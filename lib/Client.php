<?php

namespace Owncloud;

use Owncloud\Response;

class Client extends \GuzzleHttp\Client
{

    public function __construct($config = null)
    {
        $config['defaults']['query'] = ['format' => 'json'];
        parent::__construct($config);
    }

    public function get($uri = null, $headers = null, array $options = array())
    {
        $data = parent::get($uri, $headers, $options)->json();
        return new Response($data);
    }

    public function post($uri = null, array $options = array())
    {
        $data = parent::post($uri, $options)->json();
        return new Response($data);
    }

    public function delete($uri = null, array $options = array())
    {
        $data = parent::delete($uri, $options)->json();
        return new Response($data);
    }
}
