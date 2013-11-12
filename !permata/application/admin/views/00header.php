<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php include "system/global.php"; ?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $title ?> .: <?php echo $base_name ?></title>
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo $site_url; ?>/assets/img/favicon.png" />
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<meta name="robots" content="noindex, nofollow">
	
	<link rel="stylesheet" type="text/css" href="<?php echo site_url(); ?>assets/css/my.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo site_url(); ?>assets/css/ie/PIE.htc" />
	<script src="<?php echo site_url()?>assets/js/jquery-1.8.3.min.js"></script>
	<script src="<?php echo site_url()?>assets/js/bootstrap.min.js"></script>
	<script src="<?php echo site_url()?>assets/js/bootstrap-alert.js"></script>
	<script type="text/javascript" src="<?php echo site_url(); ?>assets/js/library.js"></script>
	<script type="text/javascript" src="<?php echo site_url(); ?>assets/js/jquery.bootstrap-growl.js"></script>
	<script type="text/javascript" src="<?php echo site_url(); ?>assets/js/cms.js"></script>
	<script type="text/javascript" src="<?php echo site_url(); ?>assets/js/jquery.autopopulatebox.js"></script>
	<link href="<?php echo site_url()?>assets/css/jquery-ui-1.9.2.custom.min.css" rel="stylesheet">
	<link href="<?php echo site_url()?>assets/css/bootstrap.css" rel="stylesheet">

	<script src="<?php echo site_url()?>assets/js/jquery-ui-1.9.2.custom.min.js"></script>
	<!--<script src="<?php echo site_url()?>assets/js/jquery.maskedinput.js" type="text/javascript"></script>-->
	<script src="<?php echo site_url()?>assets/tiny_mce/tiny_mce.js" type="text/javascript" ></script>
	<style>
	.display-body a  img{	behavior: url(<?php echo site_url(); ?>assets/css/ie/PIE.htc);}

	::-webkit-scrollbar {
		width: 12px;
	}
	/* Track */
	::-webkit-scrollbar-track {
		background:#ccc;
	}
	/* Handle */
	::-webkit-scrollbar-thumb {
		-webkit-border-radius: 10px;
		border-radius: 10px;
		border:solid 1px #555;
		background: rgba(150,150,150,0.8); 
	}
	</style>
	<script>
	
	 
	
	$(function() {
		$( ".datepicker" ).datepicker
		({
			dateFormat: 'dd/mm/yy',
			showButtonPanel: true
		});
	});

	tinyMCE.init({
			/* mode : "exact",
			elements : "konten", */
			theme : "advanced",
			mode : "specific_textareas",
			editor_selector : "myTextEditor",
			height:300,
			plugins : "advimage,advlink,media,contextmenu,table",
			theme_advanced_buttons1_add_before : "newdocument,separator",
			theme_advanced_buttons1_add : "fontselect,fontsizeselect",
			theme_advanced_buttons2_add : "separator,forecolor,backcolor,liststyle",
			theme_advanced_buttons2_add_before: "cut,copy,separator",
			theme_advanced_buttons3_add_before : "",
			theme_advanced_buttons3_add : "media,tablecontrols",
			theme_advanced_toolbar_location : "top",
			theme_advanced_toolbar_align : "left",
			extended_valid_elements : "hr[class|width|size|noshade]",
			file_browser_callback : "ajaxfilemanager",
			paste_use_dialog : false,
			apply_source_formatting : true,
			force_br_newlines : true,
			force_p_newlines : false,	
			relative_urls : true,
			width: '100%'
		});

		function ajaxfilemanager(field_name, url, type, win) {
			var ajaxfilemanagerurl = "<?php echo base_url();?>assets/tiny_mce/plugins/ajaxfilemanager/ajaxfilemanager.php";

			var view = 'detail';
			switch (type) {
				case "image":
				view = 'thumbnail';
					break;
				case "media":
					break;
				case "flash": 
					break;
				case "file":
					break;
				default:
					return false;
			}
            tinyMCE.activeEditor.windowManager.open({
                url: "<?php echo base_url();?>assets/tiny_mce/plugins/ajaxfilemanager/ajaxfilemanager.php?view=" + view,
                width: 782,
                height: 440,
                inline : "yes",
                close_previous : "no"
            },{
                window : win,
                input : field_name
            });
		}
	</script>

</head>
<body>

<div id="top">
	<div id="top-content">
		<ul id="top-menu-left">
			<li>
				<img src="<?php echo site_url(); ?>assets/images/logo.png" height="25" alt='Logo' />
			</li>
		</ul>

		<ul id="top-menu-right">
			<li><?php echo anchor_popup($site_url, 'Visit the Site'); ?></li>
			<li class="last"><?php echo anchor('home/logout', 'Sign Out'); ?></li>
		</ul>

	</div>
</div>
	<?php 
	if($this->session->flashdata('success')) 
	{
	?>
		<script><?php // error ,  alert , info ?>
		 setTimeout(function() {
			$.bootstrapGrowl("<?php echo $this->session->flashdata('success');  ?>", { 
			type: 'success',
			align: 'center'});
		}, 1000);
		</script>
	<?php
	}
	else if($this->session->flashdata('error'))
	{
	?>
		<script><?php // error ,  alert , info ?>
		 setTimeout(function() {
			$.bootstrapGrowl("<?php echo $this->session->flashdata('error');  ?>", { 
			type: 'error',
			align: 'center'});
		}, 1);
		</script>
	<?php
	}
	else if($this->session->flashdata('alert'))
	{
	?>
		<script><?php // error ,  alert , info ?>
		 setTimeout(function() {
			$.bootstrapGrowl("<?php echo $this->session->flashdata('alert');  ?>", { 
			type: 'alert',
			align: 'center'});
		}, 1000);
		</script>
	<?php
	}
	else if($this->session->flashdata('info'))
	{
	?>
		<script><?php // error ,  alert , info ?>
		 setTimeout(function() {
			$.bootstrapGrowl("<?php echo $this->session->flashdata('info');  ?>", { 
			type: 'info',
			align: 'center'});
		}, 1000);
		</script>
	<?php
	}
	else if($this->session->flashdata('stop'))
	{
	?>
		<script><?php // error ,  alert , info ?>
		 setTimeout(function() {
			$.bootstrapGrowl("<?php echo $this->session->flashdata('stop');  ?>", { 
			type: 'stop',
			delay: 8000,
			offset: {from: 'top', amount: 110}, // 'top', or 'bottom'
			align: 'center'});
		}, 1);
		</script>
	<?php
	}
	?>

