<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $this->load->view('0header'); ?>

<div class="cb" style="height:15px;"></div>

<div id="payment" class="body-wrapper">
	<div class="fleft"><h1>Payment Details</h1></div>
	<div class="fright">
		<div class="step"></div>
		<div class="step"></div>
		<div class="step active"></div>
		<div class="step"></div>
	</div>
	<div class="cb" style="border:1px solid #bfbdbd; margin-bottom:25px;"></div>
	
	<div class="col">
		<h2>Payment Details</h2>
		<div class="cb" style="border:1px solid #bfbdbd; margin-bottom:25px;"></div>
		
		<span style="font-size:11px;">
			Highlight your payment option below. For store cards only enter an expiry date and security number if you have one. Paypal customers click 'confirm and pay' to proceed.
		</span>
		
		<?php echo form_open('checkout/thank', array('id' => 'fPayment')); ?>
			<input type="hidden" name="payaddr" value="<?php echo $pay_address; ?>" />
			<br />
			<div id="payment-choices">
			PLEASE SELECT YOUR PAYMENT METHOD :
			<?php $i =0; foreach($bank AS $b) { $i++; ?>
				<div>
					<input type="radio" name="payment" value="<?php echo $b->id_bank_acc; ?>" <?php echo ($i == 1 ? "checked='checked'":"");?> >
					<div class="customradio <?php echo ($i == 1 ? "active":"");?>"><div class="fill"></div></div> <?php echo $b->payment_method; ?> <br />
				</div>
			<?php } ?>
				<div>
					<input type="radio" name="payment" value="paypal" <?php echo ($i == 0 ? "checked='checked'":"");?> >
					<div class="customradio <?php echo ($i == 0 ? "active":"");?>"><div class="fill"></div></div> Paypal <br />
				</div>
			<br />
			</div>
			
		<?php echo form_close(); ?>
		<?php if ($this->session->flashdata('payment_error')) echo '<br /><div class="errmsg">'.$this->session->flashdata('payment_error').'</div>'; ?>
	</div>
	<script>$(function(){
		$("#payment-choices .customradio").click(function(){
			$('input[name="payment"]').removeAttr(("checked"));
			$(this).siblings('input[type="radio"]').attr('checked', true);
			$("#payment-choices .customradio.active").removeClass('active');
			$(this).addClass('active');
		});
		
		$("#shipping-choices .customradio").click(function(){
			$('input[name="shipping"]').removeAttr(("checked"));
			$(this).siblings('input[type="radio"]').attr('checked', true);
			$("#shipping-choices .customradio.active").removeClass('active');
			$(this).addClass('active');
		});
		
		$('#tothank').click(function(e){
			e.preventDefault();
			$('#fPayment').submit();
		});
		
	});</script>
	
	<?php $this->load->view('0minicart'); ?>
	<a href="<?php echo site_url('checkout/thank'); ?>" id="tothank"><div class="red-button" style="float:right; width:168px; margin-right:140px; margin-top:20px;">CONFIRM PAYMENT</div></a>
	<div class="cb"></div>
</div>
<?php $this->load->view('0footer'); ?>
