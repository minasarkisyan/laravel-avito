<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\Auth\RegisterRequest;
use App\UseCases\Auth\RegisterService;
use App\Mail\Auth\VerifyMail;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;




class RegisterController extends Controller
{
    private $service;

    public function __construct(RegisterService $service)
    {
        $this->middleware('guest');

        $this->service = $service;
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }


    public function register(RegisterRequest $request)
    {

        $this->service->register($request);

        return redirect()->route('login')
            ->with('success', 'Check your email and click on the link to verify.');
    }


    public function verify($token)
    {
        if (!$user = User::where('verify_token', $token)->first()) {
            return redirect()->route('login')
                ->with('error', 'Sorry your link cannot be identified.');
        }

        try {
            $this->service->verify($user->id);
            return redirect()->route('login')->with('success', 'Your e-mail is verified. You can now login.');
        } catch (\DomainException $e) {
            return redirect()->route('login')->with('error', $e->getMessage());
        }

    }
}
