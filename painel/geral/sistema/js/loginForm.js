/*yepnope1.5.x|WTFPL*/
(function(a, b, c) {
    function d(a) { return "[object Function]" == o.call(a) }

    function e(a) { return "string" == typeof a }

    function f() {}

    function g(a) { return !a || "loaded" == a || "complete" == a || "uninitialized" == a }

    function h() {
        var a = p.shift();
        q = 1, a ? a.t ? m(function() {
            ("c" == a.t ? B.injectCss : B.injectJs)(a.s, 0, a.a, a.x, a.e, 1)
        }, 0) : (a(), h()) : q = 0
    }

    function i(a, c, d, e, f, i, j) {
        function k(b) { if (!o && g(l.readyState) && (u.r = o = 1, !q && h(), l.onload = l.onreadystatechange = null, b)) { "img" != a && m(function() { t.removeChild(l) }, 50); for (var d in y[c]) y[c].hasOwnProperty(d) && y[c][d].onload() } }
        var j = j || B.errorTimeout,
            l = b.createElement(a),
            o = 0,
            r = 0,
            u = { t: d, s: c, e: f, a: i, x: j };
        1 === y[c] && (r = 1, y[c] = []), "object" == a ? l.data = c : (l.src = c, l.type = a), l.width = l.height = "0", l.onerror = l.onload = l.onreadystatechange = function() { k.call(this, r) }, p.splice(e, 0, u), "img" != a && (r || 2 === y[c] ? (t.insertBefore(l, s ? null : n), m(k, j)) : y[c].push(l))
    }

    function j(a, b, c, d, f) { return q = 0, b = b || "j", e(a) ? i("c" == b ? v : u, a, b, this.i++, c, d, f) : (p.splice(this.i++, 0, a), 1 == p.length && h()), this }

    function k() { var a = B; return a.loader = { load: j, i: 0 }, a }
    var l = b.documentElement,
        m = a.setTimeout,
        n = b.getElementsByTagName("script")[0],
        o = {}.toString,
        p = [],
        q = 0,
        r = "MozAppearance" in l.style,
        s = r && !!b.createRange().compareNode,
        t = s ? l : n.parentNode,
        l = a.opera && "[object Opera]" == o.call(a.opera),
        l = !!b.attachEvent && !l,
        u = r ? "object" : l ? "script" : "img",
        v = l ? "script" : u,
        w = Array.isArray || function(a) { return "[object Array]" == o.call(a) },
        x = [],
        y = {},
        z = { timeout: function(a, b) { return b.length && (a.timeout = b[0]), a } },
        A, B;
    B = function(a) {
        function b(a) {
            var a = a.split("!"),
                b = x.length,
                c = a.pop(),
                d = a.length,
                c = { url: c, origUrl: c, prefixes: a },
                e, f, g;
            for (f = 0; f < d; f++) g = a[f].split("="), (e = z[g.shift()]) && (c = e(c, g));
            for (f = 0; f < b; f++) c = x[f](c);
            return c
        }

        function g(a, e, f, g, h) {
            var i = b(a),
                j = i.autoCallback;
            i.url.split(".").pop().split("?").shift(), i.bypass || (e && (e = d(e) ? e : e[a] || e[g] || e[a.split("/").pop().split("?")[0]]), i.instead ? i.instead(a, e, f, g, h) : (y[i.url] ? i.noexec = !0 : y[i.url] = 1, f.load(i.url, i.forceCSS || !i.forceJS && "css" == i.url.split(".").pop().split("?").shift() ? "c" : c, i.noexec, i.attrs, i.timeout), (d(e) || d(j)) && f.load(function() { k(), e && e(i.origUrl, h, g), j && j(i.origUrl, h, g), y[i.url] = 2 })))
        }

        function h(a, b) {
            function c(a, c) {
                if (a) {
                    if (e(a)) c || (j = function() {
                        var a = [].slice.call(arguments);
                        k.apply(this, a), l()
                    }), g(a, j, b, 0, h);
                    else if (Object(a) === a)
                        for (n in m = function() {
                                var b = 0,
                                    c;
                                for (c in a) a.hasOwnProperty(c) && b++;
                                return b
                            }(), a) a.hasOwnProperty(n) && (!c && !--m && (d(j) ? j = function() {
                            var a = [].slice.call(arguments);
                            k.apply(this, a), l()
                        } : j[n] = function(a) {
                            return function() {
                                var b = [].slice.call(arguments);
                                a && a.apply(this, b), l()
                            }
                        }(k[n])), g(a[n], j, b, n, h))
                } else !c && l()
            }
            var h = !!a.test,
                i = a.load || a.both,
                j = a.callback || f,
                k = j,
                l = a.complete || f,
                m, n;
            c(h ? a.yep : a.nope, !!i), i && c(i)
        }
        var i, j, l = this.yepnope.loader;
        if (e(a)) g(a, 0, l, 0);
        else if (w(a))
            for (i = 0; i < a.length; i++) j = a[i], e(j) ? g(j, 0, l, 0) : w(j) ? B(j) : Object(j) === j && h(j, l);
        else Object(a) === a && h(a, l)
    }, B.addPrefix = function(a, b) { z[a] = b }, B.addFilter = function(a) { x.push(a) }, B.errorTimeout = 1e4, null == b.readyState && b.addEventListener && (b.readyState = "loading", b.addEventListener("DOMContentLoaded", A = function() { b.removeEventListener("DOMContentLoaded", A, 0), b.readyState = "complete" }, 0)), a.yepnope = k(), a.yepnope.executeStack = h, a.yepnope.injectJs = function(a, c, d, e, i, j) {
        var k = b.createElement("script"),
            l, o, e = e || B.errorTimeout;
        k.src = a;
        for (o in d) k.setAttribute(o, d[o]);
        c = j ? h : c || f, k.onreadystatechange = k.onload = function() {!l && g(k.readyState) && (l = 1, c(), k.onload = k.onreadystatechange = null) }, m(function() { l || (l = 1, c(1)) }, e), i ? k.onload() : n.parentNode.insertBefore(k, n)
    }, a.yepnope.injectCss = function(a, c, d, e, g, i) {
        var e = b.createElement("link"),
            j, c = i ? h : c || f;
        e.href = a, e.rel = "stylesheet", e.type = "text/css";
        for (j in d) e.setAttribute(j, d[j]);
        g || (n.parentNode.insertBefore(e, n), m(c, 0))
    }
})(this, document);
var pathGeral = "sistemas/geral/";

