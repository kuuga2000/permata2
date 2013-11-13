<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>	

<div class="col last">
	<h2>My Bag</h2>
	<div class="cb" style="border:1px solid #bfbdbd; margin-bottom:25px;"></div>
	<?php if(isset($product)) { ?>
		<?php 
		$totalprice = 0; foreach($product AS $val) {
			$qtySelected 	= $shop_cart[$val->id_product]; 
			$nettprice 		= $val->base_price * $qtySelected * (100-($val->disc)) * 0.01;
			//$totalprice 	+= $nettprice;?>
			<?php 
			if($val->qty <= 0) {
				echo "<div class='errmsg'>* This item has no longer available</div>";
			} ?>
			<div class="image">
			<?php if($this->product_model->pic($val->id_product)) {
					foreach($this->product_model->pic($val->id_product) AS $val_thumb) { ?>
				<img src="<?php echo base_url('assets/upload/product/m/'.$val_thumb->thumb135);?>" width="100" />
					<?php 
					}
				} ?>
			</div>
			<div class="description">
				<div class="title"><?php echo $val->name;?></div>
				<br />
				CODE : <?php echo $val->code;?>
				<br />
				Quantity : <?php echo ($val->qty > 0) ? $qtySelected : '-';?>
				<br />
				<a class="remove-link" href="<?php echo base_url('checkout');?>">
					edit
				</a> | 
				<a class="remove-link" href="<?php echo base_url('checkout/remove/'.$val->id_product);?>">
					remove
				</a>
				<br />
				IDR
				<?php 
				
				if($val->disc==0 && $val->diskonManufaktur!==0){
					$disc = ($val->base_price - ($val->base_price * $val->diskonManufaktur/100))*$qtySelected;
					echo $this->currency->idr($disc);
					
					 
				}
				
				if($val->disc!=0 && $val->diskonManufaktur!=0){
					$disc = ($val->base_price - ($val->base_price * $val->disc/100))*$qtySelected;
					echo $this->currency->idr($disc);	
					 
				}
				
				if($val->disc!=0 && $val->diskonManufaktur==0){
					$disc = ($disc = $val->base_price - ($val->base_price * $val->disc/100))*$qtySelected;
					echo $this->currency->idr($disc);
					 
				}
				$totalprice 	+= $disc;
				?>
				 <?php //echo $this->currency->idr($nettprice);?>
			</div>
			
			<div class="cb" style="border:1px solid #bfbdbd; margin-bottom:25px;"></div>
		<?php } ?>
		<div id="sub-total">
			Sub Total : IDR <?php echo $this->currency->idr($totalprice);?><br />
			
			<?php
			$grand = $totalprice;
			$voucher_active = $this->session->userdata('voucher');
			if($voucher_active != '') {
				$voucher_info = $this->voucher_model->getDetail($voucher_active);
				$grand -= $voucher_info->vcr_value;
				echo 'Discount Voucher : IDR '.$voucher_info->vcr_value.'<br />';
			}
			?>
			
			<?php
			if($this->session->userdata("sess_account")) {
				$account_balance = $this->account_model->get_balance($this->session->userdata("sess_account"))->account_balance;
				if($account_balance > 0) {
					echo 'Account Balance Used : IDR '.($account_balance > $grand ? $grand : $account_balance).'<br />';
					$grand = ($grand > $account_balance ? $grand-$account_balance : 0);
				}
			}
			?>
			
			<?php
			if(isset($shipping_cost))
				echo '<br />Shipping Cost : IDR <?php echo $shipping_cost; ?><br />';
			?>
			<br />
			
			Total Due Ammount : IDR <?php echo $this->currency->idr($grand); ?>
		</div>
	<?php } else { ?>
	<?php echo lang('global_checkout.shopping_bag.empty', '');?>
	<div class="cb" style="height:400px;"></div>
	<?php } ?>

</div>
