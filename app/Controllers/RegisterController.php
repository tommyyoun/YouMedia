<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class RegisterController extends BaseController {
    /////////////////////////////////////////////////////
    // Define the Globle veriable within Controller class
    protected $title = 'Register';
    protected $data = array();

    /////////////////////////////////////////////////////
    public function __construct() {
        $linkTags = array(
            'css' => array(
                'href' => 'public/css/home.css',
                'rel' => 'stylesheet',
                'type' => 'text/css'
            )
        );

        $this->data = array(
            'title' => $this->title,
            'linkTags' => $linkTags
        );
    }

    public function index() {
        helper('form');
        
        return view('login/register', $this->data);
    }

    public function register() {
        helper(['form']);

        // Create rules to handle user input error
        $rules = [
            'firstName' => 'required|min_length[2]|max_length[50]',
            'lastName' => 'required|min_length[2]|max_length[50]',
            'emailAddress' => 'required|min_length[4]|max_length[100]|valid_email|is_unique[users.emailAddress]',
            'password' => 'required|min_length[4]|max_length[50]',
            'confirmPassword' => 'matches[password]'
        ];

        // 
        if ($this->validate($rules)) {
            $userModel = new UserModel();
            $data = [
                'firstName' => $this->request->getVar('firstName'),
                'lastName' => $this->request->getVar('lastName'),
                'emailAddress' => $this->request->getVar('emailAddress'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT)
            ];
            $userModel->save($data);

            $data['loginStatus'] = 'Registration Complete!';

            return view('login/login', $data);
        } else {
            $data['validation'] = $this->validator;
            echo view('login/register', $data);
        }
    }
}
