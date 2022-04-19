<form id="validate" method="post" action="index.php?acao=exportar&amp;ctrl=ouvidoria" target="iframeCadForms" name="frmCadFormulario" enctype="multipart/form-data">



<input type="text" style="display: none" value="<?=$idCargo?>" id="cargoCandidatosEmprego" name="cargoCandidatosEmprego" class="cargoCandidatosEmprego">
<input type="text" style="display: none" value="" id="deletar" name="deletar" class="deletar">


<?php
//Dados da Tabela
$dadosDaTabela = array(
    0 => '',
    1 => 'ID',
    2 => 'NOME',
    3 => 'DATA AGENDAMENTO',
    4 => 'HORÁRIO',  
    5 => 'MÉDICO',
    6 => 'ESPECIALIDADE',
    7 => 'EMAIL',
    8 => 'TELEFONE' 

);

for($i=0;$i<$forms["num"];$i++){  

        $forms[$i]->check = '<input name="check[]" id="check_'.$i.'" class="checkCurriculo" onclick="validaButton();    " type="checkbox" value="'.$forms[$i]->id.'"/>';
        $dataHora = $objUteis->dataHora($forms[$i]->data_envio);
        $forms[$i]->data_envio = $dataHora['data'].' '.$dataHora['hora'];      
	
        $link = '<a href="javascript:;" class="tipS" onclick="confirmVisualizarInscricao(\'index.php?acao=visualizar&ctrl=forms_consulta&id=' . $forms[$i]->id . '&visualizado=' . $forms[$i]->visualizado . '\',\'index.php?acao=listar&ctrl=forms_consulta\');">';
        $link .= ($forms[$i]->visualizado ? '<img src="images/icons/visualizado_S.png" title="Formulário não visualizado. Clique para marcá-lo como visualizado." class="tipS" />' : '<img src="images/icons/visualizado_N.png" title="Formulário não visualizado. Clique para marcá-lo como visualizado." class="tipS"/>');
        $link .= '</a>';

	$forms[$i]->visualizado = $link;
        if($forms[$i]->data_alteracao){
            $dataHora = $objUteis->dataHora($forms[$i]->data_alteracao);
            $forms[$i]->data_alteracao = $dataHora['data'].' '.date('H:i', strtotime($dataHora['hora']));
        }
}

//Campos para puxar na listagem
$campos = array(
    0 => 'check',
    1 => 'id',
    2 => 'nome',
    3 => 'data_agendamento',
    4 => 'horario',
    5 => 'medico',
    6 => 'especialidade',
    7 => 'email',
    8 => 'telefone'

    );

$publicar = 0;
$alterar = 0;
$excluir = 0;

if($permissao->publicar=="1"){
    $publicar = 0;
}
if($permissao->alterar=="1"){
    $alterar = 1;
}
if($permissao->excluir=="1"){
    $excluir = 1;
}

//Inicia a listagem do formulário
$objForm->sk_formListar('Ouvidoria',$dadosDaTabela,$forms,$campos,'ouvidoria',$publicar,$alterar,$excluir); 
?>


<div style="clear: both;"></div>
  <div style="float: left; margin: 5px 50px;">
      <button type="button" onclick="baixarSelecionados();" class="button blueB">Exportar CSV</button>

      <button onclick="exportarTodos();" id="buttonTodos" style="margin-left: 10px;" class="button blueB">Exportar CSV Todos</button>
</div>

 
</form>


<script>
    function exportarTodos(){
        $('#deletar').val('true');
    }

    function baixarSelecionados(){

        var check = document.getElementsByClassName("checkCurriculo");
        var cont = 0;

        for (var i=0;i<check.length;i++){ 
            if (check[i].checked == true){ 
            cont++;
            }  
        } 

        if(cont > 0){
        //Faz o submit do formulário
        if($('#validate').submit()){
        }
    }else{
        showNotification({
            message: 'Selecione algum contato',
            autoClose: true,
            duration: 5,
            type: "error"
        }); 
    } 

    }

    function validaButton(){
        var check = document.getElementsByClassName("checkCurriculo");
        var cont = 0;
        for (var i=0;i<check.length;i++){ 
            if (check[i].checked == true){ 
            cont++;
            }  
        }  

        if(cont > 0){
            document.getElementById("buttonTodos").style.display = "none";
        }if(cont == 0){
            document.getElementById("buttonTodos").style.display = "initial";
    }
}

</script>