<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){
            $users=User::all();
            return view('admin.users.index',compact('users'));
    }
    public function create(){
        return view('admin.users.create');
    }
    public function store(Request $request){
       $validated= $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6'],
            'role_as'=>['required','string']
       ]);
       User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role_as'=>$request->role_as
    ]);
    return redirect('admin/users')->with('message','user added');
    }

    public function delete($id){
        User::find($id)->delete();
        return redirect('admin/users')->with('message','user deleted');
    }
    public function profile(){
        return view('frontend.profile');
    }
    public function saveprofile(Request $request){
        $request->validate([
            'name'=>'required|string|max:200',  
            'phone'=>'required|string|min:10|max:10',
            'pincode'=>'required|string|min:6|max:6',
            'address'=>'required|string|max:500'  ]);
            $user=User::find(Auth::user()->id);
            $user->update(['name'=>$request->name]);
            $user->UserDetail()->UpdateOrCreate(
                [],
               [ 'user_id'=>$user->id,
                'phone'=>$request->phone,
                'pincode'=>$request->pincode,
                'address'=>$request->address ]
            );
            return redirect()->back()->with('message','user profile updated'); 
    }

    public function change_password(){
        return view('frontend.change_password');
    }
    
    public function update_password(Request $request){
        $request->validate(['current_password'=>['required','string','min:6'],
        'password'=>['required','string','min:6','confirmed'] ]);
        $currentpasswordstatus=Hash::check($request->current_password, auth()->user()->password);
        if($currentpasswordstatus){
            User::find(Auth::user()->id)->update([
                'password'=>Hash::make($request->password) ]);
            return redirect()->back()->with('message','password changed'); 
        }
        else{
            return redirect()->back()->with('message','password should not match with old password'); 
        
        }
    }
}
