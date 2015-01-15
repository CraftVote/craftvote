$(document).ready(function() {
    EventRegister.changeTime();
    EventRegister.onForm(null);
    EventRegister.onFile(null);
    EventRegister.onChangeSelectDepend();
    EventRegister.onAlbumImgClick();
    EventRegister.onPopupLink();
    
    $('#captcha-img').click(function(){
        $(this).attr("src", "/_system/captcha?"+ new Date().getTime());
    });
});


var Time = {
    
    now : function(){
        return new Date().getTime();
    },
    
    calc : function(raw, offset){
        monthA = 'января,февраля,марта,апреля,мая,июня,июля,августа,сентября,октября,ноября,декабря'.split(',');
        var date = new Date(raw);
        date.setHours(date.getHours()+offset);
        return date.getDate()+' '+monthA[date.getMonth()]+' '+date.getFullYear()+' в '+date.getHours()+':'+(date.getMinutes()<10?'0':'')+date.getMinutes();
    }
};

var FormValidator = {
    formName : '',
    elements : [],
    action : '',
    buttonTitle : '',
    rules : {},
    outFields : [],
    button : {},
    init : function(button, json){
        if ($(button).attr('submit') === undefined){
            console.log('Form name is undefined');
            this.formName = '';
            this.elements = [];
            this.rules = {};
            this.button = {};
            return false;
        }
        else{
            this.button = button;
            this.formName = $(button).attr('submit');
            this.elements = document.forms[this.formName].elements;
            this.action = document.forms[this.formName].action;
            this.buttonTitle = $(button).text();
            if (json === null){
                var data = $('form[name="'+this.formName+'"] input[name="__rules"]').val();
                if (data !== undefined){
                    this.rules = JSON.parse(window.atob(data));
                }
            }
            else{
                this.rules = json;
            }
        }
    },
    startLoading : function(){
        $(this.button).text('Loading...');
        $(this.button).attr('state-loading', 'loading');
        $(this.button).prop('disabled', true);
    },
    stopLoading : function(){
        $(this.button).text(this.buttonTitle);
        $(this.button).attr('state-loading', 'stopped');
        $(this.button).prop('disabled', false);
    },
    clearNotices : function(){
        $('.has-error').removeClass('has-error');
        $('.has-success').removeClass('has-success');
        $( ".form-error-text" ).remove();
        $( "span.form-control-feedback" ).remove();
        $( "div.alert-dismissible" ).remove();
    },
    throwError : function(name, text){
        var element = $('form[name="'+this.formName+'"] [name="'+name+'"]');
        if ($(element).parent().hasClass('input-group')){
        $(element).parent().parent().addClass('has-error');
        $(element).parent().after('<span class="form-error-text"> '+text+'</span>');
        $(element).parent().after('<span class="glyphicon glyphicon-remove form-error-text"></span>');
        }
        else{
            $(element).parent().addClass('has-error');
            $(element).after('<span class="form-error-text"> '+text+'</span>');
            $(element).after('<span class="glyphicon glyphicon-remove form-error-text"></span>');
        }
    },
    verifyField : function(Element){
        // Required
        if (Element.rule === undefined){
            return true;
        }
        
        if ((Element.rule.required === true)&&(Element.value === '')){
            this.throwError(Element.name, 'обязательное поле');
            console.log(Element.name);
            return false;
        }
        
        // Min length
        if ((Element.rule.minlen !== null)&&(Element.rule.minlen > 0)&&(Element.value.length < Element.rule.minlen)&&(Element.value.length > 0)){
            this.throwError(Element.name, 'минимум '+Element.rule.minlen+' символа(ов)');
            return false;
        }
        
        // Max length
        if ((Element.rule.maxlen !== null)&&(Element.rule.maxlen > 0)&&(Element.value.length > Element.rule.maxlen)&&(Element.value.length > 0)){
            this.throwError(Element.name, 'максимум '+Element.rule.minlen+' символа(ов)');
            return false;
        }
        
        // Custom validation
        if (Element.rule.validation.length > 0){
            for(var i=0;i<Element.rule.validation.length;i++){
                if (Element.rule.validation[i].type === 'email'){
                    var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                    if (!filter.test(Element.value)){
                        this.throwError(Element.name, 'неправильный формат адреса');
                        return false;
                    }
                }
                if (Element.rule.validation[i].type === 'number'){
                    var filter = /^([0-9]+)$/;
                    if (!filter.test(Element.value)){
                        this.throwError(Element.name, 'только целое число');
                        return false;
                    }
                }
                if (Element.rule.validation[i].type === 'equalfield'){
                    var ef = Element.rule.validation[i].param;
                    var ev = $('form[name="'+this.formName+'"] [name="'+ef+'"]').val();
                    if (Element.value !== ev){
                        this.throwError(Element.name, 'значения не совпадают');
                        this.throwError(ef, 'значения не совпадают');
                        return false;
                    }
                }
            }
        }
        return true;
    },
    getElementValue : function(Element){
        if (Element.id === "html-editor"){
            return $('#wysiwyg').html();
        }
        if ((Element.tag === "INPUT")&&(Element.type === "radio")){
            return $('input[name="'+Element.name+'"]:checked').val();
        }
        return false;    
    },
    grabFields : function(){
        this.outFields = [];
        var Element = {};
        var clear = true;
        for(var i=0;i<this.elements.length;i++){
            Element.tag = this.elements[i].tagName.toUpperCase();
            Element.type = this.elements[i].type;
            Element.id = this.elements[i].id;
            Element.name = this.elements[i].getAttribute("name");
            if ((Element.tag === 'BUTTON')||(Element.name === null)||(Element.name === '__rules')){
                continue;
            }
            if ((Element.tag === 'INPUT')&&(Element.type === 'checkbox')){
                var value = '0';
                if ($('form[name="'+this.formName+'"] [name="'+Element.name+'"]').is(':checked')){
                    value = '1';
                }
                this.outFields.push({name: Element.name, value: value});
                continue;
            }
            Element.value = this.getElementValue(Element);
            if (Element.value === false){
                Element.value = this.elements[i].value;
            }
            if ((Element.tag === 'INPUT')&&(Element.type === 'hidden')){
                this.outFields.push({name: Element.name, value: Element.value});
                continue;
            }
            Element.rule = this.rules[Element.name];
            if (!this.verifyField(Element)){
                clear = false;
            }
            else{
                this.outFields.push({name: Element.name, value: Element.value});
            }
         }
         return clear;
    },
    validate : function(){
        this.startLoading();
        this.clearNotices();
        if (this.grabFields()){
            var req = new HttpRequest(this.action, null, this.failedCallback, this.defaultCallback);
            req.send(this.outFields);
        }
        else{
            this.stopLoading();
        }
    },
    failedCallback : function(data){
        for(var i=0;i<data.length;i++){
            FormValidator.throwError(data[i].name, data[i].error);
        }
    },
    defaultCallback : function(data){
        FormValidator.stopLoading();
    }
};

