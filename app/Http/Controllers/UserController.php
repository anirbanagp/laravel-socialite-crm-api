<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Http\Requests\UserEditProfile;
use App\Http\Traits\UserDataSaver;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

/**
 * this will contain all functionality related to user account
 *
 * @author Anirban Saha
 */
class UserController extends BaseController
{
    use UserDataSaver;

    /**
     * set logged in user details into class variable
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->setUser();
    }

    /**
     * this will load edit profile page of current user
     *
     * @return html load view page
     */
    public function getEditProfile()
    {
        $data           =   [];
        $data['user']   = $this->user;
        return view( 'user.edit-profile', $data);
    }

    /**
     * this will update user profile details
     *
     * @param  UserEditProfile $request validated request
     * @return void                  redirect to profile page
     */
    public function postUpdateProfile(UserEditProfile $request)
    {
        $userTableData                  =   [];

        if($request->password && !empty($this->user->password) && Hash::check($request->old_password, $this->user->password) === false) {
            throwValidationError('old_password', __('label.Old Password not matched'));
        }

        $userTableData['first_name']    =   $request->firstname;
        $userTableData['last_name']     =   $request->lastname;
        $userTableData['email']         =   $this->user->email;

        if($request->password) {
            $userTableData['password']  =   $request->password;
        }

        $userProfileTableData                   =   [];
        $userProfileTableData['phone_number']   =   $request->phone_number;
        $userProfileTableData['address']        =   $request->address;
        $userProfileTableData['gender']         =   $request->gender;
        if($request->hasFile('image')) {

            $userProfileTableData['image']      =   $request->file('image')->store('user-profile');
        }

        $this->userTableData            =   $userTableData;
        $this->userProfileTableData     =   $userProfileTableData;

        $this->saveUser()->setUserDetailsIntoSession();
        $this->setFlashAlert('success', __('label.Successfully Updated'));

        return back();
    }
}
