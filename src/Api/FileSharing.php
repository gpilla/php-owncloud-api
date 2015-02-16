<?php

namespace Owncloud\Api;

use Owncloud\Response;
use Owncloud\ResponseException;

class FileSharing
{

    private $client;
    private $debug = false;

    private $version = 1;

    const SHARE_TYPE_USER = 0;
    const SHARE_TYPE_GROUP = 2;
    const SHARE_TYPE_PUBLIC_LINK = 3;

    const SHARE_PERMISSION_READONLY = 1;
    const SHARE_PERMISSION_UPDATE = 2;
    const SHARE_PERMISSION_CREATE = 4;
    const SHARE_PERMISSION_DELETE = 8;
    const SHARE_PERMISSION_RESHARE = 16;
    const SHARE_PERMISSION_PRIVATE = 31;


    public function __construct($client, $debug = false)
    {
        $this->client = $client;
        $this->debug = $debug;
    }

    public function getAllShares()
    {
        $response = $this->getClient()->get(
            $this->getFileSharingRestUrl(),
            ['debug' => $this->debug]
        );

        $response = $response->getData();

        return $response;
    }

    public function getShare($shareId)
    {
        $response = $this->getClient()->get(
            "{$this->getFileSharingRestUrl()}/{$shareId}",
            ['debug' => $this->debug]
        );

        $data = $response->getData();
        if (!isset($data['element'])) {
            throw new Owncloud\ResponseException('No element on response');
        }

        return $data['element'];
    }

    public function createNewShare($path, $options)
    {
        $options['path'] = $path;
        $response = $this->getClient()->post(
            $this->getFileSharingRestUrl(),
            ['body' => $options, 'debug' => $this->debug]
        );

        return $response->getData();
    }

    public function deleteShare($shareId)
    {
        $response = $this->getClient()->delete(
            "{$this->getFileSharingRestUrl()}/{$shareId}",
            ['debug' => $this->debug]
        );
        return $response->getData();
    }

    public function setDebug($debug = true)
    {
        $this->debug = $debug;
    }

    public function setVersion($version)
    {
        $this->version = $version;
    }

    public function getVersion()
    {
        return $this->version;
    }

    private function getFileSharingRestUrl()
    {
        return "ocs/v1.php/apps/files_sharing/api/v{$this->version}/shares";
    }

    private function getClient()
    {
        if (!isset($this->client)) {
            throw new \Owncloud\ResponseException('The REST client is not set.');
        }
        return $this->client;
    }
}
