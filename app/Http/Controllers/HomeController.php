<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Permissions;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->permissions = new Permissions();
}
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = $this->permissions->get_user_data();
        $user = $user[0];
        if ($user->permission == "View Sales")
        {
            return redirect('admin');
        }
        return view('home', ['user' => $user]);
    }
}