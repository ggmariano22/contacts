<?php

namespace App\Tests\Unit\Repository;

use App\Entity\Contact;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ContactRepositoryTest extends KernelTestCase
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $entityManager;

    public function setUp(): void
    {
        $kernel = self::bootKernel();

        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    public function testShouldAddNewContact(): void
    {
        $contactMock = (new Contact())
            ->setName('test')
            ->setEmail('teste@email.com')
            ->setPhoneNumber('123 456 789');


        $contactRepository = $this->entityManager
            ->getRepository(Contact::class);

        $contactRepository->add($contactMock);

        $result = $contactRepository->findOneBy(['email' => 'teste@email.com']);

        $this->assertEquals($contactMock->getName(), $result->getName());
        $this->assertEquals($contactMock->getEmail(), $result->getEmail());
        $this->assertEquals($contactMock->getPhoneNumber(), $result->getPhoneNumber());
    }

    public function testShouldAddEditContact(): void
    {
        $contactMock = (new Contact())
            ->setName('test')
            ->setEmail('teste@email.com')
            ->setPhoneNumber('123 456 789');


        $contactRepository = $this->entityManager
            ->getRepository(Contact::class);

        $contactRepository->add($contactMock);

        $contactMock = (new Contact())
            ->setName('test two')
            ->setEmail('teste_two@email.com')
            ->setPhoneNumber('321 654 987');

        $contactRepository->add($contactMock);

        $result = $contactRepository->findOneBy(['email' => 'teste_two@email.com']);

        $this->assertEquals($contactMock->getName(), $result->getName());
        $this->assertEquals($contactMock->getEmail(), $result->getEmail());
        $this->assertEquals($contactMock->getPhoneNumber(), $result->getPhoneNumber());
    }

    public function testShouldFindAllContacts(): void
    {
        $firstContactMock = (new Contact())
            ->setName('test')
            ->setEmail('teste@email.com')
            ->setPhoneNumber('123 456 789');

        $secondContactMock = (new Contact())
            ->setName('test two')
            ->setEmail('teste_two@email.com')
            ->setPhoneNumber('321 654 987');


        $contactRepository = $this->entityManager
            ->getRepository(Contact::class);

        $contactRepository->add($firstContactMock);
        $contactRepository->add($secondContactMock);

        $result = $contactRepository->findAll();

        $this->assertInstanceOf(Contact::class, $result[0]);
        $this->assertInstanceOf(Contact::class, $result[1]);
    }
}