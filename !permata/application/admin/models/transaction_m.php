<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Transaction_m extends CI_Model {

	function __construct()
    {
        parent::__construct();
    }
	
	function get_order(){
		 
		$data = array();
		$page = $this->uri->segment(3);
		$this->db->select("customer.id_customer, customer.email, order.invoice_number, order.total_orders,order.*, 
		CASE WHEN zpxf_order.error = 0 THEN 
			CASE WHEN zpxf_order.accept = 0 THEN 
				CASE when zpxf_order.waiting = 0 THEN 'pending'
					ELSE 'waiting'
				END
			ELSE 'accept'
			END
		ELSE 'error' 
		END as payment,
		CASE WHEN zpxf_order.cancel = 0 THEN 
			CASE WHEN zpxf_order.deliver = 0 THEN 'pending'
			ELSE 'delivered' END
		ELSE 'cancel' END AS status
		/*order.waiting as status*/",FALSE);
		$this->db->from("order");
		$this->db->join('customer','order.id_customer = customer.id_customer','left');
		$this->db->order_by('date','desc');
		if($page)
		{
			$this->db->limit(5,$page);
		}
		else
		{
			$this->db->limit(5,0);
		}
		//echo $this->db->_compile_select();exit;
		$hasil = $this->db->get();
		if($hasil->num_rows() >0)
		{	
			$data = $hasil->result();
		}
		$hasil->free_result();
		return $data;
	}
	function search_order(){
		$data = array();
		$this->db->select("customer.firstname,customer.email,customer.lastname,order.invoice_number,order.total_orders,order.date,order.*,
		CASE WHEN zpxf_order.error = 0 THEN 
			CASE WHEN zpxf_order.accept = 0 THEN 
				CASE when zpxf_order.waiting = 0 THEN 'pending'
					ELSE 'waiting'
				END
			ELSE 'accept'
			END
		ELSE 'error' 
		END as payment,
		CASE WHEN zpxf_order.cancel = 0 THEN 
			CASE WHEN zpxf_order.deliver = 0 THEN 'pending'
			ELSE 'delivered' END
		ELSE 'cancel' END AS status
		
		/*order.waiting as status*/",FALSE);
		$this->db->from("order");
		$this->db->join('customer','order.id_customer = customer.id_customer','left');
		$this->db->like('order.invoice_number', trim($this->input->post("search"))); 
		$this->db->or_like('customer.firstname', trim($this->input->post("search"))); 
		$this->db->or_like('customer.lastname', trim($this->input->post("search"))); 
		$this->db->order_by('date','desc');
		//echo $this->db->_compile_select();exit;
		$hasil = $this->db->get();
		if($hasil->num_rows() >0)
		{	
			$data = $hasil->result();
		}
		$hasil->free_result();
		return $data;
	}
	function get_other_shipping_address(){
		$id = $this->uri->segment(3);
		$data = array();
		$this->db->select("customer_address.id_address,customer_address.address,customer_address.city,customer_address.postcode");
		$this->db->from("order");
		$this->db->join('customer_address','order.id_customer = customer_address.id_customer','left');
		$this->db->where("order.invoice_number",$id);
		$hasil = $this->db->get();
		if($hasil->num_rows() >0)
		{	
			$data = $hasil->result();
		}
		$hasil->free_result();
		return $data;
	}
	function get_select_orders(){
		$id = $this->uri->segment(3);
		$data = array();
		$this->db->select("customer.firstname,customer.lastname,order.invoice_number,order.shipping_cost,order.total_orders,order.payment_method,order.name_account,order.bank_account,order.id_account,customer.address as invoice_address,customer.postcode as invoice_postcode,customer.city as invoice_city,customer_address.address as shipping_address,order.id_address,customer_address.postcode as shipping_postcode,customer_address.city as shipping_city,order.date,order.payment_date,order.shipping_date,order.waiting,order.accept,order.error,order.deliver,order.cancel");
		$this->db->from("order");
		$this->db->join('customer','order.id_customer = customer.id_customer','left');
		$this->db->join('customer_address','customer.id_customer = customer_address.id_customer','left');
		$this->db->where("order.invoice_number",$id);
		$hasil = $this->db->get();
		if($hasil->num_rows() > 0){
			$data = $hasil->row();
		}
		$hasil->free_result();
		return $data;
	}
	function get_select_items(){
		$id = $this->uri->segment(3);
		$data = array();
		$this->db->select("order_item.base_price,order_item.tax,order_item.qty,order_item.disc,order_item.disc_type,product.name,product_stock.deskripsi");
		$this->db->from("order_item");
		$this->db->join('product','order_item.id_product = product.id_product','left');
		$this->db->join('product_stock','order_item.id_prod_stock = product_stock.id_prod_stock','left');
		$this->db->where("order_item.invoice_number",$id);
		//echo $this->db->_compile_select();exit;
		$hasil = $this->db->get();
		if($hasil->num_rows() >0)
		{	
			$data = $hasil->result();
		}
		$hasil->free_result();
		return $data;
	}
	
	function get_customers(){
		$data = array();
		$page = $this->uri->segment(3);
		$this->db->select("id_customer,firstname,lastname,phone,email");
		$this->db->from("customer");
		$this->db->order_by('id_customer','desc');
		if($page)
		{
			$this->db->limit(7,$page);
		}
		else
		{
			$this->db->limit(7,0);
		}
		$hasil = $this->db->get();
		if($hasil->num_rows() >0)
		{	
			$data = $hasil->result();
		}
		$hasil->free_result();
		return $data;
	}
	function search_customers(){
		$data = array();
		$this->db->select("id_customer,firstname,lastname,phone,email");
		$this->db->from("customer");
		$this->db->like('firstname', $this->input->post("search")); 
		$this->db->or_like('lastname', $this->input->post("search")); 
		$this->db->order_by('id_customer','desc');
		$hasil = $this->db->get();
		if($hasil->num_rows() >0)
		{	
			$data = $hasil->result();
		}
		$hasil->free_result();
		return $data;
	}
	function get_customers2(){
		$data = array();
		$page = $this->uri->segment(3);
		$this->db->select("id_customer,firstname,lastname,phone,email");
		$this->db->from("customer");
		$this->db->order_by('id_customer','desc');
		$hasil = $this->db->get();
		if($hasil->num_rows() >0)
		{	
			$data = $hasil->result();
		}
		$hasil->free_result();
		return $data;
	}
	function get_select_customers(){
		$id = $this->uri->segment(3);
		$data = array();
		$this->db->select("*");
		$this->db->from("customer");
		$this->db->where("id_customer",$id);
		$hasil = $this->db->get();
		if($hasil->num_rows() > 0){
			$data = $hasil->row();
		}
		$hasil->free_result();
		return $data;
	}
	function get_addr_history(){
		$id = $this->uri->segment(3);
		$data = array();
		$this->db->select("*");
		$this->db->from("customer_address");
		$this->db->where("id_customer",$id);
		$hasil = $this->db->get();
		if($hasil->num_rows() >0)
		{	
			$data = $hasil->result();
		}
		$hasil->free_result();
		return $data;
	}
	function get_trans_history(){
		$id = $this->uri->segment(3);
		$data = array();
		$this->db->select("order.*, order.payment_date as date");
		$this->db->from("customer");
		$this->db->join('order','customer.id_customer = order.id_customer','left');
		$this->db->where("order.id_customer",$id);
		$hasil = $this->db->get();
		if($hasil->num_rows() >0)
		{	
			$data = $hasil->result();
		}
		$hasil->free_result();
		return $data;
	}
	
	// ------------------------- *** Shipping *** ----------------------------------//
	
	function get_all(){
		$data = array();
		$this->db->select("shipping_region.id_region,shipping_region.region_name,shipping_region.flag,count(zpxf_shipping.name) as counts");
		$this->db->from("shipping_region");
		$this->db->join('shipping','shipping_region.id_region = shipping.id_region','left');
		$this->db->group_by("shipping_region.id_region");
		$this->db->order_by("shipping_region.region_name", "asc");
		$hasil = $this->db->get();
		if($hasil->num_rows() >0)
		{	
			$data = $hasil->result();
		}
		$hasil->free_result();
		return $data;
	}
	function get_sub_all(){
		$data = array();
		$this->db->select("*");
		$this->db->from("shipping");
		$this->db->where("id_region",$this->uri->segment(3));
		$hasil = $this->db->get();
		if($hasil->num_rows() >0)
		{	
			$data = $hasil->result();
		}
		$hasil->free_result();
		return $data;
	}
	
	// ------------------------- *** Customer Section *** ------------------------------//
	function customer_save(){
		if(($this->input->post("firstname")) AND ($this->input->post("email")))
		{
			if($this->input->post("id_customer"))
			{
				if($this->input->post("password"))
				{
					$data = array(
					"firstname"		=> $this->input->post("firstname"),
					"lastname"		=> $this->input->post("lastname"),
					"phone"			=> $this->input->post("phone"),
					"address"		=> $this->input->post("address"),
					"city"			=> $this->input->post("city"),
					"postcode"		=> $this->input->post("postcode"),
					"email"			=> $this->input->post("email"),
					"passwd"		=> md5($this->input->post("password"))
					);
				}
				else
				{
					$data = array(
					"firstname"		=> $this->input->post("firstname"),
					"lastname"		=> $this->input->post("lastname"),
					"phone"			=> $this->input->post("phone"),
					"address"		=> $this->input->post("address"),
					"city"			=> $this->input->post("city"),
					"postcode"		=> $this->input->post("postcode"),
					"email"			=> $this->input->post("email")
					);
				}

				$this->db->where("id_customer", $this->input->post('id_customer'));
				$this->db->update("customer", $data);
				$this->session->set_flashdata('info',"Data customer successfully changed");
			}
			else
			{
				$this->db->from("customer");
				$this->db->where("email",$this->input->post("email"));
				$query = $this->db->get();
				foreach ($query->result() as $row)
				{	 $emails = $row->email;	}
				if(@$emails)
				{
					$this->session->set_flashdata('error',"This customer is already exist ");
				}
				else
				{
				//if($this->input->post("password"))
				//{
					$data = array(
						"firstname"		=> $this->input->post("firstname"),
						"lastname"		=> $this->input->post("lastname"),
						"phone"			=> $this->input->post("phone"),
						"address"		=> $this->input->post("address"),
						"city"			=> $this->input->post("city"),
						"postcode"		=> $this->input->post("postcode"),
						"email"			=> $this->input->post("email"),
						"passwd"		=> md5($this->input->post("password"))
					);
					$this->db->insert("customer",$data);
					$this->session->set_flashdata('info',"Data customer successfully added");
				//}
				//else
				//{
				//	$this->session->set_flashdata('error',"Please fill in the column password");
				//}
				}
			}
		}
	}
	function edit_date(){
		/* $orderdate = explode('/',$this->input->post("orderdate"));
		$orderdate = $orderdate[2].'-'.$orderdate[1].'-'.$orderdate[0];		
		
		$paymentdate = explode('/',$this->input->post("paymentdate"));
		$paymentdate = $paymentdate[2].'-'.$paymentdate[1].'-'.$paymentdate[0];		 */
		
		$shippingdate = explode('/',$this->input->post("shippingdate"));
		$shippingdate = $shippingdate[2].'-'.$shippingdate[1].'-'.$shippingdate[0];
		
		$data = array(
				/* "date"			=> $orderdate,
				"payment_date"	=> $paymentdate, */
				"shipping_date"	=> $shippingdate
		);
		$this->db->where("invoice_number", $this->input->post('idorder'));
		$this->db->update("order", $data);
		$this->session->set_flashdata('info',"Data transaction successfully changed");
	}
	
	public function getNewRewardCode() {
		$this->load->model('reward_model');
		$digits = 4;
		$new_num = date('ym').rand(pow(10, $digits-1), pow(10, $digits)-1);
		
		if(! $this->reward_model->find_code($new_num))
			return $new_num;
		else
			return $this->getNewRewardCode();
	}
	
	function edit_payment(){
		// send email if payment confirmed by Admin
		if($this->input->post("accept")) {
			
			$this->load->model('order_model');
			$this->load->model('reward_model');
			$this->load->model('customer_model');
			$this->load->library('email');
			$this->load->library('pix_mail_tpl');
			
			$order 	= $this->order_model->find($this->input->post('idorder'));
			
			if($order->accept == "0") { // only if not accept yet
				
				$reward 	= $this->reward_model->find_reward_value($order->total_orders);
				$customer = $this->customer_model->find($order->id_customer);
				$code 		= $this->getNewRewardCode();
				
				if($reward) {
					$this->reward_model->insert_reward_list(array(
						'code' => $code,
						'value' => $reward->reward,
						'customer_id' => $customer->id_customer,
						'dt' => date('Y-m-d H:i:s'),
						'used' => '0',
						'used_dt' => '0000-00-00 00:00:00'
						)
					);
				}
				
				/** starting send email **/
				$data = array(
					'invoice_number' => $order->invoice_number,
					'total' => $order->total_orders,
					'reward' => ($reward ? $code : '')
				);
				
				$data = (object) $data;
				$this->email->from('admin@permata.com');
				$this->email->to($customer->email);
				$this->email->subject('Permata - Payment Succeed');
				$this->email->message($this->pix_mail_tpl->order($data));
				$this->email->send();
			}
		}
		
		// save the data
		$data = array(
			"accept"		=> $this->input->post("accept"),
			"error"			=> $this->input->post("errorr"),
			"deliver"		=> $this->input->post("deliver"),
			"cancel"		=> $this->input->post("cancel")
		);
		$this->db->where("invoice_number", $this->input->post('idorder'));
		$this->db->update("order", $data);
		$this->session->set_flashdata('info',"Data transaction successfully changed");
	}
	
	function edit_shipping(){
		if($this->input->post("otheraddr"))
		{
			$this->db->select("*");
			$this->db->from("customer_address");
			$this->db->where("id_address",$this->input->post("otheraddr"));
			$query = $this->db->get();
			foreach ($query->result() as $row)
			{
				$address = $row->address;
				$postcode = $row->postcode;
				$city = $row->city;
			}
			$data = array(
				"id_address"		=> $this->input->post("otheraddr"),
				"shipping_address"	=> $address,
				"shipping_postcode"	=> $postcode,
				"shipping_city"		=> $city
			);
		}
		else
		{
			$data = array(
				"id_address"	=> $this->input->post("idaddr"),
				"shipping_address"	=> $this->input->post("shipping_address"),
				"shipping_postcode"	=> $this->input->post("shipping_postcode"),
				"shipping_city"		=> $this->input->post("shipping_city")
			);
		}
		$this->db->where("invoice_number", $this->input->post('idorder'));
		$this->db->update("order", $data);
		$this->session->set_flashdata('info',"Data shipping address successfully changed");
	}
	// -------------------------------- *** Shipping *** ------------------------------- //
	function region_save(){
		if($this->input->post("newregion"))
		{	
			$this->db->insert("shipping_region",array("region_name"	=> $this->input->post("newregion"))); 
			$this->session->set_flashdata('success',"Data shipping address successfully added");
		}
		else
		{
			$this->session->set_flashdata('error',"Data you have entered is incomplete");
		}
	}
	function region_edit(){
		if($this->input->post("location_name"))
		{
			$this->db->where("id_region", $this->input->post("idregion"));
			$this->db->update("shipping_region",array("region_name"	=> $this->input->post("location_name")));
			$this->session->set_flashdata('info',"Data region successfully changed"); 
		}
		else
		{
			$this->session->set_flashdata('error',"Data you have entered is incomplete"); 
		}
	}
	function location_save(){
		if(($this->input->post("location")) AND ($this->input->post("cost")))
		{
			$data = array(
				"id_region"	=> $this->input->post("idval"),
				"name"		=> $this->input->post("location"),
				"cost"		=> $this->input->post("cost"),
				"enable"	=> 1
			);
			$this->db->insert("shipping",$data);
			$this->session->set_flashdata('success',"Data shipping location successfully added"); 
		}
		else
		{
			$this->session->set_flashdata('error',"Data you have entered is incomplete"); 
		}
	}
	function location_edit(){
		if(($this->input->post("location_name")) AND ($this->input->post("location_cost")))
		{
			$data = array(
				"name"		=> $this->input->post("location_name"),
				"cost"		=> $this->input->post("location_cost")
			);
			$this->db->where("id_shipping", $this->input->post("idval"));
			$this->db->update("shipping",$data);
			$this->session->set_flashdata('info',"Data shipping location successfully changed"); 
		}
		else
		{
			$this->session->set_flashdata('error',"Data you have entered is incomplete"); 
		}
	}
	function enable_location(){
		$this->db->where("id_shipping", $this->uri->segment(3));
		$this->db->update("shipping", array("enable"=> $this->uri->segment(4)));
		$this->session->set_flashdata('info',"Data shipping location successfully changed"); 
	}
	
	// ------------------------- *** Voucher *** ----------------------------------//
	function get_voucher_set(){
		$data = array();
		$page = $this->uri->segment(4);
		$this->db->select("*");
		$this->db->from("voucher");
		$this->db->order_by('id_voucher','desc');
		if($page)
		{
			$this->db->limit(4,$page);
		}
		else
		{
			$this->db->limit(4,0);
		}
		$hasil = $this->db->get();
		if($hasil->num_rows() >0)
		{	
			$data = $hasil->result();
		}
		$hasil->free_result();
		return $data;
	}
	function get_voucher_set2(){
		$data = array();
		$page = $this->uri->segment(3);
		$this->db->select("*");
		$this->db->from("voucher");
		$this->db->order_by('id_voucher','desc');
		if($page)
		{
			$this->db->limit(6,$page);
		}
		else
		{
			$this->db->limit(6,0);
		}
		$hasil = $this->db->get();
		if($hasil->num_rows() >0)
		{	
			$data = $hasil->result();
		}
		$hasil->free_result();
		return $data;
	}
	function get_rewards_set(){
		$data = array();
		$page = $this->uri->segment(3);
		$this->db->select("*");
		$this->db->from("reward_setting");
		$this->db->order_by('value','asc');
		if($page)
		{
			$this->db->limit(5,$page);
		}
		else
		{
			$this->db->limit(5,0);
		}
		$hasil = $this->db->get();
		if($hasil->num_rows() >0)
		{	
			$data = $hasil->result();
		}
		$hasil->free_result();
		return $data;
	}
	function get_voucher_use(){
		$data = array();
		//$page = $this->uri->segment(4);
		$id = $this->uri->segment(5);
		$this->db->select("a.id_vcr_used,a.id_voucher,a.id_customer,a.email as emailvcr,a.code,b.firstname,b.lastname,b.email as emailcust,b.phone");
		$this->db->from("voucher_use as a");
		$this->db->join('customer as b','a.id_customer = b.id_customer','left');
		$this->db->where('a.id_voucher',$id);
		$this->db->order_by('a.id_vcr_used','desc');
		/*
		if($page)
		{
			$this->db->limit(7,$page);
		}
		else
		{
			$this->db->limit(7,0);
		}
		*/
		$hasil = $this->db->get();
		if($hasil->num_rows() >0)
		{	
			$data = $hasil->result();
		}
		$hasil->free_result();
		return $data;
	}
	function get_reward_use(){
		$data = array();
		//$page = $this->uri->segment(4);
		$id = $this->uri->segment(5);
		$this->db->select("a.code,a.customer_id,b.id_customer as id,b.firstname,b.lastname,b.email as emailcust,b.phone");
		$this->db->from("reward_list as a");
		$this->db->join('customer as b','a.customer_id = b.id_customer','left');
		$this->db->where('a.id',$id);
		$this->db->order_by('a.used_dt','desc');
		/*
		if($page)
		{
			$this->db->limit(10,$page);
		}
		else
		{
			$this->db->limit(10,0);
		}
		*/
		$hasil = $this->db->get();
		if($hasil->num_rows() >0)
		{	
			$data = $hasil->result();
		}
		$hasil->free_result();
		return $data;
	}
	function get_voucher_not_use(){
		$data = array();
		$this->db->select("*");
		$this->db->from("voucher_use");
		$this->db->where('id_customer',0);
		$this->db->where('email','');
		$this->db->order_by('date_issue','asc');

		$hasil = $this->db->get();
		if($hasil->num_rows() >0)
		{	
			$data = $hasil->result();
		}
		$hasil->free_result();
		return $data;
	}
	
	
	function get_customer_rewards(){
		$data = array();
		$this->db->select("a.id_customer as id,a.firstname,a.lastname,a.email as emailcust,a.phone,a.account_balance");
		$this->db->from("customer as a");
		$this->db->join('reward_list as b','a.id_customer = b.customer_id','right');
		$this->db->order_by('a.firstname','asc');

		$hasil = $this->db->get();
		if($hasil->num_rows() >0)
		{	
			$data = $hasil->result();
		}
		$hasil->free_result();
		return $data;
	}
	function get_customer_use(){
			$data = array();
		//$page = $this->uri->segment(4);
		$id = $this->uri->segment(5);
		$this->db->select("a.code,a.customer_id,a.value,b.id_customer as id,b.firstname,b.lastname,b.email as emailcust,b.phone");
		$this->db->from("reward_list as a");
		$this->db->join('customer as b','a.customer_id = b.id_customer','right');
		$this->db->where('a.id',$id);
		$this->db->order_by('a.used_dt','desc');
		/*
		if($page)
		{
			$this->db->limit(10,$page);
		}
		else
		{
			$this->db->limit(10,0);
		}
		*/
		$hasil = $this->db->get();
		if($hasil->num_rows() >0)
		{	
			$data = $hasil->result();
		}
		$hasil->free_result();
		return $data;
	}
	function get_selected_voucher_use(){
		$data = array();
		$this->db->select("*");
		$this->db->from("voucher_use");
		$this->db->where("id_vcr_used",$this->uri->segment(7));
		$hasil = $this->db->get();
		if($hasil->num_rows() >0)
		{	
			$data = $hasil->result();
		}
		$hasil->free_result();
		return $data;
	}
	function get_selected_voucher_use2(){
		$data = array();
		$this->db->select("*");
		$this->db->from("voucher_use");
		$this->db->where("id_vcr_used",$this->uri->segment(4));
		$hasil = $this->db->get();
		if($hasil->num_rows() >0)
		{	
			$data = $hasil->result();
		}
		$hasil->free_result();
		return $data;
	}
	function count_not_use(){
		$this->db->from('voucher_use');
		$this->db->where('id_customer',0);
		$this->db->where('email','');
		return $this->db->count_all_results();
	}
	function get_code_config(){
		$data = array();
		$id = $this->uri->segment(4);
		$this->db->select("a.code_length,a.code_separator,a.length_separator,a.code_type,a.vcr_value,a.vcr_type,a.date_issue,a.date_start,a.date_expired,a.qty,a.vcr_caption,count(b.id_voucher) as counts,c.name");
		$this->db->from("voucher as a");
		$this->db->join('voucher_use as b','a.id_voucher = b.id_voucher','left');
		$this->db->join('product as c','a.id_product = c.id_product','left');
		$this->db->where('a.id_voucher',$id);
		$hasil = $this->db->get();
		if($hasil->num_rows() >0)
		{	
			$data = $hasil->result();
		}
		$hasil->free_result();
		return $data;
	}


	function code_save(){
		$code_length = $this->input->post("code_length");
		$code_separator = $this->input->post("code_separator");
		$length_separator = $this->input->post("length_separator");
		$codeauto = $this->input->post("codeauto");
		$code = $this->input->post("code");
		$customer = $this->input->post("customer");
		$email = $this->input->post("email");
		
		$issue = explode('/',$this->input->post("dateissue"));
		$issue = @$issue[2].'-'.@$issue[1].'-'.@$issue[0];		
		$started = explode('/',$this->input->post("datestart"));
		$started = @$started[2].'-'.@$started[1].'-'.@$started[0];		
		$expire = explode('/',$this->input->post("dateexpired"));
		$expire = @$expire[2].'-'.@$expire[1].'-'.@$expire[0];
		
		if($email) { $input_customer = ''; $input_email = $email;}
		else { $input_customer = $customer; $input_email = ''; }
		
		if($code)
		{
			$res = substr($this->input->post("code"), 0,$code_length);
			$code_result = $code_length / $length_separator;
			$reso = '';
			$a = 0;
			for($i = 0; $i <= $code_result; $i++)
			{
				$resw = $code_separator.''.substr($res, $a, $length_separator);
				$reso = $reso.''.$resw;
				$a = $a + $length_separator;
			}
			$reso = substr($reso, 1); 
			$kode = substr($reso,0, -1); 
			$kode = strtoupper($kode); 
		}
		else
		{
			$kode = $codeauto;
		}
		if($this->input->post("vocer_type") == 'Percent') { $val = $this->input->post("vocer_val").'%'; }
		else{	$val = $this->input->post("vocer_val");	}
		
		$data = array(
			"id_voucher"	=> $this->input->post("id_voucher"),
			"code"			=> $kode,
			"value"			=> $val,
			"vcr_type"		=> $this->input->post("vocer_type"),
			"id_customer"	=> $input_customer,
			"email"			=> $input_email,
			"date_issue"	=> $issue,
			"date_start"	=> $started,
			"date_expired"	=> $expire
		);
		if($issue AND $started AND $expire AND ($issue != '--') AND ($issue != '--') AND ($issue != '--'))
		{
			$this->db->insert("voucher_use",$data);
			$this->session->set_flashdata('success',"Data voucher successfully added"); 
		}
		else
		{
			$this->session->set_flashdata('error',"Data you have entered is incomplete"); 
		}
	}
	function code_edit(){
		$issue = explode('/',$this->input->post("dateissue"));
		$issue = @$issue[2].'-'.@$issue[1].'-'.@$issue[0];		
		$started = explode('/',$this->input->post("datestart"));
		$started = @$started[2].'-'.@$started[1].'-'.@$started[0];		
		$expire = explode('/',$this->input->post("dateexpired"));
		$expire = @$expire[2].'-'.@$expire[1].'-'.@$expire[0];
	
		$customer = $this->input->post("customer");
		$email = $this->input->post("email");
		if($email) { $input_customer = ''; $input_email = $email;}
		else { $input_customer = $customer; $input_email = ''; }
		$data = array(
			"id_customer"	=> $input_customer,
			"email"			=> $input_email,
			"date_issue"	=> $issue,
			"date_start"	=> $started,
			"date_expired"	=> $expire
		);
		if($issue AND $started AND $expire)
		{
			$this->db->where("id_vcr_used", $this->input->post("voucher_code"));
			$this->db->update("voucher_use",$data);
			$this->session->set_flashdata('info',"Data voucher successfully changed"); 
		}
	}
	// -------------------------------- *** List Product *** --------------------------------- //
	function get_list_product(){
		$data = array();
		$this->db->select("id_product,name");
		$this->db->from("product");
		$hasil = $this->db->get();
		if($hasil->num_rows() >0)
		{	
			$data = $hasil->result();
		}
		$hasil->free_result();
		return $data;
	}
	// -------------------------------- *** Bank Account *** --------------------------------- //
	function get_bank(){
		$data = array();
		$page = $this->uri->segment(3);
		$this->db->select("*");
		$this->db->from("bank_account");
		if($page)
		{
			$this->db->limit(5,$page);
		}
		else
		{
			$this->db->limit(5,0);
		}
		$hasil = $this->db->get();
		if($hasil->num_rows() >0)
		{	
			$data = $hasil->result();
		}
		$hasil->free_result();
		return $data;
	}
	function search_bank(){
		$data = array();
		$this->db->select("*");
		$this->db->from("bank_account");
		$this->db->like('payment_method', $this->input->post("search")); 
		$this->db->or_like('name_account', $this->input->post("search")); 
		$this->db->or_like('id_account', $this->input->post("search")); 
		$hasil = $this->db->get();
		if($hasil->num_rows() >0)
		{	
			$data = $hasil->result();
		}
		$hasil->free_result();
		return $data;
	}
	function get_selected_bank(){
		$data = array();
		$id = $this->uri->segment(4);
		$this->db->select("*");
		$this->db->from("bank_account");
		$this->db->where('id_bank_acc',$id);
		$hasil = $this->db->get();
		if($hasil->num_rows() >0)
		{	
			$data = $hasil->result();
		}
		$hasil->free_result();
		return $data;
	}
	
	// ----------------------------- *** EDit Bank AcCount ** -------------------------------- //
	function bank_edit(){
		if($this->input->post("method") AND $this->input->post("accname") AND $this->input->post("accountid"))
		{
			$data = array(
				"payment_method "	=> strtoupper($this->input->post("method")),
				"name_account"		=> $this->input->post("accname"),
				"id_account"		=> $this->input->post("accountid")
			);
			if($this->input->post("id"))
			{
				$this->db->where("id_bank_acc", $this->input->post("id"));
				$this->db->update("bank_account",$data);
				$this->session->set_flashdata('info',"Data bank successfully changed"); 
			}
			else
			{
				$this->db->insert("bank_account",$data);
				$this->session->set_flashdata('info',"Data bank successfully added"); 
			}
		}
	}
	// ------------------------ *** Reward *** ------------------------------------ //
	function reward_save(){
			$data = array(
				"value"		=> $this->input->post("value"),
				"reward"	=> $this->input->post("reward"),
				"enable"	=> 1
			);
			$this->db->insert("reward_setting",$data);
	}
	function reward_enable(){
		$this->db->where("id", $this->uri->segment(3));
		$this->db->update("reward_setting", array("enable"=> $this->uri->segment(4)));
		$this->session->set_flashdata('info',"Data reward successfully changed"); 
	}
	// --------------------------------- *** Voucher *** ---------------------------------- //
	function voucher_save(){

		$issue = explode('/',$this->input->post("issue"));
		$issue = @$issue[2].'-'.@$issue[1].'-'.@$issue[0];		
		$started = explode('/',$this->input->post("started"));
		$started = @$started[2].'-'.@$started[1].'-'.@$started[0];		
		$expire = explode('/',$this->input->post("expire"));
		$expire = @$expire[2].'-'.@$expire[1].'-'.@$expire[0];
		
		$data = array(
			"code_length"		=> $this->input->post("codelength"),
			"code_separator"	=> $this->input->post("codeseparator"),
			"length_separator"	=> $this->input->post("codeseparatorlength"),
			"code_type"			=> $this->input->post("codetype"),
			"vcr_value"			=> $this->input->post("vouchervalue"),
			"vcr_type"			=> $this->input->post("vouchertype"),
			"date_issue"		=> $issue,
			"date_start"		=> $started,
			"date_expired"		=> $expire,
			"id_product"		=> $this->input->post("specificproduct"),
			"qty"				=> $this->input->post("qty"),
			"vcr_caption"		=> $this->input->post("captionname"),
			"user_group"		=> $this->input->post("customergrup"),
			"set_template"		=> 0
		);
		if($this->input->post("captionname") AND $this->input->post("codelength") AND $this->input->post("qty") AND $issue AND $started AND $expire)
		{
			$this->db->insert("voucher",$data);
			$this->session->set_flashdata('success',"Data voucher successfully added"); 
		}
		else
		{
			$this->session->set_flashdata('error',"Data you have entered is incomplete"); 
		}
	}
	function voucher_save_(){
			$issue = explode('/',$this->input->post("issue"));
			$issue = @$issue[2].'-'.@$issue[1].'-'.@$issue[0];		
			$started = explode('/',$this->input->post("start"));
			$started = @$started[2].'-'.@$started[1].'-'.@$started[0];		
			$expire = explode('/',$this->input->post("expire"));
			$expire = @$expire[2].'-'.@$expire[1].'-'.@$expire[0];
			if($this->input->post("qtyun"))
			{
				$qty = $this->input->post("qtyun");
			}
			else
			{
				$qty = $this->input->post("qty");
			}
			$data = array(
				"vcr_caption"	=> $this->input->post("caption"),
				"code"			=> strtoupper($this->input->post("code")),
				"vcr_value"		=> $this->input->post("value"),
				"qty"			=> $qty,
				"date_issue"	=> $issue,
				"date_start"	=> $started,
				"date_expired"	=> $expire
			);
			$this->db->insert("voucher",$data);
	}
	function delete_voucher(){
		$this->db->where('id_voucher', $this->uri->segment(3));
		$this->db->delete('voucher'); 
		$this->session->set_flashdata('alert',"Data voucher successfully deleted"); 
	}
	function get_voucher_selected_(){
		$id = $this->uri->segment(3);
		$data = array();
		$this->db->select("*");
		$this->db->from("voucher");
		$this->db->like('code', $this->input->post("search")); 
		$this->db->or_like('vcr_caption', $this->input->post("search")); 
		$hasil = $this->db->get();
		if($hasil->num_rows() >0)
		{	
			$data = $hasil->result();
		}
		$hasil->free_result();
		return $data;
	}
}

