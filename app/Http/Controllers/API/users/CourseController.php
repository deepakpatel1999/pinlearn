<?php

namespace App\Http\Controllers\API\users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Course;
use App\Models\Category;
use App\Models\Course_section;
use App\Models\Lecture;
use App\Models\Course_coupons;
use App\Models\User;
use Illuminate\Validation\Rule;
use App\Http\Controllers\API\BaseController as BaseController;
use Validator;
use App\Http\Resources\CourseResource as CourseResource;
use App\Http\Resources\SectionResource as SectionResource;
use App\Http\Resources\LectureResource as LectureResource;
use App\Http\Resources\CourseCouponResource as CourseCouponResource;

class CourseController extends BaseController
{
    public function course_insert(Request $request)
    {

        $data = $request->all();

        $rules = [
            'user_id' => 'required',
            'price' => 'required',
            'age'    => 'required',
            'introduction_video_link' => 'required',
            'description' => 'required',
            'cource_title' => 'required',
            'image'    => 'required',
            'end_of_my_course'    => 'required',
            'should_take' => 'required',
            'students_need' => 'required',

        ];
        $validator = Validator::make($data, $rules);
        $error_msg = $validator->errors()->first();
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
            die();
        }
        if ($request->file('image')) {
            $imagePath = $request->file('image');
            $image = time() . '.' . $imagePath->getClientOriginalName();
            $destinationPath = public_path('/images');
            $imagePath->move($destinationPath, $image);
            $image = $image;
        } else {
            $image = '';
        }
        if ($request->file('introduction_video_link')) {
            $imagePath = $request->file('introduction_video_link');
            $introduction_video_link = time() . '.' . $imagePath->getClientOriginalName();
            $destinationPath = public_path('/images/video');
            $imagePath->move($destinationPath, $introduction_video_link);
            $introduction_video_link = $introduction_video_link;
        } else {
            $introduction_video_link = '';
        }
        $subject_id = $request['subject_id'];
        $category_id = $request['category_id'];
        $topic_id = $request['topic_id'];
        $grade_id = $request['grade_id'];

        $subject_ids = Course::with('subjects')->find($subject_id);
        // $categories = Course::with('categories')->find($category_id);

        $topic_ids = Course::with('topics')->find($topic_id);
        $grade_ids = Course::with('grades')->find($grade_id);

        $course = array('user_id' => $data['user_id'], 'price' => $data['price'], 'age' => $data['age'], 'introduction_video_link' => $introduction_video_link, 'description' => $data['description'], 'cource_title' => $data['cource_title'], 'image' => $image, 'end_of_my_course' => $data['end_of_my_course'], 'should_take' => $data['should_take'], 'students_need' => $data['students_need']);

        $courses = Course::create($course);

        $courses->subjects()->attach($subject_ids);
        // $courses->categories()->attach($categories);
        $courses->topics()->attach($topic_ids);
        $courses->grades()->attach($grade_ids);

        $id = $courses->id;
        $data = Course::find($id);

