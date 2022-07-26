<?php
    include_once $path["classes"] ."class.Produto.php";
    include_once $path["conexao"] ."class.conexao.php";
    include_once $path["classes"] ."class.uteis.php";


class ProdutoCarrinho {
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
    public function adicionar($produto){ 
        $id = $produto->produto_id;
        $qtdProduto = $produto->qtd;
        $foto = $produto->foto;
        $nome = $produto->nome;
        $marca = $produto->marca;
        $preco = $produto->preco_venda;
        $precoTotal = $produto->precoTotal;

 
        if(!isset($_SESSION['PRODUTO_CARRINHO']['CARRINHO']['\''.$id.'\''])){
            $_SESSION['PRODUTO_CARRINHO']['ID']['\''.$id.'\'']['id'] = $id;
            $_SESSION['PRODUTO_CARRINHO']['ID']['\''.$id.'\'']['qtd'] = $qtdProduto;
            $_SESSION['PRODUTO_CARRINHO']['ID']['\''.$id.'\'']['foto'] = $foto;
            $_SESSION['PRODUTO_CARRINHO']['ID']['\''.$id.'\'']['nome'] = $nome;
            $_SESSION['PRODUTO_CARRINHO']['ID']['\''.$id.'\'']['marca'] = $marca;
            $_SESSION['PRODUTO_CARRINHO']['ID']['\''.$id.'\'']['preco'] = $preco;
            $_SESSION['PRODUTO_CARRINHO']['ID']['\''.$id.'\'']['preco_total'] = $precoTotal;
        }     
        return true;
    }

    public function adicionarTotal($produto){ 
        $id = $produto->produto_id;
        $total = $produto->totalProdutos;

 
        if(!isset($_SESSION['PRODUTO_CARRINHO']['CARRINHO']['\''.$id.'\''])){
            $_SESSION['PRODUTO_CARRINHO']['TOTAL']['ID']['\''.$id.'\'']['id'] = $id;
            $_SESSION['PRODUTO_CARRINHO']['TOTAL']['ID']['\''.$id.'\'']['total_produtos'] = $total;
        }     
        return true;
    }

    public function getProdutoItems(){
        return $_SESSION['PRODUTO_CARRINHO']['ID'];
    }

    public function getProdutoItem($id){
        return $_SESSION['PRODUTO_CARRINHO']['ID']['\''.$id.'\''];
    }

    public function getTotalProdutos(){
        $id = 'total';
        return $_SESSION['PRODUTO_CARRINHO']['TOTAL']['ID']['\''.$id.'\''];
    }

    public function excluirTodosImoveis(){
        unset($_SESSION['PRODUTO_CARRINHO']['ID']);
    }

    public function remover($id){
        unset($_SESSION['PRODUTO_CARRINHO']['ID']['\''.$id.'\'']);
    }

}




?>