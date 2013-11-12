<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

	<div id="menuback"></div>

	<div id="menuwrap">
		<div id="menushadow"></div>

		<ul id="sidemenu">
		<?php
				foreach ($mainmenu as $menu) {
				
		?>
			<a href="<?php echo site_url(),$menu->alias; ?> ">
				<li class="<?php echo page_line($menu->alias, $page); ?> <?php echo page_active($menu->alias, $page); ?>">
					<div class="icon <?php echo $menu->icon ?>"></div>
					<div class="title"><?php echo $menu->name ?></div>
				</li>
			</a>

		<?php
		} 
		?>
		</ul>
	</div>
