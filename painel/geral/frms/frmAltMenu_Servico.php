    
<?php


//Informações do Formalário
$nomedoformulario = 'Alterar Menu Serviço';
$acaodoformulario = 'index.php?acao=alterar&ctrl=menu_servico';
$avisodoformulario = 'Esta página você altera o menu serviço.';


//Inicia o Formulário
$objForm->sk_iniciaFormulario($nomedoformulario,$acaodoformulario,$avisodoformulario);

for($i=0; $i < count($servico); $i++){    
    if($servico[$i]->id == $servicoForm->servico ){             
        $nome_servico = $servico[$i]->titulo;
    }   
}

$optionsServico[] = '<option value="" ></option>';
$optionsServico[] = '<option value='.$servicoForm->servico.' selected="selected" >'.$nome_servico.'</option>';
foreach($servico as $key => $val){
    if($val->id <> NULL){
        if($val->id <> $servicoForm->servico){
            $optionsServico[] = '<option value='.$val->id.'>'.$val->titulo.'</option>';
        }       
    }  
}

$objForm->sk_formSelect('Categoria', 'servico', $optionsServico, true, 'Selecione uma categoria');

$objForm->sk_formText('Título','titulo','',true,'Aqui você coloca um titulo para o banner.',$servicoForm->titulo);

$objForm->sk_formText('Link redirecionamento','url','',false,'Link de redirecionamento para o botão.',$servicoForm->url);

$objForm->sk_formTextPequeno('Ordem exibição','ordem','',true,'Ordem exibição EX: 0, 1, 2.',$servicoForm->ordem);
//Status
$optionsStatus[] = '<option value="1"'. ($servicoForm->status == 1 ? 'selected="selected"' : '' ).'>Ativo</option>';
$optionsStatus[] = '<option value="0"'. ($servicoForm->status == 0 ? 'selected="selected"' : '' ).'>Inativo</option>';

$objForm->sk_formSelect('Status', 'status', $optionsStatus, true, 'Selecione uma opção');

$objForm->sk_formDataHoras('Data de cadastro','dhcadastro',false,'Deixe o campo em branco caso queria que seja a data atual.', $servicoForm->dhcadastro);

echo'<div class="title"><img src="images/icons/dark/fullscreen.png" alt="" class="titleIcon"><h6>Período de exibição</h6></div>';
        
$objForm->sk_formDataHoras('Data início para exibição','data_inicio_exibicao',false,'Data em que a notícia começara a ser exibida. Deixe o campo em branco caso queria que seja imediatamente.',($servicoForm->data_inicio_exibicao != 0 ? $objUteis->converteDataHora($servicoForm->data_inicio_exibicao): ''));

$objForm->sk_formDataHoras('Data máxima para exibição','data_expiracao',false,'Data em que a notícia deixará de ser exibida. Deixe o campo em branco caso queria que seja exibido por um período indeterminado.',($servicoForm->data_expiracao != 0 ? $objUteis->converteDataHora($servicoForm->data_expiracao) : ''));


//Cria um input hidden
$objForm->sk_formHidden('id',$servicoForm->id);

//Cria um input hidden
$objForm->sk_formHidden('imgAntiga',$servicoForm->imagem);

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
                        $('#jcrop').attr('src', e.target.result).width(1920/2),
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
                    maxSize         : [ 1920/2, 400/2 ],
                    setSelect       : [ 0, 0, 1920/2, 400/2 ],                       
                    bgOpacity       : .3,
                    borderOpacity   : .9,
                    allowResize	: true,
                    aspectRatio: 1920/400
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