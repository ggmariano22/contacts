<?php

namespace App\Service;

use App\Entity\Contact;
use App\Repository\Contracts\ContactRepositoryInterface;
use Exception;
use Throwable;

class ContactService
{
    protected $contactRepository;

    public function __construct(ContactRepositoryInterface $contactRepository)
    {
        $this->contactRepository = $contactRepository;
    }

    /**
     * @return Contact[]
     */
    public function findAll(): array
    {
        return $this->contactRepository->findAll();
    }

    public function edit(Contact $contact): void
    {
        $this->add($contact);
    }

    public function add(Contact $contact): void
    {
        try {
            $this->contactRepository->add($contact);
        } catch (Throwable $e) {
            throw new Exception('Error when trying to create contact: ' . $e->getMessage());
        }
    }

    public function remove(Contact $contact): void
    {
        try {
            $this->contactRepository->remove($contact);
        } catch (Throwable $e) {
            throw new Exception('Error when trying to delete contact: ' . $e->getMessage());
        }
    }
}