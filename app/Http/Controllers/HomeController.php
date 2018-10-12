<?php

namespace App\Http\Controllers;

use App\ContactType;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
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

        $contacts_types = ContactType::all()->pluck('id');
        dd($contacts_types);
        return view('home');
    }
}
