<?php

namespace App\Http\Middleware;

use App\Lot;
use App\Repositories\AplicationRepository;
use Closure;
use Carbon\Carbon;


class CreateAplication
{
    /**
     * @var AplicationRepository
     */
    protected $appRepository;

    /**
     * CreateAplicationMiddleware constructor.
     * @param AplicationRepository $aplicationRepository
     */
    public function __construct(AplicationRepository $aplicationRepository)
    {
        $this->appRepository = $aplicationRepository;
    }

    public function handle($request, Closure $next, $guard = null)
    {
        
        /*if($request->route('standart'))
        {*/
        $this->appRepository->addApp();
        return $next($request);
        /*}
        return redirect()->back()->withSuccess('Something Wrong!');*/
    }
}