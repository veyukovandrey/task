<?php


namespace App\Command;

use App\Entity\Group;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

use Doctrine\ORM\EntityManagerInterface;

class UpdateGroupByIdCommand extends Command
{
    protected static $defaultName = 'app:update-group-by-id';

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        parent::__construct();
    }


    protected function configure()
    {
        $this->setDescription('Update group by ID')
            ->setHelp('Update group. Input id/name')
            ->addArgument('id', InputArgument::REQUIRED, 'Pass the id.')
            ->addArgument('groupname', InputArgument::REQUIRED, 'Pass the groupname.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $entityManager = $this->entityManager;
        $user = $entityManager->getRepository(Group::class)->find($input->getArgument('id'));

        if (!$user) {
            $output->writeln('Group with this ID:'.$input->getArgument('id').' does not exist');
        } else {

            $user->setName($input->getArgument('groupname'));

            $entityManager->persist($user);

            $entityManager->flush();
            $output->writeln('Group updated');
        }

        return 0;
    }
}
