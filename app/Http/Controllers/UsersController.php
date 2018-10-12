<?php

namespace App\Http\Controllers;

use App\ContactType;
use App\Http\Requests\UserUpdateRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        return view('users', ['users' => $users, 'userAuth' => $user]);
    }

    public function show($id)
    {
        $userShow = User::find($id);

        if (is_null($userShow)) {
            return redirect()->route('users.index');
        }

        $userAuth = auth()->user();

        if (!$userAuth->can('show', $userShow)) {
            return redirect()->back();
        }

        return view('user', ['user' => $userShow, 'userAuth' => $userAuth]);
    }

    public function update($id, UserUpdateRequest $request)
    {
        $userShow = User::find($id);

        if (is_null($userShow)) {
            return redirect()->route('users.index');
        }

        $userAuth = auth()->user();

        if ($userAuth->can('update', $userShow)) {
            $userShow->profile()->update([
                'firstname' => $request->get('firstname', ''),
                'lastname' => $request->get('lastname', ''),
                'age' => $request->get('age', 1),
            ]);

            $contactTypes = ContactType::all()->pluck('code');
            foreach ($contactTypes as $type) {
                $userShow->contacts()->whereHas('type', function ($q) use ($type) {
                    $q->where('code', $type);
                })->update([
                    'info' => $request->get('contact_' . $type, 1),
                ]);
            }
        }

        return redirect()->route('user.show', ['id' => $id]);
    }

    public function delete($id)
    {
        $userShow = User::find($id);

        if (is_null($userShow)) {
            return redirect()->route('users.index');
        }

        $userAuth = auth()->user();

        if ($userAuth->can('delete', $userShow)) {
            DB::beginTransaction();

            try {
                $userShow->profile->delete();
                $userShow->contacts()->delete();
                $userShow->delete();

                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->route('user.show', ['id' => $id]);
            }
        }

        return redirect()->route('users.index');
    }
}
