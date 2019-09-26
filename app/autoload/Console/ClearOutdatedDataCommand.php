<?php

namespace App\Console;

use Bitrix\Main\Application;

/**
 * Данная консольная команда запускается кроном каждую ночь и служит удобным инструментов для
 * удаления устаревших данных/логов как из БД, так и из файловой системы.
 * Удаления старых данных позволяет держать размер проекта в разумных пределах, не стоит этим пренебрегать
 *
 * Мест в которых могут скаплиаться старые данные на проекте может быть много и каждый раз писать отдельный код получается накладно.
 * С помощью этой команды этот процесс сильно упрощается. Достаточно лишь добавить одну строчку в соответсвующий массив
 * в метода getDbSources() или getFilesystemSources()
 *
 * Для БД строчка должна содержать название таблицы, datetime поле по которому определяется дата записи (не забудьте добавить на него индекс!) и число дней
 * по истечению которого записи считаются устаревшими и удаляются.
 *
 * Для файловой системы строчка должна содержать путь до директории с файлами и число дней. Число дней отсчитывается от даты последнего изменения файла.
 */
class ClearOutdatedDataCommand extends BaseCommand
{
    /**
     * Configures the current command.
     */
    protected function configure()
    {
        $this->setName('tools:clear_outdated_data')
            ->setDescription('Clear outdated data from database and filesystem');
    }
    
    /**
     * Execute the console command.
     *
     * @return void
     */
    protected function fire()
    {
        $this->clearOutdatedDataFromDb();
        $this->clearOutdatedDataFromFilesystem();
        
        $this->info("Удаление завершено");
    }
    
    /**
     * Список таблиц, которые надо очищать от старых данных.
     * @return array
     */
    private function getDbSources()
    {
        return [
            //['table' => 'b_event_log', 'field' => 'TIMESTAMP_X', 'max_days' => 30],
        ];
    }
    
    /**
     * Список директорий которые надо очищать от старых данных.
     * @return array
     */
    private function getFilesystemSources()
    {
        return [
            //['path' => public_path('upload/foo/bar/'), 'max_days' => 30],
        ];
    }
    
    private function clearOutdatedDataFromDb()
    {
        $db = Application::getConnection();
        $sqlHelper = $db->getSqlHelper();

        foreach ($this->getDbSources() as $source) {
            if (empty($source['table']) || empty($source['field']) || empty($source['max_days']) || intval($source['max_days']) === 0) {
                continue;
            }
            $table = $sqlHelper->forSql($source['table']);
            $field = $sqlHelper->forSql($source['field']);
            $maxDays = (int) $source['max_days'];
            $this->info("Удаляем старые данные из таблицы '{$table}'");
            $db->queryExecute("DELETE FROM `{$table}` WHERE `{$field}` < DATE_SUB(NOW(), INTERVAL {$maxDays} DAY)");
        }
    }
    
    private function clearOutdatedDataFromFilesystem()
    {
        $now = time();
        foreach ($this->getFilesystemSources() as $source) {
            if (empty($source['path']) || empty($source['max_days']) || intval($source['max_days']) === 0) {
                continue;
            }

            $this->info("Удаляем старые файлы из директории '{$source['path']}'");
    
            $maxDays = (int) $source['max_days'];
            foreach (glob($source['path']."*") as $file) {
                if (is_file($file) && ($now - filemtime($file) >= 60 * 60 * 24 * $maxDays)) {
                    $this->info("Удаляем файл '{$file}'");
                    unlink($file);
                }
            }
        }
    }
}