<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompleteRegisterRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\RedirectsUsers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Illuminate\View\View;

class VerificationController extends Controller
{
    use RedirectsUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    public function show(Request $request): RedirectResponse|View
    {
        return $request->user()->hasVerifiedEmail()
            ? redirect($this->redirectPath())
            : view('auth.verify');
    }

    public function complete(Request $request)
    {
        $url = URL::route('verification.verify', ['token' => $request['token']]);

        return view('auth.complete', [
            'url' => $url,
            'name' => $request['name'],
            'email' => $request['email']
        ]);
    }

    public function verify(CompleteRegisterRequest $request)
    {
        $response = $this->broker()->reset(
            $this->credentials($request), function ($user, $password) {
            $this->resetPassword($user, $password);
            if ($user->markEmailAsVerified()) {
                event(new Verified($user));
            }
        });

        return $response == Password::PASSWORD_RESET
            ? $this->sendSuccessResponse($response)
            : $this->sendResetFailedResponse($request, $response);
    }

    public function resend(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect($this->redirectPath());
        }

        $request->user()->sendEmailVerificationNotification();

        return back()->with('resent', true);
    }

    protected function sendSuccessResponse($response)
    {
        return redirect($this->redirectPath())->with('status', trans($response));
    }

    protected function sendResetFailedResponse(Request $request, $response)
    {
        return redirect()->back()
            ->withInput($request->only('email'))
            ->withErrors(['email' => trans($response)]);
    }

    protected function setUserPassword($user, $password)
    {
        $user->password = $password;
    }

    protected function resetPassword($user, $password)
    {
        $this->setUserPassword($user, $password);
        $user->setRememberToken(Str::random(60));
        $user->save();
        $this->guard()->login($user);
    }

    protected function credentials(Request $request)
    {
        return $request->only(
            'email', 'password', 'password_confirmation', 'token'
        );
    }

    public function broker()
    {
        return Password::broker();
    }

    protected function guard()
    {
        return Auth::guard();
    }
}
