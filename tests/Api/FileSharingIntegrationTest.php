<?php

use GuzzleHttp\Client;
use GuzzleHttp\Subscriber\Mock;
use GuzzleHttp\Adapter\MockAdapter;
use GuzzleHttp\Adapter\TransactionInterface;
use GuzzleHttp\Message\Response;

use Owncloud\Api\FileSharing;

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
    public function testCreateNewShare()
    {
        $response = $this->_api->fileSharing()->createNewShare('test', ['shareType' => FileSharing::SHARE_TYPE_PUBLIC_LINK]);

        $this->assertArrayHasKey('id', $response);
        $this->assertArrayHasKey('url', $response);
        $this->assertArrayHasKey('token', $response);
        $this->assertCount(3, $response);
    }

    /**
     * @group internet
     * @expectedException        Owncloud\ResponseException
     */
    public function testCreateNewShareWithIncorrectDirectoryOrFileShouldFail()
    {
        $response = $this->_api->fileSharing()->createNewShare('non/existing/path', ['shareType' => FileSharing::SHARE_TYPE_PUBLIC_LINK]);
    }

    public function getShareIdForDelete()
    {
        $response = $this->_api->fileSharing()->createNewShare('test.txt', ['shareType' => FileSharing::SHARE_TYPE_PUBLIC_LINK]);
        return $response['id'];
    }

    /**
     * @group internet
     */
    public function testDeleteShare()
    {
        $shareId = $this->getShareIdForDelete();

        $response = $this->_api->fileSharing()->deleteShare($shareId);
        $this->assertCount(0, $response);
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
