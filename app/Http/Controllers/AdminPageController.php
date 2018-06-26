<?php

namespace App\Http\Controllers;

use App\Service;
use Illuminate\Http\Request;

class AdminPageController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'title' => 'Закажите услугу',
        ];

        return view('home', $data);
    }
}
