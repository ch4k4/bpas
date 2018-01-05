
<script type="text/javascript"> 	
    //var hn = '<?php echo base_url();?>';
    var hn = window.location.protocol + "//" + window.location.host + window.location.pathname + "/";
    //alert(hn);
    var vPageNumber = 1;
    function key_data() {
        $('a#btnSimpan').hide();
        $('a#btnBatal').hide();
        $('a#btnTambah').show();
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
</script>

<div class="sample">
    <div style="width: 100%;">
        <div style="float: left;">
            <label for="search">Search</label>
            <input class="form-control input-sm" type="text" name="search" id="search"/>            
        </div>
        <div style="float: right;">
            <a id="btnTambah" href="">Add</a>
            <a id="btnSimpan" href="">Save</a>
            <a id="btnBatal" href="">Cancel</a>
        </div>
    </div>
    <div style="clear: both;"></div>
    <div id="Alert"></div>
    <div id="content_data" class="table table-striped table-hover"></div>
    <div id="pp"></div>
</div>

<script type="text/javascript">
    //Tambah - Add
    $('a#btnTambah').live('click', function (e) {
        e.preventDefault();
        $("#Alert").slideUp(200);
        $.ajax({
            type:'POST',
            url: hn + 'addData',
            //data:'id=add',
            success:function (msg) {
                $('#search').attr('disabled', 'disabled');                
                $('div#content_data').hide();
                $('div#content_data').empty();
                $('#pp').hide();
                $('a#btnTambah').hide();
                $('div#content_data').html(msg);
                $('a#btnSimpan').show();
                $('a#btnBatal').show();
                $('div#content_data').fadeIn(200);
            },
            error:function (xhr, ajaxOptions, thrownError) {
                $("#Alert").html("<p><strong><a style='color:red'>Ma'af </a></strong> Ada kesalahan!</p>");
                $('#Alert').slideDown(300);
            }
        });
        return false;
    });

    //BATAL - Cancel
    $('a#btnBatal').live('click', function (e) {
        e.preventDefault();
        key_data();

        $('#pp').show();
        $('#search').removeAttr('disabled');
        //$('#select-satuan').removeAttr('disabled');
        $('#Alert').slideUp(300);
    });    

    //UBAH - update
    $('a[name=btnUbah]').live('click', function (e) {
        e.preventDefault();
        var vplu = $(this).attr('id');
        //alert(vplu);
        $("#Alert").slideUp(200);
        $.ajax({
            type:'POST',
            url:hn + 'uptdata',
            data:'plu=' + vplu,
            success:function (msg) {
                $('div#content_data').fadeOut(200);
                $('div#content_data').empty();
                $('#pp').hide();
                $('a#btnTambah').hide();
                $('#content_data').html(msg);
                $('a#btnSimpan').show();
                $('a#btnBatal').show();
                $('#search').attr('disabled', 'disabled');
                //$('#select-satuan').attr('disabled', 'disabled');
                $('div#content_data').fadeIn(200);				
            },
            error:function (xhr, ajaxOptions, thrownError) {

                $("#Alert").html("<p><strong><a style='color:red'>Ma'af </a></strong> Ada kesalahan!</p>");
                $('#Alert').slideDown(300);
            }
        });
        return false;
    });    

    //HAPUS - delete
    $('a[name=btnHapus]').live('click', function (e) {
        e.preventDefault();
        var plu = $(this).attr('id');        
        var $hasil = plu.split("-");
        var vdata = $hasil[1];
        $('#Alert').hide();
        $.messager.confirm('Hapus Data', 'Hapus Data "' + vdata + '" ?', function (r) {
            if (r) {

                $.ajax({
                    type:'POST',
                    url:hn + 'hapusdata_exec',
                    data:'plu=' + $hasil[0],
                    success:function (msg) {
                        var x = eval('(' + msg + ')');
                        if (x.success == 1) {
                           // parent.slideUp(300, function () {
                             //   parent.remove();
                            //});

                            $("#Alert").html("<p><strong><a style='color:blue'>Success : </a></strong>  Data <a style='color:green'>' " + vdata + " '</a> Berhasil di Hapus.</p>");
                            $('#Alert').slideDown(300);
                            key_data(vPageNumber);
                        }
                        else if ((x.success == 2)) {
                            $("#Alert").html("<p><strong><a style='color:maroon'>Pemberitahuan :</a></strong> Data <a style='color:green'>' " + vdata + " '</a> Tidak dapat diHapus!</p>");
                            $('#Alert').slideDown(300);
                        }
                        else {

                            $("#Alert").html("<p><strong><a style='color:red'>Pemberitahuan : </a></strong> terjadi kesalahan, silahkan diulang kembali!</p>");
                            $('#Alert').slideDown(300);
                        }
                    },
                    error:function (xhr, ajaxOptions, thrownError) {

                        $("#Alert").html("<p><strong><a style='color:red'>Ma'af </a></strong> Ada Kesalahan!</p>");
                        $('#Alert').slideDown(300);

                    }
                });
                return false;
            }
        });

    });
</script>