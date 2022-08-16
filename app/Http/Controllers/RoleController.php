<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;
use App\Models\Role_User;
use Illuminate\Support\Facades\DB;
class RoleController extends Controller
{

    public function index()
    {
          $roles = Role::query()->get();
          $user = User::with('roles')->get();

          // $users = $user->users;
        $all_users = User::query()->get();
        return view('role.index',compact('user','all_users','roles'))->with('role_name',$roles);
    }
    public function store(Request $request)
    {
        Role::query()->create(['role_name',$request->role_name]);
    }
    public function edit(Request $request,$id)
    {
        $user = User::with('roles')->findOrFail( $id );
        $roles = Role::all();


       // $selected_vals = User::with('roles')->get();
             $new = DB::table('role_user')->where('user_id',$id)->pluck('role_id');
             $count = DB::table('role_user')->where('user_id',$id)->count();
              $roles->selected_roles = Role::query()->whereIn('id',$new)->get();
         // dd($roles->selected_roles);
             $selected_roles = Role::query()->whereIn('id',$new)->get();
           //  dd($selected_roles);
            // dd( $user);
           return view('role.edit', compact( 'user', 'roles','selected_roles','new','count' ));
    }
    
    public function update(Request $request)
    {
         //dd($request->all());
        $roles = $request->get('roles');
        $user_id = $request->input('user_id');
        $name  = $request->input('name');
        $user = User::findOrFail($user_id);

        $user->name = $name;
        $user->update();
        $user->roles()->sync($roles);
       // dd($roles);
         return redirect()->back()->with( 'info', 'success' );
    }

    public function assign_role(Request $request)
    {
     //   dd($request->all());
       $user =new User();
       $user->name = 'newUser';
       $user->save();
       $user->roles()->attach($request->input('role_name'));
      
       
    }

    public function delete(Request $request, $id)
    {
         $user = User::find($id);

         //dd($user);
         $role = User::with('roles')->findOrFail($id);
         // dd($role);
         $user->roles()->detach($role->roles);
        //$product->categories()->detach($category);
        
        return 'Success';
    }
}
