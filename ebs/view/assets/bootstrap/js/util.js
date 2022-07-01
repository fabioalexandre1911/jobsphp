$(document).ready(function(){
   $('.modal').on('shown.bs.modal', function (e) {
        $(this).find('input[type=text],textarea,select').filter(':visible:first').focus();
    }) 
});


function addClassErro(objeto) 
{
    objeto = mudaObjetoCaptcha(objeto);    
    objeto.parent().addClass('has-error');
}

function removeClassErro(objeto) 
{
    objeto = mudaObjetoCaptcha(objeto);    
    objeto.parent().removeClass('has-error');
}

function mostraInputErro(objeto, msg) 
{    
    objeto = mudaObjetoCaptcha(objeto);    
    objeto.parent().children(".form-group .erro").show();
    objeto.parent().children(".form-group .erro").html(msg);
}

function escondeInputErro(objeto) 
{
    objeto = mudaObjetoCaptcha(objeto);    
    objeto.parent().children(".form-group .erro").html('');
    //verificar se podemos somente tirar o conteudo
    //objeto.parent().children(".form-group .erro").css('display', 'none');
}

function validaBranco(campos) 
{
    var retorno = true;

    for (var i = 0; i < campos.length; i++) 
    {
        if ($.trim($("#" + campos[i]).val()) == "") 
        {
            addClassErro($("#" + campos[i]));

            var nomecampo = $("#" + campos[i]).attr('nomecampo');

            var msg = mensagens['m10111'] + " " + '"' + nomecampo + '"' + " " + mensagens['m10114'];
            mostraInputErro($("#" + campos[i]), msg);
            retorno = false;
        } 
        else 
        {
            escondeInputErro($("#" + campos[i]));
            removeClassErro($("#" + campos[i]));
        }
    }

    return retorno;
}

function validaComparacao(campo1, campo2, labelCampoDiferente) 
{
    if ($("#" + campo1).val() == $("#" + campo2).val()) 
    {
        removeClassErro($("#" + campo2));
        escondeInputErro($("#" + campo2));
        return true;
    } 
    else 
    {
        addClassErro($("#" + campo2));
        var msg = mensagens['m194'] + labelCampoDiferente;
        mostraInputErro($("#" + campo2), msg);
        return false;
    }
}

function chamaModalErro(msg) 
{
    $(".alert").removeClass('alert-success').addClass('alert-danger');
    $("#modalErro").find('.alert').html(msg);
    $("#modalErro").find('.alert').show();
    $("#modalErro").modal("show");
}

function chamaModalAlerta(msg) 
{
    $("#modalAlerta .alert").removeClass('alert-success').removeClass('alert-danger').addClass('alert-warning');
    $("#modalAlerta").find('.alert').html(msg);
    $("#modalAlerta").find('.alert').show();
    $("#modalAlerta").modal("show");
}

function chamaModalSucesso(msg) 
{
    $(".alert").removeClass('alert-danger').addClass('alert-success');
    $("#modalSucesso").find('.alert').html(msg);
    $("#modalSucesso").find('.alert').show();
    $("#modalSucesso").modal("show");
}

function mostraAlert(elemento)
{    
    if (elemento == undefined)
        var elemento = $(".alert");
    
    elemento.show();    
    elemento.focus();
    
    setTimeout(function(){
        elemento.hide();
    }, 7000);
}

function retornaAlertVazio(msg) 
{
    return '<div class="alert alert-warning">' + msg + '</div>';
}

function validaArquivo() 
{
    var campos = new Array('arquivo');
    var retorno = validaBranco(campos);

    return retorno;
}

function SomenteNumero(e) 
{
    var tecla = (window.event) ? event.keyCode : e.which;

    if ((tecla > 47 && tecla < 58))
        return true;
    else 
    {
        if (tecla == 8 || tecla == 0 || e.ctrlKey || tecla == 13)
            return true;
        else
            return false;
    }
}

function scroll(idElemento) 
{
    var objScrDiv = document.getElementById(idElemento);
    objScrDiv.scrollTop = objScrDiv.scrollHeight-5;
}

