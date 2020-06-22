<div class="row">
    <div class="col-md-12">
        <div class="tabbable-line boxless tabbable-reversed">
            <div class="form-top tabbable-line clearfix">
                <div class="actions">
                    <button type="submit" data-toggle="confirmation" data-popout="true"
                            class="btn btn-circle btn-icon-only btn-default"
                            title="Save &amp; Close">
                        <i class="fa fa-save"></i>
                    </button>
                    <button name="save_new" data-toggle="confirmation" data-popout="true" type="submit"
                            class="btn btn-circle btn-icon-only btn-default btn-wnew "
                            title="Save &amp; New">
                        <i class="fa fa-save"></i>
                        <span class="fa fa-plus"></span>
                    </button>
                    <a href="{{ config('app.cp_route_name') }}/revenue"
                       class="btn btn-circle btn-icon-only btn-default tooltip-one-info" title="Cancel">
                        <i class="fa fa-remove"></i>
                    </a>
                    <a href="javascript:;"
                       class="btn btn-circle btn-icon-only btn-default tooltip-one-info print" title="print">
                        <i class="fa fa-print"></i>
                    </a>
                </div>
            </div>
            <div class="tab-content tabcontent-noborder">
                <div class="tab-pane active">
                    <div class="portlet box blue">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-globe"></i>revenue
                            </div>
                        </div>
                        <div class="portlet-body collapse-body form">
                            <!-- BEGIN FORM-->
                            <div class="horizontal-form">
                                <div class="form-body">
                                    <div class="row">
                                
                                        <div class="revenueInfo ">


                                            <div class="col-md-12">
                                                <div class="portlet box green ">
                                                    <div class="portlet-title">
                                                        <div class="caption">
                                                            Revenue Information
                                                        </div>
                                                        <div class="tools">
                                                            <a href="javascript:;" class="collapse"> </a>
                                                        </div>
                                                    </div>

                                                    <div class="portlet-body collapse-body padding-15-all">

                                                        <div class="row">

                                                            <div class="col-md-3 ">
                                                                <div class="form-group input-wlbl @if ($errors->has('revenue_date')) has-error @endif">
                                                                    <span class="">Revenue Date</span>

                                                                    <div class="input-group input-medium  date date-picker"
                                                                         data-date-format="yyyy-mm-dd"
                                                                         data-date-viewmode="years">
                                                                        {!! Form::text('revenue_date',isset($result->issue_date)? date('Y-m-d', strtotime($result->revenue_date)):Null,['class'=>'form-control']) !!}
                                                                        <span class="input-group-btn">
                                                                <button class="btn default" type="button">
                                                                    <i class="fa fa-calendar"></i>
                                                                </button>
                                                            </span>
                                                                    </div>
                                                                    @if ($errors->has('revenue_date'))
                                                                        <span class="help-block error">{{ $errors->first('revenue_date') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group input-wlbl  @if ($errors->has('status')) has-error @endif">
                                                                    <span class=""> Status</span>
                                                                    {!! Form::select('status',$status,null,['class'=>'form-control  txtinput']) !!}
                                                                    @if ($errors->has('status'))
                                                                        <span class="help-block error">{{ $errors->first('status') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>


                                                            <div class="col-md-3">
                                                                <div class="form-group input-wlbl  @if ($errors->has('type')) has-error @endif">
                                                                    <span class=""> Type</span>
                                                                    {!! Form::select('type',$types,null,['class'=>'form-control  txtinput']) !!}
                                                                    @if ($errors->has('type'))
                                                                        <span class="help-block error">{{ $errors->first('type') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>


                                                            <div class="col-md-3">
                                                                <div class="form-group input-wlbl  @if ($errors->has('month')) has-error @endif">
                                                                    <span class=""> Month</span>
                                                                    {!! Form::select('month',$month,null,['class'=>'form-control  txtinput']) !!}
                                                                    @if ($errors->has('month'))
                                                                        <span class="help-block error">{{ $errors->first('month') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group input-wlbl  @if ($errors->has('year')) has-error @endif">
                                                                    <span class=""> Year</span>
                                                                    {!! Form::select('year',$year,null,['class'=>'form-control  txtinput']) !!}
                                                                    @if ($errors->has('year'))
                                                                        <span class="help-block error">{{ $errors->first('year') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>


                                                            <div class="col-md-3">
                                                                <div class="form-group input-wlbl @if ($errors->has('amount')) has-error @endif">
                                                                    <span class="">Amount</span>

                                                                    <div class="input-group">
                                                                        {!! Form::text('amount',null,['class'=>'form-control txtinput-number  ']) !!}

                                                                        <span class="input-group-btn btn-right">

                                                                         {!! Form::select('currency',$currences,null,['class'=>'btn green  dropdown-toggle']) !!}
                                                                        </span>
                                                                    </div>


                                                                    @if ($errors->has('Amount'))
                                                                        <span class="help-block error">{{ $errors->first('Amount') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="clearfix"></div>


                                                            <div class="col-md-12">
                                                                <div class="form-group input-wlbl  @if ($errors->has('notes')) has-error @endif">
                                                                    <span class="">Notes</span>

                                                                    {!! Form::textarea('notes',null,['class'=>'form-control']) !!}
                                                                    @if ($errors->has('notes'))
                                                                        <span class="help-block error">{{ $errors->first('notes') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>


                                                            <!-- END FORM-->
                                                        </div>
                                                        <!--portlet form-->
                                                    </div>
                                                    <!--portlet box-->
                                                </div>
                                                <!-- col md 4 -->

                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>


                <!--span-->
            </div>

            <!--span-->
        </div>
        <!--row-->
    </div>
    <!--form body-->
</div>
<!-- END FORM-->




    