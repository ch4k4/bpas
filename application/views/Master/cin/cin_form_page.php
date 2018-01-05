<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
?>
<?php
$attributes = array('id' => 'formdata', 'class' => 'form');
echo form_open('', $attributes);
?>

<table class="table">
	<tr>
		<td>Bank Group Name</td>
		<td>:</td>
		<td>
			<?php
				if ($type == 'update')
				{
					echo form_dropdown("bank_group_kode",$option_bank,$query['bank_group_kode'],"class='form-control' id='bank_group_kode' disabled='disabled' ");
				}else{
					echo form_dropdown("bank_group_kode",$option_bank,'',"class='form-control' id='bank_group_kode' onChange=''");				
				}
			?>
		</td>
        <td>Bank Group ID</td>
		<td>:</td>
        <td>
        	<?php
        		if ($type == 'update')
					{
						echo '<input readonly class="form-control" type="text" name="bank_group_id" id="bank_group_id" value="' . $query['bank_group_kode'] . '" />';
					}else{
						echo '<input class="form-control" type="text" name="bank_group_id" id="bank_group_id" disabled="disabled" value="">';
					}
			?>
		</td>	
    </tr>
	<tr>
		<td>Bank Name</td>
		<td>:</td>
		<td>
			<?php
        		if ($type == 'update')
					{
						echo '<input readonly class="form-control" type="text" name="bank_name" id="bank_name" value="' . $query['name'] . '" />';
					}else{
						echo '<input class="form-control" type="text" id="bank_name" value="" placeholder="Bank Name">';
					}
			?>
		</td>
        <td>Bank ID</td>
		<td>:</td>
        <td>
        	<?php
        		if ($type == 'update')
					{
						echo '<input readonly class="form-control" type="text" name="bank_kode" id="bank_kode" value="' . $query['kode'] . '" />';
					}else{
						echo'<input class="form-control" type="text" id="bank_kode" value="" placeholder="Bank ID">';
					}
			?>
		</td>
    </tr>
	<tr>
		<td>Address</td>
		<td>:</td>
		<td colspan='4'>
			<?php
        		if ($type == 'update')
					{
						echo '<input class="form-control" type="text" name="address" id="address" value="' . $query['address'] . '" />';
					}else{
						echo'<textarea class="form-control" id="address" placeholder="Address" rows="3"></textarea>';
					}
			?>
		</td>
    </tr>
	<tr>
	   <td>Country</td>
		<td>:</td>
		<td>
			<?php
				if ($type == 'update')
				{
					echo form_dropdown("country_id",$option_country,$query['country_id'],"class='form-control' id='country_id'");
				}else{
					echo form_dropdown("country_id",$option_country,'',"class='form-control' id='country_id'");				
				}
			?>
		</td>
		<td>City</td>
		<td>:</td>
		<td>
		<div id='city'>
		<?php if ($type == 'update') {				
					echo form_dropdown("city_id",$option_city,$query['city_id'],"class='form-control' id='city_id'");
				}else{
					echo form_dropdown("city_id",array('Select City --> Select Country First'),'',"class='form-control' id='city_id' disabled='disabled' ");					
				}
	   ?>	
		</div>
			
		</td>		        
    </tr>
    <tr>
		<td>Zip Code</td>
		<td>:</td>
        <td>
        	<?php
        		if ($type == 'update')
					{
						echo '<input class="form-control" type="text" id="zcode" placeholder="Zip Code" value="'. $query['zip'] .'"></td>';
					}else{
						echo'<input class="form-control" type="text" id="zcode" placeholder="Zip Code" value=""></td>';
					}
			?>
	</tr>
	<tr>
		<td>Contact Person 1</td>
		<td>:</td>
		<td><?php
        		if ($type == 'update')
					{
						echo '<input class="form-control" type="text" id="cp1" placeholder="Contact Person 1" value="'. $query['cp1'] .'"></td>';
					}else{
						echo'<input class="form-control" type="text" id="cp1" placeholder="Contact Person 1" value=""></td>';
					}
			?>			
        <td>Title</td>
		<td>:</td>
        <td>
            <?php
				if ($type == 'update')
				{
					echo form_dropdown("salut_id",$option_salut,$query['title'],"class='form-control' id='salut_id'");
				}else{
					echo form_dropdown("salut_id",$option_salut,'',"class='form-control' id='salut_id'");				
				}
			?>
		</td>
    </tr>
	<tr>
		<td>Contact Person 2</td>
		<td>:</td>
		<td>
			<?php
        		if ($type == 'update')
					{
						echo'<input class="form-control" type="text" id="cp2" placeholder="Contact Person 2" value="'. $query['cp2'] .'"></td>';
					}else{
						echo'<input class="form-control" type="text" id="cp2" placeholder="Contact Person 2" value=""></td>';
					}
			?>
        <td>Title</td>
		<td>:</td>
        <td>
        <?php
			if ($type == 'update')
			{
				echo form_dropdown("salut_id2",$option_salut,$query['title2'],"class='form-control' id='salut_id2'");
			}else{
				echo form_dropdown("salut_id2",$option_salut,'',"class='form-control' id='salut_id2'");				
			}
		?>
        </td>
    </tr>
	<tr>
		<td>Telp</td>
		<td>:</td>
		<td>
			<?php
        		if ($type == 'update')
					{
						echo '<input class="form-control" type="text" id="telp" placeholder="Telp" value="'. $query['telp'] .'"></td>';
					}else{
						echo'<input class="form-control" type="text" id="telp" placeholder="Telp" value=""></td>';
					}
			?>			
        <td>Fax</td>
		<td>:</td>
        <td><?php
        		if ($type == 'update')
					{
						echo '<input class="form-control" type="text" id="fax" placeholder="Fax" value="'. $query['fax'] .'"></td>';
					}else{
						echo'<input class="form-control" type="text" id="fax" placeholder="Fax" value=""></td>';
					}
			?>
    </tr>
	<tr>
		<td>Remarks</td>
		<td>:</td>
		<td colspan='4'>
			<?php
        		if ($type == 'update')
					{
						echo '<textarea class="form-control" id="remarks" placeholder="Remarks" rows="3">'. $query['remarks'] .'</textarea>';
					}else{
						echo'<textarea class="form-control" id="remarks" placeholder="Remarks" rows="3"></textarea>';
					}
			?>
		</td>
    </tr>
	<tr>		
        <td colspan="6" align='left'>
			<input type='reset' value='Reset' name='reset' id='reset'>
		</td>
	</tr>
</table>
<?php echo form_close(); ?>
<div style="display: none;">
    <input type="hidden" id="hide_plu" value="<?php echo $query['id']?>">
    <input type="hidden" id="hide_type" value="<?php echo  $type ?>">
</div>
<script type="text/javascript">
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

$("#bank_group_kode").change(function(){
    var bank_group_kode = $("#bank_group_kode").val();
    //alert(bank_group_kode);
    //$('#txtid').val('sam');
    $('#bank_group_id').val(bank_group_kode);
    });
</script>