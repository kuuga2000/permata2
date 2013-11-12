<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php include "system/global.php"; ?>
<?php $this->load->view('00header.php'); ?>
<div id="wrap">
<?php $this->load->view('00sidemenu.php'); ?>
	<div id="submenu-pages">
		<div id="submenuback"></div>
		<div id="submenuwrap">
			<div id="submenushadow"></div>
			<ul id="submenu">
				<?php
				foreach ($subpages as $p) {
					//if (priv_page($p->alias)) {
				?>
				<a href="<?php echo site_url(); ?><?php echo $page ?>/<?php echo $p->alias; ?>">
					<li>
						<div class="inner">
							<div class="title"><?php echo $p->name; ?></div>
							<div class="clear"></div>
						</div>
					</li>
				</a>
				<?php //}
				} ?>
			</ul>
		</div>
	</div>
	

	<div id="content" style="margin-left:357px;">
		<div id="content-wrap">
			<div id="content-body">
				<div class="wrap">
					<div id="breadcrumb"><?php	echo $breadc;	?></div>
					<div class="float_r button-add"><?php echo anchor('transactions/customers_setup','Add') ?></div>
					<div class="float_r button-search" >
					<?php echo form_open('transactions/customers'); ?>
						<input type="text" name="search" placeholder="Search">
						<input type="button" class="icon-search">
					<?php echo form_close(); ?>
					</div>
					<h1><?php echo $title; ?></h1>
					<div class='display'>
						<div class='display-head'>
							<div class='col-220'>Email</div>
							<div class='col-220'>Customer</div>
							<div class='col-120'>Phone</div>
						</div>
						<div class="clear"></div>
						<div class='display-page'>
						
						<?php
						foreach ($order_all as $all) {
						$name = $all->firstname.' '.$all->lastname;
							echo 
							   '<div class="page-list">
								<div class="col-220" style="background:none;"><span><b>'.$all->email.'&nbsp</b></span></div>
								<div class="col-220" style="background:none;">'.$name.'&nbsp</b></div>
								<div class="col-120" style="background:none;"><span><b>'.$all->phone.'&nbsp</b></span></div>
								<div class="col-40" style="font-weight:bold; background:none;"><span>'.anchor($subpage.'/customers_setup/'.$all->id_customer,'[View]').'</span></div>
								</div>';
						}
						?>
						</div>
					</div>
					
				</div>
				<div class="clear"></div>
				<?php echo '<div class="page-nums">'.$this->pagination->create_links().'</div>'?>
			</div>
			<div class="clear"></div>
		</div>
		<div class="clear"></div>
	</div>
</div>

<?php $this->load->view('00footer.php'); ?>
