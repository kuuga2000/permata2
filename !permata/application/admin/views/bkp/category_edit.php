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
						$lev3 = '';
						$idlev3 = '';					
						$lev4 = '';
						$idlev4 = '';
						$parlev4 = '';
						foreach ($records as $rcd)
						{
							$records = $records->level;
						}
						foreach ($select_cat_list as $scl)
						{
							$lev1 = $scl->lev1;
							$idlev1 = $scl->idlev1;
							$parlev1 = $scl->parlev1;
							if($records >= 2){ $lev2 = $scl->lev2; $idlev2 = $scl->idlev2; $parlev2 = $scl->parlev2; }
							if($records >= 3){ $lev3 = $scl->lev3; $idlev3 = $scl->idlev3; $parlev3 = $scl->parlev3; }
							if($records >= 4){ $lev4 = $scl->lev4; $idlev4 = $scl->idlev4; $parlev4 = $scl->parlev4; }
						}
						echo anchor('category/edit/'.$idlev1.'_'.$lev1.'_1_'.$parlev1,$lev1.' - Parent');
						echo '<br>';
						if($lev2) {echo anchor('category/edit/'.$idlev2.'_'.$lev2.'_2_'.$parlev2,$lev2); echo '<br>';}
						if($lev3) {echo anchor('category/edit/'.$idlev3.'_'.$lev3.'_3_'.$parlev3,$lev3); echo '<br>';}
						if($lev4) {echo anchor('category/edit/'.$idlev4.'_'.$lev4.'_4_'.$parlev4,$lev4); }
						?>
						
						<?php
						if($level)
						{
							echo form_open($subpage.'/save_edit'); 
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
							<div class="float"><div class='label col-160'>Category </div></div>
							<div class="float"><?php echo $name; ?> Lv.<?php echo $level ?></div>
							<div class="clear"></div>
							<input type="hidden" name="level" value="<?php echo $level ?>">
							<input type="hidden" name="idcat" value="<?php echo $idcat ?>">
							<div class='float'><div class='label col-160'>Change Category</div></div>
							<div class='float'><input type="text" name="newname"></div>
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
