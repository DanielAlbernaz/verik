<?php	
	include dirname(__FILE__)."/../geral/inc/config.php";
	
	include dirname(__FILE__)."/pdo/FluentPDO.php";	
	
	$config = new Config();
	$atributosDeConexao = $config->AtributosConfig();

	$aParametros = array();
	$aParametros['host'] = $atributosDeConexao["banco"]["local"]["host"];
	$aParametros['user'] = $atributosDeConexao["banco"]["local"]["user"];
	$aParametros['passwd'] = $atributosDeConexao["banco"]["local"]["senha"];
	$aParametros['DBType'] = $atributosDeConexao["banco"]["local"]["type"];
	$aParametros['port'] = $atributosDeConexao["banco"]["local"]["port"];
	$aParametros['dbName'] = $atributosDeConexao["banco"]["local"]["banco"];
	 
	$pdo = new PDO($aParametros['DBType'].":host=".$aParametros['host'].";port=".$aParametros['port'].";dbname=".$aParametros['dbName'], $aParametros['user'],$aParametros['passwd']);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
	$pdo->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER);
	$pdo->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER);
	$sqlGl = new FluentPDO($pdo);


	// Conexão com banco Verik
	$atributosDeConexaoVerik = $config->ConexaoBancoExecelencia();

	$aParametrosVerik = array();
	$aParametrosVerik['host'] = $atributosDeConexaoVerik["banco"]["local"]["host"];
	$aParametrosVerik['user'] = $atributosDeConexaoVerik["banco"]["local"]["user"];
	$aParametrosVerik['passwd'] = $atributosDeConexaoVerik["banco"]["local"]["senha"];
	$aParametrosVerik['DBType'] = $atributosDeConexaoVerik["banco"]["local"]["type"];
	$aParametrosVerik['port'] = $atributosDeConexaoVerik["banco"]["local"]["port"];
	$aParametrosVerik['dbName'] = $atributosDeConexaoVerik["banco"]["local"]["banco"];
	 
// 	$pdo2 = new PDO($aParametrosVerik['DBType'].":host=".$aParametrosVerik['host'].";port=".$aParametrosVerik['port'].";ci:dbname=".$aParametrosVerik['dbName'], $aParametrosVerik['user'],$aParametrosVerik['passwd']);
// // 	$pdo2 = new Pdo("oci:dbname=(".$aParametrosVerik['dbName']." = (ADDRESS_LIST = (
// // 		ADDRESS = (PROTOCOL = TCP)
// // 		(HOST = {".$aParametrosVerik['host']."} )
// // 		(PORT = {".$aParametrosVerik['port']."} )
// // 	   ))
// // 	 (CONNECT_DATA = (SID = {".$aParametrosVerik['serviceName']."})
// // 	 )); charset=AL32UTF8",
// // 	 $aParametrosVerik['user'],
// // $params['passwd']
// // );
// 	$pdo2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
// 	$pdo2->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER);
// 	$pdo2->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER);
// 	$sqlGlEx = new FluentPDO($pdo2);


	