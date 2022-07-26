<?php
	date_default_timezone_set('America/Sao_Paulo');
	error_reporting(E_ALL);
	ini_set('display_errors', 0);
	header('Content-Type: text/html; charset=utf-8');
	/* caminho dos paths */
	if (($_SERVER['SERVER_NAME'] == '192.168.7.203') || ($_SERVER['SERVER_NAME'] == 'localhost')) {		
		$path["site"] = "http://localhost/verik/";
		
	}else{
		$path["site"] = "/";
	}
	
	/* outros paths */
	$path["classes"] = "painel/geral/classes/";
	$path["geral"] = "painel/geral/";
	$path["newsletter"] = "painel/geral/newsletter/";
	
	class Config{
		
		public $allConfig;
		
		public static function AtributosConfig(){
		    
		    //banco de dados local principal (o banco auxiliar ﾃｩ esse mais o sufixo _aux)
			$allConfig["banco"]["local"]["host"]  = "localhost";
			$allConfig["banco"]["local"]["user"]  = "root";
			$allConfig["banco"]["local"]["senha"] = "";
			$allConfig["banco"]["local"]["banco"] = "verik";
			$allConfig["banco"]["local"]["port"] = "3306";
			$allConfig["banco"]["local"]["type"] = "mysql";
			
			## INI - site do desenvolvedor ##
			$allConfig["siteDesenvolvedor"] = "http://www.netsuprema.com.br/";
			
			## INI - Nome do cliente ##
			$allConfig["nomeCliente"] = "Excelência Distribuidora de sistemas de segurança eletrônica";
			
			## INI - Site do cliente ##
			$allConfig["siteCliente"] = "http://excelenciago.com.br/";
			
			$allConfig["smtp"]['host'] = 'serverbr8.com';
			$allConfig["smtp"]['user'] = 'no-reply@netsuprema.com.br';
			$allConfig["smtp"]['senha'] = '$n3tn3t$';
			$allConfig["smtp"]['port'] = '587';
			//$allConfig["smtp"]['port'] = '465';
			//$allConfig["smtp"]['ssl'] = true;
			$allConfig["smtp"]['from'] = 'no-reply@netsuprema.com.br';
			$allConfig["smtp"]['fromName'] = 'Excelência Distribuidora de sistemas de segurança eletrônica';
			
			
// 			$allConfig["whm"]['dominioCpanelCliente'] = 'adugo.com.br';
// 			$allConfig["whm"]['userCpanelCliente'] = 'adugocom';
// 			$allConfig["whm"]['dominio'] = 'netsuprema.com.br';
// 			$allConfig["whm"]['user'] = 'netsupre';
// 			$allConfig["whm"]['pass'] = 'adm@2015@n49tsuprema';
			$allConfig["permissao"]['emailCpanel'] = false;
			$allConfig["permissao"]['ftpCpanel'] = false;
			$allConfig["permissao"]['formulario'] = true;
			$allConfig["permissao"]['formularioCriar'] = true;
			$allConfig["permissao"]['formularioListar'] = true;
			$allConfig["permissao"]['modulo'] = true;
			$allConfig["permissao"]['moduloCriar'] = true;
			$allConfig["permissao"]['moduloListar'] = true;
			
			return $allConfig;
		
		}

		/**
		 * Desenvolvimento
		 */
		// public $configBancoVerik;	
		// 	public static function ConexaoBancoExecelencia(){
		// 		$configBancoVerik["banco"]["local"]["host"]  = "192.168.7.206";
		// 		$configBancoVerik["banco"]["local"]["user"]  = "root";
		// 		$configBancoVerik["banco"]["local"]["senha"] = "mysql";
		// 		$configBancoVerik["banco"]["local"]["banco"] = "excelenc_api";
		// 		$configBancoVerik["banco"]["local"]["port"]  = "3306";	
		// 		$configBancoVerik["banco"]["local"]["type"]  = "mysql";

		// 		return $configBancoVerik;
		// }

		/**
		 * Produção
		 */
		public $configBancoVerik;	
			public static function ConexaoBancoExecelencia(){
				$configBancoVerik["banco"]["local"]["host"]  = "189.112.246.1";
				$configBancoVerik["banco"]["local"]["user"]  = "BANCOWEB";
				$configBancoVerik["banco"]["local"]["senha"] = "D1T3C7";
				$configBancoVerik["banco"]["local"]["banco"] = "SANTRIPDB1";
				$configBancoVerik["banco"]["local"]["serviceName"] = "SANTRIPDB1";

				$configBancoVerik["banco"]["local"]["port"]  = "1521";	
				$configBancoVerik["banco"]["local"]["type"]  = "oci";

				return $configBancoVerik;
		}
			   
	}


