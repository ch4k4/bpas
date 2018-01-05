<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
?>

<input disabled type="hidden" id="recNum" value="<?php echo $rec ?>"/>
<table cellspacing="1" cellpadding="1" class="table table-striped table-hover">
    <thead>
        <tr>
            <th width="50">#</th>            
            <th width="150">Tanggal</th>
			<th width="150">Jenis Beban</th>
			<th width="300">Nama Beban</th>			
			<th width="700">Deskripsi</th>
			<th width="200" style="text-align: right">Harga</th>
            <th width="100" colspan="2" style="text-align: center">ACTION</th>
        </tr>
    </thead>
    <tbody>
<?php foreach ($query as $qry => $row): ?>
		<tr>
			<td><?php echo ($qry + 1) + $offset; ?></td>
			<td><?php echo date('d-M-Y', strtotime($row['dt_input'])); ?></td>
			<td><?php echo $row['jbeban']; ?></td>
            <td><?php echo $row['nbeban']; ?></td>
			<td><?php echo $row['name']; ?></td>
			<td style="text-align: right"=><?php echo number_format($row['harga'],2); ?></td>
            <td style="text-align: center"><a href="" id="<?php echo  $row['id']; ?>" name="btnUbah">Update</a></td>
            <td style="text-align: center" ><a href="" id="<?php echo  $row['id'].'-'.$row['name']; ?>" name="btnHapus">Delete</a></td>
        </tr>
<?php endforeach; ?>
    </tbody>
</table>