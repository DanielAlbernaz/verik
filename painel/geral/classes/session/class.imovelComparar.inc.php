<?php
    include_once $path["classes"] ."class.Imovel.php";
    include_once $path["conexao"] ."class.conexao.php";
    include_once $path["classes"] ."class.uteis.php";


class ImovelComparar {
    private $idImovel;
    private $tipoImovel;
    private $finalidade;
    private $precoVenda;
    private $precoLocacao;
/*
    public function __construct() {        
        if(session_id() == ''){
            session_start();
            session_regenerate_id(true);
        }
    }*/
    public function adicionar($imoveis, $imoveisFoto){  
        
        $id = $imoveis->id;
        $tipo_imovel = $imoveis->tipo_imovel;
        $preco_venda = $imoveis->preco_venda;
        $preco_locacao = $imoveis->preco_locacao;
        $finalidade = $imoveis->finalidade;
        $area_util = $imoveis->area_util;
        $qtd_dormitorio = $imoveis->qtd_dormitorio;
        $qtd_sala = $imoveis->qtd_sala;
        $qtd_banheiro = $imoveis->qtd_banheiro;
        $qtd_suite = $imoveis->qtd_suite;
        $qtd_vaga = $imoveis->qtd_vaga;
        $foto = $imoveisFoto->url;
        $codigo_imovel = $imoveis->codigo_imovel;
        $bairro = $imoveis->bairro;
        $cidade = $imoveis->cidade;

 
        if(!isset($_SESSION['IMOVEL_COMPARAR']['CARRINHO']['\''.$id.'\''])){
            $_SESSION['IMOVEL_COMPARAR']['ID']['\''.$id.'\'']['id'] = $id;
            $_SESSION['IMOVEL_COMPARAR']['ID']['\''.$id.'\'']['tipo_imovel'] = $tipo_imovel;
            $_SESSION['IMOVEL_COMPARAR']['ID']['\''.$id.'\'']['preco_venda'] = $preco_venda;      
            $_SESSION['IMOVEL_COMPARAR']['ID']['\''.$id.'\'']['preco_locacao'] = $preco_locacao;    
            $_SESSION['IMOVEL_COMPARAR']['ID']['\''.$id.'\'']['finalidade'] = $finalidade; 
            $_SESSION['IMOVEL_COMPARAR']['ID']['\''.$id.'\'']['area_util'] = $area_util;  
            $_SESSION['IMOVEL_COMPARAR']['ID']['\''.$id.'\'']['qtd_dormitorio'] = $qtd_dormitorio;  
            $_SESSION['IMOVEL_COMPARAR']['ID']['\''.$id.'\'']['qtd_sala'] = $qtd_sala;  
            $_SESSION['IMOVEL_COMPARAR']['ID']['\''.$id.'\'']['qtd_banheiro'] = $qtd_banheiro;  
            $_SESSION['IMOVEL_COMPARAR']['ID']['\''.$id.'\'']['qtd_suite'] = $qtd_suite;  
            $_SESSION['IMOVEL_COMPARAR']['ID']['\''.$id.'\'']['qtd_vaga'] = $qtd_vaga;                
            $_SESSION['IMOVEL_COMPARAR']['ID']['\''.$id.'\'']['foto'] = $foto;
            $_SESSION['IMOVEL_COMPARAR']['ID']['\''.$id.'\'']['codigo_imovel'] = $codigo_imovel;
            $_SESSION['IMOVEL_COMPARAR']['ID']['\''.$id.'\'']['bairro'] = $bairro;
            $_SESSION['IMOVEL_COMPARAR']['ID']['\''.$id.'\'']['cidade'] = $cidade;
        }     
        return true;
    }

    public function getImovelItems(){
        return $_SESSION['IMOVEL_COMPARAR']['ID'];
    }

    public function excluirTodosImoveis(){
        unset($_SESSION['IMOVEL_COMPARAR']['ID']);
    }

    public function remover($id){
        unset($_SESSION['IMOVEL_COMPARAR']['ID']['\''.$id.'\'']);
    }

}




?>