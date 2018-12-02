<?php

namespace App\Http\Traits;

use App\Models\User;
use App\Http\Controllers\ApiController;
use Laravel\Socialite\Facades\Socialite;

/**
 * This will contain all required functions for saving user data
 *
 * @author  Anirban Saha
 */
trait UserDataSaver
{
    /**
     * this will contain data to be inserted in user table
     * @var array
     */
    public $userTableData          =   [];

    /**
    * this will contain data to be inserted in user_profile table
    * @var array
     */
    public $userProfileTableData   =   [];

    /**
     * This will save a user details into database
     *
     * @return  self
     */
    public function saveUser()
    {
        $user   =   User::updateOrCreate(['email' => $this->userTableData['email'] ],$this->userTableData);
        $user->userProfile()->updateOrCreate(['user_id' => $user->id ],$this->userProfileTableData);
        $this->user     =   $user;
        $this->updateOrCreateOnVTigerDb();
        $this->log('user details updated');
        return $this;
    }

    /**
     * update Or Create On VTiger Db
     *
     * @return void|ValidationException
     */
    public function updateOrCreateOnVTigerDb()
    {
        $apiHandeller   =   new ApiController();
        $vtigerPostData =   [
            'firstname' => $this->user->first_name,
            'lastname'  => $this->user->last_name,
            'mobile'    => $this->user->userProfile->phone_number,
            'email'     => $this->user->email,
         ];
        if(empty($this->user->vtiger_id)) {
            $apiResponse =  $apiHandeller->createContactOnVT($vtigerPostData);
        } else {
            $apiResponse =  $apiHandeller->updateContactOnVT($vtigerPostData, $this->user->vtiger_id);
        }
        if($apiResponse) {
            $this->user->vtiger_id = $apiResponse->id;
            $this->user->save();
        } else {
            //to aware user throw this error. ignore field name.
            throwValidationError('email', "Oops! Something went wrong.");
        }
    }
}
