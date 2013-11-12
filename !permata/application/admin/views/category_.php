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
					<div id="breadcrumb"><?php	echo $breadc;	?></div>
					<h1><?php echo $title; ?></h1>
					<div class='display'>
					<div class='float'><div class='label col-120'>New Category</div></div>
					<?php
						echo form_open('category/save_data'); 
					?>
					<div class='float'>
						<input type='text' name='catname' > 
					</div>
					<div class="clear"></div>
					<div class='float col-120'> &nbsp </div>
					<div class='float col-120'><input type='submit' name='submit' value='Save'></div>
					<?php echo form_close() ?>
					<div class="clear"></div>
					<div class='minitab-sub' style="background:#ccc; margin-top:15px;">
						<div class='float col-40'>No</div>
						<div class='float col-260'>Category Name</div>
						<div class='float col-40'>Enable</div>
						<div class='float col-40'>Action</div>
						<div class="clear"></div>
					</div>
					<?php
					$position = 1;
					if($catlist != NULL)
					{
					foreach ($catlist as $ptr)
					{
						if($ptr->enable == 1)
						{ $icon = 'class="ui-icon ui-icon-check"'; $dataenable = 0; }
						else
						{ $icon = 'class="ui-icon ui-icon-close"'; $dataenable = 1; }
						
						if(@$store != $ptr->lev1)
						{
					?>
					<div class="minitab-sub"  style="background:#efefef; <?php if($this->uri->segment(3) == $ptr->idlev1) { echo 'height:34px;'; } else { echo 'height:19px;';} ?> ">
						<div class='float col-40'><?php echo $position; ?></div>
						<div class='float col-260'>
						<?php 
						if($this->uri->segment(3) == $ptr->idlev1)
						{
							echo form_open('category/save_data',array('class' => 'cateform'));
							echo '<input type="hidden" name="catid" value="'.$ptr->idlev1.'">';
							echo '<input type="text" name="catname"  style="font-size:12px; height:20px; width:105px; margin-top:1px; margin-right:7px;" value="'.$ptr->lev1.'">';
							echo '<input style="margin-top:-9px; " type="submit" value="Save">';
							echo form_close();
						}
						else
						{	echo anchor('catalog/category/'.$ptr->idlev1,$ptr->lev1);  }
						?> 
						</div>
						<div class='float col-40'><?php echo anchor('category/category_enable/'.$ptr->idlev1.'/'.$dataenable,'<span '.$icon.'></span>'); ?></div>
						<div class='float col-40 deleteform'><?php echo anchor('category/category_delete/'.$ptr->idlev1.'/'.$dataenable,'[Delete]'); ?></div>
					</div>
					<div class="clear"></div>
					<?php
							$store = $ptr->lev1;
							$position++;
						}
					}
					}
					
					?>
					<div class="clear"></div>
					

					
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
