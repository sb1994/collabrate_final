<?php

namespace App\Http\Controllers;
use App\ProjectComment;
use App\Project;
use App\User;
use Illuminate\Http\Request;

class ProjectCommentController extends Controller
{
    //
    public function getProjectCommentsByPid($id){
      $project_comments = ProjectComment::where('project_id','=',$id)->get();

      return response()->json(['project_comments'=>$project_comments]);
    }
    public function addProjectComment(Request $request){
      $project_comment = new ProjectComment();

      $project_comment->comment = $request->comment;
      $project_comment->user_id = $request->user_id;
      $project_comment->project_id = $request->p_id;

      if ($project_comment->save()) {
        return response()->json([
            'status'=>200
          ]
        );
      }else {
        return response()->json([
            'status'=>400
          ]
        );
      }
    }
}
