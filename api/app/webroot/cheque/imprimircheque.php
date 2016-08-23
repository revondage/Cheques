<?php
require('fpdf/pdf_js.php');

class PDF_AutoPrint extends PDF_JavaScript{
  function Header(){
    global $title;
  }

  function ChapterTitle($num, $label){
    $this->SetFont('Arial','',12);
    $this->SetFillColor(255,255,255);
    $this->SetY(42);
  }

  function ChapterBody(){
    global $nombre;
    global $fecha;
    global $leyenda;
    global $cantidad;
    global $monto;

    $lx = isset($_REQUEST['lx']) ? $_REQUEST['lx'] : '';
    $ly = isset($_REQUEST['ly']) ? $_REQUEST['ly'] : '';
    $nx = isset($_REQUEST['nx']) ? $_REQUEST['nx'] : '';
    $ny = isset($_REQUEST['ny']) ? $_REQUEST['ny'] : '';
    $mx = isset($_REQUEST['mx']) ? $_REQUEST['mx'] : '';
    $my = isset($_REQUEST['my']) ? $_REQUEST['my'] : '';
    $cx = isset($_REQUEST['cx']) ? $_REQUEST['cx'] : '';
    $cy = isset($_REQUEST['cy']) ? $_REQUEST['cy'] : '';
    $fx = isset($_REQUEST['fx']) ? $_REQUEST['fx'] : '';
    $fy = isset($_REQUEST['fy']) ? $_REQUEST['fy'] : '';

    // $lx = 148;
    // $ly = 88;
    // $nx = 125;
    // $ny = 96;
    // $mx = 125;
    // $my = 104;
    // $cx = 250;
    // $cy = 97;
    // $fx = 229;
    // $fy = 84;
    // $posconfig = $poscx.",".$poscy;

    $this->SetFont('Arial','B',8);
    // $this->SetXY(148,88);
    $this->SetXY($lx,$ly);
    $this->Multicell(0,5,$leyenda,0,1,'C',true);
    $this->SetFont('Arial','',8);
    $this->SetXY($nx,$ny);
    $this->Multicell(0,5,$nombre,0,1,'C',true);
    $this->SetXY($mx,$my);
    $this->Multicell(0,5,$monto,0,1,'C',true);
    $this->SetXY($cx,$cy);
    $this->Multicell(0,5,$cantidad,0,1,'C',true);
    $this->SetXY($fx,$fy);
    $this->Multicell(0,5,$fecha,0,1,'C',true);
  }

  function PrintChapter($num, $title){
    $this->AddPage();
    $this->ChapterTitle($num,$title);
    $this->ChapterBody();
  }


  function AutoPrint($dialog=false){
    //Open the print dialog or start printing immediately on the standard printer
    $param=($dialog ? 'true' : 'false');
    $script="print($param);";
    $this->IncludeJS($script);
  }

  function AutoPrintToPrinter($server, $printer, $dialog=false){
    //Print on a shared printer (requires at least Acrobat 6)
    $script = "var pp = getPrintParams();";
    if($dialog)
    $script .= "pp.interactive = pp.constants.interactionLevel.full;";
    else
    $script .= "pp.interactive = pp.constants.interactionLevel.automatic;";
    $script .= "pp.printerName = '\\\\\\\\".$server."\\\\".$printer."';";
    $script .= "print(pp);";
    $this->IncludeJS($script);
  }
}

//------------------------------------------------------------------------------

