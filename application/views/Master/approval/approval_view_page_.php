<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
?>

<input disabled type="hidden" id="recNum" value="<?php echo $rec ?>"/>
<table cellspacing="1" cellpadding="1" class="table table-striped table-hover">
    <thead>
        <tr>
            <th width="50">#</th>
			<th hidden>#</th>
            <th width="150">Tanggal</th>
			<th width="300">Nama Beban</th>
			<th width="600">Deskripsi</th>
			<th width="200" style="text-align: right">Harga</th>            
			<th width="200" style="text-align: right"><input type="checkbox" id="ceksemua"/>Approval</th>
        </tr>
    </thead>
    <tbody>
	<?php foreach ($query as $qry => $row): ?>
		<tr>
			<td><?php echo ($qry + 1) + $offset; ?></td>
			<td hidden><input type="text" name="vid[]" id="vid" value=<?php echo $row['id']; ?>></td>
			<td><?php echo date('d-M-Y', strtotime($row['dt_input'])); ?></td>
            <td><?php echo $row['nbeban']; ?></td>
			<td><?php echo $row['name']; ?></td>
			<td style="text-align: right"=><?php echo number_format($row['harga'],2); ?></td>
			<td style="text-align: center"><input type="checkbox" name="chk[]" class="chk" value=<?php echo $row['id']; ?>></td>			
        </tr>
	<?php endforeach; ?>
    </tbody>	
</table>
<script type="text/javascript">
	$(function(){
		// create multiple select/deselect
		$("#ceksemua").click(function () {
			$('.chk').attr('checked', this.checked);
		}); 
		// jika #ceksemua di pilih maka semua checkbox akan terpilih
		// demikian juga sebaliknya
		$(".chk").click(function(){
 
			if($(".chk").length == $(".chk:checked").length) {
				$("#ceksemua").attr("checked", "checked");
			} else {
				$("#ceksemua").removeAttr("checked");
			}
 
		});
	});	
	
</script>