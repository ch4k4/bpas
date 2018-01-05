<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
    
?>
<script type="text/javascript">	
    var hn = window.location.protocol + "//" + window.location.host + window.location.pathname + "/";
    //alert(hn);
    var vPageNumber = 1;
    function key_data() {
        $('a#btnSimpan').show();
        var msg = $('#search').val();        
        $.post(hn + 'search_data', {descp_msg:msg, pageNumber:vPageNumber}, function (data) {
            $("#content_data").html(data);
            $('#pp').pagination({
                pageNumber:vPageNumber,
                total:$('#recNum').val(),                
                pageList:[10],
				showPageList:false
            });
        });
    }

    $(document).ready(function () {
        key_data();
    });

    $(function () {

        $('#pp').pagination({
            total:$('#recNum').val(),
            pageList:[10],
            showPageList:true,
            onSelectPage:function (pageNumber, pageSize) {
                $('#pp').pagination({loading:true});
                var msg = $('#search').val();
                
                $.post(hn + 'search_data/ #content_data', {descp_msg:msg, pageNumber:pageNumber}, function (data) {
                    $("#content_data").html(data);
                    vPageNumber=pageNumber;
                });
                $('#pp').pagination({loading:false});
            }
        });
    });
	
	//  for select / deselect all

	$('document').ready(function()
	{
		$(".select-all").click(function ()
		{
			$('.chk-box').attr('checked', this.checked)
		});
        
		$(".chk-box").click(function()
		{
			if($(".chk-box").length == $(".chk-box:checked").length)
			{
				$(".select-all").attr("checked", "checked");
			}
			else
			{
				$(".select-all").removeAttr("checked");
			}
		});
	});
</script>

<div class="sample">
	<form action="http://localhost/bpas2/approval/data_exec" id="formdata" class="form" method="post">
	<?php
	/*
		$attributes = array('id' => 'formdata', 'class' => 'form');
		echo form_open('', $attributes);
	*/
	?>
    <div style="width: 100%;">
        <div style="float: right;">
			<button type="submit">Proses</button>
		</div>
    </div>
    <div style="clear: both;"></div>
    <div id="Alert"></div>
    <div id="content_data" class="table table-striped table-hover"></div>
	<div style="width: 100%;">
        <div style="float: right;">            
            <button type="submit">Proses</button>
        </div>
    </div>
    <div id="pp"></div>
	<?php echo form_close(); ?>
</div>