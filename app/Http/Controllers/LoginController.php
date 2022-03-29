<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /**
     * Handle an authentication attempt.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
            'remember_me' => ['sometimes', 'boolean'],
        ]);

        if (Auth::attempt(request()->only(['email', 'password']), request()->get("remember_me", false))) {
            $request->session()->regenerate();

            return redirect('/');
        }

        return back()->withErrors([
            'email' => 'Les informations d\'identification fournies ne correspondent pas à nos enregistrements.',
        ])->withInput($request->except('password'));
    }

    /**
     * Log the user out of the application.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function register(Request $request)
    {
        $request->validate([
            'civility' => ['required', 'in:MR,MME'],
            'firstname' => ['required'],
            'lastname' => ['required'],
            'email' => ['required', 'email', 'unique:App\Models\User,email'],
            'password' => ['required', 'min:8'],
        ]);

        $user = new User($request->except("password"));
        $user->pass_crypted = Hash::make($request->password);
        $user->fk_adherent_type = 2;
        $user->login = $request->email;
        $user->ref = $this->generateNumericOTP(30);
        $user->morphy = 'phy';
        $user->statut = 1;
        $user->save();

        Auth::login($user);

        return redirect()->route("account");
    }

    private function generateNumericOTP($n): string
    {
        $generator = "1357902468";
        $result = "";
        for ($i = 1; $i <= $n; $i++) {
            $result .= substr($generator, (rand() % (strlen($generator))), 1);
        }
        return $result;
    }
}

/*'email' => [
    'required',
    Rule::unique('users')->ignore($user->id),
],*/

