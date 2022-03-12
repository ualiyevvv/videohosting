<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function requestConfirmEmail()
    {
        if ( Auth::user()->isConfirmed() )
        {
            return redirect()->route('home');
        }

        return view('user.confirm');
    }

    public function sendConfirm(Request $request)
    {
        if ( Auth::user()->isConfirmed() )
        {
            return redirect()->route('home');
        }
        
        $token = Auth::user()->getEmailConfirmationToken();

        Mail::to(Auth::user()->email)->send(new WelcomeMail( Auth::user(), $token ));

        return view('user.check-email');
    }

    public function confirmEmail($token)
    {
        if ( Auth::user()->isConfirmed() )
        {
            return redirect()->route('home');
        }
        
        $user = User::where('confirmation_token', $token)->first();
        if(! $user) 
        {
            return redirect()->route('request-confirm-email');
        }
        $user->confirm();

        return redirect()->intended()->with('success', 'Почта успешно подтверждена');

    }
    
    
    public function changePass(Request $request, $id) 
    {
        $request->validate([
            'password_old' => 'required',
            'password' => 'required|confirmed',
        ]);
        
        $user = User::find($id);
        
        if( ! Hash::check( $request->password_old, $user->password ) )
        {
            return back()->withErrors('Введенный пароль не совпадает с паролем в базе данных');
        }

        $password = bcrypt($request->password);
        $user->update(['password' => $password]);
        Auth::logoutOtherDevices($request->password); //все сессии пользователя кроме текущей будут инвалидированы
        
        return redirect()->route('user.setting')->with('success', 'Пароль успешно изменен');
    }
    
    public function setting(Request $request) 
    {
        $sessions = DB::table('sessions')->where('user_id', Auth::user()->id)->get();

        return view('user.edit', compact('sessions'));
    }

    public function sessionDelete($id) 
    {
        session()->getHandler()->destroy($id);

        return redirect()->route('user.setting')->withErrors('Сессия удалена');
    }



}
