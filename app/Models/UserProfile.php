<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    protected $guarded  =   [];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function getImageAttribute($value)
    {
        $image_link = $value != null ?
						(str_contains($value, 'http') ?
							$value : asset('storage/'.$value)
						)
					: asset('frontend/images/user.jpg');
        return  $image_link;
    }
}
