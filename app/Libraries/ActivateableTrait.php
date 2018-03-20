<?php

namespace App\Libraries;

trait ActivateableTrait
{
    /**
     * Scope where active.
     *
     * @param $query
     * @param $active
     * @return mixed
     */
    public function scopeActive($query, $active = true)
    {
        return $query->whereActive((int)$active);
    }
}