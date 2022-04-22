<?php

/**
 * Class que representa o banco de dados que é usado no APP mobile excelenc_api
 * global $sqlGlEx;
 * Config criada ConexaoBancoExecelencia()
 * 
 * Desenvolvido por: Daniel Gomes Albernaz
 */

class Produto {	

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
			if($atributos['busca']){
				$sql .= '   RIGHT JOIN marcas mc ON mc.id = est.marca_id ';
			}            
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
			if($atributos['busca']){
				$sql .= '   and mc.nome LIKE '. '"%' . $atributos['busca'] . '%" ' ;
				$sql .= '   OR est.referencia LIKE '. '"%' . $atributos['busca'] . '%" ' ;
				$sql .= '   OR est.nome LIKE '. '"%' . $atributos['busca'] . '%" ' ;
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
            $sql .= '   produtos est ';
			if($atributos['busca']){
				$sql .= '   RIGHT JOIN marcas mc ON mc.id = est.marca_id ';
			} 
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
			if($atributos['busca']){
				$sql .= '   and mc.nome LIKE '. '"%' . $atributos['busca'] . '%" ' ;
				$sql .= '   OR est.referencia LIKE '. '"%' . $atributos['busca'] . '%" ' ;
				$sql .= '   OR est.nome LIKE '. '"%' . $atributos['busca'] . '%" ' ;
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

	    $stmte = $sqlGlEx->pdo->prepare($sql);// print_rpre($sql);
        
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
		$stmte = $sqlGlEx->pdo->prepare($sql); 
		
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
    
    function listarMarcasComProdutos($atributos=array(),$orderBy=null) {
        global $sqlGlEx;

		$sql =  'SELECT DISTINCT ';
		$sql .= ' marca_id ';
		$sql .= 'FROM ';
		$sql .= 'produtos ';
		$sql .= ' WHERE ';
 		$sql .= 'ativo = 1 ';				
		$stmte = $sqlGlEx->pdo->prepare($sql); 
		
        $stmte->execute();        
        $aValores = $stmte->fetchAll(PDO::FETCH_OBJ);
        return $aValores;
    }
    
    function listaMarcas($atributos=array(),$orderBy=null) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGlEx;

		$aValores = $sqlGlEx -> from("marcas")->where($atributos)->orderBy($orderBy);
		$aValores = $aValores->fetch();
		return $aValores;
    }
    
    function listarCategoriasESubcategorias($atributos=array(),$orderBy=null) {
        global $sqlGlEx;

		$sql =  'SELECT DISTINCT ';
		$sql .= ' categoria_id, ';
		$sql .= ' cat.nome nome_categoria, ';
		$sql .= ' sub_categoria_id, ';
		$sql .= ' scat.nome nome_sub_categoria ';
        $sql .= 'FROM ';
        $sql .= 'produtos prod ';
		$sql .= 'INNER JOIN categorias AS cat ON cat.id = prod.categoria_id ';
		$sql .= 'INNER JOIN sub_categorias AS scat ON scat.id = prod.sub_categoria_id  ';		
		$sql .= ' WHERE prod.ativo = 1 ';			
		$sql .= ' ORDER BY categoria_id ';			
		$stmte = $sqlGlEx->pdo->prepare($sql);
		
        $stmte->execute();        
        $aValores = $stmte->fetchAll(PDO::FETCH_OBJ);
        return $aValores;
    }

    function listarCategoriaProduto($atributos=array(),$orderBy=null) {
        global $sqlGlEx;

		$sql =  'SELECT DISTINCT ';
		$sql .= ' categoria_id, ';
		$sql .= ' cat.nome ';
        $sql .= 'FROM ';
        $sql .= 'produtos prod ';
		$sql .= 'INNER JOIN categorias AS cat ON cat.id = prod.categoria_id ';	
		$sql .= ' WHERE prod.ativo = 1 ';			
		$stmte = $sqlGlEx->pdo->prepare($sql);
		
        $stmte->execute();        
        $aValores = $stmte->fetchAll(PDO::FETCH_OBJ);
        return $aValores;
    }

    function listarSubcategoria($atributos=array(),$orderBy=null) {
        global $sqlGlEx;

		$sql =  'SELECT DISTINCT ';
		$sql .= ' prod.sub_categoria_id, ';
		$sql .= ' scat.nome ';
        $sql .= 'FROM ';
        $sql .= 'produtos prod ';
		$sql .= 'INNER JOIN sub_categorias AS scat ON scat.id = prod.sub_categoria_id ';	
		$sql .= ' WHERE prod.categoria_id = ' . $atributos['id_sub_categoria'];			
		$stmte = $sqlGlEx->pdo->prepare($sql);
		
        $stmte->execute();        
        $aValores = $stmte->fetchAll(PDO::FETCH_OBJ);
        return $aValores;
    }


    function listarSubcategoriaView($atributos=array(),$orderBy=null) {
        global $sqlGlEx;

		$sql =  'SELECT DISTINCT ';
		$sql .= ' prod.sub_categoria_id, ';
		$sql .= ' scat.nome ';
        $sql .= 'FROM ';
        $sql .= 'produtos prod ';
		$sql .= 'INNER JOIN sub_categorias AS scat ON scat.id = prod.sub_categoria_id ';	
		$sql .= ' WHERE prod.categoria_id = ' . $atributos['id_sub_categoria'];			
		$stmte = $sqlGlEx->pdo->prepare($sql);
		
        $stmte->execute();        
        $aValores = $stmte->fetchAll(PDO::FETCH_OBJ);
        return $aValores;
    }


    function listarQuemViu($atributos=array(),$orderBy=null) {
        global $sqlGlEx;

		$sql =  'SELECT ';
		$sql .= ' * ';
        $sql .= 'FROM ';
        $sql .= 'produtos ';	
		$sql .= ' WHERE categoria_id = ' . $atributos['categoria-id'];			
		$sql .= ' and sub_categoria_id = ' . $atributos['sub-categoria-id'];			
		$sql .= ' ORDER BY id DESC LIMIT 5';			
		$stmte = $sqlGlEx->pdo->prepare($sql);
		
        $stmte->execute();        
        $aValores = $stmte->fetchAll(PDO::FETCH_OBJ);
        return $aValores;
	}
	
	function listarProdutosNoCarrinho($atributos=array(),$orderBy=null) {
        global $sqlGlEx;

		$sql =  'SELECT ';
		$sql .= ' p.*, ';
		$sql .= ' po.orcamento_id, ';
		$sql .= ' po.quantidade, ';
		$sql .= ' o.cliente, ';
		$sql .= ' o.nome nome_cliente,  ';
		$sql .= ' o.totalservico total_servico,  ';
		$sql .= ' o.percLucro  ';
        $sql .= ' FROM ';
        $sql .= 'produtos p ';	
        $sql .= 'INNER JOIN produto_orcamento AS po ON po.produto_id = p.id ';	
        $sql .= ' INNER JOIN orcamentos AS o ON o.id = po.orcamento_id  ';	
		$sql .= ' WHERE p.id = ' . $atributos['produto_id'];	
		$sql .= ' and po.orcamento_id = ' . $atributos['orcamento_id'];	
		$stmte = $sqlGlEx->pdo->prepare($sql); 
		
        $stmte->execute();        
        $aValores = $stmte->fetchAll(PDO::FETCH_OBJ);
        return $aValores;
    }

}
?>