<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\MessageBag;
use Illuminate\Validation\Rule;

class LoginController extends Controller {

    public function form() {
        return view('login.form');
    }

    public function login(Request $request) {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return redirect()->intended(route('bibliotheque.principale'));
        } else {
            return back()->withErrors(new MessageBag([
                'password' => ['Email and/or password invalid.']
            ]));
        }
    }

    public function logout() {
        Auth::logout();
        return redirect()->intended('/');
    }

    public function register() {
        return view('login.register', [
            'user' => new User()
        ]);
    }

    public function submitRegister(Request $request) {
        return $this->submit($request, true, new User());
    }

    public function profile() {
        return view('login.profile', [
            'user' => Auth::user()
        ]);
    }

    public function submitProfile(Request $request) {
        return $this->submit($request, false, Auth::user());
    }

    public function password() {
        return view('login.password', [
            'user' => Auth::user()
        ]);
    }

    public function submitPassword(Request $request) {
        $validators = [
            'current_password' => 'required',
            'password' => 'required|confirmed',
        ];
        $this->validate($request, $validators);


        if (!password_verify ($request->input('current_password'), Auth::user()->password)) {
            return back()->withErrors(new MessageBag([
                'current_password' => ['Mot de passe invalide.']
            ]));
        }

        Auth::user()->password = bcrypt($request->input('password'));
        Auth::user()->save();

        return redirect(route('profile'))->with('message', 'Votre mot de passe a été modifié');
    }

    protected function submit(Request $request, bool $withPassword, User $user) {
        $validators = [
            'name' => 'required|max:255',
            'email' => [
                'required',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ]
        ];
        if ($withPassword) {
            $validators['password'] = 'required|confirmed';
        }
        $this->validate($request, $validators);

        $userData = $request->only(array_keys($validators));
        if ($withPassword) {
            $userData['password'] = bcrypt($userData['password']);
        }
        $user->fill($userData)->save();

        if ($withPassword) {
            $credentials = $request->only('email', 'password');
            Auth::attempt($credentials);
        }

        return redirect(route('bibliotheque.principale'));
    }
}