function refreshCaptcha(){
    $("#captcha-img").attr("src", "/_system/captcha?"+(new Date()).getTime());
}

function HttpRequest(action, success_callback, failed_callback, default_callback){
    
    this.send = function(fields){
        $.ajax({
        type: 'POST',
        dataType: 'json',
        url: action,
        data: fields,
        success: function(data){
 
            if(data.type === 'alert'){
                Alert.show(data.value, data.color);
                scroll(0,0);
            }
            
            if(data.type === 'refresh'){
                window.location.reload();
            }
            
            if(data.type === 'redirect'){
                window.location.href = data.value;
            }
            
            if(data.type === 'popup'){
                Modal.hide();
                Modal.popup(data.title, data.value);
            }
                  
            if(data.type === 'success'){
                if (typeof success_callback === "function"){
                    success_callback(data.value);
                }
            }
            
            if(data.type === 'func'){
                var fn = window[data.func];
                if (typeof fn === "function"){
                    fn(data.value);
                }
            }
                
            if(data.type === 'fail'){
                if (typeof failed_callback === "function"){
                    failed_callback(data.value);
                }
            }
            
            if (typeof default_callback === "function"){
                    default_callback(data);
            }
            
            if(data.clear !== undefined){
                $('form[name="'+data.clear+'"]')[0].reset();
            }
            
            if(data.captcha !== undefined){
                refreshCaptcha();
            }
        },
        error: function(jqXHR, textStatus, errorThrown){
            alert(textStatus+': '+jqXHR.status+' ('+errorThrown+')');
            if (typeof default_callback === "function"){
                default_callback({type: 'error', value: errorThrown});
            }
            Modal.clearForms();
        }
        });
    };
};


