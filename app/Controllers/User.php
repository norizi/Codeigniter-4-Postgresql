<?php

namespace App\Controllers;
use App\Models\UserModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\Request;
use App\Libraries\MyLibrary;  //so we can easily load the custom library
use Faker\Factory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Ramsey\Uuid\Uuid;
use CodeIgniter\I18n\Time; 
 

class User extends BaseController
{
    

    public function index()
    {
        

        auditlog('List User');
        if (!session()->get('isLoggedIn'))
        {
            return redirect()
                ->to('login');
        }

        //$session = session(); 
        //echo "Hello : ".$session->get('name');
        //echo "Hello : ".$this->session->get('name');
        //$model = new UserModel();
        //$data['users'] = $users = $model->findAll(); 
       // $data['users'] = $this->UserModel->findAll(); 
       // Pagination
       //$perPage = 10; // Number of items per page
      // $currentPage = $this->request->getVar('page') ?? 1;
      // $users = $this->UserModel->paginate($perPage, 'group', $currentPage);

      $request = service('request');
      $searchData = $request->getGet(); // OR $this->request->getGet();

      $search = "";
      if (isset($searchData) && isset($searchData['search'])) {
          $search = $searchData['search'];
      }

      

      if ($search == '') {
          $paginateData = $this->UserModel->paginate(5);
      } else {
          $paginateData = $this->UserModel->select('*')
              ->orLike('name', $search)
              ->orLike('email', $search)    			
              ->paginate(5);
      }

      $data = [
          'users' => $paginateData,
          'numbering' => numbering($this->request->getGet('page_users'), 5),
          'pager' => $this->UserModel->pager,
          'search' => $search
      ];
      //$this->response->setHeader('X-Debug-Profile', '1');
         
       // return view('user/index', $data , ['cache' => 60]);
        //return view('user/index', $data, ['cache' => 60, 'cache_name' => 'user/index']);
        return view('user/index', $data);
    }

    public function datatable()
    {
        auditlog('Datatable');
     

      $data = [
          'auditlogs' => $this->AuditlogModel->findAll()
      ];
         
        return view('user/datatable', $data);
    }

    public function staff()
    {
        $data = [
            'staffs' => $this->StaffModel->paginate(10,'pager'),
            //'staffs' => $this->StaffModel->paginate(10),
            'pager' => $this->StaffModel->pager,
            'numbering'   => order_page_number($this->request->getVar('page_pager'), 10)
        ];
        return view('staff/index', $data);
       // return view('staff/index', $data, ['cache' => 60]);
    }

    public function create()
    {
        $data['act'] ='add'; 

        return view('user/form', $data);
    }

    public function store()
    {

         
        
        $rules = [
            'name' => 'required|min_length[3]',
            'email' => 'required|valid_email',
            'password' => 'required'
        ];
          
        if($this->validate($rules)){
            
           //$formModel = new FormModel();
            $data = [
                'name' => $this->request->getVar('name'),
                'email'  => $this->request->getVar('email'),
                //'password'  => $this->request->getVar('password'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT)
                
            ];
            $this->UserModel->save($data);
            session()->setFlashdata('success', 'Submitted Successfully!');
            return redirect()->to('/user-index');
            
        }else{
            $data['validation'] = $this->validator;
            $data['act'] ='add'; 
            session()->setFlashdata('error', 'Save not Successfully!');
            return view('user/form', $data);
             
        } 
        /*
        //Validation : app/Config/ Validation.php
        $data = [
            'name' => $this->request->getPost('name'),
            'email'    => $this->request->getPost('email'),
            'password' => $this->request->getPost('password'),
        ];
        $validation = \Config\Services::validation();
        if ($validation->run($data, 'userCreate')) {
            // Validation passed, process the data
            $data = [
                'name' => $this->request->getVar('name'),
                'email'  => $this->request->getVar('email'),
                'password'  => $this->request->getVar('password'),
            ];
            $this->UserModel->save($data);
        } else {
            // Validation failed, show errors
            $data['validation'] = $validation->getErrors();
            // Handle errors (e.g., display them to the user)
            session()->setFlashdata('error', 'Save not Successfully!');
            return view('user/form', $data);
        }
        */
    }

