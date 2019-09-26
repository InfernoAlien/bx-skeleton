<?php

namespace App\Console;

/**
 * В процессе жизнидеятельности проекта рано или поздно встречаются проблемы с правами, популярные кейсы:
 * - сбился юзер файлов публичной части и при редактировании страницы через админку получаем "Ошибка при создании файла"
 * - после ручного запуска консольной команды файл-лог создался не от пользователя www-data и дальнейшие запуски через крон падают при попытке записи в этот лог
 * - внешний сервис выгружал в проект файлы с одними правами, а потом взял и поменял их.
 *
 * Данный команда позволяет указать какие права мы желаем видеть в каких директориях.
 * Так как она запускается на боевом по крону (по-умолчанию раз в час), то тполучается,
 * что в ситуации когда права по какой-то причине сбились, они в течение часа придут в заданную нами норму.
 *
 * Class FixFilesPermissionsCommand
 * @package App\Console
 */
class FixFilesPermissionsCommand extends BaseCommand
{
    /**
     * Configures the current command.
     */
    protected function configure()
    {
        $this->setName('tools:fix_files_permissions')
            ->setDescription('Fix files permissions');
    }
    
    /**
     * Execute the console command.
     *
     * @return null|int
     */
    protected function fire()
    {
        if (!in_production()) {
            $this->info("Skipping for this env");
            return 0;
        }

        // Вы можете добавить сюда дополнительные команды для других директорий или модифицировать имеющиеся.
        // Пути рекомендуется хардкодить, а не использовать project_path() и т. д.,
        // чтобы не сломать как-нибудь случайно весь сервер.

        exec("sudo chmod -R 775 logs/");
        exec("sudo chown www-data:www-data logs/");

        exec("sudo chmod -R 775 public/");
        exec("sudo chown www-data:www-data public/");

        $this->info("Permissions have been fixed");
    }
}