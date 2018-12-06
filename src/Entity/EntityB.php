<?php declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class EntityB
 * @package App\Entity
 * @author  Joe Mizzi <themizzi@me.com>
 * @ORM\Entity()
 */
class EntityB
{
    /**
     * @ORM\Column(type="integer", options={"unsigned"=true})
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var int
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="EntityA", inversedBy="entityBs")
     * @var EntityA
     */
    private $entityA;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return EntityA
     */
    public function getEntityA(): ?EntityA
    {
        return $this->entityA;
    }

    /**
     * @param EntityA $entityA
     */
    public function setEntityA(EntityA $entityA)
    {
        $this->entityA = $entityA;
    }
}