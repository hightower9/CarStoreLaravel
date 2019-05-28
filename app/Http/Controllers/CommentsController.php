<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use Auth;

class CommentsController extends Controller
{
	public function comment(Request $request, $id)
	{
		$this->validate(request(),[
			'comment' => 'required', 
		]);

		$comment = new Comment();
		$uid = Auth::user()->id;
		$comment->user_id= $uid;
		$comment->car_id= $id;
		$comment->comment= $request['comment'];

    // add other fields
		$comment->save();

		$comments = Comment::where('car_id', '=', $id)->get();

		return redirect('/view/' . $id);

	}

	public function delete($id, $carid)
	{
        Comment::find($id)->delete();
    return redirect('/view/' . $carid);
	}
}

