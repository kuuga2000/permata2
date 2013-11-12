<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $this->load->view('0header'); ?>

<div class="cb" style="height:15px;"></div>

<div id="account" class="body-wrapper">
	<div class="fleft"><h1>Sign In</h1></div>
	<div class="fright">
		<div class="step active"></div>
		<div class="step"></div>
		<div class="step"></div>
		<div class="step"></div>
	</div>
	<div class="cb" style="border:1px solid #bfbdbd; margin-bottom:25px;"></div>
	
	<div class="col">
		<?php if(isset($resetpass_succeed)) { ?><div id="warn"><?php echo $resetpass_succeed['cpr']?></div><?php }?>
		<h2>Retuning Customer</h2>
		<div class="cb" style="border:1px solid #bfbdbd; margin-bottom:25px;"></div>
		
		<div id="form-signin">
			<?php echo form_open('account/sign_in', array('id' => 'fSignin')); ?>
				Email<span class="red">*</span>
				<br />
				<input type="text" name="email" />
				<br />
				Password<span class="red">*</span>
				<br />
				<input type="password" name="password" />
				<br />
				<input type="checkbox" name="remember_me" /> <span style="font-size:11px;">Remember Me </span>
				<br />
				<?php if ($this->session->flashdata('signin_fail')) echo '<br /><div class="errmsg">'.$this->session->flashdata('signin_fail').'</div>'; ?>
				<input type="submit" class="red-button" style="margin:12px 0px; width:86px;" value="SIGN IN" />
			<?php echo form_close(); ?>
		</div>
		
		<div class="cb"></div>
		
		<div class="fleft offline-link" id="bt-show-forgot">Forgotten Your Password ?</div>
		<img class="fleft" src="<?php echo site_url('assets/css/img/information.png'); ?>" style="margin-top:3px; margin-left:5px;" />
		<div class="cb" style="height:10px;"></div>
		
		<div id="form-forgotpass" style="display:<?php echo (($this->session->flashdata('reset_valid') OR $this->session->flashdata('reset_fail')) ? "block":"none");?>;">
			<?php echo form_open('account/reset_password', array('id' => 'fResetpass')); ?>
				Email Address<span class="red">*</span>
				<br />
				<input type="text" name="email" />
				<br />
				<?php if ($this->session->flashdata('reset_valid')) echo '<div class="validmsg">'.$this->session->flashdata('reset_valid').'</div>'; ?>
				<?php if ($this->session->flashdata('reset_fail')) echo '<div class="errmsg">'.$this->session->flashdata('reset_fail').'</div>'; ?>
				<input type="submit" class="red-button" style="margin:12px 0px; width:165px;" value="RESET PASSWORD" />
			<?php echo form_close(); ?>
		</div>
	</div>
	
	
	<div class="col">
		<h2>New Customers</h2>
		<div class="cb" style="border:1px solid #bfbdbd; margin-bottom:25px;"></div>
		
		Use our quick checkout process
		<div class="red-button" id="bt-show-register" style="margin:12px 0px;">PROCEED</div>
		<div class="cb"></div>
		
		<div class="offline-link" id="bt-show-register2">Create an account and make your shopping easier.</div>
		
		<div class="cb" style="height:10px;"></div>
		
		<div id="form-register" style="display:<?php echo ($this->session->flashdata('reg_fail') ? "block":"none")?>;">
			<?php echo form_open('account/register', array('id' => 'fRegister')); ?>
				Email<span class="red">*</span>
				<br />
				<input type="text" name="email" />
				<br />
				Password<span class="red">*</span>
				<br />
				<input type="password" name="password" />
				<br />
				Confirm Password<span class="red">*</span>
				<br />
				<input type="password" name="passwordconf" />
				<br />
				<input type="checkbox" name="newsletter" /> <span style="font-size:11px;">Please sign me up to the weekly newsletter  </span>
				<br />
				<input type="checkbox" name="remember_me" /> <span style="font-size:11px;">Remember Me </span>
				<br />
				<?php if ($this->session->flashdata('reg_fail')) echo '<br /><div class="errmsg">'.$this->session->flashdata('reg_fail').'</div>'; ?>
				<input type="submit" class="red-button" style="margin:12px 0px; width:86px;" value="SIGN IN" />
			<?php echo form_close(); ?>
		</div>
	</div>
	
	
	<?php $this->load->view('0minicart'); ?>
	
	<div class="cb"></div>
</div>

<script>$(function(){
	$("#bt-show-forgot").click(function(){
		$("#form-forgotpass").slideToggle();
	});
	
	$("#bt-show-register, #bt-show-register2").click(function(){
		$("#form-register").slideToggle();
	});
});</script>
<?php $this->load->view('0footer'); ?>
