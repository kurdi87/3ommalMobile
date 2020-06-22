<div class="page-bar">
    <ul class="page-breadcrumb">
        {!! generateBreadcrumbs($breadcrumbs) !!}
    </ul>

    @if(isset($isDashboard))
        <div class="page-toolbar">
            <div class="pull-right btn btn-sm">
                <i class="icon-calendar"></i>&nbsp;
                <span class="thin uppercase hidden-xs">{{ date("M d,Y") }}</span>&nbsp;
            </div>
        </div>
    @endif
</div>