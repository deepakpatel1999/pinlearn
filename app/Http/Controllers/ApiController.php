<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use App\Models\User;
use App\Models\Grade;
use App\Models\Category;
use App\Models\Subject;
use App\Models\Category_subject;
use Illuminate\Validation\Rule;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use Validator;
use App\Http\Resources\LoginResource as LoginResource;
use App\Http\Resources\TutorResource as TutorResource;
use App\Http\Resources\UserResource as UserResource;
use App\Http\Resources\UsereditResource as UsereditResource;
use App\Http\Resources\TutoreditResource as TutoreditResource;
use App\Http\Resources\GradeResource as GradeResource;
use App\Http\Resources\CategoryResource as CategoryResource;
use App\Http\Resources\CategoryUpdateResource as CategoryUpdateResource;
use App\Http\Resources\SubjectResorces as SubjectResorces;
use App\Http\Resources\SubjectlistResource as SubjectlistResource;



class ApiController extends BaseController
{
    //================ Login =================//
    public function login(Request $request)
    {
        $rules = [
            'email' => 'required',
            'password' => 'required',

        ];
        $input     = $request->all();
        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            $result['id'] = '';
            $result['email'] = '';
            return $this->sendError('Please enter all fields.', $validator->errors());
            die();
        }
        if (!auth()->attempt($request->all())) {
            $result['id'] = '';
            $result['email'] = '';
            return $this->sendError('Invalid Credentials.', $validator->errors());
            die();
        }
        $user = User::with('roles')->Select('id', 'email', 'name')->where('email', $request->email)->orwhere('password', $request->password)->first();
        $id = $user->id;
        $user = Auth::user();
        $dataa['token'] = Auth::user()->createToken('auth_token')->plainTextToken;
        $dataa['id'] = "$id";
        $dataa['email'] = $user->email;
        $dataa['role'] = $user['roles'][0]['name'];
        $dataa['username'] = $user->name;
        return $this->sendResponse(new LoginResource($dataa), 'Product retrieved successfully.');
        die();
    }

    public function signup(Request $request)
    {
        $data = $request->all();
        if ($data['role'] == 'Tutor') {
            $rules = [
                'name' => 'required',
                'role' => 'required',
                'email'    => 'unique:users|required',
                'user_name'    => 'required',
                'timezone'    => 'required',
                'password' => 'required',
                'image' => 'required',
                'Phone' => 'required',
                'country'    => 'required',
                'city'    => 'required',
                'Zipcode'    => 'required',
                'language' => 'required',
                'video_id' => 'required',
                'commition_rate'    => 'required',
                'biography'    => 'required',
                'status'    => 'required',
                'phone_verified_at' => 'required',
                'in_hone_page'    => 'required',
                'featured' => 'required',

            ];
        }
        if ($data['role'] == 'User') {
            $rules = [
                'name' => 'required',
                'role' => 'required',
                'image' => 'required',
                'email'    => 'unique:users|required',
                'Phone'    => 'required',
                'address'    => 'required',
                'password' => 'required',

            ];
        }
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
        $data_user = array('name' => $data['name'], 'user_name' => $data['user_name'], 'timezone' => $data['timezone'], 'email' => $data['email'], 'password' => bcrypt($data['password']), 'image' => $image, 'Phone' => $data['Phone'], 'country' => $data['country'], 'city' => $data['city'], 'address' => $data['address'], 'Zipcode' => $data['Zipcode'], 'language' => $data['language'], 'video_id' => $data['video_id'], 'commition_rate' => $data['commition_rate'], 'biography' => $data['biography'], 'status' => $data['status'], 'phone_verified_at' => $data['phone_verified_at'], 'in_hone_page' => $data['in_hone_page'], 'featured' => $data['featured']);
        $user = User::create($data_user);
        $role =  $data['role'];
        if ($role == 'Tutor') {
            $user->attachRole('Tutor');
            if ($user) {
                return $this->sendResponse(new TutorResource($user), 'Tuto register successfully.');
                die();
            } else {
                return $this->sendError('Validation Error.', $validator->errors());
                die();
            }
        } else {
            $user->attachRole('User');
            if ($user) {
                return $this->sendResponse(new UserResource($user), 'User register successfully.');
                die();
            } else {
                return $this->sendError('Validation Error.', $validator->errors());
                die();
            }
        }
    }

    //================ tutor get data====================//
    public function tutor_get_data(Request $request)
    {
        $data = User::whereRoleIs('Tutor')->orderBy('id', 'desc')->get();
        if ($data) {
            return $this->sendResponse(TutorResource::collection($data), 'Tutor retrieved successfully.');
            die();
        } else {
            return response()->json(array('status' => 'false', 'data' => '', 'message' => 'not found data'));
            die();
        }
    }
    //================ user get data====================//
    public function user_get_data(Request $request)
    {
        $data = User::whereRoleIs('User')->orderBy('id', 'desc')->get();
        if ($data) {
            return $this->sendResponse(UserResource::collection($data), 'User retrieved successfully.');
            die();
        } else {
            return response()->json(array('status' => 'false', 'data' => '', 'message' => 'not found data'));
            die();
        }
    }


    // =================== tutor_edit ========================//
    public function edit($id)
    {
        $data = User::with('roles')->find($id);

        if (is_null($data)) {
            return $this->sendError('data not found.');
        }
        $role = $data['roles'][0]['name'];
        if ($role == 'Tutor') {
            return $this->sendResponse(new TutoreditResource($data), 'data retrieved successfully.');
        } else {
            return $this->sendResponse(new UsereditResource($data), 'data retrieved successfully.');
        }
    }
    public function user_update_data(Request $request)
    {
        $data = $request->all();

        if ($data['role'] == 'Tutor') {

            $rules = [
                'name' => 'required',
                'role' => 'required',
                'email'    => 'unique:users|required',
                'user_name'    => 'required',
                'timezone'    => 'required',
                'password' => 'required',
                'Phone' => 'required',
                'country'    => 'required',
                'city'    => 'required',
                'Zipcode'    => 'required',
                'language' => 'required',
                'video_id' => 'required',
                'commition_rate'    => 'required',
                'biography'    => 'required',
                'status'    => 'required',
                'phone_verified_at' => 'required',
                'in_hone_page'    => 'required',
                'featured' => 'required',
            ];
        }
        if ($data['role'] == 'User') {

            $rules = [
                'name' => 'required',
                'role' => 'required',
                'email'    => 'unique:users|required',
                'Phone'    => 'required',
                'address'    => 'required',
                'password' => 'required',

            ];
        }
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
        $id = $data['id'];
        $data_user = array('name' => $data['name'], 'user_name' => $data['user_name'], 'timezone' => $data['timezone'], 'email' => $data['email'], 'password' => bcrypt($data['password']), 'image' => $image, 'Phone' => $data['Phone'], 'country' => $data['country'], 'city' => $data['city'], 'address' => $data['address'], 'Zipcode' => $data['Zipcode'], 'language' => $data['language'], 'video_id' => $data['video_id'], 'commition_rate' => $data['commition_rate'], 'biography' => $data['biography'], 'status' => $data['status'], 'phone_verified_at' => $data['phone_verified_at'], 'in_hone_page' => $data['in_hone_page'], 'featured' => $data['featured']);
        $user = User::where('id', $id)->update($data_user);

        $role =  $data['role'];
        if ($role == 'Tutor') {
            if ($user) {
                return response()->json(array('status' => 'true', 'data' => $data, 'message' => 'Data Update Successfully'));
                // return $this->sendResponse(new TutorResource($user), 'Tuto update successfully.');
                die();
            } else {
                return $this->sendError('Validation Error.', $validator->errors());
                die();
            }
        } else {

            if ($user) {
                return response()->json(array('status' => 'true', 'data' => $data, 'message' => 'Data Update Successfully'));
                //return $this->sendResponse(new UserResource($user), 'User update successfully.');
                die();
            } else {
                return $this->sendError('Validation Error.', $validator->errors());
                die();
            }
        }
    }


    //===============Delete Data=====================//
    public function delete_data($id)
    {
        $id = $id;
        $data = User::find($id);
        $image = $data->image;
        $path = public_path() . "/images/" . $image;
        unlink($path);
        $data = User::find($id)->delete();
        if ($data) {
            return $this->sendResponse([], 'Data deleted successfully.');
            die();
        } else {
            return response()->json(array('status' => 'false', 'message' => 'Somthing went wrong'));
            die();
        }
    }
    //================ gtade get data====================//
    public function gtade_get_data(Request $request)
    {
        $data = Grade::orderBy('id', 'desc')->get();
        if ($data) {
            return $this->sendResponse(GradeResource::collection($data), 'Tutor retrieved successfully.');
            die();
        } else {
            return response()->json(array('status' => 'false', 'data' => '', 'message' => 'not found data'));
            die();
        }
    }

    public function grade_insert(Request $request)
    {
        $data = $request->all();

        $rules = [
            'title' => 'required',
            'alias' => 'required',
            'ordering'    => 'required',
            'school_type'    => 'required',

        ];

        $validator = Validator::make($data, $rules);
        $error_msg = $validator->errors()->first();
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
            die();
        }
        $data_user = array('title' => $data['title'], 'alias' => $data['alias'], 'ordering' => $data['ordering'], 'school_type' => $data['school_type']);
        $grade = Grade::create($data_user);

        if ($grade) {
            return $this->sendResponse(new GradeResource($grade), 'data insert successfully.');
            die();
        } else {
            return $this->sendError('Validation Error.', $validator->errors());
            die();
        }
    }
    // =================== grade_edit ========================//
    public function grade_edit($id)
    {
        $data = Grade::find($id);
        if (is_null($data)) {
            return $this->sendError('data not found.');
        }
        return $this->sendResponse(new GradeResource($data), 'data retrieved successfully.');
    }
    public function grade_update_data(Request $request)
    {
        $data = $request->all();
        $rules = [
            'title' => 'required',
            'alias' => 'required',
            'ordering'    => 'required',
            'school_type'    => 'required',
            'discription'    => 'required',

        ];
        $validator = Validator::make($data, $rules);
        $error_msg = $validator->errors()->first();
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
            die();
        }
        $id = $data['id'];
        $data_user = array('title' => $data['title'], 'alias' => $data['alias'], 'ordering' => $data['ordering'], 'school_type' => $data['school_type'], 'discription' => $data['discription']);
        $grade = Grade::where('id', $id)->update($data_user);
        if ($grade) {
            return response()->json(array('status' => 'true', 'data' => $grade, 'message' => 'Data Update Successfully'));
            // return $this->sendResponse(new GradeResource($grade), 'grade register successfully.');            die();
        } else {
            return $this->sendError('Validation Error.', $validator->errors());
            die();
        }
    }
    //===============Delete Data=====================//
    public function delete_grade($id)
    {
        $id = $id;
        $data = Grade::find($id)->delete();
        if ($data) {
            return $this->sendResponse([], 'Data deleted successfully.');
            die();
        } else {
            return response()->json(array('status' => 'false', 'message' => 'Somthing went wrong'));
            die();
        }
    }

    public function category_insert(Request $request)
    {
        $data = $request->all();
        $rules = [
            'name' => 'required',
            'alias' => 'required',
            'ordering'    => 'required',
            'image'    => 'required',
            'status'    => 'required',
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
        $data_user = array('name' => $data['name'], 'alias' => $data['alias'], 'ordering' => $data['ordering'], 'image' => $image, 'status' => $data['status']);
        $Category = Category::create($data_user);

        if ($Category) {
            return $this->sendResponse(new CategoryResource($Category), ' Category register successfully.');
            die();
        } else {
            return $this->sendError('Validation Error.', $validator->errors());
            die();
        }
    }
    //================ gtade get data====================//
    public function category_get_data(Request $request)
    {
        $data = Category::orderBy('id', 'desc')->get();
        if ($data) {
            return $this->sendResponse(CategoryResource::collection($data), 'Tutor retrieved successfully.');
            die();
        } else {
            return response()->json(array('status' => 'false', 'data' => '', 'message' => 'not found data'));
            die();
        }
    }
    // =================== grade_edit ========================//
    public function category_edit($id)
    {
        $data = Category::find($id);
        if (is_null($data)) {
            return $this->sendError('data not found.');
        }
        return $this->sendResponse(new CategoryResource($data), 'data retrieved successfully.');
    }
    public function category_update_data(Request $request)
    {
        $data = $request->all();
        $rules = [
            'name' => 'required',
            'alias' => 'required',
            'ordering'    => 'required',
            'image'    => 'required',
            'status'    => 'required',

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
        $id = $data['id'];
        $data_user = array('name' => $data['name'], 'alias' => $data['alias'], 'ordering' => $data['ordering'], 'image' => $image, 'status' => $data['status']);
        $Category = Category::where('id', $id)->update($data_user);
        if ($Category) {
            return $this->sendResponse(new CategoryUpdateResource($Category), 'category update successfully.');
        } else {
            return $this->sendError('Validation Error.', $validator->errors());
            die();
        }
    }
    //===============Delete Data=====================//
    public function delete_category($id)
    {
        $id = $id;
        $data = Category::find($id)->delete();
        if ($data) {
            return $this->sendResponse([], 'Data deleted successfully.');
            die();
        } else {
            return response()->json(array('status' => 'false', 'message' => 'Somthing went wrong'));
            die();
        }
    }

    public function subject_insert(Request $request)
    {
        $data = $request->all();
        // dd($request['Category_id']);

        $rules = [
            'name' => 'required',
            'alias' => 'required',
            //'Category_id' => 'reruired',
            'status'    => 'required',
        ];
        $validator = Validator::make($data, $rules);
        $error_msg = $validator->errors()->first();
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
            die();
        }
        $data_user = array('name' => $data['name'], 'alias' => $data['alias'], 'status' => $data['status']);
        $subject = Subject::create($data_user);
        $category_id = $request['Category_id'];
        $subject->categories()->attach($subject->id);

        // foreach ($category_id as $category_ids) {
        //     $Category_id =   $category_ids;
        //     $subjects_id = $subject->id;
        //     $data_u = array('subjects_id' => $subjects_id, 'Category_id' => $Category_id);
        //     $subje = Category_subject::create($data_u);
        // }
        if ($subject) {
            return $this->sendResponse(new SubjectResorces($subject), ' subject register successfully.');
            die();
        } else {
            return $this->sendError('Validation Error.', $validator->errors());
            die();
        }
    }
    //================ subject_get_data get data====================//
    public function subject_get_data(Request $request)
    {
        //  $categoryyy = Category::with('subjects')->get();
        $categories = Subject::with('categories')->get();
        //  $categoryyy->subjects()->attach($subject);
        return $categories;

        if ($categories) {

            return $this->sendResponse(SubjectlistResource::collection($categories), 'subject retrieved successfully.');
            die();
        } else {
            return response()->json(array('status' => 'false', 'data' => '', 'message' => 'not found data'));
            die();
        }
    }

    // =================== subject_edit ========================//
    public function subject_edit($id)
    {

        $categories = Subject::with('categories')->find($id);
        //return $categories;

        if (is_null($categories)) {
            return $this->sendError('data not found.');
        }
        return response()->json(array('status' => 'true', 'data' => $categories, 'message' => 'Data get Successfully'));
    }

    public function subject_update_data(Request $request)
    {

        $data = $request->all();
        // dd($request['Category_id']);

        $rules = [
            'name' => 'required',
            'alias' => 'required',
            //'Category_id' => 'reruired',
            'status'    => 'required',
        ];
        $validator = Validator::make($data, $rules);
        $error_msg = $validator->errors()->first();
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
            die();
        }
        $data_user = array('name' => $data['name'], 'alias' => $data['alias'], 'status' => $data['status']);
        $id = $request['id'];
        $subject = Subject::where('id', $id)->update($data_user);
        $Category_id = $request['Category_id'];
        $subjects = Subject::find($id);
        // Want to keep only Editor (Id 2) role
        $subjects->categories()->sync($subjects);
        // foreach ($Category_id as $Category_ids) {
        //     $Category_id =   $Category_ids;
        //     $subjects_id = $subject->id;
        //     $data_u = array('subjects_id' => $subjects_id, 'Category_id' => $Category_id);
        //     $subje = Category_subject::create($data_u);
        // }
        if ($subject) {
            return response()->json(array('status' => 'true', 'data' => $subject, 'message' => 'Data update Successfully'));
            //return $this->sendResponse(new SubjectResorces($subject), ' subject register successfully.');
            die();
        } else {
            return $this->sendError('Validation Error.', $validator->errors());
            die();
        }
    }
}