    public function edit($id)
    {
        $data['act'] ='edit';  
        $data['user'] = $this->UserModel->where('id', $id)->first();
        return view('user/form', $data);
    }

    public function update()
    {

         
        
        $rules = [
            'name' => 'required|min_length[3]',
            'email' => 'required|valid_email', 
        ];

        $id = $this->request->getVar('id');
          
        if($this->validate($rules)){
            
           //$formModel = new FormModel();
            $data = [
                'name' => $this->request->getVar('name'),
                'email'  => $this->request->getVar('email'), 
            ];            
            $this->UserModel->update($id, $data);
            session()->setFlashdata('success', 'Updated Successfully!');
            return redirect()->to('/user-index');
            
        }else{
            $data['validation'] = $this->validator;
            $data['act'] ='edit'; 
            $data['user'] = $this->UserModel->where('id', $id)->first();
            session()->setFlashdata('error', 'Updated not Successfully!');
            return view('user/form', $data);
             
        } 
        /*
        //Validation : app/Config/ Validation.php
        $data = [
            'name' => $this->request->getPost('name'),
            'email'    => $this->request->getPost('email'),
            'password' => $this->request->getPost('password'),
        ];
        $validation = \Config\Services::validation();
        if ($validation->run($data, 'userCreate')) {
            // Validation passed, process the data
            $data = [
                'name' => $this->request->getVar('name'),
                'email'  => $this->request->getVar('email'),
                'password'  => $this->request->getVar('password'),
            ];
            $this->UserModel->save($data);
        } else {
            // Validation failed, show errors
            $data['validation'] = $validation->getErrors();
            // Handle errors (e.g., display them to the user)
            session()->setFlashdata('error', 'Save not Successfully!');
            return view('user/form', $data);
        }
        */
    }


    public function delete($id)
    {

       

        $this->UserModel->where('id', $id)->delete();
        session()->setFlashdata('success', 'Deleted Successfully!');
        return redirect()->to( base_url('user-index') );
    }

    public function delete_form()    {
        $id = $this->request->getVar('id');
      
        $this->UserModel->where('id', $id)->delete();
        session()->setFlashdata('success', 'Deleted Successfully!');
        return redirect()->to( base_url('user-index') );
    }

    public function mylibrary()
    {
        $mine = new MyLibrary(); // loads and creates instance
        $data['hello'] = $mine->sayHi();
        return view('mylibrary', $data);
    }

    public function mpdf()
    {
        $mpdf = new \Mpdf\Mpdf();
		$html = view('mpdf',[]);
		$mpdf->WriteHTML($html);
		$this->response->setHeader('Content-Type', 'application/pdf');
		$mpdf->Output('mpdf.pdf','I'); // opens in browser
    }

    public function faker()
    {
        
        $faker = Factory::create();

        //echo $name = $faker->name;

        for ($i = 0; $i < 1000; $i++) {
           // echo $faker->name, "<br>";
           //echo $faker->words(3, true), "<br>";
           //echo $faker->country, "<br>";
           //echo $faker->randomElement(['Electronics', 'Clothing', 'Home', 'Sports']), "<br>";
           //echo $faker->city, "<br>";
           //echo $faker->numberBetween(1, 100), "<br>"; 
           echo $faker->date(), "<br>";
        }
    }

