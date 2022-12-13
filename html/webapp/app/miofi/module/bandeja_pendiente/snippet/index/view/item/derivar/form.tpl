{include file="item/derivar/form.css.tpl"}
<form method="POST"
      action="{$path_url}/{$item_id}/save"
      id="form_{$subcontrol}">
    {if $item.id != "" or $type == 'new'}
        <div class="modal-body">
            <div class="alert alert-primary" role="alert">
                {#title#}
            </div>

            <div class="form-group row">

                <div class="col-lg-12">
                    <label>{#derivado_a_user_id_field#}: </label>
                    <div class="input-group">
                        <select class="form-control m-select2 select2_deriva"
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


                <div class="col-lg-8">
                    <label>{#instruccion_id_field#}: </label>
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


                <div class="col-lg-4">
                    <label>{#field_urgente#}:</label>
                    <div class="input-group">
                    <span class="switch switch-icon switch-danger">
                        <label><input id="urgente" type="checkbox" {if $item.limite == 1}checked="checked"{/if} name="item[urgente]" value="1" ><span></span></label>
                    </span>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_urgente#}</span>
                </div>


                {if $uservAdd.jefe}
                <div class="col-lg-8">
                    <label>{#actividad_id_field#}: </label>
                    <div class="input-group">
                        <select class="form-control m-select2 select2_deriva"
                                name="item[proceso_id]" id="proceso_id" required
                                data-placeholder="{#actividad_id_field_holder#}" {$privFace.input}
                                data-fv-not-empty___message="{#glFieldRequired#}"
                        >
                            <option value="null">Sin Actividad</option>
                            {html_options options=$cataobj.actividad selected=$item.actividad_id}
                        </select>
                    </div>
                    <span class="form-text text-black-50">{#actividad_id_field_msg#}</span>
                </div>
                <div class="col-lg-4 " id="limite_check">
                    <label>{#field_limite#}:</label>
                    <div class="input-group">
                    <span class="switch switch-icon switch-success">
                        <label><input id="limite" type="checkbox" {if $item.limite == 1}checked="checked"{/if} name="item[proceso_limite]" value="1" ><span></span></label>
                    </span>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_limite#}</span>
                </div>
                {/if}

            </div>

            {if $uservAdd.jefe}
            <div class="form-group row limite {if $item.limite == false }d-none{/if}" id="limite_div">

                <div class="col-lg-4">
                    <label>{#field_dias#}:</label>
                    <div class="input-group">
                        <input type="text" class="form-control number_integer p-5"
                               name="item[proceso_dias]" id="proceso_dias" value="0" required data-fv-not-empty___message="{#glFieldRequired#}"
                        >
                        <div class="input-group-append"><span class="input-group-text"><i class="fas fa-calendar-check"></i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_dias#}</span>
                </div>
                <div class="col-lg-4">
                    <label>{#field_horas#}:</label>
                    <div class="input-group">
                        <input type="text" class="form-control number_integer p-5"
                               name="item[proceso_horas]" id="proceso_horas" value="0" required data-fv-not-empty___message="{#glFieldRequired#}"
                        >
                        <div class="input-group-append"><span class="input-group-text"><i class="fas fa-calendar-check"></i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_horas#}</span>
                </div>
                <div class="col-lg-4">
                    <label>{#field_min#}:</label>
                    <div class="input-group">
                        <input type="text" class="form-control number_integer p-5"
                               name="item[proceso_minutos]" id="proceso_minutos" value="0" required data-fv-not-empty___message="{#glFieldRequired#}"
                        >
                        <div class="input-group-append"><span class="input-group-text"><i class="fas fa-calendar-check"></i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_min#}</span>
                </div>
            </div>
            {/if}

            <div class="form-group row">
                <div class="col-lg-12">
                    <label>{#proveido_field#}:</label>
                    <div class="input-group">
                        <textarea rows="3" class="form-control" name="item[proveido]"  {$privFace.input}>{$item.proveido|escape:'html'}</textarea>
                    </div>
                    <span class="form-text text-muted">{#proveido_field_msg#}</span>
                </div>
            </div>

        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-light-primary" id="form_close_{$subcontrol}" data-dismiss="modal"><i class="la la-angle-double-left"></i>{#glBtnCloce#}</button>
            {if $privFace.edit == 1}
                <button type="button" class="btn btn-primary font-weight-bold" id="form_submit_{$subcontrol}"><i class="la la-save"></i>{*#glBtnSave#*}{#btnDerivar#}</button>
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
