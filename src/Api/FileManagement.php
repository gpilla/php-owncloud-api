<?php

namespace Owncloud\Api;

/**
 * @author Gustavo Pilla <pilla.gustavo@gmail.com>
 */
class FileManagement extends \League\Flysystem\Filesystem
{

    public function __construct($host, $username, $password, $settings = array())
    {
        $settings['baseUri'] = $host;
        $settings['userName'] = $username;
        $settings['password'] = $password;

        $client = new \Sabre\DAV\Client($settings);
        $adapter = new \League\Flysystem\Adapter\WebDav($client, 'remote.php/webdav/');

        parent::__construct($adapter);
    }
}
