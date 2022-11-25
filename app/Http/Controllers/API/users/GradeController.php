<?php

namespace App\Http\Controllers\API\users;


use App\Http\Controllers\Controller;
use Auth;
use App\Models\Grade;
use Illuminate\Validation\Rule;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use Validator;

use App\Http\Resources\GradeResource as GradeResource;

class GradeController extends BaseController
{
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
}
