Main content -->
        <section class='content'>
          <div class='row'>
            <div class='col-xs-12'>
              <div class='box'>
                <div class='box-header'>
                
                  <h3 class='box-title'>PENGAJAR</h3>
                      <div class='box box-primary'>
        <form action="<?php echo $action; ?>" method="post"><table class='table table-bordered'>
	    <tr><td>Nama Pengajar <?php echo form_error('nama') ?></td>
            <td><input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" value="<?php echo $nama; ?>" />
        </td>
	    <tr><td>Nama Mapel <?php echo form_error('id_mapel') ?></td>
            <td>
              <!-- ($name,$table,$field,$pk,$selected) -->
              <!-- cmb_dinamis(name="id_mapel"),(table->mapel),(name field yg diinginkan),(pk alamat dari name field),"value  " -->
              <?php echo cmb_dinamis('id_mapel', 'mapel', 'mapel', 'id', $id_mapel) ?>
              <!-- <input type="text" class="form-control" name="id_mapel" id="id_mapel" placeholder="Id Mapel" value="<?php echo $id_mapel; ?>" /> -->
        </td>
	    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <tr><td colspan='2'><button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('pengajar') ?>" class="btn btn-default">Cancel</a></td></tr>
	
    </table></form>
    </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content