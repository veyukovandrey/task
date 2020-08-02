<?php


namespace App\Command;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputArgument;

use Doctrine\ORM\EntityManagerInterface;

class ShowListOfGroupCommand extends Command
{
    protected static $defaultName = 'app:show-list-of-group';

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        parent::__construct();
    }


    protected function configure()
    {
        $this->setDescription('Show list of group')
            ->setHelp('Show list of group.')
            ->addArgument('group_id', InputArgument::OPTIONAL, 'Group_id');

    }



    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $entityManager = $this->entityManager;

        $group_id = $input->getArgument('group_id');



        $query = $entityManager->createQueryBuilder()
            ->select('u')
            ->from('App\Entity\User', 'u');
            if ($group_id) {
                $query->andWhere('u.group_id = :identifier')
                    ->setParameter('identifier', $group_id);
            }
          $q = $query->getQuery();

        $array_table = $q->getArrayResult();

        $table = new Table($output);
        $table->setHeaders(['id', 'name', 'email', 'group_id'])
            ->setRows($array_table);
        $table->render();


        return 0;
    }
}
