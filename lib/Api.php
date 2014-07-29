<?php

namespace Owncloud;

class Api
{
    private $client;

    public function __construct($host, $auth)
    {
        $this->client = new Client([
            'base_url' => $host,
            'defaults' => [
                'auth' => $auth
            ]
        ]);
    }

    public function fileSharing()
    {
        return new Api\FileSharing($this->client);
    }
}
