<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use AppBundle\Entity\Task;
use AppBundle\Entity\User;
use Doctrine\ORM\EntityManager;

class TaskControllerTest extends WebTestCase
{

    public function testListAction()
    {

        $client = static::createClient(array(), array(
            'PHP_AUTH_USER' => 'user1',
            'PHP_AUTH_PW'   => 'pass1',
        ));

        $crawler = $client->request('GET', '/tasks');

        $crawler = $client->followRedirects();

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testCreateAction()
    {

        $client = static::createClient(array(), array(
            'PHP_AUTH_USER' => 'user1',
            'PHP_AUTH_PW'   => 'pass1',
        ));

        $crawler = $client->followRedirects();

        $crawler = $client->request('GET', '/tasks/create');

        $form = $crawler->selectButton('Ajouter')->form();
        $form['task[title]'] = 'Task 1';
        $form['task[content]'] = 'Content 1';
        $crawler = $client->submit($form);

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testEditAction()
    {
        $client = static::createClient(array(), array(
            'PHP_AUTH_USER' => 'user1',
            'PHP_AUTH_PW'   => 'pass1',
        ));

        $crawler = $client->followRedirects();

        $kernel = self::bootKernel();
        $entityManager = $kernel->getContainer()->get('doctrine')->getManager();
        
        $user = $entityManager->getRepository(User::class)->findOneBy(['username' => 'user1']);
        $task = $entityManager->getRepository(Task::class)->findBy(['user' => $user]);

        $crawler = $client->request('GET', '/tasks/'. $task[0]->getId() . '/edit');

        $form = $crawler->selectButton('Modifier')->form();
        $form['task[title]'] = 'Task 12';
        $form['task[content]'] = 'Content 12';
        $crawler = $client->submit($form);

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testToggleTaskAction()
    {
        $client = static::createClient(array(), array(
            'PHP_AUTH_USER' => 'user1',
            'PHP_AUTH_PW'   => 'pass1',
        ));

        $crawler = $client->followRedirects();

        $kernel = self::bootKernel();
        $entityManager = $kernel->getContainer()->get('doctrine')->getManager();
    
        $user = $entityManager->getRepository(User::class)->findOneBy(['username' => 'user1']);
        $task = $entityManager->getRepository(Task::class)->findBy(['user' => $user]);
        $crawler = $client->request('GET', '/tasks/'. $task[0]->getId()  . '/toggle');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }


    public function testDeleteTaskAction1()
    {
        $client = static::createClient(array(), array(
            'PHP_AUTH_USER' => 'user2',
            'PHP_AUTH_PW'   => 'pass1',
        ));

        $kernel = self::bootKernel();
        $entityManager = $kernel->getContainer()->get('doctrine')->getManager();

        $user = $entityManager->getRepository(User::class)->findOneBy(['username' => 'user1']);
        $task = $entityManager->getRepository(Task::class)->findBy(['user' => $user]);
        $client->followRedirects();
        $crawler = $client->request('GET', '/tasks/'. $task[0]->getId() . '/delete');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertSame(1, $crawler->filter('html:contains("Vous n\'avez pas le droit supprimer cette tâche")')->count());
    }

    public function testDeleteTaskAction2()
    {
        $client = static::createClient(array(), array(
            'PHP_AUTH_USER' => 'user1',
            'PHP_AUTH_PW'   => 'pass1',
        ));

        $kernel = self::bootKernel();
        $entityManager = $kernel->getContainer()->get('doctrine')->getManager();

        $user = $entityManager->getRepository(User::class)->findOneBy(['username' => 'user1']);
        $task = $entityManager->getRepository(Task::class)->findBy(['user' => $user]);
        $client->followRedirects();
        $crawler = $client->request('GET', '/tasks/'. $task[0]->getId() . '/delete');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertSame(1, $crawler->filter('html:contains("La tâche a bien été supprimée.")')->count());
    }
}
