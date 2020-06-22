<div class="box-item portlet box green-sharp">
    <input class="sub-item" type="hidden" name="PkgTrip_ID[{{ $PkgTrip_ID }}]" value="{{ $PkgTrip_ID }}">

    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-info-circle"></i>Flight Trip
        </div>
        <div class="tools">
            <a href="javascript:;" class="collapse"></a>
            <a href="javascript:;" class="del-item" data-toggle="tooltip" data-placement="top" title="Remove"><i class="fa fa-close"></i></a>
        </div>
    </div>
    <div class="portlet-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group select2-wlbl">
                    <span class="lblselect">Departure Airport</span>
                    <select name="PkgTrip_DepartureAirport[{{ $PkgTrip_ID}}]" class="form-control select2wlabel airports @if ($errors->has('PkgTrip_DepartureAirport['. $PkgTrip_ID.']')) has-error @endif" data-placeholder="">
                        <option></option>
                        @if(isset($tripDetails) && $tripDetails->PkgTrip_DepartureAirport)
                            <option selected="selected" value="{{ $tripDetails->PkgTrip_DepartureAirport }}">{{ $tripDetails->departureAirport->Airport_Name }}</option>
                        @endif
                    </select>
                    @if ($errors->has('PkgTrip_DepartureAirport['. $PkgTrip_ID.']'))
                        <span class="help-block error">{{ $errors->first('PkgTrip_DepartureAirport['. $PkgTrip_ID.']') }}</span>
                    @endif
                </div>
            </div>
            <!-- col md 6 -->
            <div class="col-md-6">
                <div class="form-group select2-wlbl">
                    <span class="lblselect">Arrival Airport</span>
                    <select name="PkgTrip_ArrivalAirport[{{ $PkgTrip_ID}}]" class="form-control select2wlabel airports @if ($errors->has('PkgTrip_ArrivalAirport['. $PkgTrip_ID.']')) has-error @endif" data-placeholder="">
                        <option></option>
                        @if(isset($tripDetails) && $tripDetails->PkgTrip_ArrivalAirport)
                            <option selected="selected" value="{{ $tripDetails->PkgTrip_ArrivalAirport }}">{{ $tripDetails->arrivalAirport->Airport_Name }}</option>
                        @endif
                    </select>
                    @if ($errors->has('PkgTrip_ArrivalAirport['. $PkgTrip_ID.']'))
                        <span class="help-block error">{{ $errors->first('PkgTrip_ArrivalAirport['. $PkgTrip_ID.']') }}</span>
                    @endif
                </div>
            </div>
            <!-- col md 6 -->
        </div>
        <!--row-->
        <div class="row">
            <div class="col-md-6">
                <div class="form-group select2-wlbl">
                    <span class="lblselect">Airlines</span>
                    <select name="PkgTrip_SelectedAirline[{{ $PkgTrip_ID}}]" class="form-control select2wlabel airlines @if ($errors->has('PkgTrip_SelectedAirline['. $PkgTrip_ID.']')) has-error @endif" data-placeholder="">
                        <option></option>
                        @if(isset($tripDetails) && $tripDetails->PkgTrip_SelectedAirline)
                            <option selected="selected" value="{{ $tripDetails->PkgTrip_SelectedAirline }}">{{ $tripDetails->airline->Airline_Name }}</option>
                        @endif
                    </select>
                    @if ($errors->has('PkgTrip_SelectedAirline['. $PkgTrip_ID.']'))
                        <span class="help-block error">{{ $errors->first('PkgTrip_SelectedAirline['. $PkgTrip_ID.']') }}</span>
                    @endif
                </div>
            </div>
            <!-- col md 6 -->
            <div class="col-md-6">
                <div class="form-group select2-wlbl">
                    @if(!(isset($tripDetails) && $tripDetails->PkgTrip_Class))
                        <span class="lblselect">Class</span>
                    @endif
                    <select name="PkgTrip_Class[{{ $PkgTrip_ID}}]" class="form-control select2 @if ($errors->has('PkgTrip_Class['. $PkgTrip_ID.']')) has-error @endif" data-placeholder="">
                        <option></option>
                        @foreach($classes as $class)
                            <option @if(isset($tripDetails) && $tripDetails->PkgTrip_Class==$class->SysLkp_ID) selected="selected" @endif data-tripType="{{ $class->SysLkp_HTMLID }}" value="{{ $class->SysLkp_ID }}">{{ $class->language[0]->LkpLang_Text }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('PkgTrip_Class['. $PkgTrip_ID.']'))
                        <span class="help-block error">{{ $errors->first('PkgTrip_Class['. $PkgTrip_ID.']') }}</span>
                    @endif
                </div>
            </div>
            <!-- col md 6 -->
        </div>
        <!--row-->
        <div class="row">
            <div class="col-md-6">
                <div class="form-group input-wlbl">
                    <span class="lblinput">Departure</span>

                    <div class="input-group">
                        <input readonly="" value="{{ isset($tripDetails) && strtotime($tripDetails->PkgTrip_DepartureDate)>0?date_format(date_create($tripDetails->PkgTrip_DepartureDate), 'Y-m-d'):""}}" data-date-format="yyyy-mm-dd" name="PkgTrip_DepartureDate[{{ $PkgTrip_ID}}]" type="text" readonly=""
                               class="form-control date-picker @if ($errors->has('PkgTrip_DepartureDate['. $PkgTrip_ID.']')) has-error @endif"/>
                        @if ($errors->has('PkgTrip_DepartureDate['. $PkgTrip_ID.']'))
                            <span class="help-block error">{{ $errors->first('PkgTrip_DepartureDate['. $PkgTrip_ID.']') }}</span>
                        @endif
                        <span class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <!--row-->
    </div>
    <!-- portlet body -->
</div>