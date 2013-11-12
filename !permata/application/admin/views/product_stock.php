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
					
					<?php if($stock){ ?>
					<div class="minitable" >
					<div class='minitab-sub'>
						<div class='float col-120 mid-col'>Stock Qty</div>
						<div class='float col-420 mid-col'>Attribute</div>
						<div class='float col-80 mid-col'>Price</div>
						<div class='float col-80 mid-col'>Re Order</div>

						<div class="clear"></div>
					</div>
					<?php 
					foreach ($stock as $cpt) {
						if($cpt->re_order == 1)
							$icon = 'class="ui-icon ui-icon-check"';
						else
							$icon = 'class="ui-icon ui-icon-close"';
						if($cpt->bse_price){ $pricee = $cpt->bse_price; $iconprice = 'class="ui-icon ui-icon-check"';}
						else { $pricee = $cpt->base_price; $iconprice = 'class="ui-icon ui-icon-close"';}
						if($cpt->stax){ $tax = $cpt->stax; }
						else { $tax = $cpt->tax; }
						$actual_price = (($pricee * $tax)/100)+$pricee;
						if($actual_price){
							$format_number = number_format($actual_price, 0, ',', '.'); $price = array($format_number,' Idr'); $price = implode('',$price); 	
						}
						else
						{	$price = '&nbsp'; }
						?>
						<div class='minitab-sub'>
						<?php
								echo form_open($subpage.'/stock_save'); 
						?>
							<div class='float col-120'><input style="width:100px;" type="text" name="stock" value="<?php echo $cpt->qty; ?>" >
							<input type="hidden" name="id_prod" value="<?php echo  $this->uri->segment(3) ?>" >
							<input type="hidden" name="id_prod_stock" value="<?php echo $cpt->id_prod_stock ?>" ></div>
					
							<div class='float col-420 mid-col'><?php echo $cpt->deskripsi; ?></div>
							<div class='float col-80 mid-col' style="text-align:right;"><?php echo $price; ?></div>

							<div class='float col-40 mid-col'><?php echo '<span '.$icon.'></span>'; ?></div>
		
							<div class='float col-40 mid-col'><input type="submit" style="padding:2px 14px;" value="Save"></div>
							<div class="clear"></div>
						<?php echo form_close() ?>
						</div>
						<?php
						$pricee = 0;
						$tax = 0;
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
