<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $this->load->view('0header'); ?>

<div class="cb" style="height:15px;"></div>

<div id="thank-you" class="body-wrapper">
	<div class="fleft"><h1>Thank You</h1></div>
	<div class="fright">
		<div class="step"></div>
		<div class="step"></div>
		<div class="step"></div>
		<div class="step active"></div>
	</div>
	<div class="cb" style="border:1px solid #bfbdbd; margin-bottom:25px;"></div>
	
	<?php if($payment_type == 'paypal') { ?>
	<h2><?php echo lang('global_checkout.thank.title', '');?></h2>
	<?php echo lang('global_checkout.thank.text', '').$this->session->userdata('sess_account');?>
	<?php }?>
	
	<div class="cb" style="height:30px;"></div>
	
	<table cellpadding="0" cellspacing="0" border="0" style="font-size:16px; color:#555555; line-height:30px;">
	<tr><td width="170">YOUR ORDER ID</td> 		<td>: <?php echo $orderid;?></td></tr>
	<tr><td>YOUR TOTAL ORDER</td> 						<td>: IDR <?php echo $total;?></td></tr>
	</table>
	
	<div class="cb" style="height:50px;"></div>
	
	<?php if($payment_type == 'bank') { ?>
	<div class="col" style="margin-right:25px;">
		<div class="title">Payment Details</div>
		<div class="cb" style="border-top:2px solid #bdbbbb; margin-bottom:22px; margin-top:5px;"></div>
		<div class="bodytext">
			<?php echo $rekening->payment_method." : ".$rekening->id_account." an ".$rekening->name_account;?><br />
			<?php echo lang('global_checkout.thank.confirm_note', '');?>
			<p style="margin-top: 15px;">
				<b style="font-weight: bolder;">
					<font color="red">*</font><?=$shipping['jabodetabek'];?><br>
					<font color="red">*</font><?=$shipping['other'];?>
				</b>
			</p>
		</div>
	</div>
	<?php } ?>
	
	<div class="col">
		<div class="title">Shipping To</div>
		<div class="cb" style="border-top:2px solid #bdbbbb; margin-bottom:22px; margin-top:5px;"></div>
		<div class="bodytext">
			<?php echo str_replace(array("\n", "\t", "\r"), "",
			$addr->fname.' '.$addr->lname.'<br />'
			.$addr->phone.'<br />'
			.$addr->address.'<br />'
			.$addr->postcode.'<br />'
			.$addr->city.', '.$addr->country.'<br />'); ?>
		</div>
		<br />
		
		<a href="<?php echo base_url();?>"><div class="red-button" style="width:162px;">RETURN TO SHOP</div></a>
	</div>
	
	<div class="cb"></div>
</div>
<?php $this->load->view('0footer'); ?>
