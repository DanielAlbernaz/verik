<?php


//Informações do Formalário
$nomedoformulario = 'Cadastrar avaliações';
$acaodoformulario = 'index.php?acao=cadastrar&ctrl=avaliacoes';
$avisodoformulario = 'Esta página você cadastra as avaliações.';

//Inicia o Formulário
$objForm->sk_iniciaFormulario($nomedoformulario,$acaodoformulario,$avisodoformulario);

$optionsCategorias[] = '<option value="" selected="selected"></option>';
for($v=0; $v < $equipeMedica['num']; $v++){
    $optionsCategorias[] = '<option value='.$equipeMedica[$v]->id.'>'.$equipeMedica[$v]->nome.'</option>';
}
$objForm->sk_formSelect('Médico', 'id_medico', $optionsCategorias, true, 'Selecione um médico.');


$optionsNota[] = '<option value="5" selected="selected">5 Estrelas</option>';
$optionsNota[] = '<option value="4" >4 Estrelas</option>';
$optionsNota[] = '<option value="3" >3 Estrelas</option>';
$optionsNota[] = '<option value="2" >2 Estrelas</option>';
$optionsNota[] = '<option value="1" >1 Estrelas</option>';
$objForm->sk_formSelect('Nota avaliação', 'nota_avaliacao', $optionsNota, true, 'Selecione uma avaliação.');


$objForm->sk_formText('Nome','nome','',true,'Aqui você insere um nome.');

$objForm->sk_formTextHTML('Texto','texto',true,'Aqui você alterar o texto.');

$objForm->sk_formData('Data da avaliação','dhavaliacao',true,'Aqui você informa a data da avaliação.');

$objForm->sk_formTextPequeno('Ordem exibição','ordem','',true,'Ordem exibição EX: 0, 1, 2.');

//Cria status
$optionsAba[] = '<option value=""></option>';
$optionsAba[] = '<option value="1" selected="selected">Ativo</option>';
$optionsAba[] = '<option value="0">Inativo</option>';

$objForm->sk_formSelect('Status', 'status', $optionsAba, true, 'Selecione uma opção');

$objForm->sk_formDataHoras('Data de cadastro','dhcadastro',false,'Deixe o campo em branco caso queria que seja a data atual.');

echo'<div class="title"><img src="images/icons/dark/fullscreen.png" alt="" class="titleIcon"><h6>Período de exibição</h6></div>';
        
$objForm->sk_formDataHoras('Data início para exibição','data_inicio_exibicao',false,'Data em que a notícia começara a ser exibida. Deixe o campo em branco caso queria que seja imediatamente.');

$objForm->sk_formDataHoras('Data máxima para exibição','data_expiracao',false,'Data em que a notícia deixará de ser exibida. Deixe o campo em branco caso queria que seja exibido por um período indeterminado.');


//Verfica se o usuário e Administrador
if($permissao->cadastrar == 1){
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
                        $('#jcrop').attr('src', e.target.result).width(1000),
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
                    maxSize         : [ 1000, 667 ],
                    setSelect       : [ 0, 0, 1000, 667 ],                       
                    bgOpacity       : .3,
                    borderOpacity   : .9,
                    allowResize	: true,
                    aspectRatio: 1000/667
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