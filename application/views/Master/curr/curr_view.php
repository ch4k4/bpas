<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
    
?>
<?php $this->load->view('Master/_layer');?>

<script type="text/javascript">
    //Simpan - save
    $('a#btnSimpan').live('click', function (e) {
        e.preventDefault();
        var cnama = $('#ct').val();        
        var kode = $('#ct_desc').val();
        var sym = $('#ct_desc2').val();        
        var unik = $('#hide_plu').val();        
        var type = $('#hide_type').val();		
        //alert(unik);alert(cnama);alert(kode);alert(sym);alert(type);
        $.post(hn + 'data_exec', {
            type:type,
            unik:unik,
            cnama:cnama,
            sym:sym,
            kode:kode           	
        }, function (data) {
            var x = eval('(' + data + ')');			
            if (x.success == 1) {
                $('#content_data').hide();
                try {
                    key_data(vPageNumber);
                    $('div#content_data').fadeIn(200);
                    $('#search').removeAttr('disabled');
                    $('#select-satuan').removeAttr('disabled');
                    $("#Alert").html("<p><strong><a style='color:blue'>Success : </a></strong>  Data '" + cnama + "' berhasil di Update.</p>");
                    $('#Alert').slideDown(300);
                    $('#pp').fadeIn(250);
                } catch (err) {
                }
            } else if (x.success == 2) {

                $("#Alert").html("<p><strong><a style='color:red'>Pemberitahuan : </a></strong> ID Data sudah ada, silahkan diulang kembali!</p>");
                $('#Alert').slideDown(300);
                $('input#plu').focus().select();
            }
            else if (x.success == 3) {

                $("#Alert").html(x.error);
                $('#Alert').slideDown(300);
                $('input#plu').focus().select();
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
    
</script>