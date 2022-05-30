<?php

/**
 * Class que representa o banco de dados que é usado no APP mobile excelenc_api
 * global $sqlGl;
 * Config criada ConexaoBancoExecelencia()
 * 
 * Desenvolvido por: Daniel Gomes Albernaz
 */
	
class UsuarioSite {	

	function cadastrar($form) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGl;
		
		$result = $sqlGl->insertInto('usuarios_site',$form);
		$lastInsert = $result->execute();

		//retorna o resultado da query para a câmada de controle
		return $lastInsert;
	}

	function alterar($form) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGl;
		$result = $sqlGl->update('usuarios_site')->set($form)->where('id', $form['id']);
		$result = $result->execute(true);

		//retorna o resultado da query para a câmada de controle
		return $result;
	}

	function deletar($id) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGl;
		$result = $sqlGl->deleteFrom("usuarios_site")->where("id",$id);
		$result = $result->execute();

		//retorna o resultado da query para a câmada de controle
		return $result;
	}
	
	
	function listar($atributos=array(),$orderBy=null) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGl;
		
		$aValores = $sqlGl -> from("usuarios_site")->where($atributos)->orderBy($orderBy);
		$aValores = $aValores->fetchAll();
		$aValores['num'] = count($aValores);
	
		return $aValores;
	}

	function listarusuarios_site($parametros) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGl;

		$sql =  'SELECT ';
		$sql .= ' * ';
		$sql .= 'FROM ';
		$sql .= 'usuarios_site ';
		$sql .= ' WHERE ';
 		$sql .= 'STATUS = 1 ';			

		$sqlResult = $sql;
		if(array_key_exists('pagina', $parametros)){
			$limit = 'LIMIT ' . $parametros['pagina'] . ', 3';
			$sqlResult .= $limit;
		}
	
		$stmtePaginacao = $sqlGl->pdo->prepare($sql);
		$stmte = $sqlGl->pdo->prepare($sqlResult);
		
		if($stmte->execute()) {
			if($stmtePaginacao->execute()){
				$results = $stmtePaginacao->rowCount();
			}
					   
		$aValores = $stmte->fetchAll(PDO::FETCH_OBJ);
		$aValores['num'] = $stmte->rowCount();
		$aValores['results'] = $results;
		$aValores['parametros'] = $parametros;
		return $aValores;
	}	
}

	function lista($atributos=array(),$orderBy=null) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGl;

		$aValores = $sqlGl -> from("usuarios_site")->where($atributos)->orderBy($orderBy);
		$aValores = $aValores->fetch();
		return $aValores;
	}

	function listaCaracteristicas($atributos=array(),$orderBy=null) {

		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGl;
		
		$aValores = $sqlGl -> from("caracteristica_usuarios_site")->where($atributos)->orderBy($orderBy);
		$aValores = $aValores->fetchAll();
		$aValores['num'] = count($aValores);
	
		return $aValores;
	}

	function listaFotos($atributos=array(),$orderBy=null) {

		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGl;
		
		$aValores = $sqlGl -> from("usuarios_site_fotos")->where($atributos)->orderBy($orderBy);
		$aValores = $aValores->fetchAll();
		$aValores['num'] = count($aValores);
	
		return $aValores;
	}

	function publicar($id, $status) {
		global $sqlGl;
		$result = $sqlGl->update('usuarios_site')->set('status',$status)->where('id', $id);
		$result = $result->execute(true);
		
		//retorna o resultado da query para a câmada de controle
		return $result;
	}

	## ORDEM DOS ARQUIVOS ##

	function pegarListagensParaAlterarBack($fromPosition, $toPosition) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGl;
		$aValores = $sqlGl -> from("usuarios_site")->where('ordem <= :ordem1 && ordem >= :ordem2 ',array(':ordem1' => $fromPosition, ':ordem2' => $toPosition));
		$aValores = $aValores->fetchAll();
		$aValores['num'] = count($aValores);
	
		return $aValores;
	}

	function pegarListagensParaAlterarForward($fromPosition, $toPosition) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGl;
		$aValores = $sqlGl -> from("usuarios_site")->where('ordem >= :ordem1 && ordem <= :ordem2 ',array(':ordem1' => $fromPosition, ':ordem2' => $toPosition));
		$aValores = $aValores->fetchAll();
		$aValores['num'] = count($aValores);
	
		return $aValores;
	}

	function alteraOrdem($id, $posicao) {
		global $sqlGl;
		$result = $sqlGl->update('usuarios_site')->set('ordem',$posicao)->where('id', $id);
		$result = $result->execute(true);
		
		//retorna o resultado da query para a câmada de controle
		return $result;
		
	}

	function proximo_id() {
	    //chamada ao objeto da classe de abstraÃ§Ã£o de banco de dados
	    global $sqlGl;
	
	    $pdo = $sqlGl->getPdo();
	
	    $stmt = $pdo->query("SHOW TABLE STATUS LIKE 'usuarios_site'");
	    $res = $stmt->fetch(PDO::FETCH_ASSOC);
	
	    return $res['auto_increment'];
	} 

	function cadastrarFoto($form) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGl;
		$result = $sqlGl->insertInto('usuarios_site_fotos',$form);
		$lastInsert = $result->execute();
	
		//retorna o resultado da query para a câmada de controle
		return $lastInsert;
	}

	function cadastrarCaracteristica($form) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGl;		

		$result = $sqlGl->insertInto('caracteristica_usuarios_site',$form);
		$lastInsert = $result->execute();
		//retorna o resultado da query para a câmada de controle

		return $result;

	}
	
	function listarCategorias($atributos=array(),$orderBy=null) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGl;

		$aValores = $sqlGl -> from("categoria_usuarios_site")->where($atributos)->orderBy($orderBy);
		$aValores = $aValores->fetchAll();

		$aValores['num'] = count($aValores);
		return $aValores;
	}  

	function listar_fotos($atributos=array()) {
	    global $sqlGl;

	    $sql = 'SELECT
	                nft.id,
		        	nft.img
                FROM usuarios_site_fotos nft
                WHERE nft.id_usuarios_site = :IDusuarios_site';
	    
	    $stmte = $sqlGl->pdo->prepare($sql);
	    $stmte->bindValue('IDusuarios_site',  $atributos['id'], PDO::PARAM_STR);
	    if($stmte->execute()) {
	        $aValores = $stmte->fetchAll(PDO::FETCH_OBJ);
	        $aValores['num'] = $stmte->rowCount();
	        return $aValores;
	    }
	} 

	function deletarFoto($id) {

	    //chamada ao objeto da classe de abstração de banco de dados
	    global $sqlGl;
	    $result = $sqlGl->deleteFrom("usuarios_site_fotos")->where("id",$id);
	    $result = $result->execute();
	    
	    //retorna o resultado da query para a câmada de controle
	    return $result;
	}

	function listarusuarios_siteRelacionados($atributos=array(),$orderBy=null,$limit=null) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGl;
                $sql = 'SELECT ';
                $sql .= '   * ';
                $sql .= 'FROM ';
                $sql .= '   usuarios_site ';
                $sql .= 'WHERE ';
                // $sql .= '   data_inicio_exibicao <= now() and ';
                // $sql .= '   (data_expiracao > now() or data_expiracao = 0) and ';
                $sql .= '   status = :STATUS ';
                $sql .= '   and id != :ID ';
                if($orderBy){
                    $sql .= ' order by '.$orderBy;
                }
                if($limit){
                    $sql .= ' limit '.$limit;
                }
		$aValores = array();		

		$stmte = $sqlGl->pdo->prepare($sql);
		$stmte->bindParam('STATUS', $atributos['status'], PDO::PARAM_INT);
		$stmte->bindParam('ID', $atributos['id'], PDO::PARAM_INT);

		if($stmte->execute()) {
		    $aValores = $stmte->fetchAll(PDO::FETCH_OBJ);
                    $aValores['num'] = count($aValores);
			return $aValores;
		}
	} 

	function listarusuarios_siteRelacionadosusuarios_site($atributos=array(),$orderBy=null,$limit=null) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGl;
                $sql = 'SELECT ';
                $sql .= '   * ';
                $sql .= 'FROM ';
                $sql .= '   usuarios_site ';
                $sql .= 'WHERE ';
                // $sql .= '   data_inicio_exibicao <= now() and ';
                // $sql .= '   (data_expiracao > now() or data_expiracao = 0) and ';
                $sql .= '   status = :STATUS ';
                if($orderBy){
                    $sql .= ' order by '.$orderBy;
                }
                if($limit){
                    $sql .= ' limit '.$limit;
                }
		$aValores = array();		

		$stmte = $sqlGl->pdo->prepare($sql); 
		$stmte->bindParam('STATUS', $atributos['status'], PDO::PARAM_INT);

		if($stmte->execute()) {
		    $aValores = $stmte->fetchAll(PDO::FETCH_OBJ);
                    $aValores['num'] = count($aValores);
			return $aValores;
		}
	}

	function listarPaginacao($atributos=array()) {

	    //chamada ao objeto da classe de abstração de banco de dados	
	    global $sqlGl;
		 
		$atributos['status'] = 1;

	    $sql = 'SELECT ';
            $sql .= '   COUNT(est.id) AS qtd ';
            $sql .= 'FROM ';
            $sql .= '   usuarios_site est ';
            $sql .= 'WHERE ';
            // $sql .= '   (data_expiracao >= CURDATE() or ';
            // $sql .= '   data_expiracao is null or ';
            // $sql .= '   data_expiracao = 0) ';
			$sql .= '   est.status = 1 ';
			if($atributos['palavra-chave']){
				$sql .= '   and est.titulo LIKE '. '"%' . $atributos['palavra-chave'] . '%" ' ;
				$sql .= '   OR est.texto LIKE '. '"%' . $atributos['palavra-chave'] . '%" ' ;
			}
	    
            ($atributos['pagina'] ? $atributos['pagina'] = $atributos['pagina'] : $atributos['pagina'] = 1);
            
	    $aValores = array();
	    $stmte = $sqlGl->pdo->prepare($sql);

	    if($stmte->execute()) {
	        $qtd = $stmte->fetch(PDO::FETCH_OBJ);
	    }
	    
	    // controla a paginação
	    if ($atributos['pagina'] == 1) {
	        $atributos['pagina'] = $qtd_pagina = 0;
	    } else {
	        $atributos['pagina'] = $qtd_pagina = ($atributos['pagina'] - 1) * 4;
	    }

	    $sql = 'SELECT ';
            $sql .= '   est.* ';
            $sql .= 'FROM  ';
            $sql .= '   usuarios_site est ';
            $sql .= 'WHERE ';
            // $sql .= '   (data_expiracao >= CURDATE() or ';
            // $sql .= '   data_expiracao is null or ';
            // $sql .= '   data_expiracao = 0) ';
			$sql .= '   est.status = 1 ';
			if($atributos['palavra-chave']){
				$sql .= '   and est.titulo LIKE '. '"%' . $atributos['palavra-chave'] . '%" ' ;
				$sql .= '   OR est.texto LIKE '. '"%' . $atributos['palavra-chave'] . '%" ' ;
			}
			
            $sql .= 'ORDER BY ';
            $sql .= '   est.id desc ';
            $sql .= 'LIMIT '.$qtd_pagina.',4  ';

	    $stmte = $sqlGl->pdo->prepare($sql); 
        
	    if($stmte->execute()){
	        $aValores = $stmte->fetchAll(PDO::FETCH_OBJ);
			$aValores['num'] = $stmte->rowCount();
	        $aValores['resultados'] = $qtd->qtd;

	        return $aValores;
	    }
	}

	function listarUltimosusuarios_site() {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGl;

		$sql =  'SELECT ';
		$sql .= ' * ';
		$sql .= 'FROM ';
		$sql .= 'usuarios_site ';
		$sql .= ' WHERE ';
 		$sql .= 'STATUS = 1 ';			
 		$sql .= 'ORDER BY ID DESC ';			
 		$sql .= 'LIMIT 3 ';	
		$stmte = $sqlGl->pdo->prepare($sql); print_rpre($sql)	;
		
		$stmte->execute();
			$aValores = $stmte->fetchAll(PDO::FETCH_OBJ);
			return $aValores;
		   
		
	}	

	function listarHabilidades($atributos=array(),$orderBy=null) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGl;

		$aValores = $sqlGl -> from("caracteristica_usuarios_site")->where($atributos)->orderBy($orderBy);
		$aValores = $aValores->fetchAll();

		$aValores['num'] = count($aValores);
		return $aValores;
	} 

	function deletarHabilidade($id) {

		//chamada ao objeto da classe de abstração de banco de dados

		global $sqlGl;

		$result = $sqlGl->deleteFrom("caracteristica_usuarios_site")->where("id_usuarios_site",$id);

		$result = $result->execute();



		//retorna o resultado da query para a câmada de controle

		return $result;

	}

	function cadastrarHabilidade($form) {

		//chamada ao objeto da classe de abstração de banco de dados

		global $sqlGl;

		

		$result = $sqlGl->insertInto('caracteristica_usuarios_site',$form);

		$lastInsert = $result->execute();



		//retorna o resultado da query para a câmada de controle

		return $result;

	}

	function cadastrarTokenSession($form) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGl;
		
		$result = $sqlGl->insertInto('token_validacao_sessao',$form);
		$lastInsert = $result->execute();

		//retorna o resultado da query para a câmada de controle
		return $lastInsert;
	}

	function alterarTokenSession($form) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGl;
		$result = $sqlGl->update('token_validacao_sessao')->set($form)->where('id', $form['id']);
		$result = $result->execute(true);

		//retorna o resultado da query para a câmada de controle
		return $result;
	}

	function listaTokenSession($atributos=array(),$orderBy=null) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGl;

		$aValores = $sqlGl -> from("token_validacao_sessao")->where($atributos)->orderBy($orderBy);
		$aValores = $aValores->fetch();
		return $aValores;
	}
	


}
?>