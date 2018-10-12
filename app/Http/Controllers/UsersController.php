<?php

namespace App\Http\Controllers;

use App\ContactType;
use App\Http\Requests\UserUpdateRequest;
use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
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
        $user = auth()->user();

        if ($user->hasRole('admin')) {
            $users = User::paginate(5);
        } else {
            $users = User::take(10)->get();
        }

        return view('users', ['users' => $users]);
    }

    public function show($id)
    {
        $userShow = User::find($id);

        if (is_null($userShow)) {
            redirect()->route('index');
        }

        $userAuth = auth()->user();

        if ($userAuth->can('show', $userShow)) {
            return view('user', ['user' => $userShow, 'userAuth' => $userAuth]);
        }
    }

    public function update($id, UserUpdateRequest $request)
    {
        dd($id, $request->toArray());
    }
}
