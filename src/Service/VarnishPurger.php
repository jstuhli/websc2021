<?php


namespace App\Service;


use GuzzleHttp\Client;
use SofaScore\Purgatory\Purger\PurgerInterface;


class VarnishPurger implements PurgerInterface
{
    private Client $client;
    public function __construct()
    {
        $this->client = new Client();
    }

    public function purge(iterable $urls): void
    {
        foreach ($urls as $url) {
            $this->client->request('PURGE', 'http://127.0.0.1:6081' . $url);
        }
    }
}