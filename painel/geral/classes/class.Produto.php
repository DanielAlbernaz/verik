<?php
class Produto {

	function lista($idProduto) {
		global $sqlGlv;

		$sql =  'SELECT ';
		$sql .= ' produto.*, ';
		$sql .= ' grupo.nome as nome_categoria, ';
		$sql .= ' grupo.GRUPO_PRODUTOS_ID, ';
		$sql .= ' preco.preco_venda, ';
		$sql .= ' estoque.estoque ';
		$sql .= 'FROM ';
		$sql .= ' VW_WEB_PRODUTOS produto ';
		$sql .= ' INNER JOIN VW_WEB_PRECOS preco ON preco.PRODUTO_ID = produto.PRODUTO_ID ';
		$sql .= ' INNER JOIN VW_WEB_GRUPOS_PRODUTOS grupo ON grupo.GRUPO_PRODUTOS_ID = produto.GRUPO_PRODUTOS_ID ';
		$sql .= ' INNER JOIN VW_WEB_GRUPOS_PRODUTOS_WEB grupoweb ON grupoweb.GRUPO_PRODUTOS_WEB_ID  = produto.GRUPO_PRODUTOS_WEB_ID ';
		$sql .= ' INNER JOIN VW_WEB_ESTOQUES estoque ON estoque.PRODUTO_ID = produto.PRODUTO_ID ';
		$sql .= ' WHERE ';
		$sql .= ' produto.PRODUTO_ID = ' . $idProduto;

		$stmte = $sqlGlv->pdo->prepare($sql); 
		
		$stmte->execute();
		$aValores = $stmte->fetch(PDO::FETCH_OBJ);
		return $aValores;
	}	

	function listaRelacionadosCategoria($idGrupo, $nomeFabricante) {
		global $sqlGlv;

		$sql =  'SELECT ';
		$sql .= ' produto.*, ';
		$sql .= ' grupo.nome as nome_categoria, ';
		$sql .= ' preco.preco_venda, ';
		$sql .= ' estoque.estoque ';
		$sql .= 'FROM ';
		$sql .= ' VW_WEB_PRODUTOS produto ';
		$sql .= ' INNER JOIN VW_WEB_PRECOS preco ON preco.PRODUTO_ID = produto.PRODUTO_ID ';
		$sql .= ' INNER JOIN VW_WEB_GRUPOS_PRODUTOS grupo ON grupo.GRUPO_PRODUTOS_ID = produto.GRUPO_PRODUTOS_ID ';
		$sql .= ' INNER JOIN VW_WEB_GRUPOS_PRODUTOS_WEB grupoweb ON grupoweb.GRUPO_PRODUTOS_WEB_ID  = produto.GRUPO_PRODUTOS_WEB_ID ';
		$sql .= ' INNER JOIN VW_WEB_ESTOQUES estoque ON estoque.PRODUTO_ID = produto.PRODUTO_ID ';
		$sql .= ' WHERE ';
		$sql .= ' (grupo.GRUPO_PRODUTOS_ID = ' . "'" . $idGrupo . "' ";
		$sql .= ' or produto.nome_fabricante = ' . "'" . $nomeFabricante . "')";
		$sql .= '  and preco.EMPRESA_ID = 1 ';
		$sql .= '  and estoque.estoque > 0 ';
		$sql .= ' FETCH FIRST 10 ROWS ONLY ';

		$stmte = $sqlGlv->pdo->prepare($sql);
		
		$stmte->execute();
		$aValores = $stmte->fetchAll(PDO::FETCH_OBJ);
		$aValores['num'] = count($aValores);
		return $aValores;
	}	

