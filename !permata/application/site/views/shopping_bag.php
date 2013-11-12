<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $this->load->view('0header'); ?>
<?php $this->load->view('0breadcrumb'); ?>

<div class="cb" style="height:15px;"></div>

<div id="shopping-bag" class="body-wrapper">
	<h1>My Shopping Bag</h1>
	
	<div class="cb" style="border:1px solid #bfbdbd; margin-bottom:25px;"></div>
	
	<?php if(isset($product)) { ?>
	<table id="product-list">
		<tr>
			<td class="title">DESCRIPTION</td>
			<td class="title" width="130">YOUR OPTIONS</td>
			<td class="title" width="175">PRICE</td>
		</tr>
		<?php $totalprice = 0; foreach($product AS $val) {
		$qtySelected 	= $shop_cart[$val->id_product];
		$nettprice 		= $val->base_price * $qtySelected * (100 - $val->disc) / 100;
		$totalprice 	+= $nettprice;
		?>
		<tr>
			<td>
				<?php 
				if($val->qty <= 0) {
					echo "<div class='errmsg'>* This item has no longer available</div>";
				} ?>
				<div class="image">
					<?php
					if($this->product_model->pic($val->id_product)) {
						foreach($this->product_model->pic($val->id_product) AS $val_thumb) { ?>
					<img src="<?php echo base_url('assets/upload/product/m/'.$val_thumb->thumb135);?>" />
						<?php 
						}
					} ?>
				</div>
				<div class="description">
					<?php echo $val->name;?>
					<br /><br />
					CODE : <?php echo $val->code;?>
				</div>
				<div class="cb"></div>
			</td>
			<td>
				<?php if($val->qty > 0) { ?>
				Quantity : 
				<?php echo form_open_multipart('checkout', array('class' => 'changeQty', 'autocomplete' => 'off')); ?>
				<input type="hidden" name="product_id" value="<?php echo $val->id_product;?>" />
				<select name="qty">
					<?php echo $val->id_product; for($i = 1; $i <= $val->qty; $i++) { ?>
					<option value="<?php echo $i;?>" <?php echo ($i == $qtySelected ? "selected":"");?>><?php echo $i;?></option>
					<?php }?>
				</select>
				<?php echo form_close(); ?>
				<br />
				<?php }?>
				
				<a class="remove-link" href="<?php echo base_url('checkout/remove/'.$val->id_product);?>">remove</a>
			</td>
			<td>
				Total : IDR <?php echo $nettprice;?>
			</td>
		</tr>
		<?php } ?>
	</table>
	
	<div class="cb" style="height:16px;"></div>
	
	<div id="voucher-code" class="fleft">
		<h2>Voucher Code</h2>
		<div class="cb" style="border:1px solid #bfbdbd; margin-bottom:25px;"></div>
		If you have a promotion code or student card please enter it here:
		<div class="cb" style="height:25px;"></div>
		Voucher Code
		<?php echo form_open_multipart('checkout/voucher', array('id' => 'formVoucher', 'autocomplete' => 'off')); ?>
			<input type="text" name="voucher_code" class="fleft" />
			<input type="submit" class="red-button" value="VERIFY CODE" />
		<?php echo form_close(); ?>
		<div class='cb'></div>
		<?php 
		if(isset($wrong_voucher))
			echo '<div style="color:red; font-style:italic;">'.lang('global_checkout.shopping_bag.wrongvoucher', '').'</div>';
		?>
	</div>
	
	<div id="total" class="fright">
		Product total : IDR <?php echo $totalprice;?> <br/>
		<?php
		$grand = $totalprice;
		$voucher_active = $this->session->userdata('voucher');
		if($voucher_active == '') {
			echo '<span style="font-size:10px;">(except discount from voucher)</span> <br/>';
		} else {
			$voucher_info = $this->voucher_model->getDetail($voucher_active);
			$grand -= $voucher_info->vcr_value;
			echo '<span style="font-size:10px;">Promotion Code : '.$voucher_active.'('.$voucher_info->vcr_caption.')</span> <br/><span style="font-size:16px;">IDR '.$voucher_info->vcr_value.'</span> <br/>';
		}
		?> 
		<?php
		if($this->session->userdata("sess_account")) {
			$account_balance = $this->account_model->get_balance($this->session->userdata("sess_account"))->account_balance;
			if($account_balance > 0) {
				echo '<span style="font-size:10px;">Account Balance Used : </span> <br/><span style="font-size:16px;">IDR '.($account_balance > $grand ? $grand : $account_balance).'</span>';
				$grand = ($grand > $account_balance ? $grand-$account_balance : 0);
			}
		}
		?>
		
		<br/>
		<span style="font-size:16px;">Sub Total : IDR <?php echo $grand;?></span> <br/>
		<br/>
		<a href="<?php echo base_url('checkout/account')?>"><div class="gray-button" style="float:right;">CHECK OUT</div></a>
	</div>
	
	<div class="cb" style="height:20px;"></div>
	
	<div id="footnote">
		<?php echo lang('global_checkout.shopping_bag.footnote', '');?>
	</div>
	
	<a href="<?php echo base_url('product/featured/new')?>"><div class="red-button" style="width:182px; margin-right:0px; float:right;">CONTINUE SHOPPING</div></a>
	
	<div class="cb"></div>
	
	<?php } else { ?>
	<?php echo lang('global_checkout.shopping_bag.empty', '');?>
	<div class="cb" style="height:400px;"></div>
	<?php } ?>
</div>
<script>$(function(){
	$(".changeQty select").change(function(){
		$(this).parent().submit();
	});
});</script>
<?php $this->load->view('0footer'); ?>
