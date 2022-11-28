{literal}
<script>
    var table_list;
    var snippet_list = function() {
        "use strict";
        var show_data_template = function (datos) {
            let html = "";
            $("#mostrar_bandeja").html(html);
            let img;
            jQuery.each( datos, function( i, val ) {
                console.log(val);
                console.log("Emisor cargo",val.emisor_cargo);
                html += `<div class="card card-custom gutter-b"><div class="card-body">`;
                html += `<div class="d-flex">`;
                html += html_info(val.emisor_oficina, val.emisor_cargo, val.emisor_nombre, val.fecha_emision);
                html += html_info(val.receptor_oficina, val.receptor_cargo, val.receptor_nombre, val.fecha_recepcion);
                html += `</div>`;
                html += html_Bottom(val);
                html += `</div></div>`
            });
            $("#mostrar_bandeja").html(html);
        };

        var html_info = function (oficina, cargo, nombre, fecha){
            let html = "";
            html += `<div class="flex-grow-1">
                    <div class="d-flex align-items-center justify-content-between flex-wrap mt-2">
                        <div class="mr-3">
                            <a href="#" class="d-flex align-items-center text-dark text-hover-primary font-size-h5 font-weight-bold mr-3">${oficina}
                                <i class="flaticon2-correct text-success icon-md ml-2"></i></a>
                        </div>
                    </div>
                    <div class="d-flex align-items-center flex-wrap justify-content-between">
                        <div class="flex-grow-1  text-dark-50 py-2 py-lg-2 mr-5">
                            <strong>Nombre:</strong> ${nombre}
                            <br>
                            <strong>Cargo:</strong> ${cargo}
                        </div>
                    </div>
                    <div class="d-flex align-items-left flex-lg-fill mr-5 my-1">
                        <span class="mr-4"><i class="fas fa-business-time text-info"></i></span>
                        <div class="d-flex flex-column text-primary">
                            <span class="font-weight-bolder font-size-h7"> ${fecha} </span>
                        </div>
                    </div>
                </div>`;
            return html;
        };

        var html_Bottom = function(val){
            let html = "";
            html +=`<div class="separator separator-solid my-7"></div>
                    <div class="d-flex align-items-center flex-wrap justify-content-between">
                        <div class="flex-grow-1  text-dark-50 py-2 py-lg-2 mr-5">
                            <strong>Estado:</strong> ${val.estado}
                            <br>
                            <strong>Observación:</strong> ${val.proveido}
                        </div>
                    </div>`;
            return html;
        };

        var urlsys = '{/literal}{$path_url}/{$subcontrol}_/{$id}{literal}';
        var initTable = function() {
            let table_list_var = $('#tabla_{/literal}{$subcontrol}{literal}');
            let export_title = "{/literal}{#dataTableExportTitle#}{literal}";
            let noExport = tableSetting.noExport;
            table_list = table_list_var.DataTable({
                initComplete: function(settings, json) {
                    $('#tabla_{/literal}{$subcontrol}{literal}').after('<div id="mostrar_bandeja" class="container"></div>');
                    show_data_template(settings.json.data);
                },
                drawCallback: function( settings ) {
                    $("#mostrar_bandeja").html("");
                    show_data_template(settings.json.data);
                },
                keys: {
                    columns: noExport,
                    clipboard: false,
                },
                dom: tableSetting.dom,
                buttons: [],
                colReorder: true,
                responsive: true,
                language: {"url": "/language/js/datatable."+lng+".json"},
                lengthMenu: [[10, 25, 50,-1], [10, 25, 50, lngUyuni.dataTableAll]],
                pageLength: 10,
                // order: [[ 0, "asc" ]], // Por que campo ordenara al momento de desplegar
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
                        targets: [0],
                        render: function(data,type,full,meta){
                            return '<span class="text-primary">' + data+ '</span>';
                        },
                    },
                    {
                        targets: [-2,-3],
                        searchable: false,
                    },
                    {
                        targets: [-2,-3],
                        className: "none"
                    },
                    {
                        targets: [-2,-3],
                        render: function(data,type,full,meta){
                            if (data == null){ data = "";}
                            return '<span class="text-primary font-size-xs">' + data+ '</span>';
                        },
                    },


                ],
            });

        };
        /**
         * Download File
         */
        function download(id){
            var url = urlsys+"/"+id+"/download";
            window.open(url, '_blank');
        }

        /**
         * New and Update
         */
        var btn_update = $('#btn_form_{/literal}{$subcontrol}{literal}');
        var handle_button_update = function(){
            btn_update.click(function(e){
                e.preventDefault();
                item_update("","new");
            });
        };

        var item_update = function(id,type){
            var subcontrol = "{/literal}{$subcontrol}{literal}";
            coreUyuni.itemUpdateTabs(id,type,urlsys,subcontrol);
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
                handle_button_update();
                initTable();
                handle_components();
                handle_filtro();
            },
            update: function(id,type){
                item_update(id,"update");
            },
            delete: function(id){
                item_delete(id);
            },
            download: function (id) {
                download(id);
            },
        };
    }();

    jQuery(document).ready(function() {
        snippet_list.init();
    });
</script>

{/literal}
