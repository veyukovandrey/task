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
    // the name of the command (the part after "bin/console")
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
            ->addArgument('email', InputArgument::REQUIRED, 'Pass the email.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $entityManager = $this->entityManager;

        $user = new User();
        $user->setName('entity');
        $user->setEmail('entity@gmail.com');


        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($user);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();
        $output->writeln(sprintf('Hello World!, %s', $input->getArgument('username')));
        return 0;
    }
}