    public function spreadsheet()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Hello World !');
        $writer = new Xlsx($spreadsheet);
        $writer->save('excell/Spreadsheet.xlsx');
        session()->setFlashdata('success', 'Spreadsheet Successfully Generate!');
        return redirect()->to( base_url('user-index') );
    }

        
    public function users_toexcell() {
 
        $db      = \Config\Database::connect();
        $builder = $db->table('users');   
 
        $query = $builder->query("SELECT * FROM users");
 
        $users = $query->getResult();
       
        $fileName = 'users.xlsx';  
        $spreadsheet = new Spreadsheet();
 
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Id');
        $sheet->setCellValue('B1', 'Name');
        $sheet->setCellValue('C1', 'Email');      
        $rows = 2;
 
        foreach ($users as $val){
            $sheet->setCellValue('A' . $rows, $val['id']);
            $sheet->setCellValue('B' . $rows, $val['name']);
            $sheet->setCellValue('C' . $rows, $val['email']); 
            $rows++;
        } 
        $writer = new Xlsx($spreadsheet);
        $writer->save("excell/".$fileName);
        header("Content-Type: application/vnd.ms-excel");
        redirect(base_url()."/upload/".$fileName); 
    }
    public function uuid() {

        

        $uuid = Uuid::uuid4();
        echo $uuidString = $uuid->toString();

    }


    public function timedate() {

        

        echo $myTime = Time::now('Asia/Kuala_Lumpur', 'en_US');
        echo "<br>";
        echo $myTime = Time::yesterday('Asia/Kuala_Lumpur', 'en_US');
        echo "<br>";
        echo $myTime = Time::tomorrow('America/Chicago', 'en_US');
        echo "<br>";
        echo $today       = Time::createFromDate();     // Uses current year, month, and day
    }

    public function batch_processing() {

        $db      = \Config\Database::connect();

         
        $batchSize = 10;
        $customers = $db->table('staffs') 
        ->limit(100)
        ->get()
        ->getResult();

        $batchedStaffs = array_chunk($customers, $batchSize);
        return view('staff/batch_processing', ['batchedStaffs' => $batchedStaffs]);
    }

    public function nobatch_processing() {

        $db      = \Config\Database::connect();

         
        
        $customers = $db->table('staffs') 
        ->limit(100)
        ->get()
        ->getResult();

        
        return view('staff/nobatch_processing', ['batchedStaffs' => $customers]);
    }


    public function profile()
    {
        $id = session('id'); 
        $data['user'] = $this->UserModel->where('id', $id)->first();
        return view('user/profile', $data);
    }

    public function profile_update()
    {
        $file = $this->request->getFile('file');
        //print_r($file);
        $input = $this->validate([
            'file' => [
                 
                'mime_in[file,image/jpg,image/jpeg,image/png]',
                //'max_size[file,1024]',
            ]
        ]);
        
         
        if ($file->isValid() && !$file->hasMoved()) {

            if(!$input){
                //throw new \RuntimeException($file->getErrorString().'('.$file->getError().')');
                session()->setFlashdata('error', "Upload file Successfully.");
                return redirect()->to( base_url('profile') );
            }else{
                $newName = $file->getRandomName();
                $file->move(ROOTPATH . 'public/uploads', $newName);
                $data = [
                    'name' => $this->request->getVar('name'),
                    'photo' => $newName,
                    
                ];  
                $id = session('id'); 
                $this->UserModel->update($id, $data);
                session()->setFlashdata('success', 'Upload file Successfully.');
                return redirect()->to( base_url('profile') );
            }
            
           

        } else {
            $data = [
                'name' => $this->request->getVar('name'), 
                
            ];  
            $id = session('id'); 
            $this->UserModel->update($id, $data);

            //session()->setFlashdata('error', 'Upload file not Successfully');
            return redirect()->to( base_url('profile') );
        }

        

        
    }

    public function sendemail()
	{
		// initialize email setting from emailConfig function.
		$this->email->initialize(emailConfig());
		// Set sender email and name from .env file
		$this->email->setFrom(getenv('email_config_SMTPUser'), getenv('email_config_senderName'));
		// target email or receiver
		$this->email->setTo('norizi@gmail.com');
		// Email subject
		$this->email->setSubject('Reset Password');
		// Email message
        //$template = view("email");
		$this->email->setMessage('Testing the email class.');
        //$this->email->setMessage($template);
       // $this->email->setMailType('html'); 

		// make sure email is send
		if($this->email->send()){
			//echo 'Success!';
            session()->setFlashdata('success', 'Send Email Successfully.');
            return view('sendemail');
		}else {
			//echo 'failed';
            session()->setFlashdata('error', 'Send Email failed.');
            return view('sendemail');
		}
		
		// return view('welcome_message');
	}

	//--------------------------------------------------------------------

	/**
	 * Set email configuration from .env file
	 * getenv = get the the value of an environment variable (.env file)
	 */
	
 


    
 

}
