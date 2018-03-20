<?php

namespace App\Repositories;

use App\Aplication;
use Carbon\Carbon;

class AplicationRepository
{
    /**
     * @return Aplication
     */
    public function getModel()
    {
        return new Aplication();
    }

    /**
     * Create plain aplication for \App\Aplication
     *
     * @return static
     */
    public function createPlain($data=null)
    {
        $app = self::getModel()
            ->create($data);

        return $app;
    }

    public function addApp()
    {
        $data = [
            'dealer'      => session()->has('auth.dealer') ? session()->get('auth.dealer') : null,
            'session_id'  => session()->getId(),
            'expire_date' => Carbon::now()->addHour()
        ];
        if($app = $this->getOpenApp($data))
            return $app;

        return $this->createPlain($data);
    }

    public function getOpenApp($data=null)
    {
        $app = $this->getModel()
			->where('dealer', session()->has('auth') ? session()->get('auth.dealer') : null)
			->where('session_id', session()->getId())
            ->where('status','open')
            ->first();
        if ($app) {
	        $app = $this->save($app,['expire_date' => Carbon::now()->addHour()]);
        }
        return $app;
    }
    public function getExpiredApp()
    {
        return self::getModel()
            ->where('expire_date', '<=', Carbon::now())
            ->where('status','open')
            ->get();
    }
    public function delete($id)
    {
        return self::getModel()->find($id)->delete();
    }
    public function save($app, $data=null)
    {
        $app->fill($data)->save();
        return $app;
    }
}