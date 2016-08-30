<?

// if ($s_banco==1&&$s_cheque==1&&$s_impresora==1){
//   // $lx = isset($_REQUEST['lx']) ? $_REQUEST['lx'] : '';
//   // $ly = isset($_REQUEST['ly']) ? $_REQUEST['ly'] : '';
//   // $nx = isset($_REQUEST['nx']) ? $_REQUEST['nx'] : '';
//   // $ny = isset($_REQUEST['ny']) ? $_REQUEST['ny'] : '';
//   // $mx = isset($_REQUEST['mx']) ? $_REQUEST['mx'] : '';
//   // $my = isset($_REQUEST['my']) ? $_REQUEST['my'] : '';
//   // $cx = isset($_REQUEST['cx']) ? $_REQUEST['cx'] : '';
//   // $cy = isset($_REQUEST['cy']) ? $_REQUEST['cy'] : '';
//   // $fx = isset($_REQUEST['fx']) ? $_REQUEST['fx'] : '';
//   // $fy = isset($_REQUEST['fy']) ? $_REQUEST['fy'] : '';
// }

if ($banco==1&&$cheque==1&&$impresora==1){
  $config=1;

  //-----------------------------------------------------------------//

  switch ($config){
    case 1:
    $lx=0;$ly=0;
    $nx=0;$ny=0;
    $mx=0;$my=0;
    $cx=0;$cy=0;
    $fx=0;$fy=0;
    break;

    default:
    $lx=148;$ly=88;
    $nx=125;$ny=96;
    $mx=125;$my=104;
    $cx=250;$cy=97;
    $fx=229;$fy=84;
  }

}
