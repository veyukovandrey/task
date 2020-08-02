<?php


namespace App\Command;

use App\Entity\Group;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

use Doctrine\ORM\EntityManagerInterface;

class AddGroupCommand extends Command
{

    protected static $defaultName = 'app:add-group';

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        parent::__construct();
    }


    protected function configure()
    {
        $this->setDescription('Add group')
            ->setHelp('Add group.Input name of group')
            ->addArgument('groupname', InputArgument::REQUIRED, 'Pass the group.');

    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $entityManager = $this->entityManager;

        $user = new Group();
        $user->setName($input->getArgument('groupname'));

        $entityManager->persist($user);

        $entityManager->flush();
        $output->writeln(sprintf('Created group: %s', $input->getArgument('groupname')));
        return 0;
    }
}
