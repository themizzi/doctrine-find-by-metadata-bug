<?php declare(strict_types=1);

namespace App\Command;

use App\Entity\EntityB;
use App\Entity\EntityC;
use App\Entity\EntityD;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class FindEntityBCommand
 * @package App\Command
 * @author  Joe Mizzi <themizzi@me.com>
 */
class FindEntityBByNewEntityCCommand extends Command
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct();
        $this->entityManager = $entityManager;
    }

    protected function configure()
    {
        $this->setName('find:entity-b-by-new-entity-c');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $result = $this->entityManager->getRepository(EntityB::class)->findBy([
            'entityA' => new EntityC()
        ]);
        var_dump($result);
    }
}