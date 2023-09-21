<div class="modal-dialog modal-md">
		<div class="modal-content">
		<div class="modal-header" style="justify-content: center;padding: 10px;">
			<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
		</div>
		
		<!-- Modal body -->
				<div class="modal-body">
						<div class="container">
						<form action="javascript:void(0)" id="ar_comment" method="post" enctype="multipart/form-data" novalidate="novalidate">
							@csrf		
							<div id="live-chat">
								<header class="clearfix">
									<h4>AR Chat List</h4>
									<span class="chat-message-counter">3</span>
								</header>
								<div class="chat">
									<div class="chat-history">
										<div class="chat-message clearfix">
                                        @foreach ($ardata as $item)

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
                                        </div> <!-- end chat-history -->
										<div class="apchat-footer">
											<input type="hidden" id="user_id"  value="{{$userid}}">
											<input type="hidden" id="shipmentid_loadid" value="{{$carrier_id}}">
											<input type="text" id="description" placeholder="Enter Your Comment..">
											<button type="submit" id="ArCommentSubmit"><i class="bx bx-send"></i></button>
										</div>
									</div> <!-- end chat -->
								</div>
								</form>
							</div>
						</div>
				</div>
    </div>
</div>
			<!--end comment popup-->  