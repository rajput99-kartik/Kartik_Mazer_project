<style>
    li.nav-item a {
        margin-left: 0px !important;
    }
</style>
<ul class="nav nav-tabs user_tab" id="setting_nav">
  <li class="nav-item">
    <a class="nav-link" href="{{url('admin/setting/company-details')}}"><i class="fadeIn animated bx bx-info-circle"></i> Company Details</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{url('admin/setting/email')}}"><i class="fadeIn animated bx bx-envelope-open"></i> Email Setting</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{url('admin/setting/email-template')}}"><i class="fadeIn animated bx bx-edit"></i> Email Template</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{url('admin/setting/api')}}"><i class="fadeIn animated bx bx-code"></i> Manage Api</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{url('admin/setting/ip')}}"><i class="fadeIn animated bx bx-server"></i> Manage Ip</a>
  </li>
  <!--<li class="nav-item">-->
  <!--  <a class="nav-link" href="#"><i class="fadeIn animated bx bx-printer"></i> Invoice Settings</a>-->
  <!--</li>-->
  <!--<li class="nav-item">-->
  <!--  <a class="nav-link" href="#"><i class="bx bx-home-circle"></i> Dashboard Settings</a>-->
  <!--</li>-->
</ul>

<script>
    $(function(){

        var url = window.location.pathname, 
            urlRegExp = new RegExp(url.replace(/\/$/,'') + "$"); // create regexp to match current url pathname and remove trailing slash if present as it could collide with the link in navigation in case trailing slash wasn't present there
            // now grab every link from the navigation
            $('#setting_nav a').each(function(){
                // and test its normalized href against the url pathname regexp
                if(urlRegExp.test(this.href.replace(/\/$/,''))){
                    $(this).addClass('active');
                }
            });
    
    });
</script>