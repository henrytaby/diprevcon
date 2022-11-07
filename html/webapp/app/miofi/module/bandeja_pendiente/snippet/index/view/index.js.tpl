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
                html += `<div class="card card-custom gutter-b"><div class="card-body">`;
                html += html_top(val);
                html += html_Bottom(val);
                html += `</div></div>`
            });
            $("#mostrar_bandeja").html(html);
        };

        var html_top = function (val){
            let html = "";
            html += '<div class="d-flex">';
            html += '<div class="flex-shrink-0 mr-7">' +
                '<div class="symbol symbol-50 symbol-lg-120">';
            if(val.urgente){
                html +='<img alt="Pic" src="/app/miofi/template/images/ico/oficial_urgente.png">';
            }else{
                html +='<img alt="Pic" src="/app/miofi/template/images/ico/oficial.png">';
            }
            html +='</div></div>';
            html += `<div class="flex-grow-1">
                    <div class="d-flex align-items-center justify-content-between flex-wrap mt-2">
                        <div class="mr-3">
                            <a href="#" class="d-flex align-items-center text-dark text-hover-primary font-size-h5 font-weight-bold mr-3">${val.nur}
                                <i class="flaticon2-correct text-success icon-md ml-2"></i></a>
                            <div class="d-flex flex-wrap my-2">
                                <span href="#" class="text-primary text-hover-primary  mr-lg-8 mr-5 mb-lg-0 mb-2">
                                    <span class="svg-icon svg-icon-md svg-icon-primary mr-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <mask fill="white">
                                                    <use xlink:href="#path-1"></use>
                                                </mask>
                                                <g></g>
                                                <path d="M7,10 L7,8 C7,5.23857625 9.23857625,3 12,3 C14.7614237,3 17,5.23857625 17,8 L17,10 L18,10 C19.1045695,10 20,10.8954305 20,12 L20,18 C20,19.1045695 19.1045695,20 18,20 L6,20 C4.8954305,20 4,19.1045695 4,18 L4,12 C4,10.8954305 4.8954305,10 6,10 L7,10 Z M12,5 C10.3431458,5 9,6.34314575 9,8 L9,10 L15,10 L15,8 C15,6.34314575 13.6568542,5 12,5 Z" fill="#000000"></path>
                                            </g>
                                        </svg>
                                    </span>
                                    Instrucción: ${val.instruccion}
                                </span>
                            </div>
                        </div>
                        <div class="my-lg-0 my-1">
                            <a href="#" class="btn btn-sm btn-light-primary font-weight-bolder text-uppercase mr-2">Ver</a>
                            <a href="#" class="btn btn-sm btn-primary font-weight-bolder text-uppercase">Recepcionar</a>
                        </div>
                    </div>
                    <div class="d-flex align-items-center flex-wrap justify-content-between">
                        <div class="flex-grow-1  text-dark-50 py-2 py-lg-2 mr-5">
                            ${val.asunto}
                            <br>
                            <strong>Procedencia:</strong> ${val.procedencia}
                            <br>
                            <strong>Remite:</strong> ${val.destinatario}
                            <br>
                            <strong>Observación:</strong><br> ${val.proveido}
                        </div>
                    </div>
                </div>`;
            html += `</div>`;
            return html;
        };
        var html_Bottom = function(val){
            let html = "";
            html +=`<div class="separator separator-solid my-7"></div>
                        <div class="d-flex align-items-center flex-wrap">`;
            html += flex_item();
            html += `<i class="fas fa-calendar-check icon-2x text-muted font-weight-bold"></i></span>
                    <div class="d-flex flex-column text-dark-75">`;
            html += bottom_item("Fecha Enviado", val.fecha_emision);
            html += flex_item();
            html += `<i class="fas fa-calendar-check icon-2x text-info"></i></span>
                    <div class="d-flex flex-column text-primary">`;
            html += bottom_item("Fecha Recepcion", val.fecha_recepcion);
            html += flex_item();
            html += `<i class="fas fa-sun icon-2x text-muted font-weight-bold"></i></span>
                    <div class="d-flex flex-column text-dark-75">`;
            html += bottom_item("Días hasta Recepción","6");
            html += flex_item();
            html += `<i class="fas fa-calendar-day icon-2x text-info"></i></span>
                    <div class="d-flex flex-column text-danger">`;
            html += bottom_item("Días Transcurridos ","20 / 14");
            html += flex_item();
            html += `<i class="fas fa-users icon-2x text-muted "></i></span>
                    <div class="d-flex flex-column text-dark-75">`;
            html += bottom_item("# Destinatarios","20");
            html +='</div></div>';
            return html;
        };

        var bottom_item = function(label,valor){
            let html =`<span class="font-weight-bolder font-size-sm">${label}</span>
                        <span class="font-weight-bolder font-size-h5">${valor}</span>
                    </div>
                </div>`;
            return html;
        };
        var flex_item = function(label,valor){
            let html =`<div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
                    <span class="mr-4">`;
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
                    $('#index_list').after('<div id="mostrar_bandeja" class="container"></div>');
                    show_data_template(settings.json.data);
                },
                drawCallback: function( settings ) {
                    $("#mostrar_bandeja").html("");
                    show_data_template(settings.json.data);
                    //$('html, body').animate({ scrollTop: 0 }, 'fast');
                },
                dom: tableSetting.dom,
                buttons: [
                    /*
                    {extend:'colvis',text:lngUyuni.dataTableWatch
                        ,columnText: function ( dt, idx, title ) {
                            return (idx+1)+': '+title;
                        }
                    },

                     */
                    {extend:'excelHtml5'
                        ,exportOptions: {columns: noExport}
                        , title: export_title
                    },
                    {extend:'pdfHtml5'
                        ,exportOptions: {columns: noExport}
                        , title: export_title
                        , download: 'open'

                        , pageSize: 'LETTER'
                        ,customize: function(doc) {
                            doc.styles.tableHeader.fontSize = 7;
                            doc.defaultStyle.fontSize = 7;
                            doc.pageMargins= [ 20, 20];
                        }
                    },
                    {extend:'print'
                        ,exportOptions: {columns: noExport}
                        ,text: lngUyuni.dataTablePrint
                    }

                ],
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
                /*
                rowGroup: {
                    dataSrc: ['parentname','groupname']
                },

                 */
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
                        targets: [0,1,2,3,7,8],
                        searchable: true,
                    },
                    {
                        targets: [4,5,6,9],
                        searchable: false,
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