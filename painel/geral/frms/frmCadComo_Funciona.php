<?php


//Informações do Formalário
$nomedoformulario = 'Cadastrar como funciona';
$acaodoformulario = 'index.php?acao=cadastrar&ctrl=como_funciona';
$avisodoformulario = 'Esta página você cadastra o como funciona.';

//Inicia o Formulário
$objForm->sk_iniciaFormulario($nomedoformulario,$acaodoformulario,$avisodoformulario);

//Monta o array com as categorias cadastradas no banco
$optionsServico[] = '<option selected="selected"></option>';
for($i=0; $i < count($servico); $i++){
    $optionsServico[] = '<option value='.$servico[$i]->id.'>'.$servico[$i]->titulo.'</option>';
}

$objForm->sk_formSelect('Exibir Serviço', 'servico', $optionsServico, false, 'Selecione uma categoria');


//Cria um input text
$objForm->sk_formText('Título','titulo','',true,'Aqui você coloca um titulo para o banner.');

$objForm->sk_formTextHTML('Texto','texto',false,'Aqui você escreve o texto.');

$objForm->sk_formFileCrop("Imagem",'imagem',true,'Tamanho 80px x 80px');

$objForm->sk_formTextPequeno('Ordem exibição','ordem','',true,'Ordem exibição EX: 0, 1, 2.');

$optionsAba[] = '<option value="0" selected="selected">Não</option>';
$optionsAba[] = '<option value="1" >Sim</option>';

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
                        $('#jcrop').attr('src', e.target.result).width(100),
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
                    maxSize         : [ 80, 80 ],
                    setSelect       : [ 0, 0, 80, 80 ],                       
                    bgOpacity       : .3,
                    borderOpacity   : .9,
                    allowResize	: true,
                    aspectRatio: 80/80
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