<?php

use GuzzleHttp\Client;
use GuzzleHttp\Subscriber\Mock;
use GuzzleHttp\Adapter\MockAdapter;
use GuzzleHttp\Adapter\TransactionInterface;
use GuzzleHttp\Message\Response;

use Owncloud\Api\FileSharing;

/**
 * @coversDefaultClass Owncloud\Api\FileSharing
 */
class FileSharingIntegrationTest extends PHPUnit_Framework_TestCase
{
    protected $_api;

    public function setUp()
    {
        if ( getenv('owncloud_host') != '' ) {
          $this->_api = new Owncloud\Api(getenv('owncloud_host'), getenv('owncloud_user'), getenv('owncloud_password'));
        } else {
          $this->_api = new Owncloud\Api($_SERVER['owncloud_host'], $_SERVER['owncloud_user'], $_SERVER['owncloud_password']);
        }
        $this->_api->fileSharing()->setDebug(true);
    }

    public function createAndGetShareId($filename)
    {
        // In case of integration test, de file test.txt should existe in the root of the filesystem
        $response = $this->_api->fileSharing()->createNewShare($filename, ['shareType' => FileSharing::SHARE_TYPE_PUBLIC_LINK]);
        return $response['id'];
    }

    /**
     * @group internet
     * @covers                   Owncloud\Api\FileSharing::createNewShare
     */
    public function testCreateNewShare()
    {
        $filename = $this->getTestFilename();
        $response = $this->_api->fileSharing()->createNewShare($filename, ['shareType' => FileSharing::SHARE_TYPE_PUBLIC_LINK]);

        $this->assertArrayHasKey('id', $response);
        $this->assertArrayHasKey('url', $response);
        $this->assertArrayHasKey('token', $response);
        $this->assertCount(3, $response);
    }

    /**
     * @group internet
     * @covers                   Owncloud\Api\FileSharing::createNewShare
     * @expectedException        Owncloud\ResponseException
     */
    public function testCreateNewShareWithIncorrectDirectoryOrFileShouldFail()
    {
        $this->_api->fileSharing()->createNewShare('non/existing/path', ['shareType' => FileSharing::SHARE_TYPE_PUBLIC_LINK]);
    }

    /**
     * @group internet
     * @covers                   Owncloud\Api\FileSharing::getShare
     */
    public function testGetShare()
    {
        $filename = $this->getTestFilename();
        $shareId = $this->createAndGetShareId($filename);

        $response = $this->_api->fileSharing()->getShare($shareId);

        $this->assertArrayHasKey('id', $response);
        $this->assertArrayHasKey('path', $response);
        $this->assertArrayHasKey('token', $response);
        $this->assertArrayHasKey('item_type', $response);
    }

    /**
     * @group internet
     * @covers                   Owncloud\Api\FileSharing::getShare
     * @expectedException        Owncloud\ResponseException
     */
    public function testGetShareWithWrongShareIdShouldFail()
    {
        $this->_api->fileSharing()->getShare(0);
    }

    /**
     * @group internet
     * @covers                   Owncloud\Api\FileSharing::getAllShares
     */
    public function testGetAllShares()
    {
        $filename = $this->getTestFilename();
        $this->createAndGetShareId($filename); // We create at least one.

        $response = $this->_api->fileSharing()->getAllShares();

        $this->assertGreaterThan(0, count($response));
    }

    /**
     * @group internet
     * @covers                   Owncloud\Api\FileSharing::deleteShare
     */
    public function testDeleteShare()
    {
        $filename = $this->getTestFilename();
        $shareId = $this->createAndGetShareId($filename); // We create at least one.

        $response = $this->_api->fileSharing()->deleteShare($shareId);
        $this->assertCount(0, $response);
    }

    /**
     * @group internet
     * @covers                   Owncloud\Api\FileSharing::deleteShare
     * @expectedException        Owncloud\ResponseException
     */
    public function testDeleteShareWithWrongShareIdShouldFail()
    {
        $fileSharing = $this->_api->fileSharing();

        $response = $fileSharing->deleteShare(10000);
    }

    public function getTestFilename()
    {
        $filename = 'php-owncloud-api/existing_file.txt';
        return $filename;
    }
}
