<?php
namespace App\Controllers\Traits;

trait ZohoControllerTrait
{
    
    protected $apiKey = '1000.5fdaee62de437f709676829244a6ab24.aae64d59b61fabcba79f3231a0173308';

    protected function refreshApiKey()
    {
        $url = 'https://accounts.zoho.com/oauth/v2/token';
        $clientId = '1000.NMRBGXUBEAYN46XIYT80XARX7AKZQX';
        $clientSecret = '0b11e5ae794d79ad03b91c13ec7a198e02b314046e';
        $refreshToken = '1000.db4a9a538b3de8a2837115ce0c6559c8.2eb657b01619ba18badac823428eb319';

        $data = [
            'client_id' => $clientId,
            'client_secret' => $clientSecret,
            'refresh_token' => $refreshToken,
            'grant_type' => 'refresh_token',
        ];

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/x-www-form-urlencoded',
        ]);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            throw new \Exception('Curl error: ' . curl_error($ch));
        }

        curl_close($ch);

        $responseData = json_decode($response, true);

        if (isset($responseData['access_token'])) {
            // Update the protected apiKey property with the new access token
            $this->apiKey = $responseData['access_token'];

            // Return the new API key
            return $this->apiKey;
        } else {
            throw new \Exception('Error refreshing Zoho API key');
        }
    }
    

    protected function getZohoTasks()
    {
        $url = 'https://www.zohoapis.com/crm/v2/Tasks';

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Zoho-oauthtoken ' . $this->apiKey,
            'Content-Type: application/json',
        ]);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            throw new \Exception('Curl error: ' . curl_error($ch));
        }

        curl_close($ch);

        $responseData = json_decode($response, true);

        if (isset($responseData['data'])) {
            return $responseData['data'];
        } else {
            throw new \Exception('Error fetching Zoho CRM tasks');
        }
    }

    protected function getZohoAccounts()
    {
        $url = 'https://www.zohoapis.com/crm/v2/Accounts';

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Zoho-oauthtoken ' . $this->apiKey,
            'Content-Type: application/json',
        ]);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            throw new \Exception('Curl error: ' . curl_error($ch));
        }

        curl_close($ch);

        $responseData = json_decode($response, true);

        if (isset($responseData['data'])) {
            return $responseData['data'];
        } else {
            throw new \Exception('Error fetching Zoho CRM accounts');
        }
    }



    protected function sendZohoApiRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(["data" => [$data]]));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Zoho-oauthtoken ' . $this->apiKey,
            'Content-Type: application/json',
        ]);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            throw new \Exception('Curl error: ' . curl_error($ch));
        }

        curl_close($ch);

        return $response;
    }

}
