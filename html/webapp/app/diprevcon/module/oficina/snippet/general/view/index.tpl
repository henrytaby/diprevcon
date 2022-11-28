{include file="index.css.tpl"}
<div class="card card-custom gutter-b example example-compact">
    <div class="card-header">
        <h3 class="card-title">{#title#}</h3>
        <div class="card-toolbar">
{*            <div class="example-tools justify-content-center"></div>*}
            <div class="card-toolbar">
                {if $privFace.edit == 1 and $privFace.add == 1}
                    <!--begin::Button-->
                    <a href="#" class="btn btn-success font-weight-bolder" id="btn_form_{$subcontrol}" rel="new">
                        <span><i class="fa fa-plus"></i><span> {#btnNewOficina#}</a>
                    <!--end::Button-->
                {/if}
            </div>
        </div>
    </div>

    <!--begin::Form-->
    <form method="POST"
          action="{$path_url}/{$subcontrol}_/{if $type=="update"}{$id}/{/if}save/"
          id="general_form">


    <div class="card-body">

        <div class="form-group mb-8">
            <div class="alert alert-custom alert-default" role="alert">
                <div class="alert-icon">
                    <span class="svg-icon svg-icon-primary svg-icon-xl">
                        <!--begin::Svg Icon | path:assets/media/svg/icons/Tools/Compass.svg-->
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24"></rect>
                                <path d="M7.07744993,12.3040451 C7.72444571,13.0716094 8.54044565,13.6920474 9.46808594,14.1079953 L5,23 L4.5,18 L7.07744993,12.3040451 Z M14.5865511,14.2597864 C15.5319561,13.9019016 16.375416,13.3366121 17.0614026,12.6194459 L19.5,18 L19,23 L14.5865511,14.2597864 Z M12,3.55271368e-14 C12.8284271,3.53749572e-14 13.5,0.671572875 13.5,1.5 L13.5,4 L10.5,4 L10.5,1.5 C10.5,0.671572875 11.1715729,3.56793164e-14 12,3.55271368e-14 Z" fill="#000000" opacity="0.3"></path>
                                <path d="M12,10 C13.1045695,10 14,9.1045695 14,8 C14,6.8954305 13.1045695,6 12,6 C10.8954305,6 10,6.8954305 10,8 C10,9.1045695 10.8954305,10 12,10 Z M12,13 C9.23857625,13 7,10.7614237 7,8 C7,5.23857625 9.23857625,3 12,3 C14.7614237,3 17,5.23857625 17,8 C17,10.7614237 14.7614237,13 12,13 Z" fill="#000000" fill-rule="nonzero"></path>
                            </g>
                        </svg>
                        <!--end::Svg Icon-->
                    </span>
                </div>
                <div class="alert-text">{#message#}</div>
            </div>
        </div>

        <div class="form-group row">

{*            <div class="col-lg-12">*}
{*                <label>{#fieldGroup#} <span class="text-danger bold">*</span> : </label>*}
{*                <div class="input-group group">*}
{*                    <select class="form-control m-select2 select2_general" name="item[group_id]" id="group_id"*}
{*                            data-placeholder="{#fieldGroupHolder#}" {$privFace.input}*}
{*                            required*}
{*                            data-fv-not-empty___message="{#glFieldRequired#}"*}
{*                    >*}
{*                        <option></option>*}
{*                        {html_options options=$cataobj.group selected=$item.group_id}*}
{*                    </select>*}
{*                </div>*}
{*                <span class="form-text text-black-50">{#fieldGroupMsg#}</span>*}
{*            </div>*}

            <div class="col-lg-3">
                <label>{#fieldActiveName#}:</label>
                <div class="input-group">
                    <span class="switch switch-icon">
                        <label><input type="checkbox" {if $item.active == 1}checked="checked"{/if} name="item[active]" value="1" ><span></span></label>
                    </span>
                </div>

                <span class="form-text text-muted">{#fieldActiveMsg#}</span>
            </div>

            <div class="col-lg-9">
                <label>{#field_nombre#} <span class="text-danger bold">*</span> :</label>
                <div class="col-lg-12 ">
                <input type="text" class="form-control"
                       name="item[nombre]"
                       value="{$item.nombre|escape:"html"}"
                       required
                       data-fv-not-empty___message="{#glFieldRequired#}"
                       minlength="3"
                       data-fv-string-length___message="{#field_length_nombre#}"
                >
                <span class="form-text text-muted">{#field_length_nombre#}</span>
                </div>
            </div>
            <div class="col-lg-4">
                <label>{#field_sigla#} <span class="text-danger bold">*</span> :</label>
                <div class="col-lg-12 ">
                    <input type="text" class="form-control"
                           name="item[sigla]"
                           value="{$item.sigla|escape:"html"}"
                           required
                           data-fv-not-empty___message="{#glFieldRequired#}"
                           minlength="3"
                           data-fv-string-length___message="{#field_length_sigla#}"
                    >
                    <span class="form-text text-muted">{#field_msg_sigla#}</span>
                </div>
            </div>

            <div class="col-lg-8">
                <label>{#field_entidad#}: <span class="text-danger bold">*</span></label>
                <div class="input-group" >
                    <select class="form-control select2_general" name="item[entidad_id]"
                            required
                            data-fv-not-empty___message="{#glFieldRequired#}"
                            id="tipo_select" data-placeholder="{#field_Holder_entidad#}">
                        <option></option>
                        {html_options options=$cataobj.entidad selected=$item.entidad_id}
                    </select>
                </div>
                <span class="form-text text-black-50">{#field_msg_entidad#}</span>
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

<!--begin::Modal-->
<div class="modal fade" id="form_modal_{$subcontrol}"
     data-backdrop="static" tabindex="-1" role="dialog"
     aria-labelledby="staticBackdrop" aria-hidden="true"
>
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-lg" id="modal-content_{$subcontrol}">
        </div>
    </div>
</div>
<!--end::Modal-->

{include file="index.js.tpl"}