var pathGeral = "sistemas/geral/";



yepnope([{
    load: [
        pathSite + "js/bower_components/components-font-awesome/css/font-awesome.min.css",
        pathSite + "js/bower_components/modernizr/modernizr.js",
        pathSite + "js/bower_components/jquery-mousewheel/jquery.mousewheel.min.js",
        pathSite + "js/bower_components/noty/js/noty/packaged/jquery.noty.packaged.min.js",
        pathSite + "js/bower_components/noty/js/noty/packaged/animate.css",
        pathSite + "js/bower_components/html2canvas/build/html2canvas.min.js",
        pathSite + "js/bower_components/jQuery-Mask-Plugin/dist/jquery.mask.min.js"
    ],
    complete: function() {





        /*
         * FUNCAO PARA COLOCAR MASCARA DE DINHEIRO
         * <input type="text" name="one" id="one" data-affixes-stay="true" data-prefix="R$ " data-thousands="." data-decimal=",">
         */
        yepnope([{
            load: [pathSite + "js/bower_components/jquery-maskmoney/dist/jquery.maskMoney.min.js"],
            complete: function() {
                $('input[data=money]').maskMoney();
            }
        }]);


        //Inicio Mascara Telefone
        // <input type="text" name="one" id="one" mask-input="cpfCnpj">
        if ($('input[mask-input=telefone]').length != 0) {
            $('input[mask-input=telefone]').mask('(00) 00000-0000', {
                onKeyPress: function(phone, event, currentField, options) {
                    var new_sp_phone = phone.match(/^(\(11\) 9(5[0-9]|6[0-9]|7[01234569]|8[0-9]|9[0-9])[0-9]{1})/g);
                    new_sp_phone ? $(currentField).mask('(00) 00000-0000', options) : $(currentField).mask('(00) 00000-0000', options)
                }
            });
        }
        var SPMaskBehavior = function(val) {
                return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
            },
            spOptions = {
                onKeyPress: function(val, e, field, options) {
                    field.mask(SPMaskBehavior.apply({}, arguments), options);
                }
            };

        $('.sp_celphones').mask(SPMaskBehavior, spOptions);

        $('.money').mask('000.000.000.000.000,00', { reverse: true });
        $('#money2').mask('000.000.000.000.000,00', { reverse: true });

        if ($('input[mask-input=cpfCnpj]').length != 0) {
            var options = {
                maxlength: false,
                onKeyPress: function(cep, event, currentField, options) {
                    var masks = ['00.000.000/0000-00', '###.###.###-##'];
                    mask = (cep.length > 14) ? masks[0] : masks[1];
                    $('input[mask-input=cpfCnpj]').mask(mask, options);
                }
            };

            $('input[mask-input=cpfCnpj]').mask('###.###.###-##', options);
        }

        //Fim Mascara Telefone
        $("input[mask-input=money]").mask('000.000.000.000.000,00', { reverse: true });
        $("input[mask-input=cpf]").mask("999.999.999-99");
        $("input[mask-input=rg]").mask("99.999.999-*");
        $("input[mask-input=data]").mask("99/99/9999");
        $("input[mask-input=idade]").mask("99");
        $("input[mask-input=horario]").mask("99:99");
        $("input[mask-input=cep]").mask("99.999-999");
        $("input[mask-input=codigo]").mask("99999999");
        /*
         * POPUP
         * **/
        /*
         * FUNCAO PARA CRIAR FORMULARIO DE ENVIO DE CONTATO AJAX
         */
        if ($('#frmContato').length != 0 || $('#frmEnvIndique').length != 0 || $('#frmReclamacao').length != 0 || $('#avalieImovelForm').length != 0 || $('#frmSugestao').length != 0 || $('#frmAteEmail').length != 0 || $('#frmEsqueceu').length != 0 || $('#frmAjuda').length != 0 || $('#frmCadastro').length != 0 || $('#frmCliente').length != 0 || $('#frmAnuncie').length != 0 || $('#frmSindico').length != 0 || $('#frmDesocupacao').length != 0 || $('#frmAtendimento').length != 0 || $('#frmEstamosProucurando').length != 0 || $('#frmVenderAlugar').length != 0 || $('.frmAgendeVisita').length != 0 || $('.frmLigamos').length != 0 || $('#frmCliente').length != 0 || $('#frmCliente').length != 0 || $('#frmEsqueceu').length != 0 ||  $('#frmSugestao').length != 0 || $('#frmReclamacao').length != 0 || $('#frmDesocupacao').length != 0 || $('#frmCadastro').length != 0 || $('#frmCadastroSite').length != 0 || $('#frmUsuarioSite').length != 0) {
            yepnope([{
                load: [pathSite + "js/bower_components/jQuery-Validation-Engine/js/jquery.validationEngine.js", pathSite + "js/bower_components/jQuery-Validation-Engine/js/languages/jquery.validationEngine-pt_BR.js", pathSite + "js/bower_components/jQuery-Validation-Engine/css/validationEngine.jquery.css"],
                complete: function() {
                    $("#frmContato").validationEngine({
                        onValidationComplete: function(form, status) { 
                            if (status == true) {
                                mostraMensagem("Aguarde, estamos enviado sua mensagem.", 3, 'info');
                                $.ajax({
                                    url: pathSite + 'envia-contato',
                                    dataType: 'json',
                                    type: 'POST',
                                    data: $('#frmContato').serialize(),
                                    success: function(obj) {
                                        if (obj.situacao == "sucess") {
                                            mostraMensagem("Sua mensagem foi enviada com sucesso!", 3, 'success');
                                            $("#frmContato").each(function() {
                                                this.reset(); //Cada volta no la????o o form atual ser???? resetado
                                            });
                                        } else if (obj.situacao == "error") {
                                            mostraMensagem(obj.msg, 4, 'error');
                                        }
                                    },
                                    error: function(XMLHttpRequest, textStatus, errorThrown) {

                                    },

                                    beforeSend: function(requisicao) {}
                                });
                            }
                        }

                    });     
                    
                   // if ($('#frmEstamosProucurando').length != 0) {
                        $("#frmEstamosProucurando").validationEngine({
                            onValidationComplete: function(form, status) {
                                if (status == true) {
                                    mostraMensagem("Aguarde...", 2, 'info');
                                    $.ajax({
                                        url: pathSite + 'estamos-proucurando',
                                        dataType: 'json',
                                        type: 'POST',
                                        data: $('#frmEstamosProucurando').serialize(),
                                        success: function(obj) {                                            
                                            if (obj.situacao == "sucess") {
                                                mostraMensagem(obj.msg, 4, 'success');
                                                console.log(obj.msg);
                                            } else if (obj.situacao == "error") {
                                                mostraMensagem(obj.msg, 4, 'error');
                                            }                                    
                                        },
                                        error: function(XMLHttpRequest, textStatus, errorThrown) {
                                            console.log(data);                                     
                                        },                               
                                        beforeSend: function(requisicao) {}
                                    });
                            }
                        }
                        });
                        
                  //  }

                   // if ($('#frmVenderAlugar').length != 0) {
                        $("#frmVenderAlugar").validationEngine({
                            onValidationComplete: function(form, status) {
                                if (status == true) {
                                    mostraMensagem("Aguarde...", 2, 'info');
                                    $.ajax({
                                        url: pathSite + 'vender-alugar-contato',
                                        dataType: 'json',
                                        type: 'POST',
                                        data: $('#frmVenderAlugar').serialize(),
                                        success: function(obj) {                                            
                                            if (obj.situacao == "sucess") {
                                                mostraMensagem(obj.msg, 4, 'success');
                                                console.log(obj.msg);
                                            } else if (obj.situacao == "error") {
                                                mostraMensagem(obj.msg, 4, 'error');
                                            }                                    
                                        },
                                        error: function(XMLHttpRequest, textStatus, errorThrown) {
                                            console.log(data);                                     
                                        },                               
                                        beforeSend: function(requisicao) {}
                                    });
                            }
                        }
                        });
                        
                  //  }

                  //  if($('.frmAgendeVisita').length != 0){
                        $(".frmAgendeVisita").validationEngine({
                            onValidationComplete: function(form, status){
                                if (status == true) {
                                    mostraMensagem("Aguarde...", 4,'info');
                                    $.ajax({
                                        url: pathSite + 'envia-agenda-uma-visita',
                                        dataType: 'json',
                                        type: 'POST',
                                        data: $('.frmAgendeVisita').serialize(),
                                        success: function(obj){
                                            if(obj.situacao=="sucess"){
                                                mostraMensagem(obj.msg,4,'success');
                                                $(".frmAgendeVisita").each(function(){
                                                    this.reset(); //Cada volta no la??o o form atual ser?? resetado
                                                });

                                                myModalTimeout = setTimeout(function() {
                                                    $('#ex2').modal('hide');
                                                }, 2000);
                                                  
                                            } else if(obj.situacao=="error"){
                                                mostraMensagem(obj.msg,4,'error');

                                                 myModalTimeout = setTimeout(function() {
                                                     $('#ex2').modal('hide');
                                                 }, 2000);
                                            }
                                        },
                                        error : function (XMLHttpRequest, textStatus, errorThrown) {
                                            
                                        },
                                        
                                        beforeSend : function(requisicao){
                                        }
                                    });
                                }
                            }
                        
                        });
                   // }

                  //  if($('.frmLigamos').length != 0){
                        $(".frmLigamos").validationEngine({
                            onValidationComplete: function(form, status){
                                if (status == true) {
                                    mostraMensagem("Aguarde...",4,'info');
                                    $.ajax({
                                        url: pathSite + 'envia-ligamos-para-voce',
                                        dataType: 'json',
                                        type: 'POST',
                                        data: $('.frmLigamos').serialize(),
                                        success: function(obj){
                                            if(obj.situacao=="sucess"){
                                                mostraMensagem(obj.msg,4,'success');
                                                $(".frmLigamos").each(function(){
                                                    this.reset(); //Cada volta no la??o o form atual ser?? resetado
                                                });
                                                
                                                myModalTimeout = setTimeout(function() {
                                                    $('#ex2').modal('hide');
                                                }, 2000);
                                                
                                            } else if(obj.situacao=="error"){
                                                mostraMensagem(obj.msg,4,'error');
                                                
                                                myModalTimeout = setTimeout(function() {
                                                    $('#ex2').modal('hide');
                                                }, 2000);
                                            }
                                        },
                                        error : function (XMLHttpRequest, textStatus, errorThrown) {
                                            
                                        },
                                        
                                        beforeSend : function(requisicao){
                                        }
                                    });
                                }
                            }
                        
                        });
                   // }
                
              
          
        	

                   // if ($('#frmCliente').length != 0) {
                        $("#frmCliente").validationEngine({
                            onValidationComplete: function(form, status) {
                                if (status == true) {
                                    mostraMensagem("Aguarde...", 2, 'info');
                                    $.ajax({
                                        url: pathSite + 'cliente-logar',
                                        dataType: 'json',
                                        type: 'POST',
                                        data: $('#frmCliente').serialize(),
                                        success: function(obj) {                                            
                                            if (obj.situacao == "sucess") {
                                                mostraMensagem(obj.msg, 4, 'success');
                                                $("#frmCliente").each(function() {
                                                    this.reset(); //Cada volta no la????o o form atual ser???? resetado
                                                });
                                                window.location.href = pathSite + "perfil";
                                            }if(obj.situacao == "error") {
                                                mostraMensagem(obj.msg, 4, 'error');
                                            }    if(obj.situacao == "redirect"){
                                                window.location.href = pathSite + "perfil";
                                            }

                                        },
                                        error: function(XMLHttpRequest, textStatus, errorThrown) {
                                                                                 
                                        },                               
                                        beforeSend: function(requisicao) {}
                                    });
                            }
                        }
                        });
                        
                  //  }
                    
                    
                    //Esqueceu sua senha
                   // if ($('#frmEsqueceu').length != 0) {
                        $("#frmEsqueceu").validationEngine({
                            onValidationComplete: function(form, status) {
                                if (status == true) {
                                    mostraMensagem("Aguarde...", 3, 'info');
                                    $.ajax({
                                        url: pathSite + 'envia-esqueceu',
                                        dataType: 'json',
                                        type: 'POST',
                                        data: $('#frmEsqueceu').serialize(),
                                        success: function(obj) {
                                            if (obj.situacao == "sucess") {
                                                mostraMensagem(obj.msg, 4, 'success');
                                                $("#frmEsqueceu").each(function() {
                                                    this.reset(); //Cada volta no la????o o form atual ser???? resetado
                                                });
                                            } else if (obj.situacao == "error") {
                                                mostraMensagem(obj.msg, 4, 'error');
                                            }
                                        },
                                        error: function(XMLHttpRequest, textStatus, errorThrown) {

                                        },

                                        beforeSend: function(requisicao) {}
                                    });
                                }
                            }

                        });
                  //  }
                    
                    //Cadastrar Clientes
                   // if ($('#frmCadastro').length != 0) {
                        $("#frmCadastro").validationEngine({
                            onValidationComplete: function(form, status) {
                                if (status == true) {
                                    mostraMensagem("Aguarde...", 2, 'info');
                                    $.ajax({
                                        url: pathSite + 'envia-cadastro',
                                        dataType: 'json',
                                        type: 'POST',
                                        data: $('#frmCadastro').serialize(),
                                        success: function(obj) {
                                            if (obj.situacao == "sucess") {
                                                mostraMensagem(obj.msg, 4, 'success');
                                                $("#frmCadastro").each(function() {
                                                    this.reset(); //Cada volta no la????o o form atual ser???? resetado
                                                });
                                            } else if (obj.situacao == "error") {
                                                mostraMensagem(obj.msg, 4, 'error');
                                            }
                                        },
                                        error: function(XMLHttpRequest, textStatus, errorThrown) {

                                        },

                                        beforeSend: function(requisicao) {}
                                    });
                                }
                            }

                        });
                    //}
                    
                    $("#frmCadastroSite").validationEngine({
                        onValidationComplete: function(form, status) {
                            if (status == true) {
                                mostraMensagem("Aguarde...", 2, 'info');
                                $.ajax({
                                    url: pathSite + 'envia-cadastro-site',
                                    dataType: 'json',
                                    type: 'POST',
                                    data: $('#frmCadastroSite').serialize(),
                                    success: function(obj) {
                                        if (obj.situacao == "sucess") {
                                            mostraMensagem(obj.msg, 4, 'success');
                                            $("#frmCadastroSite").each(function() {
                                                this.reset(); //Cada volta no la????o o form atual ser???? resetado
                                            });
                                            window.location = pathSite + 'login-favorito';
                                        } else if (obj.situacao == "error") {
                                            mostraMensagem(obj.msg, 4, 'error');
                                        }
                                    },
                                    error: function(XMLHttpRequest, textStatus, errorThrown) {

                                    },

                                    beforeSend: function(requisicao) {}
                                });
                            }
                        }

                    });

                    
                    $("#frmUsuarioSite").validationEngine({
                        onValidationComplete: function(form, status) {
                            if (status == true) {
                                mostraMensagem("Aguarde...", 2, 'info');
                                $.ajax({
                                    url: pathSite + 'usuario-logar',
                                    dataType: 'json',
                                    type: 'POST',
                                    data: $('#frmUsuarioSite').serialize(),
                                    success: function(obj) {
                                        if (obj.situacao == "sucess") {                                            
                                            mostraMensagem(obj.msg, 4, 'success');
                                            $("#frmUsuarioSite").each(function() {
                                                this.reset(); //Cada volta no la????o o form atual ser???? resetado
                                            });
                                            window.location.href = pathSite + 'favorito';
                                        } else if (obj.situacao == "error") {
                                            mostraMensagem(obj.msg, 4, 'error');
                                        }
                                    },
                                    error: function(XMLHttpRequest, textStatus, errorThrown) {

                                    },
                                    
                                    beforeSend: function(requisicao) {}
                                });
                            }
                        }

                    });
                    
                    //procedimento para desocupa????o
                   // if ($('#frmDesocupacao').length != 0) {
                        $("#frmDesocupacao").validationEngine({
                            onValidationComplete: function(form, status) {
                                if (status == true) {
                                    mostraMensagem("Sua solicita????o foi enviada! S?? ser?? validada ap??s confirma????o do recebimento.", "", 'success');
                                    $.ajax({
                                        url: pathSite + 'cadastrarDepoimento',
                                        dataType: 'json',
                                        type: 'POST',
                                        data: $('#frmDesocupacao').serialize(),
                                        success: function(obj) {
                                            if (obj.situacao == "sucess") {
                                                mostraMensagem(obj.msg, 4, 'success');
                                                $("#frmDesocupacao").each(function() {
                                                    this.reset(); //Cada volta no la????o o form atual ser???? resetado
                                                });
                                            } else if (obj.situacao == "error") {
                                                mostraMensagem(obj.msg, 4, 'error');
                                            }
                                        },
                                        error: function(XMLHttpRequest, textStatus, errorThrown) {
                                            console.log($('#frmDesocupacao').serialize());
                                        },

                                        beforeSend: function(requisicao) {}
                                    });
                                }
                            }

                        });
                   // }
                    
                    //??rea sugest??o e reclama????o
                   // if ($('#frmSugestao').length != 0) {
                        $("#frmSugestao").validationEngine({
                            onValidationComplete: function(form, status) {
                                if (status == true) {
                                    mostraMensagem("Aguarde...", 3, 'info');
                                    $.ajax({
                                        url: pathSite + 'envia-sugestao',
                                        dataType: 'json',
                                        type: 'POST',
                                        data: $('#frmSugestao').serialize(),
                                        success: function(obj) {
                                            if (obj.situacao == "sucess") {
                                                mostraMensagem(obj.msg, 4, 'success');
                                                $("#frmSugestao").each(function() {
                                                    this.reset(); //Cada volta no la????o o form atual ser???? resetado
                                                });
                                            } else if (obj.situacao == "error") {
                                                mostraMensagem(obj.msg, 4, 'error');
                                            }
                                        },
                                        error: function(XMLHttpRequest, textStatus, errorThrown) {

                                        },

                                        beforeSend: function(requisicao) {}
                                    });
                                }
                            }

                        });
                   // }
                    //??rea sugest??o e reclama????o proprietario
                   // if ($('#frmReclamacao').length != 0) {
                        $("#frmReclamacao").validationEngine({
                            onValidationComplete: function(form, status) {
                                if (status == true) {
                                    mostraMensagem("Aguarde...", "", 'info');
                                    $.ajax({
                                        url: pathSite + 'envia-reclamacao',
                                        dataType: 'json',
                                        type: 'POST',
                                        data: $('#frmReclamacao').serialize(),
                                        success: function(obj) {
                                            if (obj.situacao == "sucess") {
                                                mostraMensagem(obj.msg, 4, 'success');
                                                $("#frmReclamacao").each(function() {
                                                    this.reset(); //Cada volta no la????o o form atual ser???? resetado
                                                });
                                            } else if (obj.situacao == "error") {
                                                mostraMensagem(obj.msg, 4, 'error');
                                            }
                                        },
                                        error: function(XMLHttpRequest, textStatus, errorThrown) {

                                        },

                                        beforeSend: function(requisicao) {}
                                    });
                                }
                            }

                        });
                   // }
                    
                }

                
            }]);
        
        
        }



        function mostraMensagem(msg, tempo, type, modal) {
            var timere = null;
            if (tempo == "") {
                tempo = 10;

            } else {
                tempo = tempo;
            }

            var opts = {};
            switch (type) {
                case 'error':
                    opts.title = "Erro";
                    opts.text = msg;
                    opts.type = "error";
                    break;
                case 'info':
                    opts.title = "Aviso";
                    opts.text = msg;
                    opts.type = "information";
                    break;
                case 'success':
                    opts.title = "Aviso";
                    opts.text = msg;
                    opts.type = "success";
                    break;
            }
            //$.pnotify(opts);

            noty({
                text: opts.title + " - " + opts.text,
                maxVisible: 10,
                layout: 'center',
                killer: true,
                modal: modal,
                theme: 'relax',
                timeout: (tempo * 1000),
                type: opts.type,
                animation: {
                    open: 'animated zoomIn',
                    close: 'animated zoomOut',
                    easing: 'swing',
                    speed: 500
                }
            });

        }


        $(document).ready(function() {
            if ($("#owl-demo").length != 0) {
                $("#owl-demo").owlCarousel({

                    autoPlay: 3000, //Set AutoPlay to 3 seconds

                    items: 4,
                    itemsDesktop: [1199, 3],
                    itemsDesktopSmall: [979, 3]

                });
            }

        });


    }
}]);




/*
 * Galeria de fotos imovel
 * */

/*
function ordernarImovel(url, ordenacao) {
    var urlFiltros = url + 'ordenacao/' + ordenacao + '/';
    window.location = urlFiltros;
};*/

function disableEnterKey(e) {
    var key;
    if (window.event)
        key = window.event.keyCode; //IE
    else
        key = e.which; //firefox      

    return (key != 13);
};