function criaLink(str) 
{
    var replacedText, replacePattern1, replacePattern2, replacePattern3;
    
    if (str.indexOf("href") != -1)
        return str;

    //URLs starting with http://, https://, or ftp://
    replacePattern1 = /(\b(https?|ftp):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/gim;
    replacedText = str.replace(replacePattern1, '<a href="$1" target="_blank">$1</a>');

    //URLs starting with "www." (without // before it, or it'd re-link the ones done above).
    replacePattern2 = /(^|[^\/])(www\.[\S]+(\b|$))/gim;
    replacedText = replacedText.replace(replacePattern2, '$1<a href="http://$2" target="_blank">$2</a>');

    //Change email addresses to mailto:: links.
    replacePattern3 = /(([a-zA-Z0-9\-\_\.])+@[a-zA-Z\_]+?(\.[a-zA-Z]{2,6})+)/gim;
    replacedText = replacedText.replace(replacePattern3, '<a href="mailto:$1">$1</a>');

    return replacedText;
}

function atualizaTempo(idelemento)
{
    var tempo = $("#"+idelemento).html();
    tempo--;

    $("#"+idelemento).html(tempo);
    
    if (tempo > 0)
        setTimeout("atualizaTempo('"+idelemento+"')", 1000);    
}

function redirecionaLogin(host)
{
    var url = "";

    if (host)
        url = host + "/login.php";
    else 
        url = "login.php";

    window.location = url;
}

function sessionExpirou(data)
{    
    if (data.sessionexpirou)
    {
        chamaModalErro(data.msg);
        
        $('#modalErro').on('hidden.bs.modal', function () {
            redirecionaLogin();
        });
        
        return false;
    } 
    
    return true;
}

function abreArquivo(elemento, url, arquivoanexo)
{
    var nome = url.split("@!");
    nome = nome[2];
        
    if (typeof nome == "undefined")
    {
        nome = url.split("|!");
        nome = nome[2];
    }
    
    elemento.append("<a href='"+url+"' download='"+nome+"' target='_blank' id='link'>" + nome + "</a>");
    
    document.getElementById('link').click(); // $('#link').click() wasn't working for me

    $('#link').remove();
}

function getValuesCheckBox(chkboxName)
{
    return $("input[name='"+chkboxName+"']:checked").map(function() {
        return this.value;
    }).get().join(";");
}

function getLabelsCheckBox(chkboxName)
{
    return $("input[name='"+chkboxName+"']:checked").next(".lblCheckList").map(function(){
        return $(this).html();
    }).get().join(";");
}

function getValuesRadio(radioName)
{
    return $("input[name='"+radioName+"']:checked").map(function() {
        return this.value;
    }).get().join(";");
}

function getLabelsRadio(radioName)
{
    return $("input[name='"+radioName+"']:checked").next(".lblRadioList").map(function(){
        return $(this).html();
    }).get().join(";");
}

function mudaObjetoCaptcha(objeto)
{    
    if ($(objeto).attr("id") == "palavra_captcha")
        objeto = objeto.parent().parent();
    
    return objeto;
}

//função para serializar com check desmarcado
$(function() {
    $.fn.serialize = function(options) {
        return $.param(this.serializeArray(options));
    };

    $.fn.serializeArray = function(options) {
        var o = $.extend({
            checkboxesAsBools: true
        }, options || {});

        var rselectTextarea = /select|textarea/i;
        var rinput = /text|hidden|password|search/i;

        return this.map(function() {
            return this.elements ? $.makeArray(this.elements) : this;
        })
                .filter(function() {
                    return this.name && !this.disabled &&
                            (this.checked
                                    || (o.checkboxesAsBools && this.type === 'checkbox')
                                    || rselectTextarea.test(this.nodeName)
                                    || rinput.test(this.type));
                })
                .map(function(i, elem) {
                    var val = $(this).val();
                    return val == null ?
                            null :
                            $.isArray(val) ?
                            $.map(val, function(val, i) {
                                return {name: elem.name, value: val};
                            }) :
                            {
                                name: elem.name,
                                value: (o.checkboxesAsBools && this.type === 'checkbox') ? //moar ternaries!
                                        (this.checked ? this.value : 0) :
                                        val
                            };
                }).get();
    };
    
    $.fn.serializeObject = function() {
        var o = {};
        var elementType = $(this).prop('nodeName');

        if (elementType == "DIV")
            var a = $(this).find('input[name],select[name],textarea[name]').serializeArray();
        else 
            var a = this.serializeArray();

        $.each(a, function() {
            if (o[this.name] !== undefined) 
            {
                if (!o[this.name].push) 
                    o[this.name] = [o[this.name]];

                o[this.name].push(this.value || '');
            } 
            else 
                o[this.name] = this.value || '';
        });
        return o;
    };

});

$.fn.preload = function() {
    this.each(function(){
        $('<img/>')[0].src = this;
    });
}

if (typeof console === "undefined" || typeof console.log === "undefined") 
{
    console = {};
    console.log = function() {};
}

function ieversion() 
{
    var ua = window.navigator.userAgent;
    var msie = ua.indexOf("MSIE ");
    
    if (msie > 0)      // If Internet Explorer, return version number
        return parseInt(ua.substring(msie + 5, ua.indexOf(".", msie)));
    else                 // If another browser, return 0
        return -1;    
}

function verificaCookie()
{
    if (!navigator.cookieEnabled) 
    {
        window.location = "cookie.php";
        return false
    }
    
    return true;
}

function desabilitaTagsHtml(str)
{    
    str = str.replace(/</g, "&lt;");
    str = str.replace(/>/g, "&gt;");
    
    return str;
}

function openSelect(elem) 
{
    if (document.createEvent) 
    {
        var e = document.createEvent("MouseEvents");
        e.initMouseEvent("mousedown", true, true, window, 0, 0, 0, 0, 0, false, false, false, false, 0, null);
        elem[0].dispatchEvent(e);
    } 
    else if (element.fireEvent) 
        elem[0].fireEvent("onmousedown");
}

function getIdle()
{    
    $.ajax({
        type: "POST",
        url: "ajax/get_idle.php",
        dataType: 'json',
        cache: false,
        data: {},
        success: function(data) {

        },
        error: function() {

        }
    });
}

function renovaSession()
{
    setTimeout("getIdle(); renovaSession();", 1000*60*5);
}

function isChrome()
{
    var is_chrome = navigator.userAgent.toLowerCase().indexOf('chrome') > -1;
    return is_chrome;
}

function isIe()
{
    var ms_ie = false;
    var ua = window.navigator.userAgent;
    var old_ie = ua.indexOf('MSIE ');
    var new_ie = ua.indexOf('Trident/');

    if ((old_ie > -1) || (new_ie > -1)) 
        ms_ie = true;
    
    return ms_ie;
}

function isie8()
{
    if (ieversion() == 8)
        return true;
    else 
        return false;
}

function isFirefox()
{
    var is_firefox = navigator.userAgent.toLowerCase().indexOf('firefox') > -1;
    return is_firefox;
}

function isSafari()
{
    if (navigator.userAgent.indexOf('Safari') != -1 && navigator.userAgent.indexOf('Chrome') == -1) 
        return true;
    else
        return false;
}

function is_mobile()
{
    if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) 
        return true;
    else 
        return false;
}

