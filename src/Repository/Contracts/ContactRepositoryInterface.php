<?php

namespace App\Repository\Contracts;

use App\Entity\Contact;

interface ContactRepositoryInterface
{
    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Contact $entity, bool $flush = true): void;

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(Contact $entity, bool $flush = true): void;

    /**
     * @return Contact[]
     */
    public function findAll();
}