function UploadFile(filename, action){
    
    this.getPostData = function(){
        var data = new FormData();
        jQuery.each($('#file-dest')[0].files, function(i, file){
            data.append('upfile', file);
        });
        return data;
    };
    this.processError = function(){
        $('#file-label').html('<p class="form-control-static text-danger">error</p>');
    };
    this.processSuccess = function(result){
        var res = filename.split('\\');
        var shortname = res[res.length-1];
        $('#file-label').html('<p class="form-control-static text-muted">'+shortname+'</p>');
        $('#file-result').val(result).change();
        $('<input type="hidden" name="'+$('#file-dest').attr('name')+'-real" value="'+shortname+'">').insertAfter('#file-label');
        $('<input type="hidden" name="'+$('#file-dest').attr('name')+'" value="'+result+'">').insertAfter('#file-label');
        $("#file-dest").remove();
    };
    this.processFail = function(result){
        $('#file-label').html('<p class="form-control-static text-danger">'+result+'</p>');
        $("#file-btn").show();
    };
    this.doRequest = function(onsuccess, onfail, onerror){
         $.ajax({
            type: 'POST',
            url: action,
            data: this.getPostData(),
            cache: false,
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function(result){
                if (result.type === 'success'){
                    onsuccess(result.value);
                }
                if (result.type === 'fail'){
                    onfail(result.value);
                }
            },
            error: function(jqXHR, textStatus, errorThrown){
                onerror();
            }
        });  
    };
    this.upload = function(callback){
        $('#file-label').html('<img src="/res/img/system/ajax-loader.gif">');
        $("#file-btn").hide();
        if (typeof callback === "function"){
            this.doRequest(callback, this.processFail, this.processError);
        }
        else{
            this.doRequest(this.processSuccess, this.processFail, this.processError);
        }
        
    };
}


EventRegister = {
    
    changeTime : function(){
        var server = Math.floor(parseInt($('meta[name="timestamp"]').attr('content')) / 60 / 60);
        if (parseInt === 0){
            alert('Error: Not found META Timestamp');
            return;
        }
        var client = Math.floor(Time.now() / 1000 / 60 / 60);
        var offset = client - server;
        jQuery.each($('.time'), function(){
             $(this).text(Time.calc($(this).text(), offset));
        });
    },
    
    onForm : function(json){
        $('button[state-loading="stopped"]').bind("click", function(e){
            FormValidator.init(this, json);
            FormValidator.validate();
            return false;
        });
        $('#captcha-img').click(function(){
            $(this).attr("src", "/_system/captcha?"+ new Date().getTime());
        });
        $('.search-area button').click(function(){
            var keystring = $(this).parent().parent().children('input').val();
            if (keystring === ''){
                Modal.popup('', 'Введите фразу для поиска');
            }
            else{
                var callback = function(input){
                    if ($.isArray(input)){
                        var count = input.length;
                        var html = '<small class="text-muted">Найдено: '+count+'</small><table class="table table-striped table-bordered">';
                        for(var i=0;i<count;i++){
                            html += '<tr><td><a target="_blank" href="/company/'+input[i].id+'">'+input[i].fullname+'</a></td><td>'+input[i].category+'</td><td>'+input[i].subcategory+'</td><td>Скидка '+input[i].sale+'%</td></tr>';
                        }
                        html += '</table>';
                        $('#search-result').html(html);
                    }
                    else{
                        $('#search-result').html('<p class="text-danger">Ничего не найдено</p>');
                    }
                };
                var http = new HttpRequest('/sales/search', callback, null, null);
                http.send({key : keystring});
            }
        });
    },
    onFile : function(callback){
        $("#file-btn").click(function() {
            $('#file-dest').click();
        });
        $("#file-dest").change(function() {
            var filename = $(this).val();
            var action = $(this).attr('url');
            var file = new UploadFile(filename, action);
            file.upload(callback);
        });
    },
    
    onAlbumImgClick : function(){
       $("a.thumbnail img").click(function() {
            Modal.viewImg($(this).attr('src'), $(this).attr('alt'), $(this).attr('img-date'), '/personal/album/delete/'+$(this).attr('img-id'), $(this).attr('img-my'), $(this).attr('img-source'));
            return false;
        });
    },
    
    onPopupLink : function(){
        $('a[class="text-popup"]').click(function(){
            Modal.popup('Иллюстрация', '<img class="img-responsive" src="'+$(this).attr('href')+'">');
            return false;
        });
    },
    
    activeField : '',
    
    onChangeSelectDepend : function(){
        $('select[depend-field]').change(function(){
            EventRegister.activeField = $(this).attr('depend-field');
            $('select[name="'+EventRegister.activeField+'"]').attr('disabled', 'disabled');
            var url = $(this).attr('depend-url');
            
            var value = $(this).val();
            var req = new HttpRequest(url, EventRegister.doLoadSelectOptions, null, null);
            req.send({value: value});
        });
    },
    
    doLoadSelectOptions : function(data){
        var html = '<option value=""></option>';
        $.each(data, function(key, val){
            html += '<option value="'+key+'">'+val+'</option>';
        });
        $('select[name="'+EventRegister.activeField+'"]').html(html);
        $('select[name="'+EventRegister.activeField+'"]').removeAttr('disabled');
    }
};


