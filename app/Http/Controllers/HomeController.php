<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

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
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $users = DB::table("users")->join("roles","roles.id_rol","=","users.fk_rol")
                ->paginate(10);

        $roles = DB::table("roles")->get();
        return view('home',[
            "users" => $users,
            "roles" => $roles
        ]);
    }

    public function addUser(Request $request){


        $this->validator($request->all())->validate();

        User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'fk_rol' => $request["user_rol"]
        ]);

        return redirect("/home");
    }

    public function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    public function delete(Request $request){

        User::where("id",$request["id"])->delete();
        return "200";
    }
}
