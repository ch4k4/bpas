<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

    $this->load->view('Master/_layer');
?>

<script type="text/javascript">
    //Simpan - save
    $('a#btnSimpan').live('click', function (e) {
        e.preventDefault();
        var ctid = $('#hide_plu').val();
        var type = $('#hide_type').val();
        var bank_group_kode = $('#bank_group_kode').val();
        var bank_group_id = $('#bank_group_id').val();
        var bank_name = $('#bank_name').val();
        var bank_kode = $('#bank_kode').val();
        var address = $('#address').val();
        var country_id = $('#country_id').val();
        var city_id = $('#city_id').val();
        var zcode = $('#zcode').val();
        var cp1 = $('#cp1').val();
        var salut_id = $('#salut_id').val();
        var cp2 = $('#cp2').val();
        var salut_id2 = $('#salut_id2').val();
        var telp = $('#telp').val();
        var fax = $('#fax').val();
        var remarks = $('#remarks').val();        
        //alert(ctid);alert(bank_group_kode);alert(bank_name);alert(city_id);
        $.post(hn + 'data_exec', {
            type:type,ctid:ctid,
            bank_group_kode:bank_group_kode,
            bank_group_id:bank_group_id,
            bank_name:bank_name,
            bank_kode:bank_kode,
            address:address,
            country_id:country_id,
            city_id:city_id,
            zcode:zcode,
            cp1:cp1,
            salut_id:salut_id,
            cp2:cp2,
            salut_id2:salut_id2,
            telp:telp,
            fax:fax,            
            remarks:remarks            
        }, function (data) {
            var x = eval('(' + data + ')');			
            if (x.success == 1) {
                $('#content_data').hide();
                try {
                    key_data(vPageNumber);
                    $('div#content_data').fadeIn(200);
                    $('#search').removeAttr('disabled');
                    $('#select-satuan').removeAttr('disabled');
                    $("#Alert").html("<p><strong><a style='color:blue'>Success : </a></strong>  Data '" + address + "' berhasil di Update.</p>");
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

</script>