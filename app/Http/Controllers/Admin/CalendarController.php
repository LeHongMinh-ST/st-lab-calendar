<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \Illuminate\Contracts\View\View;
use \Illuminate\Foundation\Application;
use \Illuminate\Contracts\View\Factory;

class CalendarController extends Controller
{
    public function index(): View|Application|Factory
    {
        return view('admin.calendar.index');
    }


    public function create(): View|Application|Factory
    {
        return view('pages.calendar.create');
    }
}
