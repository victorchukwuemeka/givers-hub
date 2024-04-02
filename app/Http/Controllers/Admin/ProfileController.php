<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\UploadedFile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public $user;

    public function __construct(User $user)
    {
        $this->user  = $user;  
    }

    public function profile(Request $request)
    {
        return view('admin.profile');
    }

    public function profileUpdate(Request $request)
    {
        $fillable = $this->user->profile_fillable;
 
        $validated = array_filter($request->only($fillable));
        foreach($request->all() as $req => $value){
            if (empty($request->file($req)) || !$request->file($req) instanceof UploadedFile ) {continue;}
            $validated[$req] = gallery_file_upload($request->file($req),'client');
        }
          if($request->has('password') && !empty($request->get('password'))){
             $request->validate([
                'current-password' => 'required',
                'password' => 'required|string|min:6|confirmed',
            ]);
            if (!Hash::check($request->get('current-password'),user()->password)) {
                return redirect()->back()->with('error', 'password not correct');
            }
               $validated['password'] = Hash::make($validated['password']);
          }else{
               $validated['password'] = user()->password;
          }
        $createed = User::find(user()->id);
        if($validated){
        foreach ($validated as $key => $value) {
            $createed->{$key} = $value;
            }
        }
        $createed->save();
         if($createed){
            return redirect()->back()->with('success','Profile Updated Successfully');
         }
         return redirect()->back()->with('error', 'could not update profile');
    }
}
