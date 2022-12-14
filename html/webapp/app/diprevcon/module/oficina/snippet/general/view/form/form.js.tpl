{literal}
<script>
    var snippet_form_{/literal}{$subcontrol}{literal} = function() {
        "use strict";
        var form = $('#form_{/literal}{$subcontrol}{literal}');
        var btn_submit = $('#form_submit_{/literal}{$subcontrol}{literal}');
        var btn_close = $('#form_close_{/literal}{$subcontrol}{literal}');
        var pmodal = $("#form_modal_{/literal}{$subcontrol}{literal}");
        var formv;
        /**
         * Antes de enviar el formulario se ejecuta la siguiente funcion
         */
        var showRequest= function(formData, jqForm, op) {
            btn_submit.addClass('spinner spinner-white spinner-right').attr('disabled', true);
            btn_close.attr('disabled', true);
            return true;
        };
        var showResponse = function (res, statusText) {
            coreUyuni.itemFormShowResponse(res,pmodal,table_list);
            btn_close.attr('disabled', false);
            btn_submit.removeClass('spinner spinner-white spinner-right').attr('disabled', false);
        };
        /**
         * Opciones para generar el objeto del formulario
         */
        var options = {
            beforeSubmit:showRequest
            , success:  showResponse
            , data: {type:'{/literal}{$type}{literal}'}
        };
        /**
         * Se da las propiedades de ajaxform al formulario
         */
        var handle_form_submit=function(){
            form.ajaxForm(options);
            formv = FormValidation.formValidation(
                document.getElementById('form_{/literal}{$subcontrol}{literal}'),
                {
                    plugins: {
                        declarative: new FormValidation.plugins.Declarative({html5Input: true,}),
                        trigger: new FormValidation.plugins.Trigger(),
                        bootstrap: new FormValidation.plugins.Bootstrap(),
                        submitButton: new FormValidation.plugins.SubmitButton(),
                    }
                }
            );
        };
        /**
         * Se da las funcionalidades al boton enviar
         */
        var handle_btn_submit = function() {
            btn_submit.click(function(e) {
                e.preventDefault();
                /**
                 * Copiamos los datos de summerNote a una variable
                 */
                formv.validate().then(function(status) {
                    console.log(status);
                    if(status === 'Valid'){
                        form.submit();
                    }
                });
            });
        };
        /**
         * Iniciamos los componentes necesarios como , summernote, select2 entre otros
         */
        var handle_components = function(){
            coreUyuni.setComponents();
        };

        var handle_type_select = function(){
            $('#type_select').on('change',function(){
                handle_type();
            });
        };

        var folder_div= $('#folder_div');
        var url_div = $('#url_div');

        var handle_type = function(){
            var id = $('#type_select').val();
            id = id==null? '': id.toString();
            url_div.addClass('d-none');
            folder_div.addClass('d-none');
            switch (id){
                case 'url':
                    url_div.removeClass('d-none');
                    break;
                case 'module':
                    folder_div.removeClass('d-none');
                    break;
            }
        };

        //== Public Functions
        return {
            // public functions
            init: function() {
                handle_form_submit();
                handle_btn_submit();
                handle_components();
                handle_type_select();
            }
        };
    }();

    //== Class Initialization
    jQuery(document).ready(function() {
        snippet_form_{/literal}{$subcontrol}{literal}.init();
    });

</script>
{/literal}
