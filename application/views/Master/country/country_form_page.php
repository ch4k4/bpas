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
            <label>Country ID :</label>
            <div class="formRight">
                <?php if ($type == 'update') {				
					echo '<input class="form-control input-sm" disabled type="text" name="ct" id="ct" value="' . $query['name'] . '" style="width: 350px;" />';
				}else{
					echo '<input class="form-control input-sm" type="text" name="ct" id="ct" value="" style="width: 350px;"/>';
				}
                ?>
            </div>
            <div class="clear"></div>
        </div>
        <div class="formRow">
            <label for="namabarang">Description :</label>
            <div class="formRight">
				<?php if ($type == 'update') {				
					echo '<input class="form-control input-sm" type="text" name="ct_desc" id="ct_desc" value="'. $query['desc'] .'" style="width: 350px;" />';
				}else{
					echo '<input class="form-control input-sm" type="text" name="ct_desc" id="ct_desc" value="" style="width: 350px;" />';					
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
