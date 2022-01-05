<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Resources\UserResource;
class Profile extends Model
{
    use HasFactory;
    protected $fillable = ['title','description','url','image'];

    public function profileImage()
    {
    	$imagePath = ($this->image) ? $this->image : 'profile/default-non-user-no-photo-1.jpg';

    	return '/storage/' . $imagePath;
    }

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
