<?php

namespace  App\Http\Controllers\API\users;

use Auth;
use Illuminate\Validation\Rule;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use Validator;
use App\Http\Resources\LoginResource as LoginResource;
use App\Http\Resources\TutorResource as TutorResource;
use App\Http\Resources\UserResource as UserResource;
use App\Http\Resources\UsereditResource as UsereditResource;
use App\Http\Resources\TutoreditResource as TutoreditResource;


class UsersController extends BaseController
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
                return $this->sendResponse(new TutorResource($user), 'Tutor register successfully.');
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
}
