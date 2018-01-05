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
            <label>Country :</label>
            <div class="formRight" style='width: 350px;'>            
			<?php
				if ($type == 'update')
				{
					echo form_dropdown("country_id",$option_country,$query['desc'],"class='form-control' id='country_id' disabled='disabled'");
				}else{
					echo form_dropdown("country_id",$option_country,'',"class='form-control' id='country_id'");				
				}
			?>
            </div>
            <div class="clear"></div>
        </div>
        <div class="formRow">
            <label for="namabarang">City :</label>
            <div class="formRight">
            <?php if ($type == 'update') {				
					echo '<input class="form-control" type="text" name="ct_desc" id="ct_desc" value="'. $query['name'] .'" style="width: 350px;" />';
				}else{
					echo '<input class="form-control" type="text" name="ct_desc" id="ct_desc" value="" style="width: 350px;" />';					
				}
				?>				
            </div>
            <div class="clear"></div>
        </div>		
    </fieldset>
</div>

<?php echo form_close(); ?>
<div style="display: none;">
    <input type="hidden" id="hide_plu" value="<?php echo $query['id']?>">
    <input type="hidden" id="hide_type" value="<?php echo  $type ?>">
</div>