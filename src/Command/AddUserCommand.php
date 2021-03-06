<?php


namespace App\Command;

use App\Entity\User;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

use Doctrine\ORM\EntityManagerInterface;

class AddUserCommand extends Command
{

    protected static $defaultName = 'app:add-user';

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        parent::__construct();
    }


    protected function configure()
    {
        $this->setDescription('Add user')
            ->setHelp('Add user.Input name/email/group_id')
            ->addArgument('username', InputArgument::REQUIRED, 'Pass the username.')
            ->addArgument('email', InputArgument::REQUIRED, 'Pass the email.')
            ->addArgument('group_id', InputArgument::REQUIRED, 'Pass the group_id.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $entityManager = $this->entityManager;

        $user = new User();
        $user->setName($input->getArgument('username'));
        $user->setEmail($input->getArgument('email'));
        $user->setGroupId($input->getArgument('group_id'));

        $entityManager->persist($user);

        $entityManager->flush();
        $output->writeln(sprintf('Created user: %s', $input->getArgument('username')));
        return 0;
    }
}
