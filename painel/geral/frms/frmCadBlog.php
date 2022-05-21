<?php

//Informações do Formalário
$nomedoformulario = 'Cadastrar Dicas e novidades';
$acaodoformulario = 'index.php?acao=cadastrar&ctrl=blog';
$avisodoformulario = 'Esta página você cadastra os Artigos para o dicas e novidades.';

//Inicia o Formulário
$objForm->sk_iniciaFormulario($nomedoformulario,$acaodoformulario,$avisodoformulario);

//Cria um input text
$objForm->sk_formText('Título','titulo','',true,'Aqui você coloca um titulo para o dicas e novidades.');

//Monta o array com as categorias cadastradas no banco
$optionsCategoria[] = '<option value="" selected="selected"></option>';
for($i=0; $i < count($categoria) -1; $i++){
    $optionsCategoria[] = '<option value='.$categoria[$i]->id.'>'.$categoria[$i]->nome.'</option>';
}

$objForm->sk_formSelect('Categoria', 'id_categoria', $optionsCategoria, true, 'Selecione uma categoria');

//Cria o Texto de descrição
$objForm->sk_formTextHTML('Texto','texto',true,'Aqui você escreve o texto.');

$objForm->sk_formFileCrop("Imagem principal",'imagem',true, 'Resolução sugerida - 1280px X 700px');

echo'<div class="title"><img src="images/icons/dark/fullscreen.png" alt="" class="titleIcon"><h6>Galeria de fotos</h6></div>';
$objForm->sk_montaMultUploadGaleria('','index.php?acao=cadastraFoto&ctrl=blog','','');

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
                        $('#jcrop').attr('src', e.target.result).width(1280/2),
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
                    maxSize         : [ 1280/2, 700/2 ],
                    setSelect       : [ 0, 0, 1280/2, 700/2 ],                       
                    bgOpacity       : .3,
                    borderOpacity   : .9,
                    allowResize	: true,
                    aspectRatio: 1280/700
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