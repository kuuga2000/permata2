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
					<div class='float'><div class='label col-120'>New Attribute Name</div></div>
					<?php
						echo form_open($subpage.'/save'); 
					?>
					<div class='float'>
						<input type='text' name='attrname' > &nbsp <input type="checkbox" name="enable" value='1'> Enable 
					</div>
					<div class="clear"></div>
					<div class='float col-120'> &nbsp </div>
					<div class='float col-120'><input type='submit' name='submit' value='Save'></div>
					<?php echo form_close() ?>
					<div class="clear"></div>
					<div class='minitab-sub' style="background:#ccc; margin-top:15px;">
						<div class='float col-40'>No</div>
						<div class='float col-120'>Attribute Name</div>
						<div class='float col-40'>Enable</div>
						<div class='float col-220'>Action</div>
						<div class="clear"></div>
					</div>
					<?php
					$position = 1;
					foreach ($primattr as $ptr)
					{
						if($ptr->enable == 1)
							{ $icon = 'class="ui-icon ui-icon-check"'; $dataenable = 0; }
						else
							{ $icon = 'class="ui-icon ui-icon-close"'; $dataenable = 1; }
					?>
					<div class='minitab-sub' style="background:#efefef;">
						<div class='float col-40'><?php echo $position; ?></div>
						<div class='float col-120'><?php echo anchor('catalog/attribute/'.$ptr->id_prod_att,$ptr->name);  ?> <?php echo '['.$ptr->counts.']'; ?></div>
						<div class='float col-40'><?php echo anchor('attribute/pic_enable/'.$ptr->id_prod_att.'/'.$dataenable, '<span '.$icon.'></span>'); ?></div>
					<?php
					if($dattr == $ptr->id_prod_att){
					?>
					<div class='float col-240' style="margin-top:-7px; margin-bottom:-8px; ">
					<?php echo form_open($subpage.'/save_val');  ?>
						<input type="hidden" name="idval" value="<?php echo $ptr->id_prod_att; ?>">
						<input type="text" style="font-size:12px; height:15px;" name="attval" placeholder="Add new value ... ."></div>
						<div class='float col-80'>
						<input type="submit" value="Save" style="font-size:12px; height:31px;">
						</div>
					<?php echo form_close() ?>
					<?php
					}
					?>
						<div class="clear"></div>
					</div>
					<?php
					if($dattr == $ptr->id_prod_att){
						foreach($primattr_sel as $ps)
						{
					?>
					<div class='minitab-sub'>
						<div class='float col-40'> &nbsp </div>
						<div class='float col-120'><?php echo anchor('catalog/attribute/'.$ptr->id_prod_att.'/'.$ps->idp_val_attr,$ps->name);  ?></div>
						<div class='float col-40'> &nbsp </div>
						<div class='float col-220'> &nbsp </div>
						<div class="clear"></div>
					</div>
					<?php					
						}
					}
					?>
					<?php
						$position++;
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
