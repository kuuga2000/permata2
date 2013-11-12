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
				<a href="<?php echo site_url(); ?>catalog/<?php echo $p->alias; ?>">
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
					<div class="float_r button-add"><?php echo anchor('brand/add','Add') ?></div>
					<div class="float_r button-search" >
					<?php echo form_open('catalog/brand'); ?>
						<input type="text" name="search" placeholder="Search">
						<input type="button" class="icon-search">
					<?php echo form_close(); ?>
					</div>
					<h1><?php echo $title; ?></h1>
					<div class='display'>
						<div class='display-head'>
						<!--<div class='col-120'>Photo</div>-->
							<div class='col-380'>Manufacturer Name</div>
							<div class='col-40'>Action</div>
						</div>
						<div class="clear"></div>
						<div class='display-page'>
						
						<?php
						foreach ($data_all as $all) {
						
						if($all->enable == 1)	$icon = 'class="ui-icon ui-icon-check"';	else	$icon = 'class="ui-icon ui-icon-close"';
						if($all->deskripsi_enable == 1)	$iconhotdeal = 'class="ui-icon ui-icon-check"';	else	$iconhotdeal = 'class="ui-icon ui-icon-close"';
						
						if($all->logo) $imgsrc = '<img src="'.$site_url.'/assets/upload/manufacturer/'.$all->logo.'" title="'.$all->manuf_name.'" alt="'.$all->manuf_name.'"  height="40">';
						else $imgsrc = '&nbsp';
						
							echo 
							   '<div class="page-list">';
							//	<div class="col-120" style="background:none;">'.$imgsrc.'&nbsp</b></div>
						echo	'<div class="col-380" style="font-weight:bold; background:none;"><span><b>'.$all->manuf_name.'</b></span></div>
								<div class="col-40" style="font-weight:bold; background:none;"><span>'.anchor($subpage.'/information/'.$all->id_manufacturer,'[View]').'</span></div>
								<div class="col-40 deleteform" style="font-weight:bold; background:none;"><span>'.anchor($subpage.'/delete/'.$all->id_manufacturer,'[Delete]').'</span></div>
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
