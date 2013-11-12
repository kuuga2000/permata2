<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $this->load->view('00header.php'); ?>

<div id="wrap">

<?php $this->load->view('00sidemenu.php'); ?>

	<div id="content">
		<div id="content-wrap">
			<div id="content-body">
				<div class="wrap">
					<h1>Welcome Admin</h1>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore</p>
					<br />
					<img src="<?php echo site_url(); ?>assets/images/analytic.jpg" />
				</div>
				<div class="clear"></div>

			</div>
			<div class="clear"></div>

		</div>
		<div class="clear"></div>

	</div>

</div>

<?php $this->load->view('00footer.php'); ?>
