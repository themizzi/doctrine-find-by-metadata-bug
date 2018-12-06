<?php declare(strict_types=1);

namespace App\Command;

use App\Entity\EntityA;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class CreateEntityACommand
 * @package App\Command
 * @author  Joe Mizzi <themizzi@me.com>
 */
class CreateEntityACommand extends Command
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct();
        $this->entityManager = $entityManager;
    }

    protected function configure()
    {
        $this->setName('create:entity-a');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $entityA = new EntityA();
        $this->entityManager->persist($entityA);
        $this->entityManager->flush();
        $output->writeln('<info>Create entity A with id: '.$entityA->getId().'</info>');
    }
}