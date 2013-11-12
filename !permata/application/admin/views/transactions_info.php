<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $this->load->view('00header.php'); ?>
<div id="wrap">
<?php $this->load->view('00sidemenu.php'); ?>

	<div id="submenu-pages">
		<div id="submenuback"></div>
		<div id="submenuwrap">
			<div id="submenushadow"></div>
			<ul id="submenu">
				<?php
				foreach ($subpages as $p) {
					//if (priv_page($p->alias)) {
				?>
				<a href="<?php echo site_url(); ?><?php echo $page; ?>/<?php echo $p->alias; ?>">
					<li>
						<div class="inner">
							<div class="title"><?php echo $p->name; ?></div>
							<div class="clear"></div>
						</div>
					</li>
				</a>
				<?php //}
				} ?>
			</ul>
		</div>
	</div>
	

	<div id="content" style="margin-left:357px;">
		<div id="content-wrap">
			<div id="content-body">
				<div class="wrap">
					<div id="breadcrumb"><?php	echo $breadc;	?></div>
					<h1><?php echo $title; ?> <span style="color:#333;">[ <?php echo $this->uri->segment(3) ?> ]</span></h1>
					<div class='display'>
					<br>
					<?php
		$waiting_check = '';
		$accept_check = '';
		$error_check = '';
		$deliver_check = '';
		$cancel_check = '';
	foreach($customer_info as $cinfo)
	{
		$name = $customer_info->firstname.' '.$customer_info->lastname;
		$order_date = date ("d F Y",strtotime($customer_info->date));
		$order_date_edit = date ("d/m/Y",strtotime($customer_info->date));
		$payment_date = date ("d F Y",strtotime($customer_info->payment_date));
		$payment_date_edit = date ("d/m/Y",strtotime($customer_info->payment_date));
		$shipping_date = date ("d F Y",strtotime($customer_info->shipping_date));
		$shipping_date_edit = date ("d/m/Y",strtotime($customer_info->shipping_date));
		if($order_date == '01 January 1970') { $order_date = '-'; $order_date_edit = '';}
		if($payment_date == '01 January 1970') { $payment_date = '-'; $payment_date_edit = '';}
		if($shipping_date == '01 January 1970') { $shipping_date = '-'; $shipping_date_edit = '';}

		$payment_method = $customer_info->payment_method;
		$shipping_cost = $customer_info->shipping_cost;
		$id_account = $customer_info->id_account;
		$invoice_address = $customer_info->invoice_address;
		$invoice_postcode = $customer_info->invoice_postcode;
		$invoice_city = $customer_info->invoice_city;
		$bank_account = $customer_info->bank_account;
		$name_account = $customer_info->name_account;
		$idaddr = $customer_info->id_address;
		$shipping_city = $customer_info->shipping_city;
		$shipping_address = $customer_info->shipping_address;
		$shipping_postcode = $customer_info->shipping_postcode;
		if($customer_info->waiting) $waiting_check = 'checked';
		if($customer_info->accept) $accept_check = 'checked';
		if($customer_info->error) $error_check = 'checked';
		if($customer_info->deliver) $deliver_check = 'checked';
		if($customer_info->cancel) $cancel_check = 'checked';

		if($customer_info->total_orders)
		{	
			$format_number = number_format($customer_info->total_orders, 0, ',', '.'); 
			$total_orders = $format_number.' Idr';
		}
		else
		{	$total_orders = '&nbsp'; }
	}
