<?php
namespace App\Http\administrator;

use Keyhunter\Administrator\Controller;
use Illuminate\Contracts\Auth\Guard AS AuthGuard;
use Illuminate\Foundation\Application;


/**
 * Class DashboardStatisticController
 * @package App\Http\administrator
 */
class DashboardStatisticController extends Controller
{

    /**
     * DashboardStatisticController constructor.
     * @param Application $application
     * @param AuthGuard $user
     */
    public function __construct(Application $application, AuthGuard $user){
        parent::__construct($application, $user);

        /**
         * Personal Repository
         */
    }
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function dashboard()
    {
        return view('administrator::dashboard');
    }
}

