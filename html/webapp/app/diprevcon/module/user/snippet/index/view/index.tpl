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

    <div class="flex-md-row-auto w-md-275px w-xl-325px ml-md-6 ml-lg-8">

        <div class="card card-custom gutter-b" style=" background-color: #27361e;">
            <!--begin::Body-->
            <div class="card-body p-5">
                <h4 class="card-label text-dark-25"><span class="card-icon">
                        <i class="fa fa-search text-dark-25"></i></span> {#title_filter#}</h4>
                <!--begin::Container-->
                {include file="index.search.tpl"}
                <!--end::Container-->
            </div>
            <!--end::Body-->
        </div>
    </div>
</div>