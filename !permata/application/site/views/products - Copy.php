<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $this->load->view('0header'); ?>
<?php $this->load->view('0breadcrumb'); ?>

<div id="page-banner">
	<img src="<?php echo base_url('assets/img/page-banner/brand-01.jpg')?>" />
</div>

<div class="cb" style="height:15px;"></div>

<div id="products-left-column">
	<div id="brand-list" class="accord <?php if($type == "manufacturer"){ echo "active"; }?>">
		<div class="title"><h2>BRAND</h2></div>
		<div class="wrapper-list">
			<?php foreach($manufacturer_list AS $item) { ?>
			<div class="category-item <?php if($item->alias == $selected_type){ echo "active"; }?>"><a href="<?php echo base_url("product/manufacturer/".$item->alias);?>"><?php echo $item->manuf_name;?></a></div>
			<?php }?>
		</div>
	</div>
	
	<div class="cb" style="height:20px;"></div>
	
	<div id="category-list" class="accord <?php if($type == "category"){ echo "active"; }?>">
		<div class="title"><h2>CATEGORY</h2></div>
		<div class="wrapper-list">
			<?php foreach($category_list AS $item) { ?>
			<div class="category-item <?php if($item->alias == $selected_type){ echo "active"; }?>"><a href="<?php echo base_url("product/category/".$item->alias);?>"><?php echo $item->name;?></a></div>
			<?php }?>
		</div>
	</div>
	
	<div class="cb" style="height:20px;"></div>
	
	<div id="featured-list" class="accord <?php if($type == "featured"){ echo "active"; }?>">
		<div class="title"><h2>FEATURED</h2></div>
		<div class="wrapper-list">
			<?php foreach($featured_list AS $item) { ?>
			<div class="category-item <?php if($item->alias == $selected_type){ echo "active"; }?>"><a href="<?php echo base_url("product/featured/".$item->alias);?>"><?php echo $item->title;?></a></div>
			<?php }?>
		</div>
	</div>
</div>

<?php
if(!isset($url_con)) { $allproduct = true; $url_con = ''; }
?>
<div id="products-right-column">
	<div id="products-page-nav">
		<div id="sort-by-selection" class="fleft">
			<div class="label">SORT BY : </div>
			<div id="sort-form">
				<?php echo form_open('product/'.$url_con, array('id' => 'fSort')); ?>
					<input type="hidden" name="search-input" value="<?php echo (isset($key) ? $key:'');?>" />
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
			<div id="showing_items_text" class="fleft"></div>
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
		<?php 
		if($product_list) {
		$ctr = 0; foreach($product_list AS $item) { $ctr++; 
		if($item->disc_type == "Percent"){ $discprice = $item->base_price - ($item->disc * $item->base_price)/100; } else { $discprice = $item->base_price - $item->disc; }
		?>
		<?php if($ctr % 12 == 1) {?>
		<div class="products-onepage-group">
		<?php } 
					if(isset($allproduct)) { $url_con = 'manufacturer/'.$item->manufacturer_alias.'/'; } ?>
			<a href="<?php echo base_url('product/'.$url_con.$item->alias);?>">
				<div class="product-item <?php echo ($ctr % 4 == 0? "last":"");?>">	<?php 
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
		<?php if($ctr % 4 == 0) {?>
			<div class="cb"></div>
		<?php }?>
		
		<?php if($ctr % 12 == 0) {?>
		</div> <!-- end of .product-onepage-group -->
		<?php }?>
		
		<?php } // end of foreach ?>
		
		<?php if($ctr % 4 < 4) {?>
			<div class="cb"></div>
		<?php }?>
		
		<?php if($ctr % 12 < 12) {?>
		</div> <!-- end of .product-onepage-group -->
		<?php }?>
		<?php
		} // end of if  ?>
	</div>
</div>

<div class="cb"></div>

<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/js/bxslider/jquery.bxslider.css" />
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
	
	$(".accord .title").click(function(){
		var $curr_accord = $(this).parent();
		if(! $curr_accord.hasClass('active')) {
			$(".accord.active").removeClass('active').find('.wrapper-list').slideToggle();
			$curr_accord.addClass('active').find('.wrapper-list').slideToggle();
		} else {
			$(".accord.active").removeClass('active').find('.wrapper-list').slideToggle();
		}
	});
	
	$(".accord.active").find('.wrapper-list').slideToggle();
	
	var total_item 	= <?php echo count($product_list)?>;
	var total_page 	= parseInt(total_item/12) + (total_item%12 > 0 ? 1:0);
	var curr_page 	= 1;
	var item_start	= 0;
	var item_end 		= 0;
	
	$("#pagination-nav .right	").click( function(){ if(curr_page < total_page) 	{curr_page++;}	count_cur_page(); });
	$("#pagination-nav .left	").click( function(){ if(curr_page > 1) 					{curr_page--;}  count_cur_page(); });
	
	function count_cur_page() {
		item_start 	= ((curr_page-1) * 12)+1;
		item_end 		= item_end+12;
		if(total_item < item_end)
			item_end = total_item;
		
		$("#showing_items_text").html('Showing items '+item_start+'-'+item_end+' of '+total_item);
	}
	
	count_cur_page();
});
</script>

<?php $this->load->view('0footer'); ?>
