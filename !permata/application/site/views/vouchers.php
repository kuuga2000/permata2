<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $this->load->view('0header'); ?>

<div id="vouchers" class="body-wrapper">
	<div class="cb" style="height:10px;"></div>
	
	
	<h1>MY ACCOUNT</h1>
	<div class="cb" style="border-top:2px solid #bdbbbb; margin-bottom:20px; margin-top:5px;"></div>
	
	<?php $this->load->view('0member_header'); ?>
	
	<?php if ($this->session->flashdata('valid')) echo '<div class="validmsg">'.$this->session->flashdata('valid').'</div>'; ?>
	
	<span style="color:#8b8b8b;">This is your last credit balance for now.</span>
	
	<table cellpadding="0" cellspacing="0" border="0" style="line-height:35px; font-size:14px;">
		<tr><td width="145">Credit Balance	</td><td>: IDR <?php echo $account->account_balance; ?></td></tr>
	</table>
	<br /><br />
	<span style="color:#8b8b8b;">If you have a promotion code or student card please enter it here:</span>
	<?php echo form_open('account/vouchers/validate'); ?>
	<br /><br />
	Voucher Code
	<br />
	<?php if ($this->session->flashdata('fail')) echo '<div class="errmsg">'.$this->session->flashdata('fail').'</div>'; ?>
	<form>
	<input type="text" name="code" style="float:left;" /><input type="submit" class="red-button" value="VERIFY CODE" />
	<?php echo form_close(); ?>
	
	<div class="cb"></div>
</div>
<?php $this->load->view('0footer'); ?>