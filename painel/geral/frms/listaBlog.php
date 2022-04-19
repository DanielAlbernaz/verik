<?php
//Dados da Tabela
$dadosDaTabela = array(
    0 => 'ID',
    1 => 'TITULO',
    2 => 'IMAGEM',
    3 => 'DT CADASTO',
    4 => 'DT. INÍCIO EXIBIÇÃO',
    5 => 'DT. FIM EXIBIÇÃO',
);



for($i=0;$i<$blogs["num"];$i++){
	$blogs[$i]->imagem = '<img height="50" src="'.$blogs[$i]->imagem.'"/>';
    $data = $objUteis->dataHora($blogs[$i]->dhcadastro);
    $hora_cadastro = explode(':',$data['hora']); 
    if($blogs[$i]->dhcadastro){
        $blogs[$i]->dhcadastro = $data['data'].' - '.$hora_cadastro[0].':'.$hora_cadastro[1];
    }
    $data_exibicao = $objUteis->dataHora($blogs[$i]->data_inicio_exibicao);
    $hora_exibicao = explode(':',$data_exibicao['hora']);
    if($blogs[$i]->data_inicio_exibicao){
        $blogs[$i]->data_inicio_exibicao = $data_exibicao['data'].' - '.$hora_exibicao[0].':'.$hora_exibicao[1];
    }
    $data_expiracao = $objUteis->dataHora($blogs[$i]->data_expiracao);
    $hora_expiracao = explode(':',$data_expiracao['hora']);
    if($blogs[$i]->data_expiracao != '0000-00-00 00:00:00' && $blogs[$i]->data_expiracao != NULL && $blogs[$i]->data_expiracao != 0){
        $blogs[$i]->data_expiracao = $data_expiracao['data'].' - '.$hora_expiracao[0].':'.$hora_expiracao[1];
    }else{
        $blogs[$i]->data_expiracao = '';
    }        
        
        
}

//Campos para puxar na listagem
$campos = array(
    0 => 'id',
    1 => 'titulo',
    2 => 'imagem',
    3 => 'dhcadastro',
    4 => 'data_inicio_exibicao',
    5 => 'data_expiracao',
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
$objForm->sk_formListar('Blog',$dadosDaTabela,$blogs,$campos,'blog',$publicar,$alterar,$excluir);

?>
<div>
    <a href="index.php?acao=frmCad&ctrl=blog" title="" class="button greenB" style="margin: 40px 5px 5px 0px; float: right;"><span>Cadastrar novo</span></a>
</div>