<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        return response()->json($users, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $users = User::where('id',$id)->get();

        if($users->isEmpty()){
            return response()->json(['message' => 'error']);
        }
        $users = User::find($id);

        return response()->json($users, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $campos = $request->all();

        $validator = Validator::make($campos, [
            'name' => 'min:1',
            'tel' => 'tel',
            'email' => 'email',
            'password' => 'min:6'
        ]);

        if($validator->fails()){
            return response()->json(['message' => 'error', 'h' => 'h'], 401);
        }

        if(User::where('id', $id)->get()->isEmpty()){
            return response()->json(['message' => 'error'], 401);
        }

        $user = User::find($id);

        $campos['api_token'] = $user['api_token'];

        $user->update($campos);

        return response()->json($user, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // return $id;
        if(User::where('id', $id)->get()->isEmpty()){
            return response()->json(['error' => 'invalid id'], 401);
        }

        $user = User::find($id);

        $user->delete();

        return response()->json([
            'success' => true,
            'Deleted' => 'successfully',
            'data' => $user
        ], 200);
        return response()->json($user, 200);
    }
}
