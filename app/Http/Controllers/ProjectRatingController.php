<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProjectRating;
class ProjectRatingController extends Controller
{
    //
    public function addProjectRating(Request $request){
      $project_rating = new ProjectRating();

      $project_rating->project_id = $request->project_id;
      $project_rating->user_id = $request->user_id;


      if ($project_rating->save()) {
        return response()->json(['status'=>200,'message'=>'Rating Added']);
      }else{
        return response()->json(['status'=>401,'message'=>'Something went Wrong']);
      }

    }
    public function getNoOfProjectRating($id){
    $count = ProjectRating::where(['project_id' => $id])->count();

    return response()->json(['count'=>$count]);
    }
}
