<?php

namespace App\Http\Controllers\API\users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Subject;
use App\Models\Category_subject;
use Illuminate\Validation\Rule;
use App\Http\Controllers\API\BaseController as BaseController;
use Validator;
use App\Http\Resources\SubjectResorces as SubjectResorces;
use App\Http\Resources\SubjectlistResource as SubjectlistResource;
use App\Http\Resources\SubjectUpdateResource as SubjectUpdateResource;



class SubjectController extends BaseController
{
    public function subject_insert(Request $request)
    {
        $data = $request->all();

        $rules = [
            'name' => 'required',
            'alias' => 'required',
            'status'    => 'required',
        ];
        $validator = Validator::make($data, $rules);
        $error_msg = $validator->errors()->first();
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
            die();
        }
        $category_id = $request['categories_id'];
        $categories = Subject::with('categories')->find($category_id);
        $data_user = array('name' => $data['name'], 'alias' => $data['alias'], 'status' => $data['status']);
        $subject = Subject::create($data_user);
        $subject->categories()->attach($categories);

        if ($subject) {
            return $this->sendResponse(new SubjectResorces($subject), ' subject register successfully.');
            die();
        } else {
            return $this->sendError('Validation Error.', $validator->errors());
            die();
        }
    }
    //================ subject get data====================//
    public function subject_get_data(Request $request)
    {
        $categories = Subject::with('categories')->get();

        // return $categories;

        if ($categories) {

            return $this->sendResponse(SubjectlistResource::collection($categories), 'subject retrieved successfully.');
            die();
        } else {
            return $this->sendError('Validation Error.', $validator->errors());

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
        $rules = [
            'name' => 'required',
            'alias' => 'required',
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

        $category_id = $request['category_id'];

        $subjects = Subject::find($id);

        $subjects->categories()->sync($category_id);

        if ($subject) {
            return $this->sendResponse(new SubjectUpdateResource($subjects), ' subject register successfully.');

            die();
        } else {
            return $this->sendError('Validation Error.', $validator->errors());
            die();
        }
    }
    //===============Delete Data=====================//
    public function delete_subject($id)
    {
        $id = $id;
        $categories = Subject::with('categories')->find($id);
        $data = Subject::find($id)->delete();
        $delete = $categories->categories()->detach($id);
        if ($data) {
            return $this->sendResponse([], 'Data deleted successfully.');
            die();
        } else {
            return response()->json(array('status' => 'false', 'message' => 'Somthing went wrong'));
            die();
        }
    }
}
