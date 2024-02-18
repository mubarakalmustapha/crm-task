<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Controllers\Traits\ZohoControllerTrait;

class TaskController extends Controller
{
    protected $customerModel;
    protected $taskModel;

    use ZohoControllerTrait;

    public function __construct()
    {
        $this->taskModel = model('TaskModel');
        $this->customerModel = model('CustomerModel');
    }

    public function viewTasks()
    {
        try {
            $this->refreshApiKey();
            $tasks = $this->getZohoTasks();
            $customerModel = new \App\Models\CustomerModel();
            $customers = $customerModel->findAll();
        } catch (\Exception $e) {
            echo $e->getMessage();
            return;
        }

        // $data = [
        //     ['id' => 1, 'Name1' => 'Dummy Task 1', 'Status' => 'In Progress', 'Sla_Status' => '47hrs:21mins', 'Customers' => ['Customer X', 'customer'], 'tags' => 'TagA', 'Priority' => 'High'],
        //     ['id' => 2, 'Name1' => 'Dummy Task 2', 'Status' => 'To Do', 'Sla_Status' => '12hrs:45mins', 'Customers' => ['Customer X', 'customer'], 'tags' => 'TagB', 'Priority' => 'Medium'],
        //     ['id' => 3, 'Name1' => 'Dummy Task 3', 'Status' => 'Done', 'Sla_Status' => '5hrs:30mins', 'Customers' => ['Customer X', 'customer'], 'tags' => 'TagC', 'Priority' => 'Low'],
        //     ['id' => 4, 'Name1' => 'Dummy Task 4', 'Status' => 'Overdue', 'Sla_Status' => '60hrs:15mins', 'Customers' => ['Customer X', 'customer'], 'tags' => 'TagD', 'Priority' => 'High'],
        // ];
        
        return view('tasks/task', ['tasks' => $tasks, 'customers' => $customers]);
    }
    

    public function add()
    {
        $validation = \Config\Services::validation();
    
        if ($this->request->getMethod() === 'post') {
            $validation->setRules([
                'customers' => 'required|is_array',
                'taskName' => 'required',
                'hourlyRate' => 'required',
                'startDate' => 'required',
                'dueDate' => 'required',
                'priority' => 'required',
                'relatedTo' => 'required',
                'taskDescription' => 'required',
            ]);
    
            if ($validation->withRequest($this->request)->run()) {
                $taskData = $this->getTaskDataFromRequest();
                $this->taskModel->insert($taskData);
                
    
                try {
                    // Create Zoho task and save to local database
                    $zohoResponse =  $this->createZohoTask($taskData);

                    // check If zohoResponse is true 
                    if ($zohoResponse === true) {
                        return redirect()->to(base_url('dashboard/tasks/task'));

                    } else {
                        echo 'Error creating Zoho CRM task';
                    }
                    
                } catch (\Exception $e) {
                    log_message('error', $e->getMessage());
                }
            }
        }
    }
    
    protected function getTaskDataFromRequest()
    {
        return [
            'customers' => $this->request->getPost('customers'),
            'name' => $this->request->getPost('taskName'),
            'hourly_rate' => $this->request->getPost('hourlyRate'),
            'start_date' => $this->request->getPost('startDate'),
            'due_date' => $this->request->getPost('dueDate'),
            'priority' => $this->request->getPost('priority'),
            'related_to' => $this->request->getPost('relatedTo'),
            'task_description' => $this->request->getPost('taskDescription'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];
    }
    
    protected function createZohoTask(array $taskData)
    {
        $dataToSend = [
                'Subject' => 'Task',
                'Customers' => $taskData['customers'],
                'Name1' => $taskData['name'],
                'Hourly_Rate' => $taskData['hourly_rate'],
                'Start_date1' => '9th Jan 2023',
                'Target' => 'Test',
                'Due_date1' => $taskData['due_date'],
                'Priority' => $taskData['priority'],
                'Related_To' => $taskData['related_to'],
                'Sla_Status' => $taskData['start_date'],
                'Countdown' => '36hrs:21mins',
                'Description' => $taskData['task_description'],
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
                $response = $this->sendZohoApiRequest('https://www.zohoapis.com/crm/v2/Tasks', $dataToSend);
        
                
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
