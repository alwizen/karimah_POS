<?php
    function tgl_indo($tgl){
		$arr_tgl = explode("-", $tgl);
		return $arr_tgl[2].' '.getBulan($arr_tgl[1]).' '.$arr_tgl[0];        
    }
	
    function getBulan($bln){
      switch ($bln){
        case 1:
          return "Januari";
          break;
        case 2:
          return "Februari";
          break;
        case 3:
          return "Maret";
          break;
        case 4:
          return "April";
          break;
        case 5:
          return "Mei";
          break;
        case 6:
          return "Juni";
          break;
        case 7:
          return "Juli";
          break;
        case 8:
          return "Agustus";
          break;
        case 9:
          return "September";
          break;
        case 10:
          return "Oktober";
          break;
        case 11:
          return "November";
          break;
        case 12:
          return "Desember";
          break;
    }
}
?>