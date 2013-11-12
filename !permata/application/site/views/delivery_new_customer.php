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
		<h2>Delivery Address</h2>
		<div class="cb" style="border:1px solid #bfbdbd; margin-bottom:25px;"></div>
		
		<div id="form-add-address">
			<form method="post" action="#">
				First Name<span class="red">*</span> 	<br />
				<input type="text" name="firstname" />		<br />
				Last Name<span class="red">*</span>		<br />
				<input type="text" name="lastname" />	<br />
				Phone Number<span class="red">*</span>		<br />
				<input type="text" name="phone" />	<br />
				New Address Line<span class="red">*</span>		<br />
				<textarea type="text" name="address" ></textarea>	<br />
				City<span class="red">*</span>		<br />
				<select name="city">
					<?php foreach($city AS $key => $val) { ?>
					<option value="<?php echo $key;?>"><?php echo $val;?></option>
					<?php } ?>
				</select>	<br />
				Post Code<span class="red">*</span>		<br />
				<input type="text" name="postcode" />	<br />
			</form>
		</div>
	</div>
	
	<?php $this->load->view('0minicart'); ?>
	<div class="red-button" style="float:right; width:168px; margin-right:140px; margin-top:20px;">CONFIRM PAYMENT</div>
	
	<div class="cb"></div>
</div>
<?php $this->load->view('0footer'); ?>
