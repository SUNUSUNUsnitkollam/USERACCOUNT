<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class first extends CI_Controller {

	/**
	 * Index Page for= this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	/*
    }*/


	/****
	 *@function:regist
	 *@function:loading register form
	 *@author:Sunu Sukesan
	 *@link:http:'http://localhost/useraccount/first/regist'
	 *@date:02-03-2021
	****/
    public function regist()
	{

		$this->load->view('reg_form');
	}
	
	/****
	 *@function:registrationForm
	 *@function:inserting values
	 *@author:Sunu Sukesan
	 *@link:http:'http://localhost/useraccount/'
	 *@date:02-03-2021
	****/

		public function registrationForm()
	{

		$this->load->library('form_validation');
		$this->form_validation->set_rules("fname","firstname",'required');
		$this->form_validation->set_rules("lname","lastname",'required');
		$this->form_validation->set_rules("dob","dob",'required');
		$this->form_validation->set_rules("dis","district",'required');
		$this->form_validation->set_rules("address","address",'required');
		$this->form_validation->set_rules("phno","phonenumber",'required');
		$this->form_validation->set_rules("pin","pincode",'required');
		$this->form_validation->set_rules("uname","username",'required');
		$this->form_validation->set_rules("email","email",'required');
		$this->form_validation->set_rules("password","password",'required');
		if($this->form_validation->run())
		{
		$this->load->model('mainmodel');
		$pass=$this->input->post("password");
		$encpass=$this->mainmodel->encpswd($pass);
		$reg=array("fname" => $this->input->post("fname"),
					"lname"=>$this->input->post("lname"),
					"dob"=>$this->input->post("dob"),
					"district"=>$this->input->post("dis"),
					"address"=>$this->input->post("address"),
					"phno"=>$this->input->post("phno"),
					"pin"=>$this->input->post("pin"),
					"username"=>$this->input->post("uname"));
		$log=array("email"=>$this->input->post("email"),
				"password"=>$encpass,
				"utype"=>'1');
		$this->mainmodel->rgstr($reg,$log);
		redirect(base_url().'first/regist');
		}
	}

	/*public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
    } 


    public function ajax_email_check()
    {
        $this->load->view('signup_check');
    }

    public function ajax_signup()
    {
        
        $this->form_validation->set_rules('email', 'Email','required|is_unique[users.email]');
        $this->form_validation->set_message('is_unique', 'The %s is already taken');
        if ($this->form_validation->run() == FALSE):
                echo 'The email is already taken.';          
        else :           
            unset($_POST);
            echo 'Available';
        endif;
    }*/
	
	/****
	 *@function:log
	 *@function:loading login page
	 *@author:Sunu Sukesan
	 *@link:http:'http://localhost/useraccount/'
	 *@date:02-03-2021
	****/
    	public function log()
	{
		$this->load->view('login');
	}
	/****
	 *@function:login
	 *@function:function for checking user while login
	 *@author:Sunu Sukesan
	 *@link:http:'http://localhost/useraccount/'
	 *@date:02-03-2021
	****/

    public function login()
		{
		$this->load->library('form_validation');
		$this->form_validation->set_rules("email","email",'required');
		$this->form_validation->set_rules("password","password",'required');
		if($this->form_validation->run())
		 	{
				 		$this->load->model('mainmodel');
				 		$email=$this->input->post("email");
				 		$pass=$this->input->post("password");
				 		$rslt=$this->mainmodel->selepass($email,$pass);
		 		if($rslt)
		 		{
		 			$id=$this->mainmodel->getuserid($email);
		 			$user=$this->mainmodel->getuser($id);
		 			$this->load->library(array('session'));
				$this->session->set_userdata(array('id'=>(int)$user->id,
				'status'=>$user->status,'utype'=>$user->utype));
			if($_SESSION['status']=='1' && $_SESSION['utype']=='0')
			{
				redirect(base_url().'first/adminhome');
			}
			elseif($_SESSION['status']=='1' && $_SESSION['utype']=='1')
			{
				redirect(base_url().'first/userhomepage');
			}
			else
			{
				echo "YOU HAVE TO WAIT FOR ADMIN APPROVAL";
				


			}
		}
		else
		{
			echo "invalid user";
		}
	}
	else
	{
		redirect(base_url().'first/log');
	}
	
}


	/****
	 *@function:update
	 *@function:function for updating user details after login
	 *@author:Sunu Sukesan
	 *@link:http:'http://localhost/useraccount/'
	 *@date:02-03-2021
	****/
	public function update()
	{

		$reg=array("fname" => $this->input->post("fname"),
					"lname"=>$this->input->post("lname"),
					"dob"=>$this->input->post("dob"),
					"district"=>$this->input->post("dis"),
					"address"=>$this->input->post("address"),
					"phno"=>$this->input->post("phno"),
					"pin"=>$this->input->post("pin"),
					"username"=>$this->input->post("uname"));
		$b=array("email"=>$this->input->post("email"),'utype'=>'1');
		$this->load->model('mainmodel');
		$id=$this->uri->segment(3);
		$data['user_data']=$this->mainmodel->singledata($id);
		$this->mainmodel->singleselect();
		$this->load->view('userupdation',$data);
		if($this->input->post("update"))
		{
			$id=$this->session->id;
			$this->mainmodel->update($reg,$b,$id);
			redirect('first/viewuser','refresh');
		}
	}
	/****
	 *@function:viewuser
	 *@function:for viewing page for updation
	 *@author:Sunu Sukesan
	 *@link:http:'http://localhost/useraccount/'
	 *@date:02-03-2021
	****/
		public function viewuser()
	{
		$this->load->model('mainmodel');
		$id=$this->session->id;
		$data['user_data']=$this->mainmodel->viewprofile($id);
		$this->load->view('userupdation',$data);

	}
	
	/****
	 *@function:flightdelete
	 *@function:function for deleting flight details
	 *@author:Sunu Sukesan
	 *@link:http:'http://localhost/useraccount/'
	 *@date:02-03-2021
	****/
	public function flightdelete()
	{
		$id=$this->uri->segment(3);
		$this->load->model('mainmodel');
		$this->mainmodel->fdelete($id);
		redirect('first/flview','refresh');
	}
	/****
	 *@function:flview
	 *@function:function for viewing flight details
	 *@author:Sunu Sukesan
	 *@link:http:'http://localhost/useraccount/'
	 *@date:02-03-2021
	 *****/
	
	
	public function flview()
	{
		$this->load->model('mainmodel');
		$data['n']=$this->mainmodel->flightview();
		$this->load->view('userview',$data);
	}
	
	/****
	 *@function:approve
	 *@function:function for approving user
	 *@author:Sunu Sukesan
	 *@link:http:'http://localhost/useraccount/'
	 *@date:02-03-2021
	 *****/
	
	public function approve()
	{

		$this->load->model('mainmodel');
		$id=$this->uri->segment(3);
		$this->mainmodel->approve($id);
		redirect('first/viewar','refresh');
		
	}
	/****
	 *@function:reject
	 *@function:function for rejecting user
	 *@author:Sunu Sukesan
	 *@link:http:'http://localhost/useraccount/'
	 *@date:02-03-2021
	 *****/
	public function reject()
	{

		$this->load->model('mainmodel');
		$id=$this->uri->segment(3);
		$this->mainmodel->reject($id);
		redirect('first/viewar','refresh');
		
	}
	/****
	 *@function:login
	 *@function:fuction for viewing user updated page
	 *@author:Sunu Sukesan
	 *@link:http:'http://localhost/useraccount/'
	 *@date:02-03-2021
	 *****/
		
		public function viewar()
	{
		$this->load->model('mainmodel');
		$data['n']=$this->mainmodel->viewt();
		$this->load->view('viewar',$data);

	}
	
	/****
	 *@function:approvedetails
	 *@function:fuction for approving details
	 *@author:Sunu Sukesan
	 *@link:http:'http://localhost/useraccount/'
	 *@date:02-03-2021
	 *****/
	public function approvedetails()
	{

		$this->load->model('mainmodel');
		$id=$this->uri->segment(3);
		$this->mainmodel->approvedet($id);
		redirect('first/viewdetails','refresh');
		
	}
	/****
	 *@function:rejectdetails 
	 *@function:function for rejecting user
	 *@author:Sunu Sukesan
	 *@link:http:'http://localhost/useraccount/'
	 *@date:02-03-2021
	 *****/
	public function rejectdetails()
	{

		$this->load->model('mainmodel');
		$id=$this->uri->segment(3);
		$this->mainmodel->rejectdet($id);
		redirect('first/viewdetails','refresh');
		
	}
	/****
	 *@function:viewtdetails 
	 *@function:function for viewing user starts
	 *@author:Sunu Sukesan
	 *@link:http:'http://localhost/useraccount/'
	 *@date:02-03-2021
	 *****/
	public function viewdetails()
 	{ 
 	$this->load->model('mainmodel');
	$data['n']=$this->mainmodel->viewdetails();
	$this->load->view('userview',$data);

	}
	
	/****
	 *@function:email_availability 
	 *@function:function for checking email using ajax starts
	 *@author:Sunu Sukesan
	 *@link:http:'http://localhost/useraccount/'
	 *@date:02-03-2021
	 *****/
	public function email_availibility()  
      {  
      if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL))  

           {  
                echo '<label class="text-danger"><span class="glyphicon glyphicon-remove"></span> Invalid Email</span></label>';  
           }  
           else  
           {  
                $this->load->model("mainmodel");  
                if($this->mainmodel->is_email_available($_POST["email"]))  
                {  
                     echo '<label class="text-danger"><span class="glyphicon glyphicon-remove"></span> Email Already register</label>';  
                }  
                else  
                {  
                     echo '<label class="text-success"><span class="glyphicon glyphicon-ok"></span> </label>';  
                }  
           }  
       }

	/****
	 *@function:phn_availability
	 *@function:function for checking phno availability 
	 *@author:Sunu Sukesan
	 *@link:http:'http://localhost/useraccount/'
	 *@date:02-03-2021
	 *****/
       	public function phno_availability()
      {

                $this->load->model("mainmodel");  
                if($this->mainmodel->is_phno_available($_POST["phno"]))  
                {  
                     echo '<label class="text-danger"><span class="glyphicon glyphicon-remove"></span> Phone number Already register</label>';  
                }  
                else  
                {  
                     echo '<label class="text-success"><span class="glyphicon glyphicon-ok"></span> </label>';  
                }  
           }
		   /****
	 *@function:unmae availability
	 *@function:function for checking uname availability 
	 *@author:Sunu Sukesan
	 *@link:http:'http://localhost/useraccount/'
	 *@date:02-03-2021
	 *****/
      public function uname_availability()
      {

                $this->load->model("mainmodel");  
                if($this->mainmodel->is_uname_available($_POST["uname"]))  
                {  
                     echo '<label class="text-danger"><span class="glyphicon glyphicon-remove"></span> user name Already register</label>';  
                }  
                else  
                {  
                     echo '<label class="text-success"><span class="glyphicon glyphicon-ok"></span> </label>';  
                }  
           }
	/****
	 *@function:index
	 *@function:function for loading indexpage 
	 *@author:Sunu Sukesan
	 *@link:http:'http://localhost/useraccount/'
	 *@date:02-03-2021
	 *****/
           	public function index()
	{
		
		$this->load->view('index');
	}
	/****
	 *@function:adminhome
	 *@function:function for loadingadminpage 
	 *@author:Sunu Sukesan
	 *@link:http:'http://localhost/useraccount/'
	 *@date:02-03-2021
	 *****/
	public function adminhome()
	{
		
		$this->load->view('adminhome');
	}
	/****
	 *@function:userhome
	 *@function:function for loading userhome 
	 *@author:Sunu Sukesan
	 *@link:http:'http://localhost/useraccount/'
	 *@date:02-03-2021
	 *****/
	public function userhome()
	{
		
		$this->load->view('userhomepage');
	}
	/****
	 *@function:reset
	 *@function:function forresetting password 
	 *@author:Sunu Sukesan
	 *@link:http:'http://localhost/useraccount/'
	 *@date:02-03-2021
	 *****/
	public function reset()
	{
		
		$this->load->view('reset');
	}

	/****
	 *@function:resetpassword
	 *@function:function for resetting password  starts
	 *@author:Sunu Sukesan
	 *@link:http:'http://localhost/useraccount/'
	 *@date:02-03-2021
	 *****/

	public function resetpassword()
	{
	
		if($this->input->post('change_pass'))
		{	
			$old_pass=$this->input->post('old_pass');
			$new_pass=$this->input->post('new_pass');
			$confirm_pass=$this->input->post('confirm_pass');
			$session_id=$this->session->userdata('id');
			$que=$this->db->query("select * from log where id='$session_id'");
			$row=$que->row();
			$pass=$row->password;
			//$pas=$row->email;
			//echo "$pas"; 
			if((!strcmp($old_pass, $pass))&& (!strcmp($new_pass, $confirm_pass))){
				$this->mainmodel->change_pass($session_id,$new_pass);
				echo "Password changed successfully !";
				}
			    else{
					echo "You have entered a wrong password";
				}
		}
		$this->load->view('passwordreset');	
	}

		

	/****
	 *@function:fforget
	 *@function:function for loading   starts
	 *@author:Sunu Sukesan
	 *@link:http:'http://localhost/useraccount/'
	 *@date:02-03-2021
	 *****/