?>
					<?php echo form_open($subpage.'/edit_date');  ?>
					<div class='float' style="border:#ccc dotted 1px; padding:15px; width:350px; margin-bottom:15px; margin-right:15px;">
					<div class='float margin-label' style="margin-bottom:-30px;"><div class='label'><strong>Customer Information</strong></div></div>
					<div class="clear"></div>
					<hr>
					<div class='float margin-label'><div class='label col-120'>Customer</div></div>
					<div class="float" style="width:10px;">:</div>
					<div class='float' style="width:190px;"><?php echo $name; ?></div>
					<div class="clear"></div>
					<div class='float margin-label'><div class='label col-120'>Order Date</div></div>
					<div class="float" style="width:10px;">:</div>
					<div class='float' style="width:190px;"><?php echo $order_date; ?>
					<?php 
					
					echo '<input type="hidden" name="idorder" value="'.$this->uri->segment(3).'" >'; 
					/*
					if($this->uri->segment(4) == 'edit_date')
					{	echo '<input type="text" name="orderdate" class="datepicker" value="'.$order_date_edit.'" style="width:100px; margin-top:-5px;">';		}
					else
					{	echo $order_date; 			}*/
					?>
					</div>
					<div class="clear"></div>
					<div class='float margin-label'><div class='label col-120'>Payment Date</div></div>
					<div class="float" style="width:10px;">:</div>
					<div class='float' style="width:190px;"><?php echo $payment_date; ?>
					<?php 
					/*if($this->uri->segment(4) == 'edit_date')
					{	echo '<input type="text" name="paymentdate" class="datepicker" value="'.$payment_date_edit.'" style="width:100px; margin-top:-5px;">';		}
					else
					{	echo $payment_date; 			}*/
					?>
					</div>
					<div class="clear"></div>
					<div class='float margin-label'><div class='label col-120'>Shipping Date</div></div>
					<div class="float" style="width:10px;">:</div>
					<div class='float' style="width:190px;">
					<?php 
					if($this->uri->segment(4) == 'edit_date')
					{	echo '<input type="text" name="shippingdate" class="datepicker" value="'.$shipping_date_edit.'" style="width:100px; margin-top:-5px;">';		}
					else
					{	echo $shipping_date; 			}
					?>
					</div>
					<div class="clear"></div>
					<div class='float margin-label'><div class='label col-120'>Total Order</div></div>
					<div class="float" style="width:10px;">:</div>
					<div class='float' style="width:190px;"><?php echo $total_orders; ?></div>
					<div class="clear"></div>
					<hr>
					<div class="float_r submitform">
					<?php
					if($this->uri->segment(4) == 'edit_date')
					{	echo '<input style="" type="submit" value="[ Save ]">'; echo anchor('transactions/information/'.$this->uri->segment(3),'[ Cancel ]');		}
					else
					{	echo anchor('transactions/information/'.$this->uri->segment(3).'/edit_date','[ Edit ]'); }
					
					?>
					</div>
					<?php echo form_close(); ?>
					<div class="clear"></div>
					</div>
					<?php // -------------------------- *** Payment Info *** --------------------------------- // ?>
					<?php echo form_open($subpage.'/edit_payment_info');  ?>
					<div class='float' style="border:#ccc dotted 1px; padding:15px; width:350px;">
					<div class='float margin-label' style="margin-bottom:-30px;"><div class='label'><strong>Payment Information</strong></div></div>
					<div class="clear"></div>
					<hr>
					<!--<div class='float margin-label'><div class='label col-120'>Payment Method</div></div>
					<div class="float" style="width:10px;">:</div>
					<div class='float' style="width:190px;">-->
					<?php
					
					echo '<input type="hidden" name="idorder" value="'.$this->uri->segment(3).'" >'; 
					/*
					if($this->uri->segment(4) == 'edit_payment_info')
					{	echo '<input type="text" name="payment_method" value="'.$payment_method.'" style="width:180px; margin-top:-5px;">';		}
					else
					{	echo $payment_method; }*/
					?>
					<!--</div>-->
					<div class="clear"></div>
					<div class='float margin-label'><div class='label col-120'>Bank Account</div></div>
					<div class="float" style="width:10px;">:</div>
					<div class='float' style="width:190px;"><?php echo $bank_account; ?>
					<?php
					/*if($this->uri->segment(4) == 'edit_payment_info')
					{	echo '<input type="text" name="bank_account" value="'.$bank_account.'" style="width:180px; margin-top:-5px;">';		}
					else
					{	echo $bank_account; }*/
					?>
					</div>
					<div class="clear"></div>
					<div class='float margin-label'><div class='label col-120'>Name Account</div></div>
					<div class="float" style="width:10px;">:</div>
					<div class='float' style="width:190px;"><?php echo $name_account; ?>
					<?php
					/*if($this->uri->segment(4) == 'edit_payment_info')
					{	echo '<input type="text" name="name_account" value="'.$name_account.'" style="width:180px; margin-top:-5px;">';		}
					else
					{	echo $name_account; }*/
					?>
					</div>
					<div class="clear"></div>
					<div class='float margin-label'><div class='label col-120'>ID Account</div></div>
					<div class="float" style="width:10px;">:</div>
					<div class='float' style="width:190px;"><?php echo $id_account; ?>
					<?php
					/*if($this->uri->segment(4) == 'edit_payment_info')
					{	echo '<input type="text" name="idaccount" value="'.$id_account.'" style="width:180px; margin-top:-5px;">';		}
					else
					{	echo $id_account; }*/
					?>
					</div>
					<div class="clear"></div>
					<div class='float margin-label'><div class='label col-120'>Transaction Status</div></div>
					<div class="float" style="width:10px;">:</div>
					<div class='float' style="width:190px;">
					<?php
					if($name_account AND $id_account AND $bank_account)
					{
						echo '<input type="checkbox" name="wait" value="1" checked disabled> Payment Confirm <br>';
					}
					else { echo '<input type="checkbox" name="wait" value="1" disabled> Payment Confirm <br>'; }
					?>
						<input type="checkbox" name="accept" value="1" <?php if($this->uri->segment(4) == 'edit_payment_info') echo ''; else echo 'disabled'; ?> <?php echo $accept_check; ?>> Payment Approved<br>
						<input type="checkbox" name="errorr" value="1" <?php if($this->uri->segment(4) == 'edit_payment_info') echo ''; else echo 'disabled'; ?> <?php echo $error_check; ?>> Payment Error<br>
						<input type="checkbox" name="deliver" value="1" <?php if($this->uri->segment(4) == 'edit_payment_info') echo ''; else echo 'disabled'; ?> <?php echo $deliver_check; ?>> Delivered<br>
						<input type="checkbox" name="cancel" value="1" <?php if($this->uri->segment(4) == 'edit_payment_info') echo ''; else echo 'disabled'; ?> <?php echo $cancel_check; ?>> Order Cancel<br>
					</div>
					<div class="clear"></div>
					<hr>
					<div class="float_r submitform">
					<?php
					if($this->uri->segment(4) == 'edit_payment_info')
					{	echo '<input style="" type="submit" value="[ Save ]">'; echo anchor('transactions/information/'.$this->uri->segment(3),'[ Cancel ]');		}
					else
					{	echo anchor('transactions/information/'.$this->uri->segment(3).'/edit_payment_info','[ Edit ]'); }
					?>
					</div>
					<?php echo form_close(); ?>
					<div class="clear"></div>
					</div>
					<div class="clear"></div>
					<br>
					<h2>Shipping Detail</h2>
					
					<!--<div class='float' style="border:#ccc dotted 1px; padding:15px; width:350px; margin-right:15px;  margin-bottom:15px;">
					<div class='float margin-label' style="margin-bottom:-30px;"><div class='label'><strong>Invoice Address</strong></div></div>
					<div class="clear"></div>
					<hr>
					<div class='float margin-label'><div class='label col-120'>Address</div></div>
					<div class="float" style="width:10px;">:</div>
					<div class='float' style="width:190px;"><?php echo $invoice_address; ?></div>
					<div class="clear"></div>
					<div class='float margin-label'><div class='label col-120'>Postcode</div></div>
					<div class="float" style="width:10px;">:</div>
					<div class='float' style="width:190px;"><?php echo $invoice_postcode; ?></div>
					<div class="clear"></div>
					<div class='float margin-label'><div class='label col-120'>City</div></div>
					<div class="float" style="width:10px;">:</div>
					<div class='float' style="width:190px;"><?php echo $invoice_city; ?></div>
					<div class="clear"></div>
					</div>-->
					<?php // -------------------------- *** Shipping Info *** --------------------------------- // ?>
					<?php echo form_open($subpage.'/edit_shipping_info');  ?>
					<div class='float' style="border:#ccc dotted 1px; padding:15px; width:350px;  margin-bottom:15px;">
					<div class='float margin-label' style="margin-bottom:-30px;"><div class='label'><strong>Shipping Address</strong></div></div>
					<div class="clear"></div>
					<hr>
					<div class='float margin-label'><div class='label col-120'>Address</div></div>
					<div class="float" style="width:10px;">:</div>
					<div class='float' style="width:190px;">
					<?php
					echo '<input type="hidden" name="idorder" value="'.$this->uri->segment(3).'" >'; 
					echo '<input type="hidden" name="idaddr" value="'.$idaddr.'" >'; 
					if($this->uri->segment(4) == 'edit_shipping_info')
					{	echo '<input type="text" name="shipping_address" value="'.$shipping_address.'" style="width:180px; margin-top:-5px;">';		}
					else
					{	echo $shipping_address; }
					?>
					</div>
					<div class="clear"></div>
					<div class='float margin-label'><div class='label col-120'>Postcode</div></div>
					<div class="float" style="width:10px;">:</div>
					<div class='float' style="width:190px;">
					<?php
					if($this->uri->segment(4) == 'edit_shipping_info')
					{	echo '<input type="text" name="shipping_postcode" value="'.$shipping_postcode.'" style="width:180px; margin-top:-5px;">';		}
					else
					{	echo $shipping_postcode; }
					?>
					</div>
					<div class="clear"></div>
					<div class='float margin-label'><div class='label col-120'>City</div></div>
					<div class="float" style="width:10px;">:</div>
					<div class='float' style="width:190px;">
					<?php
					if($this->uri->segment(4) == 'edit_shipping_info')
					{	echo '<input type="text" name="shipping_city" value="'.$shipping_city.'" style="width:180px; margin-top:-5px;">';		}
					else
					{	echo $shipping_city; }
					?>
					</div>
					<div class="clear"></div>
					<hr>
					<div class="clear"></div>
					<?php 
					if($this->uri->segment(4) == 'edit_shipping_info')
					{
					if($shipping_addr)  echo 'Or use your other destination';
					foreach($shipping_addr as $sat)
					{
						if($idaddr != $sat->id_address)
						{
					?>
					<div class="float" style="border:solid 1px #ccc; padding:5px 5px 5px 15px; background:#eee; width:325px; margin-bottom:2px;">
						<div class="float"><input style="margin-top:-3px; margin-right:15px;" type="radio" name="otheraddr" value="<?php echo $sat->id_address; ?>"></div>
						<div class="float" style="width:285px;"><?php echo $sat->address.'<br>'.$sat->city.', '.$sat->postcode; ?></div>
					</div>
					<div class="clear"></div>
					<?php
						}
					}
					if($shipping_addr)  echo '<hr>';
					}
					
					?>
					
					<?php ?>
					<div class="float_r submitform">
					<?php
					if($this->uri->segment(4) == 'edit_shipping_info')
					{	echo '<input style="" type="submit" value="[ Save ]">'; echo anchor('transactions/information/'.$this->uri->segment(3),'[ Cancel ]');		}
					else
					{	echo anchor('transactions/information/'.$this->uri->segment(3).'/edit_shipping_info','[ Edit ]'); }
					?>
					</div>
					</div>
					<?php echo form_close(); ?>
					<div class="clear"></div>
					<br>
					<h2>Order Detail</h2>
					<div class='minitab-sub' style="background:#ccc; margin-top:15px;">
						<div class='float col-40'>No</div>
						<div class='float col-160'>Product</div>
						<!--<div class='float col-220'>Type</div>-->
						<div class='float col-80'>Unit Price</div>
						<div class='float col-40'>Qty</div>
						<div class='float col-80'>Total</div>
						<div class="clear"></div>
					</div>
					<?php
					$total = '';
					$discount = '';
					$tax = '';
					$vcrdisc = '';
					$position = 1;
					foreach ($order_info as $ptr)
					{
						
						if($ptr->disc_type == 'Percent'){ $disccaption = $ptr->disc.' %';} else { $disccaption = $ptr->disc; }
						//if($ptr->vcr_type == 'Percent'){ $voucaption = $ptr->value.' %';} else { $voucaption = $ptr->value; }
						
						$total = $total + ($ptr->base_price * $ptr->qty); 
						$tax = $tax + (($total * $ptr->tax) / 100);
						if($ptr->disc_type == 'Percent')
						{	$discount = $discount + ($total * $ptr->disc)/ 100; }
						else
						{	$discount = $discount +  $ptr->disc; }
						
						/*
						if($ptr->vcr_type == 'Percent')
						{	$vcrdisc = $vcrdisc + ($total * $ptr->value)/ 100; }
						else
						{	$vcrdisc = $vcrdisc +  $ptr->value; }
						*/
						
						if($total) { $numbertotal = number_format($total, 0, ',', '.'); } else { $numbertotal = 0;}
						if($tax) { $taxtotal =  number_format($tax, 0, ',', '.'); } else { $taxtotal = 0;}
						if($discount) { $discountotal =  number_format($discount, 0, ',', '.'); } else { $discountotal = 0;}
						if($vcrdisc) { $vcrdisctotal =  number_format($vcrdisc, 0, ',', '.'); } else { $vcrdisctotal = 0;}
						if($shipping_cost) { $shippingtotal =  number_format($shipping_cost, 0, ',', '.'); } else { $shippingtotal = 0;}
						
						@$totalcost = $totalcost + $total; $total = '';
						$total_order = $totalcost + $tax + $shipping_cost - $discount - $vcrdisc;
						if($total_order) { $ordertotal =  number_format($total_order, 0, ',', '.'); } else { $ordertotal = '';}
						
					?>
					<div class='minitab-sub'>
						<div class='float col-40'><?php echo $position; ?>&nbsp</div>
						<div class='float col-160'><?php echo $ptr->name; ?></div>
						<!--<div class='float col-220'><?php //echo $ptr->deskripsi; ?>&nbsp </div>-->
						<div class='float col-80'><?php echo number_format($ptr->base_price, 0, ',', '.'); ?>&nbsp</div>
						<div class='float col-40'><?php echo $ptr->qty;  ?>&nbsp</div>
						<div class='float col-80'><?php echo $numbertotal; ?></div>
						<div class="clear"></div>
					</div>
					<?php
						$position++;
					}
					?>
					<div class="clear"></div>
					<div class="minitable col-440" style="margin-top:15px; margin-left:457px">
					<div class="minitab-sub">
						<div class='float col-80'>Product</div>
						<div class='float col-220'><?php echo number_format(@$totalcost, 0, ',', '.'); ?></div>
						<div class="clear"></div>
					</div>
					<div class="minitab-sub">
						<div class='float col-80'>Tax</div>
						<div class='float col-220'><?php echo @$taxtotal; ?></div>
						<div class="clear"></div>
					</div>
					<div class="minitab-sub">
						<div class='float col-80'>Discount</div>
						<div class='float col-220'>
						<?php if($discount){ ?>
						- <?php echo number_format(@$discount, 0, ',', '.'); ?> Product
						<?php } ?>
						<br>
						<?php if($vcrdisctotal){ ?>
						- <?php echo @$vcrdisctotal; ?> Voucher 
						<?php } ?>
						</div>
						<div class="clear"></div>
					</div>
					<div class="minitab-sub">
						<div class='float col-80'>Shipping Cost</div>
						<div class='float col-220'><?php echo @$shippingtotal; ?></div>
						<div class="clear"></div>
					</div>
					
					<div class="minitab-sub"  style="font-weight:bold; font-size:14px;">
						<div class='float col-80'>Total</div>
						<div class='float col-220' ><b><?php echo @$ordertotal; ?></b></div>
						<div class="clear"></div>
					</div>

					
					</div>
					
					</div>
					
				</div>
				<div class="clear"></div>
			</div>
			<div class="clear"></div>
		</div>
		<div class="clear"></div>
	</div>
</div>

<?php $this->load->view('00footer.php'); ?>
