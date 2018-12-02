<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * this will contain all functionality related to company profile
 *
 * @author Anirban Saja
 */
class CompanyController extends BaseController
{
    /**
     * this will load compnay profile page
     *
     * @return html view page
     */
    public function getProfile()
    {
        return view('company.profile');
    }
}
