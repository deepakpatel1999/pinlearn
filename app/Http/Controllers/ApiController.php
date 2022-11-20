<?php

namespace App\Http\Controllers;

use Auth;

use DB;
use App\Models\User;
use App\Models\Category;
use Illuminate\Validation\Rule;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use Validator;
use App\Http\Resources\Inspiration as InspirationResource;




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
      //return response()->json(['success' => 'false', 'data' => $result, 'message' => "Please enter all fields"]);
      return $this->sendError('Please enter all fields.', $validator->errors());
      die();
    }

    if (!auth()->attempt($request->all())) {
      $result['id'] = '';
      $result['email'] = '';
      //return response(['status' => 'false', 'data' => $result, 'message' => 'Invalid Credentials']);
      return $this->sendError('Invalid Credentials.', $validator->errors());
      die();
    }

    $user = User::Select('id', 'email', 'name')->where('email', $request->email)->orwhere('password', $request->password)->first();
    $id = $user->id;
    $user = Auth::user();
    $dataa['token'] = Auth::user()->createToken('auth_token')->plainTextToken;
    $dataa['id'] = "$id";
    $dataa['email'] = $user->email;
    $dataa['username'] = $user->name;
    // echo json_encode(array('status' => 'true', 'data' => $dataa, 'message' => 'User Login Successfully'));
    return $this->sendResponse($dataa, 'User Login successfully.');
    die();
  }

  //================ sIGN UP====================//
  // public function signup(Request $request)
  // {

  //   $rules = [
  //     'name' => 'required',
  //     'email'    => 'unique:users|required',
  //     'password' => 'unique:users|required',

  //   ];

  //   $data = $request->all();

  //   $validator = Validator::make($data, $rules);

  //   $dataa['name'] = '';

  //   $dataa['email'] = '';

  //   $dataa['password'] = '';

  //   $error_msg = '';

  //   $error_msg = $validator->errors()->first();

  //   if ($validator->fails()) {

  //     //return response()->json(['status' => 'false', 'data' => $dataa, 'message' => $error_msg]);
  //     return $this->sendError('Validation Error.', $validator->errors());
  //     die();
  //   }

  //   $data_user = array('name' => $data['name'], 'email' => $data['email'], 'password' => bcrypt($data['password']));

  //   $user = User::create($data_user);
  //   $token = $user()->createToken('auth_token')->plainTextToken;

  //   if ($user) {

  //     //return response()->json(array('status' => 'true', 'data' => $token, 'message' => 'User Register Successfully'));
  //     return $this->sendResponse($data_user, 'User register successfully.');
  //     die();
  //   } else {

  //     //return response()->json(array('status' => 'false', 'data' => $dataa, 'message' => 'Somthing went wrong'));
  //     return $this->sendError('Validation Error.', $validator->errors());
  //     die();
  //   }
  // }

  //================ inspiration get data====================//
  // public function inspiration_get_data(Request $request)
  // {

  //   $data = Inspiration::orderBy('id', 'desc')->get();
  //   if ($data) {
  //     //return response()->json(array('status' => 'true', 'data' => $data, 'message' => 'successfully get data'));
  //     return $this->sendResponse(InspirationResource::collection($data), 'data retrieved successfully.');
  //     die();
  //   } else {
  //     return response()->json(array('status' => 'false', 'data' => '', 'message' => 'not found data'));

  //     die();
  //   }
  // }

  //================ inspiration Insert data====================//
  // public function inspiration_insert_data(Request $request)
  // {
  //   $rules = [
  //     'title' => 'required',
  //     'files'    =>  'required|image|mimes:jpeg,png,jpg,gif|max:2048',

  //   ];

  //   $data = $request->all();

  //   $validator = Validator::make($data, $rules);

  //   $dataa['title'] = '';

  //   $dataa['files'] = '';

  //   $error_msg = '';

  //   $error_msg = $validator->errors()->first();

  //   if ($validator->fails()) {

  //     //return response()->json(['status' => 'false', 'data' => $dataa, 'message' => $error_msg]);
  //     return $this->sendError('Validation Error.', $validator->errors());
  //     die();
  //   }
  //   if ($request->file('files')) {
  //     $imagePath = $request->file('files');
  //     $image = time() . '.' . $imagePath->getClientOriginalName();
  //     $destinationPath = public_path('/images');
  //     $imagePath->move($destinationPath, $image);
  //   } else {
  //     $image = 'test.png';
  //   }
  //   $datas['title'] = $request->title;
  //   $datas['files'] = $image;
  //   $data_user = array('title' => $data['title'], 'image' => $image);

  //   $user = Inspiration::create($data_user);

  //   if ($user) {

  //     return response()->json(array('status' => 'true', 'data' => $datas, 'message' => 'Data Register Successfully'));
  //     //return $this->sendResponse(new InspirationResource($data_user), 'Inspiration created successfully.');
  //     die();
  //   } else {

  //     return response()->json(array('status' => 'false', 'data' => $dataa, 'message' => 'Somthing went wrong'));

  //     die();
  //   }
  // }
  //=================== edit ========================//
  // public function Inspiration_edit($id)
  // {
  //   $data = Inspiration::find($id);

  //   if (is_null($data)) {
  //     return $this->sendError('data not found.');
  //   }

  //   return $this->sendResponse(new InspirationResource($data), 'data retrieved successfully.');
  // }
  //================ inspiration UPDATE data====================//
  // public function inspiration_update_data(Request $request)
  // {
  //   $id = $request->id;
  //   $updated_at = date("Y-m-d H:i:s");
  //   $rules = [
  //     'title' => 'required',

  //   ];

  //   $data['title'] = $request->title;
  //   $data['id'] = $request->id;

  //   $validator = Validator::make($data, $rules);

  //   $dataa['title'] = '';

  //   $error_msg = '';

  //   $error_msg = $validator->errors()->first();

  //   if ($validator->fails()) {

  //     //return response()->json(['status' => 'false', 'data' => $dataa, 'message' => $error_msg]);
  //     return $this->sendError('Validation Error.', $validator->errors());
  //     die();
  //   }
  //   if ($request->file('files')) {
  //     $imagePath = $request->file('files');
  //     $image = time() . '.' . $imagePath->getClientOriginalName();
  //     $destinationPath = public_path('/images');
  //     $imagePath->move($destinationPath, $image);
  //     $data['files'] = $image;
  //     $user = Inspiration::where('id', $id)->update(['title' => $request->title, 'image' => $image, 'updated_at' => $request->updated_at]);
  //   } else {

  //     $user = Inspiration::where('id', $id)->update(['title' => $request->title, 'updated_at' => $request->updated_at]);
  //   }
  //   if ($user) {

  //     return response()->json(array('status' => 'true', 'data' => $data, 'message' => 'Data Update Successfully'));
  //     //return $this->sendResponse(new InspirationResource($data), 'Inspiration created successfully.');
  //     die();
  //   } else {

  //     return response()->json(array('status' => 'false', 'data' => $dataa, 'message' => 'Somthing went wrong'));

  //     die();
  //   }
  // }

  //===============Delete Data=====================//
  // public function inspiration_delete_data(Request $request)
  // {
  //   $id = $request->id;
  //   $data = Inspiration::find($id);
  //   $image = $data->image;
  //   $path = public_path() . "/images/" . $image;
  //   unlink($path);
  //   $data = Inspiration::find($id)->delete();

  //   if ($data) {

  //     //return response()->json(array('status' => 'true', 'message' => 'Data Delete Successfully'));
  //     return $this->sendResponse([], 'Data deleted successfully.');
  //     die();
  //   } else {

  //     return response()->json(array('status' => 'false', 'message' => 'Somthing went wrong'));

  //     die();
  //   }
  // }


}
