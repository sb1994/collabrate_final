<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use App\User;
//use Illuminate\Support\Facades\Validator;
class UserController extends Controller
{
    //
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
        //$user->save();

        // return response()
        //     ->json([
        //         'registered' => true
        //     ]);
        return $user;
    }
}
