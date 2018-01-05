<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<script>
	function repotUser(str){
		var hn = window.location.protocol + "//" + window.location.host + window.location.pathname + "1/";
    	var str = document.getElementById("rpt").value;
    	var uri_1 = "<?php echo base_url()?>index.php/welcome/report/"+ str;
		//var uri_1 = hn + str;
		//alert (uri_1);
    	if (str == '0'){
    		alert('Pilih Menu');
    		document.getElementById("rpt").focus();
    		return false;
    	}

		if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
		}else{// code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange=function(){
			if (xmlhttp.readyState==4 && xmlhttp.status==200){
				document.getElementById("main2").innerHTML=xmlhttp.responseText;
			}
		}
		alert(uri_1);
		xmlhttp.open("GET",uri_1);
		xmlhttp.send();

	};
</script>

	<table class="table">
		<tr>
			<td>Report Type</td>
			<td>:</td>
			<td>
				<div class="formRight" style="width: 400px;">
					<select id="rpt" name="rpt" class="form-control">
						<option value="0">-Pilih Report-</option>						
						<option value="rpt1">History Transaction</option>
					</select>
				</div>
			</td>
			<td>
				<button onclick="repotUser()">Process</button>
			</td>
		</tr>
	</table>
	<p><div id="main2"></div>