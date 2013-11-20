<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
?>
<?php $this -> load -> view('0header');?>
<div id="home-slide">
	<div id="home-slide-wrapper">
		<?php $ctr = 0;
if ($slide_list) {
foreach($slide_list as $val) { $ctr++;
		?>
		<a href="<?php echo $val -> url;?>"> <img src="<?php echo base_url('assets/upload/gallery/' . $val -> img);?>" /> </a>
		<?php
		if ($ctr >= 5) {
			break;
		}
		?>
		<?php
		}
		}
		?>
	</div>
	<div id="home-slide-button">
		<?php $ctr = 0;
if ($slide_list) {
foreach($slide_list as $val) { $ctr++;
		?>
		<a data-slide-index="<?php echo($ctr - 1);?>" href="">
		<div class="home-slide-button-item <?php echo ($ctr == 1 ? 'first':'')?> <?php echo ($ctr == 5 ? 'last':'')?>" i="<?php echo base_url('assets/upload/gallery/' . $val -> img);?>">
			<?php echo strtoupper($val -> title);?>
		</div> </a>
		<?php
		if ($ctr >= 5) {
			break;
		}
		}
		?>
		<?php
		}
		?>
	</div>
</div>
<div class="cb" style="height:30px;"></div>
<div id="home-left-column">
	<div id="have-a-question">
		<h2><?php echo lang('global_havequestion.title', '');?></h2>
		<?php echo lang('global_havequestion.text', '');?>
		<br />
		<br />
		<a href="<?php echo base_url('contact-us')?>"> <?php echo lang('global_havequestion.button', '');?><img src="<?php echo base_url()?>assets/css/img/link-arrow.png" /> </a>
	</div>
	<div class="cb" style="height:50px;"></div>
	<div id="newsletter">
		<?php echo form_open('account/newsletter', array('id' => 'fNewsletter'));?>
		<h2><?php echo lang('global_newsletter.title', '');?></h2>
		<input type="text" name="newsletter-email" placeholder="<?php echo lang('global_newsletter.placeholder', '');?>" />
		<div id="newsletter-cpr">
			<?php echo lang('global_newsletter.text', '');?>
		</div>
		<input type="submit" id="newsletter-submit" value="<?php echo lang('global_newsletter.button', '');?>" />
		<?php echo form_close();?>
		<div class="cb"></div>
		<?php
		if ($this -> session -> flashdata('newsletter_subscribe'))
			echo '<br /><div class="errmsg">' . $this -> session -> flashdata('newsletter_subscribe') . '</div>';
		?>
	</div>
	<div class="cb" style="height:50px;"></div>
	<div id="distributor">
		<h2><?php echo lang('global_manufacturer.title', '');?></h2>
		<div class="cb" style="height:10px;"></div>
		<?php $ctr = 0;
if ($brand_list) {
foreach($brand_list as $val) { $ctr++;
		?>
		<a href="<?php echo $val -> url;?>" target="_blank">
		<div class="distributor-item <?php echo ($ctr % 3 == 0 ? "last":"")?>">
			<img
			src="<?php echo base_url('assets/upload/gallery/' . $val -> img);?>"
			width="62"
			height="21"
			alt="<?php echo $val -> title;?>"
			title="<?php echo $val -> title;?>" />
		</div> </a>
		<?php
		}
		}
		?>
		<div class="cb"></div>
	</div>
</div>
<div id="home-right-column">
	<?php
