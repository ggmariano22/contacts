<?php

namespace App\Tests\Application\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ContactControllerTest extends WebTestCase
{
    public function setUp(): void
    {
        self::ensureKernelShutdown();
    }

    public function testShouldListAllContacts(): void
    {
        $client = static::createClient();

        $client->followRedirects();        
        $client->request('GET', '/contacts');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Contacts list');
    }

    public function testShoulAddNewContact(): void
    {
        $client = static::createClient();

        $client->followRedirects();        
        $crawler = $client->request('GET', '/contacts/new');
        $button = $crawler->selectButton('Save');
        $form = $button->form();

        $crawler = $client->submit($form, [
            'contact[name]' => 'test',
            'contact[email]' => 'test@email.com',
            'contact[phone_number]' => '123 456 789',
            'contact[address]' => 'example',
        ]);

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Contacts list');
    }

    public function testShoulEditContact(): void
    {
        $client = static::createClient();

        $client->followRedirects();        
        $crawler = $client->request('GET', '/contacts/1/edit');
        $button = $crawler->selectButton('Update');
        $form = $button->form();

        $crawler = $client->submit($form, [
            'contact[name]' => 'test',
            'contact[email]' => 'test@email.com',
            'contact[phone_number]' => '123 456 789',
            'contact[address]' => 'example',
        ]);

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Contacts list');
    }

    public function testShoulDeleteContact(): void
    {
        $client = static::createClient();

        $client->followRedirects();        
        $client->request('POST', '/contacts/1');

        $this->assertResponseIsSuccessful();
    }
}
