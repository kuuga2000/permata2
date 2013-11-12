<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends MY_Controller {
	public function __construct()
	{
		parent::__construct();
		if ( ! $this->auth->signed_in())
			redirect();
		$this->load->model(array('news_m','lib','pages_model'));
		$this->load->library('breadcrumb');
	}

	public function index()
	{
		$this->load->library('pagination');
		$data['title'] = 'Pages';
		$data['breadc'] = $this->breadcrumb->show($data['title']);
		$data['page'] = 'pages';
		$data['subpage'] = 'pages';
		$data['mainmenu'] = $this->pages_model->menu();
		$data['subpages'] = $this->news_m->pages();
		$data['base_url'] = base_url().'pages/page';
		$data['total_rows'] = $this->lib->count_all('pages');
		$data['per_page'] = 6; 
		$data['uri_segment'] = 3;
		$this->pagination->initialize($data); 

		$this->load->view('pages', $data);
	}
	public function page()
	{
		$this->load->library('pagination');
		$data['title'] = 'Pages';
		$data['breadc'] = $this->breadcrumb->show($data['title']);
		$data['page'] = 'pages';
		$data['subpage'] = 'pages';
		$data['mainmenu'] = $this->pages_model->menu();
		$data['subpages'] = $this->news_m->pages();
		$data['base_url'] = base_url().'pages/page';
		$data['total_rows'] = $this->lib->count_all('pages');
		$data['per_page'] = 6; 
		$data['uri_segment'] = 3;
		$this->pagination->initialize($data); 

		$this->load->view('pages', $data);
	}
	function post(){
		$this->load->model('gallery_m');
		$this->load->library('pagination');
		$data['title'] = 'Post';
		$data['breadc'] = $this->breadcrumb->show($data['title']);
		$data['page'] = 'pages';
		$data['subpage'] = 'pages';
		$data['mainmenu'] = $this->pages_model->menu();
		$page = $this->uri->segment(4);
		$data['post_info'] = $this->news_m->get_pages_selected($page);

		$data['per_page'] = 6; 
		$data['uri_segment'] = 4;
		$data['base_url'] = base_url().'pages/post/'.$this->uri->segment(3);
		$data['post_list'] = $this->news_m->get_post(); $data['mode'] = '';
		$data['total_rows'] = $this->lib->count_page($this->uri->segment(3));
		$this->pagination->initialize($data); 
		
		$data['pages'] = $this->pagination->create_links();
		$this->load->view('pages_post.php', $data);
	}
	function post_gallery(){
		$this->load->model('gallery_m');
		$this->load->library('pagination');
		$data['title'] = 'Post';
		$data['breadc'] = $this->breadcrumb->show($data['title']);
		$data['page'] = 'pages';
		$data['subpage'] = 'pages';
		$data['mainmenu'] = $this->pages_model->menu();
		$post = $this->uri->segment(4);
		$data['post_info'] = $this->news_m->get_pages_selected($post);
		$data['post_list'] = $this->gallery_m->get_gallery_selected();
		
		$data['base_url'] = base_url().'pages/post_gallery/'.$this->uri->segment(3).'/'.$this->uri->segment(4);
		$data['uri_segment'] = 5;
		$data['total_rows'] = $this->gallery_m->count_gallery();
		$data['per_page'] = 6; 
		$this->pagination->initialize($data); 
		$data['pages'] = $this->pagination->create_links();
		$this->load->view('post_gallery', $data);
	}
	function post_edit()
	{
		$data['title'] = 'Post';
		$data['breadc'] = $this->breadcrumb->show($data['title']);
		$data['page'] = 'pages';
		$data['subpage'] = 'pages';
		$data['mainmenu'] = $this->pages_model->menu();
		$data['post_info'] = $this->news_m->get_pages_selected();
		$data['post_edit'] = $this->news_m->get_post_selected();

		$this->load->view('post_edit.php', $data);
	}
	function add()
	{
		$data['title'] = 'Pages Information';
		$data['breadc'] = $this->breadcrumb->show($data['title']);
		$data['page'] = 'pages';
		$data['subpage'] = 'pages';
		$data['mainmenu'] = $this->pages_model->menu();
		$data['subpages'] = $this->pages_model->submenu2();
		$data['page_list'] = $this->news_m->get_pages();
		$this->load->view('news_setup.php', $data);
	}
	function post_save(){
		
		if($this->input->post("title"))
		{
			$this->news_m->save_post();
			redirect('pages/post/'.$this->input->post('newpost'), 'refresh');
		}
		else
		{
			$this->session->set_flashdata('error',"Data you have entered is incomplete");
			redirect('pages/post_edit/'.$this->input->post('newpost'), 'refresh');
		}

	}
	function save_pages(){
		$nfile = '';
		$this->load->library('image_lib'); 
		$this->load->model('gallery_m'); 
		$config['upload_path'] = './../assets/upload/trash/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['overwrite'] = TRUE;
		$this->load->library('upload', $config);
		
		if (!$this->upload->do_upload("img"))  {
			$error = array('error' => $this->upload->display_errors());
			
			if($nfile == '')
			{	$hasil = 1;	}
			else
			{	$hasil = 0;	}
		}
		else {	$hasil = 1;	}  
		$photos = $this->gallery_m->gallery_setting(2);
		foreach($photos as $ph)
		{
			$width = $ph->width;
			$height = $ph->height;
		}
		$config135['image_library'] = 'gd2';
        $config135['source_image'] = $this->upload->upload_path.$this->upload->file_name;
        $config135['new_image'] = './../assets/img/page-banner/';
        $config135['maintain_ratio'] = FALSE;
        $config135['thumb_marker'] = '';
		$config135['overwrite'] = TRUE;
        $config135['width'] = @$width;
        $config135['height'] = @$height;
		
		$this->image_lib->initialize($config135);
		if ( !$this->image_lib->resize()){
			$this->session->set_flashdata('errors', $this->image_lib->display_errors('', ''));   
		}
		
		if($hasil == 1)
		{
			$aFile = $this->upload->data();
			$nfile = $aFile['file_name'];
			$nFile_explode = explode('.',$aFile['file_name']);
			
			$nfile_135_array = array($nFile_explode[0],$config135['thumb_marker']);
			$nfile_135 = implode('',$nfile_135_array);
			$nfile_135_array = array($nfile_135,@$nFile_explode[1]);
			$nfile = implode('.',$nfile_135_array);
			$this->news_m->save_pages($nfile);
		}
		else
		{
			print_r($error);
		}
		if($config135['source_image'])
		{
			@unlink($config135['source_image']);
		}
		redirect('pages', 'refresh');
	
	}
	function pages_edit(){
		$data['title'] = 'Pages Edit';
		$data['breadc'] = $this->breadcrumb->show($data['title']);
		$data['page'] = 'pages';
		$data['subpage'] = 'pages';
		$data['mainmenu'] = $this->pages_model->menu();
		$data['viewpages'] = $this->lib->get_selected('pages','id',$this->uri->segment(3));

		$this->load->view('pages_edit', $data);
	}
	function pages_enable(){
		$this->lib->change_enable('pages','id',$this->uri->segment(3),'status',$this->uri->segment(4)); // table,id_field,id_value,edited_field,edited_value
		redirect('pages', 'refresh');
	}
	function post_delete(){
		$this->news_m->delete_post();
		redirect('pages/post/'.$this->uri->segment(3), 'refresh');
	}
	function gallery(){
		$this->load->model('gallery_m');
		$data['title'] = 'Gallery';
		$data['breadc'] = $this->breadcrumb->show($data['title']);
		$data['page'] = 'pages';
		$data['subpage'] = 'pages';
		$data['mainmenu'] = $this->pages_model->menu();
		$data['gallery'] = $this->gallery_m->display_all();
		$data['data_home'] = $this->news_m->display_home();
		$this->load->view('gallery', $data);
	}
	function add_gallery(){
		$data['title'] = 'Add New Image';
		$data['breadc'] = $this->breadcrumb->show($data['title']);
		$data['page'] = 'pages';
		$data['subpage'] = 'pages';
		$data['mainmenu'] = $this->pages_model->menu();
		$this->load->view('gallery_add', $data);
	}
	function delete_gallery(){   
		$this->load->model('gallery_m'); 

		$this->gallery_m->delete_image();
		unlink(realpath('../assets/upload/gallery/'.$this->uri->segment(6)));
		redirect('pages/gallery/'.$this->uri->segment(3).'/'.$this->uri->segment(4).'/'.$this->uri->segment(5), 'refresh');
	}
	function delete_gallery_info(){
		$this->load->model('gallery_m'); 
		$this->gallery_m->delete_gallery_info();
		redirect('pages/post_gallery/'.$this->uri->segment(3).'/'.$this->uri->segment(4), 'refresh');
	}
	function save_home_gall(){
		if($this->input->post('idpost'))
		{
			$this->news_m->home_gall_save();
			$this->session->set_flashdata('info',"Data gallery successfully changed");
			redirect('pages/post_gallery/'.$this->input->post('idpagesnew').'/'.$this->input->post('idpostnew'), 'refresh');
		}
		else if($this->input->post("picture"))
		{

			$this->news_m->home_gall_save();
			$this->session->set_flashdata('alert',"Data you have entered is incomplete");
			redirect('pages/post_gallery/'.$this->input->post('idpagesnew').'/'.$this->input->post('idpostnew'), 'refresh');
		}
		else
		{
			$this->session->set_flashdata('error',"Please Insert Data");
			redirect('pages/gallery/'.$this->input->post('idpagesnew').'/'.$this->input->post('idpostnew'), 'refresh');
		}
	}
	public function save_new_gall(){
	
		$this->load->library('image_lib'); 
		$this->load->model('gallery_m'); 
		$config['upload_path'] = './../assets/upload/trash/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['overwrite'] = TRUE;
		$this->load->library('upload', $config);
		if (!$this->upload->do_upload("img"))  {
			$error = array('error' => $this->upload->display_errors());
		}
		
		if(@$error)
		{
			
			$this->session->set_flashdata('error',"Image you have entered is empty");
			redirect('pages/add_gallery/'.$this->input->post('idpage').'/'.$this->input->post('idpost'), 'refresh');
		}
		else
		{
			$this->session->set_flashdata('success',"Data gallery successfully added");
		if($this->input->post("idpost") == 26){ $idsetting = 1; }
		if($this->input->post("idpost") == 27){ $idsetting = 2; }
		$photos = $this->gallery_m->gallery_setting($idsetting);
		foreach($photos as $ph)
		{
			$width = $ph->width;
			$height = $ph->height;
		}
		$config135['image_library'] = 'gd2';
        $config135['source_image'] = $this->upload->upload_path.$this->upload->file_name;
        $config135['new_image'] = './../assets/upload/gallery/';
        $config135['maintain_ratio'] = FALSE;
        $config135['thumb_marker'] = '';
		$config135['overwrite'] = TRUE;
        $config135['width'] = @$width;
        $config135['height'] = @$height;
		
		$this->image_lib->initialize($config135);
		if ( !$this->image_lib->resize()){
			$this->session->set_flashdata('errors', $this->image_lib->display_errors('', ''));   
		}
		
		$aFile = $this->upload->data();
		$nFile = $aFile['file_name'];
		$nFile_explode = explode('.',$aFile['file_name']);
		
		$nfile_135_array = array($nFile_explode[0],$config135['thumb_marker']);
		$nfile_135 = implode('',$nfile_135_array);
		$nfile_135_array = array($nfile_135,@$nFile_explode[1]);
		$nfile = implode('.',$nfile_135_array);

		$this->gallery_m->save_image($nfile);

		if($config135['source_image'])
		{
			@unlink($config135['source_image']);
		}
		redirect('pages/post_gallery/'.$this->input->post('idpage').'/'.$this->input->post('idpost'), 'refresh');
		}
	}
}
