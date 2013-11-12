<?php
	
	if($subpages)
	{
		$margin = 'style="margin-left:457px;"';
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
							<div class="icon home"></div>
							<div class="title"><?php echo $p->name; ?></div>
							<div class="edit"></div>
							<div class="visibility"></div>
							<div class="list"></div>
							<div class="clear"></div>
						</div>
					</li>
				</a>

				<?php //}
				} ?>

			</ul>

		</div>
	</div>
	<?php
	}
	?>
