{literal}
<script>
    var snippet_tab_item = function () {
        "use strict";
        var urlsys = '{/literal}{$path_url}/{$id}{literal}';
        var handler_tab_build = function(){
            coreUyuni.setTabs();
        };

        /**
         * Boton para realizar la derivación
         */
        var btn_derivar;
        var handle_button_derivar = function(){
            {/literal}{if $type =='update'}{literal}
            $('#btn_back').before('<a href="#" class="btn btn-success btn-sm mr-1" id="btn_derivar" rel="new"><i class="fas fa-share-square"></i>Derivar</a> ');
            {/literal}{/if}{literal}
            btn_derivar = $('#btn_derivar');
            btn_derivar.click(function(e){
                e.preventDefault();
                var subcontrol = "index";
                var load_url = urlsys+"/get.form.derivar/";
                let cargando = lngUyuni.loading+'...'+cargando_vista;
                $("#modal-content_"+subcontrol).html(cargando);
                $("#form_modal_"+subcontrol).modal("show");
                $.get(load_url, function(data) {
                    $("#modal-content_"+subcontrol).html(data);
                });
            });
        };

        return {
            init: function() {
                handler_tab_build();
                {/literal}{if $privFace.edit == 1}{literal}
                handle_button_derivar();
                {/literal}{/if}{literal}
            }
        };
    }();

    jQuery(document).ready(function() {
        $('#btn_back').removeClass('d-none');
        snippet_tab_item.init();
        $('#{/literal}{$menu_tab_active}{literal}_tab').trigger('click');
    });
</script>
{/literal}


