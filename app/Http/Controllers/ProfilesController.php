<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Intervention\Image\Facades\Image;
use App\Http\Resources\UserResource;
class ProfilesController extends Controller
{
    //
    public function index(User $user)
    {
    	return response([ 'User' => new UserResource($user), 'message' => 'Retrieved successfully'], 200);
    }
    public function update(User $user)
    {
    	$this->authorize('update',$user->profile);
    	$data = request()->validate([
    		'title'=>'required',
    		'description'=>'required',
    		'url'=>'url',
    		'image'=>'image', 
    	]);
    	if(request('image'))
    	{
    	$imagePath = request('image')->store('profile','public');
  		/*$image = Image::make(public_path("storage/{$imagePath}"))->fit(1000,1000);
  		$image->save();*/
    	$imageArray = ['image' => $imagePath];
        }

    	 
    	auth()->user()->profile->update(array_merge(
    		$data,
    		$imageArray ?? []
        ));

    	return redirect("/profile/{$user->id}");
    }
}
