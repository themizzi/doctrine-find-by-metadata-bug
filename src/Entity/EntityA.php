<?php declare(strict_types=1);

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class EntityA
 * @package App\Entity
 * @author  Joe Mizzi <themizzi@me.com>
 * @ORM\Entity()
 * @ORM\InheritanceType("JOINED")
 */
class EntityA
{
    /**
     * @ORM\Column(type="integer", options={"unsigned"=true})
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var int
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="EntityB", mappedBy="entityA")
     * @var Collection|EntityB[]
     */
    private $entityBs;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return EntityB[]|Collection
     */
    public function getEntityBs()
    {
        return $this->entityBs;
    }

    /**
     * @param EntityB $entityB
     */
    public function addEntityB(EntityB $entityB): void
    {
        $this->entityBs->add($entityB);
    }

    /**
     * @param EntityB $entityB
     */
    public function removeEntityB(EntityB $entityB): void
    {
        $this->entityBs->remove($entityB);
    }
}