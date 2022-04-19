<?php

/**
 * Class que representa o banco de dados que é usado no APP mobile excelenc_api
 * global $sqlGlEx;
 * Config criada ConexaoBancoExecelencia()
 * 
 * Desenvolvido por: Daniel Gomes Albernaz
 */

class Orcamento {	

	function cadastrar($form) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGlEx;
		
		$result = $sqlGlEx->insertInto('orcamentos',$form);
		$lastInsert = $result->execute();

		//retorna o resultado da query para a câmada de controle
		return $lastInsert;
    }
    
    function cadastrarProdutoOrcamento($form) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGlEx;
		
		$result = $sqlGlEx->insertInto('produto_orcamento',$form);
		$lastInsert = $result->execute();

		//retorna o resultado da query para a câmada de controle
		return $lastInsert;
	}

	function alterar($form) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGlEx;
		$result = $sqlGlEx->update('orcamentos')->set($form)->where('id', $form['id']);
		$result = $result->execute(true);

		//retorna o resultado da query para a câmada de controle
		return $result;
	}

	function deletar($id) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGlEx;
		$result = $sqlGlEx->deleteFrom("orcamentos")->where("id",$id);
		$result = $result->execute();

		//retorna o resultado da query para a câmada de controle
		return $result;
	}
	
	
	function listar($atributos=array(),$orderBy=null) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGlEx;
		
		$aValores = $sqlGlEx -> from("orcamentos")->where($atributos)->orderBy($orderBy);
		$aValores = $aValores->fetchAll();
		$aValores['num'] = count($aValores);
	
		return $aValores;
    }
    
    function listarProdutosCarrinho($atributos=array(),$orderBy=null) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGlEx;
		
		$aValores = $sqlGlEx -> from("produto_orcamento")->where($atributos)->orderBy($orderBy);
		$aValores = $aValores->fetchAll();
		$aValores['num'] = count($aValores);
	
		return $aValores;
	}

	function listarorcamentos($parametros) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGlEx;

		$sql =  'SELECT ';
		$sql .= ' * ';
		$sql .= 'FROM ';
		$sql .= 'orcamentos ';
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

		$aValores = $sqlGlEx -> from("orcamentos")->where($atributos)->orderBy($orderBy);
		$aValores = $aValores->fetch();
		return $aValores;
    }
    
    function listaProdutosOrcamento($atributos=array(),$orderBy=null) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGlEx;

		$aValores = $sqlGlEx -> from("produto_orcamento")->where($atributos)->orderBy($orderBy);
		$aValores = $aValores->fetch();
		return $aValores;
	}

	function listaCaracteristicas($atributos=array(),$orderBy=null) {

		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGlEx;
		
		$aValores = $sqlGlEx -> from("caracteristica_orcamentos")->where($atributos)->orderBy($orderBy);
		$aValores = $aValores->fetchAll();
		$aValores['num'] = count($aValores);
	
		return $aValores;
	}

	function listaFotos($atributos=array(),$orderBy=null) {

		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGlEx;
		
		$aValores = $sqlGlEx -> from("orcamentos_fotos")->where($atributos)->orderBy($orderBy);
		$aValores = $aValores->fetchAll();
		$aValores['num'] = count($aValores);
	
		return $aValores;
	}

	function publicar($id, $status) {
		global $sqlGlEx;
		$result = $sqlGlEx->update('orcamentos')->set('status',$status)->where('id', $id);
		$result = $result->execute(true);
		
		//retorna o resultado da query para a câmada de controle
		return $result;
	}

	## ORDEM DOS ARQUIVOS ##

	function pegarListagensParaAlterarBack($fromPosition, $toPosition) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGlEx;
		$aValores = $sqlGlEx -> from("orcamentos")->where('ordem <= :ordem1 && ordem >= :ordem2 ',array(':ordem1' => $fromPosition, ':ordem2' => $toPosition));
		$aValores = $aValores->fetchAll();
		$aValores['num'] = count($aValores);
	
		return $aValores;
	}

	function pegarListagensParaAlterarForward($fromPosition, $toPosition) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGlEx;
		$aValores = $sqlGlEx -> from("orcamentos")->where('ordem >= :ordem1 && ordem <= :ordem2 ',array(':ordem1' => $fromPosition, ':ordem2' => $toPosition));
		$aValores = $aValores->fetchAll();
		$aValores['num'] = count($aValores);
	
		return $aValores;
	}

	function alteraOrdem($id, $posicao) {
		global $sqlGlEx;
		$result = $sqlGlEx->update('orcamentos')->set('ordem',$posicao)->where('id', $id);
		$result = $result->execute(true);
		
		//retorna o resultado da query para a câmada de controle
		return $result;
		
	}

	function proximo_id() {
	    //chamada ao objeto da classe de abstraÃ§Ã£o de banco de dados
	    global $sqlGlEx;
	
	    $pdo = $sqlGlEx->getPdo();
	
	    $stmt = $pdo->query("SHOW TABLE STATUS LIKE 'orcamentos'");
	    $res = $stmt->fetch(PDO::FETCH_ASSOC);
	
	    return $res['auto_increment'];
	} 

	function cadastrarFoto($form) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGlEx;
		$result = $sqlGlEx->insertInto('orcamentos_fotos',$form);
		$lastInsert = $result->execute();
	
		//retorna o resultado da query para a câmada de controle
		return $lastInsert;
	}

	function cadastrarCaracteristica($form) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGlEx;		

		$result = $sqlGlEx->insertInto('caracteristica_orcamentos',$form);
		$lastInsert = $result->execute();
		//retorna o resultado da query para a câmada de controle

		return $result;

	}
	
	function listarCategorias($atributos=array(),$orderBy=null) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGlEx;

		$aValores = $sqlGlEx -> from("categoria_orcamentos")->where($atributos)->orderBy($orderBy);
		$aValores = $aValores->fetchAll();

		$aValores['num'] = count($aValores);
		return $aValores;
	}  

	function listar_fotos($atributos=array()) {
	    global $sqlGlEx;

	    $sql = 'SELECT
	                nft.id,
		        	nft.img
                FROM orcamentos_fotos nft
                WHERE nft.id_orcamentos = :IDorcamentos';
	    
	    $stmte = $sqlGlEx->pdo->prepare($sql);
	    $stmte->bindValue('IDorcamentos',  $atributos['id'], PDO::PARAM_STR);
	    if($stmte->execute()) {
	        $aValores = $stmte->fetchAll(PDO::FETCH_OBJ);
	        $aValores['num'] = $stmte->rowCount();
	        return $aValores;
	    }
	} 

	function deletarFoto($id) {

	    //chamada ao objeto da classe de abstração de banco de dados
	    global $sqlGlEx;
	    $result = $sqlGlEx->deleteFrom("orcamentos_fotos")->where("id",$id);
	    $result = $result->execute();
	    
	    //retorna o resultado da query para a câmada de controle
	    return $result;
	}

	function listarorcamentosRelacionados($atributos=array(),$orderBy=null,$limit=null) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGlEx;
                $sql = 'SELECT ';
                $sql .= '   * ';
                $sql .= 'FROM ';
                $sql .= '   orcamentos ';
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

	function listarorcamentosRelacionadosorcamentos($atributos=array(),$orderBy=null,$limit=null) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGlEx;
                $sql = 'SELECT ';
                $sql .= '   * ';
                $sql .= 'FROM ';
                $sql .= '   orcamentos ';
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
            $sql .= '   orcamentos est ';
            $sql .= 'WHERE ';
            $sql .= '   est.ativo = 1 ';
            if($atributos['marca']){
				$sql .= '   and est.marca_id = ' . $atributos['marca'];
            }
            if($atributos['categoria']){
				$sql .= '   and est.categoria_id = ' . $atributos['categoria'];
            }
            if($atributos['sub-categoria']){
				$sql .= '   and est.sub_categoria_id = ' . $atributos['sub-categoria'];
			}
			// if($atributos['palavra-chave']){
			// 	$sql .= '   and est.titulo LIKE '. '"%' . $atributos['palavra-chave'] . '%" ' ;
			// 	$sql .= '   OR est.texto LIKE '. '"%' . $atributos['palavra-chave'] . '%" ' ;
			// }
	    
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
	        $atributos['pagina'] = $qtd_pagina = ($atributos['pagina'] - 1) * 12;
	    }

	    $sql = 'SELECT ';
            $sql .= '   est.* ';
            $sql .= 'FROM  ';
            $sql .= '   orcamentos est ';
            $sql .= 'WHERE ';
            $sql .= '   est.ativo = 1 ';
            if($atributos['marca']){
				$sql .= '   and est.marca_id = ' . $atributos['marca'];
            }
            if($atributos['categoria']){
				$sql .= '   and est.categoria_id = ' . $atributos['categoria'];
            }
            if($atributos['sub-categoria']){
				$sql .= '   and est.sub_categoria_id = ' . $atributos['sub-categoria'];
			}
			
			// if($atributos['palavra-chave']){
			// 	$sql .= '   and est.titulo LIKE '. '"%' . $atributos['palavra-chave'] . '%" ' ;
			// 	$sql .= '   OR est.texto LIKE '. '"%' . $atributos['palavra-chave'] . '%" ' ;
			// }
			
            $sql .= ' ORDER BY ';
            if($atributos['ordenacao'] == 1){
                $sql .= '   est.id DESC ';
            }elseif($atributos['ordenacao'] == 2){
                $sql .= '   est.valor ASC ';
            }elseif($atributos['ordenacao'] == 3){
                $sql .= '   est.valor DESC ';
            }elseif($atributos['ordenacao'] == 4){
                $sql .= '   est.nome ASC ';
            }elseif($atributos['ordenacao'] == 5){
                $sql .= '   est.nome DESC ';
            }else{
                $sql .= '   est.id DESC ';
            }
            
            $sql .= ' LIMIT '.$qtd_pagina.',12  ';

	    $stmte = $sqlGlEx->pdo->prepare($sql);  
        
	    if($stmte->execute()){
	        $aValores = $stmte->fetchAll(PDO::FETCH_OBJ);
			$aValores['num'] = $stmte->rowCount();
	        $aValores['resultados'] = $qtd->qtd;

	        return $aValores;
	    }
	}

	function listarUltimosorcamentos() {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGlEx;

		$sql =  'SELECT ';
		$sql .= ' * ';
		$sql .= 'FROM ';
		$sql .= 'orcamentos ';
		$sql .= ' WHERE ';
 		$sql .= 'STATUS = 1 ';			
 		$sql .= 'ORDER BY ID DESC ';			
 		$sql .= 'LIMIT 3 ';	
		$stmte = $sqlGlEx->pdo->prepare($sql); 
		
		$stmte->execute();
			$aValores = $stmte->fetchAll(PDO::FETCH_OBJ);
			return $aValores;
		   
		
	}	
	
	function deletarProdutoCarrinho($atributos=array()) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGlEx;

		$sql =  'DELETE  ';
		$sql .= ' FROM ';
		$sql .= ' produto_orcamento ';
		$sql .= ' WHERE ';
 		$sql .= ' orcamento_id = ' . $atributos['orcamento_id'];			
 		$sql .= ' and produto_id = ' . $atributos['produto_id'];
		$stmte = $sqlGlEx->pdo->prepare($sql); 
		
		$stmte->execute();
			$aValores = $stmte->fetchAll(PDO::FETCH_OBJ);
			return $aValores;		   
		
	}

	function alterarQuantidadeProdutoOrcamento($atributos=array()) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGlEx;

		$sql =  'UPDATE  ';
		$sql .= ' produto_orcamento ';
		$sql .= ' SET quantidade = ' . $atributos['qtd'];
		$sql .= ' WHERE ';
 		$sql .= ' orcamento_id = ' . $atributos['orcamento_id'];			
 		$sql .= ' and produto_id = ' . $atributos['produto_id'];
		$stmte = $sqlGlEx->pdo->prepare($sql); 
		
		$stmte->execute();
			$aValores = $stmte->fetchAll(PDO::FETCH_OBJ);
			return $aValores;		   
		
	}

	
   

}
?>