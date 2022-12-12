`<?php

namespace App\Http\Controllers\API\users;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Validation\Rule;
use App\Http\Controllers\API\BaseController as BaseController;
use Validator;
use App\Http\Resources\CategoryResource as CategoryResource;
use App\Http\Resources\CategoryUpdateResource as CategoryUpdateResource;

class CategoryController extends BaseController
{
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
}
