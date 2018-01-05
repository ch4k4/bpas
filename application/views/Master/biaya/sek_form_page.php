<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
?>
<?php
$attributes = array('id' => 'formbarang', 'class' => 'form');
echo form_open('', $attributes);
?>
<div class="formdata">
    <fieldset>
        <div class="formRow">
            <label>Sector :</label>
            <div class="formRight">
                <?php if ($type == 'update') {				
					echo '<input class="form-control input-sm" type="text" name="sek" id="sek" value="' . $query['name'] . '" style="width: 350px;" />';
				}else{
					echo '<input class="form-control input-sm" type="text" name="sek" id="sek" value="" style="width: 350px;"/>';
				}
                ?>
            </div>
            <div class="clear"></div>       		
    </fieldset>
</div>

<?php echo form_close(); ?>
<div style="display: none;">
    <input type="hidden" id="hide_plu" value="<?php echo $query['id']?>">
    <input type="hidden" id="hide_type" value="<?php echo  $type ?>">
</div>
