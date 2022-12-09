<div class="row">
    <div class="col-lg-12 alert-text">
        <label class="text-dark-25">{#filterName#}:</label>
        <input type="text" class="filtro-buscar-text form-control" placeholder="{#filterName#}" data-col-index="0">
    </div>
    <div class="col-lg-12 alert-text">
        <label class="text-dark-25">{#filterLastName#}:</label>
        <input type="text" class="filtro-buscar-text form-control" placeholder="{#filterLastName#}" data-col-index="1">
    </div>
    <div class="col-lg-12 alert-text">
        <label class="text-dark-25">{#filter_type#}:</label>
        <select class="form-control select2_filter1 filter_select" id="filter_type">
            <option value="no">{#filter_all_type#}</option>
            {html_options options=$cataobj.tipo}
        </select>
    </div>
    <div class="col-lg-12 alert-text">
        <label class="text-dark-25">{#filter_entidad#}:</label>
        <select class="form-control select2_filter1 filter_select_entidad" id="filter_entidad">
            <option value="no">{#filter_all_entidad#}</option>
            {html_options options=$cataobj.oficina}
        </select>
    </div>
    <div class="col-lg-12 alert-text">
        <label class="text-dark-25">{#filter_jefe#}:</label>
        <select class="form-control select2_filter1 filter_select_jefe" id="filter_jefe">
            <option value="no">{#filter_all_jefe#}</option>
            {html_options options=$cataobj.jefe}
        </select>
    </div>
    <div class="col-lg-12 alert-text">
        <label class="text-dark-25">{#filter_hoja#}:</label>
        <select class="form-control select2_filter1 filter_select_hoja" id="filter_hoja">
            <option value="no">{#filter_all_hoja#}</option>
            {html_options options=$cataobj.hoja}
        </select>
    </div>

</div>

