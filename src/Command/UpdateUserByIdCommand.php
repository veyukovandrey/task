<?php


namespace App\Command;

use App\Entity\User;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

use Doctrine\ORM\EntityManagerInterface;

class UpdateUserByIdCommand extends Command
{
    protected static $defaultName = 'app:update-user-by-id';

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        parent::__construct();
    }


    protected function configure()
    {
        $this->setDescription('Update user by ID')
            ->setHelp('Update user. Input id/name/email/group_id')
            ->addArgument('id', InputArgument::REQUIRED, 'Pass the id.')
            ->addArgument('username', InputArgument::REQUIRED, 'Pass the username.')
            ->addArgument('email', InputArgument::REQUIRED, 'Pass the email.')
            ->addArgument('group_id', InputArgument::REQUIRED, 'Pass the group_id.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $entityManager = $this->entityManager;
        $user = $entityManager->getRepository(User::class)->find($input->getArgument('id'));

        if (!$user) {
            $output->writeln('User with this ID:'.$input->getArgument('id').' does not exist');
        } else {

            $user->setName($input->getArgument('username'));
            $user->setEmail($input->getArgument('email'));
            $user->setGroupId($input->getArgument('group_id'));

            $entityManager->persist($user);

            $entityManager->flush();
            $output->writeln('User updated');
        }

        return 0;
    }
}
