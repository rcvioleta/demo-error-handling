<?php

namespace App\Http\Services;

use App\Exceptions\Custom\XeroValidationException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class XeroAccountService
{
    private const GET_CONTACTS_URL = 'https://api.xero.com/api.xro/2.0/Contacts';

    public function __construct(private Client $httpService)
    {
        //...
    }

    public function getAccounts()
    {
        $opts = [
            'headers' => [
                'Authorization' => 'Bearer TEST-ACCESS-TOKEN',
                'Content-Type' => 'application/json',
                'Xero-tenant-id' => 'TEST-TENANT-ID',
            ]
        ];

        try {
            $response = $this->httpService->get(self::GET_CONTACTS_URL, $opts);
            $data = json_decode($response->getBody(), true);

            return $data['Contacts'];
        } catch (ClientException $e) {
            throw new XeroValidationException(
                errorID: 'XERO_GET_ACCOUNTS_VALIDATION_ERROR',
                exception: $e
            );

            // report(new XeroValidationException(
            //     errorID: 'XERO_GET_ACCOUNTS_VALIDATION_ERROR',
            //     exception: $e
            // ));
        } catch (\Throwable $e) {
            throw new XeroValidationException(
                errorID: 'XERO_GET_ACCOUNTS_VALIDATION_ERROR',
                exception: $e
            );
        }
    }
}
