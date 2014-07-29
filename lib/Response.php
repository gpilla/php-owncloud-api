<?php

namespace Owncloud;

class Response
{

    private $response;

    public function __construct($response)
    {
        $this->response = $response;
    }

    public function isOk()
    {
        if ($this->getStatusCode() == 100) {
            return true;
        }
        return false;
    }

    public function getStatusCode()
    {
        if (isset($this->response['ocs'])) {
            return $this->response['ocs']['meta']['statuscode'];
        } else {
            return $this->response['statuscode'];
        }

    }

    public function getMessage()
    {
        if (isset($this->response['ocs'])) {
            return $this->response['ocs']['meta']['message'];
        } else {
            return $this->response['message'];
        }

    }

    public function getErrorMessage()
    {
        return "Code: {$this->getStatusCode()} : {$this->getMessage()}";
    }

    public function getData()
    {
        return $this->response['ocs']['data'];
    }

    public function getRaw()
    {
        return $this->response;
    }
}
