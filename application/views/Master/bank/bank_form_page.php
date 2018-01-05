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
            <label>Bank Group Name :</label>
            <div class="formRight">
                <?php if ($type == 'update') {				
					echo '<input class="form-control input-sm" disabled type="text" name="plu" id="plu" value="' . $query['name'] . '" style="width: 350px;" />';
				}else{
					echo '<input class="form-control input-sm" type="text" name="plu" id="plu" value="" style="width: 350px;" />';
				}
                ?>
            </div>
            <div class="clear"></div>
        </div>
        <div class="formRow">
            <label>Bank Group Code :</label>
            <div class="formRight">
				<?php if ($type == 'update') {				
					echo '<input class="form-control input-sm" type="text" name="nama" id="nama" value="'. $query['kode'] .'" style="width: 350px;" />';
				}else{
					echo '<input class="form-control input-sm" type="text" name="nama" id="nama" value="" style="width: 350px;" />';					
				}
				?>
            </div>
            <div class="clear"></div>
        </div>        		
    </fieldset>
</div>

<?php echo form_close(); ?>
<div style="display: none;">    
    <input type="hidden" id="hide_type" value="<?php echo  $type ?>">
    <input type="hidden" id="hide_plu" name="hide_plu" value="<?php echo $query['id'];?>">
</div>