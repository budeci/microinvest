<?php

namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use Keyhunter\Multilingual\LanguagesRepository;
use Lang;

class LanguageComposer extends Composer
{
    /**
     * @var LanguagesRepository
     */
    protected $languages;

    /**
     * LanguageComposer constructor.
     * @param LanguagesRepository $languagesRepository
     */
    public function __construct(LanguagesRepository $languagesRepository)
    {
        $this->languages = $languagesRepository;
    }

    /**
     * Bind data to view.
     *
     * @param View $view
     * @return $this
     */
    public function compose(View $view)
    {
        $languages = $this->languages->getPublic();

        $active_langs = [];
        $languages->each(function ($language) use (&$active_langs) {
            if ($language->slug == Lang::slug()) {
                $active_langs['current'] = $language;
            } else {
                // $active_langs['other'][] = $language;
            }
            $active_langs['other'][] = $language;
        });

        return $view->with('languages', $active_langs);
    }
}