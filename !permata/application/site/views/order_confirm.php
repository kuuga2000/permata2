<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $this->load->view('0header'); ?>

<div id="order-confirm" class="body-wrapper">
	<div class="cb" style="height:10px;"></div>
	
	
	<h2>MY ACCOUNT</h2>
	<div class="cb" style="border-top:2px solid #bdbbbb; margin-bottom:20px; margin-top:5px;"></div>
	
	<?php $this->load->view('0member_header'); ?>
	
	<span style="font-size:18px;">Is this your Order ?</span>
	
	<div class="cb" style="height:10px;"></div>
	
	<table cellpadding="0" cellspacing="0" border="0" style="line-height:35px;">
		<tr><td width="145">First Name </td><td>: <?php echo $delivery->fname;?></td></tr>
		<tr><td width="145">Last Name </td><td>: <?php echo $delivery->lname;?></td></tr>
		<tr><td width="145">Email </td><td>: <?php echo $account->email;?></td></tr>
		<tr><td width="145">Address </td><td>: <?php echo $delivery->address;?></td></tr>
		<tr><td width="145">Country </td><td>: <?php echo $delivery->country;?></td></tr>
		<tr><td width="145">City </td><td>: <?php echo $delivery->city;?></td></tr>
		<tr><td width="145">Postcode </td><td>: <?php echo $delivery->postcode;?></td></tr>
		<tr><td width="145">Mobile Phone </td><td>: <?php echo $account->phone;?></td></tr>
	</table>
	
	<div class="cb" style="height:45px;"></div>
	
	<table id="product-list">
		<tr>
			<td class="title">DESCRIPTION</td>
			<td class="title" width="130">YOUR OPTIONS</td>
			<td class="title" width="175">PRICE</td>
		</tr>
		<?php 
		$totalprice = 0;
		foreach($product AS $key => $val) { 
			if($val->disc_type == "Percent") { $percent = '%'; } else { $percent = ''; }
			$nettprice 		= $val->base_price * $val->qty * (100-($val->disc)) * 0.01;
			$totalprice 	+= $nettprice;
		?>
		<tr>
			<td>
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
					<?php echo $this->product_model->getNameByID($val->id_product)->name;?>
					<br /><br />
					CODE : <?php echo $val->id_product;?> <br />
					DISCOUNT : <?php echo $val->disc,$percent;?>
				</div>
				<div class="cb"></div>
			</td>
			<td>
				Quantity : <?php echo $val->qty;?>
			</td>
			<td>
				Total : IDR <?php echo $this->currency->idr($nettprice);?>
			</td>
		</tr>
		<?php 
		}
		$grand = $totalprice;	?>
		<tr>
			<td colspan="3" align="right" style="font-size:16px;">
				Sub Total : IDR <?php echo $this->currency->idr($totalprice);?><br />
				<?php if($order->voucher_code != '') { $vcr_value = $this->voucher_model->getDetail($order->voucher_code)->vcr_value; $grand -= $vcr_value; ?>Voucher Discount : IDR <?php echo $vcr_value;?><br /> <?php }?>
				<?php if($order->credit_balance_used != '0') { $grand -= $order->credit_balance_used; ?>Credit Balance Used : IDR <?php echo $order->credit_balance_used;?><br /> <?php }?>
				<!-- Shipping Cost : IDR <?php echo $order->shipping_cost?><br /><br />-->
				Total Due Ammount : IDR <?php echo $this->currency->idr($order->total_orders)?><br /><br />
			</td>
		</tr>
	</table>
	<div class="cb" style="height:10px;"></div>
	
	<a href="<?php echo base_url('account/confirm2/'.$order->invoice_number);?>"><div class="red-button" style="float:right; margin-right:0px;">CONTINUE</div></a>
	<a href="<?php echo base_url('account/order_history');?>"><div class="gray-button" style="float:right; margin-right:10px;">BACK</div></a>
	
	<div class="cb"></div>
</div>
<?php $this->load->view('0footer'); ?>