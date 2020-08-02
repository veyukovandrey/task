<?php


namespace App\Command;

use App\Entity\Group;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputArgument;

use Doctrine\ORM\EntityManagerInterface;

class ShowGroupCommand extends Command
{
    protected static $defaultName = 'app:show-group';

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        parent::__construct();
    }


    protected function configure()
    {
        $this->setDescription('Show table group')
            ->setHelp('Show table group.');

    }



    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $entityManager = $this->entityManager;


        //$user = $entityManager->getRepository(User::class)->findAll();

        $query = $entityManager->createQueryBuilder()
            ->select('g')
            ->from('App\Entity\Group', 'g')
            ->getQuery();

        $array_table = $query->getArrayResult();

        $table = new Table($output);
        $table->setHeaders(['id', 'name'])
            ->setRows($array_table);
        $table->render();


        return 0;
    }
}
