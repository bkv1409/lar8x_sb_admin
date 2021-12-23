<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserProfile;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;

class AdminUserController extends Controller
{
    const SUPER_ADMIN_USER_ID = 1;
    private $userRepository;

    /**
     * AdminUserController constructor.
     * @param  \App\Repositories\UserRepository  $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
        $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index', 'edit']]);
        $this->middleware('permission:user-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit', 'update', 'editPassword', 'updatePassword']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $query = User::orderBy('id', 'DESC');
        $search = $request->search;
        if (!empty($search)) {
            $query->where('name', 'like', '%' . $search . '%');
            $query->orWhere('email', 'like', '%' . $search . '%');
        }
        $data = $query->paginate(config('constants.PAGINATION.BACKEND'));
        return view('users.index', compact('data', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $roles = Role::pluck('name', 'name')->all();
        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $validateArr = array_merge(User::$COMMON_VALIDATE_ARRAY, User::$PASSWORD_VALIDATE_ARRAY, [
            'email'    => 'required|email|unique:users,email',
        ]);

        $this->validate($request, $validateArr);

        $this->userRepository->store($request);

        return redirect()->route('users.index')
            ->with('success', 'User created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(User $user, Request $request)
    {
//        $user = User::find($id);
        $userProfile = $user->userProfile;
        return view('users.show', compact('user', 'userProfile'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(User $user, Request $request)
    {
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();
        $userProfile = $user->userProfile;

        return view('users.edit', compact('user', 'roles', 'userRole', 'userProfile'));
    }

    /**
     * @param  \App\Models\User  $user
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function editPassword(User $user, Request $request)
    {
        return view('users.edit-password', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, User $user)
    {
        /*$this->validate($request, [
            'name'     => 'required',
            'email'    => 'required|email|unique:users,email,'.$user->id,
            'password' => 'same:confirm-password',
            'roles'    => 'required',
            'img_link' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'job' => 'nullable|max:100',
            'bio' => 'nullable|max:255',
            'skills' => 'nullable|max:255',
            'experience' => 'nullable|max:255',
        ]);*/

        $validateArr = array_merge(User::$COMMON_VALIDATE_ARRAY, [
            'email'    => 'required|email|unique:users,email,' . $user->id,
        ]);
        $this->validate($request, $validateArr);

        $this->userRepository->update($user, $request);

        return redirect()->route('users.index')
            ->with('success', 'User updated successfully');
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updatePassword(Request $request, User $user)
    {
        $this->validate($request, User::$PASSWORD_VALIDATE_ARRAY);

        $this->userRepository->update($user, $request, false);

        return redirect()->route('users.index')
            ->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(User $user)
    {
        if ($user->id === self::SUPER_ADMIN_USER_ID) {
            return redirect()->route('users.index')
                ->with('failed', 'Cannot disable SUPER ADMIN USER ROOT!');
        }
        $user->status = !$user->status ? 1 : 0;
        $user->save();
        return redirect()->route('users.index')
            ->with('success', 'User change status successfully');
    }


}
