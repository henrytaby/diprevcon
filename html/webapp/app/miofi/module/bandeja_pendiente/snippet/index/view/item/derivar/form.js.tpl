{literal}
<script>
    var snippet_form_{/literal}{$subcontrol}{literal} = function() {
        "use strict";
        let form = $('#form_{/literal}{$subcontrol}{literal}');
        let btn_submit = $('#form_submit_{/literal}{$subcontrol}{literal}');
        let btn_close = $('#form_close_{/literal}{$subcontrol}{literal}');
        let pmodal = $("#form_modal_{/literal}{$subcontrol}{literal}");
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
            lngUyuni.formShowResponseErrorSaveTitle = "No se puede derivar";
            lngUyuni.saveError10 = "Esta hoja de ruta ya fue derivada.";
            coreUyuni.itemFormShowResponse(res,pmodal,'');
            btn_close.attr('disabled', false);
            btn_submit.removeClass('spinner spinner-white spinner-right').attr('disabled', false);

            if(res.res==1){
                table_list.ajax.reload();
                //$('#general_tab').trigger('click');
            }else{
                //$('#general_tab').trigger('click');
            }
            pmodal.modal("hide");
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
                $('#description_input').val($('#description').summernote('code'));
                formv.validate().then(function(status) {
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
            $('.select2_deriva').select2({
                placeholder: lngUyuni.select2PlaceHolder,
                width: '100%',
                escapeMarkup: function(markup) {
                    return markup;
                }
            });

        };

        var limite_div= $('#limite_div');
        var limite_checkbox= $('#limite');
        var handle_limite_select = function(){
            limite_checkbox.on('change',function(){
                handle_limite();
            });
        };

        var handle_limite = function(){
            var id = limite_checkbox.prop('checked') ;
            id = id==null? '': id.toString();
            limite_div.addClass('d-none');
            switch (id){
                case 'true':
                    limite_div.removeClass('d-none');
                    break;
            }
        };
        var proceso_input = $('#proceso_id');
        var handle_proceso_select = function(){
            proceso_input.on('change',function(){
                handle_proceso();
            });
        };

        {/literal}
        {if $uservAdd.jefe}
        let actividad = [];
        {foreach from=$cataobj.actividadArray item=row key=idx}
        actividad[{$row.id}] =['{$row.limite}','{$row.dias}','{$row.horas}','{$row.minutos}'];
        {/foreach}
        {/if}
        {literal}

        var handle_proceso = function(){
            let id = proceso_input.val();
            id = id==null? '': id.toString();
            //console.log(id+" <--");
            limite_div.addClass('d-none');
            if(id=="null"){
                limite_checkbox.prop( "checked", false );
            }else{
                if(actividad[id][0]=='1'){
                    limite_checkbox.prop( "checked", true );
                    limite_div.removeClass('d-none');
                    //console.log(actividad[id]);
                    $('#proceso_dias').val(actividad[id][1]);
                    $('#proceso_horas').val(actividad[id][2]);
                    $('#proceso_minutos').val(actividad[id][3]);
                }else{
                    limite_checkbox.prop( "checked", false );
                    $('#proceso_dias').val(0);
                    $('#proceso_horas').val(0);
                    $('#proceso_minutos').val(0);
                }

            }
        };


        //== Public Functions
        return {
            // public functions
            init: function() {
                handle_form_submit();
                handle_btn_submit();
                handle_components();
                {/literal}
                    {if $uservAdd.jefe}
                handle_limite_select();
                handle_proceso_select();
                    {/if}
                {literal}

            }
        };
    }();

    jQuery(document).ready(function() {
        snippet_form_{/literal}{$subcontrol}{literal}.init();
    });

</script>
{/literal}
