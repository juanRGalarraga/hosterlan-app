<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Owner;
use App\Models\Guest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use App\Enums\User\Type as UserType;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class RegisteredUserController extends Controller
{
    public function create(Request $request): View
    {
        $type = $request->type;

        if ($type == 'owner') {
            return view('auth.register-owner');
        }

        return view('auth.register-guest');
    }

    public function registerByTypeUser(): View
    {
        return view('auth.register-by-type');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'type' => [Rule::enum(UserType::class)],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'password_confirmation' => ['required', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'email' => $request->email,
            'name' => $request->name,
            'password' => Hash::make($request->password)
        ]);

        // Crear el tipo de usuario
        $userType = $request->type === 'owner' ? new Owner() : new Guest();
        $userType->create([
            'user_id' => $user->id
        ]);

        // Lanzar el evento de registro después de guardar el usuario
        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
