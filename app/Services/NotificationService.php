<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

/**
 * Class WebsocketService
 * @package App\Services
 */
class NotificationService
{
    public $host;

    public function __construct()
    {
        $this->host = rtrim(env('SNS_HOST'), '/') . '/';
        $this->headers = ['MTAuth' => env('SNS_TOKEN')];
    }

    /**
     * @param $params
     * @return string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getRequest($params)
    {
        $url = $this->host.'notify?event='.$params;
        $client = new Client();
        $request = new Request('GET', $url, $this->headers);
        try {
            $response = $client->send($request);
            return (string) $response->getBody();
        } catch (\GuzzleHttp\Exception\GuzzleException $error) {
            return $error;
        }    
    }
}
