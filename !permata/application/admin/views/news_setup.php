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
				<a href="<?php echo site_url(); ?>pages/<?php echo $p->alias; ?>">
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
						<div class='display-body'>
						<?php
							echo form_open($subpage.'/news_save'); 
						?>
							<div class='float'><div class='label col-80'>Title</div></div><div class='float'><input type='text' name='title'> </div>
							<div class="clear"></div>
							<div class='float'><div class='label col-80'>Permalink</div></div><div class='float'><input type='text' name='perma'></div>
							<div class="clear"></div>
							<div class='float'><div class='label col-80'>Pages</div></div><div class='float'>
							<select name="pages">
								<option value=""></option>
							<?php
								foreach($page_list as $pages)
								{
									echo '<option value="'.$pages->id_parent.'">'.$pages->title.'</option>';
								}
							?>
							</select><span>Leave null if this news is on main pages</span>
							</div>
							<div class="clear"></div>
							<div class='float'><div class='label col-80'>Attribute</div></div>
							<div class='float' style="margin-top:15px;">
								 <input type="checkbox" name="publish" value='1'> Publish &nbsp 		 
							</div>

							<div class="clear"></div>
							<div class='float'><div class='label col-80'>Description</div></div><div class='float'><textarea class="myTextEditor" name="content"></textarea></div>
							<div class="clear"></div>
							<div class='float'><input type='submit' name='submit' value='Save'></div>
						<?php echo form_close() ?>
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
