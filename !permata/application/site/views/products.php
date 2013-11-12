<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
?>
<?php $this -> load -> view('0header');?>
<?php $this -> load -> view('0breadcrumb');?>

<div id="page-banner">
	<img src="<?php echo base_url('assets/img/page-banner/brand-01.jpg')?>" />
</div>
<div class="cb" style="height:15px;"></div>
<div id="products-left-column">
	<div id="brand-list" class="accord <?php
	if ($type == "manufacturer") { echo "active";
	}
	?>">
		<div class="title">
			<h2>BRAND</h2>
		</div>
		<div class="wrapper-list">
			<?php foreach($manufacturer_list AS $item) {
			?>
			<div class="category-item <?php
			if ($item -> alias == $selected_type) { echo "active";
			}
			?>">
				<a href="<?php echo base_url("products/manufacturer/" . $item -> alias);?>"><?php echo $item -> manuf_name;?></a>
			</div>
			<?php }?>
		</div>
	</div>
	<div class="cb" style="height:20px;"></div>
	<div id="category-list" class="accord <?php
	if ($type == "category") { echo "active";
	}
	?>">
		<div class="title">
			<h2>CATEGORY</h2>
		</div>
		<div class="wrapper-list">
			<?php foreach($category_list AS $item) {
			?>
			<div class="category-item <?php
			if ($item -> alias == $selected_type) { echo "active";
			}
			?>">
				<a href="<?php echo base_url("products/category/" . $item -> alias);?>"><?php echo $item -> name;?></a>
			</div>
			<?php }?>
		</div>
	</div>
	<div class="cb" style="height:20px;"></div>
	<div id="featured-list" class="accord <?php
	if ($type == "featured") { echo "active";
	}
	?>">
		<div class="title">
			<h2>FEATURED</h2>
		</div>
		<div class="wrapper-list">
			<?php foreach($featured_list AS $item) {
			?>
			<div class="category-item <?php
			if ($item -> alias == $selected_type) { echo "active";
			}
			?>">
				<a href="<?php echo base_url("products/featured/" . $item -> alias);?>"><?php echo $item -> title;?></a>
			</div>
			<?php }?>
		</div>
	</div>
