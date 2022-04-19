<?php
//Dados da Tabela
$dadosDaTabela = array(
    0 => 'ID',
    1 => 'Filial',
    2 => 'IMAGEM',
    3 => 'DT CADASTO',
    4 => 'DT. INÍCIO EXIBIÇÃO',
    5 => 'DT. FIM EXIBIÇÃO',
);

for($i=0;$i<$filiais["num"];$i++){
	$filiais[$i]->imagem = '<img height="50" src="'.$filiais[$i]->imagem.'"/>';
    $data = $objUteis->dataHora($filiais[$i]->dhcadastro);
    $hora_cadastro = explode(':',$data['hora']); 
    if($filiais[$i]->dhcadastro){
        $filiais[$i]->dhcadastro = $data['data'].' - '.$hora_cadastro[0].':'.$hora_cadastro[1];
    }
    $data_exibicao = $objUteis->dataHora($filiais[$i]->data_inicio_exibicao);
    $hora_exibicao = explode(':',$data_exibicao['hora']);
    if($filiais[$i]->data_inicio_exibicao){
        $filiais[$i]->data_inicio_exibicao = $data_exibicao['data'].' - '.$hora_exibicao[0].':'.$hora_exibicao[1];
    }
    $data_expiracao = $objUteis->dataHora($filiais[$i]->data_expiracao);
    $hora_expiracao = explode(':',$data_expiracao['hora']);
    if($filiais[$i]->data_expiracao != '0000-00-00 00:00:00' && $filiais[$i]->data_expiracao != NULL && $filiais[$i]->data_expiracao != 0){
        $filiais[$i]->data_expiracao = $data_expiracao['data'].' - '.$hora_expiracao[0].':'.$hora_expiracao[1];
    }else{
        $filiais[$i]->data_expiracao = '';
    }     
    
    for($a = 0; $a < $filialApi['num']; $a++){
        if($filialApi[$a]->id == $filiais[$i]->filial){
            $filiais[$i]->filial = $filialApi[$a]->nome;
        }        
    }

}

//Campos para puxar na listagem
$campos = array(
    0 => 'id',
    1 => 'filial',
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
$objForm->sk_formListar('Filial',$dadosDaTabela,$filiais,$campos,'filial',$publicar,$alterar,$excluir);

?>
<div>
    <a href="index.php?acao=frmCad&ctrl=filial" title="" class="button greenB" style="margin: 40px 5px 5px 0px; float: right;"><span>Cadastrar novo</span></a>
</div>