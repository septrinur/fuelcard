<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


function get_kuota($nopol, $nokartu){
	$CI =& get_instance();
    $CI->load->model('general_model');
	$sql = "select kuota_bbm from data_qr where no_pol ='".$nopol."' OR no_kartu='".$nokartu."'";
	$dataqr = $CI->general_model->get_query($sql);
	if (empty($dataqr)) {
		$data = "-";
	}else{
		$data = $dataqr[0]['kuota_bbm'];
	}
	return $data;
}

function tgl_service($tanggal){
	$dt = new DateTime($tanggal);

	return $dt->format('dmY'); 
}

function tanggal_indo($tanggal){
	$dt = new DateTime($tanggal);

	$date = $dt->format('d/m/Y'); 
	$time = $dt->format('H:i:s'); 

	$tgl = explode('/', $date);

	return $tgl[0].' '.bulan($tgl[1]).' '.$tgl[2].' '.$time;

}

function bulan($month){
	switch ($month) {
		case '01':
			return 'Januari';
			break;		
		case '02':
			return 'Februari';
			break;		
		case '03':
			return 'Maret';
			break;		
		case '04':
			return 'April';
			break;		
		case '05':
			return 'Mei';
			break;		
		case '06':
			return 'Juni';
			break;		
		case '07':
			return 'Juli';
			break;		
		case '08':
			return 'Agustus';
			break;		
		case '09':
			return 'September';
			break;		
		case '10':
			return 'Okteober';
			break;		
		case '11':
			return 'November';
			break;		
		case '12':
			return 'Desember';
			break;		
		
	}
}

function format_rupiah($jumlah){
	return "Rp. ".number_format($jumlah,2, ',', '.');

}

function correctDigit($digit,$number)
	{
		if(is_int($digit)){
			$correct = '';
			for($i=0;$i<$digit;$i++){
				$correct .= '0';
			}
			$digit = -1 * $digit;
			$number = $correct.$number;
			$number = substr($number,$digit);
		}
		return $number;
	}

function terbilang($x)
	{
		$x = intval($x);
		$x = abs($x);
		$abil = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
		if ($x < 12)
			return " ".$abil[$x];
		elseif ($x < 20)
			return $this->terbilang($x - 10)." belas";
		elseif ($x < 100)
			return $this->terbilang($x / 10)." puluh".$this->terbilang($x % 10);
		elseif ($x < 200)
			return " seratus".$this->terbilang($x - 100);
		elseif ($x < 1000)
			return $this->terbilang($x / 100)." ratus".$this->terbilang($x % 100);
		elseif ($x < 2000)
			return " seribu".$this->terbilang($x - 1000);
		elseif ($x < 1000000)
			return $this->terbilang($x / 1000)." ribu".$this->terbilang($x % 1000);
		elseif ($x < 1000000000)
			return $this->terbilang($x / 1000000)." juta".$this->terbilang($x % 1000000);
		elseif ($x < 1000000000000)
			return $this->terbilang($x / 1000000000)." milyar".$this->terbilang($x % 1000000000);
		else
			return $this->terbilang($x / 1000000000000)." triliun".$this->terbilang($x % 1000000000000);
	}

