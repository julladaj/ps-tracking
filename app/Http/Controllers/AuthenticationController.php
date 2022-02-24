<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthLoginRequest;
use App\Http\Requests\AuthRegisterRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function loginPage(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        $pageConfigs = ['bodyCustomClass' => 'bg-full-screen-image'];
//        return view('pages.auth-login', ['pageConfigs' => $pageConfigs]);
        return view('auth.login', ['pageConfigs' => $pageConfigs]);
    }

    //Register page
    public function registerPage()
    {
        $pageConfigs = ['bodyCustomClass' => 'bg-full-screen-image'];
//        return view('pages.auth-register', ['pageConfigs' => $pageConfigs]);
        return view('auth.register', ['pageConfigs' => $pageConfigs]);
    }

    //forget Password page
    public function forgetPasswordPage()
    {
        $pageConfigs = ['bodyCustomClass' => 'bg-full-screen-image'];
//        return view('pages.auth-forgot-password', ['pageConfigs' => $pageConfigs]);
        return view('auth.passwords.email', ['pageConfigs' => $pageConfigs]);
    }

    //reset Password page
    public function resetPasswordPage()
    {
        $pageConfigs = ['bodyCustomClass' => 'bg-full-screen-image'];
//        return view('pages.auth-reset-password', ['pageConfigs' => $pageConfigs]);
        return view('auth.passwords.reset', ['pageConfigs' => $pageConfigs]);
    }

    //auth lock page
    public function authLockPage()
    {
        $pageConfigs = ['bodyCustomClass' => 'bg-full-screen-image'];
        return view('pages.auth-lock-screen', ['pageConfigs' => $pageConfigs]);
    }

    /**
     * @param  AuthLoginRequest  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function login(AuthLoginRequest $request)
    {
        if (Auth::attempt(['email' => $request->get('email'), 'password' => $request->get('password')], $request->has('remember'))) {
            return redirect(RouteServiceProvider::HOME);
        }

        return back()->withErrors(['msg' => trans('auth.invalid_credential')]);
    }

    /**
     * @param  AuthRegisterRequest  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function register(AuthRegisterRequest $request)
    {
        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        abort_if(!$user->save(), 404);
        Auth::login($user, true);
        return redirect(RouteServiceProvider::HOME);
    }
}
