<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
?>

<form id="myform" class="myform" method="post" name="myform">
<textarea id="myField" type="text" name="myField"></textarea>
<input type="checkbox" name="myCheckboxes[]" id="myCheckboxes" value="someValue1" />
<input type="checkbox" name="myCheckboxes[]" id="myCheckboxes" value="someValue2" />
<input id="submit" type="submit" name="submit" value="Submit" onclick="return submitForm()" />
</form>
<div id="myResponse"></div>

<script type="text/javascript">
	function submitForm() {
		var form = document.myform;
		var dataString = $(form).serialize();

		$.ajax({
			type:'POST',
			url:'myurl.php',
			data: dataString,
			success: function(data){
				$('#myResponse').html(data);
			}
		});
		return false;
	}
</script>
<?php
	echo var_export($_POST);
?>