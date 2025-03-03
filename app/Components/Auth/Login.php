<?php

namespace App\Components\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public $email, $password;
    public function login()
    {
        $this->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);
        $auth = ['email' => $this->email, 'password' => $this->password];
        if (User::where('email', $auth['email'])->count() == 0) {
            $this->validate([
                'email' => 'unique:users,email',
            ]);
            User::create([
                'uname' => explode('@', $auth['email'])[0],
                'email' => $auth['email'],
                'password' => bcrypt($auth['password']),
            ]);
            Auth::user();
            return $this->redirect(route('app.home'), navigate: true);
        } else {
            if (Auth::attempt($auth)) {
                Auth::user();
                return $this->redirect(route('app.home'), navigate: true);
            } else {
                session()->flash('error', 'This password is not for this email.');
            }
        }
    }
    public function render()
    {
        return view('front.pages.auth.login')->layout('front.master');
    }
}
