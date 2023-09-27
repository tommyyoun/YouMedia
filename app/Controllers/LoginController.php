<?php 
namespace App\Controllers;  
use App\Models\UserModel;
  
class LoginController extends BaseController
{
    /////////////////////////////////////////////////////
    // Define the Globle veriable within Controller class
    protected $title = 'Login';
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

    public function index()
    {
        helper(['form']);

        if (isset($_SESSION['']))
        {
            return view('dashboard/home', $this->data);
        }
        else {
            return view('login/login', $this->data);
        }
    } 
  
    public function loginAuth()
    {
        $session = session();
        $userModel = new UserModel();
        $email = $this->request->getVar('emailAddress');
        $password = $this->request->getVar('password');
        
        $data = $userModel->where('emailAddress', $email)->first();
        
        if($data){
            $pass = $data['password'];
            $authenticatePassword = password_verify($password, $pass);
            if($authenticatePassword){
                $ses_data = [
                    'id' => $data['id'],
                    'firstName' => $data['firstName'],
                    'lastName' => $data['lastName'],
                    'emailAddress' => $data['emailAddress'],
                    'isLoggedIn' => TRUE
                ];
                $session->set($ses_data);
                return redirect()->to('/dashboard/home');
            
            }else{
                $session->setFlashdata('msg', 'Password is incorrect.');
                return redirect()->to('/');
            }
        }else{
            $session->setFlashdata('msg', 'Email does not exist.');
            return redirect()->to('/');
        }
    }

    public function logout()
    {
        session_destroy();

        $data['loginStatus'] = 'Successfully logged out!';

        return view('login/login', $data);
    }
}