<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Traits\DataSaver;
use App\Http\Traits\Auth\Authentication;

/**
 * this is the base controller, every controller should extends this.
 *
 * @author Anirban Saha
 */
class BaseController extends Controller
{
    use DataSaver, Authentication;

	/**
	 * current logged in user's details
	 *
	 * @var object users table object
	 */
	public $user;

	/**
	 *  this will assign user role and user in class property
	 *
	 */
	public function __construct(Request $request)
	{
	 	$check = $this->isLoggedIn($request);
	}

    /**
     * this will set logged in user model instance
     */
    public function setUser()
    {
        $this->user =   User::find($this->user_id);
    }
}
