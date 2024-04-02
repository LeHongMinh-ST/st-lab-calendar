<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class CalendarController extends Controller
{
    public function index(): View|Application|Factory
    {
        return view('pages.calendar.index');
    }

    public function create(): View|Application|Factory
    {
        return view('pages.calendar.create');
    }

    public function edit($id): View|Application|Factory
    {
        return view('pages.calendar.update')->with([
            'id' => $id,
        ]);
    }

    public function show($id): View|Application|Factory
    {
        return view('pages.calendar.detail')->with([
            'id' => $id,
        ]);
    }
}
