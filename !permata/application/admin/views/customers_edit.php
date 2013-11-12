<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $this->load->view('00header.php'); ?>
<div id="wrap">
<?php $this->load->view('00sidemenu.php'); ?>
<?php
		$id_customer = '';
		$firstname = '';
		$lastname = '';
		$phone = '';
		$address = '';
		$city = '';
		$postcode = '';
		$email = '';
	if($this->uri->segment(3))
	{
		if ($datacust)
		{
			$id_customer = $datacust->id_customer;
			$firstname = $datacust->firstname;
			$lastname = $datacust->lastname;
			$phone = $datacust->phone;
			$address = $datacust->address;
			$city = $datacust->city;
			$postcode = $datacust->postcode;
			$email = $datacust->email;
			$balance = $datacust->account_balance;
		}
	}
?>
	<div id="submenu-pages">
		<div id="submenuback"></div>
		<div id="submenuwrap">
			<div id="submenushadow"></div>
			<ul id="submenu">
				<?php
				foreach ($subpages as $p) {
					//if (priv_page($p->alias)) {
				?>
				<a href="<?php echo site_url(); ?><?php echo $page ?>/<?php echo $p->alias; ?>">
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
					<h1><?php echo $title; ?></h1>
					<div class='float display'>
					<?php	echo form_open($subpage.'/customer_save');	?>
							<input type="hidden" name="level" value="1">
							<input type="hidden" name="id_customer" value="<?php echo $id_customer; ?>">
							<div class='float'><div class='label col-120'>Firstname <span class="star">*</span></div></div>
							<div class='float'><input type="text" name="firstname" value="<?php echo $firstname; ?>"></div>
							<div class="clear"></div>
							<div class="float"><div class="label col-120">Lastname</div></div>
							<div class="float"><input type="text" name="lastname" value="<?php echo $lastname; ?>"></div>
							<div class="clear"></div>
							<div class='float'><div class='label col-120'>Phone Number</div></div>
							<div class='float'><input type="text" name="phone" value="<?php echo $phone; ?>"></div>
							<div class="clear"></div>
							<div class='float'><div class='label col-120'>Address</div></div>
							<div class='float'><input type="text" name="address" value="<?php echo $address; ?>"></div>
							<div class="clear"></div>
							<div class='float'><div class='label col-120'>City</div></div>
							<div class='float'><input type="text" name="city" value="<?php echo $city; ?>"></div>
							<div class="clear"></div>
							<div class='float'><div class='label col-120'>Postcode</div></div>
							<div class='float'><input type="text" name="postcode" value="<?php echo $postcode; ?>"></div>
							<div class="clear"></div>
							<div class='float'><div class='label col-120'>Email <span class="star">*</span></div></div>
							<div class='float'><input type="text" name="email" value="<?php echo $email; ?>"></div>
							
							<div class="clear"></div>
							<div class='float'><div class='label col-120'>Password</div></div>
							<div class='float'><input type="password" name="password"></div>
							<div class="clear"></div>
							<span class="float star-box">* This information needed</span>
							<div class="clear"></div>
							<div class='float'><input type='submit' name='submit' value='Save'></div>
					<?php	echo form_close(); ?>
					</div>
					<div class="float" style="margin-left:15px; margin-top:15px;">
						
						<?php
						if($this->uri->segment(3))
						{
						?>
						<h3>Credit Balance</h3>
						<?php

								?>
						<div class="float" style="border:solid 1px #ccc; padding:5px 5px 5px 15px; background:#eee; width:325px; margin-bottom:2px;">
						<div class="float" style="width:285px; font-weight:bold; font-size:14px;"><?php echo number_format($balance, 0, ',', '.'); ?> Idr</div>
						</div>
						<div class="clear"></div>
								<?php
							
						}
						?>	

						<?php
						$invoice_number = '';
						if($this->uri->segment(3))
						{
						?>
						<hr>
						<h3>Transaction History</h3>
						<div class="float" style="border:solid 1px #ccc; padding:5px 5px 5px 15px; background:#ccc; width:325px; margin-bottom:2px;">
						<div class="float" style="width:65px;">Date</div>
						<div class="float" style="width:140px;">Transaction</div>
						<div class="float" style="width:70px;">Ammount</div>

						</div>
						<div class="clear"></div>
						<?php
						$total = 0;
							foreach($trans_history as $thr)
							{
								$id_transfer = $thr->invoice_number;
								$date_trans = date ("d/m/Y",strtotime($thr->date));
								$value = $thr->total_orders;
								$total = $total + $value;
								//$type = $thr->type;
								
								$invoice_number = substr($thr->invoice_number, 0,15);
								if(strlen($thr->invoice_number) > 15)
								{	$invoice_number = $invoice_number." ...";	}
								
								$payment_method = substr($thr->payment_method, 0,15);
								if(strlen($thr->payment_method) > 15)
								{	$payment_method = $payment_method." ...";	}
								
								if($thr->invoice_number)
								$trans = 'Inv. '.$invoice_number;
								else $trans = 'Acc. '.$payment_method;
								/*
								if($type == 'Debit')
								{
									$total = $total + $value;
								}
								else
								{
									$total = $total - $value;
								}
								*/
								?>
						<div class="float" style="border:solid 1px #ccc; padding:5px 5px 5px 15px; background:#eee; width:325px; margin-bottom:2px;">
						<div class="float" style="width:65px;"><?php echo $date_trans; ?></div>
						<div class="float" style="width:140px; text-decoration:underline;"><?php echo anchor('transactions/information/'.$thr->invoice_number,$thr->invoice_number); ?></div>
						<div class="float" style="width:70px; text-align:right; margin-right:3px;"><?php echo number_format($value, 0, ',', '.'); ?></div>

						</div>
						<div class="clear"></div>
								<?php
							}
						?>
						<div class="float" style="border:solid 1px #ccc; padding:5px 5px 5px 15px; background:#ccc; width:325px; margin-bottom:2px;">
						<div class="float" style="width:65px;"> &nbsp </div>
						<div class="float" style="width:140px;"><b>Total</b></div>
						<div class="float" style="width:70px; text-align:right; margin-right:3px;"><?php echo number_format($total, 0, ',', '.'); ?></div>

						</div>
						<div class="clear"></div>
						<?php
						}
						?>	

						<?php
						if($this->uri->segment(3))
						{
						?>
						<hr>
						<h3>Shipping History</h3>
						<?php
							foreach($addr_history as $adh)
							{
								$id_address = $adh->id_address;
								$address = $adh->address;
								$city = $adh->city;
								$postcode = $adh->postcode;
								?>
						<div class="float" style="border:solid 1px #ccc; padding:5px 5px 5px 15px; background:#eee; width:325px; margin-bottom:2px;">
						<div class="float" style="width:285px;"><?php echo $address.'<br>'.$city.', '.$postcode; ?></div>
						</div>
						<div class="clear"></div>
								<?php
							}
						}
						?>						
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
