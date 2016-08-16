<?php
// require('fpdf/fpdf.php');
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

  // function ChapterBody($file){
  function ChapterBody(){
    global $nombre;
    global $fecha;
    global $leyenda;
    global $cantidad;
    global $monto;
    $this->SetFont('Arial','',8);
    $this->SetXY(229,84);
    $this->Multicell(0,5,$fecha,0,1,'C',true);
    $this->SetXY(125,96);
    $this->Multicell(0,5,$nombre,0,1,'C',true);
    $this->SetXY(250,97);
    $this->Multicell(0,5,$cantidad,0,1,'C',true);
    $this->SetXY(125,104);
    $this->Multicell(0,5,$monto,0,1,'C',true);
    $this->SetFont('Arial','B ',8);
    $this->SetXY(148,88);
    $this->Multicell(0,5,$leyenda,0,1,'C',true);
  }

  // function PrintChapter($num, $title, $file){
    function PrintChapter($num, $title){
    $this->AddPage();
    $this->ChapterTitle($num,$title);
    // $this->ChapterBody($file);
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






function numtoletras($xcifra)
{
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
  $xaux_int = substr($xcifra, 0, $xpos_punto); // obtengo el entero de la cifra a covertir
  $xdecimales = substr($xcifra . "00", $xpos_punto + 1, 2); // obtengo los valores decimales
}

$XAUX = str_pad($xaux_int, 18, " ", STR_PAD_LEFT); // ajusto la longitud de la cifra, para que sea divisible por centenas de miles (grupos de 6)
$xcadena = "";
for ($xz = 0; $xz < 3; $xz++) {
  $xaux = substr($XAUX, $xz * 6, 6);
  $xi = 0;
  $xlimite = 6; // inicializo el contador de centenas xi y establezco el límite a 6 dígitos en la parte entera
  $xexit = true; // bandera para controlar el ciclo del While
  while ($xexit) {
    if ($xi == $xlimite) { // si ya llegó al límite máximo de enteros
      break; // termina el ciclo
    }

    $x3digitos = ($xlimite - $xi) * -1; // comienzo con los tres primeros digitos de la cifra, comenzando por la izquierda
    $xaux = substr($xaux, $x3digitos, abs($x3digitos)); // obtengo la centena (los tres dígitos)
    for ($xy = 1; $xy < 4; $xy++) { // ciclo para revisar centenas, decenas y unidades, en ese orden
      switch ($xy) {
        case 1: // checa las centenas
        if (substr($xaux, 0, 3) < 100) { // si el grupo de tres dígitos es menor a una centena ( < 99) no hace nada y pasa a revisar las decenas

        } else {
          $key = (int) substr($xaux, 0, 3);
          if (TRUE === array_key_exists($key, $xarray)){  // busco si la centena es número redondo (100, 200, 300, 400, etc..)
            $xseek = $xarray[$key];
            $xsub = subfijo($xaux); // devuelve el subfijo correspondiente (Millón, Millones, Mil o nada)
            if (substr($xaux, 0, 3) == 100)
            $xcadena = " " . $xcadena . " CIEN " . $xsub;
            else
            $xcadena = " " . $xcadena . " " . $xseek . " " . $xsub;
            $xy = 3; // la centena fue redonda, entonces termino el ciclo del for y ya no reviso decenas ni unidades
          }
          else { // entra aquí si la centena no fue numero redondo (101, 253, 120, 980, etc.)
            $key = (int) substr($xaux, 0, 1) * 100;
            $xseek = $xarray[$key]; // toma el primer caracter de la centena y lo multiplica por cien y lo busca en el arreglo (para que busque 100,200,300, etc)
            $xcadena = " " . $xcadena . " " . $xseek;
          } // ENDIF ($xseek)
        } // ENDIF (substr($xaux, 0, 3) < 100)
        break;
        case 2: // checa las decenas (con la misma lógica que las centenas)
        if (substr($xaux, 1, 2) < 10) {

        } else {
          $key = (int) substr($xaux, 1, 2);
          if (TRUE === array_key_exists($key, $xarray)) {
            $xseek = $xarray[$key];
            $xsub = subfijo($xaux);
            if (substr($xaux, 1, 2) == 20)
            $xcadena = " " . $xcadena . " VEINTE " . $xsub;
            else
            $xcadena = " " . $xcadena . " " . $xseek . " " . $xsub;
            $xy = 3;
          }
          else {
            $key = (int) substr($xaux, 1, 1) * 10;
            $xseek = $xarray[$key];
            if (20 == substr($xaux, 1, 1) * 10)
            $xcadena = " " . $xcadena . " " . $xseek;
            else
            $xcadena = " " . $xcadena . " " . $xseek . " Y ";
          } // ENDIF ($xseek)
        } // ENDIF (substr($xaux, 1, 2) < 10)
        break;
        case 3: // checa las unidades
        if (substr($xaux, 2, 1) < 1) { // si la unidad es cero, ya no hace nada

        } else {
          $key = (int) substr($xaux, 2, 1);
          $xseek = $xarray[$key]; // obtengo directamente el valor de la unidad (del uno al nueve)
          $xsub = subfijo($xaux);
          $xcadena = " " . $xcadena . " " . $xseek . " " . $xsub;
        } // ENDIF (substr($xaux, 2, 1) < 1)
        break;
      } // END SWITCH
    } // END FOR
    $xi = $xi + 3;
  } // ENDDO

  if (substr(trim($xcadena), -5, 5) == "ILLON") // si la cadena obtenida termina en MILLON o BILLON, entonces le agrega al final la conjuncion DE
  $xcadena.= " DE";

  if (substr(trim($xcadena), -7, 7) == "ILLONES") // si la cadena obtenida en MILLONES o BILLONES, entoncea le agrega al final la conjuncion DE
  $xcadena.= " DE";

  // ----------- esta línea la puedes cambiar de acuerdo a tus necesidades o a tu país -------
  if (trim($xaux) != "") {
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
        $xcadena.= " PESOS $xdecimales/100 M.N. "; //
      }
      break;
    } // endswitch ($xz)
  } // ENDIF (trim($xaux) != "")
  // ------------------      en este caso, para México se usa esta leyenda     ----------------
  $xcadena = str_replace("VEINTI ", "VEINTI", $xcadena); // quito el espacio para el VEINTI, para que quede: VEINTICUATRO, VEINTIUN, VEINTIDOS, etc
  $xcadena = str_replace("  ", " ", $xcadena); // quito espacios dobles
  $xcadena = str_replace("UN UN", "UN", $xcadena); // quito la duplicidad
  $xcadena = str_replace("  ", " ", $xcadena); // quito espacios dobles
  $xcadena = str_replace("BILLON DE MILLONES", "BILLON DE", $xcadena); // corrijo la leyenda
  $xcadena = str_replace("BILLONES DE MILLONES", "BILLONES DE", $xcadena); // corrijo la leyenda
  $xcadena = str_replace("DE UN", "UN", $xcadena); // corrijo la leyenda
} // ENDFOR ($xz)
return trim($xcadena);
}

