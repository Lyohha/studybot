<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserRoleLink;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $users = User::with('roles.role')->paginate(20);
        $user = Auth::user();
        
        if(!isset($user))
            return abort(401);

        if(!$user->getRules()['edit_users'])
            return abort(403);

        $users = User::with('roles')->paginate(20);
        $users->withPath('/users');
        return new UserResource($users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        if(!isset($user))
            return abort(401);

        if(!$user->getRules()['edit_users'])
            return abort(403);

        $validator = Validator::make($request->all(), [
            'email'         => 'required|string|unique:users,email',
            'name'          => 'required|string|max:255',
            'password'      => [
                'required',
                'string',
                'confirmed',
                Password::min(8)
                    ->letters()
                    ->numbers()
                    // ->mixedCase()
            ]
        ]);

        if($validator->fails()) {
            $params = [
                'result'    => 'error',
                'messages'  => $validator->errors(),
            ];

            return response()->json($params);
        }

        $params = $validator->safe()->only(['name', 'email', 'password']);
        $params['password'] = Hash::make($params['password']);

        $user = new User($params);

        $user->save();

        if(is_array($request->get('roles'))) {
            foreach($request->get('roles') as $role) {
                $user_role_link = new UserRoleLink ([
                    'roles_id'   => $role,
                ]);
                $user_role_link->user()->associate($user);
                $user_role_link->save();
            }
        }
        $params = [
            'result'    => 'ok',
            'user'      => $user->id,
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

        if(!$user->getRules()['edit_users'])
            return abort(403);

        $user = User::with('roles')->find($id);

        return new UserResource($user);
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
        $user = Auth::user();

        if(!isset($user))
            return abort(401);

        if(!$user->getRules()['edit_users'])
            return abort(403);

        $validator = Validator::make($request->all(), [
            'email'         => [
                'string',
                'required',
                Rule::unique('users')->ignore($id),
            ],
            'name'          => 'required|string|max:255',
        ]);

        if($validator->fails()) {
            $params = [
                'result'    => 'error',
                'messages'  => $validator->errors(),
            ];

            return response()->json($params);
        }

        $params = $validator->safe()->only(['name', 'email']);

        if($request->has('password')) {
            $validator = Validator::make($request->all(), [
                'password'      => [
                    'string',
                    'confirmed',
                    Password::min(8)
                        ->letters()
                        ->numbers()
                        // ->mixedCase()
                ]
            ]);

            if($validator->fails()) {
                $params = [
                    'result'    => 'error',
                    'messages'  => $validator->errors(),
                ];
    
                return response()->json($params);
            }

            $params = array_merge($params, $validator->safe()->only(['password']));
            $params['password'] = Hash::make($params['password']);
        }

        $user = User::find($id);

        if(!isset($user)) {
            if($validator->fails()) {
                $params = [
                    'result'    => 'error',
                    'messages'  => 'User not found',
                ];
    
                return response()->json($params);
            }
        }

        $user->update($params);

        if(is_array($request->get('roles'))) {
            $new_roles = $request->get('roles');
            $roles = array();

            foreach($user->linked_roles as $role) {
                $r_id = strval($role->roles_id);
                if(!in_array($r_id, $new_roles)) {
                    $role->delete();
                    continue;
                }
                unset($new_roles[array_search($r_id, $new_roles)]);
            }

            foreach($new_roles as $role) {
                $user_role_link = new UserRoleLink ([
                    'roles_id'   => $role,
                ]);
                $user_role_link->user()->associate($user);
                $roles[] = $user_role_link;
                // $user_role_link->save();
            }

            $user->linked_roles()->saveMany($roles);
        }

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

        if(!$user->getRules()['edit_users'])
            return abort(403);

        User::destroy($id);
    }

    /**
     * Login users by api.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $params = $request->validate([
            'email'         => 'required|string|email',
            'password'      => [
                'required',
                'string',
                Password::min(8)
                    ->letters()
                    // ->numbers()
                    // ->mixedCase()
            ]
        ]);

        if (!Auth::guard('web')->attempt($params)) {
            return $this->error('Credentials not match', 401);
        }

        $token = Str::random(80);

        Auth::guard('web')->user()->forceFill([
            'access_token'  => hash('sha256', $token)
        ])->save();


        return response()->json(['token' => $token]);
    }
}
