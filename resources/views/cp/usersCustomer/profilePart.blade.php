<div class="profile-sidebar">
    <div class="portlet light profile-sidebar-portlet ">
        <div class="profile-userpic">
            <div class="upload-avatar-img" style="{{ $user->SysUsr_ThumbImage?"background-image:url(uploads/usersCustomer/".$user->SysUsr_ThumbImage.")":""}}">
                <span class="glyphicon glyphicon-cloud-upload"></span>
                <input type="file" class="avatar-file upload-profile-img" accept="image/*" />
            </div>
        </div>

        <div class="profile-usertitle">
            <div class="profile-usertitle-name"> {{ $user->SysUsr_FullName }} </div>
            <!--div class="profile-usertitle-job"> {{ $user->roles && isset($user->roles[0])?$user->roles[0]->Role_Name:"-----" }} </div-->
        </div>

        <div class="profile-usermenu">
            <ul class="nav">
                <!--li class="{{ isset($activeProfileTab)?"active":"" }}">
                    <a href="{{ config('app.cp_route_name') }}/profile/overview">
                        <i class="icon-home"></i> ملفي الشخصي
                    </a>
                </li-->
                <li class="{{ isset($activeProfileTab)?"":"active" }}">
                    <a href="{{ config('app.cp_route_name') }}/profile/edit">
                        <i class="icon-settings"></i> Account Information
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>