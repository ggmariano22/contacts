<?php

namespace App\Tests\Unit\Entity;

use App\Entity\Contact;
use PHPUnit\Framework\TestCase;

class ContactTest extends TestCase
{
    /**
     * @dataProvider contactDataProvider
     */
    public function test_should_create_contact($data): void
    {
        $entity = new Contact();

        $entity->setName($data['name']);
        $entity->setEmail($data['email']);
        $entity->setPhoneNumber($data['phone_number']);

        $this->assertEquals($entity->getName(), $data['name']);
        $this->assertEquals($entity->getEmail(), $data['email']);
        $this->assertEquals($entity->getPhoneNumber(), $data['phone_number']);
    }

    public function contactDataProvider(): array
    {
        return [
            [
                [
                    'name' => 'test',
                    'email' => 'teste@email.com',
                    'phone_number' => '123 456 789'
                ],
                [
                    'name' => 'test two',
                    'email' => 'teste_two@email.com',
                    'phone_number' => '+55 11 12345-6789'
                ],
            ]
        ];
    }
}