<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Services\LogService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
//use Spatie\Permission\Models\Role;

class AdminRoleController extends Controller
{
    const SUPER_ADMIN_ROLE_ID = 1;
    const SUPER_ADMIN_ROLE_NAME = 'Super Admin';
    /**
     * Display a listing of the resource.
     *
     */
    public function __construct()
    {
        $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index', 'edit']]);
        $this->middleware('permission:role-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:role-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Role::orderBy('id', 'DESC');
        $search = $request->search;
        if (!empty($search)) {
            $query->where('name', 'like', '%' . $search . '%');
        }
        $roles = $query->paginate(config('constants.PAGINATION.BACKEND'));
        $title = 'Role Management';
        return view('admin.roles.index', compact('roles', 'title', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        $permission = Permission::get();
        return view('admin.roles.create', compact('permission'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'       => 'required|unique:roles,name',
            'permission' => 'required',
        ]);

        $role = Role::create(['name' => $request->input('name')]);
        $role->syncPermissions($request->input('permission'));

        return redirect()->route('admin.roles.index')
            ->with('success', 'Role created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show(Role $role, Request $request)
    {
        /*dd($role->getAllPermissions());
        $rolePermissions = Permission::query()
            ->join("role_has_permissions", "role_has_permissions.permission_id", "=","permissions.id")
            ->where("role_has_permissions.role_id", $role->id)
            ->get();*/
        $rolePermissions = $role->getAllPermissions();

        return view('admin.roles.show', compact('role', 'rolePermissions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(Role $role, Request $request)
    {
        $permission = Permission::get();
        /*$rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id", $role->id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();*/
        $rolePermissions = $role->getAllPermissions()->pluck('id', 'id')->toArray();

        return view('admin.roles.edit', compact('role', 'permission', 'rolePermissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, Role $role)
    {
        $this->validate($request, [
            'name'       => 'required',
            'permission' => 'required',
        ]);
        $name = $request->input('name');
        $permission = $request->input('permission');
        $role->name = $name;
        $role->save();

        $role->syncPermissions($permission);
        LogService::logActivity(\Auth::user(), 'set list permission '. json_encode($permission). ' to role '. $name, $role);
        return redirect()->route('admin.roles.index')
            ->with('success', 'Role updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Role $role)
    {
        if ($role->id === self::SUPER_ADMIN_ROLE_ID || $role->name === self::SUPER_ADMIN_ROLE_NAME) {
            return redirect()->route('admin.roles.index')
                ->with('failed', 'Cannot delete SUPER ADMIN Role!');
        }
        $role->delete();
        return redirect()->route('admin.roles.index')
            ->with('success', 'Role deleted successfully');
    }
}
