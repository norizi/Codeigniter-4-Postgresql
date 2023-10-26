<?php

namespace App\Controllers; 
use CodeIgniter\Controller;
use CodeIgniter\HTTP\Request;
use App\Models\UserModel;
use App\Traits\RandomStringTrait;
// Import the necessary classes at the top of your controller or script
use CodeIgniter\HTTP\URI;
use \Mpdf\Mpdf;

class Login extends Controller
{
    use RandomStringTrait;

    public function index()
    {
         
        echo view('login');
    } 

    public function generatePdf() {
        $mpdf = new MPDF();
        $mpdf->WriteHTML('<h1>Hello, mPDF!</h1>');
        $mpdf->Output();
       //echo "a";
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

    function traits(){
         
        echo $randomString = $this->generateRandomString(8);
             
                            
 
    }

    function segment(){
        $uri = $this->request->uri;

        print_r($uri->getSegments()); // Array ( [0] => path [1] => to [2] => page ) 

        echo $uri->getScheme()."<br>"; // http 
        echo $uri->getAuthority()."<br>"; // snoopy:password@example.com:88 
        echo $uri->getUserInfo()."<br>"; // snoopy:password 
        echo $uri->getHost()."<br>"; // example.com 
        echo $uri->getPort()."<br>"; // 88 
        echo $uri->getPath()."<br>"; // /path/to/page 
        echo $uri->getRoutePath()."<br>"; // path/to/page 
        echo $uri->getQuery()."<br>"; // foo=bar&bar=baz 
        print_r($uri->getSegments())."<br>"; // Array ( [0] => path [1] => to [2] => page ) 
        echo $uri->getSegment(1)."<br>"; // path  
        echo $uri->getTotalSegments()."<br>"; // 3
        
         
            
             
                            
 
    }




}
