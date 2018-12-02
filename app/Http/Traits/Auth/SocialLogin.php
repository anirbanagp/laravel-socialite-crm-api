<?php

namespace App\Http\Traits\Auth;

use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use App\Http\Controllers\ApiController;

/**
 * This will contain all required functions for social login
 *
 * @author  Anirban Saha
 */
trait SocialLogin
{
    /**
     * This will generate google ReCaptcha
     *
     * @return \ReCaptcha\RequestMethod\Post object
     */
    public function getRecaptcha()
    {
        return new \ReCaptcha\RequestMethod\Post();
    }

    /**
     * Redirect the user to the provider authentication page.
     *
     * @param   string  $provider   google|facebook
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider(string $provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from provider.
     *
     * @param   string  $provider   google|facebook
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback(string $provider)
    {
        $user = Socialite::driver($provider)->user();
        if($user) {
            $this->retriveDataFromResponse($user, $provider);
            if($this->authorizeUser()) {
                if(!isset($this->user->id) || (isset($this->user->id) && $this->isApprovedInVT($this->user))) {
                    $this->saveUser();
                    $this->setUserDetailsIntoSession();
                    $this->log('Logged in by ' . $provider);
                    $this->setFlashAlert('success',__('label.Successfully LoggedIn!'));
                    return redirect(route('company.profile'));
                } else{
    				$this->setFlashAlert('danger',__('label.Your account is under verification!Try after some time.'));
    			}
            } else {
                $this->setFlashAlert('danger', __('label.Not Authorised! Please contact with Admin'));
            }
        } else {
            $this->setFlashAlert('danger', __('label.Something went wrong! Try Again'));
        }
        return redirect( route('auth.login'));

    }

    /**
     * this will retrive user details from provier response
     *
     * @param  object $user provider response
     * @return self
     */
    public function retriveDataFromResponse($user, string $provider)
    {
        $userTableData                  =   [];
        $userTableData['first_name']    =   str_before($user->getName(), ' ');
        $userTableData['last_name']     =   str_after($user->getName(), ' ');
        $userTableData['email']         =   $user->getEmail();
        $userTableData['auth_provider'] =   $provider;

        $userProfileTableData           =   [];
        $userProfileTableData['image']  =   $user->getAvatar();

        $this->userTableData            =   $userTableData;
        $this->userProfileTableData     =   $userProfileTableData;

        return $this;
    }

    /**
     * this will authorize a user. is he able to login or not
     *
     * @return boolean true if Authorised else false
     */
    public function authorizeUser()
    {
        $user   =   User::whereEmail($this->userTableData['email'])->first();
        $this->user = $user;
        return $user && $user->status == 'block' ? false : true;
    }
}
