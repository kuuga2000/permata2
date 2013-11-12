<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $this->load->view('0header'); ?>
<?php $this->load->view('0breadcrumb'); ?>

<div class="cb" style="height:15px;"></div>

<h1>SEARCH RESULT</h1>

<?php 
if(! $product_list) {
	echo lang('global_search.noresult', '');
} else { 
	echo 'We have found '.count($product_list).' product'.(count($product_list) > 1 ? 's':'').' matching the search for '.$key.'"';
}?>

<div class="cb" style="height:15px;"></div>

<div id="search-results">
	<div id="products-page-nav">
		<div id="sort-by-selection" class="fleft">
			<div class="label">SORT BY : </div>
			<div id="sort-form">
				<?php echo form_open('product/search', array('id' => 'fSort')); ?>
					<input type="hidden" name="search-input" value="<?php echo $key;?>" />
					<select name="sort" id="sort-change" style="width:136px;">
						<?php foreach(array(
							array("val" => "name", "label" => "Name"),
							array("val" => "code", "label" => "Code"),
							array("val" => "price", "label" => "Price")) AS $key => $val) { ?>
						<option value="<?php echo $val['val']?>" <?php echo ($val['val'] == $sortby ? "selected":"")?>><?php echo $val['label']?></option>
						<?php } ?>
					</select>
				<?php echo form_close(); ?>
			</div>
			<div class="cb"></div>
		</div>
		
		<div id="pagination" class="fright">
			<div id="showing_items_text" class="fleft"><?php //echo lang('global_products.showingtext', '');?></div>
			<div id="page_of_text" class="fleft"></div>
			<div id="pagination-nav" class="fleft">
				<div class="left"></div>
				<div class="right"></div>
				
				<div class="cb"></div>
			</div>
			<div class="cb"></div>
		</div>
		
		<div class="cb"></div>
		
	</div>
	
	<div style="border-top:2px solid #bdbbbb; margin:4px 0px 8px 0px;"></div>
	
	<div id="products-list">
		<?php $ctr = 0; if($product_list) { ?>
			<?php foreach($product_list AS $item) { $ctr++; 
			if($item->disc_type == "Percent"){ $discprice = $item->base_price - ($item->disc * $item->base_price)/100; } else { $discprice = $item->base_price - $item->disc; }
			?>
				<?php if($ctr % 10 == 1) {?>
				<div class="products-onepage-group">
				<?php } 
				$url_con = 'manufacturer/'.$item->manufacturer_alias.'/';
				?>
				<a href="<?php echo base_url('product/'.$url_con.$item->alias);?>">
					<div class="product-item <?php echo ($ctr % 5 == 0? "last":"");?>">	<?php 
						if($this->product_model->pic($item->id_product)) {
							foreach($this->product_model->pic($item->id_product) AS $val_thumb) { ?>
							<div class="image"><img class="lazy" src="<?php echo base_url('assets/img/loader.gif');?>" data-original="<?php echo base_url('assets/upload/product/m/'.$val_thumb->thumb135);?>" width="131" height="140" /></div>
						<?php 
							}
						} ?>
						<?php if($item->disc){ ?><div class="price-original">IDR <?php echo $item->base_price?></div> <?php } ?>
						<div class="price-nett">
							<div class="currency">IDR</div> 
							<div class="price1"><?php echo substr($discprice, 0, strlen($discprice)-3);?></div>
							<div class="price2">.<?php echo substr($discprice, -3);?></div>
							<div class="cb"></div>
						</div>
						
						<div class="cb" style="border-top:1px solid #b0a4a4; margin-top:12px; margin-bottom:9px;"></div>
						
						<div class="title"><?php echo $item->name?></div>
						<div class="short-desc"><?php echo ((strlen($item->deskripsi) <= 60) ? $item->deskripsi : substr($item->deskripsi, 0, 50)."..");?></div>
						
						<div class="cb" style="border-top:1px solid #b0a4a4; margin-top:12px; margin-bottom:6px;"></div>
						
						<div class="code">CODE : <?php echo $item->code?></div>
					</div> <!-- end of .home-product-clearance-item -->
				</a>
			<?php if($ctr % 5 == 0) {?>
				<div class="cb"></div>
			<?php }?>
			
			<?php if($ctr % 10 == 0) {?>
			</div> <!-- end of .product-onepage-group -->
			<?php }?>
			
			<?php 
			} // end of foreach 
		}?>
		
		<?php if($ctr % 5 < 5) {?>
			<div class="cb"></div>
		<?php }?>
		
		<?php if($ctr % 10 < 10) {?>
		</div> <!-- end of .product-onepage-group -->
		<?php }?>
	</div>
</div>

<div class="cb"></div>

<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/js/bxslider/jquery.bxslider.css'); ?>" />
<style>
.bx-wrapper	{ margin:0; }
.bx-wrapper .bx-viewport	{ left:0px; }
.bx-prev, .bx-next { width:inherit; height:inherit; opacity:0; filter:alpha(opacity=0); font-size:18px; }
</style>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/easing.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bxslider/jquery.bxslider.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.lazyload.min.js"></script>
<script>
$(function(){	
	$("#products-list").bxSlider({
		auto: false,
		controls : true,
		pager : true,
		pagerType : 'short',
		pagerSelector : '#page_of_text',
		nextText : "oo",
		prevText : "oo",
		nextSelector : "#pagination-nav .right",
		prevSelector : "#pagination-nav .left"
	});
	
	$("img.lazy").lazyload();
	
	$("#sort-change").change(function(){ $("#fSort").submit(); });
});
</script>

<?php $this->load->view('0footer'); ?>