// END FUNCTION

function subfijo($xx)
{ // esta función regresa un subfijo para la cifra
  $xx = trim($xx);
  $xstrlen = strlen($xx);
  if ($xstrlen == 1 || $xstrlen == 2 || $xstrlen == 3)
  $xsub = "";
  //
  if ($xstrlen == 4 || $xstrlen == 5 || $xstrlen == 6)
  $xsub = "MIL";
  //
  return $xsub;
}



//------------------------------------------------------------------------------



$pdf=new PDF_AutoPrint('L','mm','Letter'); // $pdf = new PDF('P','mm','Letter'); OR // $pdf=new PDF_AutoPrint('P','mm','Letter');
$title = 'Ejemplo de Formateo';
$nombre = utf8_decode(isset($_REQUEST['nombre']) ? $_REQUEST['nombre'] : '');
$cantidad = utf8_decode(isset($_REQUEST['cantidad']) ? $_REQUEST['cantidad'] : '');
$cantidad = number_format($cantidad, 2);
$monto = utf8_decode(isset($_REQUEST['cantidad']) ? numtoletras($_REQUEST['cantidad']) : '');
$fecha = utf8_decode(isset($_REQUEST['fecha']) ? $_REQUEST['fecha'] : '');
$leyenda = utf8_decode(isset($_REQUEST['leyenda']) ? $_REQUEST['leyenda'] : '');

$pdf->SetTitle($title);
$pdf->PrintChapter(0,'');// $pdf->PrintChapter(0,'','pruebas/cheque.txt');
$pdf->AutoPrint(true);
$pdf->Output();// $pdf->Output('LaWeaFome.pdf','I','true');
?>
