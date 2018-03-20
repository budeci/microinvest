<?php

namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use App\Soap\PaymentScheduleService;
use App\Soap\LoanApplicationService;
class AplicationComposer extends Composer
{

    /**
     * @var paymentApp
     */

    protected $paymentApp;
    protected $loanApp;

    public function __construct(PaymentScheduleService $paymentScheduleService, LoanApplicationService $loanApplicationService)
    {
        $this->paymentApp = $paymentScheduleService;
        $this->loanApp = $loanApplicationService;
    }

    /**
     * @param View $view
     * @return $this
     */
    public function compose(View $view)
    {
        $dealer = session()->has('auth') ? session()->get('auth.dealer') : 'partener';
        $loanProduct = $this->paymentApp->getLoanProductSet($dealer);
        $getBranch = $this->loanApp->getBranchSet();
        return $view
            ->with('loanProduct', $loanProduct)
            ->with('getBranch', $getBranch);
    }
}