<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Image;




class UserController extends Controller
{
    // ============================= fetch all users list ============================ //
    public function index()
    {
        $users_list = User::where('id','<>',auth()->id())->paginate(10);
        return view('users.index',compact('users_list'));
    }

    // ====================== force logout any user's session ===================== //
    public function forceLogout($id){

        if (Cache::has('user-is-online-' . $id) && Gate::allows('force-logout')) {

                Session::getHandler()->destroy(Cache::get('user-is-online-' . $id));
                Cache::forget('user-is-online-' . $id);
                return back()->with('success','User loggedOut successfully!');

        }
        return back()->with('error','User not loggedIn!');
    }

     // ====================== edit user profile ========================= //
     public function editPic(){

        $user = User::find(auth()->id());
        return view('users.edit',compact('user'));
    }

    // ====================== update user avatar ========================= //
    public function UpdateAvatar(Request $request){

        $user = auth()->user();
        if($request->hasFile('avatar') && $request->only('avatar')){

            $this->removeImage($user->avatar);
            $rules = array(
                'avatar' => 'mimes:jpeg,jpg,png,gif|required|max:50000',
                'width' => 'required|numeric|max:1500',
                'height' => 'required|numeric|max:1500',
              );
              $validator = Validator::make($request->all(), $rules);

              if ($validator->fails()){
                    return back()->withErrors($validator)->withInput();
              } else{

                    $user->avatar = $request->avatar->store('avatar','public');
                    $user->save();

                    $image = Image::make(public_path('storage/'. $user->avatar))->fit($request->width,$request->height);
                    $image->save();
                    return back()->with('success', 'Avatar has been uploaded successfully');
              };
        }

    }

// ====================== destroy existing user avatar ========================= //
    public function removeImage($user_profile_pic)
    {

        if(Storage::disk('public')->exists($user_profile_pic)){
           return Storage::disk('public')->delete($user_profile_pic);
        }else{
           return true;
        }
    }

}