if ($product_featured) {
	?>
	<div id="home-product-slide">
		<div class="fleft">
			<h2>PRODUCT SALE</h2>
		</div>
		<?php if ($product_featured) {
		?>
		<div class="fright" id="home-product-slide-nav">
			<div id="home-product-slide-page"></div>
			<div id="home-product-slide-arrow">
				<div class="left"></div>
				<div class="right"></div>
				<div class="cb"></div>
			</div>
			<div class="cb"></div>
		</div>
		<?php }?>
		<div class="cb" style="margin-bottom:17px; border-top:1px solid #bfbdbd;"></div>
		<div id="home-product-slide-wrapper">
			<?php $i = 0; foreach($product_featured AS $val_item) { $i++; if($val_item->disc_type == "Percent") { $percent = '%'; } else { $percent = ''; }
			?>
			<div class="home-product-slide-item <?php echo($i == 1 ? "active" : "");?>">
				<div class="fleft image">
					<div class="image-box">
						<?php
if($val_item->disc){
						?>
						<div class="ribbon">
							<?php echo $val_item -> disc . $percent;?>
						</div>
						<?php }?><img class="big-image" src="" />
					</div>
					<div class="image-thumb-wrapper">
						<?php
if($this->product_model->pic($val_item->id_product, 4)) {
foreach($this->product_model->pic($val_item->id_product, 4) AS $val_thumb) {
						?>
						<div class="image-thumb-item">
							<img src="<?php echo base_url('assets/upload/product/m/' . $val_thumb -> thumb135);?>" big="<?php echo base_url('assets/upload/product/' . $val_thumb -> photo);?>" title="<?php echo $val_thumb -> thumb135;?>" alt="<?php echo $val_thumb -> thumb135;?>" />
						</div>
						<?php
						}
						}
						?>
					</div>
				</div>
				<div class="fright information">
					<a href="<?php echo base_url('product/featured/sale/' . $val_item -> alias);?>">
					<div class="add-to-bag">
						ADD TO BAG
					</div></a>
					<div class="cb" style="height:20px;"></div>
					<div class="title">
						<?php echo $val_item -> name;?>
					</div>
					<div class="code">
						CODE : <?php echo $val_item -> code;?>
					</div>
					<div class="short-description">
						<?php echo((strlen($val_item -> deskripsi) <= 200) ? $val_item -> deskripsi : substr($val_item -> deskripsi, 0, 190) . "..");?>
					</div>
					<div class="cb"></div>
					<div class="social">
						<br>
						Shares 
						<br />
						<!--twt-->
			<div id="fb-root"></div>
			    <a href="https://twitter.com/share" class="twitter-share-button" data-lang="en">Tweet</a>

    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
			<!--end twt-->
			<!--fb-->
			<!--<div id="fb-root"></div>-->
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/id_ID/all.js#xfbml=1&appId=559214290818992";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div class="fb-like" style="left: -22px;" data-href="<?php echo site_url();?>" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>
			<!--end fb-->

						<!--<div class="fleft tweet"></div>
						<div class="fleft fb"></div>-->
						<div class="cb"></div>
					</div>
					<div class="cb" style="height:30px;"></div>
					<div class="price">
						<div class="fleft discount-percent">
							<div class="title">
								DISCOUNT
							</div>
							<div class="percentage">
								<?php
								if ($val_item -> disc != 0 && $val_item -> diskonManufaktur != 0) {
									$price = $val_item -> base_price - ($val_item -> base_price * $val_item -> disc / 100);
									echo $val_item -> disc . ' ' . $percent;
								} elseif ($val_item -> disc != 0 && $val_item -> diskonManufaktur == 0) {
									$price = $val_item -> base_price - ($val_item -> base_price * $val_item -> disc / 100);
									echo $val_item -> disc . ' ' . $percent;
								} elseif ($val_item -> disc == 0 && $val_item -> diskonManufaktur != 0) {
									$price = $val_item -> base_price - ($val_item -> base_price * $val_item -> diskonManufaktur / 100);
									echo $val_item -> diskonManufaktur . ' ' . $percent;
								} else {
									$price = $val_item -> base_price;
									echo $val_item -> disc . ' ' . $percent;
								}
								//echo $val_item -> disc . ' ' . $percent;
								?>
							</div>
						</div>
						<div class="fleft nett-price">
							<div class="title">
								PRICE
							</div>
							<span class="currency">IDR</span>
							<span class="price1" style="font-size: 23px;" > 
								<?php
								$countCaracterPrice=strlen(substr(number_format($price, 0, '', '.'), 0, strlen($price) - 2));
								if($countCaracterPrice==4){
								?>

								<?php echo implode('', explode('.', substr(number_format($price, 0, '', '.'), 0, strlen($price) - 2)));?>

								<? }elseif($countCaracterPrice==5){?>
								<?php echo implode('.', explode('.', substr(number_format($price, 0, '', '.'), 0, strlen($price) - 2)));?>
								<? }elseif($countCaracterPrice==3){?>
								<?php echo implode('', explode('.', substr(number_format($price, 0, '', '.'), 0, strlen($price) - 2)));?>
								<? }?>

								<?php //echo substr($price, 0, strlen($price) - 3);?></span>
							<span class="price2">
								<?php echo implode('.', explode('.', substr(number_format($price, 0, '', '.'), -4)));?>
								<?php //echo substr($price, -3);?>
							</span>
							<div class="cb"></div>
						</div>
					</div>
				</div>
				<div class="cb"></div>
			</div>
			<?php }?>
		</div>
	</div>
	<?php
	}
	?>
