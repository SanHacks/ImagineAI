<?php

namespace Gundo\Imagine\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CleanUp extends Command
{
    /**
     * Initialization of the command.
     */
    protected function configure()
    {
        $this->setName('gundo:imagine:clean');
        $this->setDescription('Clean Up old images from autogenerated products.');
        parent::configure();
    }

    /**
     * CLI command description.
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     * @return void
     */
    protected function execute(InputInterface $input, OutputInterface $output): void
    {
        // todo: implement CLI command logic here
    }
}
