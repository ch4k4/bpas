<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
    
?>
<?php $this->load->view('Master/_layer');?>

<script type="text/javascript">
    //Simpan - save
    $('a#btnSimpan').live('click', function (e) {
        e.preventDefault();
        var ctid = $('#hide_plu').val();
        var vplu = $('#country_id').val();
        var vnama = $('#ct_desc').val();
        var type = $('#hide_type').val();
        alert(ctid);alert(vplu);alert(vnama);alert(type);
        $.post(hn + 'data_exec', {
            type:type,
            ctid:ctid,
            plu:vplu,
            descp:vnama            
        }, function (data) {
            var x = eval('(' + data + ')');			
            if (x.success == 1) {
                $('#content_data').hide();
                try {
                    key_data(vPageNumber);
                    $('div#content_data').fadeIn(200);
                    $('#search').removeAttr('disabled');
                    $('#select-satuan').removeAttr('disabled');
                    $("#Alert").html("<p><strong><a style='color:blue'>Success : </a></strong>  Data '" + vnama + "' berhasil di Update.</p>");
                    $('#Alert').slideDown(300);
                    $('#pp').fadeIn(250);
                } catch (err) {
                }
            } else if (x.success == 2) {

                $("#Alert").html("<p><strong><a style='color:red'>Pemberitahuan : </a></strong> Data sudah ada, silahkan diulang kembali!</p>");
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

/*
    $("#country_id").change(function(){
        var country_id = {country_id:$("#country_id").val()};
        $.ajax({
                type: "POST",
                url : "<?php echo site_url('city/select_city')?>",
                data: country_id,
                success: function(msg){
                    $('#city').html(msg);
                }
            });
    });
*/
</script>