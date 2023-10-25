<?php

namespace App\Http\Controllers;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\Role\RoleStoreRequest;
use App\Http\Requests\Role\RoleUpdateRequest;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $roles=Role::orderBy('id', 'DESC')->get();
        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $permissions=Permission::where('name', '!=', 'dashboard')->orderBy('id', 'ASC')->get();
        return view('admin.roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleStoreRequest $request) {
        $role=Role::create(['name' => request('name')]);
        if ($role) {
            $permissions=array_merge(['dashboard'], request('permission_id'));
            $role->syncPermissions($permissions);

            return redirect()->route('roles.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Registro exitoso', 'msg' => 'El rol ha sido registrado exitosamente.']);
        } else {
            return redirect()->route('roles.create')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Registro fallido', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.'])->withInputs();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Spatie\Permission\Models\Role $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role) {
        if($role->name=='Super Admin' || $role->name=='Administrador' || $role->name=='Cliente') {
            return redirect()->route('roles.index')->with(['alert' => 'lobibox', 'type' => 'warning', 'title' => 'Edición fallida', 'msg' => 'No puedes editar este rol.']);
        }
        $permissions=Permission::where('name', '!=', 'dashboard')->orderBy('id', 'ASC')->get();
        return view('admin.roles.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Spatie\Permission\Models\Role $role
     * @return \Illuminate\Http\Response
     */
    public function update(RoleUpdateRequest $request, Role $role) {
        $old_name=$role->name;
        $role->fill(['name' => request('name')])->save();
        if ($role) {
            $permissions=array_merge(['dashboard'], request('permission_id'));
            $role->syncPermissions($permissions);

            $users=User::with(['permissions'])->where('user_role', $old_name)->get();
            foreach ($users as $user) {
                $user->fill(['user_role' => request('name')])->save();
                if (request('custom_permissions')=='0') {
                    $permissions=$role['permissions']->pluck('name');
                    $user->syncPermissions($permissions);
                }
            }

            return redirect()->route('roles.edit', ['role' => $role->id])->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'El rol ha sido editado exitosamente.']);
        } else {
            return redirect()->route('roles.edit', ['role' => $role->id])->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Spatie\Permission\Models\Role $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role) {
        if($role->name=='Super Admin' || $role->name=='Administrador' || $role->name=='Cliente') {
            return redirect()->route('roles.index')->with(['alert' => 'lobibox', 'type' => 'warning', 'title' => 'Eliminación fallida', 'msg' => 'No puedes eliminar este rol.']);
        }

        if ($role->users->count()>0) {
            return redirect()->route('roles.index')->with(['alert' => 'lobibox', 'type' => 'warning', 'title' => 'Eliminación fallida', 'msg' => 'Hay usuarios con este rol asignado, no puedes eliminar el rol.']);
        }

        $role->delete();
        if ($role) {
            return redirect()->route('roles.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Eliminación exitosa', 'msg' => 'El rol ha sido eliminado exitosamente.']);
        } else {
            return redirect()->route('roles.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Eliminación fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }
}
