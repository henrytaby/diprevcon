{include file="index.css.tpl"}
<div class="d-flex flex-column flex-md-row">
    <div class="flex-md-row-fluid ">
        <div class="card card-custom gutter-b">
            <div class="card-body p-5">
                <!--begin: Datatable-->
                <table class="table {*table-separate*} table-head-custom table-bordered table-hover
            table-checkable d-none table-sm {*table-striped*}" id="index_list">
                    <thead class="thead-dark thead-color"><tr>
                        {foreach from=$gridItem item=row key=idx}
                            <th>{$row.label|escape:"html"}</th>
                        {/foreach}
                    </tr></thead>
                    <tbody></tbody>
                </table>
                <!--end: Datatable-->
            </div>
        </div>
    </div>
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