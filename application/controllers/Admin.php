<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	/**
	 * Index Page for this controller.
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
	public function index(){
		if($this->input->post()){
			$email = $this->input->post('email_id');
			$password = sha1($this->input->post('password'));
			
			$data = $this->db->get_where('users',array('email_id'=>$email, 'password'=>$password,'account_status'=>1,'role'=>"SUADMIN"))->result_array();
			
			if (count($data)>=1){
				$uid 		= $data[0]['id']; 
				$first_name = $data[0]['first_name'];
				$last_name  = $data[0]['last_name'];
				$email 		= $data[0]['email_id'];

				$this->session->set_userdata('admin_uid',$uid);
				$this->session->set_userdata('admin_first_name', $first_name);
				$this->session->set_userdata('admin_last_name', $last_name);
				$this->session->set_userdata('admin_email',$email);
			}
		}
		if($this->session->userdata['admin_uid']){
			$page_data['page_title'] = 'Dashboard';
			$page_data['page'] = 'dashboard';
			$this->load->view('admin/index',$page_data);
		}else{
			$page_data['page_title'] = 'Login Admin';
			
			$this->load->view('admin/login',$page_data);
		}
	}
	public function team($action, $id=false){
		switch($action){
			case "view":
				$team_data = $this->db->get("team")->result_array();
				$page_data['page_title'] = 'Our Team';
				$page_data['teams'] = $team_data;
				$page_data['page'] = 'team/view';
				$this->load->view('admin/index',$page_data);
			break;
			case "add":
				if ($this->input->post()){
					if ($_FILES['profile_photo']['name'] != ""){
						$upload_data = $this->do_upload(array('upload_path'=>'./uploads/teams/','name'=>'profile_photo'));
					}
					$data = array(
						"full_name" => $this->input->post('full_name'),
						"designation" => $this->input->post('designation'),
						"fb_link"	=> $this->input->post('fb_link'),
						"ln_link"	=> $this->input->post('ln_link'),
						"tw_link"	=> $this->input->post('tw_link'),
						"about_me"	=> $this->input->post('about_me'),
						"timestamp" => time(),
						"mod_timestamp" => time()
					);
					
					if (count($upload_data) >= 1 ){
						$data['profile_photo'] = "uploads/teams/".$upload_data['file_name'];
					}
					
					if ($this->db->insert('team',$data)){
						$page_data['message'] = "Successfully Created New Team Member";
					}else{
						$page_data['message'] = "Problem Occur while uploading the new team member.";
					}
					
				}
				
				$page_data['page_title'] = "Add Team";
				$page_data['page'] = "team/form";
				$page_data['action'] = "Add";
				$this->load->view('admin/index',$page_data);
			break;
			case "edit":
				if ($this->input->post()){
					
					if ($_FILES['profile_photo']['name'] != ""){
						$upload_data = $this->do_upload(array('upload_path'=>'./uploads/teams/','name'=>'profile_photo'));
					}
					$data = array(
						"full_name" => $this->input->post('full_name'),
						"designation" => $this->input->post('designation'),
						"fb_link"	=> $this->input->post('fb_link'),
						"ln_link"	=> $this->input->post('ln_link'),
						"tw_link"	=> $this->input->post('tw_link'),
						"about_me"	=> $this->input->post('about_me'),
						"mod_timestamp" => time()
					);
					
					if (count($upload_data) >= 1 ){
						$data['profile_photo'] = "uploads/teams/".$upload_data['file_name'];
					}
					$this->db->where('id',$id);
					$this->db->update('team',$data);
					
				}
				$team_data = $this->db->get_where('team',array('id'=>$id))->result_array();
				$page_data['team_data'] = $team_data;
				$page_data['page_title'] = "Edit Team";
				$page_data['page'] = "team/form";
				$page_data['action'] = "Edit";
				$this->load->view('admin/index',$page_data);
				break;
			case "delete":
				if ($id){
					$this->db->where('id',$id);
					$this->db->delete('team');
					redirect("admin/team");
				}	
			break;
			case "active":
					
			break;
			case "inactive":
					
			break;
		}
	}
	public function logout(){
		$this->session->sess_destroy();
		redirect('admin');
	}
	public function do_upload($data){
		$config['upload_path']          = $data['upload_path'];
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size']             = 100;
		$config['max_width']            = 1024;
		$config['max_height']           = 768;

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload($data['name'])){
			return false;
		}else{
			return $this->upload->data();	
		}
    }
}
