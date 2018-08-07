<!-- Main content -->
        <section class='content'>
          <div class='row'>
            <div class='col-xs-12'>
              <div class='box'>
                <div class='box-header'>
                
                  <h3 class='box-title'>NILAI_INDO</h3>
                      <div class='box box-primary'>
        <form action="<?php echo $action; ?>" method="post"><table class='table table-bordered'>
	    <tr><td>Nama Siswa <?php echo form_error('nama_siswa') ?></td>
            <td>
               <!-- ($name,$table,$field,$pk,$selected) -->
              <!-- cmb_dinamis(name="id_mapel"),(table->mapel),(name field yg diinginkan),(pk alamat dari name field),"value  " -->
              <?php echo cmb_dinamis('nama_siswa', 'siswa', 'nama', 'id', $nama_siswa) ?>
              <!-- <input type="text" class="form-control" name="nama_siswa" id="nama_siswa" placeholder="Nama Siswa" value="<?php echo $nama_siswa; ?>" /> -->
        </td>
	    <tr><td>Ulangan <?php echo form_error('ulangan') ?></td>
            <td><input type="text" class="form-control" name="ulangan" id="ulangan" placeholder="Ulangan" value="<?php echo $ulangan; ?>" />
        </td>
	    <tr><td>Uts <?php echo form_error('uts') ?></td>
            <td><input type="text" class="form-control" name="uts" id="uts" placeholder="Uts" value="<?php echo $uts; ?>" />
        </td>
	    <tr><td>Uas <?php echo form_error('uas') ?></td>
            <td><input type="text" class="form-control" name="uas" id="uas" placeholder="Uas" value="<?php echo $uas; ?>" />
        </td>
	    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <tr><td colspan='2'><button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('nilai_indo') ?>" class="btn btn-default">Cancel</a></td></tr>
	
    </table></form>
    </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->