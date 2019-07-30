<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PartenaireControllerTest extends WebTestCase
{
    public function testNew()
    {
        $client = static::createClient();
        $crawler = $client->request(
            'POST','/partenaire',[],[],
            ['CONTENT_TYPE' => "application/json"],
            '{"numCompte": 78226201,"nomEntreprise":"KEURGUI","telephone":772026057 ,"email":"diopsecurite@gmail.com","adresse":"Thiaytou" ,"statut":"bloquer","ninea":158722 }'
        );
        $rep = $client->getResponse();
        var_dump($rep);
        $this->assertSame(201, $client->getResponse()->getStatusCode());
    }
}
