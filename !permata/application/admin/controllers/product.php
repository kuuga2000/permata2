<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product extends MY_Controller {
	public function __construct()
	{
		parent::__construct();
		if ( ! $this->auth->signed_in()) redirect();
		$this->load->model(array('pages_model','product_m','stock_m'));
		$this->load->library('breadcrumb');
		$this->load->helper(array('form', 'url'));
	}

	// **** display form **** // parent controller : catalog
	function import()
	{
		$this->load->model('manufacturer_m');
		$data['title'] = 'Product Import';
		$data['breadc'] = 'Product Import';
		$data['page'] = 'catalog';
		$data['subpage'] = 'product';
		
		$data['mainmenu'] = $this->pages_model->menu();
		$data['subpages'] = $this->pages_model->submenu2();//jangan diutak atik
		$data['product_detail'] = $this->product_m->product_detail();
		$data['manuf'] = $this->manufacturer_m->manuf_list();
		$data['productid'] = $this->product_m->get_new_id();
		$this->load->view('product_import.php', $data);
	}
	function add()
	{
		$this->load->model('manufacturer_m');
		$data['title'] = 'Product Information';
		$data['breadc'] = $this->breadcrumb->show($data['title']);
		$data['page'] = 'catalog';
		$data['subpage'] = 'product';
		
		$data['mainmenu'] = $this->pages_model->menu();
		$data['subpages'] = $this->pages_model->submenu2();//jangan diutak atik
		$data['product_detail'] = $this->product_m->product_detail();
		$data['manuf'] = $this->manufacturer_m->manuf_list();
		$data['productid'] = $this->product_m->get_new_id();
		$this->load->view('product_info2.php', $data);
	}
	function information()
	{
		$this->load->model('manufacturer_m');
		$data['title'] = 'Product Information';
		$data['page'] = 'catalog';
		$data['subpage'] = 'product';
		$data['breadc'] = $this->breadcrumb->show($data['title']);
		
		$data['mainmenu'] = $this->pages_model->menu();
		$data['subpages'] = $this->pages_model->submenu2();//jangan diutak atik
		$data['product_detail'] = $this->product_m->product_detail();
		$data['manuf'] = $this->manufacturer_m->manuf_list();

		$this->load->view('product_info.php', $data);
	}
	function picture()
	{
		$message = '';
		$data['title'] = 'Picture';
		$data['breadc'] = $this->breadcrumb->show($data['title']);
		$data['page'] = 'catalog';
		$data['subpage'] = 'product';
		$data['mainmenu'] = $this->pages_model->menu();
		$data['subpages'] = $this->pages_model->submenu2();
		$data['product_detail'] = $this->product_m->product_detail();
		$data['picture'] = $this->product_m->get_pic();

		$this->load->view('product_pict.php', $data);
	}
	function product_attribute()
	{
		$this->load->model('attribute_m');
		$data['title'] = 'Attribute';
		$data['breadc'] = $this->breadcrumb->show($data['title']);
		$data['page'] = 'catalog';
		$data['subpage'] = 'product';
		$data['mainmenu'] = $this->pages_model->menu();
		$data['subpages'] = $this->pages_model->submenu2();
		$data['product_detail'] = $this->product_m->product_detail();
		$data['attribute'] = $this->attribute_m->get_attrlist();
		$data['attr_stock'] = $this->attribute_m->get_attr_stock();
		$data['attr_check'] = $this->attribute_m->get_attr_check();

		$this->load->view('product_attr.php', $data);
	}
	
	function product_category()
	{
		$this->load->model('category_m');
		$data['title'] = 'Category';
		$data['breadc'] = $this->breadcrumb->show($data['title']);
		$data['page'] = 'catalog';
		$data['subpage'] = 'product';
		$data['mainmenu'] = $this->pages_model->menu();
		$data['subpages'] = $this->pages_model->submenu2();
		$data['product_detail'] = $this->product_m->product_detail();
		$data['cat_option'] =  $this->category_m->category_list();
		$data['discat'] = $this->product_m->display_category();
		$data['category'] = $this->product_m->get_cat();

		$this->load->view('product_cat.php', $data);
	}
	function price()
	{
		$data['title'] = 'Price & Tax';
		$data['breadc'] = $this->breadcrumb->show($data['title']);
		$data['page'] = 'catalog';
		$data['subpage'] = 'product';
		$data['mainmenu'] = $this->pages_model->menu();
		$data['subpages'] = $this->pages_model->submenu2();
		$data['product_detail'] = $this->product_m->product_detail();
		$data['price'] = $this->product_m->price();

		$this->load->view('product_price.php', $data);
	}
	function stock()
	{
		$data['title'] = 'Stock';
		$data['breadc'] = $this->breadcrumb->show($data['title']);
		$data['page'] = 'catalog';
		$data['subpage'] = 'product';
		$data['mainmenu'] = $this->pages_model->menu();
		$data['subpages'] = $this->pages_model->submenu2();
		$data['product_detail'] = $this->product_m->product_detail();
		$data['stock'] = $this->product_m->get_qty_pic();

		$this->load->view('product_stock.php', $data);
	}
	function stock_view(){

		$this->load->model('stock_m');
		$data['title'] = 'Stock';
		$data['breadc'] = $this->breadcrumb->show($data['title']);
		$data['page'] = 'catalog';
		$data['subpage'] = 'product';
		$data['mainmenu'] = $this->pages_model->menu();
		$data['subpages'] = $this->pages_model->submenu2();
		$data['product_detail'] = $this->product_m->product_detail();
		$data['stock_view'] = $this->stock_m->get_stock_view();
		$data['stock_pic'] = $this->stock_m->get_stock_pic();
		$data['tag'] = $this->product_m->get_tag_all();
		$data['my_tag'] = $this->product_m->get_tag_stock_select();

		$this->load->view('product_stock_view.php', $data);
	}
	
	// **** edit page **** //
	function prod_save()
	{
		$data['page'] = 'catalog';
		$data['subpage'] = 'product';
		$code = $this->product_m->prod_save();
		if($this->input->post("productid"))
		{
			if($this->input->post("product") AND $this->input->post("code"))
			{
				if(!$code)
				{
					redirect('product/add', 'refresh');
				}
				else
				{
					redirect('product/price/'.$this->input->post("productid"), 'refresh');
				}
			}
			else
			{
				redirect('product/add', 'refresh');
			}
		}
		else
		{
			//redirect('catalog/product', 'refresh');
			redirect('product/picture/'.$this->db->insert_id());
		}
	}
	
	function prod_import_save()
	{
		$this->load->library('image_lib'); 
		$config['upload_path'] = './../assets/excel/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg|xls|xlsx';
		$config['overwrite'] = TRUE;
		$this->load->library('upload', $config);
		
		if (!$this->upload->do_upload("fileImport"))  {
			echo 'gagal';exit;
		} else {
			if ($this->product_m->prod_import_save($this->upload->file_name))
			{
				$this->load->library('excel');
				$inputFileName = '../assets/excel/'.$this->upload->file_name;
				try {
					$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
				} catch(Exception $e) {
					die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
				}
				$sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
				//$objPHPExcel->getWorksheetIterator
				/* echo "<table>"; */
				
				//print_r($sheetData);exit;
				foreach($sheetData as $sd){
					//echo $sd['A'].'<br>';
					
					//echo $this->replaceForprice($sd['B']);exit; 
					//check code if exists
					$checkCodeProduct = $this->db->get_where('zpxf_product',array('code'=>$sd['A']))->row();
					 
					if(count($checkCodeProduct)>0){
						$qty = array(
							'qty'=>$sd['C'],
						);
						$this->db->where('id_product',$checkCodeProduct->id_product);
						$this->db->update('zpxf_product_stock',$qty);
						$price = array(
							'base_price'=>$this->replaceForprice($sd['B']),
						);
						$this->db->where('id_product',$checkCodeProduct->id_product);
						$this->db->update('zpxf_product_price',$price);
						//echo 's';
						 
						
					}else{
					
					//for alias
					$alias = strtolower(url_title($sd['A'], '-'));		
					$cek=0;
					$this->db->from("product");
							   
							$this->db->where("alias",$alias)->limit(1);
							$query = $this->db->get();
							if ($query->num_rows()>0)
							{	$cek = 1; } // dia pasti ada

					$i=1;
					$newalias = $alias;
					while($cek)
					{
						
								$cek = 0;
								$newalias = $alias.'-'.$i;
								$this->db->from("product");
								$this->db->where("alias",$newalias)->limit(1);

								$query = $this->db->get();
								if ($query->num_rows()>0)
								{	$cek = 1;	}
								$i++;
					}
					//end alias
						
						$code = array(
						    'alias'=>$newalias,//strtolower(url_title($sd['A'], '-')),
							'name'=>$sd['A'],
							'code'=>$sd['A'],
							'status'=>'unprocess',
						);
						$this->db->insert('zpxf_product',$code);
						$price = array(
							'id_product'=>$this->db->insert_id(),
							'base_price'=>$this->replaceForprice($sd['B']),
						);
						$qty = array(
							'id_product'=>$this->db->insert_id(),
							'qty'=>$sd['C']
						);
						
						$this->db->insert('zpxf_product_price',$price);
						$this->db->insert('zpxf_product_stock',$qty);
						
						//echo 's';
						
					}
					
					
				}
				$this->session->set_flashdata('success',"imported successfully");		
				redirect('product/import');
			}
		}
				
	}
	
	function cat_save()
	{
		$this->load->model('category_m');
		$this->category_m->cat_save();
		redirect('product/product_category/'.$this->input->post("position"), 'refresh');
	}
	function price_save(){
		$this->product_m->price_save();
		redirect('product/price/'.$this->input->post("id_prod"), 'refresh');
	}
	function attr_save(){
		$this->load->model('attribute_m');
		$this->attribute_m->attr_save();
		redirect('product/product_attribute/'.$this->input->post("idproduct"), 'refresh');
	}
	function delete_attr(){
		$this->load->model('attribute_m');
		$this->attribute_m->attr_delete();
		redirect('product/product_attribute/'.$this->uri->segment(3), 'refresh');
	}
	function photo_save(){
		$this->load->library('image_lib'); 
		$data['page'] = 'catalog';
		$data['subpage'] = 'product';
		$config['upload_path'] = './../assets/upload/product/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['overwrite'] = TRUE;
		$this->load->library('upload', $config);
		
		if (!$this->upload->do_upload("img"))  {
			$error = array('error' => $this->upload->display_errors());
			
			if(@$nFile == '')
			{	$hasil = 1;	}
			else
			{	$hasil = 0;	}
		}
		else {	$hasil = 1;	}  
		
		$photos = $this->product_m->photo_setting();
		foreach($photos as $ph)
		{
			$name = $ph->name;
			$width = $ph->width;
			$height = $ph->height;
			
			if($name === 's'){
				$config25['image_library'] = 'gd2';
				$config25['source_image'] = $this->upload->upload_path.$this->upload->file_name;
				$config25['new_image'] = './../assets/upload/product/s';
				$config25['maintain_ratio'] = TRUE;
				$config25['create_thumb'] = TRUE;
				$config25['overwrite'] = TRUE;
				$config25['thumb_marker'] = '_px'.$width;
				$config25['width'] = $width;
				$config25['height'] = $height;
				
				$this->image_lib->initialize($config25);
				if ( !$this->image_lib->resize()){
					$this->session->set_flashdata('errors', $this->image_lib->display_errors('', ''));   
				}
			}
			
			if($name === 'm')
			{
				$config135['image_library'] = 'gd2';
				$config135['source_image'] = $this->upload->upload_path.$this->upload->file_name;
				$config135['new_image'] = './../assets/upload/product/m';
				$config135['maintain_ratio'] = TRUE;
				$config135['create_thumb'] = TRUE;
				$config135['overwrite'] = TRUE;
				$config135['thumb_marker'] = '_px'.$width;
				$config135['width'] = $width;
				$config135['height'] = $height;
				
				$this->image_lib->initialize($config135);
				if ( !$this->image_lib->resize()){
					$this->session->set_flashdata('errors', $this->image_lib->display_errors('', ''));   
				}
			}

			if($name === 'l')
			{
				$config347['image_library'] = 'gd2';
				$config347['source_image'] = $this->upload->upload_path.$this->upload->file_name;
				$config347['new_image'] = './../assets/upload/product/l';
				$config347['maintain_ratio'] = TRUE;
				$config347['create_thumb'] = TRUE;
				$config347['overwrite'] = TRUE;
				$config347['thumb_marker'] = '_px'.$width;
				$config347['width'] = $width;
				$config347['height'] = $height;
				
				$this->image_lib->initialize($config347);
				if ( !$this->image_lib->resize()){
					$this->session->set_flashdata('errors', $this->image_lib->display_errors('', ''));   
				}
			}
			$name = '';
			$width = '';
			$height = '';

		}

		if($hasil == 1)
		{
			$aFile = $this->upload->data();
			$nFile = $aFile['file_name'];
			$nFile_explode = explode('.',$aFile['file_name']);
			
			$nfile_25_array = array($nFile_explode[0],@$config25['thumb_marker']);
			$nfile_25 = implode('',$nfile_25_array);
			$nfile_25_array = array($nfile_25,@$nFile_explode[1]);
			$nfile_25 = implode('.',$nfile_25_array);
			
			$nfile_135_array = array($nFile_explode[0],@$config135['thumb_marker']);
			$nfile_135 = implode('',$nfile_135_array);
			$nfile_135_array = array($nfile_135,@$nFile_explode[1]);
			$nfile_135 = implode('.',$nfile_135_array);
			
			$nfile_347_array = array($nFile_explode[0],@$config347['thumb_marker']);
			$nfile_347 = implode('',$nfile_347_array);
			$nfile_347_array = array($nfile_347,@$nFile_explode[1]);
			$nfile_347 = implode('.',$nfile_347_array);

			$this->product_m->save_photo($nFile,$nfile_25,$nfile_135,$nfile_347);
		}
		else
		{
			print_r($error);
		}
		
		redirect('product/picture/'.$this->input->post("position"), 'refresh');
	}
	function stock_save(){
		
		if($this->input->post("id_prod_stock"))
		{
			$this->load->model('email_m');
			$this->load->library('email');
			$uname = $this->session->userdata('sess_username');
			$usermail = $this->email_m->getuser($uname);
			foreach($usermail as $um)
			{
				$email = $um->email;
				$firstname = $um->firstname;
				$lastname = $um->lastname;
			}
			$config = Array(
			  'mailtype' => 'html',
			  'protocol' => 'sendmail',
			  'mailpath' => '/usr/sbin/sendmail',
			  'smtp_user' => 'philip@pixaal.com', // change it to yours
			  'charset' => 'iso-8859-1',
			  'wordwrap' => TRUE
			);		
			$this->email->initialize($config);
			
			$prodstock = $this->stock_m->get_stock_info($this->input->post("id_prod_stock"));
			foreach($prodstock as $nm)
			{
				if($nm->email AND ($nm->qty == 0))
				{

					$this->email->clear();
					$this->email->set_mailtype("html");
					$this->email->to($nm->email);
					$this->email->from($email, $firstname.' '.$lastname);
					
					//$this->email->cc("chilimanjatroh@yahoo.co.id");
					$this->email->subject("Your product is avaiable");
					$this->email->message(
					'
					<table >
 <tr>
	<td style="background:#ccc; height:35px; padding-left:15px;" colspan=3><img src="http://demopi.com/permata/assets/img/logo.png" ></td>
</tr>
<tr>
	<td style="border:solid 1px #ccc"><img src="http://demopi.com/permata/assets/upload/product/m/closet-1-techdraw_th.jpg" ></td>
	<td style="border:solid 1px #ccc">Kloset 1</td>
	<td style="border:solid 1px #ccc">250.000 IDR</td>
</tr>
</table>
					');
					$this->email->send();
					$this->stock_m->delete_notif($nm->email);

				}
			}
			
		}
		$this->stock_m->stock_save();
		redirect('product/stock/'.$this->input->post("id_prod"), 'refresh');
	}
	function stock_info_save(){
		$id_stock = $this->input->post("id_prod_stock");
		$id_prod = $this->input->post("id_product");
		$this->stock_m->stock_info_save();
		redirect('product/stock_view/'.$id_prod.'/'.$id_stock, 'refresh');
	}
	function cover_change(){
		$id = $this->uri->segment(3);
		$this->product_m->cover_change();
		redirect('product/picture/'.$id, 'refresh');
	}
	function pic_enable(){
		$this->load->library('session');
		$id = $this->uri->segment(3);
		$enable = $this->uri->segment(5);
		$this->product_m->pic_enable();

		if($enable === '1') { $this->session->set_flashdata('message', 'Image Enable' ); }
		else { $this->session->set_flashdata('message', 'Image Disable' ); }
		$data['flash_message'] = $this->session->flashdata('message');

		redirect('product/picture/'.$id.'/enable/'.$enable, 'refresh');
	}
	function pic_delete(){
		$this->product_m->pic_delete();
		redirect('product/picture/'.$this->uri->segment(3), 'refresh');
	}
	
	// ---------------- *** Sugestion *** ------------------------ //
	public function suggestions()
	{
		$this->load->model('product_m');
		$term = $this->input->post('term',TRUE);
		$newterm = explode(",",$term);
		
		if (strlen($term) < 2) break;
		
		$rows = $this->product_m->GetAutocompleteCategory(array('keyword' => $term));

		$json_array = array();
		if($rows)
		{
			foreach ($rows as $row)
				 array_push($json_array, $row->tag);

			echo json_encode($json_array);
		}
		else return;
	}
}
