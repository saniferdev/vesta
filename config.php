<?php

ini_set('display_errors', 0); 
ini_set('display_startup_errors', 0); 
error_reporting(-1);


$url_soap  			= "http://192.168.130.55:8124/soap-wsdl/syracuse/collaboration/syracuse/CAdxWebServiceXmlCC?wsdl";

$login 				= 'admin';
$password 			= 'mW33Yjf8q88Bex';
$codeLang 			= 'FRA';

$poolAlias 			= 'PROD';

/*$sqlServerHost 		= '192.168.124.212';
$sqlServerDatabase 	     = 'SANIFER_OUTILS';
$sqlServerUser 		= 'gestion_stock';
$sqlServerPassword 	     = 'WesoKhu640Rfz0Yi';*/

$sqlServerHost      = '192.168.130.50\TALYS';
$sqlServerDatabase  = 'x3v12prod';
$sqlServerUser      = 'CA';
$sqlServerPassword  = 'WesoKhu640Rfz0Yi';

$connectionInfo 	     = array("Database" => $sqlServerDatabase, "UID" => $sqlServerUser, "PWD" => $sqlServerPassword, "CharacterSet" => "UTF-8");
$link 				= sqlsrv_connect($sqlServerHost, $connectionInfo);
if (!$link) {
     die( print_r( sqlsrv_errors(), true));
}

?>