	function listarPaginacao($atributos=array()) {

	    //chamada ao objeto da classe de abstração de banco de dados	
        global $sqlGlv;
		 
		// $atributos['status'] = 1;

	    $sql = 'SELECT ';
            $sql .= '   COUNT(produto.produto_id) AS qtd ';
            $sql .= 'FROM ';
            $sql .= '   VW_WEB_PRODUTOS produto ';
			$sql .= '   INNER JOIN VW_WEB_ESTOQUES estoque ON estoque.PRODUTO_ID = produto.PRODUTO_ID  ';
			// if($atributos['busca']){
			// 	$sql .= '   RIGHT JOIN marcas mc ON mc.id = est.marca_id ';
			// }            
            $sql .= 'WHERE ';
            $sql .= '   produto.ativo = \'S\' ';
            $sql .= '   and estoque.estoque > 0 ';
            if($atributos['fabricante']){
				$sql .= '   and produto.MARCA = ' . "'" . $atributos['fabricante'] . "'";
            }
            if($atributos['categoria']){
				$sql .= '   and produto.GRUPO_PRODUTOS_ID = ' . "'" . $atributos['categoria'] . "'";
            }
            // if($atributos['sub-categoria']){
			// 	$sql .= '   and est.sub_categoria_id = ' . $atributos['sub-categoria'];
			// }
			// if($atributos['busca']){
			// 	$sql .= '   and mc.nome LIKE '. '"%' . $atributos['busca'] . '%" ' ;
			// 	$sql .= '   OR est.referencia LIKE '. '"%' . $atributos['busca'] . '%" ' ;
			// 	$sql .= '   OR est.nome LIKE '. '"%' . $atributos['busca'] . '%" ' ;
			// } 
			if($atributos['search']){
				$sql .= '   and (produto.nome LIKE '. "'%" . $atributos['search'] . "%' " ;
				$sql .= '   OR produto.caracteristicas_produto LIKE '. "'%" . $atributos['search'] . "%' )" ;
			}
	    
            ($atributos['pagina'] ? $atributos['pagina'] = $atributos['pagina'] : $atributos['pagina'] = 1);
            
	    $aValores = array();
	    $stmte = $sqlGlv->pdo->prepare($sql);

	    if($stmte->execute()) {
	        $qtd = $stmte->fetch(PDO::FETCH_OBJ);
	    }
	    // controla a paginação
	    if ($atributos['pagina'] == 1) {
	        $atributos['pagina'] = $qtd_pagina = 0;
	    } else {
	        $atributos['pagina'] = $qtd_pagina = ($atributos['pagina'] - 1) * 16;
	    }

	    $sql = 'SELECT ';
            $sql .= ' * ';
            $sql .= 'FROM  ';
            $sql .= '   VW_WEB_PRODUTOS produto ';
            $sql .= '   INNER JOIN VW_WEB_PRECOS preco ON preco.PRODUTO_ID = produto.PRODUTO_ID  ';
			$sql .= '   INNER JOIN VW_WEB_ESTOQUES estoque ON estoque.PRODUTO_ID = produto.PRODUTO_ID  ';
		// 	if($atributos['busca']){
		// 		$sql .= '   RIGHT JOIN marcas mc ON mc.id = est.marca_id ';
		// 	} 
			$sql .= 'WHERE ';
			$sql .= '   produto.ativo = \'S\' ';
			$sql .= '  and preco.EMPRESA_ID = 1 ';
			$sql .= '   and estoque.estoque > 0 ';
			if($atributos['fabricante']){
				$sql .= '   and produto.MARCA = ' . "'" . $atributos['fabricante'] . "'";
            }
            if($atributos['categoria']){
				$sql .= '   and produto.GRUPO_PRODUTOS_ID = ' . "'" . $atributos['categoria'] . "'";
            }
			if($atributos['search']){
				$sql .= '   and (produto.nome LIKE '. "'%" . $atributos['search'] . "%' " ;
				$sql .= '   OR produto.caracteristicas_produto LIKE '. "'%" . $atributos['search'] . "%' )" ;
			}
        //     if($atributos['sub-categoria']){
		// 		$sql .= '   and est.sub_categoria_id = ' . $atributos['sub-categoria'];
		// 	}
		// 	if($atributos['busca']){
		// 		$sql .= '   and mc.nome LIKE '. '"%' . $atributos['busca'] . '%" ' ;
		// 		$sql .= '   OR est.referencia LIKE '. '"%' . $atributos['busca'] . '%" ' ;
		// 		$sql .= '   OR est.nome LIKE '. '"%' . $atributos['busca'] . '%" ' ;
		// 	} 
			
			// if($atributos['palavra-chave']){
			// 	$sql .= '   and est.titulo LIKE '. '"%' . $atributos['palavra-chave'] . '%" ' ;
			// 	$sql .= '   OR est.texto LIKE '. '"%' . $atributos['palavra-chave'] . '%" ' ;
			// }
			
            $sql .= ' ORDER BY ';
            if($atributos['ordenacao'] == 'menor-preco'){
                $sql .= '   preco.preco_venda ASC ';
			}elseif($atributos['ordenacao'] == 'maior-preco'){
				$sql .= '   preco.preco_venda DESC ';
			}elseif($atributos['ordenacao'] == 'a-z'){
				$sql .= '   produto.nome ASC ';
			}elseif($atributos['ordenacao'] == 'z-a'){
				$sql .= '   produto.nome DESC ';
			}elseif($atributos['ordenacao'] == 'data-lancamento'){
				$sql .= '   produto.data_cadastro DESC ';
			}else{
				$sql .= '   produto.produto_id DESC ';
			}
            
		// $sql .= ' LIMIT '.$qtd_pagina.',12  ';
		$sql .= ' OFFSET '.$qtd_pagina.' ROWS FETCH NEXT 16 ROWS ONLY  ';
		
	    $stmte = $sqlGlv->pdo->prepare($sql); 
		// print_rpre($sql);exit;
		
	    if($stmte->execute()){
	        $aValores = $stmte->fetchAll(PDO::FETCH_OBJ);
			$aValores['num'] = count($aValores);
	        $aValores['resultados'] = $qtd->qtd;
	        

	        return $aValores;
	    }
	}

