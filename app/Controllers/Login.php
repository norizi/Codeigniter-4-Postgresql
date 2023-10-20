<?php

namespace App\Controllers; 
use CodeIgniter\Controller;
use CodeIgniter\HTTP\Request;
use App\Models\UserModel;

class Login extends Controller
{
     

    public function index()
    {
         
        echo view('login');
    } 
  
    public function loginAuth()
    {
        $session = session();
        $userModel = new UserModel();
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        
        $data = $userModel->where('email', $email)->first();
        
        if($data){
            $pass = $data['password'];
            $authenticatePassword = password_verify($password, $pass);
            if($authenticatePassword){
                $ses_data = [
                    'id' => $data['id'],
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'isLoggedIn' => TRUE
                ];
                $session->set($ses_data);
                return redirect()->to('user-index');
            
            }else{
                $session->setFlashdata('error', 'Password is incorrect.');
                return redirect()->to('login');
            }
        }else{
            $session->setFlashdata('error', 'Email does not exist.');
            return redirect()->to('login');
        }
    }

    function logout() {
		$session = session(); 
        $session->destroy();
        return redirect()->to('login');
    }


}
