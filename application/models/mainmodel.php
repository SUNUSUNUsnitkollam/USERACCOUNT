<?php
class mainmodel extends CI_model
{
	

/**/


	//function for insertion of values into corresponding table

	public function rgstr($reg,$log)
	{

		$this->db->insert("log",$log);
		$loginid=$this->db->insert_id();
		$reg['loginid']=$loginid;
		$this->db->insert("register",$reg);
	}
		/* function for encrypting password*/
	
		public function encpswd($pass)
	{
		return password_hash($pass, PASSWORD_BCRYPT);
	}
		/* function for fetching appropriate password*/

	public function selepass($email,$pass)
	{
		$this->db->select('*');
		$this->db->from("log");
		$this->db->where("email",$email);
		$qry=$this->db->get()->row('password');
		return $this->verifypass($pass,$qry);
	}
		/* function for fetching details of a particular user using id*/

	public function getuser($id)
 	{
 		$this->db->select('*');
 		$this->db->from("log");
 		$this->db->where("id",$id);
 		return $this->db->get()->row();
 	}
 		/* fuction for getting id of particular user*/
 	public function getuserid($email)
	{
		$this->db->select('id');
		$this->db->from("log");
		$this->db->where("email",$email);
		return $this->db->get()->row('id');
	}
	public function verifypass($pass,$qry)
	{
		return password_verify($pass,$qry);
	}
	
	public function viewprofile($id)
	{
		$this->db->select('*');
		$qry=$this->db->join('log','register.loginid=log.id','inner');
		$qry=$this->db->where("register.loginid",$id);
		$qry=$this->db->get("register");
		return $qry;

	}
	public function update($reg,$b,$id)
	{
		$this->db->select('*');
		$qry=$this->db->where("loginid",$id);
		$this->db->join('login','login.id=register.loginid','inner');
		$qry=$this->db->update("register",$reg);
		$qry=$this->db->where("id",$id);
		$qry=$this->db->update("login",$b);
		return $qry;
	}
	public function singleselect()
		{
		$qry=$this->db->get("register");
		return $qry;
		}
		public function singledata($id)
	{
		$this->db->select('*');
		$this->db->where("id",$id);
		$qry=$this->db->get("register");
		return $qry;
	}
	public function fdelete($id)
		{
		$this->db->where("id",$id);
		$this->db->delete("register");
		
		}

		public function flightview()
	{
		$this->db->select('*');
		$this->db->join('log','log.id=register.loginid','inner');
		$qry=$this->db->get("register");
		return $qry;
	}
	public function viewt()
	{
		$this->db->select('*');
		$qry=$this->db->get("register");
		return $qry;
	}
	public function approve($id)
	{
		$this->db->set('status','1');
		$qry=$this->db->where("id",$id);
		$qry=$this->db->update("register");
		return $qry;
	}
	public function reject($id)
	{
		$this->db->set('status','2');
		$qry=$this->db->where("id",$id);
		$qry=$this->db->update("register");
		return $qry;
	}
	public function approvedet($id)
	{
		$this->db->set('status','1');
		$qry=$this->db->where("id",$id);
		$qry=$this->db->update("log");
		return $qry;
	}
	public function rejectdet($id)
	{
		$this->db->set('status','2');
		$qry=$this->db->where("id",$id);
		$qry=$this->db->update("log");
		return $qry;
	}
	/*public function studupdate($id)
	{
		$this->db->select('*');
		$qry=$this->db->join("stud",'stud.loginid=login.id','inner');
		$qry=$this->db->where("stud.loginid",$id);
		$qry=$this->db->get("login");

		return $qry;
	}*/
	public function viewdetails()
	{
		#select query for 1 table

		#join way1
		$this->db->select('*');
		$this->db->join('log','log.id=register.loginid','inner');
		$qry=$this->db->get('register');
		return $qry;

	}


	function is_email_available($email)  
      {  
           $this->db->where('email', $email);  
           $query = $this->db->get("log");  
           if($query->num_rows() > 0)  
           {  
                return true;  
           }  
           else  
           {  
                return false;  
           }  
      }  
      public function is_phno_available($phno)  
      {  
           $this->db->where('phno', $phno);  
           $query = $this->db->get("register");  
           if($query->num_rows() > 0)  
           {  
                return true;  
           }  
           else 
           {  
                return false;  
           }  
      }
      public function is_uname_available($uname)
       {  
           $this->db->where('username', $uname);  
           $query = $this->db->get("register");  
           if($query->num_rows() > 0)  
           {  
                return true;  
           }  
           else  
           {  
                return false;  
           }  
      }

	function fetch_pass($session_id)
			{
			$fetch_pass=$this->db->query("select * from register where id='$session_id'");
			$res=$fetch_pass->result();
			}
			function change_pass($session_id,$new_pass)
			{
			$this->db->join('log','log.id=register.loginid','inner');
			$update_pass=$this->db->query("UPDATE log set password='$new_pass'  where id='$session_id'");
			}


}
?>