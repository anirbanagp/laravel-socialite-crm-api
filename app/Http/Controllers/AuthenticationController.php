<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Http\Traits\Auth\SocialLogin;
use App\Http\Traits\Auth\ForgotPassword;
use App\Http\Traits\UserDataSaver;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegistrationRequest;
use App\Http\Controllers\BaseController;
use App\Models\User;

/**
 * this is Authentication controller. contain auth related functions
 *
 * @author Anirban Saha
 */
class AuthenticationController extends BaseController
{
    use SocialLogin, ForgotPassword, UserDataSaver;

    /**
     * This will load registration page
     *
     * @return html registration page
     */
    public function getRegistration()
    {
        return view('auth.register');
    }

    /**
     * This will save a user details after registration manually
     *
     * @param  UserRegistrationRequest $request validated request
     * @return void
     */
    public function postRegistration(UserRegistrationRequest $request)
    {
        $userTableData                  =   [];
        $userTableData['first_name']    =   $request->firstname;
        $userTableData['last_name']     =   $request->lastname;
        $userTableData['email']         =   $request->email;
        $userTableData['password']      =   $request->password;
        $userTableData['auth_provider'] =   'email';
        $userTableData['unique_code']   =   str_random(50);
        $userTableData['status']        =   'inactive';

        $userProfileTableData           =   [];
        $userProfileTableData['phone_number']  =   $request->phone_number;

        $this->userTableData            =   $userTableData;
        $this->userProfileTableData     =   $userProfileTableData;

        $this->saveUser();
        $this->setFlashAlert('success', __('label.Successfully Registered! Verify your Email ID'));

        return redirect(route('auth.login'));
    }

    /**
     * This will load login page
     *
     * @return html load login page
     */
    public function getLogin()
    {
        return view('auth.login');
    }

    /**
	 * this will check login credentials and if sucess logged into systen
	 *
	 * @param  UserLoginRequest $request validated credentials
	 * @return void                        redierect to login/home page
	 */
	public function postLogin(UserLoginRequest $request)
	{
		$user_name 	= $request->email;
		$password  	= $request->password;
		$user	  	= User::whereEmail($user_name)->first();
		if(isset($user->id) && Hash::check($password, $user->password)){
			//valid user
			if($user->status == "active"){
                $this->user =   $user;
                if($this->isApprovedInVT($user)) {
                    $this->setUserDetailsIntoSession();
                    $this->log('Logged In',$user->id);
                    $url = Session::get('back_url') !== null ? Session::get('back_url') : route('company.profile');
                    $this->setFlashAlert('success',__('label.Successfully LoggedIn!'));
                    return redirect($url);
                } else{
    				$this->setFlashAlert('danger',__('label.Your account is under verification!Try after some time.'));
    			}
			}else{
				$this->setFlashAlert('danger',__('label.Please active your account first'));
			}
		}else{
			//invalid credential
			$this->setFlashAlert('danger',__('label.Wrong Credentials'));
		}
		return back();
	}

    /**
     * this will active an account by $token
     * @param  string $token unique code of user table
     * @return void        redirect to login page
     */
    public function getVerifyEmail($token)
    {
        $user	  	= User::where('unique_code',$token)->where('status','inactive')->first();

        if(isset($user->id)){
            $user->status = 'active';
            $user->save();
            $this->log('Activate Account',$user->id);
            $this->setFlashAlert('success',__('label.Account activated. Please Login'));
        }else {
            $this->setFlashAlert('danger',__('label.Invalid Link'));
        }
        return redirect(route('auth.login'));
    }

    /**
     * is this user Approved In VT
     *
     * @param  User    $user
     *
     * @return boolean       true if approved otherwise false
     */
    public function isApprovedInVT(User $user)
    {
        $apiHandeller   =   new ApiController();
        $apiResponse =  $apiHandeller->getContactFromVT($user->vtiger_id);
        if($apiResponse->cf_1833 != 1) {
            return false;
        }
        return true;
    }

    /**
	 * this will flush session and logged out
	 * @return void           redirect to login page
	 */
	public function postLogOut(Request $request, $message = null)
	{
		$user_id = Session::get('user_details')['id'];
		$this->log('Logged Out',$user_id);
		$request->session()->flush();
		$this->setFlashAlert('success',__('label.Successfully Logged out'));
		return redirect(route('auth.login'));
	}
}
