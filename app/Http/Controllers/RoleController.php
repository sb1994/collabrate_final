<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
class RoleController extends Controller
{
    //
    public function getUserRoles(){
      $roles = Role::all();

      return response()
          ->json([
              'roles' => $roles
          ]);
    }
}
