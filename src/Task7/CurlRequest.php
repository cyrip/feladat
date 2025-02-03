<?php

declare(strict_types=1);

namespace Task\Task7;

use CurlHandle;

class CurlRequest
{
    private CurlHandle $ch;

    public function __construct(private string $url, private string $username, private string $password, private array $data)
    {
    }

    public function run(): string
    {
        printf("\nRun Task7 ...\n");
        $this->initCurl();
        return $this->sendRequest();
    }

    public function initCurl(): void
    {
        $this->ch = curl_init($this->url);
        curl_setopt_array($this->ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_HTTPAUTH => CURLAUTH_BASIC,
            CURLOPT_USERPWD => "{$this->username}:{$this->password}",
            CURLOPT_POST => true,
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
                'Accept: application/json'
            ],
            CURLOPT_HEADER => true,
        ]);

    }

    public function sendRequest(): string
    {
        $jsonData = json_encode($this->data);

        curl_setopt($this->ch, CURLOPT_POSTFIELDS, $jsonData);

        $response = curl_exec($this->ch);
        if (curl_errno($this->ch)) {
            throw new \Exception('cURL Error: ' . curl_error($this->ch));
        }

        $httpCode = curl_getinfo($this->ch, CURLINFO_HTTP_CODE);

        $responseJSON = [
            'status' => $httpCode >= 200 && $httpCode < 300 ? 'ok' : 'error',
            'data' => [
                json_decode($response, true)
            ],
        ];

        curl_close($this->ch);
        return $response;
    }
}
