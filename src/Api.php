<?php

namespace Owncloud;

class Api
{
    private $client;
    private $host;
    private $username;
    private $password;

    public function __construct($host, $username, $password, $config = array())
    {
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;

        $config['base_url'] = $host;
        $config['defaults']['auth'] = [$username, $password];
        $this->client = new Client($config);
    }

    public function fileSharing()
    {
        return new Api\FileSharing($this->client);
    }

    public function fileManagement()
    {
        return new Api\FileManagement($this->host, $this->username, $this->password);
    }
}
