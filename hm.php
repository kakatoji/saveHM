<?php
/*
*kalkulator untuk save data KERJA
*jika perkerjaan di bidang pertambangan
*seperti Driver,oprator
*inbox saya jika bingung
*fb = kakatoji77
*Telegram @kakatoji
*/
error_reporting(0);
function save($file,$data_post){
  if(!file_get_contents($file)){
    file_put_contents($file,"[]");}
  $files=json_decode(file_get_contents($file),1);
  $arr=array_merge($files,$data_post);
  file_put_contents($file,json_encode($arr,JSON_PRETTY_PRINT));}
//warna
$bl="\e[1;30m";$r="\e[1;31m";$g="\e[1;32m";$k="\e[1;33m";$bu="\e[1;34m";$p="\e[1;35m";$c="\e[1;36m";
$w="\e[1;37m";$dl="\e[0m";$rb="\e[0;101m";
$cr=shell_exec("clear");
echo $cr;
echo "{$r}]]>{$w}DATA HM KERJA DRIVER{$r}<[[{$dl}\n";
echo "{$w}[{$r}1{$w}] {$p}Input data baru:\n";
echo "{$w}[{$r}2{$w}] {$p}Cek data lengkap:\n";
echo "{$w}[{$r}3{$w}] {$p}Input keterangan:\n";
echo "{$w}[{$r}4{$w}] {$p}Cek keterangan:\n";
$menu =readline("{$g}[>]menu{$c}: ");
switch($menu) {
  case 1:
    echo $cr;
    echo "{$w}===================[{$rb}INPUT DATA{$dl}{$w}]================\n";
    echo "{$r}=>{$p}input manual{$r}<=\n";
    echo "{$g}isi hari kerja skrg\n";
    $hari=readline("{$k}[+]Hari: ");
    echo "{$g}Format tgl ex 12/12/2020\n";
    $tgl=readline("{$k}[>]TGL: ");
    $shift=readline("{$k}[>]Shift: ");
    $unit=readline("{$k}[>]Unit: ");
    $sopir=readline("{$k}[>]Sopir: ");
    $star=readline("{$k}[>]StarHm: ");
    $stop=readline("{$k}[>]StopHm: ");
    $total=$stop - $star;
    echo "{$g}Jika ada keterangan isi\n";
    $ket=readline("{$k}[>]Keterangan: ");
    $data=[
      $hari=>[
        "hari"       =>$hari,
        "tgl"        =>$tgl,
        "shift"      =>$shift,
        "unit"       =>$unit,
        "sopir"      =>$sopir,
        "start"      =>$star,
        "stop"       =>$stop,
        "totalHm"    =>round($total,1),
        "keterangan" =>$ket]];
    save("data.json",$data);
    echo "{$g}total dari kerja hari ini{$dl}\n";
    echo "[>] ".$star." - ".$stop." = ".round($total,1);
    break;
  case 2:
  echo $cr;
  $data=json_decode(file_get_contents("data.json"),1);
   echo "{$w}======================[{$rb}DATA USER{$dl}]===================={$dl}\n";
   $i=1;
  foreach($data as $head=>$body){
    echo "{$k}Hari       :{$c}".$head."\n";
    echo "{$k}TGL        :{$bu}".$body["tgl"]."\n";
    echo "{$k}SHIFT      :{$r}".$body["shift"]."\n";
    echo "{$k}UNIT       :{$g}".$body["unit"]."\n";
    echo "{$k}SOPIR      :{$c}".$body["sopir"]."\n";
    echo "{$k}START      :{$p}".$body["start"]."\n";
    echo "{$k}STOP       :{$c}".$body["stop"]."\n";
    echo "{$k}Total HM   :{$w}".$body["totalHm"]."\n";
    echo "{$k}KETERANGAN :{$g}".$body["keterangan"]."\n";
    echo "{$w}=====================================================\n";
    $jmlh +=$body["totalHm"];
    echo "{$w}[{$c}".$i++."{$w}]{$g}TOTAL HM KERJA {$r}=> {$rb}".$jmlh."{$dl} {$p}JAM/HM\n";
    echo "{$w}====================================================\n";
  }
    break;
  case 3:
    echo $cr;
    echo "{$w}==================[{$rb}KETERANGAN{$dl}{$w}]=================={$dl}\n";
    $hari=readline("[>]Hari: ");
    $tgl=readline("[>]Tgl : ");
    $ket=readline("[>] keterangan: ");
    $data=[
      $hari=>[
        "hari"       =>$hari,
        "tgl"        =>$tgl,
        "keterangan" =>$ket]];
        save("ket.json",$data);
    echo "Hari ".$hari."\n";
    echo "Tgl  ".$tgl."\n";
    echo "keterangan ".$ket."\n";
    break;
  case 4:
    echo $cr;
    $data=json_decode(file_get_contents("ket.json"),1);
    echo "{$w}===================[{$rb}KETERANGAN{$dl}{$w}]==============\n";
    foreach($data as $head=>$body){
      echo "{$g}HARI :{$c}".$head."\n";
      echo "{$g}TGL :{$c}".$body["tgl"]."\n";
      echo "{$g}KET :{$p}".$body["keterangan"]."\n";
      echo "{$w}============================================{$dl}\n";
    }
    break;
}
