<?php

namespace Owncloud\Api;

use League\Flysystem\Adapter\WebDav;
use League\Flysystem\Filesystem;
use Sabre\DAV\Client;

/**
 * @author Gustavo Pilla <pilla.gustavo@gmail.com>
 */
class FileManagement extends Filesystem
{

    public function __construct($host, $username, $password, $settings = array())
    {
        $settings['baseUri'] = $host;
        $settings['userName'] = $username;
        $settings['password'] = $password;

        $client = new Client($settings);
        foreach($settings['curlSettings'] as $curlSettingName => $curlSettingValue) {
            $client->addCurlSetting($curlSettingName, $curlSettingValue);
        }
        $adapter = new WebDav($client, 'remote.php/webdav/');

        parent::__construct($adapter);
    }
}
