<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\Status;
use App\Http\Requests\Auth\AuthLoginRequest;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;

class AuthController extends Controller
{
    public function __construct()
    {
    }

    public function showLoginForm(): View|Application|Factory
    {
        return view('pages.auth.login');
    }

    public function login(AuthLoginRequest $request): RedirectResponse
    {
        $request->merge([$this->username() => request()->input('username')]);
        $credentials = $request->only([$this->username(), 'password']);
        if ( ! auth()->attempt($credentials, (bool) ($request->get('remember')))) {
            return redirect()->back()
                ->withErrors(['message' => ['Vui lòng kiểm tra lại tài khoản hoặc mật khẩu!']])
                ->withInput();
        }

        if (Status::Inactive === auth()->user()->status) {
            auth()->logout();

            return redirect()->back()
                ->withErrors(['message' => ['Tài khoản của bạn đã bị khoá, Vui lòng liên hệ quản trị viên!']])
                ->withInput();
        }

        return redirect()->route('admin.dashboard');
    }

    public function logout(): RedirectResponse
    {
        auth()->logout();

        return redirect()->route('login');
    }

    private function username(): string
    {
        return filter_var(request()->input('username'), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
    }
}