</div>
<?php
if ($product_clearance) {
?>
<div id="home-product-clearance" class="body-wrapper">
	<div class="fleft">
		<h2>CLEARANCE PRODUCT</h2>
	</div>
	<?php if(count($product_clearance) > 5) {
	?>
	<div class="fright" id="home-product-clearance-nav">
		<div id="home-product-clearance-page"></div>
		<div id="home-product-clearance-arrow">
			<div class="left"></div>
			<div class="right"></div>
			<div class="cb"></div>
		</div>
		<div class="cb"></div>
	</div>
	<?php }?>

	<div class="cb" style="border:1px solid #bfbdbd; margin-bottom:5px;"></div>
	<div id="home-product-clearance-wrapper">
		<?php
$ctr = 0;
foreach($product_clearance AS $item) { $ctr++;
if($item->disc_type == "Percent"){ //$discprice = $item->base_price - ($item->disc * $item->base_price)/100; } else { $discprice = $item->base_price - $item->disc;
}

$photo = '';
if($this->product_model->pic($item->id_product))
foreach($this->product_model->pic($item->id_product) AS $val_thumb)
$photo = $val_thumb->thumb135;
		?>
		<?php if($ctr % 5 == 1) {
		?>
		<div class="home-product-clearance-group">
			<?php }?>
			<a href="<?php echo base_url('product/featured/clearance/' . $item -> alias);?>">
			<div class="home-product-clearance-item <?php echo($ctr % 5 == 0 ? "last" : "");?>">
				<div class="image"><img src="<?php echo base_url('assets/upload/product/m/' . $photo);?>" />
				</div>
				<div style="height: 20px;" class="price-original">
					<?php
					if ($item -> disc != 0 && $item -> diskonManufaktur != 0) {
						echo 'IDR ' . number_format($item -> base_price, 0, '', '.');

					} elseif ($item -> disc != 0 && $item -> diskonManufaktur == 0) {
						echo 'IDR ' . number_format($item -> base_price, 0, '', '.');
					} elseif ($item -> disc == 0 && $item -> diskonManufaktur != 0) {
						echo 'IDR ' . number_format($item -> base_price, 0, '', '.');
					}
					?>
				</div>
				<div class="price-nett">
					<div class="currency">
						IDR
					</div>
					<!--for discount-->
					<?php

					if ($item -> disc == 0 && $item -> diskonManufaktur !== 0) {
						$discprice = ($item -> base_price - ($item -> base_price * $item -> diskonManufaktur / 100));
					}

					if ($item -> disc != 0 && $item -> diskonManufaktur != 0) {
						$discprice = ($item -> base_price - ($item -> base_price * $item -> disc / 100));

					}

					if ($item -> disc != 0 && $item -> diskonManufaktur == 0) {
						$discprice = ($item -> base_price - ($item -> base_price * $item -> disc / 100));
					}
					?>

					<div class="price1">
						<?php echo number_format(substr($discprice, 0, strlen($discprice) - 3), 0, '.', '.');?>
					</div>
					<div class="price2">
						.<?php echo(substr($discprice, -3));?>
					</div>
					<div class="cb"></div>
				</div>
				<div class="cb" style="border-top:1px solid #b0a4a4; margin-top:12px; margin-bottom:9px;"></div>
				<div class="title">
					<?php echo $item -> name;?>
				</div>
				<div class="short-desc">
					<?php echo((strlen($val_item -> deskripsi) <= 100) ? $val_item -> deskripsi : substr($val_item -> deskripsi, 0, 90) . "..");?>
				</div>
				<div class="cb" style="border-top:1px solid #b0a4a4; margin-top:12px; margin-bottom:6px;"></div>
				<div class="code">
					CODE : <?php echo $item -> code;?>
				</div>
			</div> <!-- end of .home-product-clearance-item --> </a>
			<?php if($ctr % 5 == 0) {
			?>
			<div class="cb"></div>
		</div>
		<!-- end of .home-product-clearance-group -->
		<?php }?>

		<?php
		} // end of foreach
		?>

		<?php if($ctr % 5 < 5) {
		?>
		<div class="cb"></div>
	</div>
	<!-- end of .home-product-clearance-group -->
	<?php }?>
</div>
</div> <?php
}
?>
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
<script>
	$(function() {
		$('#home-slide-wrapper').bxSlider({
			pagerCustom : '#home-slide-button'
		});

		$("#home-product-slide-wrapper").bxSlider({
			auto : false,
			controls : true,
			pager : true,
			pagerType : 'short',
			pagerSelector : '#home-product-slide-page',
			nextText : "oo",
			prevText : "oo",
			nextSelector : "#home-product-slide-arrow .right",
			prevSelector : "#home-product-slide-arrow .left"
		});

		$("#home-product-clearance-wrapper").bxSlider({
			auto : false,
			controls : true,
			pager : true,
			pagerType : 'short',
			pagerSelector : '#home-product-clearance-page',
			nextText : "oo",
			prevText : "oo",
			nextSelector : "#home-product-clearance-arrow .right",
			prevSelector : "#home-product-clearance-arrow .left"
		});

		$(".image-thumb-item").click(function() {
			$parent = $(this).parent().parent();
			var photo = $(this).find('img').attr('big');
			$parent.find('.big-image').fadeOut('fast', function() {
				$(this).attr('src', photo).fadeIn();
			});
		});

		$(".fleft.image").each(function() {
			$(this).find('.image-thumb-item:nth-child(1)').click();
		});
	});

</script>
<?php $this -> load -> view('0footer');?>
