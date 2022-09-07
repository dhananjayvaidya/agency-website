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
	public function portfolio($action='view', $id=false){
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
					echo "<pre>";
				print_r($_FILES);
				die();
					$tmp_media = $_FILES['media'];
					unset($_FILES['media']);
					$data = array(
						"cat_id"		=> $this->input->post('cat_id'),
						"project_name" 	=> $this->input->post("project_name"),
						"project_desc" 	=> $this->input->post("project_desc"),
						"client_name" 	=> $this->input->post("client_name"),
						"project_link" 	=> $this->input->post("project_link"),
						"project_date" 	=> $this->input->post("project_date"),
						"status" 		=> $this->input->post("status"),
						"timestamp" 	=> time(),
						"mod_timestamp" => time()
					);
					if ($this->db->insert('portfolios',$data)){
						$pid = $this->db->insert_id();
						for($x=0;$x<count($tmp_media['name']);$x++){
							$_FILES['media1'] = [
								"name" => $tmp_media['name'][$x],
								"tmp_name" => $tmp_media['tmp_name'][$x],
								"size" => $tmp_media['size'][$x],
								"error" => $tmp_media['error'][$x],
								"type" => $tmp_media['type'][$x]
							];
							$upload_data = $this->do_upload(array('upload_path'=>'./uploads/portfolio/','name'=>'media1'));
							print_r($upload_data);
							$media_data = [
								"pid"			=> $pid,
								"media_type"	=> "IMG",
								"media_content" => "uploads/portfolio/".$upload_data['file_name'],
								"status"		=> 1,
								"timestamp" 	=> time(),
								"mod_timestamp" => time()
							];
							$this->db->insert("portfolio_media",$media_data);
							unset($_FILES);
						}
						$page_data['message'] = "Successfully Created New Portfolio";
					}else{
						$page_data['message'] = "Problem Occur while uploading the new portfolio.";
					}
				}
				$categories = $this->db->get('portfolio_categories')->result_array();
				$page_data['page_title'] = "Add Team";
				$page_data['page'] = "portfolio/form";
				$page_data['action'] = "Add";
				$page_data['categories'] = $categories;
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
	public function portfolio_categories($action='view', $id=false){
		switch($action){
			case "view":
				$this->db->order_by('sort_order','asc');
				$portfolio_category_data = $this->db->get("portfolio_categories")->result_array();
				$page_data['page_title'] = 'Portfolio Categories';
				$page_data['portfolio_categories'] = $portfolio_category_data;
				$page_data['page'] = 'portfolio/category/view';
				$this->load->view('admin/index',$page_data);
			break;
			case "add":
				if ($this->input->post()){
					
					$data = array(
						"cat_name" 	=> $this->input->post('cat_name'),
						"status" 	=> $this->input->post('status'),
						"sort_order"=> $this->input->post('sort_order'),
						"timestamp" => time(),
						"mod_timestamp" => time()
					);
					
					if ($this->db->insert('portfolio_categories',$data)){
						$page_data['message'] = "Successfully Created New Portfolio Category";
					}else{
						$page_data['message'] = "Problem Occur while uploading the new portfolio category.";
					}
					
				}
				
				$page_data['page_title'] = "Add Portfolio Category";
				$page_data['page'] = "portfolio/category/form";
				$page_data['action'] = "Add";
				$this->load->view('admin/index',$page_data);
			break;
			case "edit":
				if ($this->input->post()){
					
					$data = array(
						"cat_name" 	=> $this->input->post('cat_name'),
						"status" 	=> $this->input->post('status'),
						"sort_order"=> $this->input->post('sort_order'),
						"mod_timestamp" => time()
					);
					$this->db->where('id',$id);
					if ($this->db->update('portfolio_categories',$data)){
						$page_data['message'] = "Successfully Updated Portfolio Category";
					}else{
						$page_data['message'] = "Problem Occur while updating the portfolio category.";
					}
					
				}
				$portfolio_category_data = $this->db->get_where('portfolio_categories',array('id'=>$id))->result_array();
				$page_data['portfolio_category_data'] = $portfolio_category_data;
				$page_data['page_title'] = "Edit Portfolio Category";
				$page_data['page'] = "portfolio/category/form";
				$page_data['action'] = "Edit";
				$this->load->view('admin/index',$page_data);
				break;
			case "delete":
				if ($id){
					$this->db->where('id',$id);
					$this->db->delete('portfolio_categories');
					redirect("admin/portfolio_categories");
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
