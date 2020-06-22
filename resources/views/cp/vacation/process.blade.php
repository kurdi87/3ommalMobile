<table class="table table-striped table-bordered table-hover  order-column" id="">
    <thead>
    <tr>
        <th>ID -رقم</th>
        <th>Action - الحركة</th>

        <th>Employee - الموظف</th>
        <th>Date - التاريخ</th>

        <th>Note - ملاحظات</th>
    </tr>
    </thead>
    <tbody>
@php $count=1 @endphp
    @foreach($vacation_process as $e)
       <tr>
           <td>{{$count++}}</td>
           <td>{{\App\Models\AdmissionActionModel::getActionDesc($e->action_id)}}</td>
           <td>{{\App\Models\SystemUserModel::getUserFullName($e->action_emp)}}</td>
           <td>{{ date('Y-m-d H:i:s', strtotime($e->create_date))}}</td>

           <td>{{ $e->notes}}</td>
       </tr>
    @endforeach
    </tbody>
</table>