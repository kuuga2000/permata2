<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $this->load->view('0header'); ?>
<?php $this->load->view('0breadcrumb'); ?>

<div class="cb" style="height:15px;"></div>

<div id="product-detail">
	<div class="fleft image">
		<div class="image-box">
		<?php if($product->disc_type == "Percent") { $percent = '%'; } else { $percent = ''; }  ?>
			<div class="ribbon"><?php echo $product->disc,$percent; ?></div>
			<img class="big-image" src="" />
		</div>
		<div class="image-thumb-wrapper">
			<?php if($product_thumb){?>
			<?php foreach($product_thumb AS $val_thumb) { ?>
			<div class="image-thumb-item"><img src="<?php echo base_url('assets/upload/product/m/'.$val_thumb->thumb135);?>" big="<?php echo base_url('assets/upload/product/'.$val_thumb->photo);?>" title="<?php echo $product->name;?>" alt="<?php echo $product->name;?>" /></div>
			<?php }?>
			<?php } ?>
		</div>
	</div>
	<div class="fright information">		
		<div class="title"><?php echo $product->name;?></div>
		<div class="code">CODE : <?php echo $product->code;?></div>
		<div class="deskripsi"><?php echo $product->deskripsi;?></div>
		
		<div class="social">
			Share
			<br />
			<div class="fleft tweet"></div>
			<div class="fleft fb"></div>
			<div class="cb"></div>
		</div>
		
		<div class="cb" style="height:30px;"></div>
		
		<?php if($product->qty > 0) { 
		if($product->disc_type == "Percent") { $percent = '%'; } else { $percent = ''; }
		?>
		<?php echo form_open_multipart('checkout', array('id' => 'fAddToCart', 'autocomplete' => 'off')); ?>
		<input type="hidden" name="product_id" value="<?php echo $product->id_product;?>" />
		<div class="price">
			<div class="fleft discount-percent">
				<div class="title">DISCOUNT</div>
				<div class="percentage"><?php 
				
				if($product->disc==0 && $product->diskonManufaktur!=0){
					$disc = $product->base_price - ($product->base_price * $product->diskonManufaktur/100);
					echo $product->diskonManufaktur.' '.$percent;
				}
				
				if($product->disc!=0 && $product->diskonManufaktur!=0){
					$disc = $product->base_price - ($product->base_price * $product->disc/100);	
					echo $product->disc.' '.$percent;
				}
				
				if($product->disc!=0 && $product->diskonManufaktur==0){
					$disc = $product->base_price - ($product->base_price * $product->disc/100);
					echo $product->disc.' '.$percent;
				}
				if($product->disc==0 && $product->diskonManufaktur==0){
					$disc = $product->base_price;
					echo $product->disc.' '.$percent;//
				}
				?></div>
			</div>
			<div class="fleft nett-price">
				<div class="title">PRICE</div>
				<span class="currency">IDR</span>
				<span class="price1">
				<?php 
						$countCaracterPrice=strlen(substr(number_format($disc, 0, '', '.'), 0, strlen($disc) - 2));
						if($countCaracterPrice==4){
						?>
						
						<?php echo implode('', explode('.', substr(number_format($disc, 0, '', '.'), 0, strlen($disc) - 2)));?>
					    
					    <? }elseif($countCaracterPrice==5){ ?>
					    	<?php echo implode('.', explode('.', substr(number_format($disc, 0, '', '.'), 0, strlen($disc) - 2)));?>
					    <? }elseif($countCaracterPrice==3){ ?>
					    	<?php echo implode('', explode('.', substr(number_format($disc, 0, '', '.'), 0, strlen($disc) - 2)));?>
					    <? } ?>	
					<?php //echo substr($disc, 0, strlen($disc)-3);?>
				</span>
				<span class="price2">.<?php echo substr($disc, -3);?></span>
				<div class="cb"></div>
			</div>
			<div class="fleft quantity">
				<div class="title">QUANTITY</div>
				<div class="qty">
					<select name="qty">
						<?php for($i = 1; $i <= $product->qty; $i++) { ?>
						<option value="<?php echo $i;?>"><?php echo $i;?></option>
						<?php }?>
					</select>
				</div>
			</div>
			<div class="cb"></div>
		</div>
		
		<div class="cb" style="height:25px;"></div>
		
		<div id="button-action">
			<input type="submit" id="add-to-bag" class="red-button" value="ADD TO BAG" />
			<a href="<?php echo base_url('checkout/account')?>"><div id="check-out" class="gray-button">CHECKOUT</div></a>
		</div>
		
		<?php echo form_close(); ?>
		<?php } else { ?>
		<div id="out-of-stock">
			<div class="title"><?php echo lang('global_products.out_of_stock.title', '');?></div>
			<div class="body-text"><?php echo lang('global_products.out_of_stock.body_text', '');?></div>
			
			<div class="cb" style="height:18px;"></div>
			
			<?php echo form_open('account/notifyme', array('id' => 'fNotifyProduct')); ?>
				<input type="hidden" name="id_product" value="<?php echo $product->id_product?>" />
				<input type="hidden" name="alias" value="<?php echo $product->alias?>" />
				<input type="text" name="email" id="email-input" class="fleft" placeholder="<?php echo lang('global_products.out_of_stock.placeholder', '');?>" />
				<input type="submit" value="<?php echo lang('global_products.out_of_stock.link_text', '');?>" class="red-button" />
			<?php echo form_close(); ?>
		</div>
		<div class='cb'></div>
		<?php if ($this->session->flashdata('notify_msg')) echo '<br /><div class="errmsg">'.$this->session->flashdata('notify_msg').'</div>'; ?>
		<?php } ?>
	</div>
	<div class="cb"></div>
