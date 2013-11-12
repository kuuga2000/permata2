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
					<div class='float'><div class='label col-80'>New Tag</div></div>
					<?php
						echo form_open($subpage.'/save'); 
					?>
					<div class='float'>
						<input type='text' name='tagname' > 
					</div>
					<div class="clear"></div>
					<div class='float col-80'> &nbsp </div>
					<div class='float col-80'><input type='submit' name='submit' value='Save'></div>
					<?php echo form_close() ?>
					<div class="clear"></div>
					<div class='minitab-sub' style="background:#ccc; margin-top:15px;">

						<div class='float col-120'>#</div>
						<div class='float col-160'>Tag Name</div>
						<div class='float col-240'>Use In Product</div>

						<div class="clear"></div>
					</div>
					<?php

					foreach ($tag_all as $ptr)
					{
					?>
					<div class='minitab-sub' >
						<div class='float col-120'><?php echo anchor('catalog/tag/'.$ptr->alias,'[edit]');  ?> | <?php echo anchor('tag/delete/'.$ptr->alias,'[delete]');  ?></div>
						<div class='float col-160'><?php echo $ptr->tag;  ?></div>
						<div class='float col-240'> &nbsp </div>

						<div class="clear"></div>
					</div>
						
					<?php
					if($dattr == $ptr->alias){
					?>
					<div class='float col-240' style="margin-top:-7px; margin-bottom:-8px; ">
					<?php echo form_open($subpage.'/save');  ?>
						<input type="hidden" name="alias" value="<?php echo $ptr->alias; ?>">
						<input type="text" style="font-size:12px; height:15px;" name="tagname" value="<?php echo $ptr->tag;  ?>"></div>
						<div class='float col-80'>
						<input type="submit" value="Save" style="font-size:12px; height:31px;">
						</div>
						<div class="clear"></div>
					<?php echo form_close() ?>
					<?php
					}
					?>
					
					<?php

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
