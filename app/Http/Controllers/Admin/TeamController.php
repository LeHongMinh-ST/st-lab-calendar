<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class TeamController extends Controller
{
    public function index(): View|Application|Factory
    {
        return view('pages.team.index');
    }

    public function create(): View|Application|Factory
    {
        return view('pages.team.create');
    }
}
