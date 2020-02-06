<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Home extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
		$this->load->model('Home_model');
    }
	public function index()
	{
		//$data['testimonials'] = $this->Home_model->get_all_testimonial();
		$data['lanyard_prds'] = $this->Home_model->homepage_lanyards_products(15);  // for Badge Reels
		$data['badge_reels'] = $this->Home_model->homepage_badge_reels_products(9);  // for Badge Reels
		$data['phone_accessories'] = $this->Home_model->homepage_phone_accessories_products(7);  // for Phone Accessories
		$data['drinkware_products'] = $this->Home_model->homepage_drinkware_products(3);  // for Drinkware Product
		$data['bags_products'] = $this->Home_model->homepage_bags_products(1);  // for bags products
		$data['pens_products'] = $this->Home_model->homepage_pens_products(2);  // for pens products
		$data['main_content'] = 'front/tpl_home';
		$this->load->view('partial/template', $data);  
	}

}
