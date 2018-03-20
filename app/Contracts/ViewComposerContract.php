<?php

namespace App\Contracts;

use Illuminate\Contracts\View\View;

interface ViewComposerContract
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view);
}