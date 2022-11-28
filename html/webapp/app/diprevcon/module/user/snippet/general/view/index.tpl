{include file="index.css.tpl"}
<div class="card card-custom gutter-b example example-compact">
    <div class="card-header py-3">
        <div class="card-title">
            <span class="card-icon"><i class="flaticon2-next text-dark-25"></i></span>
            <h3 class="card-label text-dark-50">{#title#}</h3>
        </div>
    </div>

    <div class="card-body pt-0 pb-0 pl-5 pr-5">
        <div class="alert alert-custom fade show pt-1 pb-1 pl-5 pr-5 ayuda" role="alert">
            <div class="alert-icon">
                <i class="flaticon-notes"></i>
            </div>
            <div class="alert-text text-justify text-dark-65" >
                {#message#}
            </div>
        </div>
    </div>

    <!--begin::Form-->
    <form method="POST"
          action="{$path_url}/{$subcontrol}_/{if $type=="update"}{$id}/{/if}save/"
          id="general_form">

        <div class="card-body pt-0 pb-0">

            <div class="form-group row">
                <div class="col-lg-6">
                    <label>{#fieldType#} <span class="text-danger bold">*</span>: </label>
                    <div class="input-group">
                        <select class="form-control m-select2 select2_general"
                                name="item[type]" id="type"
                                data-placeholder="{#field_Holder_type#}" {$privFace.input}
                                required
                                data-fv-not-empty___message="{#glFieldRequired#}"
                        >
                            <option></option>
                            {html_options options=$cataobj.type selected=$item.type}
                        </select>
                    </div>
                    <span class="form-text text-muted">{#field_GroupMsg_type#}</span>
                </div>
                <div class="col-lg-6">
                    <label>{#fieldActiveName#}:</label>
                    <div class="input-group">
                    <span class="switch switch-icon">
                        <label><input type="checkbox" {if $item.active == 1}checked="checked"{/if} name="item[active]" value="1" ><span></span></label>
                    </span>
                    </div>
                    <span class="form-text text-muted">{#fieldActiveMsg#}</span>
                </div>
            </div>

            <div class="form-group row usuario">
                <div class="col-lg-6">
                    <label>{#fieldUserName#}  <span class="text-danger bold">*</span> :</label>
                    <div class="input-group">
                        <input type="text" class="form-control"
                               name="item[username]" value="{$item.username|escape:"html"}"
                               required
                               data-fv-not-empty___message="{#glFieldRequired#}"

                        >
                        <div class="input-group-append"><span class="input-group-text"><i class="fa fa-user"></i></span></div>
                    </div>
                    <span class="form-text text-muted">{#fieldUserNameMsg#}</span>
                </div>
                <div class="col-lg-6">
                    <label>{#fieldPass#} <span class="text-danger bold">*</span> :</label>
                    <div class="input-group">
                        <input type="text" class="form-control"
                               name="item[password]"
                               placeholder=""
                               {if $type == 'new'}
                                    required
                                    data-fv-not-empty___message="{#glFieldRequired#}"
                                {/if}
                               minlength="3"
                               data-fv-string-length___message="{#fieldPassLength#}"
                        >
                        <div class="input-group-append"><span class="input-group-text"><i class="fa fa-unlock-alt"></i></span></div>
                    </div>
                    {if $type == 'new'}
                        <span class="form-text text-muted">{#fieldPassMsg#}</span>
                    {else}
                        <span class="form-text text-muted">{#fieldPassUpdateMsg#}</span>
                    {/if}
                </div>
            </div>

            <div class="form-group row">
                <div class="col-lg-6">
                    <label>{#fieldName#}  <span class="text-danger bold">*</span> :</label>
                    <div class="input-group">
                        <input type="text" class="form-control"
                               name="item[name]" value="{$item.name|escape:"html"}"
                               required
                               data-fv-not-empty___message="{#glFieldRequired#}"
                               minlength="3"
                               data-fv-string-length___message="{#fieldNameLength#}"
                        >
                        <div class="input-group-append"><span class="input-group-text"><i class="fa fa-user"></i></span></div>
                    </div>
                    <span class="form-text text-muted">{#fieldNameMsg#}</span>
                </div>
                <div class="col-lg-6">
                    <label>{#fieldLastName#} <span class="text-danger bold">*</span> :</label>
                    <div class="input-group">
                        <input type="text" class="form-control"
                               name="item[last_name]"
                               value="{$item.last_name|escape:"html"}"
                               placeholder=""
                               required
                               data-fv-not-empty___message="{#glFieldRequired#}"
                               minlength="3"
                               data-fv-string-length___message="{#fieldLastNameLength#}"
                        >
                        <div class="input-group-append"><span class="input-group-text"><i class="fa fa-user"></i></span></div>
                    </div>
                    <span class="form-text text-muted">{#fieldLastNameMsg#}</span>
                </div>

                <div class="col-lg-3">
                    <label>{#fieldMobile#}:</label>
                    <div class="input-group">
                        <input type="text" class="form-control number_integer2 "
                               name="item[mobile]" value="{$item.mobile|escape:"html"}"
                               minlength="3"
                               data-fv-string-length___message="{#fieldMobileLength#}"
                        >
                        <div class="input-group-append"><span class="input-group-text"><i class="fa fa-phone"></i></span></div>
                    </div>
                    <span class="form-text text-muted">{#fieldMobileMsg#}</span>
                </div>
                <div class="col-lg-3">
                    <label>{#fieldPhone#} :</label>
                    <div class="input-group">
                        <input type="text" class="form-control number_integer2 "
                               name="item[phone]" value="{$item.phone|escape:"html"}"
                               minlength="3"
                               data-fv-string-length___message="{#fieldPhoneLength#}"
                        >
                        <div class="input-group-append"><span class="input-group-text"><i class="fa fa-phone"></i></span></div>
                    </div>
                    <span class="form-text text-muted">{#fieldPhoneMsg#}</span>
                </div>

                <div class="col-lg-6">
                    <label>{#email_field#} :</label>
                    <div class="input-group">
                        <input type="email" class="form-control"
                               name="item[email]" value="{$item.email|escape:"html"}"
                               minlength="3"
                               data-fv-string-length___message="{#email_fieldLength#}"
                        >
                        <div class="input-group-append"><span class="input-group-text"><i class="fas fa-at"></i></span></div>
                    </div>
                    <span class="form-text text-muted">{#email_fieldMsg#}</span>
                </div>
            </div>

            <div class="form-group row {if $item.type != '3' and $item.type != '4' }d-none{/if} oficina" id="oficina_div">
                <div class="col-lg-8">
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
                <div class="col-lg-2">
                    <label>{#jefe_field#}:</label>
                    <div class="input-group">
                    <span class="switch switch-icon">
                        <label><input type="checkbox" {if $item.jefe == 1}checked="checked"{/if} name="item[jefe]" value="1" ><span></span></label>
                    </span>
                    </div>
                    <span class="form-text text-muted">{#jefe_fieldMsg#}</span>
                </div>
                <div class="col-lg-2">
                    <label>{#ingreso_hoja_field#}:</label>
                    <div class="input-group">
                    <span class="switch switch-icon">
                        <label><input type="checkbox" {if $item.ingreso_hoja == 1}checked="checked"{/if} name="item[ingreso_hoja]" value="1" ><span></span></label>
                    </span>
                    </div>
                    <span class="form-text text-muted">{#ingreso_hoja_fieldMsg#}</span>
                </div>
                <div class="col-lg-12">
                    <label>{#cargo_field#}  <span class="text-danger bold">*</span> :</label>
                    <div class="input-group">
                        <input type="text" class="form-control"
                               name="item[cargo]" value="{$item.cargo|escape:"html"}"
                               {*required*}
                               data-fv-not-empty___message="{#glFieldRequired#}"

                        >
                        <div class="input-group-append"><span class="input-group-text"><i class="fas fa-user-graduate"></i></span></div>
                    </div>
                    <span class="form-text text-muted">{#cargo_fieldMsg#}</span>
                </div>
            </div>

            <div class="form-group row">

                <div class="col-lg-12">
                    <label>{#fieldDescription#}:</label>
                    <div class="input-group">
                        <textarea rows="2" class="form-control"
                                  name="item[description]" value="{$item.description|escape:"html"}"
                        >{$item.description|escape:'html'}</textarea>
                    </div>
                    <span class="form-text text-muted">{#fieldDescriptionMsg#}</span>
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