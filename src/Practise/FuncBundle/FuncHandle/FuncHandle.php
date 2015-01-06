<?php

namespace Practise\FuncBundle\FuncHandle;

use Doctrine\ORM\EntityManager;
use Practise\FuncBundle\FuncHandle\Component\FuncInterface;

class FuncHandle implements FuncInterface
{
    protected $entityManager;

    function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function insertDatabase($object) {
        $this->entityManager->persist($object);
        $this->entityManager->flush();
        return $object;
    }

    public function deleteDatabase($object) {
        $this->entityManager->remove($object);
        $this->entityManager->flush();
        return $object;
    }
}