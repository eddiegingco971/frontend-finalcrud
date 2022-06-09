<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            'users' => User:: orderBy('id')->get()
        ]);
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
        $request->validate([
            'fullname' => 'string|required',
            'username' => 'required',
            'address' => 'string|required',
            'gender' => 'string|required',
            'phone' => 'required',
            'email' => 'string|required',
            'password' => 'required',
        ]);
        $user = User::create($request->only('fullname','username','address','gender','phone','email','username','password'));
        
        return response()->json($user);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return response()->json($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user -> update($request->only('fullname','username','address','gender','phone','email', 'password'));
        
        return response()->json($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $fullname = $user->fullname;

            $user->delete();

            return response()->json([
            'deleted' => true,
            'message' => $fullname ." has been deleted."
         ]);
    }

    public function register(Request $request) {
        $request->validate([
            'fullname' => 'string|required',
            'username' => 'required',
            'address' => 'string|required',
            'gender' => 'string|required',
            'phone' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required'
        ]);

        $user  = User::create([
            
            'fullname' => $request->fullname,
            'username' => $request->username,
            'address' => $request->address,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return response()->json([
            'message' => 'Registration success'
        ], 202);
    }

    public function login(Request $request) {
        $creds = $request->only('email','password');

        if(!$token = auth()->attempt($creds)) {
            return response()->json([
                'error' => 'Unauathorized'
            ], 401);
        }

        return $this->respondWithToken($token);
    }
}
