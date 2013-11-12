<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $this->load->view('0header'); ?>
<?php $this->load->view('0breadcrumb'); ?>

<div id="contact" class="body-wrapper">
	<div class="cb" style="height:10px;"></div>
	<div id="gmap-wrapper">
		<iframe width="946" height="396" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?q=<?php echo $page_detail->latitude;; ?>&amp;output=embed"></iframe>
	</div>
	
	<div class="cb" style="height:50px;"></div>
	
	<div class="col" style="margin-right:25px;">
		<div class="title"><?php echo lang('global_contact.ouroffice', '');?></div>
		<div class="cb" style="border-top:2px solid #bdbbbb; margin-bottom:22px; margin-top:5px;"></div>
		<div class="bodytext">
			<?php echo $page_detail->tx; ?>
		</div>
	</div>
	
	<div class="col">
		<div class="title"><?php echo lang('global_contact.contactform', '');?></div>
		<div class="cb" style="border-top:2px solid #bdbbbb; margin-bottom:22px; margin-top:5px;"></div>
		<?php echo form_open('contact/send', array('id' => 'contact-form')); ?>
			<table cellpadding="0" cellspacing="0" border="0">
				<tr><td width="145">Name</td><td width="10">:</td><td><input type="text" name="name" /></td></tr>
				<tr><td>Email</td><td>:</td><td><input type="text" name="email" /></td></tr>
				<tr><td>Address</td><td>:</td><td><input type="text" name="address" /></td></tr>
				<tr><td>Mobile Phone</td><td>:</td><td><input type="text" name="mobilephone" /></td></tr>
				<tr><td>Subject</td><td>:</td><td><input type="text" name="subject" /></td></tr>
				<tr><td style="vertical-align:top; padding-top:4px;">Message</td><td style="vertical-align:top; padding-top:4px;">:</td><td><textarea name="message"></textarea></td></tr>
				<tr><td></td><td></td><td><input type="submit" class="red-button" value="SUBMIT" style="width:125px; margin-right:20px;" /><input type="reset" class="red-button" value="RESET" style="width:125px;" /></td></tr>
			</table>
			<?php if ($this->session->flashdata('contact')) echo '<br /><div class="errmsg">'.$this->session->flashdata('contact').'</div>'; ?>
		<?php echo form_close(); ?>
	</div>
	
	<div class="cb"></div>
</div>
<?php $this->load->view('0footer'); ?>
