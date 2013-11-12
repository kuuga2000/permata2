<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $this->load->view('00header.php'); ?>
<?php
$fd_role = $this->session->flashdata('role');
$fd_username = $this->session->flashdata('username');
$fd_email = $this->session->flashdata('email');
$fd_firstname = $this->session->flashdata('firstname');
$fd_lastname = $this->session->flashdata('lastname');
$fd_gender = $this->session->flashdata('gender');
$fd_address = $this->session->flashdata('address');
$fd_phone = $this->session->flashdata('phone');
$fd_note = $this->session->flashdata('note');

$select_group = array();
foreach ($users_group as $ug)
{
	$select_group[$ug->alias] = $ug->name;
}
?>

<div id="wrap">

<?php $this->load->view('00sidemenu.php'); ?>

	<div id="content">
		<div id="content-wrap">
			<div id="content-body">
				<div class="wrap">
					<div id="breadcrumb"><?php	echo $breadc;	?></div>
					<div class="icon users"></div>
					<h1>Edit Profile</h1>

					<?php echo form_open('users/'.@$user->username.'/update', array('class' => 'detaildata')); ?>

						<div style="float:left; width:540px; margin-right:60px;">
							<h2>General Information</h2>
							<div class="float col-120"><?php echo form_label('Role', 'role'); ?></div>
							<div class="float col-40"> <?php echo form_label('*', 'required'); ?></div>
							<div class="float col-120"><?php echo form_dropdown('role', $select_group, @$user->user_group); ?></div>
							<div class="clear"></div>
							<div class="float col-120"><?php echo form_label('Username', 'username'); ?></div> 
							<div class="float col-40"><?php echo form_label('*', 'required'); ?></div>
							<div class="float col-120"><?php echo form_input(array('name' => 'username', 'value' => $fd_username ? $fd_username : @$user->username)); ?></div>
							<div class="clear"></div>
							<div class="float col-120"><?php echo form_label('Email', 'email'); ?></div> 
							<div class="float col-40"><?php echo form_label('*', 'required'); ?></div>
							<div class="float col-120"><?php echo form_input(array('name' => 'email', 'value' => $fd_email ? $fd_email : @$user->email)); ?></div>
							<div class="clear"></div>
							<div class="float col-120"><?php echo form_label('New Password', 'new_password'); ?></div>
							<div class="float col-40"> &nbsp </div>
							<div class="float col-120"><?php echo form_password(array('name' => 'password')); ?></div>
							<div class="clear"></div>
							<div class="float col-120"><?php echo form_label('Confirm Password', 'confirm_password'); ?></div>
							<div class="float col-40"> &nbsp </div>
							<div class="float col-120"><?php echo form_password(array('name' => 'confirm_password')); ?></div>
							<div class="clear"></div>
							<div class="float col-120"><?php IF(@$user->registered){ echo form_label('Registration Date', 'registered'); } ?></div>
							<div class="float col-220" style="font-weight:bold;"><?php IF(@$user->registered){ echo date('l, d F Y H:i:s', strtotime($user->registered)); } ?></div>
							<div class="clear"></div>
							<div class="float col-120"><?php IF(@$user->last_login){ echo form_label('Last Visit Date', 'last_login'); } ?></div>
							<div class="float col-220" style="font-weight:bold;"><?php if (@$user->last_login) echo date('l, d F Y H:i:s', strtotime(@$user->last_login));  ?></div>
							<div class="clear"></div>
							<div class="float col-220"><?php echo form_checkbox(array('name' => 'receive', 'value' => 1)); ?> Receive System Emails</div>
							<div class="clear"></div>
							<div class="float col-220"><?php echo form_checkbox(array('name' => 'block', 'value' => 1)); ?> Block this User</div>
						</div>

						<div style="float:left; width:540px;">
							<h2>Personal Information</h2>
							<div class="float col-120"><?php echo form_label('First Name', 'firstname'); ?></div>
							<div class="float col-40"><?php echo form_label('*', 'required'); ?></div>
							<div class="float col-120"><?php echo form_input(array('name' => 'firstname', 'value' => $fd_firstname ? $fd_firstname : @$user->firstname)); ?></div>
							<div class="clear"></div>
							<div class="float col-120"><?php echo form_label('Last Name', 'lastname'); ?></div>
							<div class="float col-40"><?php echo form_label('*', 'required'); ?></div>
							<div class="float col-120"><?php echo form_input(array('name' => 'lastname', 'value' => $fd_lastname ? $fd_lastname : @$user->lastname)); ?></div>
							<div class="clear"></div>
							<div class="float col-120"><?php echo form_label('Gender', 'gender'); ?></div>
							<div class="float col-40"> &nbsp </div>
							<div class="float col-120"><?php echo form_dropdown('gender', array('male' => 'Male', 'female' => 'Female'), $fd_gender ? $fd_gender : @$user->gender); ?></div>
							<div class="clear"></div>
							<div class="float col-120"><?php echo form_label('Address', 'address'); ?></div>
							<div class="float col-40"> &nbsp </div>
							<div class="float col-120"><?php echo form_textarea(array('style' => 'height:45px;','name' => 'address', 'value' => $fd_address ? $fd_address : @$user->address)); ?></div>
							<div class="clear"></div>
							<div class="float col-120"><?php echo form_label('Phone', 'phone'); ?></div>
							<div class="float col-40"> &nbsp </div>
							<div class="float col-120"><?php echo form_input(array('name' => 'phone', 'value' => $fd_phone ? $fd_phone : @$user->phone)); ?></div>
							<div class="clear"></div>
							<div class="float col-120"><?php echo form_label('Note', 'note'); ?></div>
							<div class="float col-40"> &nbsp </div>
							<div class="float col-120"><?php echo form_textarea(array('style' => 'height:45px;','name' => 'note', 'value' => $fd_note ? $fd_note : @$user->note)); ?></div>
						</div>

						<!--div style="width:300px; float:left; padding:20px; border:1px solid #cecece; border-radius:5px;">
							<h2>Privileges</h2>
							<p><?php echo form_checkbox(array('name' => 'add', 'value' => 1)); ?> Add</p>
							<p><?php echo form_checkbox(array('name' => 'edit', 'value' => 1)); ?> Edit</p>
							<p><?php echo form_checkbox(array('name' => 'delete', 'value' => 1)); ?> Delete</p><br />

							<h2>Access</h2>
							<p><?php echo form_checkbox(array('name' => 'add', 'value' => 1)); ?> Dashboard</p>
							<p><?php echo form_checkbox(array('name' => 'edit', 'value' => 1)); ?> Pages</p>
							<p style="margin-left:30px; font-style:italic;"><?php echo form_checkbox(array('name' => 'edit', 'value' => 1)); ?> About</p>
							<p style="margin-left:30px; font-style:italic;"><?php echo form_checkbox(array('name' => 'edit', 'value' => 1)); ?> Product</p>
							<p style="margin-left:30px; font-style:italic;"><?php echo form_checkbox(array('name' => 'edit', 'value' => 1)); ?> Services</p>
							<p><?php echo form_checkbox(array('name' => 'delete', 'value' => 1)); ?> Users</p>
							<p><?php echo form_checkbox(array('name' => 'delete', 'value' => 1)); ?> Settings</p>
						</div-->

						<div class="clear"></div>

						<br /><p><?php echo form_submit(array('value' => 'Update Profile')); ?></p>

					<?php echo form_close(); ?>

				</div>
				<div class="clear"></div>

			</div>
			<div class="clear"></div>

		</div>
		<div class="clear"></div>

	</div>

</div>

<script>
$(document).ready(function(){
	$('#role').change(function(){
		role = $(this).val();
		if (role == 'super admin')
			$('#priv').stop(true, true).hide(300);
		else
			$('#priv').stop(true, true).show(300);
	});
});
</script>

<?php $this->load->view('00footer.php'); ?>
