<div class="panel" id="edit">
    <div class="panel-heading"><i class="fa fa-edit"></i></div>
        <div class="panel-body" style="padding: 10px">
            <form action="{{url('xf/modify',$id)}}" method="POST">
                <input type="hidden" name="_method" value="PUT">
                    {{csrf_field()}}
                        <div class="form-group">
                          <textarea class="form-control textarea" name="">
                            {!!$body!!}
                          </textarea>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" name="submit" value="Submit">
                            <button type="button" class="btn btn-danger" id="close_edit">Cancel</button>
                        </div>
            </form>
        </div>
 </div>

<script type="text/javascript" src="{{asset('js/jquery-2.2.3.js')}}"></script> 
<script type="text/javascript">
    $(document).ready(function() {
  $('.textarea').summernote();
}); 
    //close the form when the cancel button is clicked
$('#close_edit').on('click', function(){
  $(this).closest('#edit').hide();
});
</script>
<script type="text/javascript" src="{{asset('js/summernote-lite.min.js')}}"></script> 