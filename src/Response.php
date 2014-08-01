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
        $message = '';
        if ($this->getStatusCode() != '') {
            $message .= "Code: {$this->getStatusCode()} : ";
        }
        if ($this->getMessage() != '') {
            $message .= $this->getMessage();
        } else {
            return 'Not expected response from webservice';
        }
        return $message;
    }

    /**
     * Returns the response data.
     *
     * Before returning the data, checks if the response is ok, if it not, the throw Exception.
     */
    public function getData()
    {
        if (!$this->isOk()) {
            throw new ResponseException($this->getErrorMessage());
        }
        return $this->response['ocs']['data'];
    }

    public function getRaw()
    {
        return $this->response;
    }
}
