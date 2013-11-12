<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php include "system/global.php"; ?>
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
<style>
  .ui-autocomplete-loading {
    background: white url('<?php echo base_url();?>assets/js/jqueryui/images/ui-anim_basic_16x16.gif') 95% center no-repeat;
	padding-right:5px;
  }
</style>
<script>
	$(document).ready(function(){
			function split( val ) {
			  return val.split( /,\s*/ );
			}
			function extractLast( term ) {
			  return split( term ).pop();
			}
			function onlyUniqueValues(value, index, self) { 
				return self.indexOf(value) === index;
			}
			$("#autocomplete_interest").autocomplete({			
				source: function (request, response) {
					$('#info_interest').removeClass('error_msg').html("");
					var csrf = $('input[name="nbdvm"]').val();
					$.ajax({
						type: "POST",
						url: "<?php echo site_url('product/suggestions'); ?>",
						data: {term : extractLast($("#autocomplete_interest").val()),nbdvm: csrf},
						dataType: "json",
						success: function (data) {
							if (data != null) {
								response($.map(data, function (item) {
									return {
										label: item,
										value: item                          
									}
								}))
							} 
							else
							{
								$(this).removeClass('ui-autocomplete');
							}							
						},
						error: function(data)
						{
							$('#autocomplete_interest').removeClass('ui-autocomplete-loading');						
							$('#info_interest').addClass('error_msg').html("There is no topic of interest for " + extractLast($("#autocomplete_interest").val())+"");
						},
						delay:500
					});
				},search: function() {
					$(this).addClass('ui-autocomplete-loading');
					// custom minLength
					var term = extractLast( this.value );
					/* var spliiit = split(this.value);
					var ln = spliiit.length;
					if(ln > 1)
					for(var lm = 1; lm <= ln; lm++)
					{							
						if(spliiit[(lm-2)].localeCompare(term) == 0)
						{
							alert('f');
							return false;
							break;
						}
					} */
					if ( term.length < 1 ) {
					return false;
					}
				},					
				open    : function(){$(this).removeClass('ui-autocomplete-loading');},
				focus: function() {
				  return false;
				},
				select: function( event, ui ) {
				  var terms = split( this.value );
/* remove the current input */
				  terms.pop();
/*  add the selected item */
				  terms.push(ui.item.value);
/* add placeholder to get the comma-and-space at the end */
				  terms.push("");
				  terms = terms.filter( onlyUniqueValues);
				  this.value = terms.join( ", " );
				  $('').value = terms.join( ", " );
				  return false;
				}
			});
	});
</script>
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
					<div class="float_r button-add"><?php echo anchor('product/stock/'.$id_product,'Back') ?></div>
					<div class='display'>
					<?php foreach($stock_view as $sv){
						if($sv->bas_price) { $base_price = $sv->bas_price; $actase = 'Change'; } else { $base_price = $sv->base_price; $actase = '';}
						if($sv->etax) { $tax = $sv->etax; $actax = 'Change'; } else { $tax = $sv->tax; $actax = '';}
						if($sv->edisc) { $disc = $sv->edisc; $actdis = 'Change'; } else { $disc = $sv->disc; $actdis = '';}
						$total_price = (($base_price * $tax)/ 100) + $base_price;
						if($sv->edisc_type == 'Amount Flat')
						{	$net_price = $total_price - $disc;	}
						else { $net_price = $total_price - (($total_price * $disc)/ 100); }
	
					?>
					<?php echo form_open($subpage.'/stock_info_save');   ?>
					<div class='minitab-sub'>
					<div class='float'><div class='label col-80'>Attribute</div></div><div  style="width:380px; margin-top:14px;"><?php echo $sv->deskripsi; ?>
					<input type="hidden" name="id_prod_stock" value="<?php echo $this->uri->segment(4); ?>">
					<input type="hidden" name="id_product" value="<?php echo $this->uri->segment(3); ?>">
					</div>
					<div class="clear"></div>
					<div class='float'><div class='label col-80'>Base Price</div></div><div class='float'><input type='text' name="baseprice" value="<?php echo $base_price ?>"> <?php // echo $actase; ?></div>
					<div class="clear"></div>
					<div class='float'><div class='label col-80'>Tax</div></div><div class='float'><input type='text' name="tax" value="<?php echo $tax ?>"> <?php // echo $actax; ?></div>
					<div class="clear"></div>
					<div class='float'><div class='label col-80'>Disc</div></div><div class='float'><input type='text' name="disc" value="<?php echo $disc ?>"><?php echo $sv->edisc_type; ?> <?php // echo  $actdis; ?></div>
					<div class="clear"></div>
					<div class='float'><div class='label col-80'>Total Price</div></div><div class='float' style="margin-top:12px;"><?php echo number_format($total_price, 0, ',', '.'); ?></div>
					<div class="clear"></div>
					<div class='float'><div class='label col-80'>Net Price</div></div><div class='float' style="margin-top:12px;"><?php echo number_format($net_price, 0, ',', '.'); ?></div>
					
					
					<div class="clear"></div>
					</div>
					<div class='minitab-sub'>
					<?php } ?>
					<div class="float"><div class='label col-80'>Image</div></div> 
					<div class="float"><div class='label '>
					<?php
					$idprodstock = '';
					$checked = '';
					foreach($stock_pic as $sc){
					$idprodstock = $sc->id_prod_stock;
					if($idprodstock === $this->uri->segment(4)) $checked = 'checked';
					?>
					<img src="<?php echo $site_url; ?>/assets/upload/product/s/<?php echo $sc->thumb25; ?>" >
					<input type="checkbox" name="cover_<?php echo $sc->idproduct_pic; ?>" value="1" <?php echo $checked; ?>>
					<input type="hidden" name="name_prod_<?php echo $sc->idproduct_pic; ?>" value="<?php echo $this->uri->segment(4); ?>">
					<?php
					$checked = '';
					}
					?>
					</div></div>
					<div class="clear"></div>
					<?php
					/*
					<div class="float col-80">Tag</div>
					<div class="float col-440px" >
					<select name="tag">
					
					<?php
					foreach($tag as $tg)
					{
						echo '<option value="'.$tg->alias.'_'.$tg->tag.'">'.$tg->tag.'</option>';
					}
					?>
					</select>
					<textarea name="tag" id="autocomplete_interest" placeholder="Tag ... "></textarea>
					</div>
					<div class="clear"></div>
					<div class="float" style="margin-left:95px;" >
					<?php
					foreach($my_tag as $mtg)
					{
						echo '<div class="float tag-list">'.anchor('tag/delete_stock/'.$mtg->id_product.'/'.$mtg->id_prod_stock.'/'.$mtg->id_tag_stock,$mtg->tag.'<span>x</span>').'</div>';
					}
					?>
					<div class="clear"></div>
					</div> 
					*/
					?>
					<div class="clear"></div>
					<div class='float col-40 mid-col'><input type="submit" style="padding:2px 14px;" value="Save"></div>
					<div class="clear"></div>
					</div>
					<?php echo form_close() ?>
				</div>
				<div class="clear"></div>
			</div>
			<div class="clear"></div>
		</div>
		<div class="clear"></div>
	</div>
</div>

<?php $this->load->view('00footer.php'); ?>
