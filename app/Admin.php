<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class Admin extends Model
{
    public function index()
    {
        $user_permissions_group = 1;
        $groups = DB::table('groups')
            ->where('permissions_group', $user_permissions_group)
            ->get();
        //return view('user.index', ['users' => $users]);
    }
    public function get_orders()
    {
        $orders = DB::table('orders')
            ->get();
        return $orders;
    }
    public function get_user_data()
    {
        if (Auth::check())
        {
            $user = DB::table('users')
                ->leftJoin('groups', 'users.permissions_group', '=', 'groups.group_name')
                ->leftJoin('permissions', 'groups.permissions_id', '=', 'permissions.id')
                ->where('email', '=', Auth::user()['email'])
                ->get();
            return $user;
        }
    }
}