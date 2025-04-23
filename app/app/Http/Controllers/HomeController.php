<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function __invoke()
    {
        if(Auth::check()){
            return redirect()->route('publications.index');
        }
        return redirect()->route('welcome');
    }

    public function homev2()
    {
        return Inertia::render('wellcome', [
            'appName' => config('app.name'),
        ]);
    }
}
