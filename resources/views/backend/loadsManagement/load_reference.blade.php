<div class="modal-dialog modal-lg">
<div class="modal-content">

<!-- Modal Header -->
<div class="modal-header">
<h4 class="modal-title">Load Details</h4>
<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>

<!-- Modal body -->
<div class="modal-body">
<div class="container">
<div class="row">
<div class="col-md-12 row">
<?php if($load_reference){ ?>
    <div class="col-md-7 load_details">
        <div class="row">
            <div class="col-md-6">
                <div class="search_data">
                <label>Name:</label>
                <p>{{isset($Agent['name']) ? $Agent['name'] : null }}</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="search_data">
                <label>Email:</label>
                <p>{{isset($Agent['email']) ? $Agent['email'] : null }}</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="search_data">
                <label>Phone:</label>
                <p>{{isset($Agent['phone']) ? $Agent['phone'] : null }}</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="search_data">
                    <label>Extensions Number:</label>
                    <p>{{isset($Agent['ext']) ? $Agent['ext'] : null }}</p>
                </div>
            </div>
        </div>
    
    <div class="row load_extra">
        <div class="col-md-6">
            <div class="search_data">
                <label>Orgin:</label>
                <p>{{isset($load_reference->load_state_origin) ? $load_reference->load_state_origin : null }}</p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="search_data">
                <label>Drop:</label>
                <p>{{isset($load_reference->load_city_desti) ? $load_reference->load_city_desti : null }}</p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="search_data">
                <label>Equipment:</label>
                <p>{{isset($load_reference->equipments) ? $load_reference->equipments : null }}</p>
            </div>
        </div>
    <div class="col-md-6">
        <div class="search_data">
            <label>Full/Partial:</label>
            <p>{{isset($load_reference->full_partial_tl_ltl) ? $load_reference->full_partial_tl_ltl : null }}</p>
        </div>
    </div>
    <div class="col-md-6">
        <div class="search_data">
            <label>Length:</label>
            <p>{{isset($load_reference->length_load) ? $load_reference->length_load : null }}</p>
        </div>
    </div>
    <div class="col-md-6">
        <div class="search_data">
            <label>Weight:</label>
            <p>{{isset($load_reference->weight_load) ? $load_reference->weight_load : null }}</p>
        </div>
    </div>
   
    <div class="col-md-6">
        <div class="search_data">
            <label>Date:</label>
            <p>{{isset($load_reference->created_at) ? $load_reference->created_at : null }}</p>
        </div>
    </div>
    @php
                    $status = $load_reference->load_status;
                            $date_pick = explode('T', $load_reference->dat_pick_date);

                           // dd($date_pick);

                            $date_pick1 = strtotime($date_pick['0']);
                            $today = strtotime(date('Y-m-d'));

                           // dd($date_pick1);

                            //today // 1692729000
                            //date_pick1 = //1692297000 
                            $lstatus = '';
                            // 2022-11-18T10:29:20.000Z
                            
                            if ($today > $date_pick1) {
                                $lstatus = 'Expire';
                            } else {
                                if ($status == 1) {
                                    $lstatus = 'Delete';
                                } else {
                                    $lstatus = 'Active';
                                }
                            }
    @endphp         

    <div class="col-md-6">
        <div class="search_data">
            <label>Status:</label>
            <p>{{isset($lstatus) ? $lstatus : null }}</p>
        </div>
    </div>


    </div>
    </div>
    <div class="col-md-5">
    <div id="live-chat" class="load_comment">
            <div class="clearfix">
                <h4>Comments</h4>
                <span class="chat-message-counter">3</span>
            </div>
            <div class="chat">
                <div class="chat-history">
                    <div class="chat-message clearfix">
                        <div class="">
                            @if(isset($LoadComment))
                            
                                @foreach($LoadComment as $comments)
                                @php
                                $Agent = \App\Models\User::where('id', $comments['sender_id'])->first();
                                @endphp

                                    <div class="chat-message-content clearfix">
                                        <a href="#" class="chat-del">x</a>
                                            <p><span style="color: #346fe9; font-weight: bold;">{{isset($Agent['name']) ? $Agent['name'] : null }}: </span> {{isset($comments['message']) ? $comments['message'] : null}}</p>
                                            <span class="chat-time">02 Nov, 2022<span> 04:38:17am</span></span>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div> <!-- end chat-history -->
                        <div class="apchat-footer">
                            <input type="hidden" id="load_id" value="{{isset($load_reference->load_dat_id) ? $load_reference->load_dat_id : null }}">
                            <span class="error" id="loadCommentError"></span>
                            <textarea id="loadComment" placeholder="Enter Your Comment.."></textarea>
                            <button type="button" id="loadCommentBtn"><i class="bx bx-send"></i></button>
                        </div>
                </div> <!-- end chat -->
           </div>
    </div>
    
    </div>
    </div>
    <?php }else{ ?>
            <div class="col-md-12">
                <label>No Data Found!</label>
            </div>
        
        <?php } ?>
        </div>
     </div>
    </div>
        
    </div>
</div>