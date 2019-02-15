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
	private function upload_logo1color_image($img_path){
                $config['upload_path']          = './upload/logo_one_color';
                //$config['allowed_types']        = 'gif|jpg|jpeg|png';
                $config['allowed_types']        = '*';
                $config['max_size']             = 2048000;
                $config['max_width']            = 10241;
                $config['max_height']           = 7681;

                $this->load->library('upload', $config);
				$this->upload->initialize($config);
                if ( ! $this->upload->do_upload($img_path))
                {
				   $upload_data[] =  $this->upload->display_errors();
				   return false;
                }
                else
                {
                        $upload_data[] = $this->upload->data();


                }
				return $upload_data;
    }
		private function upload_logo2color_image($img_path){
                $config['upload_path']          = './upload/logo_two_color';
                //$config['allowed_types']        = 'gif|jpg|jpeg|png';
                $config['allowed_types']        = '*';
                $config['max_size']             = 2048000;
                $config['max_width']            = 10241;
                $config['max_height']           = 7681;

                $this->load->library('upload', $config);
				$this->upload->initialize($config);
                if ( ! $this->upload->do_upload($img_path))
                {
				   $upload_data[] =  $this->upload->display_errors();
				   return false;
                }
                else
                {
                        $upload_data[] = $this->upload->data();


                }
				return $upload_data;
    }
	function remove() {
	$rowid = $this->input->post('rowid');
	// Check rowid value.
	if ($rowid==="all"){
	// Destroy data which store in session.
		$this->cart->destroy();
	}else{
	// Destroy selected rowid in session.
	$data = array(
			'rowid' => $rowid,
			'qty' => 0
			);
	// Update cart data, after cancel.
	$this->cart->update($data);
	}
	echo $fefe = count($this->cart->contents());
	// This will show cancel data in cart.
	}




	function update_cart(){
	//Recieve post values,calcute them and update
	$rowid = $_POST['rowid'];
	$price = $_POST['price'];
	$amount = $price * $_POST['qty'];
	$qty = $_POST['qty'];

	$data = array(
		'rowid' => $rowid,
		'price' => $price,
		'amount' => $amount,
		'qty' => $qty
		);
	$this->cart->update($data);
	echo $data['amount'];
	}
	public function studio_checkout_thanks()
	{
		$data['main_content']='front/tpl_order_thank_you';
		$this->load->view('partial/template_inner', $data);  
	}
	//Calculate
	public function studio_calculate()
	{
            
			$Prc1=$this->input->post('Prc1');
			$Prc2=$this->input->post('Prc2');
			$Prc3=$this->input->post('Prc3');
			$Prc4=$this->input->post('Prc4');
			$Prc5=$this->input->post('Prc5');
			$Prc6=$this->input->post('Prc6');
			
			$Qty1=$this->input->post('Qty1');
			$Qty2=$this->input->post('Qty2');
			$Qty3=$this->input->post('Qty3');
			$Qty4=$this->input->post('Qty4');
			$Qty5=$this->input->post('Qty5');
			$Qty6=$this->input->post('Qty6');
			$Qty=$this->input->post('quant');
			if($Qty==$Qty1 || $Qty<=$Qty2-1){$price=$Prc1;}
			else if($Qty==$Qty2 || $Qty<=$Qty3-1){$price=$Prc2;}
			else if($Qty==$Qty3 || $Qty<=$Qty4-1){$price=$Prc3;}
			else if($Qty==$Qty4 || $Qty<=$Qty5-1){$price=$Prc4;}
			else if($Qty==$Qty5 || $Qty<=$Qty6-1){$price=$Prc5;}
			else{$price=$Prc6;}
		    $QtyTotal=$Qty*$price;
			if($this->input->post('select_imprint_color')!=""){$IMC=35;$colorcharge="0.40";}else{}
			if($this->input->post('select_logo_color')==1){$IMC=35;$colorcharge="0.40";}
			else if($this->input->post('select_logo_color')==2){$IMC=70;$colorcharge="0.80";}
			else if($this->input->post('select_logo_color')==3){$IMC=105;$colorcharge="1.2";}
			else if($this->input->post('select_logo_color')==4){$IMC=140;$colorcharge="1.6";}
			else if($this->input->post('select_logo_color')==5){$IMC=175;$colorcharge="2";}
			else{}
		    $total=$QtyTotal+$IMC+$colorcharge;
		    echo "Total Price: ".'$'.$total;
 
	}
	public function studio_calculate2()
	{
            
			$Prc1=$this->input->post('Prc1');
			$Prc2=$this->input->post('Prc2');
			$Prc3=$this->input->post('Prc3');
			$Prc4=$this->input->post('Prc4');
			$Prc5=$this->input->post('Prc5');
			$Prc6=$this->input->post('Prc6');
			
			$Qty1=$this->input->post('Qty1');
			$Qty2=$this->input->post('Qty2');
			$Qty3=$this->input->post('Qty3');
			$Qty4=$this->input->post('Qty4');
			$Qty5=$this->input->post('Qty5');
			$Qty6=$this->input->post('Qty6');
			$Qty=$this->input->post('quant');
			if($Qty==$Qty1 || $Qty<=$Qty2-1){$price=$Prc1;}
			else if($Qty==$Qty2 || $Qty<=$Qty3-1){$price=$Prc2;}
			else if($Qty==$Qty3 || $Qty<=$Qty4-1){$price=$Prc3;}
			else if($Qty==$Qty4 || $Qty<=$Qty5-1){$price=$Prc4;}
			else if($Qty==$Qty5 || $Qty<=$Qty6-1){$price=$Prc5;}
			else{$price=$Prc6;}
		    $QtyTotal=$Qty*$price;
			$IMC=35;
		    $total=$QtyTotal+$IMC;
			echo "<div style='color:#f00'>One time logo plate charge: ".'$'.$IMC;
			echo "</div><br>";
		    echo "Total Price: ".'$'.$total;
 
	}
	//Calculate
	public function studio_cart()
	{
        if($this->input->server('REQUEST_METHOD') === 'POST')
        {	
			$logo_image_one_color = $this->upload_logo1color_image('logo1');
			$logo_image_two_color = $this->upload_logo2color_image('logo2');
			if(!empty($logo_image_one_color)){$IMC=35;
			//$data['logo_one_color_image']= base_url().'upload/logo_one_color/'.$logo_image_one_color[0]['logo1'];
			$logo_one_color_image1= base_url().'upload/logo_one_color/'.$logo_image_one_color[0]['file_name'];
			}else{$logo_one_color_image1="";}
		    if(!empty($logo_image_two_color)){
			//$data['logo_two_color_image']= base_url().'upload/logo_two_color/'.$logo_image_two_color[0]['logo2'];
			$logo_two_color_image2= base_url().'upload/logo_two_color/'.$logo_image_two_color[0]['file_name'];
			}else{$logo_two_color_image2="";}
			
			$Prc1=$this->input->post('Prc1');
			$Prc2=$this->input->post('Prc2');
			$Prc3=$this->input->post('Prc3');
			$Prc4=$this->input->post('Prc4');
			$Prc5=$this->input->post('Prc5');
			$Prc6=$this->input->post('Prc6');
			
			$Qty1=$this->input->post('Qty1');
			$Qty2=$this->input->post('Qty2');
			$Qty3=$this->input->post('Qty3');
			$Qty4=$this->input->post('Qty4');
			$Qty5=$this->input->post('Qty5');
			$Qty6=$this->input->post('Qty6');
			
			$Qty=$this->input->post('quant');
			if($Qty==$Qty1 || $Qty<=$Qty2-1){$price=$Prc1;}
			else if($Qty==$Qty2 || $Qty<=$Qty3-1){$price=$Prc2;}
			else if($Qty==$Qty3 || $Qty<=$Qty4-1){$price=$Prc3;}
			else if($Qty==$Qty4 || $Qty<=$Qty5-1){$price=$Prc4;}
			else if($Qty==$Qty5 || $Qty<=$Qty6-1){$price=$Prc5;}
			else{$price=$Prc6;}
			
			if($this->input->post('demo')!=""){$demo=$this->input->post('demo');}else{$demo='';}
		    $select_logo_color=$this->input->post('select_logo_color');
			//if($this->input->post('select_imprint_color')!=""){$IMC=35;$colorcharge="0.40";}else{}
			
			if($this->input->post('select_imprint_color2')!="" && $this->input->post('select_imprint_color3')!="" && $this->input->post('select_imprint_color4')!="" && $this->input->post('select_imprint_color5')!="" && $this->input->post('select_imprint_color6')!=""){$IMC=175; $colorcharge="2";}
			
			else if($this->input->post('select_imprint_color2')!="" && $this->input->post('select_imprint_color3')!="" && $this->input->post('select_imprint_color4')!="" && $this->input->post('select_imprint_color5')!="" && $this->input->post('select_imprint_color6')==""){$IMC=140;$colorcharge="1.6";}
			
			else if($this->input->post('select_imprint_color2')!="" && $this->input->post('select_imprint_color3')!="" && $this->input->post('select_imprint_color4')!="" && $this->input->post('select_imprint_color5')=="" && $this->input->post('select_imprint_color6')==""){ $IMC=105; $colorcharge="1.2";}
			
			else if($this->input->post('select_imprint_color2')!="" && $this->input->post('select_imprint_color3')!="" && $this->input->post('select_imprint_color4')=="" && $this->input->post('select_imprint_color5')=="" && $this->input->post('select_imprint_color6')==""){ $IMC=70; $colorcharge="0.8";}
			
			else if($this->input->post('select_imprint_color2')!="" && $this->input->post('select_imprint_color3')=="" && $this->input->post('select_imprint_color4')=="" && $this->input->post('select_imprint_color5')=="" && $this->input->post('select_imprint_color6')==""){ $IMC=35; $colorcharge="0.40";}
			
			else if($this->input->post('select_imprint_color2')=="" && $this->input->post('select_imprint_color3')!="" && $this->input->post('select_imprint_color4')=="" && $this->input->post('select_imprint_color5')=="" && $this->input->post('select_imprint_color6')==""){ $IMC=35; $colorcharge="0.40";}
			else if($this->input->post('select_imprint_color2')=="" && $this->input->post('select_imprint_color3')=="" && $this->input->post('select_imprint_color4')!="" && $this->input->post('select_imprint_color5')=="" && $this->input->post('select_imprint_color6')==""){ $IMC=35; $colorcharge="0.40";}
			
			
			/*else if($this->input->post('select_imprint_color2')!="" && $this->input->post('select_imprint_color3')==""){$IMC=35;$colorcharge="0.40";}
			else if($this->input->post('select_imprint_color2')=="" && $this->input->post('select_imprint_color3')!="" && $this->input->post('select_imprint_color4')==""){$IMC=35;$colorcharge="0.40";}
			else if($this->input->post('select_imprint_color2')=="" && $this->input->post('select_imprint_color3')=="" && $this->input->post('select_imprint_color4')!=""){$IMC=35;$colorcharge="0.40";}*/
			else{}
			
			
			$insert_data = array(
					'id'=>$this->input->post('pid'),
					'name'=>$this->input->post('pname'),
					'price'=>$price,
					'image'=>$this->input->post('pimg'),
					'qty'=>$this->input->post('quant'),
					'productcolor'=>$this->input->post('productcolor'),
					'print_options'=>$this->input->post('print_options'),
					'logo_one_color_image'=>$logo_one_color_image1,
					'select_imprint_color'=>$this->input->post('select_imprint_color'),
					'pms'=>$this->input->post('pms'),
					'select_logo_color'=>$select_logo_color,
					'logo_two_color_image'=>$logo_two_color_image2,
					'select_imprint_color2'=>$this->input->post('select_imprint_color2'),
					'pms2'=>$this->input->post('pms2'),
					'select_imprint_color3'=>$this->input->post('select_imprint_color3'),
					'pms3'=>$this->input->post('pms3'),
					'select_imprint_color4'=>$this->input->post('select_imprint_color4'),
					'pms4'=>$this->input->post('pms4'),
					'select_imprint_color5'=>$this->input->post('select_imprint_color5'),
					'pms5'=>$this->input->post('pms5'),
					'select_imprint_color6'=>$this->input->post('select_imprint_color6'),
					'pms6'=>$this->input->post('pms6'),
					'TextImprint'=>$this->input->post('TextImprint'),
					'ImprintFont'=>$this->input->post('ImprintFont'),
					'ImprintColor'=>$this->input->post('ImprintColor'),
					'odate'=>$this->input->post('odate'),
					'note'=>$this->input->post('note'),
					'demo'=>$demo,
					'platecharge'=>$IMC,
					'colorcharge'=>$colorcharge
				);
				//echo "<pre>"; print_r($insert_data);exit;
	        //This function add items into cart.
	        $this->cart->insert($insert_data);
		    redirect('cart');
	
		}
		$data['cart']=$this->cart->contents();
		$data['main_content']='front/tpl_cart';
		$this->load->view('partial/template_inner', $data);  
	}
	public function studio_checkout()
	{        $this->load->library('authorize_net');
		    if ($this->input->server('REQUEST_METHOD') === 'POST')
            {
       		$this->form_validation->set_rules('shipping_fname', 'Shipping First Name', 'required');
            $this->form_validation->set_rules('shipping_lname', 'Shipping Last Name', 'required');
			$this->form_validation->set_rules('shipping_email', 'Email', 'required');
            $this->form_validation->set_rules('shipping_add', 'Shipping Address', 'required');
			$this->form_validation->set_rules('shipping_city', 'Shipping City', 'required');
			$this->form_validation->set_rules('shipping_state', 'Shipping State', 'required');
			$this->form_validation->set_rules('shipping_zipcode', 'Shipping Postcode', 'required');
			$this->form_validation->set_rules('shipping_phone', 'Shipping Phone Number ', 'required|regex_match[/^[0-9]{10}$/]'); 
            $this->form_validation->set_rules('billing_fname', 'Billing First Name', 'required');
            $this->form_validation->set_rules('billing_lname', 'Billing Last Name', 'required');
			$this->form_validation->set_rules('billing_email', 'Billing Email', 'required');
            $this->form_validation->set_rules('billing_add', 'Billing Address', 'required');
			$this->form_validation->set_rules('billing_city', 'Billing City', 'required');
			$this->form_validation->set_rules('billing_state', 'Billing State', 'required');
			$this->form_validation->set_rules('billing_zipcode', 'Billing Postcode', 'required');
			$this->form_validation->set_rules('billing_phone', 'Billing Phone Number ', 'required|regex_match[/^[0-9]{10}$/]');
			$created_at = date('Y-m-d H:i:s');
			if ($this->form_validation->run())
            {
				$store_customer_data = array(
						'firstname'=> $this->input->post('shipping_fname'),
						'lastname'=> $this->input->post('shipping_lname'),
						'email'=> $this->input->post('shipping_email'),
						'telephone'=> $this->input->post('shipping_phone'),
						//'password'=> $this->__encrip_password($this->input->post('password')),
						'shipping_firstname'=> $this->input->post('shipping_fname'),
						'shipping_lastname'=> $this->input->post('shipping_lname'),
						'shipping_address_1'=> $this->input->post('shipping_add'),
						'shipping_address_2'=> $this->input->post('shipping_add1'),
						'shipping_city'=> $this->input->post('shipping_city'),
						'shipping_state'=> $this->input->post('shipping_state'),
						'shipping_postcode'=> $this->input->post('shipping_zipcode'),
						'shipping_country'=> $this->input->post('shipping_country'),
						'shipping_phone'=> $this->input->post('shipping_phone'),
						'payment_firstname'=> $this->input->post('billing_fname'),
						'payment_lastname'=> $this->input->post('billing_lname'),
						'payment_address_1'=> $this->input->post('billing_add'),
						'payment_address_2'=> $this->input->post('billing_add1'), 
						'payment_city'=> $this->input->post('billing_city'),
						'payment_state'=> $this->input->post('billing_state'),
						'payment_postcode'=> $this->input->post('billing_zipcode'),
						'payment_country'=> $this->input->post('billing_country'),
						'payment_phone'=> $this->input->post('billing_phone'),
						'date_added' => $created_at
				);
				// And store user information in database.
				$cust_id=$this->Home_model->store_customer_data($store_customer_data);
	            $order = array(
					'date' => date('Y-m-d'),
					'customerid' => $cust_id
	              );
	$ord_id=$this->Home_model->insert_order($order);
	if ($cart=$this->cart->contents()):
	foreach ($cart as $item):
	$charge=$item['platecharge']+$item['colorcharge'];
	$total=$item['subtotal']+$charge;
	$order_detail = array(
		'orderid' => $ord_id,
		'order_date'=>$item['odate'],
		'productid' => $item['id'],
		'quantity' => $item['qty'],
		'price' => $item['price'],
		'product_color'=>$item['productcolor'],
		'product_plate_charge'=>$item['platecharge'],
		'product_color_charge'=>$item['colorcharge'],
		'product_logo_one_color_image'=>$item['logo_one_color_image'],
		'product_logo_one_color'=>$item['select_imprint_color'],
		'product_pms'=>$item['pms'],
		'product_logo_two_color_image'=>$item['logo_two_color_image'],
		'no_of_colors'=>$item['select_logo_color'],
		'color1'=>$item['select_imprint_color2'],
		'pms1'=>$item['pms2'],
		'color2'=>$item['select_imprint_color3'],
		'pms2'=>$item['pms3'],
		'color3'=>$item['select_imprint_color4'],
		'pms3'=>$item['pms4'],
		'color4'=>$item['select_imprint_color5'],
		'pms4'=>$item['pms5'],
		'color5'=>$item['select_imprint_color6'],
		'pms5'=>$item['pms6'],
		'lanyard_logo'=>$item['demo'],
		'TextImprint'=>$item['TextImprint'],
		'ImprintFont'=>$item['ImprintFont'],
		'ImprintColor'=>$item['ImprintColor'],
		'order_note'=>$item['note'],
		'order_subtotal'=>$item['subtotal'],
		'order_total'=>$total
	);

	// Insert product information with order detail, store in cart also store in database.
	$cust_id = $this->Home_model->insert_order_detail($order_detail);
	endforeach;
	endif;

	$this->cart->destroy();
	redirect('checkout_thanks');
				$this->session->set_flashdata('message', '<strong>Success!</strong> Your order has been done successfully.We will contact you soon.');
				//redirect('shop');
			}
			
			
			}			
		$data['main_content'] = 'front/tpl_checkout';
		$this->load->view('partial/template_inner', $data);  
	}
	public function studio_shop()
	{
		$data_per_page = ($this->input->get('paged') !=0 || empty(! $this->input->get('paged')))? $this->input->get('paged') :'25';
		$sort=(empty(! $this->input->get('sort')))? $this->input->get('sort') :'asc';
		$config['per_page'] = $data_per_page;
        $config['base_url'] = base_url().'shop';
        $config['use_page_numbers'] = TRUE;
		$config['reuse_query_string'] = TRUE;
        $config['num_links'] = 8;
		$config['first_tag_open'] = '<li class="page_first">';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li class="page_last">';
		$config['last_tag_close'] = '</li>';
		$config['next_link'] = '>';
		$config['next_tag_open'] = '<li class="page_last1">';
		$config['next_tag_close'] = '</li>';
		$config['prev_link'] = '<';
		$config['prev_tag_open'] = '<li class="page_first1">';
		$config['prev_tag_close'] = '</li>';
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a>';
        $config['cur_tag_close'] = '</a></li>';
        $page = $this->uri->segment(2);
		$limit_end = ($page * $config['per_page']) - $config['per_page'];
        if ($limit_end < 0)
		{
			$limit_end = 0;
        }
		$data['all_products'] = $this->Home_model->get_all_shop_products($sort,$config['per_page'],$limit_end);
		$data['count_products_record']= $this->Home_model->count_product_records();
		$config['total_rows'] = $data['count_products_record'];
		$this->pagination->initialize($config);
		$data['main_content'] = 'front/tpl_shop_page';
		$this->load->view('partial/template_inner', $data);  
	}
	public function product_category()
	{
		$category_id = $this->uri->segment(2);
		$sort=(empty(! $this->input->get('sort')))? $this->input->get('sort') :'asc';	
		$data_per_page = ($this->input->get('paged') !=0 || empty(! $this->input->get('paged')))? $this->input->get('paged') :'25';
		$config['per_page'] = $data_per_page;
        $config['base_url'] = base_url().'product-category/'.$category_id.'/';
        $config['use_page_numbers'] = TRUE;
		$config['reuse_query_string'] = TRUE;
		$config["uri_segment"] = 3;
        $config['num_links'] = 20;
		$config['first_tag_open'] = '<li class="page_first">';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li class="page_last">';
		$config['last_tag_close'] = '</li>';
		$config['next_link'] = '';
		$config['next_tag_open'] = '<span class="nextlink">';
		$config['next_tag_close'] = '</span>';
		$config['prev_link'] = '';
		$config['prev_tag_open'] = '<span class="prevlink">';
		$config['prev_tag_close'] = '</span>';
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a>';
        $config['cur_tag_close'] = '</a></li>';
        $page = $this->uri->segment(3);
		$limit_end = ($page * $config['per_page']) - $config['per_page'];
        if ($limit_end < 0){
            $limit_end = 0;
        }
		$data['product_category_data'] = $this->Home_model->get_subcategory_by_id($category_id);

		//$data['all_cat_products'] = $this->Home_model->get_single_subcategory_all_products($category_id);
		$data['all_cat_products'] = $this->Home_model->get_single_subcategory_all_products($category_id,$sort,$config['per_page'],$limit_end);
		$data['count_products_record']= $this->Home_model->count_get_single_subcategory_all_products($category_id);
		$config['total_rows'] = $data['count_products_record'];
		$this->pagination->initialize($config); 
		
		$data['main_content'] = 'front/tpl_category_page';
		$this->load->view('partial/template_inner', $data);  
	}
	public function product_categry()
	{
		$category_id = $this->uri->segment(2);
        $sort=(empty(! $this->input->get('sort')))? $this->input->get('sort') :'asc';	
		$data_per_page = ($this->input->get('paged') !=0 || empty(! $this->input->get('paged')))? $this->input->get('paged') :'25';
		$config['per_page'] = $data_per_page;
        $config['base_url'] = base_url().'product-categry/'.$category_id.'/';
        $config['use_page_numbers'] = TRUE;
		$config['reuse_query_string'] = TRUE;
        $config['num_links'] = 20;
		$config["uri_segment"] = 3;
		$config['first_tag_open'] = '<li class="page_first">';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li class="page_last">';
		$config['last_tag_close'] = '</li>';
		$config['next_link'] = '';
		$config['next_tag_open'] = '<span class="nextlink">';
		$config['next_tag_close'] = '</span>';
		$config['prev_link'] = '';
		$config['prev_tag_open'] = '<span class="prevlink">';
		$config['prev_tag_close'] = '</span>';
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a>';
        $config['cur_tag_close'] = '</a></li>';
        $page = $this->uri->segment(3);
		$limit_end = ($page * $config['per_page']) - $config['per_page'];
        if ($limit_end < 0){
            $limit_end = 0;
        }
        $data['product_category_data'] = $this->Home_model->get_category_by_id($category_id);
		$data['all_cat_products'] = $this->Home_model->get_single_category_all_products($category_id,$sort,$config['per_page'],$limit_end);
		$data['count_products_record']= $this->Home_model->count_get_single_category_all_products($category_id);
		$config['total_rows'] = $data['count_products_record'];
		$this->pagination->initialize($config); 
	
		$data['main_content'] = 'front/tpl_maincategory_page';
		$this->load->view('partial/template_inner', $data);  
	}
	
	
   public function thank_you_page()
	{
		$data['main_content'] = 'front/tpl_thank_you';
		$this->load->view('partial/template', $data);  
	}
	public function clients_area()
	{
		$data['main_content'] = 'front/tpl_clients_area';
		$this->load->view('partial/template_inner', $data);  
	}
	public function faq_area()
	{
		$data['main_content'] = 'front/tpl_faq';
		$this->load->view('partial/template_inner', $data);  
	}
	public function studio_d()
	{
		$data['main_content'] = 'front/tpl_studio_d';
		$this->load->view('partial/template_inner', $data);  
	}
	public function all_categories()
	{
		$data['categories'] = $this->Home_model->get_all_sage_categories();
		$data['main_content'] = 'front/tpl_all_categories';
		$this->load->view('partial/template_inner', $data);  
	}
	public function custom_lanyards()
	{
		$data['main_content'] = 'front/tpl_csutom_lanyards_page';
		$this->load->view('partial/template_inner', $data);  
	}
	public function studio_polyester_lanyard()
	{
		$data['main_content'] = 'front/tpl_polyester_lanyard.php';
		$this->load->view('partial/template_inner', $data);  
	}
	####
	public function studio_mshop_asc()
	{
		$cat_id = $this->uri->segment(2);
		$config['per_page'] = 15;
        $config['base_url'] = base_url().'price_asc/'.$cat_id.'/';
        $config['use_page_numbers'] = TRUE;
		$config['reuse_query_string'] = TRUE;
        $config['num_links'] = 20;
		$config['next_link'] = '';
		$config['next_tag_open'] = '<span class="nextlink">';
		$config['next_tag_close'] = '</span>';
		$config['prev_link'] = '';
		$config['prev_tag_open'] = '<span class="prevlink">';
		$config['prev_tag_close'] = '</span>';
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a>';
        $config['cur_tag_close'] = '</a></li>';
		
        $page = $this->uri->segment(3);
		$limit_end = ($page * $config['per_page']) - $config['per_page'];
        if ($limit_end < 0){
            $limit_end = 0;
        }
		$data['all_products'] = $this->Home_model->get_all_shop_products_asc1($cat_id,$config['per_page'],$limit_end);
		$data['count_products_record']= $this->Home_model->count_product_records1($cat_id);
		$config['total_rows'] = $data['count_products_record'];
		$this->pagination->initialize($config);
		$data['main_content'] = 'front/tpl_shop_page';
		$this->load->view('partial/template_inner', $data);  
	}
	public function studio_mshop_desc()
	{
		$cat_id = $this->uri->segment(2);
		$config['per_page'] = 15;
        $config['base_url'] = base_url().'price_desc/'.$cat_id.'/';
        $config['use_page_numbers'] = TRUE;
		$config['reuse_query_string'] = TRUE;
        $config['num_links'] = 20;
		$config['next_link'] = '';
		$config['next_tag_open'] = '<span class="nextlink">';
		$config['next_tag_close'] = '</span>';
		$config['prev_link'] = '';
		$config['prev_tag_open'] = '<span class="prevlink">';
		$config['prev_tag_close'] = '</span>';
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a>';
        $config['cur_tag_close'] = '</a></li>';
		
        $page = $this->uri->segment(3);
		$limit_end = ($page * $config['per_page']) - $config['per_page'];
        if ($limit_end < 0){
            $limit_end = 0;
        }
		$data['all_products'] = $this->Home_model->get_all_shop_products_desc1($cat_id,$config['per_page'],$limit_end);
		$data['count_products_record']= $this->Home_model->count_product_records1($cat_id);
		$config['total_rows'] = $data['count_products_record'];
		$this->pagination->initialize($config);
		$data['main_content'] = 'front/tpl_shop_page';
		$this->load->view('partial/template_inner', $data);  
	}
	
	###
	public function studio_shop_asc()
	{
		$cat_id = $this->uri->segment(2);
		$data_per_page = ($this->input->get('paged') !=0 || empty(! $this->input->get('paged')))? $this->input->get('paged') :'25';
		$config['per_page'] = $data_per_page;
        $config['base_url'] = base_url().'price_range_asc/'.$cat_id.'/';
        $config['use_page_numbers'] = TRUE;
		$config['reuse_query_string'] = TRUE;
		$config["uri_segment"] = 3;
        $config['num_links'] = 20;
		$config['next_link'] = '';
		$config['next_tag_open'] = '<span class="nextlink">';
		$config['next_tag_close'] = '</span>';
		$config['prev_link'] = '';
		$config['prev_tag_open'] = '<span class="prevlink">';
		$config['prev_tag_close'] = '</span>';
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a>';
        $config['cur_tag_close'] = '</a></li>';
       
        $page = $this->uri->segment(3);
		$limit_end = ($page * $config['per_page']) - $config['per_page'];
        if ($limit_end < 0){
            $limit_end = 0;
        }
		$data['all_products'] = $this->Home_model->get_all_shop_products_asc($cat_id,$config['per_page'],$limit_end);
		$data['count_products_record']= $this->Home_model->count_product_records2($cat_id);
		$config['total_rows'] = $data['count_products_record'];
		$this->pagination->initialize($config);
		$data['main_content'] = 'front/tpl_shop_page';
		$this->load->view('partial/template_inner', $data);  
	}
	public function studio_shop_desc()
	{
		$cat_id = $this->uri->segment(2);
		$data_per_page = ($this->input->get('paged') !=0 || empty(! $this->input->get('paged')))? $this->input->get('paged') :'25';
		$config['per_page'] = $data_per_page;
        $config['base_url'] = base_url().'price_range_desc/'.$cat_id.'/';
        $config['use_page_numbers'] = TRUE;
		$config['reuse_query_string'] = TRUE;
        $config['num_links'] = 20;
		$config["uri_segment"] = 3;
		$config['next_link'] = '';
		$config['next_tag_open'] = '<span class="nextlink">';
		$config['next_tag_close'] = '</span>';
		$config['prev_link'] = '';
		$config['prev_tag_open'] = '<span class="prevlink">';
		$config['prev_tag_close'] = '</span>';
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a>';
        $config['cur_tag_close'] = '</a></li>';
       
        $page = $this->uri->segment(3);
		$limit_end = ($page * $config['per_page']) - $config['per_page'];
        if ($limit_end < 0){
            $limit_end = 0;
        }
		$data['all_products'] = $this->Home_model->get_all_shop_products_desc($cat_id,$config['per_page'],$limit_end);
		$data['count_products_record']= $this->Home_model->count_product_records2($cat_id);
		$config['total_rows'] = $data['count_products_record'];
		$this->pagination->initialize($config);
		$data['main_content'] = 'front/tpl_shop_page';
		$this->load->view('partial/template_inner', $data);  
	}



	
	public function studio_product_detail_page()
	{
		$page_id = $this->uri->segment(2);
		$data['product_data'] = $this->Home_model->get_page_by_id($page_id);
		
		$data['main_content'] = 'front/tpl_product_details_old';
		$this->load->view('partial/template_inner', $data);  
	}
	public function privacy_policy()
	{
		$data['main_content'] = 'front/tpl_privacy';
		$this->load->view('partial/template_inner', $data);  
	}
	public function returns_policy()
	{
		$data['main_content'] = 'front/tpl_returns_policy';
		$this->load->view('partial/template_inner', $data);  
	}

	public function contact_us()
	{
		if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            $this->form_validation->set_rules('fname', 'First Name', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required');
			 $this->form_validation->set_rules('phone', 'Phone', 'required');
            $this->form_validation->set_rules('subject', 'Subject', 'required');
            $this->form_validation->set_rules('message', 'Message', 'required');
            $this->form_validation->set_error_delimiters('<li>', '</li>');
            $created_at = date('Y-m-d H:i:s');
            if ($this->form_validation->run())
            {
			
				$htmlContent = '<html><body>';
				$htmlContent .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
				$htmlContent .= "<tr style='background: #eee;'><td><strong>First Name : </strong> </td><td>" . $this->input->post('fname'). "</td></tr>";
				$htmlContent .= "<tr><td><strong>Email : </strong> </td><td>" . $this->input->post('email')."</td></tr>";
				$htmlContent .= "<tr><td><strong>phone : </strong> </td><td>" . $this->input->post('phone')."</td></tr>";
				$htmlContent .= "<tr><td><strong>Subject : </strong> </td><td>" . $this->input->post('subject')."</td></tr>";
				$htmlContent .= "<tr><td><strong>Message : </strong> </td><td>" . $this->input->post('message')."</td></tr>";
				$htmlContent .="</table></body><//html>";
				$config['mailtype'] = 'html';
				/*$this->email->initialize($config);
				$this->email->to($this->config->item('admin_email'));
				$this->email->from($this->config->item('reply_email'),'Studio D Merchandise');
				$this->email->subject($this->input->post('subject'));
				$this->email->message($htmlContent);
				*/
				$to="alanchris27@gmail.com";
				$subject="Contact us | Studio D Merchandise";
			    $from = "Studio D Merchandise <info@demoforclients.com>";
			    $headers = "From: " . $from . "\r\n";
			    $headers .= "Reply-To: ". $from . "\r\n";
			    $headers .= "MIME-Version: 1.0\r\n";
			    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
				if(mail($to,$subject,$htmlContent,$headers)){
					$this->session->flashdata('message', 'Thank you for your message. It has been sent.');
					redirect('thank-you');
				}else{
					$this->session->flashdata('error', 'There was an error trying to send your message. Please try again later.');
				}
				/*if($this->email->send()){
					$this->session->flashdata('message', 'Thank you for your message. It has been sent.');
					redirect('contact');
                }else{
					$this->session->flashdata('error', 'There was an error trying to send your message. Please try again later.');
                }*/	
					
			}
               

        }
		$data['main_content'] = 'front/tpl_contact_us';
		$this->load->view('partial/template_inner', $data);  
	}
	public function studio_product_search()
	{
		$data_per_page = ($this->input->get('paged') !=0 || empty(! $this->input->get('paged')))? $this->input->get('paged') :'25';
		$config['per_page'] = $data_per_page;
        $config['base_url'] = base_url().'product-search';
        $config['use_page_numbers'] = TRUE;
		$config['reuse_query_string'] = TRUE;
        $config['num_links'] = 8;
		$config['first_tag_open'] = '<li class="page_first">';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li class="page_last">';
		$config['last_tag_close'] = '</li>';
		$config['next_link'] = '>';
		$config['next_tag_open'] = '<li class="page_last1">';
		$config['next_tag_close'] = '</li>';
		$config['prev_link'] = '<';
		$config['prev_tag_open'] = '<li class="page_first1">';
		$config['prev_tag_close'] = '</li>';
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a>';
        $config['cur_tag_close'] = '</a></li>';
        $page = $this->uri->segment(2);
		$limit_end = ($page * $config['per_page']) - $config['per_page'];
        if ($limit_end < 0)
		{
			$limit_end = 0;
        }
		$data['all_product_details'] = $this->Home_model->get_products_details($config['per_page'],$limit_end);
		$data['count_products_record']= $this->Home_model->count_search_product_records();
		$config['total_rows'] = $data['count_products_record'];
		$this->pagination->initialize($config);
		$data['main_content'] = 'front/tpl_search_shop';
		$this->load->view('partial/template_inner', $data);  
	}
	private function upload_featured_image($img_path){
                $config['upload_path']          = './upload/request-data';
               // $config['allowed_types']        = 'gif|jpg|jpeg|png';
				$config['allowed_types']		= '*';
                $config['max_size']             = 2048000;
                $config['max_width']            = 1024;
                $config['max_height']           = 768;

                $this->load->library('upload', $config);
				$this->upload->initialize($config);
                if ( ! $this->upload->do_upload($img_path))
                {
				   $upload_data[] =  $this->upload->display_errors();
					return false;
                }
                else
                {
                        $upload_data[] = $this->upload->data();

                }
				return $upload_data;
    }
	public function request_quote()
	{
		if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            $this->form_validation->set_rules('fname', 'First Name', 'required');
            $this->form_validation->set_rules('lname', 'last Name', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required');
			 $this->form_validation->set_rules('phone', 'Phone', 'required');
            $this->form_validation->set_rules('comment', 'Additional Comments / Details', 'required');
            $this->form_validation->set_error_delimiters('<li>', '</li>');
            $created_at = date('Y-m-d H:i:s');
			
            if ($this->form_validation->run())
            {
				
				$featured_image_array = $this->upload_featured_image('userpic');
				if(!empty($featured_image_array)):
				$uploadded_logo_image = base_url().'upload/request-data/'.$featured_image_array[0]['file_name'];
				else:
				$uploadded_logo_image='';
				endif;	
			
				$htmlContent = '<html><body>';
				$htmlContent .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
				$htmlContent .= "<tr style='background: #eee;'><td><strong>First Name : </strong> </td><td>" . $this->input->post('fname'). "</td></tr>";
				$htmlContent .= "<tr style='background: #eee;'><td><strong>last Name : </strong> </td><td>" . $this->input->post('lname'). "</td></tr>";
				$htmlContent .= "<tr><td><strong>Company Name : </strong> </td><td>" . $this->input->post('company_name')."</td></tr>";
				$htmlContent .= "<tr><td><strong>Email : </strong> </td><td>" . $this->input->post('email')."</td></tr>";
				$htmlContent .= "<tr><td><strong>phone : </strong> </td><td>" . $this->input->post('phone')."</td></tr>";
				$htmlContent .= "<tr><td><strong>What products are you interested in? : </strong> </td><td>" . $this->input->post('interested')."</td></tr>";
				$htmlContent .= "<tr><td><strong>How many would you like? : </strong> </td><td>" . $this->input->post('refer_like')."</td></tr>";
				$htmlContent .= "<tr><td><strong>Date Needed : </strong> </td><td>" . $this->input->post('date_need')."</td></tr>";
				$htmlContent .= "<tr><td><strong>How did you hear about us? : </strong> </td><td>" . $this->input->post('here_abt_us')."</td></tr>";
				$htmlContent .= "<tr><td><strong>Message : </strong> </td><td>" . $this->input->post('comment')."</td></tr>";
				$htmlContent .="</table></body><//html>";
				
				$to="alanchris27@gmail.com";
				$subject="Request Quote | Studio D Merchandise";
			    $from = "Studio D Merchandise <info@demoforclients.com>";
			    $headers = "From: " . $from . "\r\n";
			    $headers .= "Reply-To: ". $from . "\r\n";
			    $headers .= "MIME-Version: 1.0\r\n";
			    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
				if(mail($to,$subject,$htmlContent,$headers)){
					$this->session->flashdata('message', 'Thank you for your message. It has been sent.');
					redirect('thank-you');
				}else{
					$this->session->flashdata('error', 'There was an error trying to send your message. Please try again later.');
				}
				
				/*$config['mailtype'] = 'html';
				$this->email->initialize($config);
				$this->email->to($this->config->item('admin_email'));
				$this->email->from($this->config->item('reply_email'),'Studio D Merchandise');
				$this->email->subject($this->input->post('subject'));
				
				if(!empty($featured_image_array)):
					$this->email->attach($uploadded_logo_image);
				endif;
				
				$this->email->message($htmlContent);
				if($this->email->send()){
					$this->session->flashdata('message', 'Thank you for your message. It has been sent.');
					redirect('contact');
                }else{
					$this->session->flashdata('error', 'There was an error trying to send your message. Please try again later.');
                }*/	
					
			}  

        }
		$data['main_content'] = 'front/tpl_request_quote';
		$this->load->view('partial/template_inner', $data);  
	}
	public function cust_product()
	{
		if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            $this->form_validation->set_rules('fname', 'First Name', 'required');
            $this->form_validation->set_rules('lname', 'last Name', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required');
			 $this->form_validation->set_rules('phone', 'Phone', 'required');
            $this->form_validation->set_rules('comment', 'Additional Comments', 'required');
            $this->form_validation->set_error_delimiters('<li>', '</li>');
            $created_at = date('Y-m-d H:i:s');
			
            if ($this->form_validation->run())
            {
				
				$featured_image_array = $this->upload_featured_image('userpic');
				if(!empty($featured_image_array)):
				$uploadded_logo_image = base_url().'upload/request-data/'.$featured_image_array[0]['file_name'];
				else:
				$uploadded_logo_image='';
				endif;	
			
				$htmlContent = '<html><body>';
				$htmlContent .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
				$htmlContent .= "<tr style='background: #eee;'><td><strong>First Name : </strong> </td><td>" . $this->input->post('fname'). "</td></tr>";
				$htmlContent .= "<tr style='background: #eee;'><td><strong>last Name : </strong> </td><td>" . $this->input->post('lname'). "</td></tr>";
				$htmlContent .= "<tr><td><strong>Company Name : </strong> </td><td>" . $this->input->post('company_name')."</td></tr>";
				$htmlContent .= "<tr><td><strong>Email : </strong> </td><td>" . $this->input->post('email')."</td></tr>";
				$htmlContent .= "<tr><td><strong>phone : </strong> </td><td>" . $this->input->post('phone')."</td></tr>";
				$htmlContent .= "<tr><td><strong> What do you need ? : </strong> </td><td>" . $this->input->post('interested')."</td></tr>";
				$htmlContent .= "<tr><td><strong>How many ? : </strong> </td><td>" . $this->input->post('refer_like')."</td></tr>";
				$htmlContent .= "<tr><td><strong>Message : </strong> </td><td>" . $this->input->post('comment')."</td></tr>";
				$htmlContent .="</table></body><//html>";
				$to="alanchris27@gmail.com";
				$subject="Request Quote | Studio D Merchandise";
			    $from = "Studio D Merchandise <info@demoforclients.com>";
			    $headers = "From: " . $from . "\r\n";
			    $headers .= "Reply-To: ". $from . "\r\n";
			    $headers .= "MIME-Version: 1.0\r\n";
			    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
				if(mail($to,$subject,$htmlContent,$headers)){
					$this->session->flashdata('message', 'Thank you for your message. It has been sent.');
					redirect('thank-you');
				}else{
					$this->session->flashdata('error', 'There was an error trying to send your message. Please try again later.');
				}
				
				/*$config['mailtype'] = 'html';
				$this->email->initialize($config);
				$this->email->to($this->config->item('admin_email'));
				$this->email->from($this->config->item('reply_email'),'Studio D Merchandise');
				$this->email->subject($this->input->post('subject'));
				
				if(!empty($featured_image_array)):
					$this->email->attach($uploadded_logo_image);
				endif;
				
				$this->email->message($htmlContent);
				if($this->email->send()){
					$this->session->flashdata('message', 'Thank you for your message. It has been sent.');
					redirect('contact');
                }else{
					$this->session->flashdata('error', 'There was an error trying to send your message. Please try again later.');
                }*/	
					
			}  

        }
		$data['main_content'] = 'front/tpl_custom_product';
		$this->load->view('partial/template_inner', $data);  
	}

}
