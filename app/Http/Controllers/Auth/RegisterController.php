<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{

    public function showRegistrationForm()
    {
        $users = User::all();
        return view('register', compact('users'));
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3|max:50',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|max:20|confirmed',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
            
        }
         User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        return redirect()->back()->withSuccess('Usuário registrado com sucesso!');
    }


    protected function failedValidation(Validator $validator)
    {
        throw new \Illuminate\Validation\ValidationException($validator, response()->json($validator , 422));
    }
}
