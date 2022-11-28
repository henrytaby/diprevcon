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

        <div class="card-body">
            <div class="form-group row">

                <div class="col-lg-4">
                    <label>{#nur_field#}<span class="text-danger bold">*</span> :</label>
                    <div class="input-group">
                        <input type="text" class="form-control"
                               name="item[nur]" value="{$item.nur|escape:"html"}"
                               required
                               data-fv-not-empty___message="{#glFieldRequired#}"
                               minlength="3"
                               data-fv-string-length___message="{#nur_fieldLength#}"
                        >
                        <div class="input-group-append"><span class="input-group-text field_info"><i class="fas fa-stream"></i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#nur_fieldMsg#}</span>
                </div>

                <div class="col-lg-4">
                    <label>{#cite_field#}<span class="text-danger bold">*</span> :</label>
                    <div class="input-group">
                        <input type="text" class="form-control"
                               name="item[cite]" value="{$item.cite|escape:"html"}"
                               required
                               data-fv-not-empty___message="{#glFieldRequired#}"
                               minlength="3"
                               data-fv-string-length___message="{#cite_fieldLength#}"
                        >
                        <div class="input-group-append"><span class="input-group-text field_info"><i class="fas fa-stream"></i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#cite_fieldMsg#}</span>
                </div>


                <div class="col-lg-12">
                    <label>{#field_procedencia#}<span class="text-danger bold">*</span> :</label>
                    <div class="input-group">
                        <input type="text" class="form-control"
                               name="item[procedencia]" value="{$item.procedencia|escape:"html"}"
                               required
                               data-fv-not-empty___message="{#glFieldRequired#}"
                               minlength="3"
                               data-fv-string-length___message="{#field_length_procedencia#}"
                        >
                        <div class="input-group-append"><span class="input-group-text field_info"><i class="fas fa-info"></i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_procedencia#}</span>
                </div>

                <div class="col-lg-12">
                    <label>{#field_destinatario#}<span class="text-danger bold">*</span> :</label>
                    <div class="input-group">
                        <input type="text" class="form-control"
                               name="item[destinatario]" value="{$item.destinatario|escape:"html"}"
                               required
                               data-fv-not-empty___message="{#glFieldRequired#}"
                               minlength="3"
                               data-fv-string-length___message="{#field_length_destinatario#}"
                        >
                        <div class="input-group-append"><span class="input-group-text field_info"><i class="fas fa-info"></i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_destinatario#}</span>
                </div>

                <div class="col-lg-6">
                    <label>{#field_date#}:</label>
                    <div class="input-group">
                        <input type="text" class="form-control date_general" id="valid_until"
                               name="item[fecha]" value="{$item.fecha|date_format:'%d/%m/%Y'}"
                                {*                               data-fv-not-empty___message="{#glFieldRequired#}"*}
                        >
                        <div class="input-group-append"><span class="input-group-text calendar"><i class="flaticon-event-calendar-symbol"></i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_date#}</span>
                </div>
                <div class="col-lg-6">
                    <label>{#field_time#}:</label>
                    <div class="input-group">
                        <input type='text' class="form-control m_timepicker_1" id="m_timepicker_1"
                               readonly placeholder="{#field_holder_time#}" type="text"
                               name="item[hora]"
                               value="{$item.hora|escape:"html"}"
                        />
                        <div class="input-group-append"><span class="input-group-text calendar"><i class="la la-clock-o"></i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_time#}</span>
                </div>
                <div class="col-lg-12">
                    <label>{#field_asunto#}<span class="text-danger bold">*</span> :</label>
                    <div class="input-group">
                        <textarea rows="2" class="form-control m-input mayus"
                                  name="item[asunto]"
                        >{$item.asunto|escape:'html'}</textarea>
                        <div class="input-group-append"><span class="input-group-text"><i class="fas fa-calendar-check"></i></span></div>
                    </div>
                    <span class="form-text text-muted">{#field_msg_asunto#}</span>
                </div>

                <div class="col-lg-6">
                    <label>{#field_fojas#}:</label>
                    <div class="input-group">
                        <input type="text" class="form-control number_integer pr-5" id="number_integer"
                               name="item[fojas]" value="{$item.fojas|escape:"html"}"
{*                               data-fv-not-empty___message="{#glFieldRequired#}"*}
                        >
                        <div class="input-group-append"><span class="input-group-text"><i class="fas fa-calendar-check"></i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_fojas#}</span>
                </div>
                <div class="col-lg-6">
                    <label>{#field_tipo_correspondencia_id#}: </label>
                    <div class="input-group">
                        <select class="form-control m-select2 select2_general"
                                name="item[tipo_correspondencia_id]" id="type_select_estado"
                                data-placeholder="{#field_holder_tipo_correspondencia_id#}" {$privFace.input}
{*                                required*}
{*                                data-fv-not-empty___message="{#glFieldRequired#}"*}
                        >
                            <option></option>
                            {html_options options=$cataobj.tipo_correspondencia selected=$item.tipo_correspondencia_id}
                        </select>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_tipo_correspondencia_id#}</span>
                </div>

                <div class="col-lg-12">
                    <label>{#descripcion_field#}:</label>
                    <div class="input-group">
                        <textarea rows="3" class="form-control"
                                  name="item[descripcion]"
                        >{$item.descripcion|escape:'html'}</textarea>
                    </div>
                    <span class="form-text text-muted">{#descripcion_fieldMsg#}</span>
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