public function forget()
{
$this->load->view('reset');
}
/****
	 *@function:send
	 *@function:function for sending email  starts
	 *@author:Sunu Sukesan
	 *@link:http:'http://localhost/useraccount/'
	 *@date:02-03-2021
	 *****/
public function send()
{
    $to =  $this->input->post('from');  // User email pass here
    $subject = 'Welcome To Elevenstech';

    $from = 'amigosskrk@gmail.com';              // Pass here your mail id

    $emailContent = '<!DOCTYPE><html><head></head><body><table width="600px" style="border:1px solid #cccccc;margin: auto;border-spacing:0;"><tr><td style="background:#000000;padding-left:3%"><img src="http://elevenstechwebtutorials.com/assets/logo/logo.png" width="300px" vspace=10 /></td></tr>';
    $emailContent .='<tr><td style="height:20px"></td></tr>';


    $emailContent .= $this->input->post('message');  //   Post message available here


    $emailContent .='<tr><td style="height:20px"></td></tr>';
    $emailContent .= "<tr><td style='background:#000000;color: #999999;padding: 2%;text-align: center;font-size: 13px;'><p style='margin-top:1px;'><a href='http://elevenstechwebtutorials.com/' target='_blank' style='text-decoration:none;color: #60d2ff;'>www.elevenstechwebtutorials.com</a></p></td></tr></table></body></html>";
               


    $config['protocol']    = 'smtp';
    $config['smtp_host']    = 'ssl://smtp.gmail.com';
    $config['smtp_port']    = '465';
    $config['smtp_timeout'] = '60';

    $config['smtp_user']    = 'amigosskrk@gmail.com';    //Important
    $config['smtp_pass']    = 'amigos@123';  //Important

    $config['charset']    = 'utf-8';
    $config['newline']    = "\r\n";
    $config['mailtype'] = 'html'; // or html
    $config['validation'] = TRUE; // bool whether to validate email or not

     

    $this->email->initialize($config);
    $this->email->set_mailtype("html");
    $this->email->from($from);
    $this->email->to($to);
    $this->email->subject($subject);
    $this->email->message($emailContent);
    $this->email->send();

    $this->session->set_flashdata('msg',"Mail has been sent successfully");
    $this->session->set_flashdata('msg_class','alert-success');
    return redirect('first/forget');
}







}
