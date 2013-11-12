<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $this->load->view('00header.php'); ?>
<div id="wrap">
<?php $this->load->view('00sidemenu.php'); ?>
<?php 
 
	$id_product = '';
	$alias = '';
	$product = '';
	$code = '';
	$date = '';
	$brand = '';
	$description = '';
	$enable = '';
	$checked = '';
	$hotdeal = '';
	$hotchecked = '';
	$paket = '';
	$paketchecked = '';
	$promo = '';
	$promochecked = '';
	$clearance = '';
	$clearchecked = '';
	$newchecked = '';
	$new = '';

	if ($product_detail)
	{
		$id_product = $product_detail->id_product;
		$alias = $product_detail->alias;
		$product = $product_detail->name;
		$code = $product_detail->code;
		$date = explode('-',$product_detail->date_release);
		$date = $date[2].'/'.$date[1].'/'.$date[0];
		$id_man = $product_detail->id_manufacturer;
		$brand = $product_detail->brand_name;
		$description = $product_detail->deskripsi;
		$enable = $product_detail->enable;
		$hotdeal = $product_detail->hotdeal;
		$paket = $product_detail->paket;
		$promo = $product_detail->promotion;
		$clearance = $product_detail->clearance;
		$new = $product_detail->new;
		if($enable) $checked = 'checked';
		if($hotdeal) $hotchecked = 'checked';
		if($paket) $paketchecked = 'checked';
		if($promo) $promochecked = 'checked';
		if($clearance) $clearchecked = 'checked';
		if($new) $newchecked = 'checked';
	}							
?>
	<div id="submenu-pages">
		<div id="submenuback"></div>

		<div id="submenuwrap">
			<div id="submenushadow"></div>

			<ul id="submenu">

				<?php
				foreach ($subpages as $p) {
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
						<div>
						<?php
							echo form_open($subpage.'/prod_save'); 
						?>
							<div class='float'><div class='label col-80'>Product Name</div></div>
							<div class='float'>
								<input type='text' name='product' value='<?php echo $product ?>'> &nbsp <input type="checkbox" name="enable" value='1' <?php echo $checked; ?>> Enable &nbsp; 
								<input name="status" type="checkbox" value="processed" <?=$product_detail->status=='processed'?'checked=checked':''?>" /> processed 
								<input type='hidden' name='alias' value='<?php echo $alias ?>'>
								<input type='hidden' name='id_product' value='<?php echo $id_product ?>'>
							</div>
							<div class="clear"></div>
							<div class='float'><div class='label col-80'>Attribute</div></div>
							<div class='float' style="margin-top:15px;">
								 <input type="checkbox" name="hotdeal" value='1' <?php echo $hotchecked; ?>> Sale &nbsp 
								 <input type="checkbox" name="paket" value='1' <?php echo $paketchecked; ?>> Paket &nbsp 
								 <input type="checkbox" name="promosi" value='1' <?php echo $promochecked; ?>> Promotions &nbsp 
								 <input type="checkbox" name="clear" value='1' <?php echo $clearchecked; ?>> Clearance &nbsp 
								 <input type="checkbox" name="new" value='1' <?php echo $newchecked; ?> > New 
								 
							</div>
							<div class="clear"></div>
							<div class='float'><div class='label col-80'>Code Number</div></div><div class='float'><input class="upper" type='text' name='code' value="<?php echo $code ?>"></div>
							<div class="clear"></div>
							<!--<div class='float'><div class='label col-80'>Date Release</div></div><div class='float'><input type='text' name='date' class='datepicker' value="<?php echo $date ?>"></div>
							<div class="clear"></div>-->
							<div class='float'><div class='label col-80'>Brand Name</div></div><div class='float'>
							<select name="idbrand">
							<?php 
								echo '<option value='.$id_man.'>'.$brand.'</option>';
							foreach ($manuf as $m)
							{
								echo '<option value='.$m->id_manufacturer.'>'.$m->manuf_name.'</option>';
							}
							?>
							</select>
							</div>
							<div class="clear"></div>
							<style>
							#description_path{height:18px;}
							#description_path_row span{float:left;}
							#description_path_row span #description_path_voice{float:left;}
							#description_path_row span #description_path{float:right;}</style>
							<div class='float'><div class='label col-80'>Description</div></div><div class='float'><textarea name="description" class="myTextEditor" ><?php echo $description ?></textarea></div>
							<div class="clear"></div>
							<div class="float"><input type="submit" name="submit" value="Save"></div>
						<?php echo form_close() ?>
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
