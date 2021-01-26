<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        return response()->json(Auth::user(),200);
    }
    public function create(Request $request)
    {
        $this->middleware('auth');

        $messages = [
            'name.required' => 'El campo nombre es obligatorio.',
            'email.required' => 'El campo email es obligatorio.',
            'email.email' => 'Por favor, escribe una dirección de correo válida.',
            'role_id.required' => 'El campo nombre es obligatorio.',
            'code_access.unique' => 'El codigo ya esta siendo usado.',
            'code_access.required' => 'El campo codigo es obligatorio.',
            'password.required' => 'El campo contraseña es obligatorio'
        ];

        $rules = array(
            'name' => 'required',
            'email' => 'email|required|email',
            'role_id' => 'required',
            'code_access' => 'required',
            'password' => 'required'
        );

        $validator = Validator::make($request->all(), $rules, $messages);
        
        if ($validator->fails()) {

            return response()->json(['errors' => $validator->errors()], 422);

        } else { 
            $user = new User;

            $user->name = $request->name;
            $user->email = $request->email;
            $user->role_id = $request->role_id;
            $user->code_access = $request->code_access;
            $user->password = Hash::make($request->password);

            if($user->save()){
                return response()->json(['success' => true, 'message' => 'El usuario ha sido creado correctamente', 'users' => User::all()], 200);
            } else {
                return response()->json(['success' => false, 'message' => 'El usuario no ha sido almacenado.'], 200);
            }
        }
    }

    public function store(Request $request)
    {
        $this->middleware('auth');

        $users = User::all();

        $users->map(function($elem) {
            $elem['role'] = $elem->role;
        });

        return response()->json(['users' => $users],200);
    }

    public function update(Request $request)
    {

        $this->middleware('auth');

        $messages = [
            'id.required' => 'El campo id es obligatorio.',
            'name.required' => 'El campo nombre es obligatorio.',
            'email.required' => 'El campo email es obligatorio.',
            'email.email' => 'Por favor, escribe una dirección de correo válida.',
            'role_id.required' => 'El campo nombre es obligatorio.',
            'code_access.unique' => 'El codigo ya esta siendo usado.',
            'code_access.required' => 'El campo codigo es obligatorio.',
            'password.required' => 'El campo contraseña es obligatorio'
        ];

        $rules = array(
            'id' => 'required',
            'name' => 'required',
            'email' => 'email|required|email',
            'role_id' => 'required',
            'code_access' => 'required',
            'password' => 'required'
        );

        
        $validator = Validator::make($request->all(), $rules, $messages);
        
        if ($validator->fails()) {

            return response()->json(['errors' => $validator->errors()], 422);

        } else { 
            $user = User::find($request->id);

            $user->name = $request->name;
            $user->email = $request->email;
            $user->role_id = $request->role_id;
            $user->code_access = $request->code_access;
            $user->password = Hash::make($request->password);

            if($user->save()){
                return response()->json(['success' => true, 'message' => 'El usuario ha sido editado correctamente', 'users' => User::all()], 200);
            } else {
                return response()->json(['success' => false, 'message' => 'El usuario no ha sido almacenado.'], 200);
            }
        }
    }
    public function destroy(Request $request)
    {
        $this->middleware('auth');
        $user = User::find($request->id);

        if($user->delete()){
            return response()->json(['success' => true, 'message' => 'El usuario ha sido eliminado correctamente', 'users' => User::all()], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'No se ha logrado procesar la solicitud.'], 200);
        }
    }
}
