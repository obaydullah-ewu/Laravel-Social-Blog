<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index']]);
    }
    
    public function edit() {
        if(Auth::user()){
            $user = User::find(Auth::user()->id);

            if($user){
                return view('user.edit')->withUser($user);
            } else {
                return redirect()->back();
            }
        } else {
            return redirect()->back();
        }
    }

    public function update(Request $request) {
        $user = User::find(Auth::user()->id);

        if($user){
            $validate = null;
            if(Auth::user()->email === $request->get('email')){
                $validate = $request->validate([
                    'name' => 'required|min:2',
                    'email' => 'required|email',
                    'city' => 'nullable',
                    'cover_image' => 'image|nullable|max:1999'
    
                ]);
            } else {
                $validate = $request->validate([
                    'name' => 'required|min:2',
                    'email' => 'required|email|unique:users',
                    'city' => 'nullable',
                    'cover_image' => 'image|nullable|max:1999'
                ]);
            }
            if($validate) {
                $user->name = $request->get('name');
                $user->email = $request->get('email');
                $user->city = $request->get('city');
                $user->country = $request->get('country');
                
                if($request->hasFile('cover_image')){                    
                    $filenameWithExt = $request->file('cover_image')->getClientOriginalName();                    
                    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);                   
                    $extension = $request->file('cover_image')->getClientOriginalExtension();
                    $fileNameToStore = $filename.'_'.time().'_'.$extension;
                    $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
                }
                if($request->hasFile('cover_image')){
                    $user->cover_image = $fileNameToStore;  
                }
                $user->save();
                return redirect()->back()->with('success', 'Your profile has been updated');
            }else{
                return redirect()-back();
            }
            
        } else {
            return redirect()->back();
        }
    }

    
    public function passwordEdit(){
        if(Auth::user()){
            return view('user.password');
        } else {
            return redirect()->back();
        }
    }


    public function passwordUpdate(Request $request){
        $validate = $request->validate([
            'oldPassword' => 'required|min:7',
            'password' => 'required|min:7|required_with:password_confirmation'
        ]);
        $user = User::find(Auth::user()->id);

        if($user) {
            if(Hash::check($request->get('oldPassword'), $user->password) && $validate){
                $user->password = Hash::make($request->get('password'));
                $user->save();
                return redirect()->back()->with('success', 'Your password has been updated');
            } else {
                return redirect()->back()->with('error', 'Your entered does not match your current password');
            }
        }
    }

    public function searchpeople(Request $request){
        $searchpeople = $request->input('searchpeople');

        $users = User::query()->where('name', 'LIKE', "%{$searchpeople}%")->get();

        return view('user.searchpeople', compact('users'));

    }
    
}
