<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index() {
        $roles = Role::query()->orderBy("name")->where('name','!=','super-user')->get();
        $users = User::all();
        return view('roles.index',[
            'roles'=>$roles,
            'users'=>$users
        ]);
    }

    public function edit($id) {
        $user = User::query()->findOrFail($id);
        $role = $user->getRoleNames()[0];
        $newRole = Role::query()->where('name', '!=', $role)->first();
        DB::table('model_has_roles')->where('model_id', $id)->update(['role_id'=>$newRole->id]);
        return redirect()->back()->with('status','Данные пользователя изменены!');
    }
}
