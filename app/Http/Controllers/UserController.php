<?php

namespace Restful\Http\Controllers;

use Illuminate\Http\Request;
use Restful\Http\Requests;
use Restful\Http\Controllers\Controller;
use Restful\User;

class UserController extends Controller
{
    
    public function index()
    {
      return User::all();
    }

  
    public function create()
    {
        //
    }

   
    public function store(Request $request)
    { 
        if (!is_array($request->all())) {
            return ['error' => 'request must be an array'];
        }
        // Creamos las reglas de validación
        $rules = [
            'name'      => 'required',
            'email'     => 'required|email',
            'password'  => 'required'
            ];

        try {
         // Ejecutamos el validador, en caso de que falle devolvemos la respuesta
        $validator = \Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return [
                'created' => false,
                'errors'  => $validator->errors()->all()
            ];
        }

        User::create($request->all());
        return ['created' => true];
        
        } catch (Exception $e) {
            \Log::info('Error creating user: '.$e);
            return \Response::json(['created' => false], 500);
        }
    }

   
    public function show($user)
    {
        //return User::find($id);
        //return User::findOrFail($id);
        return $user;
    }

  
    public function edit($user)
    {
        //
    }

    
    public function update(Request $request, $user)
    {
        $user = User::find($user);
        $user->update($request->all());
        return ['updated' => true];
    }

    
    public function destroy($user)
    {
        User::destroy($user);
        return ['deleted' => true];
    }

      public function names()
    {
        return user::all()->lists('name');
    }
}
