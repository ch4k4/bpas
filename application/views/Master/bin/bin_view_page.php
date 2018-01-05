<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
?>

<input disabled type="hidden" id="recNum" value="<?php echo $rec ?>"/>
<table cellspacing="1" cellpadding="1" class="table table-striped table-hover">
    <thead>
        <tr>
            <th>#</th>
			<th>Bank Group</th>
			<th width="150">Bank Name</th>					
			<th>Address</th>
			<th>Contact Person</th>			
			<th>Telp</th>
			<th>Fax</th>
			<th>Remarks</th>
            <th width="100" colspan="2" style="text-align: center">ACTION</th>
        </tr>
    </thead>
    <tbody>
<?php foreach ($query as $qry => $row): ?>
		<tr>
			<td><?php echo ($qry + 1) + $offset; ?></td>
            <td><?php echo $row['nmbank']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['address']; ?></td>
            <td><?php echo $row['cp1']; ?></td>            
            <td><?php echo $row['telp']; ?></td>
            <td><?php echo $row['fax']; ?></td>
            <td><?php echo $row['remarks']; ?></td>            
            <td style="text-align: center"><a href="" id="<?php echo  $row['id']; ?>" name="btnUbah">Update</a></td>
            <td style="text-align: center" ><a href="" id="<?php echo  $row['id'].'-'.$row['name']; ?>" name="btnHapus">Delete</a></td>
        </tr>
<?php endforeach; ?>
    </tbody>
</table>