<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Checkout extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->load->model('product_model');
		$this->load->model('voucher_model');
		$this->load->model('order_model');
		$this->load->model('reward_model');
	}
	
	public function addCart() {
		$id 	= $this->input->post('product_id');
		$qty 	= $this->input->post('qty');
		
		if(! $id && !$qty)
			redirect();
		
		$shop_cart = $this->session->userdata('shopping_cart');
		if(count($shop_cart) == 0) {
			$this->session->set_userdata('shopping_cart', array($id => $qty));
		} else {
			$samekey = false;
			foreach($shop_cart AS $key => $val) {
				if($key == $id) {
					$shop_cart[$key] = $qty;
					$samekey = true;
					break;
				}
			}
			
			if(! $samekey) 
				$shop_cart[$id] = $qty;
			
			$this->session->set_userdata('shopping_cart', $shop_cart);
		}
	}
	
	public function removeCart($id) {
		$shop_cart 	= $this->session->userdata('shopping_cart');
		$new_cart 	= array();
		
		foreach($shop_cart AS $key => $val)
			if($key != $id)
				$new_cart[$key] = $val;
			
		$this->session->set_userdata('shopping_cart', $new_cart);
		
		return $new_cart;
	}

	public function index() {
		$data['page'] = '';
		$data['page_detail'] = '';
		$data['breadcrumb'] = array();
		
		if ($_POST)
			$this->addCart();
		
		$shop_cart = $this->session->userdata('shopping_cart');
		if($shop_cart) {
			$data['product'] 		= $this->product_model->getDetailByList(array_keys($shop_cart));
			$data['shop_cart'] 	= $shop_cart;
		}
		
		$this->load->view('shopping_bag', $data);
	}
	
	public function getNewInvoiceNum() {
		$digits = 4;
		$new_num = date('ym').rand(pow(10, $digits-1), pow(10, $digits)-1);
		
		if(! $this->order_model->find($new_num))
			return $new_num;
		else
			return $this->getNewInvoiceNum();
	}
	
	public function getTotalOrders() {
		$total 			= 0;
		$shop_cart 	= $this->session->userdata("shopping_cart");
		if(count($shop_cart) > 0) {
			$product 		= $this->product_model->getDetailByList(array_keys($shop_cart));
			
			foreach($product AS $item) {
				
				//$total += $item->base_price * (100 - $item->disc)/100 * $shop_cart[$item->id_product];
				//added by kuuga november 13,2013
				if($item->disc==0 && $item->diskonManufaktur!==0){
					$disc = ($item->base_price - ($item->base_price * $item->diskonManufaktur/100))*$shop_cart[$item->id_product];
				}
				if($item->disc!=0 && $item->diskonManufaktur!=0){
					$disc = ($item->base_price - ($item->base_price * $item->disc/100))*$shop_cart[$item->id_product]; 
				}
				if($item->disc!=0 && $item->diskonManufaktur==0){
					$disc = ($disc = $item->base_price - ($item->base_price * $item->disc/100))*$shop_cart[$item->id_product];
				}
				$total +=$disc;
				//end 
			}
		}
		
		$voucher_val 	= 0;
		$voucher			= $this->session->userdata("voucher");
		if($voucher != '')
			$voucher_val = $this->voucher_model->getDetail($voucher)->vcr_value;
		
		return $total-$voucher_val;
	}
	
	public function insertOrder ($new_id, $balance_used, $total, $address, $user_data, $payment_method) {
		$shop_cart 	= $this->session->userdata('shopping_cart');
		$data_insert = array(
			"invoice_number" => $new_id,
			"id_customer" => $user_data->id_customer,
			"date" => date('Y-m-d H:i:s'),
			"shipping_cost" => "0",
			"total_orders" => $total,
			"voucher_code" => $this->session->userdata("voucher"),
			"credit_balance_used" => $balance_used,
			"payment_method" => $payment_method,
			"payment_date" => "",
			"bank_account" => "",
			"name_account" => "",
			"id_account" => "",
			"shipping_date" => "",
			"id_address" => $address->id_address,
			"waiting" => "0",
			"accept" => "0",
			"error" => "0",
			"deliver" => "0",
			"cancel" => "0",
			"flag" => "0"
		);
		$data_item = array();
		if(count($shop_cart) > 0) {
			$product 		= $this->product_model->getDetailByList(array_keys($shop_cart));
			
			$data_item = array();
			foreach($product AS $item) {
				//echo '<br>diskon product :'.$item->disc;
				//echo '<br>diskon brand: '.$item->diskonManufaktur;
				if($item->disc!=0 && $item->diskonManufaktur!=0){
					$disc = $item->disc;
				}elseif($item->disc!=0 && $item->diskonManufaktur==0){
					$disc = $item->disc;
				}elseif($item->disc==0 && $item->diskonManufaktur!=0){
					$disc=$item->diskonManufaktur;
				}elseif($item->disc==0 && $item->diskonManufaktur==0){
					$disc = 0;
				}
				array_push($data_item, 
					array(
						"invoice_number" => $new_id,
						"id_product" => $item->id_product,
						"id_prod_stock" => "",
						"base_price" => $item->base_price,
						"tax" => $item->tax,
						"disc" => $disc,//$item->disc,
						"disc_type" => $item->disc_type,
						"qty" => $shop_cart[$item->id_product]
					)
				);
			}
			//print_r($data_item);
			//exit;
		}
		
		if($this->product_model->check_stock($shop_cart)) {
			if($this->order_model->new_order($data_insert, $data_item)) {
				$this->product_model->update_stock($shop_cart);
				$this->voucher_model->useCode($this->session->userdata("voucher"));
				$this->account_model->update_balance($user_data->id_customer, $balance_used);
				
				/** starting send email **/
				$data = array(
					'invoice_number' => $new_id,
					'total' => $total,
					'reward' => ''
				);
				
				$data = (object) $data;
				$this->load->library('email');
				$this->email->from('admin@permata.com');
				$this->email->to($user_data->email);
				$this->email->subject('Permata - Order Succeed');
				$this->email->message($this->pix_mail_tpl->order($data));
				$this->email->send();
			}
		} else {
			redirect('checkout');
		}
	}
	
	function paypal_valid() {
		$pp_hostname = "www.sandbox.paypal.com"; /* Change to www.sandbox.paypal.com to test against sandbox */

		/* read the post from PayPal system and add 'cmd' */
		$req = 'cmd=_notify-synch';

		$tx_token = $_GET['tx'];
		$auth_token = "U3itP0DN7OpL6gv9YPS6OBxZR5e01JcsluHvc42Q6tLkd51Izib0UYoRa3a"; /* paypal merchant token */
		$req .= "&tx=$tx_token&at=$auth_token";

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://$pp_hostname/cgi-bin/webscr");
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
		/* set cacert.pem verisign certificate path in curl using 'CURLOPT_CAINFO' field here,
		if your server does not bundled with default verisign certificates. */
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Host: $pp_hostname"));
		$res = curl_exec($ch);
		curl_close($ch);

		if ( ! $res) {
			/* HTTP ERROR */
			$this->order_model->cancel($this->session->userdata('order_id'));
			$this->session->unset_userdata('order_id');
			
			$this->session->set_flashdata('payment_error', "Sorry, Your payment not succeed. Please try again.");
			redirect('checkout/payment');
		} else {
			/* parse the data */
			$lines = explode("\n", $res);
			$keyarray = array();
			
			if (strcmp ($lines[0], "SUCCESS") == 0) {
				/* payment success */
				for ($i=1; ($i<count($lines) - 2);$i++) {
					list($key, $val) = explode("=", $lines[$i]);
					$keyarray[urldecode($key)] = urldecode($val);
				}
				
				//print_r($keyarray);
				
				$this->order_model->confirm_payment($this->session->userdata('order_id'), array("waiting" => "1", "payment_date" => date('Y-m-d')));
				
			} else if (strcmp ($lines[0], "FAIL") == 0) {
				$this->order_model->cancel($this->session->userdata('order_id'));
				$this->session->unset_userdata('order_id');
				
				$this->session->set_flashdata('payment_error', "Sorry, Your payment not succeed. Please try again.");
				redirect('checkout/payment');
			}
		}
	}

	public function page() {
		
		$action 		= $this->uri->segment(2);
		$id 				= $this->uri->segment(3);
		$label 			= '';
		$shop_cart 	= $this->session->userdata('shopping_cart');
		
		$data['page'] = $action;
		$data['page_detail'] = '';
		$data['breadcrumb'] = array();
		
		if(! in_array($action, array('voucher', 'remove', 'account', 'delivery', 'payment', 'thank', 'paypal_valid', 'paypal_cancel')))
			redirect();
			
		if(count($shop_cart) > 0) {
			$data['product'] 		= $this->product_model->getDetailByList(array_keys($shop_cart));
			$data['shop_cart'] 	= $shop_cart;
		}
		
		if ( $action == 'remove') {
			if(! $this->product_model->checkID($id) || !array_key_exists($id, $shop_cart))
				redirect();
			
			$shop_cart 	= $this->removeCart($id);
			$data['shop_cart'] 	= $shop_cart;
			if(count($shop_cart) > 0) {
				$data['product'] 		= $this->product_model->getDetailByList(array_keys($shop_cart));
			} else {
				unset($data['product']);
			}
		}  // end of remove
		
		if ( $action == 'account') {
			if ($this->session->userdata('sess_account'))
				redirect('checkout/delivery');
			
		} // end of account
		
		if ( $action == 'voucher') {
			$voucher_code = strtoupper($this->input->post('voucher_code'));
			if($this->voucher_model->check($voucher_code)) {
				$this->session->set_userdata('voucher', $voucher_code);
			} else {
				$data['wrong_voucher'] = true;
			}
			
		} // end of voucher
		
		if ( $action == 'delivery')
		{
			
			if (count($shop_cart) == 0)
				redirect();
				
			if ( ! $this->session->userdata('sess_account'))
				redirect('checkout/account');
			
			if ($this->uri->segment(3) == 'add')
				return $this->load->view('delivery_add_address', $data);
			
			$acc = $this->account_model->find_email($this->session->userdata('sess_account'));
			if ( ! $data['address'] = $this->account_model->get_address($acc->id_customer))
				redirect('checkout/delivery/add');
		}
		
		if ( $action == 'payment') {
			//print_r($_POST);exit;
			if ( ! $this->session->userdata('sess_account'))
				redirect('checkout/account');
			
			if($this->session->userdata('address') == '' && ! $_POST)
				redirect('checkout/delivery');
			
			$data['pay_address'] = $this->session->userdata('address');
			if ($_POST) {
				$data['pay_address'] = $this->input->post('address');
				if ( ! $this->account_model->find_address($data['pay_address'], $this->account_model->find_email($this->session->userdata('sess_account'))->id_customer))
					redirect('checkout/delivery');
			
				$this->session->set_userdata('address', $data['pay_address']);
			}
			
			if($data['pay_address'] == '')
				redirect('checkout/delivery');
			
			$data['shipping'] = array(
				"jabodetabek" => "Jabodetabek (IDR 20.000 / KG)",
				"other" => "Outside Jabodetabek (we will directly transfer you to our customer service)");
			
			$this->load->model('bank_model');
			$data['bank'] = $this->bank_model->all();
		}
		
		if ( $action == 'thank') {
			if ( ! $this->session->userdata('sess_account'))
				redirect('checkout/account');
			
			
			/* */
			 $data['shipping'] = array(
				"jabodetabek" => "Jabodetabek (FREE SHIPPING)",
				"other" => "Outside Jabodetabek (Please contact our customer service +62 21 725 6076)");
			 /* */
			
			
			
			$data['pay_address'] 	= $this->session->userdata('address');;
			if ( ! $this->account_model->find_address($data['pay_address'], $this->account_model->find_email($this->session->userdata('sess_account'))->id_customer))
				redirect('checkout/delivery');
			
			if ( ! $_POST)
				redirect('checkout/payment');
			
			$data['pay_bank'] 		= $this->input->post('payment');
			//$data['pay_ship'] = $this->input->post('shipping');
			
			$this->load->model('bank_model');
			if($data['pay_bank'] == 'paypal') {
				// simpan w/ paypal
				$user_data 	= $this->account_model->find_email($this->session->userdata('sess_account'));
				$address 		= $this->account_model->find_address($data['pay_address'], $user_data->id_customer);
				
				$new_id = $this->getNewInvoiceNum();
				$total 	= $this->getTotalOrders();
				$balance_used = ($user_data->account_balance > $total ? $total : $user_data->account_balance);
				$total = ($total > $balance_used ? $total-$balance_used : 0);
				
				$this->insertOrder($new_id, $balance_used, $total, $address, $user_data, "paypal");
				$this->session->set_userdata('order_id', $new_id);
				
				// redirect to paypal
				$currency 	= (int)$this->pix_setting->get_value('currency');
				$total_usd 	= $total / $currency;
				$pp = 'https://www.sandbox.paypal.com/cgi-bin/webscr?cmd=_xclick&business=R5L249B5TLU78&currency_code=USD&item_name=Permata.com - Order ID : '.$new_id.'&amount='.number_format($total_usd, 2, '.', ',').'&return='.site_url('checkout/paypal_valid').'&cancel_return='.site_url('checkout/paypal_cancel');
				redirect($pp);
				
			} else if ($this->bank_model->find($data['pay_bank'])) {
				// simpan w/ bank
				$user_data 	= $this->account_model->find_email($this->session->userdata('sess_account'));
				$address 		= $this->account_model->find_address($data['pay_address'], $user_data->id_customer);
				
				$new_id = $this->getNewInvoiceNum();
				$total 	= $this->getTotalOrders();
				$balance_used = ($user_data->account_balance > $total ? $total : $user_data->account_balance);
				$total = ($total > $balance_used ? $total-$balance_used : 0);
				
				$this->insertOrder($new_id, $balance_used, $total, $address, $user_data, "transfer");
				
				// prepare other data for show
				$data['orderid'] 	= $new_id;
				$data['total'] 		= $this->currency->idr($total);
				$data['addr'] 		= $address;
				
				$this->load->model('bank_model');
				$data['rekening'] = $this->bank_model->find($data['pay_bank']);
				
				$data['payment_type'] = 'bank';
				
				$this->session->set_userdata('shopping_cart', array());
				$this->session->set_userdata('voucher', '');
				$this->session->set_userdata('address', '');
			} else {
				redirect('checkout/delivery');
			}
		}
		
		if ( $action == 'paypal_valid') {
			if ( ! $this->session->userdata('sess_account'))
				redirect('checkout/account');
			
			$data['pay_address'] 	= $this->session->userdata('address');;
			if ( ! $this->account_model->find_address($data['pay_address'], $this->account_model->find_email($this->session->userdata('sess_account'))->id_customer))
				redirect('checkout/delivery');
			
			if ( ! $this->session->userdata('order_id'))
				redirect('checkout/payment');
		
			// action setelah paypal di submit
			$this->paypal_valid();
			
			$user_data 	= $this->account_model->find_email($this->session->userdata('sess_account'));
			$address 		= $this->account_model->find_address($data['pay_address'], $user_data->id_customer);
			
			// prepare other data for show
			$data['orderid'] 	= $this->session->userdata('order_id');
			$data['total'] 		= $this->getTotalOrders();
			$data['addr'] 		= $address;
			
			$this->load->model('bank_model');
			
			$data['payment_type'] = 'paypal';
			
			$this->session->set_userdata('shopping_cart', array());
			$this->session->set_userdata('voucher', '');
			$this->session->set_userdata('address', '');
			$this->session->set_userdata('order_id', '');
			
			// overide view to "payment"
			$action = "thank";
		}
		
		if ( $action == 'paypal_cancel') {
			$this->order_model->cancel($this->session->userdata('order_id'));
			$this->session->unset_userdata('order_id');
			
			$this->session->set_flashdata('payment_error', "Sorry, Your payment not succeed. Please try again.");
			redirect('checkout/payment');
		}
		
		if(in_array($action, array('voucher', 'remove')))
			$this->load->view('shopping_bag', $data);
		else
			$this->load->view($action, $data);
	}
}
