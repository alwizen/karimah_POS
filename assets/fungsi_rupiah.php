<?php
function Rp($angka){
    $tara = "Rp " . number_format($angka,2,',','.');
return $tara;
}
function setBulat($angka) {
    $bulat = 0;
    $arr_angka = explode(".", $angka);
    if ($angka < 1) {
        $bulat = 1;
    } else if ($arr_angka[1] > 5) {
        $bulat = $arr_angka[0] + 1;
    } else {
        $bulat = $arr_angka[0];
    }
    return $bulat;
}
?>