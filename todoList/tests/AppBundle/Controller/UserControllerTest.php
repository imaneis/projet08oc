<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use AppBundle\Entity\User;
use Doctrine\ORM\EntityManager;

class UserControllerTest extends WebTestCase
{

    public function testListAction()
    {
        $client = static::createClient(array(), array(
            'PHP_AUTH_USER' => 'admin',
            'PHP_AUTH_PW'   => 'pass1',
        ));

        $client->followRedirects();
        $client->request('GET', '/users');

        $this->assertSame(200, $client->getResponse()->getStatusCode());
    }

    public function testCreateAction()
    {
        $client = static::createClient(array(), array(
            'PHP_AUTH_USER' => 'admin',
            'PHP_AUTH_PW'   => 'pass1',
        ));
       
        $client->followRedirects();
        $crawler = $client->request('GET', '/users/create');
        
        $form = $crawler->selectButton('Ajouter')->form();
        $form['user[username]'] = 'admin2';
        $password = 'pass2';
        $form['user[password][first]'] = $password;
        $form['user[password][second]'] = $password;
        $form['user[roles]'] = ['ROLE_ADMIN'];
        $form['user[email]'] = 'admin2@email.fr';
        $crawler = $client->submit($form);

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}