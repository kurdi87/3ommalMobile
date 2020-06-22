<div class="portlet box green">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-key"></i>الخدمات
        </div>
        <div class="tools">
            
        </div>
    </div>
    <div class="portlet-body form">
        <!-- BEGIN FORM-->
        <div class="horizontal-form">
            <div class="form-body">
                <div class="row services-row {{ isset($services)?"service":"" }}">
                    @foreach($services as $service)
                        <div class="col-md-2">
                            <div class="portlet box box-services green servshow">
                                <div class="portlet-title">
                                    <div class="caption caption-wcheckbox ">
                                       
                                        <label class="checkbox-inline parent-check ">
@if (isset($invoice_items))
@foreach($invoice_items as $item)
@if($item->serv_id==$service->serv_id)
<?php $itemcost=$item->cost;
$itemnote=$item->notes; ?>
@endif
@endforeach
                                         {!!
                                        
 Form::checkbox('exserv[]',$service->serv_id,(!$errors->has() && in_array($service->serv_id,$invoice_items->lists('serv_id')->toArray()))?true:null, array('class'=>'mycheckbox addserv ccheckbox',"data-parent"=>"parent".$service->serv_id)) !!}
 @else{!!
 Form::checkbox('exserv[]',$service->serv_id,null, array('class'=>'mycheckbox addserv ccheckbox',"data-parent"=>"parent".$service->serv_id)) !!}
 @endif

                                              
                                          
                                            <i class="fa fa fa-thumb-tack" ></i><span class="label-checkbox">{{ $service->serv_name }}</span>
                                        </label>
                                    </div>
                                    <div class="tools">
                                        <a href="javascript:;" class="collapse mycollapse"></a>
                                    </div>
                                </div>
                                <div class="portlet-body collapse-body form">
                                
                                             

                                                <div class="input-group service" >

                                            @if (isset($invoice_items))
                                                    {!!Form::text('cost'.$service->serv_id,(!$errors->has() && in_array($service->serv_id,$invoice_items->lists('serv_id')->toArray()))?$itemcost:$service->serv_cost,['class'=>'form-control cost  ','id'=>'cost'])!!}
 @else
 {!! Form::text('cost'.$service->serv_id,$service->serv_cost,['class'=>'form-control cost  ','id'=>'cost'])    !!}
 @endif </div> <div class="input-group service" > <span class="lblinput">ملاحظات</span>
                                               
                                                                    @if (isset($invoice_items))
                                                    {!!Form::textArea('note'.$service->serv_id,(!$errors->has() && in_array($service->serv_id,$invoice_items->lists('serv_id')->toArray()))?$itemnote:null,['class'=>'form-control   ','id'=>'cost'])!!}
 @else
 {!! Form::textArea('note'.$service->serv_id,null,['class'=>'form-control   ','id'=>'cost'])    !!}
 @endif
            
                                                </div>
                                          


                               </div>
                                <!--portlet form-->
                            </div>
                            <!--portlet box-->
                        </div>
                        <!-- col md 4 -->
                    @endforeach
                </div>
            </div>
            <!--form body-->
        </div>
        <!-- END FORM-->
    </div>
    <!--portlet form-->
</div>