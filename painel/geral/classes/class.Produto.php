<?php
class Produto {
	

	function cadastrar($form) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGl;
		
		$result = $sqlGl->insertInto('produtos',$form);
		$lastInsert = $result->execute();

		//retorna o resultado da query para a câmada de controle
		return $lastInsert;
	}

	function alterar($form) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGl;
		$result = $sqlGl->update('produtos')->set($form)->where('id', $form['id']);
		$result = $result->execute(true);

		//retorna o resultado da query para a câmada de controle
		return $result;
	}

	function deletar($id) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGl;
		$result = $sqlGl->deleteFrom("produtos")->where("id",$id);
		$result = $result->execute();

		//retorna o resultado da query para a câmada de controle
		return $result;
	}
	
	
	function listar($atributos=array(),$orderBy=null) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGl;
		
		$aValores = $sqlGl -> from("produtos")->where($atributos)->orderBy($orderBy);
		$aValores = $aValores->fetchAll();
		$aValores['num'] = count($aValores);
	
		return $aValores;
	}

	function listarproduto($parametros) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGl;

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

		$aValores = $sqlGl -> from("produtos")->where($atributos)->orderBy($orderBy);
		$aValores = $aValores->fetch();
		return $aValores;
	}

	function publicar($id, $status) {
		global $sqlGl;
		$result = $sqlGl->update('produtos')->set('status',$status)->where('id', $id);
		$result = $result->execute(true);
		
		//retorna o resultado da query para a câmada de controle
		return $result;
	}

	## ORDEM DOS ARQUIVOS ##

	function pegarListagensParaAlterarBack($fromPosition, $toPosition) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGl;
		$aValores = $sqlGl -> from("produtos")->where('ordem <= :ordem1 && ordem >= :ordem2 ',array(':ordem1' => $fromPosition, ':ordem2' => $toPosition));
		$aValores = $aValores->fetchAll();
		$aValores['num'] = count($aValores);
	
		return $aValores;
	}

	function pegarListagensParaAlterarForward($fromPosition, $toPosition) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGl;
		$aValores = $sqlGl -> from("produtos")->where('ordem >= :ordem1 && ordem <= :ordem2 ',array(':ordem1' => $fromPosition, ':ordem2' => $toPosition));
		$aValores = $aValores->fetchAll();
		$aValores['num'] = count($aValores);
	
		return $aValores;
	}

	function alteraOrdem($id, $posicao) {
		global $sqlGl;
		$result = $sqlGl->update('produtos')->set('ordem',$posicao)->where('id', $id);
		$result = $result->execute(true);
		
		//retorna o resultado da query para a câmada de controle
		return $result;
		
	}

	function proximo_id() {
	    //chamada ao objeto da classe de abstraÃ§Ã£o de banco de dados
	    global $sqlGl;
	
	    $pdo = $sqlGl->getPdo();
	
	    $stmt = $pdo->query("SHOW TABLE STATUS LIKE 'produtos'");
	    $res = $stmt->fetch(PDO::FETCH_ASSOC);
	
	    return $res['auto_increment'];
	} 

	function cadastrarFoto($form) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGl;
		$result = $sqlGl->insertInto('produto_fotos',$form);
		$lastInsert = $result->execute();
	
		//retorna o resultado da query para a câmada de controle
		return $lastInsert;
	}
	
	function listarCategorias($atributos=array(),$orderBy=null) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGl;

		$aValores = $sqlGl -> from("categoria_produto")->where($atributos)->orderBy($orderBy);
		$aValores = $aValores->fetchAll();

		$aValores['num'] = count($aValores);
		return $aValores;
	}  

	function listar_fotos($atributos=array()) {
	    global $sqlGl;

	    $sql = 'SELECT
	                nft.id,
		        	nft.img
                FROM produto_fotos nft
                WHERE nft.id_produto = :IDproduto';
	    
	    $stmte = $sqlGl->pdo->prepare($sql);
	    $stmte->bindValue('IDproduto',  $atributos['id'], PDO::PARAM_STR);
	    if($stmte->execute()) {
	        $aValores = $stmte->fetchAll(PDO::FETCH_OBJ);
	        $aValores['num'] = $stmte->rowCount();
	        return $aValores;
	    }
	} 

	function deletarFoto($id) {

	    //chamada ao objeto da classe de abstração de banco de dados
	    global $sqlGl;
	    $result = $sqlGl->deleteFrom("produto_fotos")->where("id",$id);
	    $result = $result->execute();
	    
	    //retorna o resultado da query para a câmada de controle
	    return $result;
	}

	function listarprodutoRelacionados($atributos=array(),$orderBy=null,$limit=null) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGl;
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

		$stmte = $sqlGl->pdo->prepare($sql);
		$stmte->bindParam('STATUS', $atributos['status'], PDO::PARAM_INT);
		$stmte->bindParam('ID', $atributos['id'], PDO::PARAM_INT);

		if($stmte->execute()) {
		    $aValores = $stmte->fetchAll(PDO::FETCH_OBJ);
                    $aValores['num'] = count($aValores);
			return $aValores;
		}
	} 

	function listarprodutoRelacionadosproduto($atributos=array(),$orderBy=null,$limit=null) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGl;
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
            $sql .= '   produtos est ';
            $sql .= 'WHERE ';
			$sql .= '   (data_inicio_exibicao <= NOW()) and ';
            $sql .= '   (data_expiracao >= NOW() or data_expiracao is null or data_expiracao = "0000-00-00 00:00:00" ) and ';
			$sql .= '   est.status = 1 ';
			if($atributos['categoria']){
				$sql .= '   and est.categoria = '. '' . $atributos['categoria'] . ' ' ;
			}
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
            $sql .= '   produtos est ';
            $sql .= 'WHERE ';
            $sql .= '   (data_inicio_exibicao <= NOW()) and ';
            $sql .= '   (data_expiracao >= NOW() or data_expiracao is null or data_expiracao = "0000-00-00 00:00:00" ) and ';
			$sql .= '   est.status = 1 ';
			if($atributos['categoria']){
				$sql .= '   and est.categoria = '. '' . $atributos['categoria'] . ' ' ;
			}
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

	function listarUltimosproduto() {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGl;

		$sql =  'SELECT ';
		$sql .= ' * ';
		$sql .= 'FROM ';
		$sql .= 'produtos ';
		$sql .= ' WHERE ';
 		$sql .= 'STATUS = 1 ';			
 		$sql .= 'ORDER BY ID DESC ';			
 		$sql .= 'LIMIT 3 ';	
		$stmte = $sqlGl->pdo->prepare($sql); 
		
		$stmte->execute();
			$aValores = $stmte->fetchAll(PDO::FETCH_OBJ);
			return $aValores;
	}	
	
	function listarDestaques() {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGl;

		$sql =  'SELECT * FROM treinamento_presencial WHERE destaque = 1 ';
		$sql .= ' UNION ';
		$sql .= 'SELECT * FROM treinamento_gravado WHERE destaque = 1  ';
		$sql .= ' UNION ';
		$sql .= ' SELECT * FROM treinamento WHERE destaque = 1  ';

		$stmte = $sqlGl->pdo->prepare($sql);
		
		$stmte->execute();
			$aValores = $stmte->fetchAll(PDO::FETCH_OBJ);
			return $aValores;
	}	
}
?>