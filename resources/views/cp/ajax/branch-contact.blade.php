<div class="col-md-6 addcontact-info">
    <div class="addcontact-rg">
        <div class="row addcontact-data">
            <div class="col-md-6">
                <div class="form-group selectbs-wlbl">
                    <span class="lblselect">Contact Type</span>
                    <select class="bs-select select-contactbranch form-control select-required" name="branch[contact][type][]">
                        <option value="">Contact Type</option>
                        @foreach($contacts_type_info as $item)
                        <option data-myclass="{{ $item->SysLkp_HTMLID!="BRANCH_CONTACT_TYPE_SKYPE"?"txtinput-mobilenumber":"" }}" value="{{$item->lookup_language->LkpLang_SystemLookupID}}">{{$item->lookup_language->LkpLang_Text}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group input-wlbl">
                    <input type="text" name="branch[contact][value][]" class="form-control input-single" placeholder=""/>
                    <span class="help-block error txtmobilenumber"></span>
                </div>
            </div>
        </div>
        <span class="fa fa-close del-btn btn-delcontact"></span>
    </div>
</div>