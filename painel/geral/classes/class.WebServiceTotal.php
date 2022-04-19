<?php

class WebService {
	
    private $conn;
    private $retorno = array();
    
    public function __construct($configuracao) {  
        $this->conn = new PDO('mysql:host='.$configuracao['banco']['local']['host'].';dbname='.$configuracao['banco']['local']['banco'], $configuracao['banco']['local']['user'], $configuracao['banco']['local']['senha'], array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        $this->conn->exec("SET NAMES utf8");
    }
    
    public function inserirImovel($imovel) {
        $retorno = $this->sqlInserirImovel($imovel);

        if (!$retorno['status']) {
            print_r($retorno['erro']);
            die();
        } else {
            $idImovel = $retorno['id_imovel'];
        }
        
        if (isset($imovel['imovel_foto'])) {
            foreach ($imovel['imovel_foto'] as $imovelFoto) {
                $retorno = $this->salvarImovelFoto($imovel['codigo_imovel'], $imovelFoto['nome'], $imovelFoto['url']);
                if (!$retorno['status']) {
                    print 'não foi possivel salvar a imagem';
                } else {
                    $imovelFoto['url'] = $retorno['url'];
                    $this->sqlInserirImovelFoto($idImovel, $imovelFoto);
                }
            }
        }
		
		$this->sqlDeletarCaracteristica($idImovel);
		if (isset($imovel['caracteristicas']) && $imovel['caracteristicas']) {
            foreach ($imovel['caracteristicas'] as $imovelCaracteristica) {
				$this->sqlInserirCaracteristica($idImovel, $imovelCaracteristica);
            }
        }
    }
    
    public function atualizarImovel($imovel) {

        $retorno = $this->sqlAtualizarImovel($imovel);
        if (!$retorno['status']) {
            print_r($retorno['erro']) . '<hr />';
        } else {
            $idImovel = $imovel['id_imovel'];
        }
        
        $retorno = $this->sqlExcluirImovelFoto($imovel);
        if (!$retorno['status']) {
            print_r($retorno['erro']) . '<hr />';
        }
        
        $retorno = $this->excluirImovelFoto($imovel['codigo_imovel']);
        if (!$retorno['status']) {
            print $retorno['erro'] . '<hr />';
        }
       
        if (isset($imovel['imovel_foto'])) {
            foreach ($imovel['imovel_foto'] as $imovelFoto) {
                $retorno = $this->salvarImovelFoto($imovel['codigo_imovel'], $imovelFoto['nome'], $imovelFoto['url']);
                if (!$retorno['status']) {
                    print 'não foi possivel salvar a imagem';
                } else {
                    $imovelFoto['url'] = $retorno['url'];
                    $this->sqlInserirImovelFoto($idImovel, $imovelFoto);
                }
            }
        }
        $this->sqlDeletarCaracteristica($idImovel);

        if (isset($imovel['caracteristicas']) && $imovel['caracteristicas']) {
            foreach ($imovel['caracteristicas'] as $imovelCaracteristica) {
				$this->sqlInserirCaracteristica($idImovel, $imovelCaracteristica);
            }
        }

    }
    
    public function imovelExiste($imovel) {
        
        $sql = 'SELECT
                	*
                FROM imovel i
                WHERE i.codigo_imovel = :CODIGO_IMOVEL';
        
        $stmte = $this->conn->prepare($sql);
        $stmte->bindValue('CODIGO_IMOVEL', $imovel['codigo_imovel'], PDO::PARAM_INT);
        if ($stmte->execute()) {
            $this->retorno['status'] = true;
            $this->retorno['dados']  = $stmte->fetch(PDO::FETCH_ASSOC);
            $this->retorno['qtd']    = $stmte->rowCount();
        } else {
            $this->retorno['status'] = false;
            $this->retorno['erro']   = $this->conn->errorInfo();
        }
         
        return $this->retorno;
    }
    
	private function sqlInserirImovel($imovel) {

	    $sql = 'INSERT INTO imovel
    	        (
                    codigo_imovel,
                    finalidade,
					categoria,
                    tipo_imovel,
                    tipo_imovel_url,
                    imovel_destaque,
                    cidade,
                    bairro,
                    cidade_url,
                    bairro_url,
                    numero,
                    complemento,
                    cep,
                    preco_venda,
                    preco_locacao,
                    preco_condominio,
                    area_util,
                    area_total,
                    area_comum, 
                    area_privativa,
                    area_terreno,   
                    area_construida,	        
                    qtd_dormitorio,
                    qtd_suite,
                    qtd_banheiro,
                    qtd_sala,
                    qtd_vaga,
                    prioridade,
                    latitude,
                    longitude,
                    observacao,
                    video,
                    
                    uf,
                    lagradouro,
                    publicacoes,
                    proprietario
    	        ) VALUES (
                    :CODIGO_IMOVEL,
                    :FINALIDADE,
					:CATEGORIA,
                    :TIPO_IMOVEL,
                    :TIPO_IMOVEL_URL,
                    :IMOVEL_DESTAQUE,
                    :CIDADE,
                     :BAIRRO,
                    :CIDADE_URL,
                    :BAIRRO_URL,
                    :NUMERO,
                    :COMPLEMENTO,
                    :CEP,
                    :PRECO_VENDA,
                    :PRECO_LOCACAO,
                    :PRECO_CONDOMINIO,
                    :AREA_UTIL,
                    :AREA_TOTAL,
                    :AREA_COMUM, 
                    :AREA_PRIVATIVA,
                    :AREA_TERRENO, 
                    :AREA_CONSTRUIDA,
                    :QTD_DORMITORIO,
                    :QTD_SUITE,
                    :QTD_BANHEIRO,
                    :QTD_SALA,
                    :QTD_VAGA,
                    :PRIORIDADE,
                    :LATITUDE,
                    :LONGITUDE,
                    :OBSERVACAO,
                    :VIDEO,
                   
                    :UF,
                    :LAGRADOURO,
                    :PUBLICACOES,
                    :PROPRIETARIO
	           )';
	    
            $stmte = $this->conn->prepare($sql);
	    $stmte->bindValue('CODIGO_IMOVEL',    $imovel['codigo_imovel'],    PDO::PARAM_INT);
		$stmte->bindValue('FINALIDADE',       $imovel['finalidade'],       PDO::PARAM_INT);
		$stmte->bindValue('CATEGORIA',        $imovel['categoria'],        PDO::PARAM_INT);
	    $stmte->bindValue('TIPO_IMOVEL',      $imovel['tipo_imovel'],      PDO::PARAM_STR);
	    $stmte->bindValue('TIPO_IMOVEL_URL',  $imovel['tipo_imovel_url'],  PDO::PARAM_STR);
	    $stmte->bindValue('IMOVEL_DESTAQUE',  $imovel['imovel_destaque'],  PDO::PARAM_STR);
	    $stmte->bindValue('CIDADE',           $imovel['cidade'],           PDO::PARAM_STR);
	    $stmte->bindValue('BAIRRO',           $imovel['bairro'],           PDO::PARAM_STR);
	    $stmte->bindValue('CIDADE_URL',       $imovel['cidade_url'],       PDO::PARAM_STR);
	    $stmte->bindValue('BAIRRO_URL',       $imovel['bairro_url'],       PDO::PARAM_STR);
	    $stmte->bindValue('NUMERO',           $imovel['numero'],           PDO::PARAM_STR);
	    $stmte->bindValue('COMPLEMENTO',      $imovel['complemento'],      PDO::PARAM_STR);
	    $stmte->bindValue('CEP',              $imovel['cep'],              PDO::PARAM_STR);
	    $stmte->bindValue('PRECO_VENDA',      $imovel['preco_venda'],      PDO::PARAM_STR);
	    $stmte->bindValue('PRECO_LOCACAO',    $imovel['preco_locacao'],    PDO::PARAM_STR);
	    $stmte->bindValue('PRECO_CONDOMINIO', $imovel['preco_condominio'], PDO::PARAM_STR);
	    $stmte->bindValue('AREA_UTIL',        $imovel['area_util'],        PDO::PARAM_STR);
	    $stmte->bindValue('AREA_TOTAL',       $imovel['area_total'],       PDO::PARAM_STR);
            $stmte->bindValue('AREA_COMUM',       $imovel['area_comum'],       PDO::PARAM_STR);
	    $stmte->bindValue('AREA_PRIVATIVA',   $imovel['area_privativa'],   PDO::PARAM_STR);
	    $stmte->bindValue('AREA_TERRENO',     $imovel['area_terreno'],     PDO::PARAM_STR);
	    $stmte->bindValue('AREA_CONSTRUIDA',  $imovel['area_construida'],  PDO::PARAM_STR);
	    $stmte->bindValue('QTD_DORMITORIO',   $imovel['qtd_dormitorio'],   PDO::PARAM_INT);
	    $stmte->bindValue('QTD_SUITE',        $imovel['qtd_suite'],        PDO::PARAM_INT);
	    $stmte->bindValue('QTD_BANHEIRO',     $imovel['qtd_banheiro'],     PDO::PARAM_INT);
	    $stmte->bindValue('QTD_SALA',         $imovel['qtd_sala'],         PDO::PARAM_INT);
	    $stmte->bindValue('QTD_VAGA',         $imovel['qtd_vaga'],         PDO::PARAM_INT);
	    $stmte->bindValue('PRIORIDADE',       $imovel['prioridade'],       PDO::PARAM_INT);
	    $stmte->bindValue('LATITUDE',         $imovel['latitude'],         PDO::PARAM_INT);
	    $stmte->bindValue('LONGITUDE',        $imovel['longitude'],        PDO::PARAM_INT);
	    $stmte->bindValue('OBSERVACAO',       $imovel['observacao'],       PDO::PARAM_STR);
	    $stmte->bindValue('VIDEO',            $imovel['video'],            PDO::PARAM_STR);
            
            $stmte->bindValue('UF',               $imovel['uf'],               PDO::PARAM_STR);
            $stmte->bindValue('LAGRADOURO',       $imovel['lagradouro'],       PDO::PARAM_STR);
            $stmte->bindValue('PUBLICACOES',      $imovel['publicacoes'],      PDO::PARAM_STR);
            $stmte->bindValue('PROPRIETARIO',     $imovel['proprietario'],     PDO::PARAM_STR);
            
            if ($stmte->execute()) {
	        $this->retorno['status']    = true;
	        $this->retorno['id_imovel'] = $this->conn->lastInsertId();
	    } else {
	        $this->retorno['status']    = false;
	        $this->retorno['erro'] = $this->conn->errorInfo();
	    }
            

	    return $this->retorno;
	}
	
	private function sqlInserirImovelFoto($idImovel, $imovelFoto) {
	    $sql = 'INSERT INTO imovel_foto
    	        (
    	           id_imovel,
    	           nome,
    	           url,
    	           principal,
    	           prioridade
    	        ) VALUES (
	               :ID_IMOVEL,
    	           :NOME,
    	           :URL,
    	           :PRINCIPAL,
    	           :PRIORIDADE
	           )';
	     
	    $stmte = $this->conn->prepare($sql);
	    $stmte->bindValue('ID_IMOVEL',  $idImovel,                 PDO::PARAM_INT);
	    $stmte->bindValue('NOME',       $imovelFoto['nome'],       PDO::PARAM_STR);
	    $stmte->bindValue('URL',        $imovelFoto['url'],        PDO::PARAM_STR);
	    $stmte->bindValue('PRINCIPAL',  $imovelFoto['principal'],  PDO::PARAM_INT);
	    $stmte->bindValue('PRIORIDADE', 1, PDO::PARAM_STR);
	    if ($stmte->execute()) {
	        $this->retorno['status'] = true;
	    } else {
	        $this->retorno['status'] = false;
	        $this->retorno['erro'] = $this->conn->errorInfo();
	    }
	     
	    return $this->retorno;
	}

	private function sqlInserirCaracteristica($idImovel, $imovelCaracteristica) {
            echo 'aqui';
	    $sql = 'INSERT INTO imovel_caracteristica
    	        (
    	           id_imovel,
    	           nm_caracteristica	
    	        ) VALUES (
	            :ID_IMOVEL,
    	            :NOME_CARACTERISTICA
	           )';
	     
	    $stmte = $this->conn->prepare($sql);

	    $stmte->bindValue('ID_IMOVEL',  $idImovel, PDO::PARAM_INT);
	    $stmte->bindValue('NOME_CARACTERISTICA',$imovelCaracteristica['nome'], PDO::PARAM_STR);
	    if ($stmte->execute()) {
	        $this->retorno['status'] = true;
	    } else {
	        $this->retorno['status'] = false;
	        $this->retorno['erro'] = $this->conn->errorInfo();
	    }
	     
	    return $this->retorno;
	}

	private function sqlDeletarCaracteristica($idImovel) {
	    $sql = 'DELETE FROM imovel_caracteristica
    	        WHERE 
					ID_IMOVEL = :ID_IMOVEL ';
	     
	    $stmte = $this->conn->prepare($sql);
	    $stmte->bindValue('ID_IMOVEL',  $idImovel, PDO::PARAM_INT);
	    if ($stmte->execute()) {
	        $this->retorno['status'] = true;
	    } else {
	        $this->retorno['status'] = false;
	        $this->retorno['erro'] = $this->conn->errorInfo();
	    }
	     
	    return $this->retorno;
	}
	
	public function sqlAtualizarImovel($imovel) {
	    $sql = 'UPDATE imovel SET
                    codigo_imovel    = :CODIGO_IMOVEL,
                    finalidade       = :FINALIDADE,
					categoria        = :CATEGORIA,
                    tipo_imovel      = :TIPO_IMOVEL,
                    tipo_imovel_url  = :TIPO_IMOVEL_URL,
                    imovel_destaque  = :IMOVEL_DESTAQUE,
                    cidade           = :CIDADE,
                    bairro           = :BAIRRO,
                    cidade_url       = :CIDADE_URL,
                    bairro_url       = :BAIRRO_URL,
                    numero           = :NUMERO,
                    complemento      = :COMPLEMENTO,
                    cep              = :CEP,
                    preco_venda      = :PRECO_VENDA,
                    preco_locacao    = :PRECO_LOCACAO,
                    preco_condominio = :PRECO_CONDOMINIO,
                    area_util        = :AREA_UTIL,
                    area_total       = :AREA_TOTAL,
                    area_comum       = :AREA_COMUM,
                    area_privativa   = :AREA_PRIVATIVA,
                    area_terreno     = :AREA_TERRENO,
                    area_construida  = :AREA_CONSTRUIDA,
                    qtd_dormitorio   = :QTD_DORMITORIO,
                    qtd_suite        = :QTD_SUITE,
                    qtd_banheiro     = :QTD_BANHEIRO,
                    qtd_sala         = :QTD_SALA,
                    qtd_vaga         = :QTD_VAGA,
                    prioridade       = :PRIORIDADE,
                    latitude         = :LATITUDE,
                    longitude        = :LONGITUDE,
                    observacao       = :OBSERVACAO,
                    video            = :VIDEO,
                    uf               = :UF,
                    lagradouro       = :LAGRADOURO,
                    publicacoes      = :PUBLICACOES,
                    proprietario     = :PROPRIETARIO          
        	    WHERE id = :ID_IMOVEL';
	
	    $stmte = $this->conn->prepare($sql);
	    $stmte->bindValue('CODIGO_IMOVEL',    $imovel['codigo_imovel'],    PDO::PARAM_INT);
		$stmte->bindValue('FINALIDADE',       $imovel['finalidade'],       PDO::PARAM_INT);
		$stmte->bindValue('CATEGORIA',        $imovel['categoria'],        PDO::PARAM_INT);
	    $stmte->bindValue('TIPO_IMOVEL',      $imovel['tipo_imovel'],      PDO::PARAM_STR);
	    $stmte->bindValue('TIPO_IMOVEL_URL',  $imovel['tipo_imovel_url'],  PDO::PARAM_STR);
	    $stmte->bindValue('IMOVEL_DESTAQUE',  $imovel['imovel_destaque'],  PDO::PARAM_STR);
	    $stmte->bindValue('CIDADE',           $imovel['cidade'],           PDO::PARAM_STR);
	    $stmte->bindValue('BAIRRO',           $imovel['bairro'],           PDO::PARAM_STR);
	    $stmte->bindValue('CIDADE_URL',       $imovel['cidade_url'],       PDO::PARAM_STR);
	    $stmte->bindValue('BAIRRO_URL',       $imovel['bairro_url'],       PDO::PARAM_STR);
	    $stmte->bindValue('NUMERO',           $imovel['numero'],           PDO::PARAM_STR);
	    $stmte->bindValue('COMPLEMENTO',      $imovel['complemento'],      PDO::PARAM_STR);
	    $stmte->bindValue('CEP',              $imovel['cep'],              PDO::PARAM_STR);
	    $stmte->bindValue('PRECO_VENDA',      $imovel['preco_venda'],      PDO::PARAM_STR);
	    $stmte->bindValue('PRECO_LOCACAO',    $imovel['preco_locacao'],    PDO::PARAM_STR);
	    $stmte->bindValue('PRECO_CONDOMINIO', $imovel['preco_condominio'], PDO::PARAM_STR);
	    $stmte->bindValue('AREA_UTIL',        $imovel['area_util'],        PDO::PARAM_STR);
	    $stmte->bindValue('AREA_TOTAL',       $imovel['area_total'],       PDO::PARAM_STR);
            $stmte->bindValue('AREA_COMUM',       $imovel['area_comum'],       PDO::PARAM_STR);
	    $stmte->bindValue('AREA_PRIVATIVA',   $imovel['area_privativa'],   PDO::PARAM_STR);
	    $stmte->bindValue('AREA_TERRENO',     $imovel['area_terreno'],     PDO::PARAM_STR);
	    $stmte->bindValue('AREA_CONSTRUIDA',  $imovel['area_construida'],  PDO::PARAM_STR);
	    $stmte->bindValue('QTD_DORMITORIO',   $imovel['qtd_dormitorio'],   PDO::PARAM_STR);
	    $stmte->bindValue('QTD_SUITE',        $imovel['qtd_suite'],        PDO::PARAM_STR);
	    $stmte->bindValue('QTD_BANHEIRO',     $imovel['qtd_banheiro'],     PDO::PARAM_STR);
	    $stmte->bindValue('QTD_SALA',         $imovel['qtd_sala'],         PDO::PARAM_STR);
	    $stmte->bindValue('QTD_VAGA',         $imovel['qtd_vaga'],         PDO::PARAM_STR);
	    $stmte->bindValue('PRIORIDADE',       $imovel['prioridade'],       PDO::PARAM_STR);
	    $stmte->bindValue('LATITUDE',         $imovel['latitude'],         PDO::PARAM_STR);
	    $stmte->bindValue('LONGITUDE',        $imovel['longitude'],        PDO::PARAM_STR);
	    $stmte->bindValue('OBSERVACAO',       $imovel['observacao'],       PDO::PARAM_STR);
	    $stmte->bindValue('VIDEO',            $imovel['video'],            PDO::PARAM_STR);
	    $stmte->bindValue('ID_IMOVEL',        $imovel['id_imovel'],        PDO::PARAM_INT);
            $stmte->bindValue('UF',               $imovel['uf'],               PDO::PARAM_STR);
            $stmte->bindValue('LAGRADOURO',       $imovel['lagradouro'],       PDO::PARAM_STR);
            $stmte->bindValue('PUBLICACOES',      $imovel['publicacoes'],      PDO::PARAM_STR);
            $stmte->bindValue('PROPRIETARIO',     $imovel['proprietario'],     PDO::PARAM_STR);
	    if ($stmte->execute()) {
	        $this->retorno['status'] = true;
	        print 'atualizado - ' . $imovel['id_imovel'] . '<hr />';
	    } else {
	        $this->retorno['status'] = false;
	        $this->retorno['erro'] = $this->conn->errorInfo();
	    }
	     
	    return $this->retorno;
	}
	
	private function sqlExcluirImovelFoto($imovel) {
	    $sql = 'DELETE FROM imovel_foto WHERE id_imovel = :ID_IMOVEL';
	    $stmte = $this->conn->prepare($sql);
	    $stmte->bindValue('ID_IMOVEL', $imovel['id_imovel'], PDO::PARAM_STR);
	    if ($stmte->execute()) {
	        $this->retorno['status'] = true;
	    } else {
	        $this->retorno['status'] = false;
	        $this->retorno['erro'] = $this->conn->errorInfo();
	    }

	    return $this->retorno;
	}
	
	private function salvarImovelFoto($idImovel, $nomeImovel, $urlImovel) {
	    
	    $dirImovel = getcwd() . '/../img/imovel/' . $idImovel;
	    if (!file_exists($dirImovel)) {
	        mkdir($dirImovel, 0777);
	        chmod($dirImovel, 0777);
	    } else {
	        chmod($dirImovel, 0777);
	    }

	    $arquivo = file_get_contents($urlImovel);
	    if (strlen($arquivo) > 0) {
	        file_put_contents($dirImovel . '/' .$nomeImovel . '.jpg', $arquivo);
	    } else {	        
	        copy(getcwd() . '/../img/sem_foto.jpg', $dirImovel . '/' .$nomeImovel . '.jpg');
	    }
	    
	    if (file_exists($dirImovel . '/' .$nomeImovel . '.jpg')) {
	        $this->retorno['status'] = true;
	        $this->retorno['url']    = 'img/imovel/' . $idImovel . '/' . $nomeImovel . '.jpg';
	    } else {
	        $this->retorno['status'] = false;
	    }
	    
	    return $this->retorno;
	}
	
	private function excluirImovelFoto($idImovel) {
	    $dirImovel = getcwd() . '/../img/imovel/' . $idImovel;
	    
	    chmod($dirImovel, 0777);
	    
	    $files = array_diff(scandir($dirImovel), array('.','..'));
	    foreach ($files as $file) {
	        (is_dir($dirImovel . '/' .$file)) ? delTree($dirImovel . '/' .$file) : unlink($dirImovel . '/' .$file);
	    }
	    
	    if (rmdir($dirImovel)) {
	        $this->retorno['status'] = true;
	    } else {
	        $this->retorno['status'] = false;
	        $this->retorno['erro']   = 'Não foi possível remover o diretorio do imovel. Codigo do imovel: ' . $idImovel;
	    }

	    return $this->retorno;
	}
}
?>