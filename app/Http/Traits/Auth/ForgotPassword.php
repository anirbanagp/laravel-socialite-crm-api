<?php

namespace App\Http\Traits\Auth;
use App\Models\User;
use App\Mail\ForgetPasswordMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Http\Requests\ResetPasswordRequest;

/**
 * This will contain all functionality related to forgot password
 *
 * @author Anirban Saha
 */
trait ForgotPassword
{
    /**
	 * this will send a forgot password link to user to reset passowrd
	 * 
	 * @param  Request $request request object
	 * @return bool           true for success and false invalid email
	 */
	public function sendForgotPasswordLink(Request $request)
	{
		$email = $request->email;
		$user = User::where('email',$email)->where('status', '!=', 'block')->first();
		if(isset($user->id)){
			$unique_code = str_random(50);
			$user = User::find($user->id);
			$user->unique_code 	= $unique_code;
			$user->save();
			Mail::to($email)->queue(new ForgetPasswordMail($user));
			$this->log('reset password link sent',$user->id);
			echo 1;
		}else{
			echo 0;
		}
	}

    /**
     *  this will load reset password page
     *
     *  @param   string  $token  token sent to mail
     *  @return	 void|string load page if valid else redirect to login page
     */
    public function getResetPassword($token)
    {
        $user = User::where('unique_code',$token)->where('status', '!=', 'block')->first();
        if(isset($user->id)){
            return view('auth.reset-password');
        }else{
            $this->setFlashAlert('danger',__('registration.Invalid Link'));
            return redirect(route('auth.login'));
        }
    }
    /**
	 *  this will reset password for not logged in user
	 *
	 *  @param   ResetPasswordRequest  $request  validated request
	 *  @return  void 									  redirect to login page
	 */
	public function postResetPassword(ResetPasswordRequest $request)
	{
		$url = url()->previous();
		$token = str_after($url, 'reset-password/');
		$user = User::where('unique_code',$token)->where('status', '!=', 'block')->first();
		if(isset($user->id)){
			$user->password	=	$request->password;
			$user->status	=	'active';
			$user->save();
			$this->log('password changed',$user->id);
			$this->setFlashAlert('success',__('label.Password Updated'));
		}else{
			$this->setFlashAlert('danger',__('label.Invalid Link'));
		}
		return redirect(route('auth.login'));
	}
}
