<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class LoginControllerTest extends WebTestCase
{
    private $client;

    protected function setUp(): void
    {
        parent::setUp();

        //Créer le client
        $this->client = static::createClient();
    }

    public function testLoginPageIsRender()
    {
        // Faire la requête
        $this->client->request("GET", "/login");
        // Vérifier qu'elle est en succès
        $this->assertResponseIsSuccessful();
        // Vérifier que la page contient bien le titre
        $this->assertSelectorTextContains('h1', "Se connecter");
    }

    public function testSuccessfulLogin()
    {
        // Faire la requête
        $this->client->request("GET", "/login");

        // Soumettre le formulaire
        $crawler = $this->client->submitForm('login', [
         '_username' => 'j.doe@gmail.com',
         '_password' => '123456',
         ]);

        // vérifier qu'on est bien redirigé vers la page d'accueil
        $response = $this->client->getResponse();
        $redirectUrl = $response->headers->get('Location');
        $this->assertStringEndsWith('/', $redirectUrl);

        // vérifier que la page d'accueil contient bien les bons textes
        $crawler = $this->client->followRedirect();
        $this->assertSelectorTextContains('h1', "Vous êtes connecté");
        $this->assertSelectorTextContains('a', "Se déconnecter");
    }

    public function testWrongLogin()
    {
        // Faire la requête
        $this->client->request("GET", "/login");

        // Soumettre le formulaire
        $crawler = $this->client->submitForm('login', [
         '_username' => 'j.doe@gmail.com',
         '_password' => '12345678',
         ]);

        // vérifier qu'on est bien redirigé vers la page d'accueil
        $response = $this->client->getResponse();
        $redirectUrl = $response->headers->get('Location');
        $this->assertStringEndsWith('/login', $redirectUrl);

        // vérifier que la page d'accueil contient bien les bons textes
        $crawler = $this->client->followRedirect();
        $this->assertSelectorTextContains('div', "Invalid credentials.");
    }

    protected function tearDown():void{
        parent::tearDown();
        $this->client= null;
    }
}
