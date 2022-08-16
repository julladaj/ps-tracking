<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Peas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Spatie\Permission\Models\Role;

class UsersController extends Controller
{
    //user List
    public function listUser()
    {
        return view('pages.app-users-list');
    }

    //user view
    public function viewUser()
    {
        return view('pages.app-users-view');
    }

    //user edit
    public function editUser()
    {
        return view('pages.app-users-edit');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Request $request): \Illuminate\Contracts\View\View
    {
        $pageSize = (int)$request->query('page_size', 10);
        $search = (string)$request->query('search', '');
        $roleName = (string)$request->query('role', '');
        $pea_id = $request->query('pea_id');
        $direction = $request->query('direction') ?: 'desc';
        $sort = $request->query('sort') ?: 'users.id';

        $users = User::select('id', 'name', 'email', 'pea_id')
            ->with(['profiles', 'pea'])
            ->where('id', '>', 1);

        if ($pea_id) {
            $users->where('pea_id', $pea_id);
        }

        $isAdmin = (optional(auth()->user())->hasRole('super-admin') || optional(auth()->user())->hasRole('admin'));
        if (!$isAdmin) {
            $users->where('pea_id', auth()->user()->pea_id);
        }

        if ($roleName) {
            $users->whereHas('roles', function ($query) use ($roleName) {
                $query->where('roles.name', '=', $roleName); // or whatever constraint you need here
            });
        }

        if ($search) {
            $users
                ->where('users.name', 'like', '%' . $search . '%')
                ->orWhereHas('profiles', function ($query) use ($search) {
                    return $query
                        ->where('pea_no', $search)
                        ->orWhere('telephone', $search);
                });
        }

        return view('users.index', [
            'users' => $users->sortable()->paginate($pageSize),
            'pageSize' => $pageSize,
            'search' => $search,
            'role' => $roleName,
            'roles' => Role::where('id', '>', 1)->get(),
            'peas' => Peas::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.edit', [
            'peas' => Peas::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $data = $request->validated();
        $data['password'] = bcrypt($request->get('new_password'));
        if (User::create($data)) {
            return redirect(route('users.index'))->with(['success' => 'Insert user success!']);
        }

        return redirect(route('users.index'))->with(['error' => 'Insert user fail!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('users.edit', [
            'user' => User::findOrFail($id),
            'peas' => Peas::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * @throws ValidationException
     */
    public function update(UpdateUserRequest $request, $id)
    {
        // Extra validation for update unique.
        $validation = Validator::make($request->all(), [
            'email' => 'unique:users,email,' . $id
        ]);
        if ($validation->fails()) {
            throw new ValidationException($validation);
        }

        if ($user = User::findOrFail($id)) {
            $user->update($request->validated());
            if ($request->get('new_password')) {
                $user->password = bcrypt($request->get('new_password'));
                $user->save();
            }

            return redirect(route('users.index'))->with(['success' => 'Update user success!']);
        }

        return redirect(route('users.index'))->with(['error' => 'Update user fail!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
