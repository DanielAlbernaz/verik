<?php


//Informações do Formalário
$nomedoformulario = 'Cadastrar serviços';
$acaodoformulario = 'index.php?acao=cadastrar&ctrl=servico';
$avisodoformulario = 'Esta página você cadastra os serviços.';

//Inicia o Formulário
$objForm->sk_iniciaFormulario($nomedoformulario,$acaodoformulario,$avisodoformulario);

$objForm->sk_formFileCrop("Banner",'imagem',false,'Tamanho 679px x 131px');

$objForm->sk_formText('Título','titulo','',true,'Aqui você coloca um titulo para o banner.');

$objForm->sk_formTextHTML('Texto','texto',true,'Aqui você escreve o texto.');

$objForm->sk_formText('Texto botão','texto_botao','',false,'Aqui você coloca um titulo para o banner.');

$objForm->sk_formText('Link botão','url','',false,'Link de redirecionamento para o botão.');

$objForm->sk_formTextPequeno('Ordem exibição','ordem','',true,'Ordem exibição EX: 0, 1, 2.');

$optionsAba[] = '<option value="0" selected="selected">Não</option>';
$optionsAba[] = '<option value="1" >Sim</option>';

$objForm->sk_formSelect('Abrir link na mesma aba?', 'abrir_mesma_aba', $optionsAba, true, 'Selecione uma opção');

$optionsPosition[] = '<option value="0" selected="selected">Inferior</option>';
$optionsPosition[] = '<option value="1" >Superior</option>';

$objForm->sk_formSelect('Exibir conteúdo', 'exibir_conteudo', $optionsPosition, true, 'Selecione uma opção');

//Cria status
$optionsStatus[] = '<option value=""></option>';
$optionsStatus[] = '<option value="1" selected="selected">Ativo</option>';
$optionsStatus[] = '<option value="0">Inativo</option>';

$objForm->sk_formSelect('Status', 'status', $optionsStatus, true, 'Selecione uma opção');


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
                        $('#jcrop').attr('src', e.target.result).width(679),
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
                    maxSize         : [ 679, 131 ],
                    setSelect       : [ 0, 0, 679, 131 ],                       
                    bgOpacity       : .3,
                    borderOpacity   : .9,
                    allowResize	: true,
                    aspectRatio: 679/131
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