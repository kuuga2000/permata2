<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $this->load->view('00header.php'); ?>
<div id="wrap">
<?php $this->load->view('00sidemenu.php'); ?>
	<div id="submenu-pages">
		<div id="submenuback"></div>
		<div id="submenuwrap">
			<div id="submenushadow"></div>
			<ul id="submenu">
				<?php
				foreach ($subpages as $p) {
					//if (priv_page($p->alias)) {
				?>
				<a href="<?php echo site_url(); ?>catalog/<?php echo $p->alias; ?>">
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
					<div id="breadcrumb">
					<?php
					if($breadc)
					{
						foreach ($breadc as $bc)
						{
							if($bc->level == 1)
							{ echo $bc->cru1.' > '.$bc->cru2.' > '.$title;  }
							else if( $bc->level == 0)
							{ echo $bc->cru1.' > '.$title;  }
							else
							{ echo $this->uri->segment(1);}
						}
					}
					else
					{	echo $title;	}
					?>
					</div>
					<h1><?php echo $title; ?></h1>
					<div class='display'>

						<div class="category">
						<div class="head-cat"><?php echo anchor('category/add','Add'); ?> Add Category </div>
						<?php
						$ling = '';

						$tag_parent = '&nbsp ';
						$tag_child = '&nbsp  ';
						foreach($catlist as $co){
						if($co->lev4 == '')
						{	$disable = ''; }
						else
						{	$disable = 'style="color:#ccc; "'; }
						
						if($co->lev4) { $show = $co->lev4; $idlev = $co->idlev4; $star = '***'; }
						else if($co->lev3) { $show = $co->lev3; $idlev = $co->idlev3; $star = '**'; }
						else if($co->lev2) { $show = $co->lev2; $idlev = $co->idlev2; $star = '*'; }
						else{ $show = $co->lev1; $idlev = $co->idlev1; $star = ''; }
						
						

						?>
						
						<div class="body-cat" <?php echo $disable ?>>
						<?php 
						$ling = anchor('category/add/','Add');
							
						?>
							<div class="button-edit col-220"><?php echo anchor('category/edit/',$show.'<span> Edit</span>');  ?></div>
							<div class="float col-40"><?php echo $star; ?></div>

						</div>
						<?php
						$disable = '';
						$ling = '';
						$star = '';
						$show = '';
						}
						?>
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
