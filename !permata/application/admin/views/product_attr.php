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

				<a href="<?php echo site_url(); ?>product/<?php echo $p->alias; ?>/<?php echo $id_product ?>">
					<li>
						<div class="inner">
							<div class="title"><?php echo $p->name; ?></div>
							<div class="clear"></div>
						</div>
					</li>
				</a>

				<?php //}
				} ?>
				<a href="<?php echo site_url(); ?>catalog">
					<li>
						<div class="inner">
							<div class="title">Back</div>
							<div class="clear"></div>
						</div>
					</li>
				</a>
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
						<script>
						$(function() {
							$( ".accor" ).accordion({
								collapsible: true
							});
						});
						</script>
							<div class='float'><div class='label col-120'>Select Attribute</div></div>
							<div class='float'>
						<?php
						$idprodstock = '';
						foreach($attr_check as $attc)
						{
							if($this->uri->segment(4)) $idprodstock = $this->uri->segment(4);
							else $idprodstock = $attc->id_prod_stock + 1;
						}
						$attname = '';
						foreach($attribute as $attr){
						if($attr->attname === $attname)$attecho = '';
						else $attecho = $attr->attname;
						$attname = $attr->attname;
							if($attecho){
							echo '<div style="width:80px; margin-top:14px;">'.$attecho.'</div>
									<div class="label col-440">'.form_open($subpage.'/attr_save').'
									<input type="hidden" name="idproduct" value="'.$this->uri->segment(3).'">
									<input type="hidden" name="idprodstock" value="'.$idprodstock.'">
									<select name="value_name">';}
						foreach($attribute as $attp){
						if($attr->attname === $attp->attname) 
									echo '<option value="'.$attr->attname.'_'.$attp->valname.'_'.$attp->id_prod_att.'">  &nbsp'.$attp->valname.'</option>'; 
						}
									echo "";
						?>
						<?php
							if($attecho){ 
									echo '</select>
									<input type="submit" style="margin-left:5px; margin-top:-10px;" value="Add"><br>'; 
									echo form_close(); 
									echo '</div><br>';}
						$attecho = '';
						}
						?>
							</select>
							</div>
							<div class="clear"></div>
							
							<div class="minitable" >
							<div class='minitab-sub'>
								<div class='float col-40 mid-col'> ID </div>
								<div class='float col-220 mid-col'>Stock Qty</div>
								<div class='float col-220 mid-col'>Attribute</div>
								<div class='float col-40 mid-col'> # </div>
							</div>
							<div class="clear"></div>
							<?php 
							$atmname = '';
							$idattr = '';
							$prod_sbefore = '';
							foreach ($attr_stock as $atv) {
							?>
							<?php
							if(($atv->atname === $atmname) AND ($atv->id_prod_stock === $idattr)) { $atecho = '&nbsp'; $prod_stock = ''; }
							else { $atecho = $atv->atname; $idattr = $atv->id_prod_stock; $prod_stock = $atv->id_prod_stock;  }
							$atmname = $atv->atname;
							if($prod_stock === $prod_sbefore) $idstock = '&nbsp';
							else $idstock = $prod_stock;
							$prod_sbefore = $prod_stock;
							?>
							<div class='minitab-sub attr-url' style="height:20px;">
								<div class="float col-40" ><?php echo $idstock; ?></div>
								<div class="float col-220"><?php echo $atecho; ?></div>
								<div class="float col-220"><?php echo $atv->vlname; ?></div>
								<div class="float col-80 attclear">
								<?php echo anchor('product/attribute/'.$id_product.'/'.$atv->id_prod_stock, '[Add]'); ?>
								<?php echo anchor('product/delete_attr/'.$id_product.'/'.$atv->id_prod_stock.'/'.$atv->idp_val_attr	, '[Delete]'); ?>
								</div>
							<?php $atecho = ''; $prod_stock = ''; ?>
							</div>
							<div class="clear"></div>
							<?php
							}
							?>
							
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
