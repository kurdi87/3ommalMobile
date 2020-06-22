@php
    use Carbon\Carbon;
    use App\Models\AdmissionModel;
@endphp


@extends('cp.layout.layout')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">

                        <span class="caption-subject bold uppercase">Dashboard</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <h2><span class="text-danger">No Statistical Data </span> </h2>
                </div>
            </div>
        </div>

    </div>
    <!-- END EXAMPLE TABLE PORTLET-->




@stop