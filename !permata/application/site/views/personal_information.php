<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $this->load->view('0header'); ?>

<div id="personal-information" class="body-wrapper">
	<div class="cb" style="height:10px;"></div>
	<style>
	table tr td { vertical-align:top; }
	</style>
	
	<h1>MY ACCOUNT</h1>
	<div class="cb" style="border-top:2px solid #bdbbbb; margin-bottom:20px; margin-top:5px;"></div>
	
	<?php $this->load->view('0member_header'); ?>
	
	<div style="float:left; margin-right:50px;">
		<?php echo form_open('account/update'); ?>
		<h2>GENERAL INFORMATION</h2>
		<div class="cb" style="height:10px;"></div>
		<?php if ($this->session->flashdata('valid')) echo '<div class="validmsg">'.$this->session->flashdata('valid').'</div>'; ?>
		
		<table cellpadding="0" cellspacing="0" border="0" width="370">
			<tr><td>First name</td><td>:</td><td><input type="text" name="fname" value="<?php echo $account->firstname; ?>" /></td></tr>
			<tr><td>Last Name</td><td>:</td><td><input type="text" name="lname" value="<?php echo $account->lastname; ?>" /></td></tr>
			<tr><td>Address</td><td>:</td><td><textarea name="address" class="txarea"><?php echo $account->address; ?></textarea></td></tr>
			<tr><td>Phone Number</td><td>:</td><td><input type="text" name="phone"  value="<?php echo $account->phone; ?>" /></td></tr>
			<tr><td>City</td><td>:</td><td><input type="text" name="city" value="<?php echo $account->city; ?>" /></td></tr>
			<tr><td>Postcode</td><td>:</td><td><input type="text" name="postcode" value="<?php echo $account->postcode; ?>" /></td></tr>
			<tr><td></td><td></td><td>
				<?php if ($this->session->flashdata('fail')) echo '<div class="errmsg">'.$this->session->flashdata('fail').'</div><br />'; ?>
				<input type="submit" class="red-button" value="SAVE" />
			</td></tr>
		</table>
		<?php echo form_close(); ?>
	</div>
	
	<div style="float:left;">
		<?php echo form_open('account/change_password'); ?>
		<h2>YOUR EMAIL ADDRESS & PASSWORD</h2>
		<div class="cb" style="height:10px;"></div>
		<?php if ($this->session->flashdata('validpass')) echo '<div class="validmsg">'.$this->session->flashdata('validpass').'</div>'; ?>
		
		<table cellpadding="0" cellspacing="0" border="0">
			<tr><td>Email</td><td>:</td><td><input type="text" name="email" value="<?php echo $account->email; ?>" disabled="disabled" /></td></tr>
			<tr><td>New Password<span class="red">*</span></td><td>:</td><td><input type="password" name="pass" value="" /></td></tr>
			<tr><td>Confirm New Password<span class="red">*</span></td><td>:</td><td><input type="password" name="passconf" value="" /></td></tr>
			<tr><td></td><td></td><td>
			<?php if ($this->session->flashdata('failpass')) echo '<div class="errmsg">'.$this->session->flashdata('failpass').'</div><br />'; ?>
			<input type="submit" class="red-button" value="CHANGE PASSWORD" style="width:180px;" />
			</td></tr>
		</table>
		<?php echo form_close(); ?>
	</div>
	<div class="cb"></div>
</div>
<?php $this->load->view('0footer'); ?>