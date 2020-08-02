<?php


namespace App\Command;

use App\Entity\Group;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

use Doctrine\ORM\EntityManagerInterface;

class DeleteGroupByIdCommand extends Command
{
    protected static $defaultName = 'app:delete-group-by-id';

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        parent::__construct();
    }


    protected function configure()
    {
        $this->setDescription('Delete group by ID')
            ->setHelp('Delete group. Input id')
            ->addArgument('id', InputArgument::REQUIRED, 'Pass the id.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $entityManager = $this->entityManager;
        $user = $entityManager->getRepository(Group::class)->find($input->getArgument('id'));

        if (!$user) {
            $output->writeln('Group with this ID:'.$input->getArgument('id').' does not exist');
        } else {

            $entityManager->remove($user);

            $entityManager->flush();
            $output->writeln('Group deleted');
        }

        return 0;
    }
}
