<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php include "system/global.php"; ?>
<?php $this->load->view('00header.php'); ?>
<div id="wrap">
<?php $this->load->view('00sidemenu.php'); ?>
	<div id="content" style="margin-left:157px;">
		<div id="content-wrap">
			<div id="content-body">
				<div class="wrap">
					<div id="breadcrumb"><?php	echo $breadc;	?></div>
					<h1><?php echo $title; ?></h1>
					<div class='display'>
					<?php echo form_open_multipart('pages/save_new_gall'); ?>
					<input type="hidden" name="idpage" value="<?php echo $this->uri->segment(3); ?>">
					<input type="hidden" name="idpost" value="<?php echo $this->uri->segment(4); ?>">
					<div class="float"><div class='label col-80'>Image File</div></div><div class='float' style="margin-top:8px;"><input type='file' name='img'></div>
					<div class="clear"></div>
					<div class="float"><input type="submit" name="submit" value="Save"></div>
					<div class="clear"></div>
					<?php echo form_close(); ?>
					</div>
					
				</div>
				<div class="clear"></div>
				
			</div>
			<div class="clear"></div>
		</div>
		<div class="clear"></div>
	</div>

</div>

<?php $this->load->view('00footer.php'); ?>
