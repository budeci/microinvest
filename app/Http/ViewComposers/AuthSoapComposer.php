<?php

namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;

class AuthSoapComposer extends Composer
{

    /**
     * @param View $view
     * @return $this
     */
    public function compose(View $view)
    {
        $authDealerName = session()->has('auth') ? session()->get('auth.dealer') : '';
        $authCheck      = session()->has('auth') ? true : false;
        $appVariant     = session()->has('auth') ? session()->get('auth.applicationVariant') : '0';
        $logo_url = route('online');
        if ($appVariant == 1)  {
            $logo_url = route('standart');
        } elseif($appVariant == 2){
            $logo_url = route('business');
        } elseif($appVariant == 3){
            $logo_url = route('credit_auto');
        }

        return $view
            ->with('authDealerName', $authDealerName)
            ->with('appVariant', $appVariant)
            ->with('logo_url', $logo_url)
            ->with('authCheck', $authCheck);
    }
}
