<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

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
		$page_data['page_title'] = 'Home Page';
		$page_data['page'] = 'home';
		$this->load->view('front/index',$page_data);
	}
	public function about_us(){
		$page_data['page_title'] = 'About Us';
		$page_data['page'] = 'about_us';
		$this->load->view('front/index',$page_data);
	}
	public function services(){
		$page_data['page_title'] = "Our Services";
		$page_data['page'] = "services";
		$this->load->view('front/index', $page_data);
	}
	public function portfolio(){
		$page_data['page_title'] = "Portfolio";
		$page_data['page'] = "portfolio";
		$this->load->view('front/index', $page_data);
	}
	public function team(){
		$page_data['page_title'] = "Our Team";
		$page_data['page'] = "team";
		$this->load->view('front/index', $page_data);
	}
	public function pricing(){
		$page_data['page_title'] = "Our Pricing";
		$page_data['page'] = "pricing";
		$this->load->view('front/index', $page_data);
	}
	public function contact_us(){
		$page_data['page_title'] = "Contact Us";
		$page_data['page'] = "contact_us";
		$this->load->view('front/index', $page_data);
	}
}
