<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
?>
<?php
$attributes = array('id' => 'formdata', 'class' => 'form');
echo form_open('', $attributes);
?>
<div class="formdata">
    <fieldset>
		<div class="formRow">
            <label>Tanggal :</label>
            <div class="formRight" style='width: 400px;'>			
				<?php
					if ($type == 'update')
					{
						echo '<input type="date" id="checkin" name="checkin" value="'. $query['dt_input'] .'">';
						
					}else{
						echo '<input type="date" id="checkin" name="checkin">';						
					}
				?>
            </div>
            <div class="clear"></div>
        </div>
		<div class="formRow">
            <label>Jenis Beban :</label>
            <div class="formRight" style='width: 400px;'>            
			<?php
				if ($type == 'update')
				{
					echo form_dropdown("sector_id",$option_sector,$query['sector_id'],"class='form-control' id='sector_id' ");					
				}else{
					echo form_dropdown("sector_id",$option_sector,'',"class='form-control' id='sector_id'");				
				}
			?>
            </div>
            <div class="clear"></div>
        </div>
        <div class="formRow">
            <label>Nama Beban :</label>
            <div id='beban' class="formRight" style='width: 400px;'>            
			<?php
				if ($type == 'update')
				{
					echo form_dropdown("beban_id",$option_subsec,$query['subsec_id'],"class='form-control' id='beban_id'");
				}else{
					echo form_dropdown("beban_id",array('Select City --> Select Country First'),'',"class='form-control' id='beban_id' disabled='disabled'");				
				}
			?>
            </div>
            <div class="clear"></div>
        </div>
        <div class="formRow">
            <label>Deskripsi :</label>
            <div class="formRight" style='width: 400px;'>
            <?php if ($type == 'update') {				
					echo '<input class="form-control" type="text" name="ct_beban" id="ct_beban" value="'. $query['name'] .'"/>';
				}else{
					echo '<input class="form-control" type="text" name="ct_beban" id="ct_beban" value="" />';					
				}
				?>				
            </div>
            <div class="clear"></div>
        </div>
		<div class="formRow">
            <label>Harga :</label>
            <div class="formRight" style='width: 400px;'>
            <?php if ($type == 'update') {				
					echo '<input class="number" name="ct_harga" id="ct_harga" value="'. $query['harga'] .'"/>';
				}else{
					echo '<input class="number" name="ct_harga" id="ct_harga" value="" />';					
				}
				?>				
            </div>
            <div class="clear"></div>
        </div>		
		<div class="formRow">
            <label>Status :</label>
            <div class="formRight" style='width: 400px;'>
            <?php if ($type == 'update') {				
					echo '<input class="form-control" type="text" name="stat" id="stat" value="'. $query['stat'] .'"/>';
				}else{
					echo '<input class="form-control" type="text" name="stat" id="stat" value="O" disabled="disabled"/>';					
				}
				?>				
            </div>
            <div class="clear"></div>
        </div>
		<!--
		<div class="form-group file_upload" style='width: 400px;'>
			<label>Upload file</label>
			<input type="file" name="bon" value="" id="bon" class="form-control file" />
		</div>
		-->
    </fieldset>
</div>

<?php echo form_close(); ?>
<div style="display: none;">
    <input type="hidden" id="hide_plu" value="<?php echo $query['id']?>">
    <input type="hidden" id="hide_type" value="<?php echo  $type ?>">
</div>

<script type="text/javascript">
$("#sector_id").change(function(){
    var sector_id = {sector_id:$("#sector_id").val()};
    $.ajax({
        type: "POST",
        url : "<?php echo site_url('subsector/select_subsec')?>",
        data: sector_id,
        success: function(msg){
            $('#beban').html(msg);
            }
	});
});

$('input.number').keyup(function(event) {
	// skip for arrow keys
	if(event.which >= 37 && event.which <= 40) return;

	// format number
	$(this).val(function(index, value) {
		return value
		.replace(/\D/g, "")
		.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
	});
});
</script>