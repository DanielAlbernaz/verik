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
			$allConfig["banco"]["local"]["port"] = "3309";
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
		// public $configBancoExecelencia;	
		// 	public static function ConexaoBancoExecelencia(){
		// 		$configBancoExecelencia["banco"]["local"]["host"]  = "192.168.7.206";
		// 		$configBancoExecelencia["banco"]["local"]["user"]  = "root";
		// 		$configBancoExecelencia["banco"]["local"]["senha"] = "mysql";
		// 		$configBancoExecelencia["banco"]["local"]["banco"] = "excelenc_api";
		// 		$configBancoExecelencia["banco"]["local"]["port"]  = "3306";	
		// 		$configBancoExecelencia["banco"]["local"]["type"]  = "mysql";

		// 		return $configBancoExecelencia;
		// }

		/**
		 * Produção
		 */
		public $configBancoExecelencia;	
			public static function ConexaoBancoExecelencia(){
				$configBancoExecelencia["banco"]["local"]["host"]  = "189.113.168.208";
				$configBancoExecelencia["banco"]["local"]["user"]  = "excelenc_api";
				$configBancoExecelencia["banco"]["local"]["senha"] = "@2018@n49tsuprema";
				$configBancoExecelencia["banco"]["local"]["banco"] = "excelenc_api";
				$configBancoExecelencia["banco"]["local"]["port"]  = "3306";	
				$configBancoExecelencia["banco"]["local"]["type"]  = "mysql";

				return $configBancoExecelencia;
		}
			   
	}


