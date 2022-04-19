<?php
//Dados da Tabela
$dadosDaTabela = array(
    0 => 'ID',
    1 => 'TITULO',
    2 => 'DATA EXIBIÇÃO',
    3 => 'ORDEM'

);

for($i=0;$i<$menuServicos["num"];$i++){
	$menuServicos[$i]->imagem = '<img height="50" src="'.$menuServicos[$i]->imagem.'"/>';
    $data = $objUteis->dataHora($menuServicos[$i]->dhcadastro);
    $hora_cadastro = explode(':',$data['hora']);
    if($menuServicos[$i]->dhcadastro){
        $menuServicos[$i]->dhcadastro = $data['data'].' - '.$hora_cadastro[0].':'.$hora_cadastro[1];
    }
    $data_exibicao = $objUteis->dataHora($menuServicos[$i]->data_inicio_exibicao);
    $hora_exibicao = explode(':',$data_exibicao['hora']);
    if($menuServicos[$i]->data_inicio_exibicao){
        $menuServicos[$i]->data_inicio_exibicao = $data_exibicao['data'].' - '.$hora_exibicao[0].':'.$hora_exibicao[1];
    }
    $data_expiracao = $objUteis->dataHora($menuServicos[$i]->data_expiracao);
    $hora_expiracao = explode(':',$data_expiracao['hora']);
    if($menuServicos[$i]->data_expiracao != '0000-00-00 00:00:00'){
        $menuServicos[$i]->data_expiracao = $data_expiracao['data'].' - '.$hora_expiracao[0].':'.$hora_expiracao[1];
    }else{
        $menuServicos[$i]->data_expiracao = '';
    }               
        
}

//Campos para puxar na listagem
$campos = array(
    0 => 'id',
    1 => 'titulo',
    2 => 'data_inicio_exibicao',
    3 => 'ordem'
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
$objForm->sk_formListar('Menu Serviços',$dadosDaTabela,$menuServicos,$campos,'menu_servico',$publicar,$alterar,$excluir);

?>
 
 <div>

<a href="index.php?acao=frmCad&ctrl=menu_servico" title="" class="button greenB" style="margin: 40px 5px 5px 0px; float: right;"><span>Cadastrar novo</span></a>

</div>