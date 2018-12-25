<?php

namespace App\Http\Controllers\Web\Auth;

use App\Events\User\RequestedPasswordResetEmail;
use App\Events\User\ResetedPasswordViaEmail;
use App\Http\Requests\Auth\PasswordRemindRequest;
use App\Http\Requests\Auth\PasswordResetRequest;
use App\Notifications\ResetPassword;
use App\Repositories\User\UserRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PasswordController extends Controller
{
    /**
     * Create a new password controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Display the form to request a password reset link.
     *
     * @return \Illuminate\Http\Response
     */
    public function forgotPassword()
    {
        return view('auth.password.remind');
    }

    /**
     * Send a reset link to the given user.
     *
     * @param PasswordRemindRequest $request
     * @param UserRepository $users
     * @return \Illuminate\Http\Response
     */
    public function sendPasswordReminder(PasswordRemindRequest $request, UserRepository $users)
    {
        $user = $users->findByEmail($request->email);

        $token = Password::getRepository()->create($user);

        $user->notify(new ResetPassword($token));

        event(new RequestedPasswordResetEmail($user));

        return redirect()->route('password.remind')
            ->with('success', 'Password reset email sent. Check your inbox (and spam) folder.');
    }

    /**
     * Display the password reset view for the given token.
     *
     * @param  string $token
     * @return \Illuminate\Contracts\View\View
     * @throws NotFoundHttpException
     */
    public function getReset($token = null)
    {
        if (is_null($token)) {
            throw new NotFoundHttpException;
        }

        return view('auth.password.reset')->with('token', $token);
    }

    /**
     * Reset the given user's password.
     *
     * @param PasswordResetRequest $request
     * @return \Illuminate\Http\Response|RedirectResponse
     */
    public function postReset(PasswordResetRequest $request)
    {
        $credentials = $request->only('username', 'password', 'password_confirmation', 'token');

        $response = Password::reset($credentials, function ($user, $password) {
            $this->resetPassword($user, $password);
        });

        switch ($response) {
            case Password::PASSWORD_RESET:
                return redirect('login')->with('success', 'Your password has been reset!');

            default:
                return redirect()->back()
                    ->withInput($request->only('email'))
                    ->withErrors(['email' => "We can't find a user with that e-mail address."]);
        }
    }

    /**
     * Reset the given user's password.
     *
     * @param  \Illuminate\Contracts\Auth\CanResetPassword  $user
     * @param  string  $password
     * @return void
     */
    protected function resetPassword($user, $password)
    {
        $user->password = $password;
        $user->save();

        event(new ResetedPasswordViaEmail($user));
    }
}
