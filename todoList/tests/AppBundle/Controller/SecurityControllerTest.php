<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SecurityControllerTest extends WebTestCase
{

    public function testLoginAction()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/login');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }


    public function testLoginCheck()
    {
        $client = static::createClient();
    
        $crawler = $client->request('GET', '/login');

        $form = $crawler->selectButton('Se connecter')->form();

        $form['_username'] = 'user1';

        $form['_password'] = 'pass1';

        $client->submit($form);

        $crawler = $client->followRedirect();

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testLogout()
    {
        $client = static::createClient();

        $client->followRedirects();
      
        $client->request('GET', '/logout');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testAnonymous()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/tasks');

        $this->assertEquals(302, $client->getResponse()->getStatusCode());
    }

    public function testUsers()
    {
        $client = static::createClient(array(), array(
            'PHP_AUTH_USER' => 'user1',
            'PHP_AUTH_PW'   => 'pass1',
        ));

        $crawler = $client->request('GET', '/users');

        $this->assertEquals(403, $client->getResponse()->getStatusCode());
    }
}