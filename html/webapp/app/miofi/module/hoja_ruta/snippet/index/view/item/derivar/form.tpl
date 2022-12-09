{include file="item/derivar/form.css.tpl"}
<form method="POST"
      action="{$path_url}/{$item_id}/save"
      id="form_{$subcontrol}">
    {if $item.id != "" or $type == 'new'}
        <div class="modal-body">
            <div class="alert alert-primary" role="alert">
                {if $type == 'new'}{#glnew#}{else}{#glupdate#}{/if} - {#title#}
            </div>

            <div class="form-group row">

                <div class="col-lg-12">
                    <label>{#derivado_a_user_id_field#} <span class="text-danger bold">*</span>: </label>
                    <div class="input-group">
                        <select class="form-control m-select2 select2_general"
                                name="item[derivado_a_user_id]" id="derivado_a_user_id" required
                                data-placeholder="{#derivado_a_user_id_field_holder#}" {$privFace.input}
                                data-fv-not-empty___message="{#glFieldRequired#}"
                        >
                            <option></option>
                            {html_options options=$cataobj.persona selected=$item.derivado_a_user_id}
                        </select>
                    </div>
                    <span class="form-text text-black-50">{#derivado_a_user_id_field_msg#}</span>
                </div>

                <div class="col-lg-6">
                    <label>{#instruccion_id_field#} <span class="text-danger bold">*</span>: </label>
                    <div class="input-group">
                        <select class="form-control m-select2 select2_general"
                                name="item[instruccion_id]" id="instruccion_id" required
                                data-placeholder="{#instruccion_id_field_holder#}" {$privFace.input}
                                data-fv-not-empty___message="{#glFieldRequired#}"
                        >
                            <option></option>
                            {html_options options=$cataobj.instruccion selected=$item.instruccion_id}
                        </select>
                    </div>
                    <span class="form-text text-black-50">{#instruccion_id_field_msg#}</span>
                </div>


                <div class="col-lg-6">
                    {*
                    <label>{#actividad_id_field#}: </label>
                    <div class="input-group">
                        <select class="form-control m-select2 select2_general"
                                name="item[proceso_id]" id="proceso_id" required
                                data-placeholder="{#actividad_id_field_holder#}" {$privFace.input}
                                data-fv-not-empty___message="{#glFieldRequired#}"
                        >
                            <option></option>
                            {html_options options=$cataobj.actividad selected=$item.actividad_id}
                        </select>
                    </div>
                    <span class="form-text text-black-50">{#actividad_id_field_msg#}</span>
*}
                </div>

                <div class="col-lg-12">
                    <label>{#proveido_field#}: <span class="text-danger bold">*</span></label>
                    <div class="input-group">
                        <textarea rows="3" class="form-control" name="item[proveido]"
                                required data-fv-not-empty___message="{#glFieldRequired#}"
                                {$privFace.input}>{$item.proveido|escape:'html'}</textarea>
                    </div>
                    <span class="form-text text-muted">{#proveido_field_msg#}</span>
                </div>
            </div>

        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-light-primary" id="form_close_{$subcontrol}" data-dismiss="modal"><i class="la la-angle-double-left"></i>{#glBtnCloce#}</button>
            {if $privFace.edit == 1}
            <button type="button" class="btn btn-primary font-weight-bold" id="form_submit_{$subcontrol}"><i class="la la-save"></i>{#glBtnSave#}</button>
            {/if}
        </div>

    {else}
        <div class="modal-body">
            No existe el registro
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-light-primary" id="form_close_{$subcontrol}" data-dismiss="modal"><i class="la la-angle-double-left"></i>Cerrar</button>
        </div>
    {/if}

</form>

{include file="item/derivar/form.js.tpl"}
