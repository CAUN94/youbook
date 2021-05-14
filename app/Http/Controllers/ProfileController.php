<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index() {
    	return view('profile.index');
    }

    public function store(Request $request) {
    	$this->validate($request,[
    		'name'=>'required',
    		'gender'=>'required'
    	]);
    	User::where('id',auth()->user()->id)
    		->update($request->except('_token'));
    	return redirect()->back()->with('message','Perfil Actualizado');
    }

    public function profilePic(Request $request)
    {
    	$this->validate($request,['file'=>'required|image|mimes:jpeg,jpg,png']);
    	if($request->hasFile('file')){
    		$user = User::where('id',auth()->user()->id);
    		$image = $request->file('file');
    		$name = time().'.'.$image->getClientOriginalExtension();

    		if($user->role_id != 3){
    			$destination = public_path('/img/professionals/');
    		}
    		else {
    			$destination = public_path('/profile');
    		}
    		$image->move($destination,$name);

    		$user->update(['image'=>$name]);

    		return redirect()->back()->with('message','profile updated');


    	}
    }


}
