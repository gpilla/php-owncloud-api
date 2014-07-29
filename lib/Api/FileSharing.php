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
        $response = $this->client->get(
            $this->getFileSharingRestUrl(),
            ['debug' => $this->debug]
        );
        if (!$response->isOk()) {
            throw new ResponseException($response->getErrorMessage());
        }

        return $response->getData();
    }

    public function getShare($shareId)
    {
        $response = $this->client->get(
            "{$this->getFileSharingRestUrl()}/{$shareId}",
            ['debug' => $this->debug]
        );
        if (!$response->isOk()) {
            throw new ResponseException($response->getErrorMessage());
        }

        return $response->getData();
    }

    public function createNewShare($path, $options)
    {
        $body = "path=$path";
        foreach($options as $option => $value) {
            $body .= "&{$option}={$value}";
        }
        $response = $this->client->post(
            $this->getFileSharingRestUrl(),
            ['body' => $body]
        );
        if (!$response->isOk()) {
            throw new ResponseException($response->getErrorMessage());
        }
        return $response->getData();
    }

    public function deleteShare($shareId)
    {
        $response = $this->client->delete(
            "{$this->getFileSharingRestUrl()}/{$shareId}",
            ['debug' => $this->debug]
        );
        if (!$response->isOk()) {
            throw new ResponseException($response->getErrorMessage());
        }
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

    private function getFileSharingRestUrl()
    {
        return "/ocs/v1.php/apps/files_sharing/api/v{$this->version}/shares";
    }
}
