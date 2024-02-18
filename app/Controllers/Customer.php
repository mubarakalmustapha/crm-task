<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Controllers\Traits\ZohoControllerTrait;

class Customer extends Controller
{
    use ZohoControllerTrait;
    protected $customerModel;

    public function __construct()
    {
        $this->customerModel = model('CustomerModel');
    }

    public function index()
    {
        try {
            $this->refreshApiKey();
            $tasks = $this->getZohoAccounts();
        } catch (\Exception $e) {
            echo $e->getMessage();
            return;
        }

        return view('customers/summary', ['data' => $tasks]);

    }


    public function add()
    {
        $validation = \Config\Services::validation();
    
        if ($this->request->getMethod() === 'post') {
            $validation->setRules([
                'company' => 'required',
                'primaryEmail' => 'required|valid_email',
                'phoneNumber' => 'required',
                'city' => 'required',
                'state' => 'required',
                'zipCode' => 'required',
                'country' => 'required',
            ]);
    
            if ($validation->withRequest($this->request)->run()) {
                try {
                    $accountData = $this->getAccountDataFromRequest();
                    $this->customerModel->insert($accountData);
                    $zohoResponse = $this->createZohoAccount();
    
                    if ($zohoResponse === true) {
                        return redirect()->to(base_url('dashboard/customer/summary'));
                    } else {
                        echo 'Error creating Zoho CRM account';
                    }
                } catch (\Exception $e) {
                    echo $e->getMessage();
                }
            }
        }
    
    }
    
    protected function getAccountDataFromRequest()
    {
        return [
            'company_name' => $this->request->getPost('company'),
            'primary_email' => $this->request->getPost('primaryEmail'),
            'phone_number' => $this->request->getPost('phoneNumber'),
            'website' => $this->request->getPost('website'),
            'city' => $this->request->getPost('city'),
            'state' => $this->request->getPost('state'),
            'zipcode' => $this->request->getPost('zipCode'),
            'country' => $this->request->getPost('country'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];
    }
    protected function createZohoAccount()
    {
        $accountData = $this->getAccountDataFromRequest();
    
        $dataToSend = [
            "Account_Name" => "Mube",
            "Last_Name" => "Customer",
            'Company' => $accountData['company_name'],
            'Primary_Contact' => $accountData['phone_number'],
            'Primary_Email' => $accountData['primary_email'],
            'Phone' => $accountData['phone_number'],
            'Status' => "Active",
            'Website' => $accountData['website'],
            'City' => $accountData['city'],
            'State' => $accountData['state'],
            'Zipcode' => $accountData['zipcode'],
            'Country' => $accountData['country'],
            'Date_Created' => date('Y-m-d'),
            'trigger' => [
                "approval",
                "workflow",
                "blueprint",
                "pathfinder",
                "orchestration"
            ],
        ];
    
        try {
            $this->refreshApiKey();
            $response = $this->sendZohoApiRequest('https://www.zohoapis.com/crm/v2/Accounts', $dataToSend);
    
            
            $responseData = json_decode($response, true);
    
            // Check if the response status is success
            if (isset($responseData['data'][0]['code']) && $responseData['data'][0]['code'] === 'SUCCESS') {
                // Return true for success
                return true;
            } else {
                // Return false for failure
                return false;
            }
        } catch (\Exception $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
    

    
    
    
    
}
