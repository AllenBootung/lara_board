@extends('template')
@section('content')
<style type="text/css">
  textarea.AutoHeight {
      -moz-appearance: textfield-multiline;
      -webkit-appearance: textarea;
      border: 1px solid gray;

      height: 300px;
      max-height: 300px;
      overflow: auto;
      padding: 2px;
      resize: both;

  }
  .panel-body {
    min-height: 40px;
  }
</style>
<form method="post">
  {{ csrf_field() }}
  <div id="wrapper">

    
    <div id="page-wrapper" class="custom-page-wrapper col-md-12">
        @if ( isset($msg))
          msg
        @endif
        <div class="row">                    
            @foreach($results as $result)
              <div class="panel panel-primary">
                <input type="hidden" id="REPLY_NO" name="REPLY_NO" value="{{$result->REPLY_NO}}">
                <div class="panel-heading">
                    <input type="button" class="btn btn-success btn-xs btn_edit" value="編">
                    <input type="button" class="btn btn-danger btn-xs btn_del" value="刪">
                    {{ $result->created_at}}
                </div>
                
                <div class="panel-body" id="REPLY_MESSAGE">{!! nl2br(e($result->REPLY_MESSAGE)) !!}</div>
                
              </div>
            @endforeach                                         
        </div>
        {{ $results->links() }}

        @if ( isset($add_title) )
          <input type="text" class="form-control mustfill" name="MSG_TITLE">
        @endif
        
        <section class="row" id="reply_area" style="margin-top:10px;">
            <div class="panel panel-primary">
              <div class="panel-heading">
                <textarea class="form-control mustfill" rows="11" name="REPLY_MESSAGE" wrap="hard"></textarea>
              </div>
            </div><!-- /.panel -->
            <input type="submit" name ="SAVE_ADD" class="btn btn-warning " value="增" onclick="return all_check();"/>
        </section>
    
    </div>
  </div>
</form>

<script type="text/javascript">
  $(".btn_edit").click(function(){
    $("#wrapper").find("input").attr("disabled","true");
    $(this).parent().siblings("#REPLY_NO").removeAttr("disabled");
    $("#reply_area").remove();

    var reply_msg = $(this).parent().siblings("#REPLY_MESSAGE").html().replace(/<br>/g, "");
    
    $(this).parent().siblings("#REPLY_MESSAGE").html(
      '<textarea class="form-control mustfill AutoHeight" name="REPLY_MESSAGE">'+
        reply_msg +
      '</textarea>'
    );

    $(this).parent().html(
      '<input type="submit" class="btn btn-danger btn-xs" name="SAVE_EDIT" value="存" onclick="return all_check();"/>'+
      '<input type="button" class="btn btn-default btn-xs" value="消" onclick="window.location.href = window.location.pathname + window.location.search;"/>'
    );


  });

  function all_check()
  {
      all_fill = true;
      $(".mustfill").each(function(){
        if (!$(this).val()){
          all_fill = false;
          $(this).addClass("not_fill");
          
        } else {
          $(this).removeClass("not_fill");
        }
      });
      
      return all_fill;
      
  }//function all_check()
</script>
<script type="text/javascript">
  $(".btn_del").click(function(){
      $("#wrapper").find("input").attr("disabled","true");
      $(this).parent().siblings("#REPLY_NO").removeAttr("disabled");

      $(this).parent().html(
        '<input type="button" class="btn btn-default btn-xs" value="消" onclick="window.location.href = window.location.pathname + window.location.search;"/>'+
        '<input type="submit" class="btn btn-danger btn-xs" id="btn_delee_submit" name="DEL_LIST" value="是"/>'
      );
      
    });//$("#btn_delete").click(function()
</script>
<script type="text/javascript">
  jQuery(function($) {  
       $("textarea.AutoHeight").css("overflow","auto").bind("keydown keyup", function(){  
           $(this).height('0px').height($(this).prop("scrollHeight")+"px");  
       }).keydown();  
  });  
</script>
@stop