function suportDownload()
{
    var a = document.createElement('a');

    if(typeof a.download != "undefined")
        return true;
    else 
        return false;
}

function trataTime(time) {
    
    var d = new Date(parseInt(time));
    
    return trataDigitoData(d.getHours()) + ":" + trataDigitoData(d.getMinutes());
}

function trataDigitoData(numero) 
{
    if (numero < 10) 
        numero = "0" + numero;
    
    return numero;
}

function isEmail(email) 
{    
    if (email == "")
        return true;
    
    var re = /[áàãâäéèêëíìîïóòõôöúùûüçÁÀÃÂÄÉÈÊËÍÌÎÏÓÒÕÖÔÚÙÛÜÇ]/;
    
    if (re.test(email))
        return false;
    
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}

function isData(data)
{    
    var dia, mes, ano, partsData;
    
    if (data.length != 10)
        return false;
    
    if (data.indexOf("/") != -1)
    {
        partsData = data.split('/');
        dia = parseInt(partsData[0]);
        mes = parseInt(partsData[1]);
        ano = parseInt(partsData[2]);
    } 
    else 
    {
        partsData = data.split("-");
        dia = parseInt(partsData[2]);
        mes = parseInt(partsData[1]);
        ano = parseInt(partsData[0]);
    }
    
    var date = new Date(ano, mes-1, dia);

    if (date.getFullYear() == ano && date.getMonth() + 1 == mes && date.getDate() == dia) 
        return true;
    else 
        return false;
}

function isInteger(x)
{ 
    return Math.floor(x) === x; 
}

function retiraAcento(palavra)
{  
    var com_acento = 'áàãâäéèêëíìîïóòõôöúùûüçÁÀÃÂÄÉÈÊËÍÌÎÏÓÒÕÖÔÚÙÛÜÇ';    
    var sem_acento = 'aaaaaeeeeiiiiooooouuuucAAAAAEEEEIIIIOOOOOUUUUC'; 

    for (l in palavra)
    {  
        for (l2 in com_acento)
        {  
            if (palavra[l] == com_acento[l2]) 
                palavra=palavra.replace(palavra[l],sem_acento[l2]);  
        }  
    }  

    return palavra;  
}