</div>
<div id="products-right-column">
	<div id="products-page-nav">
		<div id="sort-by-selection" class="fleft">
			<div class="label">
				SORT BY :
			</div>
			<div id="sort-form">
				<?php
				if (!isset($url_con)) { $allproduct = true;
					$url_con = '';
				
				?>
				<?php echo form_open('product/' . $url_con, array('id' => 'fSort'));?>
				<? }else{ ?>
					<?php echo form_open('products/' . $url_con, array('id' => 'fSort'));?>
				<? } ?>	
				<input type="hidden" name="search-input" value="<?php echo(isset($key) ? $key : '');?>" />
				<select name="sort" id="sort-change" style="width:136px;">
					<?php foreach(array(
array("val" => "name", "label" => "Name"),
array("val" => "code", "label" => "Code"),
array("val" => "price", "label" => "Price")) AS $key => $val) {
					?>
					<option value="<?php echo $val['val']?>" <?php echo ($val['val'] == $sortby ? "selected":"")?>><?php echo $val['label']
						?></option>
					<?php }?>
				</select>
				<?php echo form_close();?>
			</div>
			<div class="cb"></div>
		</div>
		<div id="pagination" class="fright" style="width: 400px">
			<div id="showing_items_text" class="fleft">
				&nbsp;
			</div>
			<!--<div id="page_of_text" class="fleft"></div>-->
			<div id="pagination-nav" class="fleft" style="position: relative;right: -55px;">
				<div class="page-nums">
					<?php echo $this -> pagination -> create_links();?>
				</div>
				<div class="cb"></div>
			</div>
			<div class="cb"></div>
		</div>
		<div class="cb"></div>
	</div>
	<div style="border-top:2px solid #bdbbbb; margin:4px 0px 8px 0px;"></div>
	<div id="products-list">
		<div class="products-onepage-group">
			<!--item-product-->
			<?php if($product_list){
			?>
			<?php
$ctr = 0;
foreach($product_list as $product): $ctr++;

//if($product->diskonManufaktur!=0){
	//diskon manufaktur
	if($product->diskonManufaktur!=0 && $product->disc==0){
		$discprice = $product->base_price - ($product->diskonManufaktur * $product->base_price)/100;
	}elseif($product->diskonManufaktur!=0 && $product->disc!=0){
		$discprice = $product->base_price - ($product->disc * $product->base_price)/100;
	}elseif($product->diskonManufaktur==0 && $product->disc!=0){
		$discprice = $product->base_price - ($product->disc * $product->base_price)/100;
	}else{
		$discprice = $product->base_price;
	}
/*}else{
	if($product->disc_type == "Percent"){
		$discprice = $product->base_price - ($product->disc * $product->base_price)/100;
	} else {
		$discprice = $product->base_price - $product->disc;
	}
}*/


/*
if($product->disc_type == "Percent"){
$discprice = $product->base_price - ($product->disc * $product->base_price)/100;
} else {
$discprice = $product->base_price - $product->disc;
}*/

			?>
			<?
				if (isset($allproduct)) { $url_con = 'manufacturer/' . $product -> manufacturer_alias . '/';
				}
			?>
			<a href="<?php echo base_url('product/' . $url_con . $product -> alias);?>">
			<div class="product-item " style="width: 124px">
				<!--<div class="image">
				<img style="display: block;" class="lazy" src="<?php echo base_url('assets/img/loader.gif');?>" data-original="<?php echo base_url('assets/upload/product/m/'.$val_thumb->thumb135);?>" data-original="http://localhost/permata/assets/upload/product/m/bathtub_th.jpg" height="140" width="131">
				</div>-->
				<?php if($this->product_model->pic($product->id_product)) {
foreach($this->product_model->pic($product->id_product) AS $val_thumb) {
				?>
				<div class="image">
					 
					<img src="<?php echo base_url('assets/upload/product/m/' . $val_thumb -> thumb135);?>" width="131" height="140" />
				</div>
				<?php
				}
				}else{
				?>
				<div class="image"><img src="<?php echo base_url('assets/upload/product/m/no_image.jpg');?>" width="131" height="140" />
				</div>
				<? }?>
				
				<div class="price-original" style="height: 20px;">
				<?php if($product->disc!=0){
					echo number_format($product -> base_price, 0, '', '.');
				}elseif($product->diskonManufaktur!=0){
					echo number_format($product -> base_price, 0, '', '.');
				} 
				?>
				 
				</div>
				 		
				<!--
				?php }else{?>
				<div class="price-original" style="height: 20px;">
					IDR ?php echo number_format($product -> base_price, 0, '', '.');?>
				</div>
				? }?>-->
				
				
				
				<div class="price-nett">
					<div class="currency">
						IDR <?php //echo $product->diskonManufaktur;?>
					</div>
					<div class="price1">
						<?php
							//echo number_format($discprice,0,'','.');
						?>
					</div>
					<div class="price1">
						<?php 
						$countCaracterPrice=strlen(substr(number_format($discprice, 0, '', '.'), 0, strlen($discprice) - 2));
						if($countCaracterPrice==4){
						?>
						
						<?php echo implode('', explode('.', substr(number_format($discprice, 0, '', '.'), 0, strlen($discprice) - 2)));?>
					    
					    <? }elseif($countCaracterPrice==5){ ?>
					    	<?php echo implode('.', explode('.', substr(number_format($discprice, 0, '', '.'), 0, strlen($discprice) - 2)));?>
					    <? }elseif($countCaracterPrice==3){ ?>
					    	<?php echo implode('', explode('.', substr(number_format($discprice, 0, '', '.'), 0, strlen($discprice) - 2)));?>
					    <? } ?>		
					</div>
					<div class="price2">
						<?php echo implode('.', explode('.', substr(number_format($discprice, 0, '', '.'), -4)));?>
					</div>
					<div class="cb"></div>
				</div>
				<div class="cb" style="border-top:1px solid #b0a4a4; margin-top:12px; margin-bottom:9px;"></div>
				<div class="title">
					<?=$product -> name;?>
				</div>
				<div class="short-desc">
					<?php //echo ((strlen($product->deskripsi) <= 60) ? $product->deskripsi : substr($product->deskripsi, 0, 50)."..");?>
				</div>
				<div class="cb" style="border-top:1px solid #b0a4a4; margin-top:12px; margin-bottom:6px;"></div>
				<div class="code">
					CODE : <?php echo $product -> code;?>
				</div>
			</div></a>
			<?php if($ctr % 4 == 0) {
			?>

			<div class="cb"></div>
			<?php }?>

			<?
			endforeach;
			?>
			<div class="cb"></div>
			<!--end-item-product-->
			<br>
			<div style="border-top:2px solid #bdbbbb; margin:4px 0px 8px 0px;width: 676px;"></div>
			<div id="pagination" class="fright" style="width: 400px;clear: both;">
				<div id="showing_items_text" class="fleft">
					&nbsp;
				</div>
				<!--<div id="page_of_text" class="fleft"></div>-->
				<div id="pagination-nav" class="fleft" style="position: relative;right: -2px;">
					<div class="page-nums">
						<?php echo $this -> pagination -> create_links();?>
					</div>
					<div class="cb"></div>
				</div>
				<div class="cb"></div>
			</div><? }?>
		</div>
	</div>
</div>
<div class="cb"></div>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/js/bxslider/jquery.bxslider.css" />
<style>
	.bx-wrapper {
		margin: 0;
	}
	.bx-wrapper .bx-viewport {
		left: 0px;
	}
	.bx-prev, .bx-next {
		width: inherit;
		height: inherit;
		opacity: 0;
		filter: alpha(opacity=0);
		font-size: 18px;
	}
</style>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/easing.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/bxslider/jquery.bxslider.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.lazyload.min.js"></script>
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
//not used any more...
//nextSelector : "#pagination-nav .right",
//prevSelector : "#pagination-nav .left"
//...
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

var total_item 	=<?php echo count($product_list)?>
	;
	var total_page = parseInt(total_item / 12) + (total_item % 12 > 0 ? 1 : 0);
	var curr_page = 1;
	var item_start = 0;
	var item_end = 0;

	$("#pagination-nav .right	").click(function() {
		if(curr_page < total_page) {
			curr_page++;
		}	count_cur_page();
	});
	$("#pagination-nav .left	").click(function() {
		if(curr_page > 1) {
			curr_page--;
		}  count_cur_page();
	});
	function count_cur_page() {
		item_start = ((curr_page - 1) * 12) + 1;
		item_end = item_end + 12;
		if(total_item < item_end)
			item_end = total_item;

		//$("#showing_items_text").html('Showing items ' + item_start + '-' + item_end + ' of ' + total_item);
	}

	count_cur_page();
	});
</script>
<?php $this -> load -> view('0footer');?>
