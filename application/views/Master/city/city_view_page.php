<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
?>

<input disabled type="hidden" id="recNum" value="<?php echo $rec ?>"/>
<table cellspacing="1" cellpadding="1" class="table table-striped table-hover">
    <thead>
        <tr>
            <th width="50">#</th>
            <th width="200">COUNTRY</th>
            <th width="600">CITY</th>            
            <th width="100" colspan="2" style="text-align: center">ACTION</th>
        </tr>
    </thead>
    <tbody>
<?php foreach ($query as $qry => $row): ?>
		<tr>
			<td><?php echo ($qry + 1) + $offset; ?></td>
            <td><?php echo $row['country']; ?></td>
            <td><?php echo $row['propinsi']; ?></td>            
            <td style="text-align: center"><a href="" id="<?php echo  $row['id']; ?>" name="btnUbah">Update</a></td>
            <td style="text-align: center" ><a href="" id="<?php echo  $row['id'].'-'.$row['propinsi']; ?>" name="btnHapus">Delete</a></td>
        </tr>
<?php endforeach; ?>
    </tbody>
</table>