<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ApiControllerTest extends WebTestCase
{
    public function testGetClubes()
    {
        $client = static::createClient();
        
        $crawler = $client->request('GET', '/api/clubes');
        $clubes = \json_decode($client->getResponse()->getContent());

        $this->assertTrue(           
            count($clubes) == 10
        );

    }

}
