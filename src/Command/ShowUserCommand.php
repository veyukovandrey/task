<?php


namespace App\Command;

use App\Entity\User;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputArgument;

use Doctrine\ORM\EntityManagerInterface;

class ShowUserCommand extends Command
{
    protected static $defaultName = 'app:show-user';

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        parent::__construct();
    }


    protected function configure()
    {
        $this->setDescription('Show table user')
            ->setHelp('Show table user.');

    }



    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $entityManager = $this->entityManager;


        //$user = $entityManager->getRepository(User::class)->findAll();

        $query = $entityManager->createQueryBuilder()
            ->select('u')
            ->from('App\Entity\User', 'u')
            ->getQuery();

        $array_tabe = $query->getArrayResult();

        $table = new Table($output);
        $table->setHeaders(['id', 'name', 'email', 'group_id'])
           ->setRows($array_tabe);
        $table->render();


        return 0;
    }
}
