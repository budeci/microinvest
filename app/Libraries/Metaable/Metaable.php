<?php

namespace App\Libraries\Metaable;

trait Metaable
{
    /**
     * Get meta by key
     *
     * @param $key
     * @param null $type
     * @param bool $asModel
     * @return mixed
     */
    public function getMeta($key, $type = null, $asModel = false)
    {
        if ($type) {
            $meta = $this->whereKey($key)->whereType($type)->active()->first();
        } else {
            $meta = $this->whereKey($key)->active()->first();
        }

        return ($meta) ? ($asModel) ? $meta : $meta->value : '';
    }

    /**
     * @return mixed
     */
    public function getAll()
    {
        return $this->select('*')->active()->get();
    }
}