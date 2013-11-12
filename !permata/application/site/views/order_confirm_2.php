<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $this->load->view('0header'); ?>

<div id="order-confirm-2" class="body-wrapper">
	<div class="cb" style="height:10px;"></div>
	
	
	<h2>MY ACCOUNT</h2>
	<div class="cb" style="border-top:2px solid #bdbbbb; margin-bottom:20px; margin-top:5px;"></div>
	
	<?php $this->load->view('0member_header'); ?>
	
	<div class="cb" style="height:10px;"></div>
	<?php if ($this->session->flashdata('confirm_fail')) echo '<br /><div class="errmsg">'.$this->session->flashdata('confirm_fail').'</div>'; ?>
	<?php if($status == "success") { ?>
	<?php echo lang('global_confirm.success', '');?>
	<?php } else {?>
	<?php echo form_open_multipart('account/confirm_submit', array('id' => 'formConfirm', 'autocomplete' => 'off')); ?>
	<input type="hidden" name="invoice_number" value="<?php echo $order->invoice_number;?>" />
	<table cellpadding="0" cellspacing="0" border="0">
		<tr><td>Order ID</td><td>:</td><td><?php echo $order->invoice_number;?></td></tr>
		<tr><td>Pay to </td><td>:</td><td>
			<select name="id_bank_acc">
				<?php 
				if($bank) {
					foreach($bank AS $valbank) {
				?>
				<option value="<?php echo $valbank->id_bank_acc;?>"><?php echo $valbank->payment_method . ' ' . $valbank->id_account . ' an : ' . $valbank->name_account ;?></option>
				<?php
					}
				}
				?>
			</select>
		</td></tr>
		<tr><td>Account Name</td><td>:</td><td><input type="text" name="name_account" /></td></tr>
		<tr><td>Account Number</td><td>:</td><td><input type="text" name="id_account" /></td></tr>
		<tr><td>Payment from</td><td>:</td><td><input type="text" name="bank_account" /></td></tr>
		<tr><td>Total Payment</td><td>:</td><td><input type="text" name="payment_value" /></td></tr>
		<tr><td>Transaction Date</td><td>:</td><td>
			<select name="date"><?php for($i = 1; $i <= 31; $i++ ) { echo "<option value='$i' ".($i == date("d") ? "selected":"").">$i</option>";	} ?></select>
			<select name="month"><?php for($i = 1; $i <= 12; $i++ ) { echo "<option value='$i' ".($i == date("m") ? "selected":"").">$i</option>";	} ?></select>
			<select name="year"><?php for($i = (int)date("Y"); $i >= ((int)date("Y")-1); $i-- ) { echo "<option value='$i'>$i</option>";	} ?></select>
		</td></tr>
		<tr><td></td><td></td><td>
			
			<input type="submit" class="red-button" value="CONTINUE" />
			<a href="<?php echo base_url('account/confirm/'.$order->invoice_number);?>"><div class="gray-button">BACK</div></a>
		</td></tr>
	</table>
	<?php }?>
	<?php echo form_close(); ?>
	<div class="cb"></div>
</div>
<?php $this->load->view('0footer'); ?>