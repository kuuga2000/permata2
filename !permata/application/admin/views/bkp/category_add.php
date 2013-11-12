<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $this->load->view('00header.php'); ?>
<div id="wrap">
<?php $this->load->view('00sidemenu.php'); ?>
<?php 
	if(!$cat_base){$cat_base = '';}
	if(!$level){$level = '';}						
?>
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
					<h1><?php echo $title; ?></h1>
					<div class='display'>
						<?php
						if($cat_base == NULL)
						{
							echo form_open($subpage.'/add'); 
						?>
							<input type="hidden" name="level" value="1">
							<div class='float'><div class='label col-120'>Add Existing Parent <?php echo $cat_base; ?></div></div>
							<div class='float'>
							<select name="parent">
							<?php  
							foreach($select_list as $sl)
							{
							?>
								<option value="<?php echo $sl->id_category; ?>_<?php echo $sl->name; ?>"><?php echo $sl->name; ?></option>
							<?php
							}
							?>
								
							</select>
							</div>
							<div class="clear"></div>
							<div class='float'><div class='label col-120'>Add New Parent </div></div>
							<div class='float'><input type="text" name="parentnew"></div>
							<div class="clear"></div>
							<div class='float'><input type='submit' name='submit' value='Save'></div>
						<?php echo form_close();
						}
						?>
						
						<?php
						if($level)
						{
							echo form_open($subpage.'/add'); 
							$arraycat = explode('_',$cat_base);
							if($arraycat[0] == 'new')
							{
								$idcat = ''; 
								$name = $arraycat[1]; 
							}
							else
							{
								$idcat = $arraycat[0]; 
								$name = $arraycat[1]; 
							}
						?>
							
							<div class="float"><div class='label col-160'>Parent Category </div></div>
							<div class="float"><?php echo anchor($subpage.'/parent_delete',$name.' [ Edit ]'); ?> Lv.<?php echo $level ?></div>
							<div class="clear"></div>
							<?php
							$id = '';
							if($select_list == 'none')
							{
							}
							else
							{
							?>
							<div class='float'><div class='label col-160'>Add Existing Category</div></div>
							<div class='float'>
							<select name="parent">
							<?php  
							foreach($select_list as $sl)
							{
								$id = $sl->id_category;
							?>
								<option value="<?php echo $sl->id_category; ?>_<?php echo $sl->name; ?>"><?php echo $sl->name; ?></option>
							<?php
							}
							?>
							</select>
							</div>
							<div class="clear"></div>
							<?php
							}
							$level = $level+1;
							
							?>
							<?php if(!$idcat) { $idcat = $id; } ?>
							<input type="hidden" name="level" value="<?php echo $level ?>">
							<input type="hidden" name="idcat" value="<?php echo $idcat ?>">
							<div class='float'><div class='label col-160'>Add New Sub Category</div></div>
							<div class='float'><input type="text" name="parentnew"></div>
							<div class="clear"></div>
							<div class='float'><input type='submit' name='submit' value='Save'></div>
						<?php echo form_close();
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