</div>
<?php if($related_product) { ?>
<div class="cb" style="height:66px;"></div>

<div id="related-product" class="body-wrapper">
	<div class="fleft"><h2>RELATED PRODUCT</h2></div>
	
	<div class="cb" style="border:1px solid #bfbdbd; margin-bottom:5px;"></div>
	
	<div id="related-product-list-wrapper">
		<?php $ctr = 0; foreach($related_product AS $item) { $ctr++; 
		//$price_nett = $item->base_price * $item->disc * 0.01; 
		$price_nett=$item->base_price - ($item->disc * $item->base_price)/100
		?>
		<a href="<?php echo base_url('product/category/'.$item->category_alias.'/'.$item->alias);?>">
		<div class="related-product-item <?php echo ($ctr % 5 == 0? "last":"");?>">	
			<?php 
			if($this->product_model->pic($item->id_product)) {
				foreach($this->product_model->pic($item->id_product) AS $val_thumb) { ?>
			<div class="image"><img src="<?php echo base_url('assets/upload/product/m/'.$val_thumb->thumb135);?>" /></div>
			<?php 
				}
			} ?>
			<div class="base_price" style="text-decoration: line-through; height: 20px;">IDR 
				<?php if($item->disc!=0){
					echo number_format($item-> base_price, 0, '', '.');
				}elseif($item->diskonManufaktur!=0){
					echo number_format($item -> base_price, 0, '', '.');
				} 
				?>
				
				<?php //echo $this->currency->idr($item->base_price);?></div>
			<div class="price-nett">
				<div class="currency">IDR</div> 
				<div class="price1"><?php echo $this->currency->idr(substr($price_nett, 0, strlen($price_nett)-3));?></div>
				<div class="price2">.<?php echo  substr($price_nett, -3);?></div>
				<div class="cb"></div>
			</div>
			
			<div class="cb" style="border-top:1px solid #b0a4a4; margin-top:12px; margin-bottom:9px;"></div>
			<?php $item->deskripsi = strip_tags($item->deskripsi); ?>
			<div class="title"><?php echo $item->name?></div>
			<div class="short-desc"><?php echo ((strlen($item->deskripsi) <= 100) ? $item->deskripsi : substr($item->deskripsi, 0, 90)."..");?></div>
			
			<div class="cb" style="border-top:1px solid #b0a4a4; margin-top:12px; margin-bottom:6px;"></div>
			
			<div class="code">CODE : <?php echo $item->code?></div>
		</div> <!-- end of .related-product-item -->
		</a>
		<?php } // end of foreach ?>

		<div class="cb"></div>
	</div> <!-- end of #related-product-list-wrapper -->
</div><div class="cb"></div>
<?php } // end of if($related_product) ?>

<script>$(function(){
	$(".image-thumb-item").click(function(){
		$parent = $(this).parent().parent();
		var photo = $(this).find('img').attr('big');
		$parent.find('.big-image').fadeOut('fast',function(){
			$(this).attr('src', photo).fadeIn();
		});
	});
	
	$(".fleft.image").find('.image-thumb-item:nth-child(1)').click();
});</script>
<?php $this->load->view('0footer'); ?>
