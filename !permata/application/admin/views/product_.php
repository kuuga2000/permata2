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
				<a  href="<?php echo site_url(); ?>catalog/<?php echo $p->alias; ?>">
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
					<div class="float_r button-add"><?php echo anchor('product/add','Add') ?></div>
					<div class="float_r button-search" >
					<?php echo form_open('catalog/product'); ?>
						<input type="text" name="search" placeholder="Search">
						<input type="button" class="icon-search">
					<?php echo form_close(); ?>
					</div>
					<div class="float_r button-add" style="margin-right:10px;"><?php echo anchor('product/import','Import') ?></div>
					<h1><?php echo $title; ?></h1>
					<div class='display'>
						<div class='display-head'>
						    <div class='col-80'>Kode</div>
							<!--<div class='col-80'>Photo</div>-->
							<div class='col-120'>Product Name</div>
							<div class='col-120'>Brand Name</div>
							<div class='col-120'>Price</div>
							<div class="col-80">Status</div>
							<div class='col-80'>Action</div>
						</div>
						<div class="clear"></div>
						<div class='display-page'>
						
						<?php

						foreach ($data_all as $all) {
						$color = $all->status==='unprocess' ? 'orange' : 'none';	
					
						$actual_price = ($all->base_price * $all->tax)/100 + $all->base_price;
						if($all->base_price)
						{	$format_number = number_format($actual_price, 0, ',', '.'); $price = array($format_number,' Idr'); $price = implode('',$price); 	}
						else
						{	$price = '&nbsp'; }
						
						if($all->enable == 1)	$icon = 'class="ui-icon ui-icon-check"';	else	$icon = 'class="ui-icon ui-icon-close"';
						if($all->hotdeal == 1)	$iconhotdeal = 'class="ui-icon ui-icon-check"';	else	$iconhotdeal = 'class="ui-icon ui-icon-close"';
						
						if($all->thumb25) $imgsrc = '<img src="'.$site_url.'/assets/upload/product/s/'.urlencode($all->thumb25).'" title="'.$all->name.'" alt="'.$all->name.'">';
						else $imgsrc = '&nbsp';
						
														
							echo 
							   '<div class="page-list">
								<div class="col-80" style="font-weight:bold; background:none;">'.$all->code.'&nbsp</b></div>
								<!--<div class="col-80" style="font-weight:bold; background:none;">'.$imgsrc.'&nbsp</b></div>-->
								<div class="col-120" style="font-weight:bold; background:none;"><span><b>'.$all->name.'</b></span></div>
								<div class="col-120" style="font-weight:bold; background:none;"><span><b>'.$all->brand_name.'&nbsp</b></span></div>
								<div class="col-120" style="background:none;"><span><b>'.$price.'&nbsp</b></span></div>
								<div class="col-80" style="font-weight:bold; background:none;color:'.$color.';">'.$all->status.'&nbsp</b></div>
								<div class="col-40" style="font-weight:bold; background:none;"><span>'.anchor($subpage.'/information/'.$all->id_product,'[View]').'</span></div>
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
