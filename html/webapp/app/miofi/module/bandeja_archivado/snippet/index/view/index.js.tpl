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
                html += `<div class="card card-custom gutter-b"><div class="card-body p-0">`;
                html += html_top(val);
                html += html_per(val);
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
                        <div class="my-lg-0 my-1">`;
            //html += '<a href="javascript:#" class="btn btn-sm btn-success font-weight-bolder text-uppercase mr-2">Derivar</a>';

            //html += `<a href="javascript:snippet_list.archivar('${val.actions}','${val.nur}');" class="btn btn-sm btn-warning font-weight-bolder text-uppercase">Archivar</a>`;
            html += `</div>
                    </div>
                    <div class="d-flex align-items-center flex-wrap justify-content-between">
                        <div class="flex-grow-1  text-dark-50 py-2 py-lg-2 mr-5">

<div class="alert alert-custom alert-light-primary fade show mb-5 p-2" role="alert">
    <div class="alert-text">${val.asunto}</div>
</div>
                            <strong>Procedencia:</strong> ${val.procedencia}<br>
                            <strong>Remite:</strong> ${val.destinatario} <br>

<div class="alert alert-custom alert-light-info fade show mb-5 p-2" role="alert">
    <div class="alert-text"><strong>Observación/Proveído:</strong> ${val.proveido}</div>
</div>
                        </div>
                    </div>
                </div>`;
            html += `</div>`;
            return html;
        };
        var html_per = function (val){
            let html = '';
            html += `
<div class="row">
<div class="col-lg-6"">
    <strong>Emisor:</strong> ${val.emisor_nombre}<br>
    <strong>Emisor Cargo:</strong> ${val.emisor_cargo} <br>
    <strong>Emisor Oficina:</strong> ${val.emisor_oficina}
</div>
<div class="col-lg-6">
    <strong>Receptor:</strong> ${val.receptor_nombre}<br>
    <strong>Receptor Cargo:</strong> ${val.receptor_cargo} <br>
    <strong>Receptor Oficina:</strong> ${val.receptor_oficina}
</div>
</div>
            `;
            html += '';
            return html;
        };
        var html_Bottom = function(val){
            let html = "";
            html +=`<div class="separator separator-solid my-2"></div>
                        <div class="d-flex align-items-center flex-wrap">`;

            html += iconos_abajo("Fecha Enviado",val.fecha_emision,"text-dark-75","fas fa-calendar-check","text-success font-weight-bold");
            html += iconos_abajo("Fecha Recepcion",val.fecha_recepcion,"text-dark-75o","fas fa-calendar-check","text-info font-weight-bold");

            let tiempo = getTiempo(val.recepcion_dias,val.recepcion_horas,val.recepcion_minutos);
            html += iconos_abajo("Tiempo de Recepción",tiempo,"text-dark-75","far fa-clock font-weight-bold","text-muted");
            let accion = getTiempo(val.accion_dias,val.accion_horas,val.accion_minutos);
            let proceso = getTiempo(val.proceso_dias,val.proceso_horas,val.proceso_minutos);
            let accion_dias = val.proceso_limite?accion+" / "+proceso:accion;

            html += iconos_abajo("Fecha Archivado",val.accion_fecha,"estado","fas fa-calendar-check","text-info font-weight-bold","control");
            html += iconos_abajo("Tiempo Transcurrido",accion_dias,"estado","far fa-clock","text-info");

            html += iconos_abajo("# Destinatarios",val.total_seguimiento,"text-dark-75","fas fa-users","text-muted");

            html +='</div></div>';
            return html;
        };
        var getTiempo = function (dias,horas,minutos){
            let html = "" ;
            if(dias>0) html += dias+" días,";
            if(horas>0) html += horas+" horas,";
            html += minutos+" minutos";
            return html;
        }
        var iconos_abajo = function (label,valor,classTexto,icon,iconclass,divclass){
            let html =`
                <div class="d-flex align-items-center flex-lg-fill mr-5 my-1 ${divclass}">
                    <span class="mr-4"><i class="${icon} icon-2x ${iconclass}"></i></span>
                    <div class="d-flex flex-column ${classTexto}">
                        <span class="font-weight-bolder font-size-sm">${label}</span>
                        <span class=" font-size-sm">${valor}</span>
                    </div>
                </div>`;
            return html;
        }

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
        var  item_archivar = function(id,nur){

            let html ="Se archivará el documento y moverá el documento de la bandeja de \"Archivados\" <br> ";
            html += "<strong>NUR: "+nur+"</strong><br> ID : "+id+"  ";
            Swal.fire({
                title: '¿Esta seguro de archivar el documento?',
                html: html,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: "<i class='fas fa-thumbs-up'></i> Si, Archivar",
                cancelButtonText: "<i class='la la-thumbs-down'></i>"+lngUyuni.deleteBtnNo,
                customClass: {
                    confirmButton: "btn btn-warning",
                    cancelButton: "btn btn-default"
                }
            }).then(function(result) {
                if (result.value) {
                    item_archivar_accion(id);
                }
            });


        };

        var item_archivar_accion = function(id){
            var url = urlsys+"/"+id+"/estado";
            Swal.fire({
                title: "Recepcionando Documento",
                html: "Iniciando el proceso de recepción"+cargando_vista,
                showConfirmButton: false,
                allowEnterKey: false,
                allowOutsideClick: false,
                allowEscapeKey: false,
            });

            $.get( url, {},
                function(res){
                    if(res.res == 1){
                        Swal.close();
                        Swal.fire({icon: 'success',title: "El documento fue recepcionado",showConfirmButton: false,timer: 1000});
                        table_list.ajax.reload();
                    }else{
                        var msg_error = "No se pudo realizar la recepción del documento";
                        if (res.msgdb !== undefined){
                            msg_error += '<div class="alert alert-danger font-size-xs" role="alert">';
                            msg_error += '<strong>'+lngUyuni.technicalData+': </strong>'+res.msgdb+'</div>';
                        }
                        Swal.fire({
                            icon: "error", title: "No se puede Archivar",
                            html:msg_error, showClass: {popup: 'animate__animated animate__wobble'}
                        });

                    }
                },"json");
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
            archivar: function(id,nur){
                item_archivar(id,nur);
            },
        };

    }();

    jQuery(document).ready(function() {
        //$('#btn_new').removeClass('d-none');
        snippet_list.init();
    });
</script>
{/literal}