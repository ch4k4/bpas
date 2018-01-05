<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
?>

<input disabled type="hidden" id="recNum" value="<?php echo $rec ?>"/>
<table cellspacing="1" cellpadding="1" class="table table-striped table-hover">
    <thead>
        <tr>
            <th width="">#</th>
            <th width="">TYPE</th>
            <th width="">KODE</th>
            <th width="150">NAME</th>
            <th width="">ADDRESS</th>            
            <th width="">TELP</th>
            <th width="">FAX</th>            
            <th width="">REMARKS</th>                        
            <th width="" colspan="2" style="text-align: center">ACTION</th>
        </tr>
    </thead>
    <tbody>
<?php foreach ($query as $qry => $row): ?>
		<tr>
			<td><?php echo ($qry + 1) + $offset; ?></td>
            <td><?php echo $row['tipe']; ?></td>
            <td><?php echo $row['kode']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['address']; ?></td>            
            <td><?php echo $row['telp']; ?></td>
            <td><?php echo $row['fax']; ?></td>
            <td><?php echo $row['remarks']; ?></td>            
            <td style="text-align: center"><a href="" id="<?php echo  $row['id']; ?>" name="btnUbah">Update</a></td>
            <td style="text-align: center" ><a href="" id="<?php echo  $row['id'].'-'.$row['name']; ?>" name="btnHapus">Delete</a></td>
        </tr>
<?php endforeach; ?>
    </tbody>
</table>