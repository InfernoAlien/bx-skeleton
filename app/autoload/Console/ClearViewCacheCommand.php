<?php

namespace App\Console;

use Arrilot\BitrixBlade\BladeProvider;

class ClearViewCacheCommand extends BaseCommand
{
    /**
     * Configures the current command.
     */
    protected function configure()
    {
        $this->setName('view:clear')
            ->setDescription('Clear all blade compiled view cache files');
    }
    
    /**
     * Execute the console command.
     *
     * @return null|int
     */
    protected function fire()
    {
        if (BladeProvider::clearCache()) {
            $this->info("View cache has been cleared");
        } else {
            $this->error("Some of cache files were not cleared from ". BladeProvider::getCachePath());
        }

        return null;
    }
}