function retiraCaracteresEspeciais(palavra)
{
    palavra = retiraAcento(palavra);
    palavra = palavra.replace(/[^a-zA-Z0-9_.-]/g,'_');
    palavra = palavra.replace(/[ -]+/g,'-');
    palavra = palavra.replace(/^-|-$/g,'_');
    palavra = palavra.replace(/[_]{2,}/g,'_');

    return palavra;
}

function codAleatorio()
{
    var caracteres = '0123456789abcdefghijklmnopqrstuvwxyz';
    var codigo_aleatorio = "";
    
    for (var i=0;i<12;i++)
    {
        codigo_aleatorio += caracteres[Math.floor((Math.random() * 36))];
    }
    
    return codigo_aleatorio;    
}

function formataDecimal(valor)
{
    var parts = (valor + "").split("."),
        main = parts[0],
        len = main.length,
        output = "",
        i = len - 1;

    while(i >= 0) 
    {
        output = main.charAt(i) + output;

        if ((len - i) % 3 === 0 && i > 0) 
            output = "." + output;

        --i;
    }

    // put decimal part back
    if (parts.length > 1) 
        output += "," + parts[1];

    return output;
}

function retornaObjetoAmazon(strJsonAmazon, modulo)
{
    var objetoAmazon = JSON.parse(strJsonAmazon);    
    var keysTratar = ['key', 'Policy', 'X-Amz-Signature'];
    
    $.each(objetoAmazon, function(index, value){
        if ($.inArray(index, keysTratar) !== -1 )
            objetoAmazon[index] = value[modulo];
    });
    
    return objetoAmazon;    
}

function retornaBinarioThumb(file, objetoBinario)
{
    var cb = "";

    if (file.type.indexOf("image") != -1)
    {
        var fr = new FileReader();
        var img;

        fr.onloadend = function () {
            var img = new Image();
            img.onload = function() {
                var canvas = $("<canvas/>").attr("id", "myCanvas");                
                $("body").append(canvas);
                canvas = document.getElementById("myCanvas"); 
                var context = canvas.getContext('2d');                                
                var imageWidth = this.width;
                var imageHeight = this.height;
                var newWidth = imageWidth/imageHeight*63;

                canvas.width = newWidth;
                canvas.height = 63;
                canvas.style.display = 'none';

                context.drawImage(this, 0, 0, newWidth, 63);
                cb = canvas.toDataURL(); 
                var posCodigoBinario = cb.indexOf(",");
                cb = cb.substr(posCodigoBinario+1);
                objetoBinario.cb = cb;
            };
            img.src = fr.result;
        }
        fr.readAsDataURL(file);   
    }
    
     window['codigoBinario'] = cb;
}

if (!Object.keys) 
{
    Object.keys = function(obj) {
    var keys = [];

    for (var i in obj) 
    {
        if (obj.hasOwnProperty(i)) 
            keys.push(i);
    }   

    return keys;
    };
}

function mascaraNumero(valor, precisao)
{
    $("body").append($("<input>").attr("type", "hidden").attr("id", "moneytemp"));
    
    if (precisao != undefined)
        valor = Number(valor).toFixed(precisao);
    
    var objetoMaskMoney = {thousands:'.', decimal:','};
    
    if (precisao != undefined)
        objetoMaskMoney.precision = precisao; 
    
    $("#moneytemp").maskMoney(objetoMaskMoney);
    $("#moneytemp").val(valor).trigger('mask.maskMoney');

    var moneytemp = $("#moneytemp").val()

    $("#moneytemp").remove();

    return moneytemp;
}

function isNumber(n) 
{
  return !isNaN(parseFloat(n)) && isFinite(n);
}

function isAlphaNumeric(string)
{
    if( string.match(/^[a-zA-Z0-9]+/) )
        return true

    return false;
}

function replaceAll(str, find, replace) 
{
    return str.split(find).join(replace);
}

function formataNumeroBD(valor)
{
    valor = replaceAll(valor,".","");
    valor = valor.replace(",",".");
    
    return valor;
}

function formataDataBrasil(data)
{ 
    if (data.indexOf("/") !== false)
        return data;
    
    data = new Date(data);
    data = $.datepicker.formatDate('dd/mm/yy', data, "pt-BR");
    
    return data;
}

function lowerExtensao(filename)
{
    var posicao = filename.lastIndexOf(".");
    
    filename = filename.substr(0, posicao) + filename.substr(posicao).toLowerCase();

    return filename;
}