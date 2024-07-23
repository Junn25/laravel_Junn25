<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function authenticate(Request $request)
    {
        $login = $request->input('username');
        $user = User::where('username', $login)->first();

        if (!$user) {
            return redirect()->back()->withErrors(['username' => 'Invalid login credentials']);
        }

        $request->validate([
            'password' => 'required|min:8',
        ]);

        if (Auth::attempt(['username' => $user->username, 'password' => $request->password])) {
            Auth::loginUsingId($user->id);
            return redirect('/');
        } else {
            return redirect()->back()->withErrors(['password' => 'Invalid login credentials']);
        }
    }
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
}
