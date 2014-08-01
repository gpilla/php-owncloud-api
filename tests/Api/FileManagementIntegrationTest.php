<?php

/**
 * @coversDefaultClass Owncloud\Api\FileManagement
 */
class FileManagementIntegrationTest extends PHPUnit_Framework_TestCase
{
    protected $_api;

    public function setUp()
    {
        $this->_api = new Owncloud\Api($_SERVER['owncloud_host'], $_SERVER['owncloud_user'], $_SERVER['owncloud_password']);
    }

    /**
     * @group internet
     * @covers                   Owncloud\Api\FileManagement::update
     */
    public function testRead()
    {
        $this->_api->fileManagement()->update('test/lalala.txt', 'Ejemplo');
        $actual = $this->_api->fileManagement()->read('test/lalala.txt');
        $this->assertEquals('Ejemplo', $actual);
    }

    /**
     * @group internet
     * @covers                   Owncloud\Api\FileManagement::write
     */
    /*public function testWrite()
    {
        $expected = 'Example random number :'.rand(0, 15000);

        $this->_api->fileManagement()->write('test/file.txt', $expected);
        $actual = $this->_api->fileManagement()->read('test/file.txt');
        $this->assertEquals($expected, $actual);
    }*/

    /**
     * @group internet
     * @covers                   Owncloud\Api\FileManagement::update
     */
    public function testUpdate()
    {
        $expected = 'Example random number :'.rand(0, 15000);
        $this->_api->fileManagement()->update('test/lalala.txt', $expected);

        $actual = $this->_api->fileManagement()->read('test/lalala.txt');
        $this->assertEquals($expected, $actual);
    }
}
