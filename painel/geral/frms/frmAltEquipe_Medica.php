    
<?php


//Informações do Formalário
$nomedoformulario = 'Alterar a equipe médica';
$acaodoformulario = 'index.php?acao=alterar&ctrl=equipe_medica';
$avisodoformulario = 'Esta página você altera a equipe médica';

//Inicia o Formulário
$objForm->sk_iniciaFormulario($nomedoformulario,$acaodoformulario,$avisodoformulario);

//Cria um input text
$objForm->sk_formText('Nome','nome','',true,'Aqui informa o nome do Médico.', $equipeMedicaForm->nome);

$objForm->sk_formText('CRM','crm','',false,'Aqui informa o número de crm.', $equipeMedicaForm->crm);

$objForm->sk_formText('Especialidade','especialidade','',false,'Aqui informa a especialidade.', $equipeMedicaForm->especialidade);

//$objForm->sk_formTextHtml('Especialidades', 'especialidade', true, 'Aqui você informa a especialidade do Médico.', $equipeMedicaForm->especialidade);

$objForm->sk_formTextArea('Formações', 'formacoes', '', true, 'Aqui você informa as formações.', $equipeMedicaForm->formacoes);

$objForm->sk_formFileCrop("Imagem",'imagem',false, 'Resolução sugerida - 427px X 491px', $equipeMedicaForm->imagem);

echo'<div class="title"><img src="images/icons/dark/fullscreen.png" alt="" class="titleIcon"><h6>Selecione os Convênios</h6></div>';  
$y = 0;
for($i=0; $i < $convenios['num']; $i++){
    if($conveniosMedico[$y]->id_convenio == $convenios[$i]->id){
        $objForm->sk_formCheckbox($convenios[$i]->titulo, 'convenios[]', 'checked', false, 'Escolha os Convênios', $convenios[$i]->id);
        $y++;
    }else{
        $objForm->sk_formCheckbox($convenios[$i]->titulo, 'convenios[]', '', false, 'Escolha os Convênios', $convenios[$i]->id);
    }
}

$objForm->sk_formTextPequeno('Ordem exibição','ordem','',true,'Ordem exibição EX: 0, 1, 2.',$equipeMedicaForm->ordem);
//Status
$optionsStatus[] = '<option value="1"'. ($equipeMedicaForm->status == 1 ? 'selected="selected"' : '' ).'>Ativo</option>';
$optionsStatus[] = '<option value="0"'. ($equipeMedicaForm->status == 0 ? 'selected="selected"' : '' ).'>Inativo</option>';

$objForm->sk_formSelect('Status', 'status', $optionsStatus, true, 'Selecione uma opção');

$objForm->sk_formDataHoras('Data de cadastro','dhcadastro',false,'Deixe o campo em branco caso queria que seja a data atual.' ,$objUteis->converteDataHora($equipeMedicaForm->dhcadastro));

echo'<div class="title"><img src="images/icons/dark/fullscreen.png" alt="" class="titleIcon"><h6>Período de exibição</h6></div>';
        
$objForm->sk_formDataHoras('Data início para exibição','data_inicio_exibicao',false,'Data em que a notícia começara a ser exibida. Deixe o campo em branco caso queria que seja imediatamente.',($equipeMedicaForm->data_inicio_exibicao != 0 ? $objUteis->converteDataHora($equipeMedicaForm->data_inicio_exibicao): ''));

$objForm->sk_formDataHoras('Data máxima para exibição','data_expiracao',false,'Data em que a notícia deixará de ser exibida. Deixe o campo em branco caso queria que seja exibido por um período indeterminado.',($equipeMedicaForm->data_expiracao != 0 ? $objUteis->converteDataHora($equipeMedicaForm->data_expiracao) : ''));



//Cria um input hidden
$objForm->sk_formHidden('id',$equipeMedicaForm->id);

$objForm->sk_formHidden('imgAntiga',$equipeMedicaForm->imagem);

//Verfica se o usuário e Administrador
if($permissao->alterar == 1){
    //Cria um input submit
    $objForm->sk_formSubmit();
}

//Final do Formulário
$objForm->sk_fimDoFormulario();

?>


<!-- Script para recorte da imagem. É necessário colocar esse script em todos os formulários que forem utilizar recorte para que seja informado o tamanho da imagem -->
<script>

            $( "#img" ).click(function() {
                $("#jcrop").remove();
                $(".jcrop-holder").remove();
                $(".imgPreview .formRight").append("<img id='jcrop'/>");
            });

            function preview(input){
                if (input.files && input.files[0]){
                    var reader = new FileReader(); 
                    reader.onload = function(e){
                        $('#jcrop').attr('src', e.target.result).width(378),
                        cropImg()
                    };
                    reader.readAsDataURL(input.files[0]);                    
                    $(".imgPreview").show();
                }
            }; 

            function cropImg(){        
                $('#jcrop').Jcrop({
                    onChange: exibePreview,
                    onSelect: exibePreview,
                    bgColor         : 'white',
                    minSize         : [ 100, 100 ],
                    maxSize         : [ 378, 350 ],
                    setSelect       : [ 0, 0, 378, 350 ],                      
                    bgOpacity       : .3,
                    borderOpacity   : .9,
                    allowResize	: true,
                    aspectRatio: 378/350
                });        
            };

            function exibePreview(c){            
                $('#x').val(c.x);
                $('#y').val(c.y);
                $('#x2').val(c.x2);
                $('#y2').val(c.y2);
                $('#w').val(c.w);
                $('#h').val(c.h);
            };    

</script>