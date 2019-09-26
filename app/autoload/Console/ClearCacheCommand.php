<?php

namespace App\Console;

use Arrilot\BitrixCacher\Cache;

class ClearCacheCommand extends BaseCommand
{
    /**
     * Configures the current command.
     */
    protected function configure()
    {
        $this->setName('cache:clear')
            ->setDescription('Clear bitrix cache');
    }
    
    /**
     * Execute the console command.
     *
     * @return null|int
     */
    protected function fire()
    {
        Cache::flushAll();
        $this->info("Cache has been cleared");
    }
}