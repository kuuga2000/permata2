<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $this->load->view('0header'); ?>

<div class="cb" style="height:15px;"></div>

<div id="delivery-add-address" class="body-wrapper">
	<div class="fleft"><h1>Delivery Details</h1></div>
	<div class="fright">
		<div class="step"></div>
		<div class="step active"></div>
		<div class="step"></div>
		<div class="step"></div>
	</div>
	<div class="cb" style="border:1px solid #bfbdbd; margin-bottom:25px;"></div>
	
	<div class="col">
		<h2>Add New Delivery Address</h2>
		<div class="cb" style="border:1px solid #bfbdbd; margin-bottom:25px;"></div>
		
		<div id="form-add-address">
			<?php echo form_open('account/add_address', array('id' => 'fAddr')); ?>
				First Name<span class="red">*</span> 	<br />
				<input type="text" name="firstname" />		<br />
				Last Name<span class="red">*</span>		<br />
				<input type="text" name="lastname" />	<br />
				Phone Number<span class="red">*</span>		<br />
				<input type="text" name="phone" />	<br />
				New Address Line<span class="red">*</span>		<br />
				<textarea type="text" name="address" ></textarea>	<br />
				City<span class="red">*</span>		<br />
				<input type="text" name="city" />	<br />
				Country<span class="red">*</span>		<br />
				<input type="text" name="country" />	<br />
				Post Code<span class="red">*</span>		<br />
				<input type="text" name="postcode" />	<br />
				<?php if ($this->session->flashdata('addr_fail')) echo '<div class="errmsg">'.$this->session->flashdata('addr_fail').'</div>'; ?>
				<input type="submit" class="red-button" style="margin:12px 0px; width:175px;" value="USE THIS ADDRESS" />
			<?php echo form_close(); ?>
		</div>
	</div>
	
	<?php $this->load->view('0minicart'); ?>
	
	<div class="cb"></div>
</div>
<?php $this->load->view('0footer'); ?>
