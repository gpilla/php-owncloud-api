<?php

use GuzzleHttp\Client;
use GuzzleHttp\Subscriber\Mock;
use GuzzleHttp\Adapter\MockAdapter;
use GuzzleHttp\Adapter\TransactionInterface;
use GuzzleHttp\Message\Response;

class FileSharingTest extends PHPUnit_Framework_TestCase
{
    protected $_api;

    public function setUp()
    {
        $mockAdapter = new MockAdapter(function (TransactionInterface $trans) {
            // You have access to the request
            $request = $trans->getRequest();
            // Return a response
            return new Response(200);
        });

        $this->_api = new Owncloud\Api('http://demo.com', ['foo', 'bar'], ['adapter' => $mockAdapter]);
    }

    public function testDeleteShare()
    {
        $fileSharing = $this->_api->fileSharing();

        //$response = $fileSharing->deleteShare(1);
    }
}
