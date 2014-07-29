<?php

namespace Owncloud;

class Api
{
    private $client;

    public function __construct($host, $auth, $config = array())
    {
        $config['base_url'] = $host;
        $config['defaults']['auth'] = $auth;
        $this->client = new Client($config);
    }

    public function getClient()
    {
        return $this->client;
    }

    public function fileSharing()
    {
        return new Api\FileSharing($this->client);
    }
}
