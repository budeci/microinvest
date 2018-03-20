<?php

namespace App\Repositories;

use App\AplicationFile;

class AplicationFileRepository
{
    /**
     * @return AplicationFile
     */
    public function getModel()
    {
        return new AplicationFile();
    }


    public function addAppFile($data = null)
    {
        $appFile = self::getModel()
            ->create($data);
        return $appFile;
    }

    public function getAppFile($appId)
    {
        return self::getModel()
            ->where('aplication_id', $appId)
            ->get();
    }

    public function removeFile($fileId)
    {
        return self::getModel()->where('id_file',$fileId)->delete();
    }
    public function findFile($fileId)
    {
        return self::getModel()->where('id_file',$fileId)->first();
    }
}