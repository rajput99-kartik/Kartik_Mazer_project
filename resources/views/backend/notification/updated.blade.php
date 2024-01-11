@foreach ($notification_data as $notify_data )

										        <?php 

										             $ul = $notify_data->url;

        										    if(!empty($ul)){

										        ?>

										        <div class=""> <h6 class="msg-name"><i class="bx bx-group"></i> <a href="{{ $notify_data->url }}"><span class="msg-time float-end">{{ $notify_data->title }}</a></span></h6> <span id="notificationsRead" value="{{ $notify_data->id }}"><i class="bx bx-message"></i></span></div>

        									    <?php }else {?>

        										<a href="{{ url('admin/notification').'/'.$ul}}"> <h6 <i class="bx bx-group"></i><span class="msg-time float-end">{{ $notify_data->title }}</span></h6></a>

										        <?php }?>

										@endforeach