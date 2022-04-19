    
<?php


//Informações do Formalário
$nomedoformulario = 'Alterar o avaliações';
$acaodoformulario = 'index.php?acao=alterar&ctrl=avaliacoes';
$avisodoformulario = 'Esta página você altera o avaliações';

//Inicia o Formulário
$objForm->sk_iniciaFormulario($nomedoformulario,$acaodoformulario,$avisodoformulario);

for($i=0; $i < $equipeMedica['num']; $i++){    
    if($equipeMedica[$i]->id == $avaliacoesForm->id_medico){             
        $nome = $equipeMedica[$i]->nome;
    }   
}   
$optionsPagina[] = '<option value="" ></option>';
$optionsPagina[] = '<option value='.$avaliacoesForm->id_medico.' selected="selected" >'.$nome.'</option>';
foreach($equipeMedica as $key => $val){
    if($val->id <> NULL){
        if($val->id <> $avaliacoesForm->id_medico){
            $optionsPagina[] = '<option value='.$val->id.'>'.$val->nome.'</option>';
        }       
    }   
}

$objForm->sk_formSelect('Médico', 'id_medico', $optionsPagina, true, 'Selecione um médico.');

$optionsNota[] = '<option value="5"'. ($avaliacoesForm->nota_avaliacao == 5 ? 'selected="selected"' : '' ).'>5 Estrelas</option>';
$optionsNota[] = '<option value="4"'. ($avaliacoesForm->nota_avaliacao == 4 ? 'selected="selected"' : '' ).'>4 Estrelas</option>';
$optionsNota[] = '<option value="3"'. ($avaliacoesForm->nota_avaliacao == 3 ? 'selected="selected"' : '' ).'>3 Estrelas</option>';
$optionsNota[] = '<option value="2"'. ($avaliacoesForm->nota_avaliacao == 2 ? 'selected="selected"' : '' ).'>2 Estrelas</option>';
$optionsNota[] = '<option value="1"'. ($avaliacoesForm->nota_avaliacao == 1 ? 'selected="selected"' : '' ).'>1 Estrelas</option>';

$objForm->sk_formSelect('Nota avaliação', 'nota_avaliacao', $optionsNota, true, 'Selecione uma avaliação.');

$objForm->sk_formText('Nome','nome','',true,'Aqui você insere um nome.',$avaliacoesForm->nome);

$objForm->sk_formTextHTML('Texto','texto',true,'Aqui você alterar o texto.',$avaliacoesForm->texto);

$objForm->sk_formFileCrop("Imagem",'imagem',false,'Tamanho da imagem do banner 95px x 95px',$bannerForm->imagem);

$objForm->sk_formData('Data da avaliação','dhavaliacao',true,'Aqui você informa a data da avaliação.',$objUteis->converteData($avaliacoesForm->dhavaliacao));

$objForm->sk_formTextPequeno('Ordem exibição','ordem','',true,'Ordem exibição EX: 0, 1, 2.',$avaliacoesForm->ordem);
//Status
$optionsStatus[] = '<option value="1"'. ($avaliacoesForm->status == 1 ? 'selected="selected"' : '' ).'>Ativo</option>';
$optionsStatus[] = '<option value="0"'. ($avaliacoesForm->status == 0 ? 'selected="selected"' : '' ).'>Inativo</option>';

$objForm->sk_formSelect('Status', 'status', $optionsStatus, true, 'Selecione uma opção');

$objForm->sk_formDataHoras('Data de cadastro','dhcadastro',false,'Deixe o campo em branco caso queria que seja a data atual.' ,$objUteis->converteDataHora($avaliacoesForm->dhcadastro));

echo'<div class="title"><img src="images/icons/dark/fullscreen.png" alt="" class="titleIcon"><h6>Período de exibição</h6></div>';
        
$objForm->sk_formDataHoras('Data início para exibição','data_inicio_exibicao',false,'Data em que a notícia começara a ser exibida. Deixe o campo em branco caso queria que seja imediatamente.',($avaliacoesForm->data_inicio_exibicao != 0 ? $objUteis->converteDataHora($avaliacoesForm->data_inicio_exibicao): ''));

$objForm->sk_formDataHoras('Data máxima para exibição','data_expiracao',false,'Data em que a notícia deixará de ser exibida. Deixe o campo em branco caso queria que seja exibido por um período indeterminado.',($avaliacoesForm->data_expiracao != 0 ? $objUteis->converteDataHora($avaliacoesForm->data_expiracao) : ''));



//Cria um input hidden
$objForm->sk_formHidden('id',$avaliacoesForm->id);

$objForm->sk_formHidden('imgAntiga',$avaliacoesForm->imagem);

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
                        $('#jcrop').attr('src', e.target.result).width(95),
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
                    minSize         : [ 95, 95 ],
                    maxSize         : [ 95, 95 ],
                    setSelect       : [ 0, 0, 95, 95 ],                   
                    bgOpacity       : .3,
                    borderOpacity   : .9,
                    allowResize	: true,
                    aspectRatio: 95/95
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