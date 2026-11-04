<?php
// Pasarela de consultas: PHP es obligatorio. No expone URLs arbitrarias (evita SSRF).
header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: private, max-age=20');
function fail_request($status,$message){http_response_code($status);echo json_encode(['error'=>$message],JSON_UNESCAPED_UNICODE);exit;}
$kind=$_GET['type']??'callsign';
if($kind==='callsign'){
  $callsign=strtoupper(trim((string)($_GET['callsign']??'')));
  if(!preg_match('/^[A-Z0-9]{2,10}$/',$callsign))fail_request(400,'El indicativo del vuelo no es válido.');
  $path='/v2/callsign/'.rawurlencode($callsign);
}elseif($kind==='nearby'){
  $path='/v2/point/18.57/-68.36/45';
}else fail_request(400,'Tipo de consulta no permitido.');
$url='https://api.adsb.lol'.$path;
$body=false;$http=0;$err='';
if(function_exists('curl_init')){
  $ch=curl_init($url);
  curl_setopt_array($ch,[CURLOPT_RETURNTRANSFER=>true,CURLOPT_CONNECTTIMEOUT=>5,CURLOPT_TIMEOUT=>15,CURLOPT_FOLLOWLOCATION=>false,CURLOPT_SSL_VERIFYPEER=>true,CURLOPT_HTTPHEADER=>['Accept: application/json'],CURLOPT_USERAGENT=>'TransferOps/1.1']);
  $body=curl_exec($ch);$err=curl_error($ch);$http=(int)curl_getinfo($ch,CURLINFO_HTTP_CODE);curl_close($ch);
}elseif(ini_get('allow_url_fopen')){
  $ctx=stream_context_create(['http'=>['method'=>'GET','timeout'=>15,'ignore_errors'=>true,'header'=>"Accept: application/json\r\nUser-Agent: TransferOps/1.1\r\n"],'ssl'=>['verify_peer'=>true,'verify_peer_name'=>true]]);
  $body=@file_get_contents($url,false,$ctx);
  if(isset($http_response_header[0]) && preg_match('/\s(\d{3})\s/',$http_response_header[0],$m))$http=(int)$m[1];
  if($body===false)$err='No se pudo establecer la conexión HTTPS desde el servidor.';
}else fail_request(503,'PHP no tiene habilitado cURL ni allow_url_fopen.');
if($http===429)fail_request(503,'La fuente de vuelos aplicó un límite de consultas (HTTP 429). Intenta más tarde.');
if($http===403)fail_request(503,'La fuente de vuelos rechazó la consulta (HTTP 403). Necesitas autorización del proveedor.');
if($body===false)fail_request(502,'No se pudo consultar la fuente de vuelos. '.$err);
if($http!==200)fail_request(502,'El proveedor respondió HTTP '.($http?:'desconocido').'.');
$data=json_decode($body,true);
if(!is_array($data)||!isset($data['ac'])||!is_array($data['ac']))fail_request(502,'La fuente devolvió datos incompletos.');
echo json_encode(['ac'=>array_slice($data['ac'],0,180),'now'=>$data['now']??null,'source'=>'adsb.lol'],JSON_UNESCAPED_UNICODE);
