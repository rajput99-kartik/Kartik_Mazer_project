<style>
    .modal-backdrop {
    display: none !important;
}
.modal {
    box-shadow: inset 0px 0px 0px 1000px #0006;
}
</style>
<div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header" style="justify-content: center;padding: 10px;">
        <h4 class="modal-title">Document Upload</h4>
        <button type="button" class="btn-close apuploaded" data-bs-dismiss="modal"></button>
      </div>
      
      <!-- Modal body -->
      <div class="modal-body">
        <div class="container">
            
            <div class="chat-message-content clearfix row">
              <?php $image = ADMIN_DOC_PATH; ?>
              <?php  
                foreach ($apdata as  $item) {
                # code...
              $i = 1; foreach (( explode(',' ,$item->document_name))as $picture) {?>
                <div class="col-md-2">
                    <a href="{{ asset('public/backend/shipment_doc'.'/'.$picture)}}" download="{{ asset('public/backend/shipment_doc'.$picture)}}" target="_blank"> <br>
                    <img src="{{$image}}" style="height:50px; width:50px" downloads>  <i class="fa fa-download" aria-hidden="true"></i>
                  </a>
                </div>
                
                <?php  }} ?>
            </div>
        
        
          <form action="{{url('admin/apcomment/documentupload/')}}" id="new_ap_doc" method="post" enctype="multipart/form-data" novalidate="novalidate">
            @csrf						
            <div class="form-group shipment-more search_input">
              <label class="select-docu">
                <span>Select Document</span>
                <i class="bx bx-upload"></i>
                <input type="file" class="form-control" name="image_path[]" id="image_path" for="lane_origin">
                <span class="docname"></span>
              </label>
              <input type="hidden" name="shipmentid"  value="{{$carrier_id}}">
            </div>
            <div class="card-footer">
              <button type="submit" class="btn btn-primary" id="load_post_btn" >Upload Document</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  
  <script>
      
      $(document).ready(function(){
          $("button.btn-close.apuploaded").click(function(){
            $('#Apupload').hide();
           // $(".modal-backdrop").remove();
        })
        
        $("button.apshipupload_fetch").click(function(){
            $('#Apupload').show();
           // $(".modal-backdrop").remove();
        })
        
        $('input#image_path').change(function(e){
            var docname = e.target.files[0].name;
            $("span.docname").text(docname);
        })
            
      })
  </script>