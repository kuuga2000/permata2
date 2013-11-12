<?php
class Currency{
	public function idr($number){
		return number_format($number,0,'','.');
	}
}