	function listaFotosProduto($idProduto) {
		global $sqlGlv;

		$sql =  'SELECT ';
		$sql .= ' fotos.* ';
		$sql .= 'FROM ';
		$sql .= ' VW_WEB_FOTOS_PRODUTOS fotos ';
		$sql .= ' INNER JOIN VW_WEB_PRODUTOS produto ON fotos.PRODUTO_ID = produto.PRODUTO_ID ';
		$sql .= ' WHERE ';
		$sql .= ' fotos.PRODUTO_ID = ' . $idProduto;

		$stmte = $sqlGlv->pdo->prepare($sql); 
		
		$stmte->execute();
		$aValores = $stmte->fetchAll(PDO::FETCH_OBJ);
		return $aValores;
	}	


	function listaCategoriaProdutos() {
		global $sqlGlv;

		$sql =  'SELECT DISTINCT ';
		$sql .= ' produto.GRUPO_PRODUTOS_ID ';
		$sql .= 'FROM ';
		$sql .= ' VW_WEB_PRODUTOS produto ';

		$stmte = $sqlGlv->pdo->prepare($sql); 
		
		$stmte->execute();
		$aValores = $stmte->fetchAll(PDO::FETCH_OBJ);
	
		$categoriasPesquisa = [];
		for($i = 0; $i < count($aValores); $i++){
			if($i == (count($aValores) - 1)){
				$categoriasPesquisa[$i] = "'" . $aValores[$i]->grupo_produtos_id . "'";
			}else{
				$categoriasPesquisa[$i] = "'" . $aValores[$i]->grupo_produtos_id . "'" . ', ';
			}
		}
        $mostraCategorias = $this->categorias(implode(" ",$categoriasPesquisa));

		return $mostraCategorias;
	}

	function categorias($categorias) {
		global $sqlGlv;

		$sql =  'SELECT ';
		$sql .= ' * ';
		$sql .= ' FROM ';
		$sql .= ' VW_WEB_GRUPOS_PRODUTOS ';
		$sql .= ' WHERE ';
		$sql .= ' GRUPO_PRODUTOS_ID in ( ' . $categorias . ' )';
		
		$stmte = $sqlGlv->pdo->prepare($sql); 
		
		$stmte->execute();
		$aValores = $stmte->fetchAll(PDO::FETCH_OBJ);
		$aValores['num'] = count($aValores);
		return $aValores;
	}

	function listaMarcaProdutos() {
		global $sqlGlv;

		$sql =  'SELECT DISTINCT ';
		$sql .= ' produto.MARCA ';
		$sql .= 'FROM ';
		$sql .= ' VW_WEB_PRODUTOS produto ';

		$stmte = $sqlGlv->pdo->prepare($sql); 
		
		$stmte->execute();
		$aValores = $stmte->fetchAll(PDO::FETCH_OBJ);
		$aValores['num'] = count($aValores);
		return $aValores;
	}
}
?>