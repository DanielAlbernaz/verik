

function validaSenha()
{
    var senha = $('#senha').val();
    var confirmarSenha = $('#confirmar_senha').val();

    if(senha != confirmarSenha){
        $('#confirmar_senha').css("border", "1px solid red");
        $('#erro_senha').text('Senhas não conferem!');
        $('#erro_senha').css("color", "red");
        $("#botao_cadastrar").attr("disabled", true);
    }else{
        $('#confirmar_senha').css("border", "");
        $('#erro_senha').text('');
        $('#erro_senha').css("color", "");
        $("#botao_cadastrar").attr("disabled", false);
    }
}

function validaCpfCnpj(){
    var cpfCnpj = $('#cpfCnpj').val();

    if (cpfCnpj.length == 18){
        //CNPJ
        if(!validaCnpj(cpfCnpj)){
            $('#cpfCnpj').css("border", "1px solid red");
            $('#erro_cpfCnpj').text('Digite um CPNJ válido!');
            $('#erro_cpfCnpj').css("color", "red");
            $("#botao_cadastrar").attr("disabled", true);
        }else{
            $('#cpfCnpj').css("border", "");
            $('#erro_cpfCnpj').text('');
            $('#erro_cpfCnpj').css("color", "");
            $("#botao_cadastrar").attr("disabled", false);
            $('#tipo_pessoa').remove();
            $("#tipo_pessoa_valida").append('<input type="hidden" id="tipo_pessoa" name="tipo_pessoa" value="2"/>');
        }

    } else if (cpfCnpj.length == 14){
        //CPF
        if(!validaCpf(cpfCnpj)){
            $('#cpfCnpj').css("border", "1px solid red");
            $('#erro_cpfCnpj').text('Digite um CPF válido!');
            $('#erro_cpfCnpj').css("color", "red");
            $("#botao_cadastrar").attr("disabled", true);
        }else{
            $('#cpfCnpj').css("border", "");
            $('#erro_cpfCnpj').text('');
            $('#erro_cpfCnpj').css("color", "");
            $("#botao_cadastrar").attr("disabled", false);
            $('#tipo_pessoa').remove();
            $("#tipo_pessoa_valida").append('<input type="hidden" id="tipo_pessoa" name="tipo_pessoa" value="1"/>');
        }
    } else {
        $('#cpfCnpj').css("border", "1px solid red");
        $('#erro_cpfCnpj').text('Digite um CPF ou um CPNJ válido!');
        $('#erro_cpfCnpj').css("color", "red");
        $("#botao_cadastrar").attr("disabled", false);
    }
}

function validaCpf(cpf) {	
	cpf = cpf.replace(/[^\d]+/g,'');	
	
	// Elimina CPFs invalidos conhecidos	
	if (cpf.length != 11 || 
		cpf == "00000000000" || 
		cpf == "11111111111" || 
		cpf == "22222222222" || 
		cpf == "33333333333" || 
		cpf == "44444444444" || 
		cpf == "55555555555" || 
		cpf == "66666666666" || 
		cpf == "77777777777" || 
		cpf == "88888888888" || 
		cpf == "99999999999")
			return false;		
	// Valida 1o digito	
	add = 0;	
	for (i=0; i < 9; i ++)		
		add += parseInt(cpf.charAt(i)) * (10 - i);	
		rev = 11 - (add % 11);	
		if (rev == 10 || rev == 11)		
			rev = 0;	
		if (rev != parseInt(cpf.charAt(9)))		
			return false;		
	// Valida 2o digito	
	add = 0;	
	for (i = 0; i < 10; i ++)		
		add += parseInt(cpf.charAt(i)) * (11 - i);	
	rev = 11 - (add % 11);	
	if (rev == 10 || rev == 11)	
		rev = 0;	
	if (rev != parseInt(cpf.charAt(10)))
		return false;		
	return true;   
}

function validaCnpj(cnpj) {
    cnpj = cnpj.replace(/[^\d]+/g,'');
 
    if(cnpj == '') return false;
     
    if (cnpj.length != 14)
        return false;
 
    // Elimina CNPJs invalidos conhecidos
    if (cnpj == "00000000000000" || 
        cnpj == "11111111111111" || 
        cnpj == "22222222222222" || 
        cnpj == "33333333333333" || 
        cnpj == "44444444444444" || 
        cnpj == "55555555555555" || 
        cnpj == "66666666666666" || 
        cnpj == "77777777777777" || 
        cnpj == "88888888888888" || 
        cnpj == "99999999999999")
        return false;
         
    // Valida DVs
    tamanho = cnpj.length - 2
    numeros = cnpj.substring(0,tamanho);
    digitos = cnpj.substring(tamanho);
    soma = 0;
    pos = tamanho - 7;
    for (i = tamanho; i >= 1; i--) {
      soma += numeros.charAt(tamanho - i) * pos--;
      if (pos < 2)
            pos = 9;
    }
    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
    if (resultado != digitos.charAt(0))
        return false;
         
    tamanho = tamanho + 1;
    numeros = cnpj.substring(0,tamanho);
    soma = 0;
    pos = tamanho - 7;
    for (i = tamanho; i >= 1; i--) {
      soma += numeros.charAt(tamanho - i) * pos--;
      if (pos < 2)
            pos = 9;
    }
    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
    if (resultado != digitos.charAt(1))
          return false;
           
    return true;    
}


function validaCep()
{   
    var cep = $('#cep').val();

    if(cep.length != 10){
        $('#cep').css("border", "1px solid red");
        $('#erro_cep').text('Digite um CEP válido!');
        $('#erro_cep').css("color", "red");
        $("#botao_cadastrar").attr("disabled", true);
    }else{
        $('#cep').css("border", "");
        $('#erro_cep').text('');
        $('#erro_cep').css("color", "");
        $("#botao_cadastrar").attr("disabled", false);
    }
}


// function validaCep()
// {   
//     $.ajax({											
//         url: pathSite + 'valida-email-existe',
//         dataType: 'json', 
//         data: $("#email").val(),
//         type: 'post',												
//         success: function(obj){
//             console.log('suceeso');
//     },
//     error : function (XMLHttpRequest, textStatus, errorThrown) {
//         console.log(XMLHttpRequest);
//         console.log(textStatus);
//         console.log(errorThrown);
//     },							
//     beforeSend : function(requisicao){
//     }
// });
// }