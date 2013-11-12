<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $this->load->view('00header.php'); ?>
<div id="wrap">
<?php $this->load->view('00sidemenu.php'); 
	$checked = '';
	$hotchecked = '';
	if ($manuf)
	{
		$id_product = $manuf->id_manufacturer;
		$alias = $manuf->alias;
		$logo = $manuf->logo;
		$manuf_name = $manuf->manuf_name;
		$id_manufacturer = $manuf->id_manufacturer;
		$deskripsi = $manuf->deskripsi;
		$meta_title = $manuf->meta_title;
		$meta_description = $manuf->meta_description;
		$meta_keyword = $manuf->meta_keyword;
		$enable = $manuf->enable;
		$deskripsi_enable = $manuf->deskripsi_enable;
		if($enable) $checked = 'checked';
		if($deskripsi_enable) $hotchecked = 'checked';
	}	
?>

	<div id="content" style="margin-left:157px;">
		<div id="content-wrap">
			<div id="content-body">
				<div class="wrap">
					<div id="breadcrumb"><?php	echo $breadc;	?></div>
					<h1><?php echo $title; ?></h1>
					<div class='display'>
						<div class='display-body'>
						<?php
							echo form_open_multipart($subpage.'/manufaktur_save'); 
						?>
				<!--		<div class='float' ><div class='label col-120'>Logo</div></div>
							<div class='float' style="margin-top:15px;">
							<input type='file' name="img"></div>
							<div class="clear"></div>-->
							<div class='float'><div class='label col-120'>Name</div></div>
								<div class='float'>
									<input type='text' name='name' value='<?php echo $manuf_name ?>'> &nbsp <input type="checkbox" name="enable" value="1" <?php echo $checked ?>> Enable
									<input type='hidden' name='id_manufacturer' value='<?php echo $id_manufacturer ?>'>
									<input type='hidden' name='alias' value='<?php echo $alias ?>'>
								</div>
							<div class="clear"></div>
				<!--		<div class='float'>
								<div class='label col-120'>Description</div>
								<div class='float'><textarea name="description"><?php // echo $deskripsi ?></textarea></div>
								<div class='float'>&nbsp <input type="checkbox" name="descenable" value="1" <?php // echo $hotchecked ?>> Enable</div>
							</div>-->
							<div class='float'><div class='label col-120'>Discount</div></div>
							<div class='float'><input class="upper" type='text' maxlength="3" name='diskon' style="width: 50px;" value='<?php //echo $meta_keyword ?>'> %</div>
							
							<div class="clear"></div>
							<div class='float'><div class='label col-120'>Meta Title</div></div>
							<div class='float'><input class="upper" type='text' name='metatitle' value='<?php echo $meta_title ?>'></div>
							<div class="clear"></div>
							<div class='float'><div class='label col-120'>Meta Description</div></div>
							<div class='float'><input class="upper" type='text' name='metadesc' value='<?php echo $meta_description ?>'></div>
							<div class="clear"></div>
							<div class='float'><div class='label col-120'>Meta Keyword</div></div>
							<div class='float'><input class="upper" type='text' name='metakey' value='<?php echo $meta_keyword ?>'></div>
							<div class="clear"></div>
							
							<div class='float'><input type='submit' name='submit' value='Save'></div>
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
