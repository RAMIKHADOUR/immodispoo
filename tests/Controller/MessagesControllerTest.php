<?php

namespace App\Tests\Controller;

use App\Entity\Messages;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class MessagesControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $repository;
    private string $path = '/messages/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->repository = $this->manager->getRepository(Messages::class);

        foreach ($this->repository->findAll() as $object) {
            $this->manager->remove($object);
        }

        $this->manager->flush();
    }

    public function testIndex(): void
    {
        $this->client->followRedirects();
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Message index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'message[mail_envoy]' => 'Testing',
            'message[mail_recu]' => 'Testing',
            'message[content]' => 'Testing',
            'message[createdAt]' => 'Testing',
            'message[users]' => 'Testing',
        ]);

        self::assertResponseRedirects($this->path);

        self::assertSame(1, $this->repository->count([]));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Messages();
        $fixture->setMail_envoy('My Title');
        $fixture->setMail_recu('My Title');
        $fixture->setContent('My Title');
        $fixture->setCreatedAt('My Title');
        $fixture->setUsers('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Message');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Messages();
        $fixture->setMail_envoy('Value');
        $fixture->setMail_recu('Value');
        $fixture->setContent('Value');
        $fixture->setCreatedAt('Value');
        $fixture->setUsers('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'message[mail_envoy]' => 'Something New',
            'message[mail_recu]' => 'Something New',
            'message[content]' => 'Something New',
            'message[createdAt]' => 'Something New',
            'message[users]' => 'Something New',
        ]);

        self::assertResponseRedirects('/messages/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getMail_envoy());
        self::assertSame('Something New', $fixture[0]->getMail_recu());
        self::assertSame('Something New', $fixture[0]->getContent());
        self::assertSame('Something New', $fixture[0]->getCreatedAt());
        self::assertSame('Something New', $fixture[0]->getUsers());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();
        $fixture = new Messages();
        $fixture->setMail_envoy('Value');
        $fixture->setMail_recu('Value');
        $fixture->setContent('Value');
        $fixture->setCreatedAt('Value');
        $fixture->setUsers('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/messages/');
        self::assertSame(0, $this->repository->count([]));
    }
}
