<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Transactions extends MY_Controller {
	public function __construct()
	{
		parent::__construct();
		if ( ! $this->auth->signed_in())
			redirect();
		$this->load->model(array('pages_model','transaction_m'));
		$this->load->library('breadcrumb');
	}

	// **** display data list **** // 
	
	public function index()
	{
		$this->load->library('pagination');
		$this->load->model(array('product_m','lib'));
		$data['page'] = 'transactions';
		$data['subpage'] = 'transactions';
		$data['mainmenu'] = $this->pages_model->menu();
		$data['subpages'] = $this->pages_model->submenu2();
		
		if($this->input->post("search"))
		{
			$data['title'] = 'Orders Search';
			$data['breadc'] = $this->breadcrumb->show($data['title']);
			$data['order_all'] = $this->transaction_m->search_order();
		}
		else
		{
			$data['title'] = 'Orders';
			$data['breadc'] = $this->breadcrumb->show($data['title']);
			$table = 'order';
			$data['base_url'] = base_url().'transactions/transactions';
			$data['order_all'] = $this->transaction_m->get_order();
			$data['total_rows'] = $this->lib->count_all($table);
			$data['per_page'] = 5; 
			$this->pagination->initialize($data); 
		}
		$this->load->view('transactions_.php', $data);
	}
	function orders(){
		$this->load->library('pagination');
		$this->load->model(array('product_m','lib'));
		$data['page'] = 'transactions';
		$data['subpage'] = 'transactions';
		$data['mainmenu'] = $this->pages_model->menu();
		$data['subpages'] = $this->pages_model->submenu2();
		
		if($this->input->post("search"))
		{
			$data['title'] = 'Orders Search';
			$data['breadc'] = $this->breadcrumb->show($data['title']);
			$data['order_all'] = $this->transaction_m->search_order();
		}
		else
		{
			$data['title'] = 'Orders';
			$data['breadc'] = $this->breadcrumb->show($data['title']);
			$table = 'order';
			$data['base_url'] = base_url().'transactions/transactions';
			$data['order_all'] = $this->transaction_m->get_order();
			$data['total_rows'] = $this->lib->count_all($table);
			$data['per_page'] = 5; 
			$this->pagination->initialize($data); 
		}
		$this->load->view('transactions_.php', $data);
	}
	function information(){
		$data['dattr'] = '';
		$this->load->model('attribute_m');
		$data['title'] = 'Order List';
		$data['breadc'] = $this->breadcrumb->show($data['title']);
		$data['page'] = 'transactions';
		$data['subpage'] = 'transactions';
		$data['mainmenu'] = $this->pages_model->menu();
		$data['subpages'] = $this->pages_model->submenu();
		$data['subpages'] = $this->pages_model->submenu2();
		
		$data['customer_info'] = $this->transaction_m->get_select_orders();
		$data['order_info'] = $this->transaction_m->get_select_items();
		$data['shipping_addr'] = $this->transaction_m->get_other_shipping_address();

		$this->load->view('transactions_info', $data);
	}
	function customers(){
		$this->load->library('pagination');
		$this->load->model(array('product_m','lib'));
		$data['page'] = 'transactions';
		$data['subpage'] = 'transactions';
		$data['mainmenu'] = $this->pages_model->menu();
		$data['subpages'] = $this->pages_model->submenu2();
		
		
		if($this->input->post("search"))
		{
			$data['title'] = 'Customers Search';
			$data['breadc'] = $this->breadcrumb->show($data['title']);
			$data['order_all'] = $this->transaction_m->search_customers();
		}
		else
		{
			$data['title'] = 'Customers';
			$data['breadc'] = $this->breadcrumb->show($data['title']);
			$table = 'customer';
			$data['base_url'] = base_url().'transactions/customers';
			$data['order_all'] = $this->transaction_m->get_customers();
			$data['total_rows'] = $this->lib->count_all($table);
			$data['per_page'] = 7; 
			$this->pagination->initialize($data); 
		}
		$this->load->view('customers_.php', $data);
	}
	function customers_setup()
	{
		$data['title'] = 'Customers';
		$data['breadc'] = $this->breadcrumb->show($data['title']);
		$this->load->library('pagination');
		$this->load->model(array('product_m','lib'));
		$data['page'] = 'transactions';
		$data['subpage'] = 'transactions';
		$data['base_url'] = base_url().'transactions/product';
		if($this->uri->segment(3))
		{	
			$data['title'] = 'View Data Customers';
			$data['datacust'] = $this->transaction_m->get_select_customers();	
			$data['addr_history'] = $this->transaction_m->get_addr_history();	
			$data['trans_history'] = $this->transaction_m->get_trans_history();	
		}
		else
		{
			$data['title'] = 'Add New Customers';
		}
		$data['mainmenu'] = $this->pages_model->menu();
		$data['subpages'] = $this->pages_model->submenu2();

		$this->load->view('customers_edit.php', $data);
	}
	function shipping_area(){
		$data['dattr'] = '';
		$data['title'] = 'Shipping Area';
		$data['breadc'] = $this->breadcrumb->show($data['title']);
		$data['page'] = 'transactions';
		$data['subpage'] = 'transactions';
		$data['mainmenu'] = $this->pages_model->menu();
		$data['subpages'] = $this->pages_model->submenu2();
		
		$data['primattr'] = $this->transaction_m->get_all();
		if($this->uri->segment(3))
		{	
			$data['primattr_sel'] = $this->transaction_m->get_sub_all(); $data['dattr'] = $this->uri->segment(3);
		}
		$this->load->view('shipping_', $data);
	}
	function vouchers(){
		$this->load->library('pagination');
		$this->load->model(array('lib'));
		$data['dattr'] = '';
		$data['title'] = 'Vouchers';
		$data['breadc'] = $this->breadcrumb->show($data['title']);
		$data['page'] = 'transactions';
		$data['subpage'] = 'transactions';
		$data['mainmenu'] = $this->pages_model->menu();
		$data['subpages'] = $this->pages_model->submenu2();
		$data['total_vocer'] = $this->lib->count_all('voucher');
		$data['total_vocer_notuse'] = $this->transaction_m->count_not_use();
		$data['primattr'] = $this->transaction_m->get_all();
		$data['product_list'] = $this->transaction_m->get_list_product();
		if($this->uri->segment(3) == 'voucher_set')
		{	
			$data['voucher'] = $this->transaction_m->get_voucher_set(); 
			$data['dattr'] = $this->uri->segment(5);
			$table = 'voucher';
			$data['base_url'] = base_url().'transactions/Vouchers/voucher_set';
			$data['total_rows'] = $this->lib->count_all($table);
			$data['per_page'] = 4; 
			$data['uri_segment'] = 4;
			
			if($this->uri->segment(5))
			{
				$data['voucher_use'] = $this->transaction_m->get_voucher_use();
			}
		}
		if($this->uri->segment(3) == 'voucher_not_use')
		{
			$data['voucher_not_use'] = $this->transaction_m->get_voucher_not_use();
		}
		if($this->uri->segment(3) == 'use_voucher_code')
		{
			$data['konfigurasi_rator'] = $this->transaction_m->get_selected_voucher_use2();
			$data['voucher_not_use'] = $this->transaction_m->get_voucher_not_use();
			$data['cust'] = $this->transaction_m->get_customers2();
		}
		if($this->uri->segment(3) == 'code_setup')
		{
			if($this->uri->segment(7))
			{
				$data['konfigurasi'] = $this->transaction_m->get_selected_voucher_use();
			}
			else
			{
				$data['konfigurasi'] = $this->transaction_m->get_code_config();
			}
			$data['cust'] = $this->transaction_m->get_customers2();
			
		}
		$this->pagination->initialize($data); 
		$data['link'] = $this->pagination->create_links();
		$this->load->view('voucher_', $data);
	}
	function rewards(){	
		$this->load->model(array('lib'));
		$this->load->library('pagination');
		$data['page'] = 'transactions';
		$data['subpage'] = 'transactions';
		$data['mainmenu'] = $this->pages_model->menu();
		$data['subpages'] = $this->pages_model->submenu2();
		$data['total_rewards'] = $this->lib->count_all('reward_list');
		$data['title'] = 'Rewards';
		$data['breadc'] = $this->breadcrumb->show($data['title']);
		if($this->uri->segment(3) == 'view')
		{	
			$data['rewards'] = $this->transaction_m->get_rewards_set(); 
			$data['dattr'] = $this->uri->segment(5);
			$table = 'voucher';
			$data['base_url'] = base_url().'transactions/Vouchers/voucher_set';
			$data['total_rows'] = $this->lib->count_all($table);
			$data['per_page'] = 4; 
			$data['uri_segment'] = 4;
			
			if($this->uri->segment(5))
			{
				$data['rewards_use'] = $this->transaction_m->get_reward_use();
			}
		}
		else if($this->uri->segment(3) == 'customers')
		{
			$data['customer_rewards'] = $this->transaction_m->get_customer_rewards();
			$data['datcr'] = $this->uri->segment(5);
			if($this->uri->segment(5))
			{
				$data['customer_use'] = $this->transaction_m->get_customer_use();
			}	
		}
		else
		{
			$data['rewards'] = $this->transaction_m->get_rewards_set(); 
			$table = 'reward_setting';
			$data['base_url'] = base_url().'transactions/rewards';
			$data['total_rows'] = $this->lib->count_all($table);
			$data['per_page'] = 5; 
			$data['uri_segment'] = 3;
		}
		
		
		$this->pagination->initialize($data); 
		$data['link'] = $this->pagination->create_links();
		$this->load->view('rewards_', $data);
	}
	function bank_account(){
		$this->load->library('pagination');
		$this->load->model(array('product_m','lib'));
		
		$data['page'] = 'transactions';
		$data['subpage'] = 'transactions';
		$table = 'bank_account';
		
		$data['mainmenu'] = $this->pages_model->menu();
		$data['subpages'] = $this->pages_model->submenu2();

		if($this->uri->segment(4))
		{
			$data['title'] = 'Bank Account';
			$data['breadc'] = $this->breadcrumb->show($data['title']);
			$data['bank_selected'] = $this->transaction_m->get_selected_bank();
		}
		else
		{
			if($this->input->post("search"))
			{
				$data['title'] = 'Search Account';
				$data['breadc'] = $this->breadcrumb->show($data['title']);
				$data['bank_list'] = $this->transaction_m->search_bank();
			}
			else
			{
				$data['title'] = 'Bank Account';
				$data['breadc'] = $this->breadcrumb->show($data['title']);
				$data['base_url'] = base_url().'transactions/bank_account';
				$data['total_rows'] = $this->lib->count_all($table);
				$data['per_page'] = 5; 
				$data['bank_list'] = $this->transaction_m->get_bank();
				$this->pagination->initialize($data); 
			}
		}
		$this->load->view('bank_.php', $data);
	}
	// -------------------------- *** Edit Section *** -------------------------------//
	function customer_save(){
		if(($this->input->post("firstname")) AND ($this->input->post("email")))
		{
			if(!filter_var($this->input->post("email"), FILTER_VALIDATE_EMAIL)) 
			{
				$this->session->set_flashdata('error',"E-mail is not valid");
				redirect('transactions/customers_setup','refresh'); 
			} 
			else 
			{
				$this->transaction_m->customer_save();
				redirect('transactions/customers','refresh'); 
			}
		}
		else
		{
			if($this->input->post("id_customer"))
			{
				$this->session->set_flashdata('error',"Data you have entered is incorrect");
				redirect('transactions/customers','refresh'); 
			}
			else
			{
				$this->session->set_flashdata('error',"Data you have entered is incomplete");
				redirect('transactions/customers_setup','refresh'); 
			}
		}
	}
	function edit_date(){
		$this->transaction_m->edit_date();
		redirect('transactions/information/'.$this->input->post("idorder"),'refresh'); 
	}
	function edit_payment_info(){
		$this->transaction_m->edit_payment();
		redirect('transactions/information/'.$this->input->post("idorder"),'refresh'); 
	}
	function edit_shipping_info(){
		$this->transaction_m->edit_shipping();
		redirect('transactions/information/'.$this->input->post("idorder"),'refresh'); 
	}
	
	// -------------------------- *** Save Location --------------------------------//
	function save_region(){
		$this->transaction_m->region_save();
		redirect('transactions/shipping_area','refresh'); 
	}
	function edit_region(){
		$this->transaction_m->region_edit();
		redirect('transactions/shipping_area','refresh'); 
	}
	function save_location(){
		$this->transaction_m->location_save();
		redirect('transactions/shipping_area','refresh'); 
	}
	function edit_location(){
		$this->transaction_m->location_edit();
		redirect('transactions/shipping_area','refresh'); 
	}
	function location_enable(){
		$this->transaction_m->enable_location();
		redirect('transactions/shipping_area','refresh'); 
	}
	// ---------------------- *** Voucher CRUD *** ---------------------------//
	function save_voucer(){
		$this->transaction_m->voucher_save();
		redirect('transactions/Vouchers/voucher_set','refresh');
	}
	function save_voucher_(){
		if($this->input->post("caption") AND $this->input->post("value") AND $this->input->post("start") AND  $this->input->post("expire") AND ($this->input->post("qty") OR $this->input->post("qtyun")))
		{
			$this->transaction_m->voucher_save_();
			$this->session->set_flashdata('success',"Data transaction successfully added");
			redirect('transactions/voucher','refresh');
		}
		else
		{
			$this->session->set_flashdata('error',"Data you have entered is incomplete"); 
			redirect('transactions/voucher/add','refresh');
		}
	}
	function save_code(){
		$this->transaction_m->code_save();
		redirect('transactions/Vouchers/voucher_set','refresh');
	}
	function edit_code(){
		$this->transaction_m->code_edit();
		redirect('transactions/Vouchers/voucher_set','refresh');
	}
	function voucher_delete(){
		$this->transaction_m->delete_voucher();
		redirect('transactions/voucher','refresh');
	}
	// --------------------- *** BanK AcCounT Crud *** ------------------------- //
	
	function bank_update(){
		if($this->input->post("method") AND $this->input->post("accname") AND $this->input->post("accountid"))
		{
		$this->transaction_m->bank_edit();
			redirect('transactions/bank_account','refresh');
		}
		else
		{
			$this->session->set_flashdata('error',"Data you have entered is incomplete"); 
			redirect('transactions/bank_account/add','refresh');
		}
	}
	function bank_save(){
		$this->transaction_m->bank_save();
		redirect('transactions/bank_account','refresh');
	}
	// --------------------- *** Reward Setting *** ------------------------- //
	function save_reward(){
		if($this->input->post("value") AND $this->input->post("reward"))
		{
			$this->transaction_m->reward_save();
			$this->session->set_flashdata('success',"Data reward successfully added"); 
			redirect('transactions/rewards','refresh');
		}
		else
		{
			$this->session->set_flashdata('error',"Data you have entered is incomplete");
			redirect('transactions/rewards/setup','refresh');
		}
	}
	function enable_rewards(){
		$this->transaction_m->reward_enable();
		redirect('transactions/rewards','refresh');
	}
	// ------------------------- *** Voucher2 *** ----------------------------- //
	function voucher(){
		$this->load->library('pagination');
		$this->load->model(array('lib'));
		$data['dattr'] = '';
		
		$data['page'] = 'transactions';
		$data['subpage'] = 'transactions';
		$data['mainmenu'] = $this->pages_model->menu();
		$data['subpages'] = $this->pages_model->submenu2();


		if($this->input->post("search"))
		{
			$data['title'] = 'Vouchers Search';
			$data['breadc'] = $this->breadcrumb->show($data['title']);
			$data['voucher'] = $this->transaction_m->get_voucher_selected_(); 
		}
		else
		{
			$data['title'] = 'Vouchers';
			$data['breadc'] = $this->breadcrumb->show($data['title']);
			$data['voucher'] = $this->transaction_m->get_voucher_set2(); 
			$data['dattr'] = $this->uri->segment(5);
			$table = 'voucher';
			$data['base_url'] = base_url().'transactions/voucher';
			$data['total_rows'] = $this->lib->count_all($table);
			$data['per_page'] = 6; 
			$data['uri_segment'] = 3;
			$this->pagination->initialize($data); 
			$data['link'] = $this->pagination->create_links();
		}
		$this->load->view('voucher2_', $data);
	}
}
