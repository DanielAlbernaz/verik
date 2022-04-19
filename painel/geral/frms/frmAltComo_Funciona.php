    
<?php


//Informações do Formalário
$nomedoformulario = 'Alterar como funciona';
$acaodoformulario = 'index.php?acao=alterar&ctrl=como_funciona';
$avisodoformulario = 'Esta página você altera o como funciona.';


//Inicia o Formulário
$objForm->sk_iniciaFormulario($nomedoformulario,$acaodoformulario,$avisodoformulario);

for($i=0; $i < count($servico); $i++){    
    if($servico[$i]->id == $ComoFuncionaForm->servico ){             
        $nome_servico = $servico[$i]->titulo;
    }   
}

$optionsServico[] = '<option value="" ></option>';
$optionsServico[] = '<option value='.$ComoFuncionaForm->servico.' selected="selected" >'.$nome_servico.'</option>';
foreach($servico as $key => $val){
    if($val->id <> NULL){
        if($val->id <> $ComoFuncionaForm->servico){
            $optionsServico[] = '<option value='.$val->id.'>'.$val->titulo.'</option>';
        }       
    }  
}

$objForm->sk_formSelect('Serviço', 'servico', $optionsServico, true, 'Selecione uma serviço');

//Cria um input text
$objForm->sk_formText('Titulo','titulo','',true,'Aqui você altera o titulo do banner.',$ComoFuncionaForm->titulo);

$objForm->sk_formTextHTML('Texto','texto',false,'Aqui você escreve o texto.', $ComoFuncionaForm->texto);

$objForm->sk_formFileCrop("Imagem",'imagem',false,'Tamanho da imagem do banner 80px x 80px',$ComoFuncionaForm->imagem);

$optionsAba[] = '<option value="0" selected="selected">Não</option>';
$optionsAba[] = '<option value="1" >Sim</option>';

$objForm->sk_formTextPequeno('Ordem exibição','ordem','',true,'Ordem exibição EX: 0, 1, 2.',$ComoFuncionaForm->ordem);

//Status
$optionsStatus[] = '<option value="1"'. ($ComoFuncionaForm->status == 1 ? 'selected="selected"' : '' ).'>Ativo</option>';
$optionsStatus[] = '<option value="0"'. ($ComoFuncionaForm->status == 0 ? 'selected="selected"' : '' ).'>Inativo</option>';

$objForm->sk_formSelect('Status', 'status', $optionsStatus, true, 'Selecione uma opção');

$objForm->sk_formDataHoras('Data de cadastro','dhcadastro',false,'Deixe o campo em branco caso queria que seja a data atual.', $ComoFuncionaForm->dhcadastro);

echo'<div class="title"><img src="images/icons/dark/fullscreen.png" alt="" class="titleIcon"><h6>Período de exibição</h6></div>';
        
$objForm->sk_formDataHoras('Data início para exibição','data_inicio_exibicao',false,'Data em que a notícia começara a ser exibida. Deixe o campo em branco caso queria que seja imediatamente.',($ComoFuncionaForm->data_inicio_exibicao != 0 ? $objUteis->converteDataHora($ComoFuncionaForm->data_inicio_exibicao): ''));

$objForm->sk_formDataHoras('Data máxima para exibição','data_expiracao',false,'Data em que a notícia deixará de ser exibida. Deixe o campo em branco caso queria que seja exibido por um período indeterminado.',($ComoFuncionaForm->data_expiracao != 0 ? $objUteis->converteDataHora($ComoFuncionaForm->data_expiracao) : ''));


//Cria um input hidden
$objForm->sk_formHidden('id',$ComoFuncionaForm->id);

//Cria um input hidden
$objForm->sk_formHidden('imgAntiga',$ComoFuncionaForm->imagem);

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