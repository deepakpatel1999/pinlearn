<?php

namespace App\Http\Controllers\API\users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Topic;
use Illuminate\Validation\Rule;
use App\Http\Controllers\API\BaseController as BaseController;
use Validator;
use App\Http\Resources\TopicResource as TopicResource;
use App\Http\Resources\TopicInsertResource as TopicInsertResource;

class TopicController extends BaseController
{
    public function topic_insert(Request $request)
    {
        $data = $request->all();
        $rules = [
            'name' => 'required',
            'alias' => 'required',
            'ordering'    => 'required',
        ];
        $validator = Validator::make($data, $rules);
        $error_msg = $validator->errors()->first();
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
            die();
        }
        $category_id = $request['category_id'];
        $subject_id = $request['subject_id'];
        $categories = Topic::with('categories')->find($category_id);
        $subject = Topic::with('categories')->find($subject_id);
        $data_user = array('name' => $data['name'], 'alias' => $data['alias'], 'ordering' => $data['ordering']);

        $topic = Topic::create($data_user);
        $id = $topic->id;
        $data = Topic::find($id);

        $topic->categories()->attach($categories);
        $topic->subjects()->attach($subject);
        // return $topic;
        if ($topic) {
            return $this->sendResponse(TopicInsertResource::make($data), 'Topics Insert successfully.');
            die();
        } else {
            return $this->sendError('Validation Error.', $validator->errors());
            die();
        }
    }
    //================ topic_get get data====================//
    public function topic_get_data(Request $request)
    {
        $topics = Topic::with('categories', 'subjects')->get();

        if ($topics) {
            return $this->sendResponse(TopicResource::collection($topics), 'Topics retrieved successfully.');
            die();
        } else {
            return response()->json(array('status' => 'false', 'data' => '', 'message' => 'not found data'));
            die();
        }
    }
    // =================== topic_edit ========================//
    public function topic_edit($id)
    {
        $topic = Topic::with('categories', 'subjects')->find($id);

        if (is_null($topic)) {
            return $this->sendError('data not found.');
        }
        return $this->sendResponse(TopicResource::make($topic), 'Topics retrieved successfully.');
    }

    public function topic_update_data(Request $request)
    {
        $data = $request->all();
        $rules = [
            'name' => 'required',
            'alias' => 'required',
            'ordering'    => 'required',
        ];
        $validator = Validator::make($data, $rules);
        $error_msg = $validator->errors()->first();
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
            die();
        }
        $data_user = array('name' => $data['name'], 'alias' => $data['alias'], 'ordering' => $data['ordering']);

        $id = $request['id'];

        $category_id = $request['category_id'];

        $subject_id = $request['subject_id'];

        $categories = Topic::with('categories')->find($category_id);

        $subject = Topic::with('subjects')->find($subject_id);

        $topic = Topic::where('id', $id)->update($data_user);

        $topics = Topic::find($id);

        $topics->categories()->sync($categories);

        $topics->subjects()->sync($subject);
        return $topics;
        if ($topics) {
            return $this->sendResponse(TopicInsertResource::make($topics), ' Topics Update successfully.');

            die();
        } else {
            return $this->sendError('Validation Error.', $validator->errors());
            die();
        }
    }

    //===============Delete Data=====================//
    public function delete_topic($id)
    {
        $id = $id;
        $categories = Topic::with('categories')->find($id);
        $subjects = Topic::with('subjects')->find($id);
        $data = Topic::find($id)->delete();
        $cat = $categories->categories()->detach($id);
        $sub = $categories->subjects()->detach($id);
        if ($data) {
            return $this->sendResponse([], 'Data deleted successfully.');
            die();
        } else {
            return response()->json(array('status' => 'false', 'message' => 'Somthing went wrong'));
            die();
        }
    }
}
