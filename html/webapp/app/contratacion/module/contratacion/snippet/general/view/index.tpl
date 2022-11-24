{include file="index.css.tpl"}
<div class="card card-custom gutter-b example example-compact">
    <div class="card-body pt-0 pb-0 pl-5 pr-5">
        <div class="alert alert-custom fade show pt-1 pb-1 pl-5 pr-5 ayuda" role="alert">
            <div class="alert-icon"><i class="flaticon-notes"></i></div>
            <div class="alert-text text-justify text-dark-65" >{#message#}</div>
        </div>
    </div>

    <div class="card-header py-3">
        <div class="card-title">
            <span class="card-icon"><i class="flaticon2-next text-dark-25"></i></span>
            <h3 class="card-label text-dark-50">{#title#}</h3>
        </div>
    </div>
    <!--begin::Form-->
    <form method="POST"
          action="{$path_url}/{$subcontrol}_/{if $type=="update"}{$id}/{/if}save/"
          id="general_form">

        <div class="card-body pt-1 pb-0">
            <div class="form-group row">
                <div class="col-lg-12">
                    <label>{#field_objeto_contratacion#}<span class="text-danger bold">*</span> :</label>
                    <div class="input-group">
                        <input type="text" class="form-control"
                               name="item[objeto_contracion]" value="{$item.objeto_contracion|escape:"html"}"
                               required
                               data-fv-not-empty___message="{#glFieldRequired#}"
                               minlength="3"
                               data-fv-string-length___message="{#field_length_objeto_contratacion#}"
                        >
                        <div class="input-group-append"><span class="input-group-text field_info"><i class="fas fa-info"></i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_objeto_contratacion#}</span>
                </div>

                <div class="col-lg-4">
                    <label>{#field_fecha_publicacion#}:</label>
                    <div class="input-group">
                        <input type="text" class="form-control date_general" id="valid_until"
                               name="item[fecha_publicacion]" value="{$item.fecha_publicacion|date_format:'%d/%m/%Y'}"
                                {*                               data-fv-not-empty___message="{#glFieldRequired#}"*}
                        >
                        <div class="input-group-append"><span class="input-group-text calendar"><i class="flaticon-event-calendar-symbol"></i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_fecha_publicacion#}</span>
                </div>

                <div class="col-lg-6">
                    <label>{#field_cuce#}:</label>
                    <div class="input-group">
                        <input type="text" class="form-control"
                               name="item[cuce]" value="{$item.cuce|escape:"html"}"
                               minlength="3"
                               data-fv-string-length___message="{#field_length_cuce#}"
                        >
                        <div class="input-group-append"><span class="input-group-text field_info"><i class="far fa-hourglass"></i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_cuce#}</span>
                </div>
                <div class="col-lg-2">
                    <label>{#field_subasta#}:</label>
                    <div class="input-group">
                    <span class="switch switch-icon">
                        <label><input type="checkbox" {if $item.subasta == 1}checked="checked"{/if} name="item[subasta]" value="1" ><span></span></label>
                    </span>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_active#}</span>
                </div>

                <div class="col-lg-4">
                    <label>{#field_tipo_id#}: </label>
                    <div class="input-group">
                        <select class="form-control m-select2 select2_general"
                                name="item[tipo_id]" id="type_select_estado"
                                data-placeholder="{#field_holder_tipo_id#}" {$privFace.input}
                        >
                            <option></option>
                            {html_options options=$cataobj.tipo selected=$item.tipo_id}
                        </select>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_tipo_id#}</span>
                </div>

                <div class="col-lg-4">
                    <label>{#field_modalidad_id#}: </label>
                    <div class="input-group">
                        <select class="form-control m-select2 select2_general"
                                name="item[modalidad_id]" id="type_select_estado"
                                data-placeholder="{#field_holder_modalidad_id#}" {$privFace.input}
                        >
                            <option></option>
                            {html_options options=$cataobj.modalidad selected=$item.modalidad_id}
                        </select>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_modalidad_id#}</span>
                </div>

                <div class="col-lg-4">
                    <label>{#field_estado_id#}: </label>
                    <div class="input-group">
                        <select class="form-control m-select2 select2_general"
                                name="item[estado_id]" id="type_select_estado"
                                data-placeholder="{#field_holder_estado_id#}" {$privFace.input}
                        >
                            <option></option>
                            {html_options options=$cataobj.estado selected=$item.estado_id}
                        </select>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_estado_id#}</span>
                </div>

                <div class="col-lg-12">
                    <label>{#field_procesador#}:</label>
                    <div class="input-group">
                        <input type="text" class="form-control"
                               name="item[procesador]" value="{$item.procesador|escape:"html"}"
                               minlength="3"
                               data-fv-string-length___message="{#field_length_procesador#}"
                        >
                        <div class="input-group-append"><span class="input-group-text field_info"><i class="fas fa-user"></i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_procesador#}</span>
                </div>

                <div class="col-lg-6">
                    <label>{#field_codigo_interno#}:</label>
                    <div class="input-group">
                        <input type="text" class="form-control"
                               name="item[codigo_interno]" value="{$item.codigo_interno|escape:"html"}"
                               minlength="3"
                               data-fv-string-length___message="{#field_length_codigo_interno#}"
                        >
                        <div class="input-group-append"><span class="input-group-text field_info"><i class="fab fa-centercode"></i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_codigo_interno#}</span>
                </div>
                <div class="col-lg-6">
                    <label>{#field_numero_contrato#}:</label>
                    <div class="input-group">
                        <input type="text" class="form-control"
                               name="item[contrato_codigo]" value="{$item.contrato_codigo|escape:"html"}"
                               minlength="3"
                               data-fv-string-length___message="{#field_length_numero_contrato#}"
                        >
                        <div class="input-group-append"><span class="input-group-text field_info"><i class="fab fa-codepen"></i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_numero_contrato#}</span>
                </div>
            </div>
        </div>
        <div class="card-header py-3">
            <div class="card-title  m-0">
                <span class="card-icon"><i class="flaticon2-next text-dark-25"></i></span>
                <span class="font-weight-bold font-size-h4 text-dark-50">{#title2#}</span>
            </div>
        </div>
        <div class="card-body  pt-1 p   b-0 proyecto" >
            <div class="form-group row  pt-0 pb-0 mb-0">
                <div class="col-lg-4">
                    <label>{#field_proponente#}: </label>
                    <div class="input-group">
                        <select class="form-control m-select2 select2_general"
                                name="item[proponente_id]" id="type_select_estado"
                                data-placeholder="{#field_holder_proponente#}" {$privFace.input}
                        >
                            <option></option>
                            {html_options options=$cataobj.proponente selected=$item.proponente_id}
                        </select>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_proponente#}</span>
                </div>
                <div class="col-lg-8">
                    <label>{#field_nombre_proponente#}:</label>
                    <div class="input-group">
                        <input type="text" class="form-control"
                               name="item[proponente]" value="{$item.proponente|escape:"html"}"
                               minlength="3"
                               data-fv-string-length___message="{#field_length_nombre_proponente#}"
                        >
                        <div class="input-group-append"><span class="input-group-text field_info"><i class="fas flaticon-layer"></i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_nombre_proponente#}</span>
                </div>
                <div class="col-lg-6">
                    <label>{#field_telefono#}: </label>
                    <div class="input-group">
                        <input type="text" class="form-control"
                               name="item[telefono]" value="{$item.telefono|escape:"html"}"
                               minlength="3"
                               data-fv-string-length___message="{#field_length_telefono#}"
                        >
                        <div class="input-group-append"><span class="input-group-text field_info"><i class="la la-phone"></i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_telefono#}</span>
                </div>
                <div class="col-lg-6">
                    <label>{#field_email#}: </label>
                    <div class="input-group">
                        <input type="text" class="form-control"
                               name="item[email]" value="{$item.email|escape:"html"}"
                               minlength="3"
                               data-fv-string-length___message="{#field_length_email#}"
                        >
                        <div class="input-group-append"><span class="input-group-text field_info">@</i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_email#}</span>
                </div>
            </div>
        </div>

        <div class="card-body pt-1 pb-0 ">
            <div class="form-group row">
                <div class="col-lg-4">
                    <label>{#field_plazo#}:</label>
                    <div class="input-group">
                        <input type="text" class="form-control"
                               name="item[plazo]" value="{$item.plazo|escape:"html"}"
                               minlength="3"
                               data-fv-string-length___message="{#field_length_plazo#}"
                        >
                        <div class="input-group-append"><span class="input-group-text field_info"><i class="fas fa-business-time"></i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_plazo#}</span>
                </div>
                <div class="col-lg-4">
                    <label>{#field_fecha_suscripcion#}:</label>
                    <div class="input-group">
                        <input type="text" class="form-control date_general" id="valid_until"
                               name="item[fecha_suscripcion]" value="{$item.fecha_suscripcion|date_format:'%d/%m/%Y'}"
                               data-fv-not-empty___message="{#glFieldRequired#}"
                        >
                        <div class="input-group-append"><span class="input-group-text calendar"><i class="flaticon-event-calendar-symbol"></i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_fecha_publicacion#}</span>
                </div>
                <div class="col-lg-4">
                    <label>{#field_fecha_fin#}:</label>
                    <div class="input-group">
                        <input type="text" class="form-control date_general" id="valid_until"
                               name="item[fecha_fin]" value="{$item.fecha_fin|date_format:'%d/%m/%Y'}"
                               data-fv-not-empty___message="{#glFieldRequired#}"
                        >
                        <div class="input-group-append"><span class="input-group-text calendar"><i class="flaticon-event-calendar-symbol"></i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_fecha_fin#}</span>
                </div>
                <div class="col-lg-6">
                    <label>{#field_precio_referencial#}:</label>
                    <div class="input-group">
                        <input type="text" class="form-control number_decimal input_money text-right pr-5" id="number_decimal"
                               name="item[precio_referencial]" value="{$item.precio_referencial|escape:"html"}"
                        >
                        <div class="input-group-append"><span class="input-group-text"><i class="fas fa-money-bill"></i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_precio_referencial#}</span>
                </div>
                <div class="col-lg-6">
                    <label>{#field_monto#}:</label>
                    <div class="input-group">
                        <input type="text" class="form-control number_decimal input_money text-right pr-5" id="number_decimal"
                               name="item[monto]" value="{$item.monto|escape:"html"}"
                        >
                        <div class="input-group-append"><span class="input-group-text"><i class="fas fa-money-bill"></i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_monto#}</span>
                </div>
                <div class="col-lg-4">
                    <label>{#field_pago_total#}:</label>
                    <div class="input-group">
                        <input type="text" class="form-control number_decimal input_money text-right pr-5" id="number_decimal"
                               name="item[pago_total]" value="{$item.pago_total|escape:"html"}"
                        >
                        <div class="input-group-append"><span class="input-group-text"><i class="fas fa-money-bill"></i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_pago_total#}</span>
                </div>
                <div class="col-lg-4">
                    <label>{#field_pago_parcial#}:</label>
                    <div class="input-group">
                        <input type="text" class="form-control number_decimal input_money text-right pr-5" id="number_decimal"
                               name="item[pago_parcial]" value="{$item.pago_parcial|escape:"html"}"
                        >
                        <div class="input-group-append"><span class="input-group-text"><i class="fas fa-money-bill"></i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_pago_parcial#}</span>
                </div>
                <div class="col-lg-4">
                    <label>{#field_pago_pendiente#}:</label>
                    <div class="input-group">
                        <input type="text" class="form-control number_decimal input_money text-right pr-5" id="number_decimal"
                               name="item[pago_pendiente]" value="{$item.pago_pendiente|escape:"html"}"
                        >
                        <div class="input-group-append"><span class="input-group-text"><i class="fas fa-money-bill"></i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_pago_pendiente#}</span>
                </div>
                <div class="col-lg-12 pt-3 pb-0">
                    <label>{#field_observacion#} </label>
                    <div class="m-input-icon m-input-icon--right">
                        <div class="summernote" id="observaciones">{$item.observaciones}</div>
                        <input class="form-control m-input" type="hidden" name="item[observaciones]" id="observacion_input" {$privFace.input}>
                    </div>
                </div>
            </div>
        </div>


        <div class="card-footer">
            {if $privFace.edit == 1}
                <button type="reset" class="btn btn-primary mr-2" id="general_submit">
                    <i class="la la-save"></i>
                    {#glBtnSaveChanges#}</button>
            {/if}
            <a href="{$path_url}" class="btn btn-light-primary ">
                <i class="la la-angle-double-left"></i>{if $type =="new"} {#glBtnCancel#} {else} {#glBtnBackToList#}{/if}
            </a>
        </div>

    </form>
    <!--end::Form-->
</div>

{include file="index.js.tpl"}