<?php

namespace App\Http\Controllers;
use Storage;
use Illuminate\Http\Request;
use App\Project;

class ProjectController extends Controller
{
  public function getAllProjects()
  {
    $projects = Project::all();
    return response()
          ->json([
              'projects' => $projects
          ]);
  }
    //
    public function addProject(Request $request){
      // if ($request->hasFile('project_images')) {
      //   # code...
      //   $project_imgs = $request->project_images;
      //   return "true";
      // }
      //return $request->project_images;

      // if (is_array($project_imgs)) {
      //   // foreach ($project_imgs as $project_img) {
      //   //   // # code...
      //   //   // $fileName = $project_img->getClientOriginalName();
      //   //   // $path = public_path()."/storage/img/cover_img/".$fileName;
      //   //   // file_put_contents($path,$decoded);
      //   //   // $fileNames = [$project_img];
      //   //   // return $fileNames;
      //   //
      //   //
      //   // }
      //   return "True";
      // }
      //dd($request->all());
      //
      // foreach ($project_imgs as $project_img) {
      //   $project_img->store('img/project_img');
      // }
      // foreach ($project_imgs as $project_img) {
      //         // not sure this is needed
      //           $fname = $project_img->getClientOriginalName();
      //           $string = str_random(16);
      //           $ext = $project_img->guessExtension();
      //           $file_name = $string . '.' .  $ext;
      //           $filepath = 'img/project_img/' . $file_name;
      //           $project_img->storeAs('img/project_img', $file_name);
      // }

      $cover_image = $request->file('cover_img');
      //expoles the base64 text for the image
      $exploded = explode(',',$request->cover_img);

      //gets the string after the comma
      $decoded = base64_decode($exploded[1]);

      //checks the exstention
      if (str_contains($exploded[0],'jpeg')) {
        $extension = 'jpg';
      }else {
        # code...
        $extension = 'png';
      }
      //setting the name that will be stored in the db and with the image
      $fileName = str_random().'.'.$extension;
      //
      $path = public_path()."/storage/img/cover_img/".$fileName;
      file_put_contents($path,$decoded);

      $project  = new Project();
      $project->name = $request->name;
      $project->description = $request->description;
      $project->user_id = $request->user_id;
      $project->category_id = $request->category_id;
      $project->cover_img = $request->cover_img;
      $project->cover_img = $fileName;
      $project->save();
      //
      // $user->name = $request->name;
      // $user->profile_img = $fileName;

      // return response()
      //     ->json([
      //         'project_images' => $project_imgs
      //     ]);
      return response()
          ->json([
              'project' => $project
          ]);
      //return $request;
      //return $user;
      //return $profile_image;

    }
    public function editProject(Request $request){
      $project  = Project::where('id',$request->id)->first();

      //return $project;
      //checks if file input is set otherwise
      if ($request->cover_img =="") {
        $project->name = $request->name;
        $project->description = $request->description;
        //$project->cover_img = $request->cover_img;
        // $user->name = $request->name;
        return response()
            ->json([
                'sucess' => 200
            ]);
      }else{
        $cover_image = $request->file('cover_img');
        //expoles the base64 text for the image
        $exploded = explode(',',$request->cover_img);

        //gets the string after the comma
        $decoded = base64_decode($exploded[1]);

        //checks the exstention
        if (str_contains($exploded[0],'jpeg')) {
          $extension = 'jpg';
        }else {
          # code...
          $extension = 'png';
        }
        //setting the name that will be stored in the db and with the image
        $fileName = str_random().'.'.$extension;
        //
        $path = public_path()."/storage/img/cover_img/".$fileName;
        file_put_contents($path,$decoded);


        $project->name = $request->name;
        $project->description = $request->description;
        //$project->cover_img = $request->cover_img;
        // $user->name = $request->name;
        // $user->profile_img = $fileName;

        $project->cover_img = $fileName;
        $project->save();

        return response()
            ->json([
                'sucess' => 200
            ]);
      }
      // $cover_image = $request->file('cover_img');
      // //expoles the base64 text for the image
      // $exploded = explode(',',$request->cover_img);
      //
      // //gets the string after the comma
      // $decoded = base64_decode($exploded[1]);
      //
      // //checks the exstention
      // if (str_contains($exploded[0],'jpeg')) {
      //   $extension = 'jpg';
      // }else {
      //   # code...
      //   $extension = 'png';
      // }
      // //setting the name that will be stored in the db and with the image
      // $fileName = str_random().'.'.$extension;
      // //
      // $path = public_path()."/storage/img/cover_img/".$fileName;
      // file_put_contents($path,$decoded);
      //
      //
      // $project->name = $request->name;
      // $project->description = $request->description;
      // //$project->cover_img = $request->cover_img;
      // // $user->name = $request->name;
      // // $user->profile_img = $fileName;
      //
      // $project->cover_img = $fileName;
      // $project->save();
      //
      // return response()
      //     ->json([
      //         'sucess' => 200
      //     ]);
      //return $request;
      //return $user;
      //return $project;

    }
    //api call
    public function getUserProject($id){
      $project = Project::where('id',$id)->get();

      return $project;
    }
    public function deleteUserProject(Request $request,$id){
      //return $request;
      try {
        $project=Project::find($id);
        $project->delete();
        return response()
            ->json([
                'status' => 200
            ]);
      } catch (Exception $e) {
        return response()
            ->json([
                'status' => 404
            ]);
      }

      //return $project;

    }
    public function getSelectedProjects(Request $request){
      $searchInput = $request->input;
      $projects = Project::where('name', 'like', '%'.$searchInput.'%')
      ->orderBy('name')
      ->paginate(20);
      return response()->json(['projects'=>$projects]);
    }
}
