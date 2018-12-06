<?php declare(strict_types=1);

namespace App\Command;

use App\Entity\EntityA;
use App\Entity\EntityB;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class CreateEntityBCommand
 * @package App\Command
 * @author  Joe Mizzi <themizzi@me.com>
 */
class CreateEntityBCommand extends Command
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct();
        $this->entityManager = $entityManager;
    }

    protected function configure()
    {
        $this->setName('create:entity-b');
        $this->addArgument('entity-a-id', InputArgument::REQUIRED);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $entityB = new EntityB();
        $entityB->setEntityA($this->entityManager->find(EntityA::class, $input->getArgument('entity-a-id')));
        $this->entityManager->persist($entityB);
        $this->entityManager->flush();
        $output->writeln('<info>Create entity B with id: '.$entityB->getId().'</info>');
    }
}