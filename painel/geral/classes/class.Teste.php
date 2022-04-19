<?php
class Teste {
	

	function cadastrar($form) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGlEx;
		
		$result = $sqlGlEx->insertInto('produtos',$form);
		$lastInsert = $result->execute();

		//retorna o resultado da query para a câmada de controle
		return $lastInsert;
	}

	function alterar($form) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGlEx;
		$result = $sqlGlEx->update('produtos')->set($form)->where('id', $form['id']);
		$result = $result->execute(true);

		//retorna o resultado da query para a câmada de controle
		return $result;
	}

	function deletar($id) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGlEx;
		$result = $sqlGlEx->deleteFrom("produtos")->where("id",$id);
		$result = $result->execute();

		//retorna o resultado da query para a câmada de controle
		return $result;
	}
	
	
	function listar($atributos=array(),$orderBy=null) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGlEx;
		
		$aValores = $sqlGlEx -> from("produtos")->where($atributos)->orderBy($orderBy);
		$aValores = $aValores->fetchAll();
		$aValores['num'] = count($aValores);
	
		return $aValores;
	}

	function listarprodutos($parametros) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGlEx;

		$sql =  'SELECT ';
		$sql .= ' * ';
		$sql .= 'FROM ';
		$sql .= 'produtos ';
		$sql .= ' WHERE ';
 		$sql .= 'STATUS = 1 ';			

		$sqlResult = $sql;
		if(array_key_exists('pagina', $parametros)){
			$limit = 'LIMIT ' . $parametros['pagina'] . ', 3';
			$sqlResult .= $limit;
		}
	
		$stmtePaginacao = $sqlGlEx->pdo->prepare($sql);
		$stmte = $sqlGlEx->pdo->prepare($sqlResult);
		
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
		global $sqlGlEx;

		$aValores = $sqlGlEx -> from("produtos")->where($atributos)->orderBy($orderBy);
		$aValores = $aValores->fetch();
		return $aValores;
	}

	function listaCaracteristicas($atributos=array(),$orderBy=null) {

		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGlEx;
		
		$aValores = $sqlGlEx -> from("caracteristica_produtos")->where($atributos)->orderBy($orderBy);
		$aValores = $aValores->fetchAll();
		$aValores['num'] = count($aValores);
	
		return $aValores;
	}

	function listaFotos($atributos=array(),$orderBy=null) {

		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGlEx;
		
		$aValores = $sqlGlEx -> from("produtos_fotos")->where($atributos)->orderBy($orderBy);
		$aValores = $aValores->fetchAll();
		$aValores['num'] = count($aValores);
	
		return $aValores;
	}

	function publicar($id, $status) {
		global $sqlGlEx;
		$result = $sqlGlEx->update('produtos')->set('status',$status)->where('id', $id);
		$result = $result->execute(true);
		
		//retorna o resultado da query para a câmada de controle
		return $result;
	}

	## ORDEM DOS ARQUIVOS ##

	function pegarListagensParaAlterarBack($fromPosition, $toPosition) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGlEx;
		$aValores = $sqlGlEx -> from("produtos")->where('ordem <= :ordem1 && ordem >= :ordem2 ',array(':ordem1' => $fromPosition, ':ordem2' => $toPosition));
		$aValores = $aValores->fetchAll();
		$aValores['num'] = count($aValores);
	
		return $aValores;
	}

	function pegarListagensParaAlterarForward($fromPosition, $toPosition) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGlEx;
		$aValores = $sqlGlEx -> from("produtos")->where('ordem >= :ordem1 && ordem <= :ordem2 ',array(':ordem1' => $fromPosition, ':ordem2' => $toPosition));
		$aValores = $aValores->fetchAll();
		$aValores['num'] = count($aValores);
	
		return $aValores;
	}

	function alteraOrdem($id, $posicao) {
		global $sqlGlEx;
		$result = $sqlGlEx->update('produtos')->set('ordem',$posicao)->where('id', $id);
		$result = $result->execute(true);
		
		//retorna o resultado da query para a câmada de controle
		return $result;
		
	}

	function proximo_id() {
	    //chamada ao objeto da classe de abstraÃ§Ã£o de banco de dados
	    global $sqlGlEx;
	
	    $pdo = $sqlGlEx->getPdo();
	
	    $stmt = $pdo->query("SHOW TABLE STATUS LIKE 'produtos'");
	    $res = $stmt->fetch(PDO::FETCH_ASSOC);
	
	    return $res['auto_increment'];
	} 

	function cadastrarFoto($form) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGlEx;
		$result = $sqlGlEx->insertInto('produtos_fotos',$form);
		$lastInsert = $result->execute();
	
		//retorna o resultado da query para a câmada de controle
		return $lastInsert;
	}

	function cadastrarCaracteristica($form) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGlEx;		

		$result = $sqlGlEx->insertInto('caracteristica_produtos',$form);
		$lastInsert = $result->execute();
		//retorna o resultado da query para a câmada de controle

		return $result;

	}
	
	function listarCategorias($atributos=array(),$orderBy=null) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGlEx;

		$aValores = $sqlGlEx -> from("categoria_produtos")->where($atributos)->orderBy($orderBy);
		$aValores = $aValores->fetchAll();

		$aValores['num'] = count($aValores);
		return $aValores;
	}  

	function listar_fotos($atributos=array()) {
	    global $sqlGlEx;

	    $sql = 'SELECT
	                nft.id,
		        	nft.img
                FROM produtos_fotos nft
                WHERE nft.id_produtos = :IDprodutos';
	    
	    $stmte = $sqlGlEx->pdo->prepare($sql);
	    $stmte->bindValue('IDprodutos',  $atributos['id'], PDO::PARAM_STR);
	    if($stmte->execute()) {
	        $aValores = $stmte->fetchAll(PDO::FETCH_OBJ);
	        $aValores['num'] = $stmte->rowCount();
	        return $aValores;
	    }
	} 

	function deletarFoto($id) {

	    //chamada ao objeto da classe de abstração de banco de dados
	    global $sqlGlEx;
	    $result = $sqlGlEx->deleteFrom("produtos_fotos")->where("id",$id);
	    $result = $result->execute();
	    
	    //retorna o resultado da query para a câmada de controle
	    return $result;
	}

	function listarprodutosRelacionados($atributos=array(),$orderBy=null,$limit=null) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGlEx;
                $sql = 'SELECT ';
                $sql .= '   * ';
                $sql .= 'FROM ';
                $sql .= '   produtos ';
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

		$stmte = $sqlGlEx->pdo->prepare($sql);
		$stmte->bindParam('STATUS', $atributos['status'], PDO::PARAM_INT);
		$stmte->bindParam('ID', $atributos['id'], PDO::PARAM_INT);

		if($stmte->execute()) {
		    $aValores = $stmte->fetchAll(PDO::FETCH_OBJ);
                    $aValores['num'] = count($aValores);
			return $aValores;
		}
	} 

	function listarprodutosRelacionadosprodutos($atributos=array(),$orderBy=null,$limit=null) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGlEx;
                $sql = 'SELECT ';
                $sql .= '   * ';
                $sql .= 'FROM ';
                $sql .= '   produtos ';
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

		$stmte = $sqlGlEx->pdo->prepare($sql); 
		$stmte->bindParam('STATUS', $atributos['status'], PDO::PARAM_INT);

		if($stmte->execute()) {
		    $aValores = $stmte->fetchAll(PDO::FETCH_OBJ);
                    $aValores['num'] = count($aValores);
			return $aValores;
		}
	}

	function listarPaginacao($atributos=array()) {

	    //chamada ao objeto da classe de abstração de banco de dados	
	    global $sqlGlEx;
		 
		$atributos['status'] = 1;

	    $sql = 'SELECT ';
            $sql .= '   COUNT(est.id) AS qtd ';
            $sql .= 'FROM ';
            $sql .= '   produtos est ';
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
	    $stmte = $sqlGlEx->pdo->prepare($sql);

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
            $sql .= '   produtos est ';
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

	    $stmte = $sqlGlEx->pdo->prepare($sql); 
        
	    if($stmte->execute()){
	        $aValores = $stmte->fetchAll(PDO::FETCH_OBJ);
			$aValores['num'] = $stmte->rowCount();
	        $aValores['resultados'] = $qtd->qtd;

	        return $aValores;
	    }
	}

	function listarUltimosprodutos() {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGlEx;

		$sql =  'SELECT ';
		$sql .= ' * ';
		$sql .= 'FROM ';
		$sql .= 'produtos ';
		$sql .= ' WHERE ';
 		$sql .= 'STATUS = 1 ';			
 		$sql .= 'ORDER BY ID DESC ';			
 		$sql .= 'LIMIT 3 ';	
		$stmte = $sqlGlEx->pdo->prepare($sql); print_rpre($sql)	;
		
		$stmte->execute();
			$aValores = $stmte->fetchAll(PDO::FETCH_OBJ);
			return $aValores;
		   
		
	}	

	function listarHabilidades($atributos=array(),$orderBy=null) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGlEx;

		$aValores = $sqlGlEx -> from("caracteristica_produtos")->where($atributos)->orderBy($orderBy);
		$aValores = $aValores->fetchAll();

		$aValores['num'] = count($aValores);
		return $aValores;
	} 

	function deletarHabilidade($id) {

		//chamada ao objeto da classe de abstração de banco de dados

		global $sqlGlEx;

		$result = $sqlGlEx->deleteFrom("caracteristica_produtos")->where("id_produtos",$id);

		$result = $result->execute();



		//retorna o resultado da query para a câmada de controle

		return $result;

	}

	function cadastrarHabilidade($form) {

		//chamada ao objeto da classe de abstração de banco de dados

		global $sqlGlEx;

		

		$result = $sqlGlEx->insertInto('caracteristica_produtos',$form);

		$lastInsert = $result->execute();



		//retorna o resultado da query para a câmada de controle

		return $result;

	}


}
?>