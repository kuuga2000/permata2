<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pix_mail_tpl {

	private $CI;

	public function __construct()
	{
		$this->CI = &get_instance();
	}

	public function order($data)
	{
		if ( ! is_object($data))
			return false;

		$tpl = '
			Dear Customer,<br /><br />
			Your transaction has been succeed : <br />
			<table>
				<tr>
					<td width="100">Order ID</td>
					<td width="10">:</td>
					<td width="200">'.$data->invoice_number.'</td>
				</tr>
				<tr>
					<td>Total</td>
					<td>:</td>
					<td>'.$data->total.'</td>
				</tr>'.
				(
					$data->reward != '' ? '
						<tr>
							<td>Reward Code</td>
							<td>:</td>
							<td>'.$data->reward.'</td>
						</tr>':''
				)
			.'</table>
		';

		return $tpl;
	}

	public function contact($data)
	{
		if ( ! is_object($data))
			return false;

		$tpl = '
			Dear admin,<br /><br />
			Message from:<br />
			<table>
				<tr>
					<td width="100">Name</td>
					<td width="10">:</td>
					<td width="200">'.$data->name.'</td>
				</tr>
				<tr>
					<td>Email</td>
					<td>:</td>
					<td>'.$data->email.'</td>
				</tr>
				<tr>
					<td>Address</td>
					<td>:</td>
					<td>'.$data->address.'</td>
				</tr>
				<tr>
					<td>Mobile Phone</td>
					<td>:</td>
					<td>'.$data->mobilephone.'</td>
				</tr>
				<tr>
					<td>Subject</td>
					<td>:</td>
					<td>'.$data->subject.'</td>
				</tr>
				<tr>
					<td>Message</td>
					<td>:</td>
					<td>'.$data->message.'</td>
				</tr>
			</table>
		';

		return $tpl;
	}
}
