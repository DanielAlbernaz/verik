<?php
//Dados da Tabela
$dadosDaTabela = array(
    0 => 'ID',
    1 => 'ORDEM',
    2 => 'TITULO',
    3 => 'IMAGEM',
    4 => 'DT CADASTO',
    5 => 'DT. INÍCIO EXIBIÇÃO',
    6 => 'DT. FIM EXIBIÇÃO',

);

for($i=0;$i<$banners["num"];$i++){
	$banners[$i]->imagem = '<img height="50" src="'.$banners[$i]->imagem.'"/>';
    $data = $objUteis->dataHora($banners[$i]->dhcadastro);
    $hora_cadastro = explode(':',$data['hora']);
    if($banners[$i]->dhcadastro){
        $banners[$i]->dhcadastro = $data['data'].' - '.$hora_cadastro[0].':'.$hora_cadastro[1];
    }
    $data_exibicao = $objUteis->dataHora($banners[$i]->data_inicio_exibicao);
    $hora_exibicao = explode(':',$data_exibicao['hora']);
    if($banners[$i]->data_inicio_exibicao){
        $banners[$i]->data_inicio_exibicao = $data_exibicao['data'].' - '.$hora_exibicao[0].':'.$hora_exibicao[1];
    }
    $data_expiracao = $objUteis->dataHora($banners[$i]->data_expiracao);
    $hora_expiracao = explode(':',$data_expiracao['hora']);
    if($banners[$i]->data_expiracao != '0000-00-00 00:00:00' && $produtos[$i]->data_expiracao != 0){
        $banners[$i]->data_expiracao = $data_expiracao['data'].' - '.$hora_expiracao[0].':'.$hora_expiracao[1];
    }else{
        $banners[$i]->data_expiracao = '';
    }       
}


//Campos para puxar na listagem
$campos = array(
    0 => 'id',
    1 => 'ordem',
    2 => 'titulo',
    3 => 'imagem',
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
$objForm->sk_formListar('Banners',$dadosDaTabela,$banners,$campos,'banner',$publicar,$alterar,$excluir);

?>
 
 <div>

<a href="index.php?acao=frmCad&ctrl=banner" title="" class="button greenB" style="margin: 40px 5px 5px 0px; float: right;"><span>Cadastrar novo</span></a>

</div>