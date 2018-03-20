<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Repositories\AplicationRepository;
use File;
/**
 * Class UpdateStatusLot
 * @package App\Console\Commands
 */
class RemoveExpireApp extends Command
{
    /**
     * @var LotRepository
     */
    protected $app;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'remove:expire_app';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove expire aplication';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(AplicationRepository $aplicationRepository)
    {
        parent::__construct();
        $this->app = $aplicationRepository;
    }

    public function handle()
    {
        foreach ($this->app->getExpiredApp() as $item) {
            if ($item->aplicationFile) {
                File::delete(array_pluck($item->aplicationFile, 'full_path'));
            }
            $this->app->delete($item->id);
        }
    }
}
