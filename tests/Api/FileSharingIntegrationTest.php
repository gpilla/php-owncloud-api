<?php

use GuzzleHttp\Client;
use GuzzleHttp\Subscriber\Mock;
use GuzzleHttp\Adapter\MockAdapter;
use GuzzleHttp\Adapter\TransactionInterface;
use GuzzleHttp\Message\Response;

class FileSharingIntegrationTest extends PHPUnit_Framework_TestCase
{
    protected $_api;

    public function setUp()
    {
        $this->_api = new Owncloud\Api($_SERVER['owncloud_host'], [$_SERVER['owncloud_user'], $_SERVER['owncloud_password']]);
    }

    /**
     * @group internet
     */
    public function testDeleteShare()
    {
        $fileSharing = $this->_api->fileSharing();
        
        $response = $fileSharing->deleteShare(1);
    }

    /**
     * @group internet
     * @expectedException        Owncloud\ResponseException
     */
    public function testDeleteShareWithWrongShareIdShouldFail()
    {
        $fileSharing = $this->_api->fileSharing();

        $response = $fileSharing->deleteShare(10000);
    }
}
