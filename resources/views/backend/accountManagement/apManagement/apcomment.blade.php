

    <div class="container">
            <form id="ap_comment" action="{{ url('admin/apcomment/add/') }}">						
              <div id="live-chat">
                <header class="clearfix">
                  <h4>Ap Chat List</h4>
                  <span class="chat-message-counter">3</span>
                </header>
                <div class="chat">
                  <div class="chat-history">
                    <div class="chat-message clearfix">
                        @foreach ($apdata as $item)
                        @php
                          $user = DB::table('users')->where('id', $item->current_user_id)->first();
                          $userid = Auth::id();
                        @endphp
                        <?php if($userid==$item->current_user_id){ 
                        ?>
                        <div class="chat-right">
                            <div class="chat-message-content clearfix">
                                <a href="#" class="chat-del">x</a>
                                <p><span style="color: #346fe9; font-weight: bold;">You: </span> {{$item->description}}</p>
                              <span class="chat-time">
                                {{date('d M, Y', strtotime($item->created_at))}}
                                <span> {{ date('h:i:sa', strtotime($item->created_at))}}</span>
                              </span>
                            </div>
                            </div>
                            <?php
                        }else{
                            ?>
                            <div class="chat-message-content clearfix">
                                <a href="#" class="chat-del">x</a>
                                <p><span style="color: #346fe9; font-weight: bold;">{{$user->name}}: </span> {{$item->description}}</p>
                              <span class="chat-time">
                                {{date('d M, Y', strtotime($item->created_at))}}
                                <span> {{ date('h:i:sa', strtotime($item->created_at))}}</span>
                              </span>
                            </div>
                            <?php
                        }?>
                        @endforeach

                        {{-- <div class="chat-message-content clearfix">
                          <a href="#" class="chat-del">x</a>
                          <p></p>
                            <span class="chat-time">
                              17/03/2022
                              <span>13:37</span>
                            </span>
                          </div> --}}
                              
                            </div> <!-- end chat-history -->
                            <div class="apchat-footer">
                                <input type="hidden" id="ap_agentid"  value="@foreach($apdata as $udata)
                                    {{$udata->ap_agentid}}
                                    @endforeach">
                                <input type="hidden" id="shipmentid_loadid" value="{{$carrier_id}}">
                                <input type="text" id="description" placeholder="Enter Your Comment..">
                                <button type="submit"><i class="bx bx-send"></i></button>
                            </div>
                          </div> <!-- end chat -->
                        </div>
                      </form>
                    </div>
                  </div>
            <!--end comment popup-->  
        <script>
            
            $(document).ready(function(){
                $('form#ap_comment').on('submit',function(e){
                    e.preventDefault();
                    let form_action = $('form#ap_comment').attr('action');
                    let ap_agentid = $('#ap_agentid').val();
                    let shipmentid_loadid = $('#shipmentid_loadid').val();
                    let description = $('#description').val();
                    
                    $.ajax({
                      url: form_action,
                      type:"POST",
                      data:{
                        "_token": "{{ csrf_token() }}",
                        ap_agentid:ap_agentid,
                        shipmentid_loadid:shipmentid_loadid,
                        description:description,
                      },
                      success:function(response){
                    	//ShowLoaderTimeLine();
                    		$.ajax({
                    			url: "{{url('/admin/apcomment/fetchcommentdata')}}",
                    			type: 'get',
                    			cache : false,
                    			data: {carrier_id:shipmentid_loadid},
                    			success: function(data){
                    				$('#Apcomment').html(data);
                    			}
                    		});
                      }
                      });
                      
                      var carrier_id = $(".show input#shipmentid_loadid").val();
                        setTimeout(function(){
                        $.ajax({
                    		url: HOSTPATH+'admin/apcomment/fetchcommentdata',
                    		type: 'get',
                    		cache : false,
                    		data: {carrier_id:carrier_id},
                    		success: function(data){
                    		    var htmldata = $(data).find(".chat-message").html();
			                    $(".show .chat-message").html(htmldata);
			                    $("input#description").val('');
                    		}
                    	});
                        }, 200)
                });
            })
        </script>