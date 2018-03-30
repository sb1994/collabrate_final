<?php

namespace App\Http\Controllers;
use App\User;
use Hash;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:api')->only('logout');
    }
    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);

        $user = new User($request->all());
        $user->password = bcrypt($request->password);
        $user->profile_img='default.jpg';
        $user->save();

        return response()
            ->json([
                'registered' => true
            ]);
        //return $user;
    }
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)
            ->first();
        //checks the hashed input password vs the stored password
        if($user && Hash::check($request->password, $user->password)) {
            return response()
                ->json([
                    'user_id' => $user->id
                ]);
        }

        return response()
            ->json([
                'email' => ['Provided email and password does not match!']
            ], 422);
    }
    public function showProfile($user_id) {
      $user = User::where('id',$user_id)->get();
      //$user_projects= $->projects()->get();
      //return $user_projects;
      // response()->json([
      //     'user' => $user,
      //     'projects' => $user_projects
      // ]);
      return $user;
    }
    public function editProfile(Request $request) {
      //return $request;
      if ($request->profile_img =="") {
         //return "there is no file";
        //return $request->profile_img;
        $user  = User::find($request->id);
        // $user->password = bcrypt($request->password);
        $user->name = $request->name;
        $user->skill = $request->skill;
        $user->country = $request->country;
        $user->city = $request->city;
        $user->profession = $request->profession;
        $user->main_intrest = $request->main_intrest;
        $user->biography=$request->biography;
        //$user->profile_img = $fileName;
        $user->role_id = $request->role_id;
        $user->save();
      }else {
          $profile_image = $request->file('profile_img');
          //expoles the base64 text for the image
          $exploded = explode(',',$request->profile_img);

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
          $path = public_path()."/storage/img/profile_img/".$fileName;
          file_put_contents($path,$decoded);

          $user  = User::find($request->id);
          // $user->password = bcrypt($request->password);
          $user->name = $request->name;
          $user->skill = $request->skill;
          $user->country = $request->country;
          $user->city = $request->city;
          $user->profession = $request->profession;
          $user->main_intrest = $request->main_intrest;
          $user->biography=$request->biography;
          $user->profile_img = $fileName;
          $user->role_id = $request->role_id;
          $user->save();
      }
      // if ($request->hasFile('profile_img')) {
      //   $profile_image = $request->file('profile_img');
      //   //expoles the base64 text for the image
      //   $exploded = explode(',',$request->profile_img);
      //
      //   //gets the string after the comma
      //   $decoded = base64_decode($exploded[1]);
      //
      //   //checks the exstention
      //   if (str_contains($exploded[0],'jpeg')) {
      //     $extension = 'jpg';
      //   }else {
      //     # code...
      //     $extension = 'png';
      //   }
      //   //setting the name that will be stored in the db and with the image
      //   $fileName = str_random().'.'.$extension;
      //   //
      //   $path = public_path()."/storage/img/profile_img/".$fileName;
      //   file_put_contents($path,$decoded);
      //
      //   $user  = User::find($request->id);
      //   // $user->password = bcrypt($request->password);
      //   $user->name = $request->name;
      //   $user->skill = $request->skill;
      //   $user->country = $request->country;
      //   $user->city = $request->city;
      //   $user->profession = $request->profession;
      //   $user->main_intrest = $request->main_intrest;
      //   $user->biography=$request->biography;
      //   $user->profile_img = $fileName;
      //   $user->role_id = $request->role_id;
      //   $user->save();
      // }else {
      //   $user  = User::find($request->id);
      //   // $user->password = bcrypt($request->password);
      //   $user->name = $request->name;
      //   $user->skill = $request->skill;
      //   $user->country = $request->country;
      //   $user->city = $request->city;
      //   $user->profession = $request->profession;
      //   $user->main_intrest = $request->main_intrest;
      //   $user->biography=$request->biography;
      //   //$user->profile_img = $fileName;
      //   $user->role_id = $request->role_id;
      //   $user->save();
      // }
      // if ($request->profile_img !="") {
      //    //return "there is a file";
      //   return $request->profile_img;
      // }else {
      //   return "no file uploaded";
      // }
      // if ($request->profile_img == "") {
      //     // $user  = User::find($request->id);
      //     // // $user->password = bcrypt($request->password);
      //     // $user->name = $request->name;
      //     // $user->skill = $request->skill;
      //     // $user->country = $request->country;
      //     // $user->city = $request->city;
      //     // $user->profession = $request->profession;
      //     // $user->main_intrest = $request->main_intrest;
      //     // $user->biography=$request->biography;
      //     // //$user->profile_img = $fileName;
      //     // $user->role_id = $request->role_id;
      //     // $user->save();
      // }else {
      //   //
      //   //     //$profile_image = $request->file('profile_img');
      //   //     //expoles the base64 text for the image
      //   // $exploded = explode(',',$request->profile_img);
      //   //
      //   // //gets the string after the comma
      //   // $decoded = base64_decode($exploded[1]);
      //   //
      //   // //checks the exstention
      //   // if (str_contains($exploded[0],'jpeg')) {
      //   //   $extension = 'jpg';
      //   // }else {
      //   //   # code...
      //   //   $extension = 'png';
      //   // }
      //   // //setting the name that will be stored in the db and with the image
      //   // $fileName = str_random().'.'.$extension;
      //   // //
      //   // $path = public_path()."/storage/img/profile_img/".$fileName;
      //   // file_put_contents($path,$decoded);
      //   //
      //   // $user  = User::find($request->id);
      //   // // $user->password = bcrypt($request->password);
      //   // $user->name = $request->name;
      //   // $user->skill = $request->skill;
      //   // $user->country = $request->country;
      //   // $user->city = $request->city;
      //   // $user->profession = $request->profession;
      //   // $user->main_intrest = $request->main_intrest;
      //   // $user->biography=$request->biography;
      //   // $user->profile_img = $fileName;
      //   // $user->role_id = $request->role_id;
      //   // $user->save();
      //   return "There is a file";
      // }
      // if ($request->has('profile_img')) {
      //   $profile_image = $request->file('profile_img');
      //   //expoles the base64 text for the image
      //   $exploded = explode(',',$request->profile_img);
      //
      //   //gets the string after the comma
      //   $decoded = base64_decode($exploded[1]);
      //
      //   //checks the exstention
      //   if (str_contains($exploded[0],'jpeg')) {
      //     $extension = 'jpg';
      //   }else {
      //     # code...
      //     $extension = 'png';
      //   }
      //   //setting the name that will be stored in the db and with the image
      //   $fileName = str_random().'.'.$extension;
      //   //
      //   $path = public_path()."/storage/img/profile_img/".$fileName;
      //   file_put_contents($path,$decoded);
      //
      //   $user  = User::find($request->id);
      //   // $user->password = bcrypt($request->password);
      //   $user->name = $request->name;
      //   $user->skill = $request->skill;
      //   $user->country = $request->country;
      //   $user->city = $request->city;
      //   $user->profession = $request->profession;
      //   $user->main_intrest = $request->main_intrest;
      //   $user->biography=$request->biography;
      //   $user->profile_img = $fileName;
      //   $user->role_id = $request->role_id;
      //   $user->save();
      // }else {
      //   $user  = User::find($request->id);
      //   // $user->password = bcrypt($request->password);
      //   $user->name = $request->name;
      //   $user->skill = $request->skill;
      //   $user->country = $request->country;
      //   $user->city = $request->city;
      //   $user->profession = $request->profession;
      //   $user->main_intrest = $request->main_intrest;
      //   $user->biography=$request->biography;
      //   //$user->profile_img = $fileName;
      //   $user->role_id = $request->role_id;
      //   $user->save();
      // }
      //

      // if ($request->has('profile_img')) {
      //   return 'There is a file';
      // }else {
      //   return 'file was uploaded';
      // }

      // return response()
      //     ->json([
      //         'user' => $user
      //     ]);
      //return $request;
      //return $user;
      //return $profile_image;
    }
    public function getUserProjects($user_id)
    {
      $user_projects = User::find($user_id)->projects;

      // return response()
      //     ->json([
      //         'projects' => $user_projects
      //     ]);
      return $user_projects;
    }
}
