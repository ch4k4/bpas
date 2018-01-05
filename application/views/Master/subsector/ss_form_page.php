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
            <label>Sector :</label>
            <div class="formRight" style='width: 400px;'>            
			<?php
				if ($type == 'update')
				{
					echo form_dropdown("sector_id",$option_sector,$query['desc'],"class='form-control' id='sector_id' disabled='disabled'");
				}else{
					echo form_dropdown("sector_id",$option_sector,'',"class='form-control' id='sector_id'");				
				}
			?>
            </div>
            <div class="clear"></div>
        </div>
        <div class="formRow">
            <label>Sub Sector :</label>
            <div class="formRight" style='width: 400px;'>
            <?php if ($type == 'update') {				
					echo '<input class="form-control" type="text" name="ct_desc" id="ct_desc" value="'. $query['name'] .'"/>';
				}else{
					echo '<input class="form-control" type="text" name="ct_desc" id="ct_desc" value="" />';					
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