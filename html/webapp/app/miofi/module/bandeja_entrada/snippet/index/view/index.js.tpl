{literal}
<script>

    var table_list;
    var snippet_list = function() {
        "use strict";
        var show_data_template2 = function (datos) {
            let html = "";
            $("#mostrar_bandeja").html(html);
            let img;
            jQuery.each( datos, function( i, val ) {
                html += '<div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 p-2"><div class="card card-custom gutter-b card-stretch m-0 p-0"><div class="card-body pt-4 px-3">';
                img = urlsys+"/"+val.actions+"/portada?r="+Math.floor(Math.random() * 101);;
                html += '<div class="bgi-no-repeat bgi-size-cover rounded min-h-200px" style="background-image: url('+img+')"></div>';
                html += '<a href="javascript:snippet_list.update(\''+val.actions+'\');" class="btn btn-block btn-sm btn-light-danger font-weight-bolder text-uppercase py-4 mt-2">Ver Proyecto</a>'
                html += '<p class="mb-7">'+val.servicio+'</p>';
                html += '<div class="mb-2">';
                html += moreInfo("Sector",val.sector_id);
                html += moreInfo("Fecha Inicio",val.fecha_inicio);
                html += moreInfo("Fecha Fin",val.fecha_fin);
                //html += moreInfo("Cliente",val.cliente);
                html += '</div>';
                html += '<p class="mb-7"><strong>Cliente: </strong>'+val.cliente+'</p>';
                html += '</div></div></div>'
            });
            $("#mostrar_bandeja").html(html);
        };
        var moreInfo2 = function(label,valor){

            let html = '<div class="d-flex justify-content-between align-items-center">' +
                '<span class="text-dark-75 font-weight-bolder mr-2">'+label+'</span>' +
                '<span class="text-muted font-weight-bold">'+valor+' </span>' +
                '</div>';
            return html;
        };

        var show_data_template = function (datos) {
            let html = "";
            $("#mostrar_bandeja").html(html);
            let img;
            jQuery.each( datos, function( i, val ) {
                html += '<div class="card card-custom gutter-b"><div class="card-body">';
                html += html_top(val);
                html += '</div></div>'
            });
            $("#mostrar_bandeja").html(html);
        };

        var html_top = function (val){
            let html = "";
            html += '<div class="d-flex">';

            html += '<div class="flex-shrink-0 mr-7">' +
                    '<div class="symbol symbol-50 symbol-lg-120">'+
                    '<img alt="Pic" src="/app/miofi/template/images/ico/oficial.png">'+'</div></div>';
            html += "</div>";
            return html;

        };
        var moreInfo = function(label,valor){

            let html = '<div class="d-flex justify-content-between align-items-center">' +
                '<span class="text-dark-75 font-weight-bolder mr-2">'+label+'</span>' +
                '<span class="text-muted font-weight-bold">'+valor+' </span>' +
                '</div>';
            return html;
        };



        var urlsys = '{/literal}{$path_url}{literal}';
        var initTable = function() {
            let table_list_var = $('#index_list');
            let export_title = "{/literal}{#dataTableExportTitle#}{literal}";
            let noExport = tableSetting.noExport;
            // begin first table
            table_list = table_list_var.DataTable({
                initComplete: function(settings, json) {
                    //$('#index_list').removeClass('d-none');
                    $('#index_list').after('<div id="mostrar_bandeja" class="row">esto es una prueba</div>');
                    show_data_template(settings.json.data);
                },
                drawCallback: function( settings ) {
                    $("#mostrar_bandeja").html("ya funciona");
                    show_data_template(settings.json.data);
                    //$('html, body').animate({ scrollTop: 0 }, 'fast');
                },

                keys: {
                    columns: noExport,
                    clipboard: false,
                },
                dom: tableSetting.dom,
                buttons: [],
                responsive: true,
                colReorder: true,
                language: {"url": "/language/js/datatable."+lng+".json"},
                lengthMenu: [[10, 25, 50,-1], [10, 25, 50, lngUyuni.dataTableAll]],
                pageLength: 10,
                //order: [[ 1, "asc" ]], // Por que campo ordenara al momento de desplegar
                InfoFiltered: false,
                searchDelay: 500,
                processing: true,
                serverSide: true,
                ajax: {
                    url: urlsys+'/list',
                    type: 'POST',
                    data: {},
                },
                columns: [
                    {/literal}{foreach from=$gridItem item=row key=idx}
                                           {if $idx != 0},{/if}{literal}{data: '{/literal}{if $row.as}{$row.as}{else}{$row.field}{/if}{literal}'{/literal}{if $row.responsive}, responsivePriority: -1{/if}{literal}}{/literal}
                    {/foreach}{literal}
                ],
                columnDefs: [
                    {
                        targets: -1,
                        width: "90px",
                        className: 'noExport',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, full, meta) {
                            var boton = '<div class="btn-group btn-group-sm " role="group" aria-label="Accion">';
                            var lbEdit = {/literal}{if $privFace.edit == 1}lngUyuni.btnEdit{else}lngUyuni.btnViewData{/if}{literal};
                            boton += '<a href="javascript:snippet_list.update(\''+data+'\');" class="btn btn-success btn-sm" title="'+lbEdit+'">'+lbEdit+'</a>';
                            {/literal}{if $privFace.edit ==1 and $privFace.delete == 1}{literal}
                            boton += '<a href="javascript:snippet_list.delete(\''+data+'\');" class="btn btn-icon btn-light-danger btn-sm" title="'+lngUyuni.btnDelete+'"><i class="flaticon-delete-1"></i></a>';
                            {/literal}{/if}{literal}
                            boton += '<div>';
                            return boton;
                        },
                    },


                    {
                        targets: [-2,-3],
                        searchable: false,
                        className: "none",
                        render: function(data,type,full,meta){
                            if (data == null){ data = "";}
                            return '<span class="text-primary font-size-xs">' + data+ '</span>';
                        },
                    },

                ],
            });
        };

        /**
         * New and Update
         */
        //var btn_update = $('#btn_update');
        var btn_update = $('#btn_new');
        var handle_button_update = function(){
            btn_update.click(function(e){
                e.preventDefault();
                item_update("","new");
            });
        };

        var item_update = function(id,type){
            coreUyuni.itemUpdateIndex(id,type,urlsys);
        };
        /**
         * Delete
         */
        var  item_delete = function(id){
            var url = urlsys+"/"+id+"/delete";
            coreUyuni.itemDelete(id,url,table_list);
        };
        /**
         * Inicializar componentes
         */
        var handle_components = function(){
            coreUyuni.setComponents();
        };
        /**
         * Filtros
         */
        var handle_filtro = function () {
            coreUyuni.tableFilter();
        };

        return {
            //main function to initiate the module
            init: function() {
                initTable();
                handle_button_update();
                handle_components();
                handle_filtro();
            },
            update: function(id,type){
                item_update(id,type);
            },
            delete: function(id){
                item_delete(id);
            },
        };

    }();

    jQuery(document).ready(function() {
        //$('#btn_new').removeClass('d-none');
        snippet_list.init();
    });
</script>
{/literal}