/*** End Utility Function ***/
	
	/*** Date and Time Function ***/
	function num2namemonth($num)
	{
		$num = correctDigit(2,$num);
		switch($num)
		{
			case '01': return 'Januari'; break;
			case '02': return 'Februari'; break;
			case '03': return 'Maret'; break;
			case '04': return 'April'; break;
			case '05': return 'Mei'; break;
			case '06': return 'Juni'; break;
			case '07': return 'Juli'; break;
			case '08': return 'Agustus'; break;
			case '09': return 'September'; break;
			case '10': return 'Oktober'; break;
			case '11': return 'November'; break;
			case '12': return 'Desember'; break;
			default : return ''; break;
		}
	}
	
	function arrMonth()
	{
		return array(1=>'Januari'
					,2=>'Februari'
					,3=>'Maret'
					,4=>'April'
					,5=>'Mei'
					,6=>'Juni'
					,7=>'Juli'
					,8=>'Agustus'
					,9=>'September'
					,10=>'Oktober'
					,11=>'November'
					,12=>'Desember'
					);
	}
	
	function arrMonth2Digit()
	{
		return array('01'=>'Januari'
					,'02'=>'Februari'
					,'03'=>'Maret'
					,'04'=>'April'
					,'05'=>'Mei'
					,'06'=>'Juni'
					,'07'=>'Juli'
					,'08'=>'Agustus'
					,'09'=>'September'
					,'10'=>'Oktober'
					,'11'=>'November'
					,'12'=>'Desember'
					);
	}
	
	function dayOfTheWeek($day=7)
	{
		switch($day)
		{
			case 0: return 'Minggu'; break;
			case 1: return 'Senin'; break;
			case 2: return 'Selasa'; break;
			case 3: return 'Rabu'; break;
			case 4: return 'Kamis'; break;
			case 5: return 'Jumat'; break;
			case 6: return 'Sabtu'; break;
			default : return ''; break;
		}
	}
	
	function dmy2ymd($date){
		if($date!=''){
			$arr_date = explode('/',$date);
			$dttime = $arr_date[2].'-'.$arr_date[1].'-'.$arr_date[0];
			$datetime = DateTime::createFromFormat('m/d/Y', $date);

			$date = $datetime->format('Y-m-d H:i:s'); 
			// print_r($date);exit();
		}
		return $date;
	}

	function dmytoymd($date){
		if($date!=''){
			$arr_date = explode('/',$date);
			$dttime = $arr_date[2].'-'.$arr_date[1].'-'.$arr_date[0];
			$datetime = DateTime::createFromFormat('d/m/Y', $date);

			$date = $datetime->format('Y-m-d H:i:s'); 
			// print_r($date);exit();
		}
		return $date;
	}

	function ymdhis2dmonthyhis($datetime)
	{
		if($datetime!=''){
			$arr_datetime = explode(' ',$datetime);
			$arr_date = explode('-',$arr_datetime[0]);
			$datetime = $arr_date[2].' '.num2namemonth($arr_date[1]).' '.$arr_date[0].' Pukul '.$arr_datetime[1];
		}
		return $datetime;
	}
	

	function ymd2dmy($date){
		if($date!=''){
			$year = substr($date, 0,4);
			$month = substr($date, 4,2);
			$day = substr($date, 6,2);
			$datetime = $day.' '.num2namemonth($month).' '.$year;
		}
		return $datetime;
	}

	function ymdhis2dmonthy($datetime)
	{
		if($datetime!=''){
			$arr_datetime = explode(' ',$datetime);
		//print_r($arr_datetime);exit();
			$arr_date = explode('-',$arr_datetime[0]);
			$datetime = $arr_date[2].' '.num2namemonth($arr_date[1]).' '.$arr_date[0];
		}
		return $datetime;
	}
	
	function ymdhis2dmy($datetime)
	{
		if($datetime!=''){
			$arr_datetime = explode(' ',$datetime);
			$arr_date = explode('-',$arr_datetime[0]);
			$datetime = $arr_date[2].'-'.$arr_date[1].'-'.$arr_date[0];
		}
		return $datetime;
	}
	
	function createCurrentTime()
	{
		$t = microtime(true);
		$micro = sprintf("%06d",($t-floor($t))*1000000);
		$d = new DateTime(date('Y-m-d H:i:s.'.$micro,$t));
		return $d->format("YmdHisu");
	}
	
	function isTime($time,$is24Hours=true,$seconds=false) {
		$pattern = "/^".($is24Hours ? "([1-2][0-3]|[01]?[1-9])" : "(1[0-2]|0?[1-9])").":([0-5]?[0-9])".($seconds ? ":([0-5]?[0-9])" : "")."$/";
		if (preg_match($pattern, $time)) {
			return true;
		}
		return false;
	}
	
	function arrHour()
	{
		$arr = array();
		for($i=0;$i<24;$i++){
			$str_i = substr('00'.$i,-2);
			$arr[$str_i] = $str_i;
		}
		return $arr;
	}
	
	function arrMinuteSecond()
	{
		$arr = array();
		for($i=0;$i<60;$i++){
			$str_i = substr('00'.$i,-2);
			$arr[$str_i] = $str_i;
		}
		return $arr;
	}
	
	function dateDiff($tgl_awal, $tgl_akhir)
	{
		return round((strtotime($tgl_akhir)-strtotime($tgl_awal))/86400);
	}
	
	function dateDiffInYear($tgl_awal, $tgl_akhir)
	{
		$diff = abs(strtotime($tgl_akhir) - strtotime($tgl_awal));
		$years = floor($diff / (365*60*60*24));
		return $years;
	}
	
	/*** End Date and Time Function ***/