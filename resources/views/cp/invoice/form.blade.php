<div class="row">
    <div class="col-md-12">
        <div class="tabbable-line boxless tabbable-reversed">
            <div class="form-top tabbable-line clearfix">

                <div class="actions">
                    @if (in_array($role, $create_edit)|| in_array($role, array_merge($spu,[10])))
                        <button type="submit" class="btn btn-circle btn-icon-only btn-default tooltip-one-info"
                                title="Save &amp; Close">
                            <i class="fa fa-save"></i>
                        </button>
                        <button name="save_new" type="submit"
                                class="btn btn-circle btn-icon-only btn-default btn-wnew tooltip-one-info"
                                title="Save &amp; New">
                            <i class="fa fa-save"></i>
                            <span class="fa fa-plus"></span>
                        </button>
                    @endif
                    <a href="{{ config('app.cp_route_name') }}/invoice"
                       class="btn btn-circle btn-icon-only btn-default tooltip-one-info" title="Cancel">
                        <i class="fa fa-remove"></i>
                    </a>
                    <a href="javascript:;"
                       class="btn btn-circle btn-icon-only btn-default tooltip-one-info print" title="print">
                        <i class="fa fa-print"></i>
                    </a>
                    @if(isset($result->id) && $result->status=="18")
                        <a title="Print Audit invoice "
                           class=" btn btn-circle btn-icon-only btn-default tooltip-one-info tooltipstered"
                           href="{{config("app.cp_route_name")}}/invoice/invoiceForm/{{$result->id}}?type=audit"
                           target="_blank">
                            <i class="fa fa-opencart"></i>
                        </a>
                    @endif
                </div>


            </div>
            <div class="tab-content tabcontent-noborder">
                <div class="tab-pane active">
                    <div class="portlet box blue" id="pp1">
                        <div class="portlet-title ">
                            <div class="capnvoice Information
