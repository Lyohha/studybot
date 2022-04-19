<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class UserInfoController extends Controller
{
    //
    public function index() {
        $user = Auth::user();

        if(!isset($user))
            return abort(401);

        $params = array (
            'name'      => $user->name,
            'role'      => ''
        );

        if(isset($user->roles))
        {
            if(count($user->roles))
            {
                $params['role'] = $user->roles[0]->role->name;
            }
        }

        $params['rules'] = $user->getRules();

        return response()->json($params);
    }
}
