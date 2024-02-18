<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class AuthController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        
        $this->userModel = new UserModel();
    }

    public function signup()
    {
        $validation = \Config\Services::validation();

        if ($this->request->getMethod() === 'post') {
            $validation->setRules([
                'full_name' => 'required|min_length[3]',
                'email' => 'required|valid_email|is_unique[users.email]',
                'password' => 'required|min_length[4]',
            ]);

            if ($validation->withRequest($this->request)->run()) {
                
                $userData = [
                    'full_name' => $this->request->getPost('full_name'),
                    'email' => $this->request->getPost('email'),
                    'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                ];

                // Save the user to the database
                $this->userModel->insert($userData);

                // Redirect to login view
                return redirect()->to('signin');
            }
        }

        return view('auth/signup_view', ['validation' => $validation]);
    }

    public function signin()
    {
        $validation = \Config\Services::validation();

        if ($this->request->getMethod() === 'post') {
            $validation->setRules([
                'email' => 'required|valid_email',
                'password' => 'required|min_length[4]',
            ]);

            if ($validation->withRequest($this->request)->run()) {
                
                $user = $this->userModel->where('email', $this->request->getPost('email'))->first();

                if ($user && password_verify($this->request->getPost('password'), $user['password'])) {
                    
                    $this->setUserSession($user);

                    // Redirect to the dashboard
                    return redirect()->to('/dashboard');
                }
            }
        }

        return view('auth/signin_view', ['validation' => $validation]);
    }

    private function setUserSession($user)
    {
        $session = session();
        $session->set('user_id', $user['id']);
        $session->set('email', $user['email']);
        $session->set('full_name', $user['full_name']);
    }
}
