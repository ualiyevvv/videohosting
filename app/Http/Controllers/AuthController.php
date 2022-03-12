<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    public function create() 
    {
        return view('register');
    }

    public function store(Request $request) 
    {
        $request->validate([
            'nickname' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ]);

        $user = User::create([
            'nickname' => $request->nickname,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        Auth::login($user);

        return redirect()->route('send-confirmation-email')->with('success', 'Подтвердите почту, чтобы завершить регистрацию');
    }

    public function loginForm() 
    {
        return view('login');
    }

    public function login(Request $request) 
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        
        if(Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
        ])){
            $time = date('H:i:s');
            session()->flash('success', "Вы авторизовались под именем ". Auth::user()->nickname .", время: $time");
            
            if(Auth::user()->is_admin)
            {
                return redirect()->route('admin.index');
            } 
            else 
            {
                return redirect()->route('home');
            }
        }
        
        return redirect()->back()->withErrors('Неправильный логин или пароль');
    }

    public function logout(Request $request) 
    {
        Auth::logout();

        return redirect()->route('home')->withErrors('Вы вышли из системы');
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
    }
}
