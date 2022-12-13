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

                <div class="col-lg-12">
                    <label>{#field_oficina#} <span class="text-danger bold">*</span>: </label>
                    <div class="input-group">
                        <select class="form-control m-select2 select2_general"
                                name="item[oficina_id]" id="select_oficina"
                                data-placeholder="{#field_Holder_oficina#}" {$privFace.input}
                                data-fv-not-empty___message="{#glFieldRequired#}"
                        >
                            <option></option>
                            {html_options options=$cataobj.oficina selected=$item.oficina_id}
                        </select>
                    </div>
                    <span class="form-text text-muted">{#field_GroupMsg_oficina#}</span>
                </div>

                <div class="col-lg-9">
                    <label>{#field_name#}  <span class="text-danger bold">*</span> :</label>
                    <div class="input-group">
                        <input type="text" class="form-control"
                               name="item[nombre]" value="{$item.nombre|escape:"html"}"
                               required
                               data-fv-not-empty___message="{#glFieldRequired#}"
                               minlength="3"
                               data-fv-string-length___message="{#field_length_name#}"
                        >
                        <div class="input-group-append"><span class="input-group-text field_info"><i class="fas fa-info"></i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_name#}</span>
                </div>
                <div class="col-lg-3">
                    <label>{#field_active#}:</label>
                    <div class="input-group">
                    <span class="switch switch-icon">
                        <label><input type="checkbox" {if $item.active == 1}checked="checked"{/if} name="item[active]" value="1" ><span></span></label>
                    </span>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_active#}</span>
                </div>
                <div class="col-lg-12">
                    <label>{#field_limite#}:</label>
                    <div class="input-group">
                    <span class="switch switch-icon">
                        <label><input id="limite" type="checkbox" {if $item.limite == 1}checked="checked"{/if} name="item[limite]" value="1" ><span></span></label>
                    </span>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_limite#}</span>
                </div>
                </div>

                <div class="form-group row {if $item.limite == false }d-none{/if} limite" id="limite_div">
                    <div class="col-lg-4">
                        <label>{#field_dias#}:</label>
                        <div class="input-group">
                            <input type="text" class="form-control number_integer p-5" id="number_integer"
                                   name="item[dias]" value="{$item.dias|escape:"html"}"
                            >
                            <div class="input-group-append"><span class="input-group-text"><i class="fas fa-calendar-check"></i></span></div>
                        </div>
                        <span class="form-text text-black-50">{#field_msg_dias#}</span>
                    </div>
                    <div class="col-lg-4">
                        <label>{#field_horas#}:</label>
                        <div class="input-group">
                            <input type="text" class="form-control number_integer p-5" id="number_integer"
                                   name="item[horas]" value="{$item.horas|escape:"html"}"
                            >
                            <div class="input-group-append"><span class="input-group-text"><i class="fas fa-calendar-check"></i></span></div>
                        </div>
                        <span class="form-text text-black-50">{#field_msg_horas#}</span>
                    </div>
                    <div class="col-lg-4">
                        <label>{#field_min#}:</label>
                        <div class="input-group">
                            <input type="text" class="form-control number_integer p-5" id="number_integer"
                                   name="item[minutos]" value="{$item.minutos|escape:"html"}"
                            >
                            <div class="input-group-append"><span class="input-group-text"><i class="fas fa-calendar-check"></i></span></div>
                        </div>
                        <span class="form-text text-black-50">{#field_msg_min#}</span>
                    </div>
                </div>
            <div class="form-group row">
                <div class="col-lg-12">
                    <label>{#field_descripcion#}<span class="text-danger bold">*</span> :</label>
                    <div class="input-group">
                        <textarea rows="4" class="form-control m-input mayus"
                                  name="item[descripcion]"
                        >{$item.descripcion|escape:'html'}</textarea>
                        <div class="input-group-append"><span class="input-group-text"><i class="fas fa-calendar-check"></i></span></div>
                    </div>
                    <span class="form-text text-muted">{#field_msg_descripcion#}</span>
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