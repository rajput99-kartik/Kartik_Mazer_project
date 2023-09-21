<div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Carrier Request</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <div id="live-chat" class="load_comment">
            <header class="clearfix status">
              <h4>
                  <p><b>MC Number:</b><span>{{$carrier['mc_no']}}</span></p>
                  <p><b>DOT Number:</b><span>{{$carrier['dot_no']}}</span></p>
                  <p><b>Status:</b><span>
                      <td class="switch-btn">
<?php

if($carrierData['status'] == '0'){
$checked = 'checked';
} else{
$checked = '';
}

$status_content = '<input type="checkbox"  class="stat_check" '.$checked.' data-toggle="toggle" >';
?>



							{!! $status_content !!}
							<span class="switch"></span>
                            <span class="toltip">Carrier Request Sent(Green)</span>
						</td>
                  </span></p>
              </h4>
            </header>
            <div class="clearfix">
                <h4>Comments</h4>
                <span class="chat-message-counter">3</span>
            </div>
            <div class="chat">
                <div class="chat-history">
                        <div class="chat-message clearfix">
                                    <div class="">
                                        @if(isset($requestform))
                                        
                                        @foreach($requestform as $comments)
                                        @php
                                        $agent = App\Models\User::where('id',$comments['sender_id'])->first();
                                        @endphp
                                        <div class="chat-message-content clearfix">
                                            <a href="#" class="chat-del">x</a>
                                            <p><span style="color: #346fe9; font-weight: bold;">{{$agent['name']}}: </span> {{$comments['comment']}}</p>
                                            <span class="chat-time">02 Nov, 2022<span> 04:38:17am</span>
                                            </span>
                                        </div>
                                        @endforeach
                                        @endif
                                    </div>
                        
                        </div> <!-- end chat-history -->
                    <div class="apchat-footer">
                        <input type="hidden" id="load_id" value="{{$carrier['id']}}">
                        <span class="error" id="carrierRequestError"></span>
                        <textarea id="requestComment" placeholder="Enter Your Comment.."></textarea>
                        <button type="button" id="requestCommentBtn"><i class="bx bx-send"></i></button>
                    </div>
                </div> <!-- end chat -->
            </div>
        </div>
      

    </div>
  </div>



<!-- <script>
    $(function() {
        $(document).on('change','#loadCommentBtn', function() {
            var curr    = $(this).prop('checked');
            var cat     = $(this).attr('cat');
            console.log(curr);
            console.log(cat);
            return false;
            // $.ajax({
            //     type:"post",
            //     url:"{{ url('admin/carrier/StatusUpdate') }}",
            //     data: {'curr': curr, 'cat':cat},
            //     success:function(resp){
            //         if(resp.status == 'true'){
            //             swal(resp.msg,'','success');
            //         } else{
            //             swal(resp.msg,'','warning');
            //         }
            //     }
            // })
        })
    })
</script> -->