Alert = {
    
    clear : function(){
        var selector = this.getWindow();
        $(selector).html('');
    },
    
    getWindow : function(){
        var selector = '#alert-area';
        if ($('#modal-alert').length > 0){
            if ($("#main-modal").is(":visible")){
                selector = '#modal-alert';
            }
        }
        return selector;
    },
    
    show : function(text, color){
        var selector = this.getWindow();
        var color_class = 'alert-success';
        switch(color){
            case 2: color_class = 'alert-warning'; break;
            case 3:
                color_class = 'alert-danger';
                text = '<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> '+text;
                break;
            case 4: color_class = 'alert-info'; break;
        }
        $(selector).html('<div class="alert '+color_class+' alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>'+text+'</div>');
    }
};


Modal = {
    
    viewImg : function(src, comment, date, delete_action, is_my, source){
        this.clearForms();
        this.createLayout();
        this.show();
        this.setHeader('<p class="modal-title">'+date+'</p>');
        this.setBody('<img class="img-responsive" src="'+src+'">');
        var company = '';
        if (source !== undefined){
            company = '<small><a href="/company/'+source+'">Источник</a></small>';
        }
        var button = '';
        if ((is_my === '1')&&(source === undefined)){
            button = '<a onclick="Modal.confirm(\'Вы уверены что хотите безвозвратно удалить это фото?\', \''+delete_action+'\'); return false;" href="#"><span class="glyphicon glyphicon-trash"></span></a>';
        }
        this.appendToFooter('<p class="pull-left"><small>'+comment+'</small></p><p>'+company+button+'</p>');
    },
    
    loadForm : function(action){
        this.clearForms();
        this.createLayout();
        this.show();
        var request = new HttpRequest(action, Modal.formcallback, Modal.failedcallback, null);
        request.send({});
    },
    
    popup : function(title, body){
        this.clearForms();
        this.createLayout();
        this.show();
        this.setHeader('<h3>'+title+'</h3>');
        this.setBody('<p>'+body+'</p>');
        this.appendToFooter(' <button type="button" class="btn btn-default btn-width-sm" data-dismiss="modal">Ok</button>');
    },
    
    input : function(title, default_value, action){
        this.clearForms();
        this.createLayout();
        this.show();
        this.setHeader('<h2>Редактирование</h2>');
        this.setBody('<p>'+title+'</p><form action="'+action+'" name="confirm_input_form" class="form-horizontal" role="form"><div class="form-group has-feedback"><div class="col-sm-12 col-sm-offset-0"><input class="form-control" name="confirm_input_value" value="'+default_value+'" maxlength="128" type="text"></div></div></form>');
        this.appendToFooter('<button type="button" submit="confirm_input_form" state-loading="stopped" class="btn btn-primary">Сохранить</button> ');
        this.appendToFooter(' <button type="button" class="btn btn-default btn-width-sm" data-dismiss="modal">Отмена</button>');
        EventRegister.onForm(null);
        return false;
    },
    
    confirm : function(title, url, value){
        this.clearForms();
        this.createLayout();
        this.show();
        this.setHeader('<h2>Подтверждение</h2>');
        this.setBody('<p>'+title+'</p>');
        this.appendToFooter('<button onclick="Modal.doConfirm(\''+url+'\', \''+value+'\');" type="button" class="btn btn-primary btn-width-sm">Да</button> ');
        this.appendToFooter(' <button type="button" class="btn btn-default btn-width-sm" data-dismiss="modal">Отмена</button>');
    },
    
    confirm_call_buffer : null,
    
    confirmInput : function(title, default_value, callback){
        this.clearForms();
        this.createLayout();
        this.show();
        this.confirm_call_buffer = callback;
        this.setHeader('<h2>Подтверждение</h2>');
        this.setBody('<p>'+title+'</p><input class="form-control" id="modal-input" type="text" value="'+default_value+'">');
        this.appendToFooter('<button onclick="Modal.doInputConfirm();" type="button" class="btn btn-primary btn-width-sm">Принять</button> ');
        this.appendToFooter(' <button type="button" class="btn btn-default btn-width-sm" data-dismiss="modal">Отмена</button>');
    },
    
    doInputConfirm : function(){
        if (this.confirm_call_buffer !== null){
            var value = $('#modal-input').val();
            this.confirm_call_buffer(value);
            this.confirm_call_buffer = null;
            Modal.hide();
        }
    },
    
    doConfirm : function(url, value){
        var req = new HttpRequest(url, null, null, null);
        req.send({confirm_input_value : value});
        Modal.hide();
    },
    
    formcallback : function(data){
        Modal.setHeader('<h3>'+data.title+'</h3>');
        Modal.setBody(Modal.jsonToHtmlForm(data));
        Modal.appendToFooter(Modal.jsonToHtmlButtons(data.buttons));
        Modal.appendToFooter('<button type="button" class="btn btn-default btn-width-sm" data-dismiss="modal">Отмена</button>');
        EventRegister.onForm(data.elements);
        EventRegister.onFile(null);
    },
    
    failedcallback : function(data){
        alert(data);
    },
    
    setHeader : function(header){
        $('#main-modal .modal-header').append(header);
    },
    
    setBody : function(body){
        $('#main-modal .modal-body').html(body);
    },
    
    show : function(){
        $('#main-modal').modal('show');
    },
    
    hide : function(){
        $('.modal').modal('hide');
    },
    
    appendToFooter : function(element){
        $('#main-modal .modal-footer').append(element);
    },
    
    clearForms : function(){
        if ($('#main-modal').length > 0){
            $('#main-modal').remove();  
        }
        if ($('.modal-backdrop').length > 0){
            $('.modal-backdrop').remove();  
        }
    },
    
    jsonToHtmlForm : function(json){
        var html = '<form';
        $.each(json.attributes, function(key, val){
            html += ' '+key+'="'+val+'"';
        });
        html += '>';
        var buffer = '';
        $.each(json.elements, function(name, attr){
            if (attr.type === 15){
                buffer += '<div class="form-group has-feedback"><div class="col-sm-'+json.field_len+' col-sm-offset-'+json.label_len+'">';
            }
            else{
                if (attr.label === null){
                    html += '<div class="form-group has-feedback"><div class="col-sm-'+json.field_len+' col-sm-offset-'+json.label_len+'">';
                }
                else{
                    html += '<div class="form-group has-feedback"><label class="col-sm-'+json.label_len+' control-label">'+attr.label+'</label><div class="col-sm-'+json.field_len+'">';
                }
            }    
            switch (attr.type){
                case 0:
                    html += Modal.renderFormElementInput(name, attr);
                    break;
                case 1:
                    html += Modal.renderFormElementInput(name, attr);
                    break;
                case 2:
                    html += Modal.renderFormElementSelect(name, attr);
                    break;
                case 3:
                    html += Modal.renderFormElementCheckbox(name, attr);
                    break;
                case 4:
                    html += Modal.renderFormElementRadio(name, attr);
                    break;
                case 5:
                    html += Modal.renderFormElementTextarea(name, attr);
                    break;
                case 6:
                    html += Modal.renderFormElementCaptcha(name);
                    break;
                case 7:
                    html += Modal.renderFormElementStaticText(attr);
                    break;
                case 9:
                    html += Modal.renderFormElementHidden(name, attr);
                    break;
                case 12:
                    html += Modal.renderFormElementFile(name, attr);
                    break;
                case 15:
                    buffer += Modal.renderFormElementDesign(attr);
                    break;
                default:  html += 'undefined';
            }
            html += '</div></div>';
        });
        html += buffer+'</form>';
        return html;
    },
    
    jsonToHtmlButtons : function(json){
        var html = '';
        for (var i=0;i<json.length;i++){
            var form = '';
            if (json[i].submit === true){
                form = ' state-loading="stopped" submit="'+json[i].form+'"';
            }
            html += '<button class="'+json[i].class+'"'+form+'>'+json[i].title+'</button>';
        }
        return html;
    },
    
    renderFormElementDesign : function(attr){
        return attr['html'];
    },
    
    renderFormElementRadio : function(name, attr){
        var html = '';
        $.each(attr.items, function(key, val){
            if (attr.value == key){
                html += '<div class="radio"><label><input type="radio" name="'+name+'" value="'+key+'" checked> '+val+'</label></div>';
            }
            else{
                html += '<div class="radio"><label><input type="radio" name="'+name+'" value="'+key+'"> '+val+'</label></div>';
            }
        });
        return html;
    },
    
    renderFormElementCheckbox : function(name, attr){
        var html = '';
        html += '<div class="checkbox"><label><input type="checkbox" name="'+name+'">'+attr.title+'</label></div>';
        return html;
    },
    
    renderFormElementStaticText : function(attr){
        var html = '<p class="form-control-static">'+attr.value+'</p>';
        return html;
    },
    
    renderFormElementCaptcha : function(name){
        var html = '<div class="row"><div class="col-xs-6"><img id="captcha-img" src="/_system/captcha"></div><div class="col-xs-6"><input class="form-control" type="text" name="'+name+'"></div></div>';
        return html;
    },
    
    renderFormElementTextarea : function(name, attr){
        var html = '<textarea class="form-control" name="'+name+'"';
        if (attr.disabled === true){
            html += ' disabled';
        }
        if (attr.placeholder !== null){
            html += ' placeholder="'+attr.placeholder+'"';
        }
        if (attr.rows !== null){
            html += ' rows="'+attr.rows+'"';
        }
        if (attr.maxlen !== null){
            html += ' maxlength="'+attr.maxlen+'"';
        }
        html += '>';
        if (attr.value !== null){
            html += attr.value;
        }
        html += '</textarea>';
        return html;
    },
    
    renderFormElementSelect : function(name, attr){
        var html = '<select class="form-control" name="'+name+'"';
        if (attr.disabled === true){
            html += ' disabled';
        }
        html += '>';
        for(var i=0;i<attr.items.length;i++){
            $.each(attr.items[i], function(key, val){
                html += '<option value="'+key+'">'+val+'</option>';
            });
        }
        html += '</select>';
        return html;
    },
    
    renderFormElementInput : function(name, attr){
        var html = '<input class="form-control"';
        if (attr.type === 0){
            html += ' type="text"';
        }
        else{
            html += ' type="password"';
        }
        html += ' name="'+name+'"';
        if (attr.value !== null){
            html += ' value="'+attr.value+'"';
        }
        if (attr.placeholder !== null){
            html += ' placeholder="'+attr.placeholder+'"';
        }
        if (attr.maxlen !== null){
            html += ' maxlength="'+attr.maxlen+'"';
        }
        if (attr.disabled === true){
            html += ' disabled';
        }
        html += '>';
        return html;
    },
    
    renderFormElementHidden : function(name, attr){
        return '<input type="hidden" name="'+name+'" value="'+attr.value+'">';
    },
    
    renderFormElementFile : function(name, attr){
        return '<span id="file-label"></span> <button id="file-btn" class="btn btn-default btn-sm" type="button">Обзор</button><input id="file-dest" url="'+attr.url+'" name="'+name+'" type="file" style="visibility:hidden;">';
    },
    
    createLayout : function(){
        $("body").append('<div id="main-modal" class="modal fade" role="dialog"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button></div><div id="modal-alert"></div><div class="modal-body"><p><div class="block-center"><img src="/res/img/system/ajax-loader.gif"></div></p></div><div class="modal-footer"></div></div></div></div>');
    }
    
};