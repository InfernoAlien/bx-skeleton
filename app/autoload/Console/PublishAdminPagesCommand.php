<?php

namespace App\Console;

use Arrilot\BitrixCacher\Cache;

class PublishAdminPagesCommand extends BaseCommand
{
    /**
     * Configures the current command.
     */
    protected function configure()
    {
        $this->setName('tools:publish_admin_pages')
            ->setDescription('Publish admin pages to /bitrix/admin/');
    }
    
    /**
     * Execute the console command.
     *
     * @return null|int
     * @throws \Exception
     */
    protected function fire()
    {
        $pages = require app_path('admin.php');
        if (!is_array($pages)) {
            $this->abort("admin.php must return array");
        }

        foreach ($pages as $page => $script) {
            file_put_contents(public_path("bitrix/admin/app_{$page}.php"), $this->constructFileContent($script));
        }

        $this->info(count($pages) . " pages have been published");
    }
    
    private function constructFileContent($script)
    {
        $content = '<?php'.PHP_EOL;
        $content .= 'require $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_before.php";'.PHP_EOL;
        $content .= "require \"{$script}\";".PHP_EOL;
        $content .= 'require $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_admin.php";'.PHP_EOL;

        return $content;
    }
}