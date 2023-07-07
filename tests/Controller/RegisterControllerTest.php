<?php

namespace App\Tests;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RegisterControllerTest extends WebTestCase
{
    private $client;
    private $entityManager;

    protected function setUp(): void
    {
        parent::setUp();

        //Créer le client
        $this->client = static::createClient();

        //Créer l'entity manager
        $this->entityManager = $this->client->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    public function testRenderRegisterPage()
    {
        // Faire la requête
        $this->client->request("GET", "/register");
        // Vérifier qu'elle est en succès
        $this->assertResponseIsSuccessful();
        // Vérifier que la page contient bien le titre
        $this->assertSelectorTextContains('h1', "Inscription");
    }

    public function testSuccessfulRegister()
    {
        // Faire la requête
        $this->client->request("GET", "/register");

        // Soumettre le formulaire
        $crawler = $this->client->submitForm('Register', [
         'registration_form[firstname]' => 'John',
         'registration_form[lastname]' => 'Doe',
         'registration_form[email]' => 'test@test.com',
         'registration_form[plainPassword]' => 'azerty',
         ]);

        // vérifier qu'on est bien redirigé vers le login
        $response = $this->client->getResponse();
        $redirectUrl = $response->headers->get('Location');
        $this->assertStringEndsWith('/login', $redirectUrl);

        // Vérifier qu'on retrouve bien l'utilisateur en BDD
        $user = $this->entityManager
            ->getRepository(User::class)
            ->findOneBy(['email' => 'test@test.com']);

        $this->assertNotNull($user);
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        // Supprimer l'utilisateur qu'on vient de créer en BDD
        $user = $this->entityManager
            ->getRepository(User::class)
            ->findOneBy(['email' => 'test@test.com']);
        
        if($user){
            $this->entityManager->remove($user);
            $this->entityManager->flush();
        }
        
        // Remettre client et entity manager à null
        $this->client = null;
        $this->entityManager = null;
    }
}
