<?php

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class GuzzleClient
{
    /**
     * @var Client
     */
    private Client $client;

    /**
     * GuzzleClient constructor.
     * @param string $url Base url
     */
    public function __construct(string $url)
    {

        $this->client = new Client(['base_uri' => $url]);
    }

    /**
     * @param string $url
     * @return string
     * @throws NotInitializedException Error indicating Guzzle client is not initialized
     * @throws UnsuccessfulRequestException Not 200-status http response
     */
    public function get(string $url): string
    {
        if (!$this->client) {
            throw new NotInitializedException();
        }
        try {
            $response = $this->client->get($url);
        } catch (GuzzleException $ex) {
            throw new UnsuccessfulRequestException($ex->getMessage());
        }
        if ($response->getStatusCode() !== 200) {
            throw new UnsuccessfulRequestException("Unsuccessfull request", $response->getStatusCode(),
                $response->getReasonPhrase());

        }
        return (string)$response->getBody();

    }

}