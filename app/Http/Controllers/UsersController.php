<?php

namespace App\Http\Controllers;

use App\ContactType;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
            $users = User::orderBy('id', 'desct')->paginate(5);
        } else {
            $users = User::orderBy('id', 'desct')->take(10)->get();
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

            DB::beginTransaction();

            try {
                $firstname = (string)$request->get('firstname', '');
                $lastname = (string)$request->get('lastname', '');
                $age =  (int)$request->get('age', 0);

                if (is_null($userShow->profile)) {
                    $userShow->profile()->create([
                        'firstname' => $firstname,
                        'lastname' => $lastname,
                        'age' => $age,
                    ]);
                } else {
                    $userShow->profile()->update([
                        'firstname' => $firstname,
                        'lastname' => $lastname,
                        'age' => $age,
                    ]);
                }

                $contactTypes = ContactType::all()->pluck('code');
                foreach ($contactTypes as $type) {
                    $contact = $userShow->contacts()->whereHas('type', function ($q) use ($type) {
                        $q->where('code', $type);
                    })->first();

                    if (is_null($contact)) {
                        $userShow->contacts()->create([
                            'contact_type_id' => ContactType::findByCode($type)->id,
                            'info' => (string)$request->get('contact_' . $type, ''),
                        ]);
                    } else {
                        $contact->update([
                            'info' => (string)$request->get('contact_' . $type, ''),
                        ]);
                    }
                }

                if ($request->get('admin', false)) {
                    $userShow->assignRole('admin');
                } else {
                    $userShow->removeRole('admin');
                }

                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                dd($e);
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

    public function create(UserCreateRequest $request)
    {
        $userAuth = auth()->user();

        if ($userAuth->can('create', $userAuth)) {
            DB::beginTransaction();

            try {
                $user = User::create([
                    'email' => (string)$request->get('email', ''),
                    'token' => Str::random(10),
                    'password' => Hash::make('secret'),
                    'name' => (string)$request->get('firstname', '') . ' ' . (string)$request->get('lastname', ''),
                ]);

                $user->profile()->create([
                   'firstname' => (string)$request->get('firstname', ''),
                   'lastname' => (string)$request->get('lastname', ''),
                   'age' => (int)$request->get('age', 0),
                ]);

                $contactTypes = ContactType::all()->pluck('code');
                foreach ($contactTypes as $type) {
                    $user->contacts()->create([
                        'contact_type_id' => ContactType::findByCode($type)->id,
                        'info' => (string)$request->get('contact_' . $type, ''),
                    ]);
                }

                if ($request->get('admin', false)) {
                    $user->assignRole('admin');
                } else {
                    $user->removeRole('admin');
                }

                DB::commit();

                return redirect()->route('user.show', ['id' => $user->id]);
            } catch (\Exception $e) {
                DB::rollBack();
            }
        }

        return redirect()->route('user.create.form');
    }

    public function createForm()
    {
        return view('user_create');
    }
}
