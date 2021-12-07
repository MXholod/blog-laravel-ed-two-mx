<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    //
	public function signupForm(){
		return view('site.auth.signup');
	}
	
	public function signupStore(Request $request){
		//Validation rules
		$this->validate($request, [
			'firstname' => 'required|max:255',
			'lastname' => 'required|max:255',
			'email' => 'required|email|unique:users',
			'password' => 'required|min:5|max:12|confirmed',
		]);
		//Set the role for a user 'admin' - 1, others - 0
		$defineRole = 0;
			$users = DB::table('users')->select(DB::raw('count(*) as user_count'))->get();
		//Table 'mx_users' is empty. Who is first that is 'admin' 
		if($users[0]->user_count == 0){
			$defineRole = 1;
		}else{
			$defineRole = 0;
		}
		//Create new User
		$user = User::create([
			'firstname' => $request->firstname,
			'lastname' => $request->lastname,
			'email' => $request->email,
			//'password' => Hash::make($request->password)
			'password' => bcrypt($request->password),
			'is_admin' => $defineRole
		]);
		//Authenticate a user
		// auth()->user(); //If a user 'signed in' it returns the user Model otherwise null
		/*auth()->attempt([
			'email' => $request->email,
			'password' => $request->password
		]);*/
		//Or this way
		auth()->attempt($request->only('email','password'));
		//Show a message to the registered user
		session()->flash('success', "You've signed up!" );
		//Go to the route 'cabinet' - cabinet page
		//return redirect()->home();
		return redirect()->route('cabinet');
	}
	
	public function signinForm(){
		return view('site.auth.signin');
	}
	
	public function signinStore(Request $request){
		//Validation rules
		$this->validate($request, [
			'email' => 'required|email',
			'password' => 'required',
		]);
		//Authenticate a user
		// auth()->user(); //If a user 'signed in' it returns the user Model otherwise null
		/*auth()->attempt([
			'email' => $request->email,
			'password' => $request->password
		]);*/
		//Remember me: $request->remember - will be 'on' or null
		//Or this way. Check if the user can't 'sign in' attempt() return false
		if(!auth()->attempt($request->only('email','password'), $request->remember)){
			//Go back to the 'sign in' form with the session flash message
			return back()->with('error', 'Invalid sign in details');
		}
		//Show a message to the registered user
		session()->flash('success', "You've signed in!" );
		//Go to the route 'cabinet' - cabinet page
		//return redirect()->home();
		return redirect()->route('cabinet');
	}
	
	public function signinOut(){
		auth()->logout();
		return redirect()->route('home');
	}
}
