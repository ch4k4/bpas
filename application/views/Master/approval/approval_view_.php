<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
    
?>
<script type="text/javascript">	
    var hn = window.location.protocol + "//" + window.location.host + window.location.pathname + "/";    
    var vPageNumber = 1;
    function key_data() {
        $('a#btnSimpan').show();
        $('a#btnBatal').show();        
        var msg = $('#search').val();        
        $.post(hn + 'search_data', {descp_msg:msg, pageNumber:vPageNumber}, function (data) {
            $("#content_data").html(data);
            $('#pp').pagination({
                pageNumber:vPageNumber,
                total:$('#recNum').val(),
                //tentukan banyak rec yg mau ditampilkan disini
                pageList:[10],
                //sembunyikan pagelist pagintion easyui
                showPageList:false
            });
        });
    }

    $(document).ready(function () {
        key_data();
    });

    $(function () {

        function handle_SearchData(){
            var msg = $('#search').val();            
            $.post(hn + 'search_data', {descp_msg:msg, pageNumber:vPageNumber}, function (data) {
                $("#content_data").html(data);
                $('#pp').pagination({
                    pageNumber:vPageNumber,
                    total:$('#recNum').val(),
                    //tentukan banyak rec yg mau ditampilkan disini
                    pageList:[10],
                    //sembunyikan pagelist pagintion easyui
                    showPageList:false
                });
            });
        }

        $('input#search').live('keyup', function(){
            handle_SearchData();
        });

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
    //Simpan - save
    $('a#btnSimpan').live('click', function (e) {
        e.preventDefault();
        var form = document.formdata;
		var dataString = $(form).serialize();
        //alert(ctid);alert(vplu);alert(type);
        $.post(hn + 'data_exec', {
            data: dataString
        }, function (data) {
            var x = eval('(' + data + ')');			
            if (x.success == 1) {
                $('#content_data').hide();
                try {
                    key_data(vPageNumber);
                    $('div#content_data').fadeIn(200);
                    $('#search').removeAttr('disabled');
                    $('#select-satuan').removeAttr('disabled');
                    $("#Alert").html("<p><strong><a style='color:blue'>Success : </a></strong>  Data '" + vplu + "' berhasil di Update.</p>");
                    $('#Alert').slideDown(300);
                    $('#pp').fadeIn(250);
                } catch (err) {
                }
            }
        })

            .error(function () {
                $('#search').removeAttr('disabled');
                $('#Alert').removeAttr('class');
                $("#Alert").addClass("nNote nFailure hideit");
                $("#Alert").html("<p><strong><a style='color:red'>Pemberitahuan : </a></strong> terjadi kesalahan, silahkan diulang kembali!</p>");
                $('#Alert').slideDown(300);				
            });
        return false;
    });
	
	function getSelectedChbox(frm) {
		var selchbox = [];        // array that will store the value of selected checkboxes

		// gets all the input tags in frm, and their number
		var inpfields = frm.getElementsByTagName('input');
		var nr_inpfields = inpfields.length;

		// traverse the inpfields elements, and adds the value of selected (checked) checkbox in selchbox
		for(var i=0; i<nr_inpfields; i++) {
			if(inpfields[i].type == 'checkbox' && inpfields[i].checked == true) selchbox.push(inpfields[i].value);
		}

		return selchbox;
	}
	
	document.getElementById('btnTambah').onclick = function(){
		var selchb = getSelectedChbox(this.form);     // gets the array returned by getSelectedChbox()
		alert(selchb);
	}
	
	//Tambah - Add
	/*
    $('a#btnTambah').live('click', function (e) {
		e.preventDefault();
        var selchb = getSelectedChbox(this.form);     // gets the array returned by getSelectedChbox()
		alert(selchb);
    });
	*/
	//BATAL - Cancel
    $('a#btnBatal').live('click', function (e) {
        e.preventDefault();
        key_data();

        $('#pp').show();
        $('#search').removeAttr('disabled');
        //$('#select-satuan').removeAttr('disabled');
        $('#Alert').slideUp(300);
    });
	
</script>
<div class="sample">
    <div style="width: 100%;">
        <div style="float: left;">
            <label for="search">Search</label>
            <input class="form-control input-sm" type="text" name="search" id="search"/>            
        </div>
        <div style="float: right;">
            <a id="btnSimpan" href="">Approved</a>            
            <a id="btnTambah" href="">Approved2</a>
        </div>
    </div>
    <div style="clear: both;"></div>
    <div id="Alert"></div>
	<?php
		$attributes = array('id' => 'formdata', 'name' => 'formdata','class' => 'form');
		echo form_open('', $attributes);
	?>
    <div id="content_data" class="table table-striped table-hover"></div>
	<?php echo form_close(); ?>
    <div id="pp"></div>
</div>