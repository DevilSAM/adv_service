<?php

declare(strict_types=1);

namespace Modules\Auth\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class AuthController extends Controller
{
    public function login(Request $request): \Illuminate\Http\Response | array
    {
        $credentials = $request->validate(
            [
                'email'    => ['required', 'email'],
                'password' => ['required'],
            ]
        );

        if (Auth::attempt($credentials, (bool) $request->input('remember'))) {
            $request->session()->regenerate();
            return ['id' => Auth::user()->id];
        } else {
            return Response::make(['message' => __('auth.failed')], 401);
        }
    }

    public function getCurrentAuth(): array
    {
        $user = Auth::user();
        if ($user) {
            return ['id' => $user->id, 'name' => $user->name, 'email' => $user->email];
        }
        return ['id' => null];
    }

    public function logout(Request $request): \Illuminate\Http\Response | array
    {
        $user = Auth::user();
        Auth::logout();
        return $user->toArray();
    }

    public function registration(Request $request): \Illuminate\Http\Response | array
    {
        $credentials = $request->validate(
            [
                'name'     => ['required'],
                'email'    => ['required', 'email'],
                'password' => ['required', 'min:3'],
            ]
        );

        User::create($credentials);

        if (Auth::attempt($credentials, (bool) $request->input('remember'))) {
            $request->session()->regenerate();
            return ['id' => Auth::user()->id];
        } else {
            return Response::make(['message' => __('auth.failed')], 401);
        }

    }
}
