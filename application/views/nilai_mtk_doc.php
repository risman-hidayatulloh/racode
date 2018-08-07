<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            .word-table {
                border:1px solid black !important; 
                border-collapse: collapse !important;
                width: 100%;
            }
            .word-table tr th, .word-table tr td{
                border:1px solid black !important; 
                padding: 5px 10px;
            }
        </style>
    </head>
    <body>
        <h2>Nilai_mtk List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Nama Siswa</th>
		<th>Ulangan</th>
		<th>Uts</th>
		<th>Uas</th>
		
            </tr><?php
            foreach ($nilai_mtk_data as $nilai_mtk)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $nilai_mtk->nama ?></td>
		      <td><?php echo $nilai_mtk->ulangan ?></td>
		      <td><?php echo $nilai_mtk->uts ?></td>
		      <td><?php echo $nilai_mtk->uas ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>