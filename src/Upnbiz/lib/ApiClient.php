<?php

namespace Upnbiz\lib;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;

/**
 * Class ApiClient
 * @package Evo\InvoicingApiClientBundle\Service
 */
class ApiClient
{
    CONST ENDPOINT_INVOICE = "invoices";

    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * @var string
     */
    private $api_base_uri;

    /**
     * ApiClient constructor.
     * @param $api_base_uri
     */
    public function __construct($api_base_uri)
    {
        $this->client = new Client();
        $this->api_base_uri = $api_base_uri;
    }

    /**
     * @return \Psr\Http\Message\StreamInterface
     */
    public function getInvoices()
    {
        $response = $this->client->request('GET', $this->api_base_uri . '/' . $this::ENDPOINT_INVOICE);

        return $response->getBody();
    }

    /**
     * @param $id
     * @return \Psr\Http\Message\StreamInterface
     */
    public function getInvoice($id)
    {
        $response = $this->client->request('GET', $this->api_base_uri . '/' . $this::ENDPOINT_INVOICE . '/' . $id);

        return $response->getBody();
    }

    /**
     * @param $json
     * @return \Psr\Http\Message\StreamInterface
     */
    public function createInvoice($json)
    {
        $response = $this->client->request('POST', $this->api_base_uri . '/' . $this::ENDPOINT_INVOICE, [
            'body' => $json,
        ]);

        return $response->getBody();
    }

    /**
     * @param $id
     * @param $json
     * @return \Psr\Http\Message\StreamInterface
     */
    public function updateInvoice($id, $json)
    {
        $response = $this->client->request('PATCH', $this->api_base_uri . '/' . $this::ENDPOINT_INVOICE . '/' . $id, [
            'body' => $json,
        ]);

        return $response->getBody();
    }

    /**
     * @param $id
     * @return \Psr\Http\Message\StreamInterface
     */
    public function deleteInvoice($id)
    {
        $response = $this->client->request('DELETE', $this->api_base_uri . '/' . $this::ENDPOINT_INVOICE . '/' . $id);

        return $response->getBody();
    }

    /**
     * @param $json
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function validateInvoice($json)
    {
        $response = $this->client->request('POST', $this->api_base_uri . '/' . $this::ENDPOINT_INVOICE, [
            'headers' => [
                'validate-only' => true,
            ],
            'body' => $json,
        ]);

        return $response;
    }
}