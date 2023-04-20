<?php

namespace App\Tests\Unit\Service;

use App\Entity\Contact;
use App\Repository\ContactRepository;
use App\Repository\Contracts\ContactRepositoryInterface;
use App\Service\ContactService;
use LDAP\Result;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ContactServiceTest extends KernelTestCase
{
    public function testShouldListAllContacts(): void
    {
        self::bootKernel();
        $container = self::$container;

        $repositoryMock = $this->createMock(ContactRepository::class);
        $repositoryMock->expects(self::once())
            ->method('findAll')
            ->willReturn($this->getContacts());

        $container->set(ContactRepositoryInterface::class, $repositoryMock);
        $repository = $container->get(ContactRepositoryInterface::class);
        $service = new ContactService($repository);

        $result = $service->findAll();

        $this->assertSameSize($this->getContacts(), $result);

        $this->assertInstanceOf(Contact::class, $result[0]);
        $this->assertInstanceOf(Contact::class, $result[1]);
    }

    public function testShouldAddNewContact(): void
    {
        self::bootKernel();
        $container = self::$container;

        $contactMock = $this->getContacts()[0];

        $repositoryMock = $this->createMock(ContactRepository::class);
        $repositoryMock->expects(self::once())
            ->method('add')
            ->with($contactMock)
            ->willReturn(null);

        $container->set(ContactRepositoryInterface::class, $repositoryMock);
        $repository = $container->get(ContactRepositoryInterface::class);
        $service = new ContactService($repository);

        $result = $service->add($contactMock);

        $this->assertNull($result);
    }

    public function testShouldAddEditContact(): void
    {
        self::bootKernel();
        $container = self::$container;

        $contactMock = $this->getContacts()[0];

        $repositoryMock = $this->createMock(ContactRepository::class);
        $repositoryMock->expects(self::once())
            ->method('add')
            ->with($contactMock)
            ->willReturn(null);

        $container->set(ContactRepositoryInterface::class, $repositoryMock);
        $repository = $container->get(ContactRepositoryInterface::class);
        $service = new ContactService($repository);

        $result = $service->edit($contactMock);

        $this->assertNull($result);
    }

    public function getContacts(): array
    {
        return [
            
            (new Contact())
            ->setName('test')
            ->setEmail('teste@email.com')
            ->setPhoneNumber('123 456 789'),

            (new Contact())
            ->setName('testtwo')
            ->setEmail('teste_two@email.com')
            ->setPhoneNumber('+55 11 12345-6789')
        ];
    }
}