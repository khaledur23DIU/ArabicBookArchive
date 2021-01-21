<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Rules\MatchOldPassword;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    	 
    }

    public function userProfile($id)
    {
    	$user = User::where('id',$id)->first();
    	if (!empty($user)) {
    		return view('admin.users.profile',compact('user'));
    	}
    }

    public function updateBasicInfo(Request $request, $id)
    {
     	$this->validate($request,[
     		'name' => 'required|string|min:3|max:255'
     	]);
     	$user = User::where('id',$id)->first();
     	if (!empty($user)) {
     		$user->update([
     			'name' => $request->name
     		]);

     		Toastr::success(__('Record Updated Successfully'));
     		return redirect(route('profile.userProfile',$user->id));
     	}
     	else{
     		Toastr::error(__('Record Not Found'));
     		return redirect(route('dashboard'));
     	}
    }

    public function updateUserPassword(Request $request, $id)
    {
    	$validator = Validator::make($request->all(), [
   			'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
			]);

			if ($validator->fails()) {
			    return redirect(url('dashboard/users/profile/'.$id.'#change-password'))->withErrors($validator)->withInput();
			} 
		else {

			    $user = User::where('id',$id)->first();
     			if (!empty($user)) {

     				$user->update([
     					'password' => Hash::make($request->new_confirm_password)
     				]);

     				Toastr::success(__('Record Updated Successfully'));
     				return redirect(route('profile.userProfile',$user->id));
     			}
     		else{
     				Toastr::error(__('Record Not Found'));
     				return redirect(route('dashboard'));
     			}
			}
    }

    public function updateUserInfo(Request $request, $id)
    {
    	$validator = Validator::make($request->all(), [
            'bio' => 'sometimes|nullable|string',
            'birth_date' => 'sometimes|nullable|date|after:'. date('d/m/Y'),
            'phone' => 'sometimes|nullable|string|max:15',
            'website' => 'sometimes|nullable|url'
			]);

			if ($validator->fails()) {
			    return redirect(url('dashboard/users/profile/'.$id.'#info'))->withErrors($validator)->withInput();
			} 
		else {

			    $user = User::where('id',$id)->first();
     			if (!empty($user)) {

     				$user->profile()->update([
     					'bio' => $request->bio,
     					'birth_date' => Carbon::parse($request->birth_date)->format('Y-m-d'),
     					'phone' => $request->phone,
     					'website' => $request->website
     				]);

     				Toastr::success(__('Record Updated Successfully'));
     				return redirect(route('profile.userProfile',$user->id));
     			}
     		else{
     				Toastr::error(__('Record Not Found'));
     				return redirect(route('dashboard'));
     			}
			}
    }


    public function updateUserSocialLink(Request $request, $id)
    {
    	$validator = Validator::make($request->all(), [
            'facebook' => 'sometimes|nullable|url',
            'google' => 'sometimes|nullable|url',
            'linkedIn' => 'sometimes|nullable|url',
            'instagram' => 'sometimes|nullable|url',
            'quora' => 'sometimes|nullable|url'
			]);

			if ($validator->fails()) {
			    return redirect(url('dashboard/users/profile/'.$id.'#social-link'))->withErrors($validator)->withInput();
			} 
		else {

			    $user = User::where('id',$id)->first();
     			if (!empty($user)) {

     				$user->profile()->update([
     					'facebook' => $request->facebook,
     					'google_plus' => $request->google,
     					'linkedin' => $request->linkedIn,
     					'instagram' => $request->instagram,
     					'quora' => $request->quora,
     				]);

     				Toastr::success(__('Record Updated Successfully'));
     				return redirect(route('profile.userProfile',$user->id));
     			}
     		else{
     				Toastr::error(__('Record Not Found'));
     				return redirect(route('dashboard'));
     			}
			}
    }
}
