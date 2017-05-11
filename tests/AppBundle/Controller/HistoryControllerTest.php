<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HistoryControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'history/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('История', $crawler->filter('h1')->text());
    }

    public function testAjax()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'history/ajax');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertCount(1, $crawler->filter('table'));
    }
}