tion">
                                <i class="icon-globe"></i>invoice
                            </div>
                        </div>
                        <div class="portlet-body collapse-body form">
                            <!-- BEGIN FORM-->
                            <div class="horizontal-form">
                                <div class="form-body">

                                    <div class="row">

                                        @if(isset($patient))
                                            <div class="col-md-12">
                                                <div class="portlet box yellow  ">
                                                    <div class="portlet-title ">
                                                        <div class="caption">
                                                            Patient Information
                                                        </div>
                                                        <div class="tools">
                                                            <a href="" class="collapse"> </a>
                                                        </div>
                                                    </div>

                                                    <div class="portlet-body  padding-15-all">
                                                        <div class="row">

                                                            <div class="col-md-12">
                                                                <div class="row">


                                                                    <div class="col-md-4">
                                                                        <div class="form-group input-wlbl ">
                                                                            <span class="">Document No</span>
                                                                            <p>{{isset($patient->sid)?$patient->sid:Null}}</p>

                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-group input-wlbl ">
                                                                            <span class="">Document Type</span>
                                                                            <p>{{isset($patient->dtype)?\App\Models\TypesModel::getTypeName($patient->dtype):Null}}</p>

                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-4">
                                                                        <div class="form-group input-wlbl ">
                                                                            <span class="">File Number</span>
                                                                            <p>{{isset($patient->file_no)?$patient->file_no:Null}}</p>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-3">
                                                                        <div class="form-group input-wlbl ">
                                                                            <span class="">First Name</span>
                                                                            <p>{{isset($patient->fname)?$patient->fname:Null}}</p>

                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="form-group input-wlbl ">
                                                                            <span class="">Second Name</span>
                                                                            <p>{{isset($patient->sname)?$patient->sname:Null}}</p>

                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="form-group input-wlbl ">
                                                                            <span class="">Third Name</span>
                                                                            <p>{{isset($patient->tname)?$patient->tname:Null}}</p>

                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="form-group input-wlbl ">
                                                                            <span class="">Last Name</span>
                                                                            <p>{{isset($patient->faname)?$patient->faname:Null}}</p>

                                                                        </div>
                                                                    </div>
                                                                </div>


                                                                <div class="row">
                                                                    <div class="col-md-3">
                                                                        <div class="form-group input-wlbl ">
                                                                            {!! Form::text('appointment_id',isset($appointment_id)?$appointment_id:0,['class'=>'form-control hidden ']) !!}
                                                                            <span class="">First Name Ar</span>
                                                                            <p>{{isset($patient->fname_ar)?$patient->fname_ar:Null}}</p>

                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="form-group input-wlbl ">
                                                                            <span class="">Second Name Ar</span>
                                                                            <p>{{isset($patient->sname)?$patient->sname_ar:Null}}</p>

                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="form-group input-wlbl ">
                                                                            <span class="">Third Name Ar</span>
                                                                            <p>{{isset($patient->tname)?$patient->tname_ar:Null}}</p>

                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="form-group input-wlbl ">
                                                                            <span class="">Last Name Ar</span>
                                                                            <p>{{isset($patient->faname)?$patient->faname_ar:Null}}</p>

                                                                        </div>
                                                                    </div>
                                                                </div>


                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="row">
                                                                            <div class="col-md-6 ">
                                                                                <div class="form-group input-wlbl ">
                                                                                    <span class="">Date of Birth</span>
                                                                                    <p>{{  isset($patient->bod)? date('Y-m-d', strtotime($patient->bod)):Null}}</p>

                                                                                </div>


                                                                            </div>
                                                                            <div class="col-md-6 hidden">
                                                                                <div class="form-group input-wlbl ">
                                                                                    <span class="">Place of Birth</span>
                                                                                    <p>{{isset($patient->birth_place)? \App\Models\CountryModel::getCountryname($patient->bodplace) :Null}}</p>

                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-4 hidden">
                                                                                <div class="form-group input-wlbl ">
                                                                                    <span class="">Title</span>
                                                                                    <p>{{isset($patient->title)?\App\Models\TypesModel::getTypeName($patient->tilte):Null}}</p>

                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-4">
                                                                                <div class="form-group input-wlbl ">
                                                                                    <span class="">Gender</span>
                                                                                    <p>{{isset($patient->gender)?\App\Models\TypesModel::getTypeName($patient->gender):Null}}</p>

                                                                                </div>
                                                                            </div>


                                                                            <div class="col-md-4 hidden">
                                                                                <div class="form-group input-wlbl ">
                                                                                    <span class="">Blood</span>
                                                                                    <p>{{isset($patient->blood)?\App\Models\TypesModel::getTypeName($patient->blood):Null}}</p>

                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-6 hidden">
                                                                        <div class="form-group input-wlbl  @if ($errors->has('image')) has-error @endif">
                                                                            <span class=""> Image</span>
                                                                            <div class="profile-userpic">
                                                                                <div class="upload-admission-img"
                                                                                     style="{{ isset($patient->image)?"background-image:url(img/patient/".$patient->image.")":""}}">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">


                                                                </div>
                                                            </div>

                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="portlet box red ">
                                                    <div class="portlet-title ">
                                                        <div class="caption">
                                                            Hospital Information
                                                        </div>
                                                        <div class="tools">
                                                            <a href="#" class="collapse"> </a>
                                                        </div>
                                                    </div>

                                                    <div class="portlet-body collapse-body padding-15-all">
                                                        <div class="row">

                                                            <div class="col-md-3">
                                                                <div class="form-group input-wlbl">
                                                                    <span class="">Hospital</span>
                                                                    <p>{{isset($event->hospital_id)?\App\Models\RecipeModel::getHospitalName($event->hospital_id) :Null}}</p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group input-wlbl">
                                                                    <span class="">Department</span>
                                                                    <p>{{isset($event->department_id)?\App\Models\DepartmentModel::getDepartmentName($event->department_id) :Null}}</p>

                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group input-wlbl  @if ($errors->has('doctor_id')) has-error @endif">
                                                                    <span class="">Doctor</span>
                                                                    <p>{{isset($event->doctor_id)?\App\Models\DoctorInfoModel::getDoctorName($event->doctor_id) :Null}}</p>

                                                                </div>
                                                            </div>


                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="portlet box green ">
                                                    <div class="portlet-title ">
                                                        <div class="caption">
                                                            Coverage Information Event #<a
                                                                    href="{{ config('app.cp_route_name') }}/event/edit/{{$event->id}}"
                                                                    style="color: #fff"
                                                                    target="_blank">{{$event->id}}</a>
                                                        </div>
                                                        <div class="tools">
                                                            <a href="" class="collapse"> </a>
                                                        </div>
                                                    </div>

                                                    <div class="portlet-body collapse-body padding-15-all">

                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <div class="form-group input-wlbl   has-error ">
                                                                    <span class="">Event No</span>


                                                                    {!! Form::text('event_no',isset($event->event_no)?$event->event_no:null,['class'=>'form-control']) !!}
                                                                    @if ($errors->has('event_no'))
                                                                        <span class="help-block error">{{ $errors->first('event_no') }}</span>
                                                                    @endif

                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group input-wlbl">
                                                                    <span class="">Coverage No</span>
                                                                    <p>{{isset($event->coverage_no)?$event->coverage_no:Null}}</p>

                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group input-wlbl">
                                                                    <span class="">Financing Pary</span>
                                                                    <p>{{isset($event->finance_party)?\App\Models\FinancePartyModel::getFianancePartyName($event->finance_party):Null}}</p>

                                                                </div>
                                                            </div>

                                                            <div class="col-md-3">

                                                                <div class="form-group input-wlbl">
                                                                    <span class="">Coverage Type</span>
                                                                    <p>{{isset($event->coverage_type)?\App\Models\TypesModel::getTypeName($event->coverage_type):Null}}</p>

                                                                </div>

                                                            </div>

                                                            <div class="col-md-3">
                                                                <div class="form-group input-wlbl">
                                                                    <span class="">Coverage Cost</span>
                                                                    <p>{{isset($event->coverage_cost)?$event->coverage_cost:Null}}</p>

                                                                </div>

                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group input-wlbl">
                                                                    <span class="">Service Date</span>
                                                                    <p>{{   isset($event->coverage_date)? date('Y-m-d', strtotime($event->coverage_date)):Null}}</p>

                                                                </div>
                                                            </div>
                                                            <div class="col-md-3 hidden">
                                                                <div class="form-group input-wlbl">
                                                                    <span class="">Insurance No</span>
                                                                    <p>{{isset($event->insurance_no)?$event->insurance_no:Null}}</p>

                                                                </div>


                                                            </div>
                                                            <div class="col-md-3 hidden">
                                                                <div class="form-group input-wlbl">
                                                                    <span class="">Insurance Status</span>
                                                                    <p>{{isset($event->insurance_status)?\App\Models\TypesModel::getTypeName($event->insurance_status):Null}}</p>

                                                                </div>

                                                            </div>
                                                            <div class="col-md-3 hidden" >
                                                                <div class="form-group input-wlbl">
                                                                    <span class="">Insurance Type</span>
                                                                    <p>{{isset($event->insurance_type)?\App\Models\TypesModel::getTypeName($event->insurance_type):Null}}</p>

                                                                </div>

                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group input-wlbl">
                                                                    <span class="">Insurance Coverage Percentage</span>
                                                                    <p>{{   isset($event->insurance_cov)?$event->insurance_cov:Null}}</p>

                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group input-wlbl">
                                                                    <span class="">Insurance Date</span>
                                                                    <p>{{   isset($event->insurance_date)? date('Y-m-d', strtotime($event->insurance_date)):Null}}</p>

                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group input-wlbl">
                                                                    <span class="">Insurance Expire Date</span>
                                                                    <p>{{   isset($event->insurance_exdate)? date('Y-m-d', strtotime($event->insurance_exdate)):Null}}</p>

                                                                </div>
                                                            </div>


                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="portlet box purple">
                                                    <div class="portlet-title">
                                                        <div class="caption">
                                                            Event Information Event #<a
                                                                    href="{{ config('app.cp_route_name') }}/event/edit/{{$event->id}}"
                                                                    style="color: #fff"
                                                                    target="_blank">{{$event->id}}</a>
                                                        </div>
                                                        <div class="tools">
                                                            <a href="" class="expand"> </a>

                                                        </div>
                                                    </div>


                                                    <div class="portlet-body  padding-15-all">

                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <div class="form-group input-wlbl">
                                                                    <span class="">Referral Type</span>
                                                                    <p>{{isset($event->referral_type)?\App\Models\TypesModel::getTypeName($event->referral_type):Null}}</p>

                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group input-wlbl">
                                                                    <span class="">Service Type</span>
                                                                    <p>{{isset($event->service_type)?\App\Models\TypesModel::getTypeName($event->service_type):Null}}</p>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="portlet box default">
                                                    <div class="portlet-title ">
                                                        <div class="caption">
                                                            Admission Information #<a
                                                                    href="{{ config('app.cp_route_name') }}/admission/edit/{{$admission->id}}"
                                                                    target="_blank">{{$admission->id}}</a>
                                                        </div>
                                                        <div class="tools">
                                                            <a href="" class="collapse"> </a>

                                                        </div>
                                                    </div>


                                                    <div class="portlet-body  padding-15-all">

                                                        <div class="row">

                                                            <div class="col-md-3">
                                                                <div class="form-group input-wlbl  @if ($errors->has('hospital_id')) has-error @endif">
                                                                    <span class="">Hospital</span>
                                                                    <p>{{isset($admission->hospital_id)?\App\Models\RecipeModel::getHospitalName($admission->hospital_id) :Null}}</p>

                                                                </div>
                                                            </div>

                                                            <div class="col-md-3">
                                                                <div class="form-group input-wlbl  @if ($errors->has('department_id')) has-error @endif">
                                                                    <span class="">Department</span>

                                                                    <p>{{isset($admission->department_id)?\App\Models\DepartmentModel::getDepartmentName($admission->department_id) :Null}}</p>

                                                                </div>
                                                            </div>


                                                            <div class="col-md-12">
                                                                <div class="form-group   @if ($errors->has('notes')) has-error @endif">
                                                                    <span class="">Notes</span>
                                                                    <p>{{isset($admission->notes)?$admission->notes :Null}}</p>

                                                                </div>
                                                            </div>

                                                            <div class="col-md-3 hidden">
                                                                <div class="form-group input-wlbl  @if ($errors->has('procedures')) has-error @endif">
                                                                    <span class="">Procedures</span>
                                                                    <p>{{isset($admission->procedures)?$admission->procedures :Null}}</p>

                                                                </div>
                                                            </div>


                                                        </div>
                                                    </div>
                                                </div>


                                            </div>



                                        @endif
                                        @if (in_array($role, array_merge($spu,$create_edit,[10])))
                                            <div class="col-md-12">
                                                <div class="portlet box default">
                                                    <div class="portlet-title ">
                                                        <div class="caption">
                                                            Invoice Information
                                                        </div>
                                                        <div class="tools">
                                                            <a href="" class="collapse"> </a>

                                                        </div>
                                                    </div>


                                                    <div class="portlet-body padding-15-all">

                                                        <div class="row">


                                                            <div class="col-md-12">

                                                                <!-- BEGIN EXAMPLE TABLE PORTLET-->

                                                                <div class="portlet green box bordered" id="p1">
                                                                    <div class="portlet-title">
                                                                        <div class="caption font-dark">

                                                                            <div class="btn-group">

                                                                            </div>


                                                                            <a title="Add Procedure"
                                                                               data-modal="modal-proadd"
                                                                               class="promodal btn btn-circle btn-icon-only btn-default tooltip-one-info"
                                                                               data-id=""
                                                                               href="#">
                                                                                <i class="fa fa-plus"> </i>
                                                                            </a> Procedures

                                                                        </div>
                                                                    </div>
                                                                    <div class="portlet-body">
                                                                        <div class="table-toolbar">
                                                                            <div class="row">
                                                                                <div class="col-md-6">


                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <div class="btn-group pull-right">
                                                                                        <button class="btn green  btn-outline dropdown-toggle"
                                                                                                data-toggle="dropdown">
                                                                                            Procedures
                                                                                            List
                                                                                            <i class="fa fa-angle-down"></i>
                                                                                        </button>
                                                                                        <ul class="dropdown-menu pull-right">
                                                                                            <li>
                                                                                                <a class="exportData"
                                                                                                   data-href="{{ config('app.cp_route_name') }}/invoice/listProcedure/{{$result->id}}?export=csv&amp;"
                                                                                                   href="{{ config('app.cp_route_name') }}/invoice/listProcedure/{{$result->id}}?export=csv&amp;">
                                                                                                    <i class="fa fa-print"></i>Export
                                                                                                    To CSV
                                                                                                </a>
                                                                                            </li>
                                                                                            <li>
                                                                                                <a class="exportData"
                                                                                                   data-href="{{ config('app.cp_route_name') }}/invoice/listProcedure/{{$result->id}}?export=xlsx&amp;"
                                                                                                   href="{{ config('app.cp_route_name') }}/invoice/listProcedure/{{$result->id}}?export=xlsx&amp;">
                                                                                                    <i class="fa fa-file-excel-o"></i>Export
                                                                                                    To Excel
                                                                                                </a>
                                                                                            </li>
                                                                                            <li>
                                                                                                <a class="exportData"
                                                                                                   data-href="{{ config('app.cp_route_name') }}/invoice/listProcedure/{{$result->id}}?getProcedure=pdf&amp;"
                                                                                                   href="{{ config('app.cp_route_name') }}/invoice/listProcedure/{{$result->id}}?export=pdf&amp;">
                                                                                                    <i class="fa fa-file-pdf-o"></i>
                                                                                                    Export To PDF
                                                                                                </a>
                                                                                            </li>
                                                                                        </ul>
                                                                                    </div>
                                                                                </div>

                                                                            </div>
                                                                        </div>

                                                                        <!-- tblactions region -->

                                                                        <table class="table table-striped table-bordered table-hover table-checkable order-column"
                                                                               id="mydatatable">
                                                                            <thead>
                                                                            <tr>
                                                                                <th>ID</th>
                                                                                <th>Name</th>
                                                                                <th>Service Code</th>
                                                                                <th>Cost</th>
                                                                                <th>Qty</th>
                                                                                <th>Total cost NIS</th>
                                                                                <th>Discount</th>
                                                                                <th>Grand Total</th>
                                                                                <th>Status</th>

                                                                                <th class="tblaction-rg tblaction-three-rg">
                                                                                    Delete
                                                                                </th>
                                                                            </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                            </tbody>
                                                                            <tfoot>
                                                                            <tr>
                                                                                <th colspan="4"><h4
                                                                                            class="text text-danger">
                                                                                        Total
                                                                                        Cost:</h4></th>
                                                                                <th colspan="5"></th>
                                                                            </tr>
                                                                            <tr>
                                                                                <th colspan="4"><h4
                                                                                            class="text text-danger">
                                                                                        Discount :</h4></th>
                                                                                <th colspan="2">   {!! Form::text('discount',isset($result->discount)?$result->discount:0,['class'=>'discountt  form-control ']) !!}</th>
                                                                                <th colspan="2"><h4
                                                                                            class="text text-danger">
                                                                                        Percentage :</h4></th>
                                                                                <th colspan="1"><input name="perc"
                                                                                                       type="checkbox"
                                                                                                       value="1"
                                                                                                       class="perc" {{isset($result->discount)?($result->perc=="1"?"checked":""):""}}>
                                                                                </th>

                                                                            </tr>

                                                                            <tr>
                                                                                <th colspan="4" style=""><h4
                                                                                            class="text text-success">
                                                                                        Approved Cost: </h4></th>
                                                                                <th colspan="5">
                                                                                    <div class="input-group">
                                                                                        {!! Form::text('approved_cost',isset($result->approved_cost)?$result->approved_cost:Null,['class'=>'approved_cost  form-control ']) !!}
                                                                                        {!! Form::text('start_approved_cost',isset($result->approved_cost)?$result->approved_cost:Null,['class'=>'start_approved_cost grand form-control hidden ']) !!}

                                                                                        <span class="input-group-btn">
                      <button class="btn default" type="button">
                          NIS
                      </button>
                  </span>
                                                                                    </div>


                                                                                </th>
                                                                            </tr>
                                                                            </tfoot>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                                <!-- END EXAMPLE TABLE PORTLET-->
                                                            </div>



                                                            <div class="col-md-4 {{in_array($role,[10])?'hidden':''}}">
                                                                <div class="form-group input-wlbl  @if ($errors->has('status')) has-error @endif">
                                                                    <span class="">Status</span>

                                                                    {!! Form::select('status',$status,null,['class'=>'form-control select2 txtinput-required txtinput']) !!}
                                                                    @if ($errors->has('status'))
                                                                        <span class="help-block error">{{ $errors->first('status') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            <div class="col-md-4 {{in_array($role,[10])?'hidden':''}}">
                                                                <div class="form-group input-wlbl  @if ($errors->has('invoice_month')) has-error @endif">
                                                                    <span class="">Month</span>

                                                                    {!! Form::select('invoice_month',$invoice_month,null,['class'=>'form-control select2 txtinput-required txtinput']) !!}
                                                                    @if ($errors->has('invoice_month'))
                                                                        <span class="help-block error">{{ $errors->first('invoice_month') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4 {{in_array($role,[10])?'hidden':''}}">
                                                                <div class="form-group input-wlbl  @if ($errors->has('invoice_year')) has-error @endif">
                                                                    <span class="">Year</span>

                                                                    {!! Form::select('invoice_year',$invoice_year,null,['class'=>'form-control select2 txtinput-required txtinput']) !!}
                                                                    @if ($errors->has('invoice_year'))
                                                                        <span class="help-block error">{{ $errors->first('invoice_year') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>


                                                            <div class="col-md-3 {{in_array($role,[10])?'hidden':''}}">

                                                                <div class="form-group input-wlbl @if ($errors->has('discharge_date')) has-error @endif">
                                                                    <span class=""> Discharge Date</span>

                                                                    <div class="input-group input-medium  date date-picker"
                                                                         data-date-format="yyyy-mm-dd"
                                                                         data-date={{date('Y-m-d')}}
                                                                                 data-date-viewmode="years">
                                                                        {!! Form::text('discharge_date',isset($result->discharge_date)? date('Y-m-d', strtotime($result->discharge_date)):Null,['class'=>'form-control']) !!}
                                                                        <span class="input-group-btn">
                      <button class="btn default" type="button">
                          <i class="fa fa-calendar"></i>
                      </button>
                  </span>
                                                                    </div>
                                                                    @if ($errors->has('discharge_date'))
                                                                        <span class="help-block error">{{ $errors->first('discharge_date') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3 {{in_array($role,[10])?'hidden':''}}">

                                                                <div class="form-group input-wlbl @if ($errors->has('invoice_date')) has-error @endif">
                                                                    <span class="">Invoice Date</span>

                                                                    <div class="input-group input-medium date date-picker"
                                                                         data-date-format="yyyy-mm-dd"
                                                                         data-date={{date('Y-m-d')}}
                                                                                 data-date-viewmode="years">
                                                                        {!! Form::text('invoice_date',isset($result->invoice_date)? date('Y-m-d', strtotime($result->invoice_date)):Null,['class'=>'form-control']) !!}
                                                                        <span class="input-group-btn">
                      <button class="btn default" type="button">
                          <i class="fa fa-calendar"></i>
                      </button>
                  </span>
                                                                    </div>
                                                                    @if ($errors->has('invoice_date'))
                                                                        <span class="help-block error">{{ $errors->first('invoice_date') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>


                                                            <div class="col-md-3 {{in_array($role,array_merge($spu,[10]))?'hidden':''}}">
                                                                <div class="form-group input-wlbl @if ($errors->has('agent_amounnt')) has-error @endif">
                                                                    <span class="">Paid to Agent Amount</span>

                                                                    <div class="input-group">
                                                                        {!! Form::text('agent_amounnt',null,['class'=>'form-control txtinput-number  ']) !!}

                                                                        <span class="input-group-btn">
                      <button class="btn default" type="button">
                         NIS
                      </button>
                  </span>
                                                                    </div>


                                                                    @if ($errors->has('agent_amounnt'))
                                                                        <span class="help-block error">{{ $errors->first('agent_amounnt') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3 {{in_array($role,array_merge($spu,[10]))?'hidden':''}}">
                                                                <div class="form-group input-wlbl  @if ($errors->has('paid_to_hos')) has-error @endif">
                                                                    <span class="">Paid To Agent </span>
                                                                    {!! Form::checkbox('paid_to_hos')!!}

                                                                    @if ($errors->has('paid_to_hos'))
                                                                        <span class="help-block error">{{ $errors->first('paid_to_hos') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="clearfix">
                                                                <hr>
                                                            </div>
                                                            <div class="col-md-3 {{in_array($role,array_merge($spu,[10]))?'hidden':''}}">
                                                                <div class="form-group input-wlbl  @if ($errors->has('rfp_to_hos')) has-error @endif">
                                                                    <span class="">RFP Sent to Hospital </span>
                                                                    {!! Form::checkbox('rfp_to_hos')!!}

                                                                    @if ($errors->has('rfp_to_hos'))
                                                                        <span class="help-block error">{{ $errors->first('nrfp_to_hosotes') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            <div class="col-md-3 {{in_array($role,array_merge($spu,[10]))?'hidden':''}}">

                                                                <div class="form-group input-wlbl @if ($errors->has('rfp_date')) has-error @endif">
                                                                    <span class=""> RFP Date</span>

                                                                    <div class="input-group input-medium  date date-picker"
                                                                         data-date-format="yyyy-mm-dd"
                                                                         data-date={{date('Y-m-d')}}
                                                                                 data-date-viewmode="years">
                                                                        {!! Form::text('rfp_date',isset($result->rfp_date)? date('Y-m-d', strtotime($result->rfp_date)):Null,['class'=>'form-control']) !!}
                                                                        <span class="input-group-btn">
                      <button class="btn default" type="button">
                          <i class="fa fa-calendar"></i>
                      </button>
                  </span>
                                                                    </div>
                                                                    @if ($errors->has('rfp_date'))
                                                                        <span class="help-block error">{{ $errors->first('rfp_date') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>


                                                            <div class="col-md-3 {{in_array($role,array_merge($spu,[10]))?'hidden':''}}">
                                                                <div class="form-group input-wlbl @if ($errors->has('commission_paid')) has-error @endif">
                                                                    <span class="">Comission Paid by Hospital</span>

                                                                    <div class="input-group">
                                                                        {!! Form::text('commission_paid',null,['class'=>'form-control txtinput-number  ']) !!}

                                                                        <span class="input-group-btn">
                      <button class="btn default" type="button">
                         NIS
                      </button>
                  </span>
                                                                    </div>


                                                                    @if ($errors->has('commission_paid'))
                                                                        <span class="help-block error">{{ $errors->first('commission_paid') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3 {{in_array($role,array_merge($spu,[10]))?'hidden':''}}">
                                                                <div class="form-group input-wlbl  @if ($errors->has('com_is_paid')) has-error @endif">
                                                                    <span class="">Commision is paied?</span>
                                                                    {!! Form::checkbox('com_is_paid')!!}

                                                                    @if ($errors->has('com_is_paid'))
                                                                        <span class="help-block error">{{ $errors->first('com_is_paid') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="clearfix">
                                                                <hr>
                                                            </div>

                                                            <div class="col-md-3 {{in_array($role,array_merge($spu,[10]))?'hidden':''}}">
                                                                <div class="form-group input-wlbl @if ($errors->has('commission_perc')) has-error @endif">
                                                                    <span class="">Comission Paid by Hospital</span>

                                                                    <div class="input-group">
                                                                        {!! Form::text('commission_perc',null,['class'=>'form-control commission_perc txtinput-number  ']) !!}

                                                                        <span class="input-group-btn">
                      <button class="btn default" type="button">
                         %
                      </button>
                  </span>
                                                                    </div>


                                                                    @if ($errors->has('amount'))
                                                                        <span class="help-block error">{{ $errors->first('amount') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            <div class="col-md-3 {{in_array($role,array_merge($spu,[10]))?'hidden':''}}">
                                                                <div class="form-group input-wlbl @if ($errors->has('amount')) has-error @endif">
                                                                    <span class=""> Amount of commission </span>

                                                                    <div class="input-group">
                                                                        {!! Form::text('amount',(isset($result->commission_perc)?(($result->commission_perc*$result->approved_cost/100)):0),['class'=>'form-control amount txtinput-number  ','readonly']) !!}

                                                                        <span class="input-group-btn">
                      <button class="btn default" type="button">
                         NIS
                      </button>
                  </span>
                                                                    </div>


                                                                    @if ($errors->has('amount'))
                                                                        <span class="help-block error">{{ $errors->first('amount') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>


                                                            <div class="col-md-3 {{in_array($role,array_merge($spu,[10]))?'hidden':''}}">
                                                                <div class="form-group input-wlbl  @if ($errors->has('finance_month')) has-error @endif">
                                                                    <span class="">Finance Month</span>

                                                                    {!! Form::select('finance_month',$invoice_month,null,['class'=>'form-control select2 txtinput-required txtinput']) !!}
                                                                    @if ($errors->has('invoice_month'))
                                                                        <span class="help-block error">{{ $errors->first('finance_month') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3 {{in_array($role,array_merge($spu,[10]))?'hidden':''}}">
                                                                <div class="form-group input-wlbl  @if ($errors->has('paid_finance_party')) has-error @endif">
                                                                    <span class="">Paid by Financial Party </span>
                                                                    {!! Form::checkbox('paid_finance_party')!!}

                                                                    @if ($errors->has('paid_finance_party'))
                                                                        <span class="help-block error">{{ $errors->first('paid_finance_party') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="clearfix">
                                                                <hr>
                                                            </div>
                                                            <div class="col-md-3 {{in_array($role,$spu)?'hidden':''}}">
                                                                <div class="form-group input-wlbl  @if ($errors->has('finance_year')) has-error @endif">
                                                                    <span class="">Finance Year</span>

                                                                    {!! Form::select('finance_year',$invoice_year,null,['class'=>'form-control select2 txtinput-required txtinput']) !!}
                                                                    @if ($errors->has('finance_year'))
                                                                        <span class="help-block error">{{ $errors->first('finance_year') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group input-wlbl  @if ($errors->has('invoice_no')) has-error @endif">
                                                                    <span class="">Invoice No </span>

                                                                    {!! Form::text('invoice_no',null,['class'=>'form-control']) !!}
                                                                    @if ($errors->has('invoice_no'))
                                                                        <span class="help-block error">{{ $errors->first('invoice_no') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group input-wlbl  @if ($errors->has('other_notes_invoice')) has-error @endif">
                                                                    <span class="">Comments -التعليقات</span>

                                                                    {!! Form::select('other_notes_invoice[]',$other_notes_invoice,isset($result->other_notes)?explode(",",$result->other_notes):null,['class'=>'form-control select2','multiple'=>'multiple','placehoder'=>'select Comments']) !!}
                                                                    @if ($errors->has('other_notes_invoice'))
                                                                        <span class="help-block error">{{ $errors->first('other_notes_invoice') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            <div class="col-md-12">
                                                                <div class="form-group input-wlbl  @if ($errors->has('notes')) has-error @endif">
                                                                    <span class="">Notes</span>
                                                                    {!! Form::text('admission_id',isset($admission->id)?$admission->id:Null,['class'=>'form-control hidden']) !!}
                                                                    {!! Form::textarea('notes',null,['class'=>'form-control']) !!}
                                                                    @if ($errors->has('notes'))
                                                                        <span class="help-block error">{{ $errors->first('notes') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>


                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    @endif

                                    <!--span-->
                                    </div>

                                    <!--row-->
                                </div>
                                <!--form body-->
                            </div>
                            <!-- END FORM-->
                        </div>
                        <!--portlet form-->
                    </div>
                    <!--portlet box-->

                </div>
                <!--tab pane-->
            </div>
            <!--tab content-->
        </div>
    </div>
</div>