function numtoletras($xcifra){
  $xarray = array(0 => "CERO",
  1 => "UN", "DOS", "TRES", "CUATRO", "CINCO", "SEIS", "SIETE", "OCHO", "NUEVE",
  "DIEZ", "ONCE", "DOCE", "TRECE", "CATORCE", "QUINCE", "DIECISEIS", "DIECISIETE", "DIECIOCHO", "DIECINUEVE",
  "VEINTI",
  30 => "TREINTA",
  40 => "CUARENTA",
  50 => "CINCUENTA",
  60 => "SESENTA",
  70 => "SETENTA",
  80 => "OCHENTA",
  90 => "NOVENTA",
  100 => "CIENTO",
  200 => "DOSCIENTOS",
  300 => "TRESCIENTOS",
  400 => "CUATROCIENTOS",
  500 => "QUINIENTOS",
  600 => "SEISCIENTOS",
  700 => "SETECIENTOS",
  800 => "OCHOCIENTOS",
  900 => "NOVECIENTOS"
);
//
$xcifra = trim($xcifra);
$xlength = strlen($xcifra);
$xpos_punto = strpos($xcifra, ".");
$xaux_int = $xcifra;
$xdecimales = "00";
if (!($xpos_punto === false)) {
  if ($xpos_punto == 0) {
    $xcifra = "0" . $xcifra;
    $xpos_punto = strpos($xcifra, ".");
  }
  $xaux_int = substr($xcifra, 0, $xpos_punto);
  $xdecimales = substr($xcifra . "00", $xpos_punto + 1, 2);
}

$XAUX = str_pad($xaux_int, 18, " ", STR_PAD_LEFT);
$xcadena = "";
for ($xz = 0; $xz < 3; $xz++) {
  $xaux = substr($XAUX, $xz * 6, 6);
  $xi = 0;
  $xlimite = 6;
  $xexit = true;
  while ($xexit) {
    if ($xi == $xlimite) {
      break;
    }

    $x3digitos = ($xlimite - $xi) * -1;
    $xaux = substr($xaux, $x3digitos, abs($x3digitos));
    for ($xy = 1; $xy < 4; $xy++) {
      switch ($xy) {
        case 1:
        if (substr($xaux, 0, 3) < 100) {

        } else {
          $key = (int) substr($xaux, 0, 3);
          if (TRUE === array_key_exists($key, $xarray)){
            $xseek = $xarray[$key];
            $xsub = subfijo($xaux);
            if (substr($xaux, 0, 3) == 100)
            $xcadena = " " . $xcadena . " CIEN " . $xsub;
            else
            $xcadena = " " . $xcadena . " " . $xseek . " " . $xsub;
            $xy = 3;
          }
          else {
            $key = (int) substr($xaux, 0, 1) * 100;
            $xseek = $xarray[$key];
            $xcadena = " " . $xcadena . " " . $xseek;
          }
        }
        break;
        case 2:
        if (substr($xaux, 1, 2) < 10) {

        }else{
          $key = (int) substr($xaux, 1, 2);
          if (TRUE === array_key_exists($key, $xarray)) {
            $xseek = $xarray[$key];
            $xsub = subfijo($xaux);
            if (substr($xaux, 1, 2) == 20)
            $xcadena = " " . $xcadena . " VEINTE " . $xsub;
            else
            $xcadena = " " . $xcadena . " " . $xseek . " " . $xsub;
            $xy = 3;
          }else{
            $key = (int) substr($xaux, 1, 1) * 10;
            $xseek = $xarray[$key];
            if (20 == substr($xaux, 1, 1) * 10)
            $xcadena = " " . $xcadena . " " . $xseek;
            else
            $xcadena = " " . $xcadena . " " . $xseek . " Y ";
          }
        }
        break;
        case 3:
        if (substr($xaux, 2, 1) < 1) {

        }else{
          $key = (int) substr($xaux, 2, 1);
          $xseek = $xarray[$key];
          $xsub = subfijo($xaux);
          $xcadena = " " . $xcadena . " " . $xseek . " " . $xsub;
        }
        break;
      }
    }
    $xi = $xi + 3;
  }

  if (substr(trim($xcadena), -5, 5) == "ILLON")
  $xcadena.= " DE";

  if (substr(trim($xcadena), -7, 7) == "ILLONES")
  $xcadena.= " DE";

  if (trim($xaux) != ""){
    switch ($xz) {
      case 0:
      if (trim(substr($XAUX, $xz * 6, 6)) == "1")
      $xcadena.= "UN BILLON ";
      else
      $xcadena.= " BILLONES ";
      break;
      case 1:
      if (trim(substr($XAUX, $xz * 6, 6)) == "1")
      $xcadena.= "UN MILLON ";
      else
      $xcadena.= " MILLONES ";
      break;
      case 2:
      if ($xcifra < 1) {
        $xcadena = "CERO PESOS $xdecimales/100 M.N.";
      }
      if ($xcifra >= 1 && $xcifra < 2) {
        $xcadena = "UN PESO $xdecimales/100 M.N. ";
      }
      if ($xcifra >= 2) {
        $xcadena.= " PESOS $xdecimales/100 M.N. ";
      }
      break;
    }
  }

  $xcadena = str_replace("VEINTI ", "VEINTI", $xcadena);
  $xcadena = str_replace("  ", " ", $xcadena);
  $xcadena = str_replace("UN UN", "UN", $xcadena);
  $xcadena = str_replace("  ", " ", $xcadena);
  $xcadena = str_replace("BILLON DE MILLONES", "BILLON DE", $xcadena);
  $xcadena = str_replace("BILLONES DE MILLONES", "BILLONES DE", $xcadena);
  $xcadena = str_replace("DE UN", "UN", $xcadena);
}
return trim($xcadena);
}

function subfijo($xx){
  $xx = trim($xx);
  $xstrlen = strlen($xx);
  if ($xstrlen == 1 || $xstrlen == 2 || $xstrlen == 3)
  $xsub = "";
  if ($xstrlen == 4 || $xstrlen == 5 || $xstrlen == 6)
  $xsub = "MIL";
  return $xsub;
}

//------------------------------------------------------------------------------


$pdf=new PDF_AutoPrint('L','mm','Letter');
$title = 'Ejemplo de Formateo';
$nombre = utf8_decode(isset($_REQUEST['nombre']) ? $_REQUEST['nombre'] : '');
$cantidad = utf8_decode(isset($_REQUEST['cantidad']) ? $_REQUEST['cantidad'] : '');
$cantidad = number_format($cantidad, 2);
$monto = utf8_decode(isset($_REQUEST['cantidad']) ? numtoletras($_REQUEST['cantidad']) : '');
$fecha = utf8_decode(isset($_REQUEST['fecha']) ? $_REQUEST['fecha'] : '');
setlocale(LC_TIME, 'es_MX.UTF-8');
$fecha=strtoupper(strftime("%d de %B de %Y",strtotime($fecha)));
$leyenda = utf8_decode(isset($_REQUEST['leyenda']) ? $_REQUEST['leyenda'] : '');


$pdf->SetTitle($title);
$pdf->PrintChapter(0,'');
$pdf->AutoPrint(true);
$pdf->Output();
?>
