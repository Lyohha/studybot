<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Roles;
use App\Http\Resources\RoleResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $roles = null;

        if($request->query('page') != null)
            $roles = Roles::paginate(10);
        else
            $roles = Roles::all();

        return new RoleResource($roles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $user = Auth::user();

        if(!isset($user))
            return abort(401);

        if(!$user->getRules()['edit_roles'])
            return abort(403);

        $fields = [
            'name'          => 'required|string|max:255',
        ];

        foreach(Roles::$list as $item) {
            $fields[$item] = 'boolean';
        }

        $validator = Validator::make($request->all(), $fields);

        if($validator->fails()) {
            $params = [
                'result'    => 'error',
                'messages'  => $validator->errors(),
            ];

            return response()->json($params);
        }

        $params = $validator->safe()->all();

        $role = new Roles($params);
        $role->save();

        $params = [
            'result'    => 'ok',
            'user'      => $role->id,
        ];

        return response()->json($params);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Auth::user();

        if(!isset($user))
            return abort(401);

        if(!$user->getRules()['edit_roles'])
            return abort(403);

        $role = Roles::find($id);

        return new RoleResource($role);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $user = Auth::user();

        if(!isset($user))
            return abort(401);

        if(!$user->getRules()['edit_roles'])
            return abort(403);

        $fields = [
            'name'          => 'required|string|max:255',
        ];

        foreach(Roles::$list as $item) {
            $fields[$item] = 'boolean';
        }

        $validator = Validator::make($request->all(), $fields);

        if($validator->fails()) {
            $params = [
                'result'    => 'error',
                'messages'  => $validator->errors(),
            ];

            return response()->json($params);
        }

        $params = $validator->safe()->all();

        foreach(Roles::$list as $item) {
            if(!isset($params[$item]))
                $params[$item] = false;
        }

        $role = Roles::find($id);

        if(!isset($role)) {
            if($validator->fails()) {
                $params = [
                    'result'    => 'error',
                    'messages'  => 'Role not found',
                ];
    
                return response()->json($params);
            }
        }

        $role->update($params);

        $params = [
            'result'    => 'ok',
            'user'      => $id,
        ];

        return response()->json($params);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $user = Auth::user();

        if(!isset($user))
            return abort(401);

        if(!$user->getRules()['edit_roles'])
            return abort(403);

        Roles::destroy($id);
    }
}
