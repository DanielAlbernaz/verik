<?php

$optionsTreinamento[] = '<option value="" >SELECIONE</option>';
for($i = 0 ; $i < $treinamento['num']; $i++){
    $optionsTreinamento[] = '<option value="'.$treinamento[$i]->id.'" '.($treinamento[$i]->id == $idTreinamento ? 'selected="selected"' : '').' >'.$treinamento[$i]->titulo.'</option>';
}
$objForm->sk_formSelectMaior('Selecione um treinamento', 'id_treinamento_live" onchange="carregarListaEmailTreinamentoPresencial(this.value); ', $optionsTreinamento, false, 'Selecione uma opção');


//Dados da Tabela
$dadosDaTabela = array(
    0 => 'ID',
    1 => 'NOME', 
    2 => 'EMAIL', 
    3 => 'DATA INSCRIÇÃO', 
);

for($i=0;$i<$inscritos["num"];$i++){	
    $inscritos[$i]->data_inscricao = $objUteis->converteDataHora($inscritos[$i]->data_inscricao);
}

//Campos para puxar na listagem
$campos = array(
    0 => 'id',
    1 => 'nome',
    2 => 'email',
    3 => 'data_inscricao',
);

$publicar = 0;
$alterar = 0;
$excluir = 0;

if($permissao->publicar=="1"){
    $publicar = 0;
}
if($permissao->alterar=="1"){
    $alterar = 0;
}
if($permissao->excluir=="1"){
    $excluir = 0;
}

//Inicia a listagem do formulário
if (isset($_GET['id_treinamento_presencial']) && !empty($_GET['id_treinamento_presencial'])) {
    $objForm->sk_formListar('Inscritos',$dadosDaTabela,$inscritos,$campos,'lista_inscritos');    
   
echo'
    <div style="clear: both;"></div>
    <div style="float: left; margin: 10px 45px;">
      <a style="padding: 8px;" href="index.php?acao=inscricao_csv&ctrl=lista_inscritos_presencial&id_treinamento_presencial='.$_GET["id_treinamento_presencial"].'" id="buttonTodos" class="button greyishB">Exportar CSV</a>
    </div>';

echo'
    <div style="float: left; margin: 10px -15px;">
      <a style="padding: 8px;" onClick="chamarEsperar();" href="index.php?acao=enviar_email&ctrl=lista_inscritos_presencial&id_treinamento_presencial='.$_GET["id_treinamento_presencial"].'"  id="buttonTodos" class="button greyishB">Enviar email aos inscritos</a>
    </div>';
}

if(isset($_GET['id_status']) && !empty($_GET['id_status'])){
    echo"
        <script>
        $(document).ready(function() {
            showNotification({
                message: 'Emails enviados com sucesso!',
                autoClose: true,
                duration: 1,
                type: 'success'
            });
        });
        </script>
    ";
}
?>
<script>
    function chamarEsperar(){
        showNotification({
            message: 'Aguarde estamos enviando os emails...',
            autoClose: true,
            duration: 30,
            type: 'information'
        });        
    }

</script>