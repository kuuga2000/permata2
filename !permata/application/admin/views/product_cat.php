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
							<div class='float'><div class='label col-120'>Category Name</div></div>
						<?php
							echo form_open($subpage.'/cat_save'); 
						?>
							<div class='float'><input type="hidden" name="id_product" value="<?php echo $id_product; ?>">
							<input type="hidden" name="position" value="<?php echo $this->uri->segment(3); ?>">
							<select name="category_name">
						<?php
						$tag_parent = '&nbsp ';
						$tag_child = '&nbsp  ';
						foreach ($cat_option as $co) {
						if($co->lev4 == '')
						{	$disable = ''; }
						else
						{	$disable = 'style="color:#888; "'; }
						if($co->lev4) { $show = $co->lev4; $idlev = $co->idlev4; $star = '***'; }
						else if($co->lev3) { $show = $co->lev3; $idlev = $co->idlev3; $star = ' **'; }
						else if($co->lev2) { $show = $co->lev2; $idlev = $co->idlev2; $star = '  *'; }
						else{ $show = $co->lev1; $idlev = $co->idlev1; $star = '   '; }
						?>
								<option <?php echo $disable; ?> value="<?php echo $idlev.'_'.$show.'_'.$id_product; ?>"><?php echo $show; echo $star; ?></option>
						<?php
						$tag_parent = '&nbsp ';
						$tag_child = '&nbsp  ';
						}
						?>
							</select>
							</div>
							<div class="clear"></div>
							<div class='float col-120''><input type='submit' value='Add'></div>
						<?php echo form_close() ?>
						</div>
					</div>
					
					<div class="clear"></div>
					<div class="minitable col-440" >
					<div class='minitab-sub'>
						<div class='float col-40 mid-col'> ID </div>
						<div class='float col-120 mid-col'>Category Name</div>
						<div class='float col-120 mid-col'>Enable</div>
						<div class="clear"></div>
					</div>
					
					<?php 
					$c = 1;
					foreach ($category as $cpt) {
					if($cpt->enable == 1)
					{	$icon = 'class="ui-icon ui-icon-check"'; $enable = 0;	}
					else
					{	$icon = 'class="ui-icon ui-icon-close"'; $enable = 1;	}
					?>
					<div class='minitab-sub'>
						<div class='float col-40'><?php echo $c; ?></div>
						<div class='float col-120'><?php echo $cpt->cat_name; ?></div>
						<div class='float col-40'><?php echo anchor('category/cprod_enable/'.$this->uri->segment(3).'/'.$cpt->id_prod_cat.'/'.$enable, '<span '.$icon.'></span>'); ?></div>
						<div class='float col-40 deleteform'><?php echo anchor('category/cprod_delete/'.$this->uri->segment(3).'/'.$cpt->id_prod_cat.'/'.$enable,'[Delete]'); ?></div>
						<div class="clear"></div>
					</div>
					<?php
						$c++;
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
