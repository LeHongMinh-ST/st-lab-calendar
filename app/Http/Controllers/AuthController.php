<?php

namespace App\Http\Controllers;

use App\Enums\Status;
use App\Http\Requests\Auth\AuthLoginRequest;
use Illuminate\Http\RedirectResponse;

class AuthController extends Controller
{
    public function __construct(
    )
    {
    }

    public function login(AuthLoginRequest $request): RedirectResponse
    {
        $request->merge([$this->username() => request()->input('username')]);
        $credentials = request([$this->username(), 'password']);
        if (!auth()->attempt($credentials)) {
            return redirect()->back()
                ->withErrors(['message' => ['Vui lòng kiểm tra lại tài khoản hoặc mật khẩu!']])
                ->withInput();
        }

        if (auth()->user()->status === Status::Inactive) {
            auth()->logout();
            return redirect()->back()
                ->withErrors(['message' => ['Tài khoản của bạn đã bị khoá, Vui lòng liên hệ quản trị viên!']])
                ->withInput();
        }

        return redirect()->route('admin.dashboard');
    }

    private function username(): string
    {
        return filter_var(request()->input('username'), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
    }

    public function logout(): RedirectResponse
    {
        auth()->logout();
        return redirect()->route('auth.login');
    }
}
