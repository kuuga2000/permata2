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
						<div class='display-body'>
						<?php
							echo  form_open_multipart($subpage.'/photo_save'); 
						?>
							<input type="hidden" name="id_prod" value="<?php echo $id_product ?>">
							<input type="hidden" name="position" value="<?php echo $this->uri->segment(3); ?>">
							<div class='float'><div class='label col-80'>Photo</div></div><div class='float'><input type='file' name="img"></div>
							<div class="clear"></div>
							<div class='float'><div class='label col-80'>Caption</div></div><div class='float'><input type='text' name="caption"></div>
							<div class="clear"></div>
							<div class='float col-80''><input type="submit" value="Save"></div>
						<?php echo form_close() ?>
						</div>
					</div>
					<div class="clear"></div>
						<script>
						  $(function() {
							$( ".dialog-form" ).dialog({
							  autoOpen: false,
							  height: 300,
							  width: 350,
							  modal: true,
							});
						 
							$( ".comment" )
							  .click(function() {
							  event.preventDefault();
								$( ".dialog-form" ).dialog( "open" );
							  });
						  });
						  </script>

					<?php if($picture){ ?>
					<div class="minitable" >
					<div class='minitab-sub'>
						<div class='float col-40'>#</div>
						<div class='float col-40'>Images</div>
						<div class='float col-120'>Caption</div>
						<div class='float col-40'>Cover</div>
						<div class='float col-40'>Enable</div>
						<!--<div class='float col-80'>Total Use</div>-->
						<div class='float col-40'>Action</div>
						<div class="clear"></div>
					</div>
					<?php 
					$position = 1;
					foreach ($picture as $cpt) {
					if($cpt->enable == 1)
						{ $icon = 'class="ui-icon ui-icon-check"'; $dataenable = 0; }
					else
						{ $icon = 'class="ui-icon ui-icon-close"'; $dataenable = 1; }
					if($cpt->cover == 1)
						$iconcover = 'class="ui-icon ui-icon-check"';
					else
						$iconcover = 'class="ui-icon ui-icon-close"';
					?>

					<div class='minitab-sub'>
						<div class='float col-40'><?php echo $position; ?></div>
						<div class='float col-40'><img src="<?php echo $site_url; ?>/assets/upload/product/s/<?php echo $cpt->thumb25; ?>" ></div>
						<div class='float col-120'><?php echo $cpt->caption; ?>&nbsp </div>
						<div class='float col-40'><?php echo anchor('product/cover_change/'.$id_product.'/'.$cpt->idproduct_pic, '<span '.$iconcover.'></span>'); ?></div>
						<div class='float col-40'><?php echo anchor('product/pic_enable/'.$id_product.'/'.$cpt->idproduct_pic.'/'.$dataenable, '<span '.$icon.'></span>'); ?></div>
						<!--<div class='float col-80'><?php echo $cpt->countstock; ?></div>-->
						<div class='float col-40 deleteform'><?php echo anchor('product/pic_delete/'.$id_product.'/'.$cpt->idproduct_pic, '[Delete]'); ?></div>
						<div class="clear"></div>
					</div>

					<?php
					$position++;
					}
					}
					?>
					<div class="dialog-form" title="Create new user">
							  <p class="validateTips">All form fields are required.</p>
							 
							  <form>
							  <fieldset>
								<label for="name"><?php echo $cpt->countstock; ?></label>
								<input type="text" name="name" id="name" class="text ui-widget-content ui-corner-all" />
								<label for="email">Email</label>
								<input type="text" name="email" id="email" value="" class="text ui-widget-content ui-corner-all" />
								<label for="password">Password</label>
								<input type="password" name="password" id="password" value="" class="text ui-widget-content ui-corner-all" />

							  </fieldset>
							  </form>
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
