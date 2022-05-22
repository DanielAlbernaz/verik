<?php
//Dados da Tabela
$dadosDaTabela = array(
    0 => 'ID',
    1 => 'CÓDIGO PRODUTO',
    2 => 'NOME PRODUTO',
    3 => 'IMAGEM',
    4 => 'DT CADASTO',
    5 => 'DT. INÍCIO EXIBIÇÃO',
    6 => 'DT. FIM EXIBIÇÃO',
);



for($i=0;$i<$produtos["num"];$i++){
	$produtos[$i]->imagem_principal = '<img height="50" src="'.$produtos[$i]->imagem_principal.'"/>';
    $data = $objUteis->dataHora($produtos[$i]->dhcadastro);
    $hora_cadastro = explode(':',$data['hora']); 
    if($produtos[$i]->dhcadastro){
        $produtos[$i]->dhcadastro = $data['data'].' - '.$hora_cadastro[0].':'.$hora_cadastro[1];
    }
    $data_exibicao = $objUteis->dataHora($produtos[$i]->data_inicio_exibicao);
    $hora_exibicao = explode(':',$data_exibicao['hora']);
    if($produtos[$i]->data_inicio_exibicao){
        $produtos[$i]->data_inicio_exibicao = $data_exibicao['data'].' - '.$hora_exibicao[0].':'.$hora_exibicao[1];
    }
    $data_expiracao = $objUteis->dataHora($produtos[$i]->data_expiracao);
    $hora_expiracao = explode(':',$data_expiracao['hora']);
    if($produtos[$i]->data_expiracao != '0000-00-00 00:00:00' && $produtos[$i]->data_expiracao != NULL && $produtos[$i]->data_expiracao != 0){
        $produtos[$i]->data_expiracao = $data_expiracao['data'].' - '.$hora_expiracao[0].':'.$hora_expiracao[1];
    }else{
        $produtos[$i]->data_expiracao = '';
    }        
        
        
}

//Campos para puxar na listagem
$campos = array(
    0 => 'id',
    1 => 'codigo_produto',
    2 => 'nome_produto',
    3 => 'imagem_principal',
    4 => 'dhcadastro',
    5 => 'data_inicio_exibicao',
    6 => 'data_expiracao',
);

$publicar = 0;
$alterar = 0;
$excluir = 0;

/**
 * Verifica a permissÃ£o do usuÃ¡rio
 */
if($permissao->publicar=="1"){
    $publicar = 1;
}
if($permissao->alterar=="1"){
    $alterar = 1;
}
if($permissao->excluir=="1"){
    $excluir = 1;
}

//Inicia a listagem do formulário
$objForm->sk_formListar('Produto',$dadosDaTabela,$produtos,$campos,'produto',$publicar,$alterar,$excluir);

?>
<div>
    <a href="index.php?acao=frmCad&ctrl=produto" title="" class="button greenB" style="margin: 40px 5px 5px 0px; float: right;"><span>Cadastrar novo</span></a>
</div>