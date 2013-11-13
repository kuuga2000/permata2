<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<!DOCTYPE HTML>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title><?php $meta = meta_tags('meta_title', $page, isset($post) ? $post : false); echo ( $meta == '' ? $meta : 'Permata'); ?></title>
	<meta name="keywords" content="<?php echo meta_tags('meta_keywords', $page, isset($post) ? $post : false); ?>" />
	<meta name="description" content="<?php echo meta_tags('meta_description', $page, isset($post) ? $post : false); ?>" />
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo site_url('assets/img/favicon.png'); ?>" />

	<link rel="stylesheet" type="text/css" href="<?php echo site_url('assets/css/style.css'); ?>" />
	<script type="text/javascript" src="<?php echo site_url('assets/js/jquery-1.8.0.min.js'); ?>"></script>
	<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
</head>
<body>

<div id="top-gray">
	<div class="body-wrapper">
		<div id="account-cart" class="fleft">
			<?php if ($this->session->userdata('sess_account')) { ?>
			<a class="first" href="<?php echo base_url('account/personal_information');?>">Welcome <?php echo $this->session->userdata('sess_account'); ?></a> | 
			<a href="<?php echo base_url('account/sign_out');?>">Sign Out</a> | 
			<?php } else { ?>
			<a class="first" href="<?php echo base_url('checkout/account');?>">Create Account</a> | 
			<a href="<?php echo base_url('checkout/account');?>">Sign in</a> | 
			<?php } ?>
			<a href="<?php echo base_url('checkout');?>"><img src="<?php echo base_url('assets/css/img/cart-icon.png');?>" /> <?php echo count($this->session->userdata('shopping_cart')); ?> item(s)</a>
		</div>
		
		<div id="search-box" class="fright">
			<?php echo form_open('product/search', array('id' => 'fSearch')); ?>
				<input type="text" name="search-input" placeholder="Search" class="fleft" /><input type="submit" id="search-submit" value="" />
			<?php echo form_close(); ?>
		</div>
		<div class="cb"></div>
	</div>
</div>
<div class="cb"></div>

<div id="top-menu">
	<div class="body-wrapper">
		<div id="logo-block" class="fleft">
			<a href="<?php echo base_url()?>"><img src="<?php echo base_url('assets/img/logo.png')?>" /></a>
		</div>
		
		<div id="menu-list" class="fright">
			<?php
			if(!isset($selected_type))
				$selected_type = '';
			
			if ($this->pix_page->view('top')) {
				$ctr = 0; $totalmenu = count($this->pix_page->view('top'));
				foreach ($this->pix_page->view('top') as $p) { $ctr++;
				?>
			<div class="menu <?php echo ($p->template == $page ? "active":"");?>" <?php echo ($p->template == 'product' ? 'id="menu-product"':'');?> >
				<?php if($p->template == 'product') { ?>
				
				<div id="product-pop">
					<div id="product-white"></div>
					<div id="submenu-container">
						<?php
						$categories = $this->category_model->getlist();
						foreach($categories as $category){
							echo anchor('products/category/'.$category->alias,$category->name, array('class' => 'submenu '.($category->alias == $selected_type ? "active":"")) )."<br />";
						}
						?>
						<?php
						/*if ($this->pix_page->manufacturer()) {
							foreach ($this->pix_page->manufacturer() as $c) {
								echo anchor('products/manufacturer/'.$c->alias, $c->manuf_name, array('class' => 'submenu '.($c->alias == $selected_type ? "active":"")) )."<br />";
							}
						}*/
						?>
						
						<?php /*$ctr2 = 0; 
						if ($this->pix_page->featured()) {
							foreach($this->pix_page->featured() as $val) { $ctr2++;
								echo anchor('products/featured/'.strtolower($val->title), ucwords(strtolower($val->title)), array('class' => 'submenu '.(strtolower($val->title) == $selected_type ? "active":"")))."<br />";
							}
						}*/
						?>
					</div>
				</div>
				
				<?php }?>
				
				<?php echo anchor($p->template == 'home' ? false : $p->alias, strtoupper($p->title), array('class' => 'menu-item'.($ctr == $totalmenu ? ' last':''), 'style' => ($p->template == 'product' ? 'position:relative; z-index:0;':'') )); ?>
				
			</div>
			
			<?php if($ctr != $totalmenu) { ?>
			<div>|</div>
			<?php } ?>
			
				<?php
				} // end of foreach
			} // end of if
			?>
		</div>
	</div>
</div>

<script>
$(function(){
	$("#menu-product").hover(function(){
		$("#menu-list #product-pop").toggle();
	});
});
</script>

<div id="mybody" class="body-wrapper">
	