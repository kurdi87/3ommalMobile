<table class="table table-striped table-bordered table-hover  order-column" id="">
    <thead>
    <tr>
        <th>ID</th>
        <th>Action</th>

        <th>Employee</th>
        <th>Date</th>

    </tr>
    </thead>
    <tbody>
@php $count=1 @endphp
    @foreach($lead_process as $e)
       <tr>
           <td>{{$count++}}</td>
           <td>{{\App\Models\LeadActionModel::getActionDesc($e->action_id)}}</td>
           <td>{{\App\Models\SystemUserModel::getUserFullName($e->action_emp)}}</td>
           <td>{{ date('Y-m-d H:i:s', strtotime($e->create_date))}}</td>

       </tr>
    @endforeach
    </tbody>
</table>