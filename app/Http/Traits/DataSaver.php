<?php

namespace App\Http\Traits;

use Session;
use App\Models\User;
use App\Models\UsersActivityLog;

/**
 * This contain several function that help to store data into session or database
 *
 *  @author Anirban Saha
 */
trait DataSaver
{
	/**
	 * This will log users activity into table
	 *
	 * @param  string $event   what he did
	 * @param  integer $user_id nullable for logged in user
	 */
	public function log(string $event,$user_id = null)
	{
		$data['user_id'] = $user_id == null ? $this->user->id : $user_id;
		$data['event']	 = $event;
		UsersActivityLog::create($data);
	}

	/**
	 * Set user details into session
	 *
	 * @param int $user_id user_id
	 */
	public function setUserDetailsIntoSession($user_id = null)
	{
		$user_id = $user_id !== null ? $user_id : $this->user->id;
		$user = User::find($user_id);
		$image_link = optional($user->userProfile)->image;
		$user_details = [
			'id' 			=> $user->id,
			'name' 			=> $user->name,
			'email' 		=> $user->email,
			'profile_image' => $image_link,
		];
		Session::put('user_details',$user_details);
	}
	
	/**
	 * set alert message into session
	 *
	 * @param string $class   danger/success
	 * @param string $message translated alert message
	 */
	public function setFlashAlert($class,$message)
	{
		Session::flash('alert_class', $class);
		Session::flash('alert_msg',$message);
	}
}
