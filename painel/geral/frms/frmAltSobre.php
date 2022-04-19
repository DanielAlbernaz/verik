<?php

//Informações do Formalário
$nomedoformulario = 'Alterar sobre da clínica';
$acaodoformulario = 'index.php?acao=alterar&ctrl=sobre';
$avisodoformulario = 'Esta página você altera sobre da clínica';

//Inicia o Formulário
$objForm->sk_iniciaFormulario($nomedoformulario,$acaodoformulario,$avisodoformulario);

//Cria um input text
$objForm->sk_formText('Título','titulo','',false,'Aqui você um titulo para o banco.',$sobreForm->titulo);

$objForm->sk_formFileCrop("Imagem",'imagem',false, 'Resolução sugerida - 581px X 517px',$sobreForm->imagem);

$objForm->sk_formTextHTML('Texto','texto',false,'Aqui você alterar o texto.',$sobreForm->texto);

$objForm->sk_formText('Texto botão','texto_botao','',false,'Aqui você coloca um titulo para o banner.', $sobreForm->texto_botao);

$objForm->sk_formTextUrl('Link botão','url','',false,'Link de redirecionamento para o botão.' ,$sobreForm->url);

$optionsAba[] = '<option value="1"'. ($sobreForm->abrir_mesma_aba == 1 ? 'selected="selected"' : '' ).'>Não</option>';
$optionsAba[] = '<option value="0"'. ($sobreForm->abrir_mesma_aba == 0 ? 'selected="selected"' : '' ).'>Sim</option>';

$objForm->sk_formSelect('Abrir link na mesma aba?', 'abrir_mesma_aba', $optionsAba, true, 'Selecione uma opção');

//Status
$optionsStatus[] = '<option value="1"'. ($sobreForm->status == 1 ? 'selected="selected"' : '' ).'>Ativo</option>';
$optionsStatus[] = '<option value="0"'. ($sobreForm->status == 0 ? 'selected="selected"' : '' ).'>Inativo</option>';

$objForm->sk_formSelect('Status', 'status', $optionsStatus, true, 'Selecione uma opção');

$objForm->sk_formDataHoras('Data de cadastro','dhcadastro',false,'Deixe o campo em branco caso queria que seja a data atual.' ,$sobreForm->dhcadastro);

echo'<div class="title"><img src="images/icons/dark/fullscreen.png" alt="" class="titleIcon"><h6>Período de exibição</h6></div>';
        
$objForm->sk_formDataHoras('Data início para exibição','data_inicio_exibicao',false,'Data em que a notícia começara a ser exibida. Deixe o campo em branco caso queria que seja imediatamente.',($sobreForm->data_inicio_exibicao != 0 ? $objUteis->converteDataHora($sobreForm->data_inicio_exibicao): ''));

$objForm->sk_formDataHoras('Data máxima para exibição','data_expiracao',false,'Data em que a notícia deixará de ser exibida. Deixe o campo em branco caso queria que seja exibido por um período indeterminado.',($sobreForm->data_expiracao != 0 ? $objUteis->converteDataHora($sobreForm->data_expiracao) : ''));


//Cria um input hidden
$objForm->sk_formHidden('id',$sobreForm->id);

$objForm->sk_formHidden('imgAntiga',$sobreForm->imagem);

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
                        $('#jcrop').attr('src', e.target.result).width(581),
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
                    maxSize         : [ 581, 517 ],
                    setSelect       : [ 0, 0, 581, 517 ],                   
                    bgOpacity       : .3,
                    borderOpacity   : .9,
                    allowResize	: true,
                    aspectRatio: 581/517
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