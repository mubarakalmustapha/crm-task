<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Controllers\Traits\ZohoControllerTrait;

class Dashboard extends Controller
{
    use ZohoControllerTrait;
    protected $taskModel;

    public function __construct()
    {
        $this->taskModel = model('TaskModel');
    }

    public function index()
    {
        try {
            $this->refreshApiKey();
            $tasks = $this->getZohoTasks();
        } catch (\Exception $e) {
            // Handle exception
            echo $e->getMessage();
            return;
        }

        

        // $tasks = [
        //     ['id' => 1, 'Name1' => 'Task 1', 'Countdown' => '2024-02-15', 'Status' => 'In Progress', 'start_date' => '2024-02-01', 'tags' => 'Tag1', 'Priority' => 'High'],
        //     ['id' => 2, 'Name1' => 'Task 2', 'Countdown' => '2024-02-18', 'Status' => 'To Do', 'start_date' => '2024-02-05', 'tags' => 'Tag3', 'Priority' => 'Medium'],
        //     ['id' => 3, 'Name1' => 'Task 3', 'Countdown' => '2024-02-10', 'Status' => 'Done', 'start_date' => '2024-02-10', 'tags' => 'Tag2', 'Priority' => 'Low'],
        //     ['id' => 4, 'Name1' => 'Task 4', 'Countdown' => '2024-02-05', 'Status' => 'Overdue', 'start_date' => '2024-01-30', 'tags' => 'Tag1', 'Priority' => 'High'],
        // ];

        return view('dashboard/index', ['tasks' => $tasks]);
    }

}

