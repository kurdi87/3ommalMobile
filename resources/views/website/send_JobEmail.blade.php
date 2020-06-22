Hello ,
<br>
This to  inform you that an job application request  has been created to you
<br>
<ul style="list-style: unset">
    <li>email:{{$user->SysUsr_Email}}</li>
    <li>name:{{$user->SysUsr_FullName}}</li>
    <li>mobile:{{$user->SysUsr_Mobile}}</li>
    <li>Application:{{json_encode($jobApplication,JSON_UNESCAPED_UNICODE)}}</li>


</ul>
<br>
To Manage <a href="http://api.3ommal.me/crm/jobApplication/edit/{{$jobApplication->id}}" target="_blank">Click Here</a>
Good Day..
