<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $this->load->view('0header'); ?>

<div class="cb" style="height:15px;"></div>

<div id="delivery" class="body-wrapper">
	<div class="fleft"><h1>Delivery</h1></div>
	<div class="fright">
		<div class="step"></div>
		<div class="step active"></div>
		<div class="step"></div>
		<div class="step"></div>
	</div>
	<div class="cb" style="border:1px solid #bfbdbd; margin-bottom:25px;"></div>
	
	<div class="col">
		<h2>Delivery Details</h2>
		<div class="cb" style="border:1px solid #bfbdbd; margin-bottom:25px;"></div>
		
		<div id="full-address"></div>
		
		<div class="cb" style="height:20px;"></div>
		
		<?php echo form_open('checkout/payment', array('id' => 'fDelivery')); ?>
			<?php $ai = 1; foreach($address AS $addr) { ?>
			<div class="address-item <?php echo $ai == 1 ? 'active' : false; ?>">
				<input type="radio" name="address" value="<?php echo $addr->id_address; ?>" <?php echo $ai == 1 ? 'checked="checked"' : false; ?> > <?php echo $addr->address.', '.$addr->city.', '.$addr->country; ?>
			</div>
			<?php $ai++; } ?>
			<br />
			<div>
				<a href="<?php echo site_url('checkout/delivery/add'); ?>"><div class="red-button" style="float:left; width:168px; margin-right:140px; margin-top:20px;">ADD NEW ADDRESS</div></a>
			</div>
		<?php echo form_close(); ?>
	</div>
	<script>$(function(){
		var address_full = new Array();
		<?php foreach($address AS $addr) { ?>
		address_full[<?php echo $addr->id_address; ?>] = "<?php echo str_replace(array("\n", "\t", "\r"), "",
			$addr->fname.' '.$addr->lname.'<br />'
			.$addr->phone.'<br />'
			.$addr->address.'<br />'
			.$addr->postcode.'<br />'
			.$addr->city.', '.$addr->country.'<br />'); ?>";
		<?php }?>
		$(".address-item").click(function(){
			$(".address-item.active").removeClass('active');
			$(this).addClass('active');
			
			var thisRadio = $(this).find('input[type="radio"]');
			var i = thisRadio.val();
			$('input[name="address"]').removeAttr(("checked"));
			thisRadio.attr("checked", true);
			$("#full-address").html(address_full[i]);
		});
		
		$(".address-item.active").click();
		
		$('#topayment').click(function(e){
			e.preventDefault();
			$('#fDelivery').submit();
		});
	});</script>
	
	<?php $this->load->view('0minicart'); ?>
	<a href="<?php echo site_url('checkout/payment'); ?>" id="topayment"><div class="red-button" style="float:right; width:168px; margin-right:140px; margin-top:20px;">CONFIRM PAYMENT</div></a>
	<div class="cb"></div>
</div>
<?php $this->load->view('0footer'); ?>
