<?php

namespace Owncloud;

class Api
{
    private $client;
    private $host;
    private $username;
    private $password;

    /**
     * @var array for additional curlSettings in \Sabre\DAV\Client 
     */
    private $fileManagementConfig;

    /**
     * @var Api\FileManagement
     */
    private $fileManagement;

    public function __construct($host, $username, $password, $config = array())
    {
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->fileManagementConfig = $config['fileManagementConfig'];
        $config['base_url'] = $host;
        $config['defaults']['auth'] = [$username, $password];
        $this->client = new Client($config);


    }

    public function fileSharing()
    {
        return new Api\FileSharing($this->client);
    }

    public function fileManagement(): Api\FileManagement
    {
        if($this->fileManagement){
            return $this->fileManagement;
        }
        return $this->fileManagement = new Api\FileManagement($this->host, $this->username, $this->password, $this->fileManagementConfig);

    }

    public function listContents(string $path): array
    {
        return $this->fileManagement()->listContents($path);
    }

    /**
     * @throws \League\Flysystem\FileNotFoundException
     */
    public function delete(string $filePath): bool
    {
        return $this->fileManagement()->delete($filePath);
    }

    public function getFileContent(string $filePath)
    {
        if($handler =  $this->fileManagement()->get($filePath)){
            return $handler->read();
        }
        return '';

    }

}
