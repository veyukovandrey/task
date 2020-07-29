<?php
namespace Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


class FirstCommand extends Command
{
    public function configure()
    {
        $this->setName('task')
            ->setDescription('Display input data')
            ->setHelp('This command test input output')
            ->addArgument('text', InputArgument::REQUIRED, 'Any text.');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Data for display: '.$input->getArgument('text'));
        return 0; //must have for fix error message in console
    }
}
