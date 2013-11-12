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
				<a  href="<?php echo site_url(); ?>settings/<?php echo $p->alias; ?>">
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
					<div class="float_r button-create"><?php echo anchor('settings/notification_send','Send Notifications') ?></div>
					<div class="float_r button-search" >
					<?php echo form_open('settings'); ?>
						<input type="text" name="search" placeholder="Search">
						<input type="button" class="icon-search">
					<?php echo form_close(); ?>
					</div>
					<h1><?php echo $title; ?></h1>
					<div class='display'>
						<div class='display-head'>
							<div class='col-260'>Email</div>
							<div class='col-80'>Photo</div>
							<div class='col-120'>Product</div>
							<div class='col-120'>Price</div>
							<div class='col-120'>Discount</div>
						</div>
						<div class="clear"></div>
						<div class='display-page'>
						
						<?php
	
						foreach ($data_all as $all) {
						if($all->disc_type){ $disc = '%'; } else { $disc = '';}
								echo 
							   '<div class="page-list">
								<div class="col-260" style="background:none;">'.$all->email.'&nbsp</b></div>
								<div class="col-80" style="background:none;"><img src="'.$site_url.'/assets/upload/product/s/'.$all->thumb25.'" title="'.$all->thumb25.'" alt="'.$all->thumb25.'">&nbsp</b></div>
								<div class="col-120" style="background:none;">'.$all->name.'&nbsp</b></div>
								<div class="col-120" style="background:none;">'.number_format($all->base_price, 0, ',', '.').'&nbsp</b></div>
								<div class="col-120" style="background:none;">'.number_format($all->disc, 0, ',', '.').' '.$disc.'&nbsp</b></div>
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
