<?php

/**
 * @coversDefaultClass Owncloud\Api\FileManagement
 */
class FileManagementIntegrationTest extends PHPUnit_Framework_TestCase
{
    protected $_api;

    public function setUp()
    {
        if ( getenv('owncloud_host') != '' ) {
          $this->_api = new Owncloud\Api(getenv('owncloud_host'), getenv('owncloud_user'), getenv('owncloud_password'));
        } else {
          $this->_api = new Owncloud\Api($_SERVER['owncloud_host'], $_SERVER['owncloud_user'], $_SERVER['owncloud_password']);
        }
    }

    /**
     * @group internet
     * @covers                   Owncloud\Api\FileManagement::update
     */
    public function testRead()
    {
        $filename = $this->getTestFilename();
        $expected = 'Example random number :'.rand(0, 15000);

        $this->_api->fileManagement()->update($filename, $expected);
        $actual = $this->_api->fileManagement()->read($filename);

        $this->assertEquals($expected, $actual);
    }

    /**
     * @group internet
     * @covers                   Owncloud\Api\FileManagement::write
     */
    public function testWrite()
    {
        $filename = $this->getTestFilename();
        $expected = 'Example random number :'.rand(0, 15000);

        $this->_api->fileManagement()->write($filename, $expected);
        $actual = $this->_api->fileManagement()->read($filename);
        $this->assertEquals($expected, $actual);
    }

    /**
     * @group internet
     * @covers                   Owncloud\Api\FileManagement::update
     */
    public function testUpdate()
    {
        $filename = $this->getTestFilename();
        $expected = 'Example random number :'.rand(0, 15000);

        $this->_api->fileManagement()->update($filename, $expected);
        $actual = $this->_api->fileManagement()->read($filename);

        $this->assertEquals($expected, $actual);
    }

    public function getTestFilename()
    {
        $filename = 'php-owncloud-api/test_file_management.txt';
        return $filename;
    }
}
