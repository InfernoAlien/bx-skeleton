<?php

namespace App\Console;

use Exception;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

abstract class BaseCommand extends Command
{
    /**
     * @var InputInterface
     */
    protected $input;

    /**
     * @var OutputInterface
     */
    protected $output;

    /**
     * Execute the console command.
     *
     * @return null|int
     */
    abstract protected function fire();
    
    /**
     * Configures the current command.
     *
     * @param string $message
     * @throws Exception
     */
    protected function abort($message = '')
    {
        if ($message) {
            $this->error($message);
        }

        throw new Exception();
    }

    /**
     * Executes the current command.
     *
     * @param InputInterface  $input  An InputInterface instance
     * @param OutputInterface $output An OutputInterface instance
     *
     * @return null|int null or 0 if everything went fine, or an error code.
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->input = $input;
        $this->output = $output;

        try {
            return $this->fire();
        } catch (Exception $e) {
            $this->error($e->getMessage());
            $this->error('Abort!');
            return 1;
        }
    }

    /**
     * Echo an error message.
     *
     * @param string$message
     */
    protected function error($message)
    {
        $this->output->writeln("<error>{$message}</error>");
    }

    /**
     * Echo an info.
     *
     * @param string $message
     */
    protected function info($message)
    {
        $this->output->writeln("<info>{$message}</info>");
    }

    /**
     * Echo a message.
     *
     * @param string $message
     */
    protected function message($message)
    {
        $this->output->writeln("{$message}");
    }
}