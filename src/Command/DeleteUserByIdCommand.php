<?php


namespace App\Command;

use App\Entity\User;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

use Doctrine\ORM\EntityManagerInterface;

class DeleteUserByIdCommand extends Command
{
    protected static $defaultName = 'app:delete-user-by-id';

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        parent::__construct();
    }


    protected function configure()
    {
        $this->setDescription('Delete user by ID')
            ->setHelp('Delete user. Input id')
            ->addArgument('id', InputArgument::REQUIRED, 'Pass the id.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $entityManager = $this->entityManager;
        $user = $entityManager->getRepository(User::class)->find($input->getArgument('id'));

        if (!$user) {
            $output->writeln('User with this ID:'.$input->getArgument('id').' does not exist');
        } else {

            $entityManager->remove($user);

            $entityManager->flush();
            $output->writeln('User deleted');
        }

        return 0;
    }
}