        if ($course) {
            return $this->sendResponse(CourseResource::make($data), ' Course register successfully.');
            die();
        } else {
            return $this->sendError('Validation Error.', $validator->errors());
            die();
        }
    }
    public function add_section(Request $request)
    {

        $data = $request->all();

        $rules = [
            'course_id' => 'required',
            'title'    => 'required',
            'description'    => 'required',
            'ordering' => 'required',
            'trial_video' => 'required',

        ];
        $validator = Validator::make($data, $rules);
        $error_msg = $validator->errors()->first();
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
            die();
        } else {
            $section = array('course_id' => $data['course_id'], 'title' => $data['title'], 'description' => $data['description'], 'ordering' => $data['ordering'], 'trial_video' => $data['trial_video']);
            $section = Course_section::create($section);
            if ($section) {
                return $this->sendResponse(new SectionResource($section), ' Section register successfully.');
                die();
            } else {
                return $this->sendError('Validation Error.', $validator->errors());
                die();
            }
        }
    }
    //================ add_lecture data====================//
    public function add_lecture(Request $request)
    {
        $data = $request->all();
        $rules = [
            'course_id'    => 'required',
            'course_sections_id'    => 'required',
            'title'    => 'required',
            'description'    => 'required',
            'ordering' => 'required',
            'file' => 'required',
        ];
        $validator = Validator::make($data, $rules);
        $error_msg = $validator->errors()->first();
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
            die();
        } else {

            if ($request->file('file')) {
                $imagePath = $request->file('file');
                $file = time() . '.' . $imagePath->getClientOriginalName();
                $destinationPath = public_path('/images/video');
                $imagePath->move($destinationPath, $file);
                $file = $file;
            } else {
                $file = '';
            }

            $lecture = array('course_id' => $data['course_id'], 'course_sections_id' => $data['course_sections_id'], 'title' => $data['title'], 'description' => $data['description'], 'ordering' => $data['ordering'], 'file' => $file);
            $section = Lecture::create($lecture);

            if ($section) {
                return $this->sendResponse(new LectureResource($section), ' Section register successfully.');
                die();
            } else {
                return $this->sendError('Validation Error.', $validator->errors());
                die();
            }
        }
    }
    //================ course_coupon data====================//
    public function course_coupon(Request $request)
    {
        $data = $request->all();
        $rules = [
            'course_id'    => 'required',
            'name'    => 'required',
            'name'    => 'required',
            'maximum_number' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'money_discount' => 'required',

        ];
        $validator = Validator::make($data, $rules);
        $error_msg = $validator->errors()->first();
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
            die();
        } else {



            $coupons = array('course_id' => $data['course_id'],'name' => $data['name'], 'coupon_code' => $data['coupon_code'],'maximum_number' => $data['maximum_number'], 'start_date' => $data['start_date'], 'end_date' => $data['end_date'], 'money_discount' => $data['money_discount']);
            $coupon = Course_coupons::create($coupons);

            if ($coupon) {
                return $this->sendResponse(new CourseCouponResource($coupon), ' Section register successfully.');
                die();
            } else {
                return $this->sendError('Validation Error.', $validator->errors());
                die();
            }
        }
    }
    // =================== get_course ========================//
    public function get_course()
    {

        $course = Course::with('user','sections')->get();
        //$section = Course::with('sections')->get();

return  $course;

        //return response()->json(array('status' => 'true', 'data' => $categories, 'message' => 'Data get Successfully'));
    }

    // public function subject_update_data(Request $request)
    // {
    //     $data = $request->all();
    //     $rules = [
    //         'name' => 'required',
    //         'alias' => 'required',
    //         'status'    => 'required',
    //     ];
    //     $validator = Validator::make($data, $rules);
    //     $error_msg = $validator->errors()->first();
    //     if ($validator->fails()) {
    //         return $this->sendError('Validation Error.', $validator->errors());
    //         die();
    //     }
    //     $data_user = array('name' => $data['name'], 'alias' => $data['alias'], 'status' => $data['status']);
    //     $id = $request['id'];
    //     $subject = Subject::where('id', $id)->update($data_user);

    //     $category_id = $request['category_id'];

    //     $subjects = Subject::find($id);

    //     $subjects->categories()->sync($category_id);

    //     if ($subject) {
    //         return $this->sendResponse(new SubjectUpdateResource($subjects), ' subject register successfully.');

    //         die();
    //     } else {
    //         return $this->sendError('Validation Error.', $validator->errors());
    //         die();
    //     }
    // }
    // //===============Delete Data=====================//
    // public function delete_subject($id)
    // {
    //     $id = $id;
    //     $categories = Subject::with('categories')->find($id);
    //     $data = Subject::find($id)->delete();
    //     $delete = $categories->categories()->detach($id);
    //     if ($data) {
    //         return $this->sendResponse([], 'Data deleted successfully.');
    //         die();
    //     } else {
    //         return response()->json(array('status' => 'false', 'message' => 'Somthing went wrong'));
    //         die();
    //     }
    // }
}
