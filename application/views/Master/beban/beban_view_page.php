<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
?>

<input disabled type="hidden" id="recNum" value="<?php echo $rec ?>"/>
<table cellspacing="1" cellpadding="1" class="table table-striped table-hover">
    <thead>
        <tr>
            <th width="50">#</th>
            <th width="300">Jenis Beban</th>
            <th width="400">Beban</th>
			<th width="650">Keterangan</th>
			<th width="200">Kodasi</th>
            <th width="100" colspan="2" style="text-align: center">ACTION</th>
        </tr>
    </thead>
    <tbody>
<?php foreach ($query as $qry => $row): ?>
		<tr>
			<td><?php echo ($qry + 1) + $offset; ?></td>
            <td><?php echo $row['jbeban']; ?></td>
            <td><?php echo $row['name']; ?></td>
			<td><?php echo $row['desk']; ?></td>
            <td><?php echo $row['coa']; ?></td>
            <td style="text-align: center"><a href="" id="<?php echo  $row['id']; ?>" name="btnUbah">Update</a></td>
            <td style="text-align: center" ><a href="" id="<?php echo  $row['id'].'-'.$row['name']; ?>" name="btnHapus">Delete</a></td>
        </tr>
<?php endforeach; ?>
    </tbody>
</table>