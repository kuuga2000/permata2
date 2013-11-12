<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $this->load->view('00header.php'); ?>
<div id="wrap">
<?php $this->load->view('00sidemenu.php'); ?>
<?php 
	$id_product = '';
	if ($product_detail)
	{
		$id_product = $product_detail->id_product;
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

				<a href="<?php echo site_url(); ?>product/<?php echo $p->alias; ?>/<?php echo $id_product; ?>">
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
					<div class='display'>
						<div class='display-body'>
						<?php
							echo form_open($subpage.'/price_save'); 
								$id = $this->uri->segment(3);
								$baseprice = '';
								$tax = '';
								$wholeprice = '';
								$disc = '';
								$discount = '';
							if ($price)
							{
								$id = $price->id_product;
								$wholeprice = $price->whole_price;
								$baseprice = $price->base_price;
								$tax = $price->tax;
								$discount = $price->disc;
								$disc = $price->disc;
								$disc_type = $price->disc_type;
							}
						?>
							<input type='hidden' name="id_prod" value="<?php echo $id ?>">
							<!--
							<div class='float'><div class='label col-120'>Wholesale Price</div></div><div class='float'><input type='text' name="wholesale" value="<?php echo $wholeprice ?>"></div>
							<div class="clear"></div>
							<div class='float'><div class='label col-120'>Base Price</div></div><div class='float'><input type='text' name="baseprice" value="<?php echo $baseprice ?>"></div>
							<div class="clear"></div>
							<div class='float'><div class='label col-120'>Tax</div></div><div class='float'><input type='text' name="tax" value="<?php echo $tax ?>"></div>
							<div class="clear"></div>
							<div class='float'><div class='label col-120'>Discount</div></div><div class='float'><input type='text' name="disc" value="<?php echo $disc ?>"></div>
							<div class="clear"></div>
							
							<div class='float'><div class='label col-120'>Discount Type</div></div><div class='float'>
							<select name="disc_type">
							<?php 
							if($disc_type) { echo '<option value="'.$disc_type.'">'.$disc_type.'</option>'; }
							if($disc_type != 'Percent') { echo '<option value="Percent">Percent</option>'; } 
							if($disc_type != 'Amount Flat') { echo '<option value="Amount Flat">Amount Flat</option>'; } 
							?>
							</select>
							</div>
							<div class="clear"></div>-->
							
							
							<input type='hidden' name="wholesale" value="0">
							<input type='hidden' name="tax" value="0">
							<input type="hidden" name="disc_type" value="Percent" />
							
							<div class='float'><div class='label col-120'>Base Price</div></div><div class='float'><input type='text' name="baseprice" value="<?php echo $baseprice ?>"></div>
							<div class="clear"></div>
							<div class='float'><div class='label col-120'>Discount</div></div><div class='float'><input type='text' name="disc" value="<?php echo $disc ?>" maxlength="2" style="width:25px;" /> %</div>
							<div class="clear"></div>
							
							<div class='float col-120'><input type='submit' name='' value='Save'></div>
						<?php 
							
							echo form_close() 
						?>
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
