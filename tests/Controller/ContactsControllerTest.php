<?php

namespace App\Tests\Controller;

use App\Entity\Contacts;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class ContactsControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $repository;
    private string $path = '/contacts/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->repository = $this->manager->getRepository(Contacts::class);

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
        self::assertPageTitleContains('Contact index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'contact[prenom_nom]' => 'Testing',
            'contact[email_contact]' => 'Testing',
            'contact[message]' => 'Testing',
            'contact[tel_mobile]' => 'Testing',
            'contact[createdAt]' => 'Testing',
            'contact[users]' => 'Testing',
        ]);

        self::assertResponseRedirects($this->path);

        self::assertSame(1, $this->repository->count([]));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Contacts();
        $fixture->setPrenom_nom('My Title');
        $fixture->setEmail_contact('My Title');
        $fixture->setMessage('My Title');
        $fixture->setTel_mobile('My Title');
        $fixture->setCreatedAt('My Title');
        $fixture->setUsers('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Contact');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Contacts();
        $fixture->setPrenom_nom('Value');
        $fixture->setEmail_contact('Value');
        $fixture->setMessage('Value');
        $fixture->setTel_mobile('Value');
        $fixture->setCreatedAt('Value');
        $fixture->setUsers('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'contact[prenom_nom]' => 'Something New',
            'contact[email_contact]' => 'Something New',
            'contact[message]' => 'Something New',
            'contact[tel_mobile]' => 'Something New',
            'contact[createdAt]' => 'Something New',
            'contact[users]' => 'Something New',
        ]);

        self::assertResponseRedirects('/contacts/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getPrenom_nom());
        self::assertSame('Something New', $fixture[0]->getEmail_contact());
        self::assertSame('Something New', $fixture[0]->getMessage());
        self::assertSame('Something New', $fixture[0]->getTel_mobile());
        self::assertSame('Something New', $fixture[0]->getCreatedAt());
        self::assertSame('Something New', $fixture[0]->getUsers());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();
        $fixture = new Contacts();
        $fixture->setPrenom_nom('Value');
        $fixture->setEmail_contact('Value');
        $fixture->setMessage('Value');
        $fixture->setTel_mobile('Value');
        $fixture->setCreatedAt('Value');
        $fixture->setUsers('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/contacts/');
        self::assertSame(0, $this->repository->count([]));
    }
}
