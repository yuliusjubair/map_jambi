<?php 
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename=DDR1.xls');
header('Cache-Control: max-age=0');
?>
<style type="text/css">
  /* Housekeeping */
html{
    font:0.75em/1.5 sans-serif;
    color:#333;
    background-color:#fff;
    padding:1em;
}

/* Tables */
table{
    width:100%;
    margin-bottom:1em;
    border-collapse: collapse;
}
th{
    font-weight:bold;
    background-color:#ddd;
}
th,
td{
    padding:0.5em;
    border:1px solid #ccc;
}

</style>
<div class="row">
<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            Data Ruas Jalan By Table
        </div>
        <!-- /.panel-heading -->
        <div class="panel-body">
          <div class="table-responsive">
                <table id="table" style="font-size: 12px;" class="datatable table table-hover table-bordered data">
                    <thead>
                        <tr>
                            <th rowspan="3" style="text-align:center;" valign="top">No</th>
                            <th rowspan="3" style="text-align:center;" valign="top">id</th>
                            <th rowspan="3" style="text-align:center;" valign="top">Nama Ruas Jalan</th>
                            <th rowspan="3" style="text-align:center;">Kec. yang dilalui</th>
                            <th rowspan="3" style="text-align:center;">Panjang Ruas(km)</th>
                            <th rowspan="3" style="text-align:center;">Lebar Ruas(km)</th>
                            <th colspan="4" style="text-align:center;">Panjang Tiap Jenis Permukaan</th>
                            <th colspan="8" style="text-align:center;">Panjang Tiap Kondisi</th>
                        </tr>
                        <tr>
                          <?php foreach($master_jenis as $kon):?>
                            <th rowspan="2"><?php echo $kon->jenis?></th>
                          <?php endforeach;?>
                          
                          <?php foreach($master_kondisi as $kon):?>
                            <th colspan="2"><?php echo $kon->nama?></th>
                          <?php endforeach;?>
                        </tr>
                        <tr>
                          <?php foreach($master_kondisi as $kon):?>
                            <th>%</th>
                            <th>km</th>
                          <?php endforeach;?>
                        </tr>
                    </thead>
                    <tbody>
                      <?php 
                      $no=1;
                      foreach($row as $r):?>
                      <tr>
                        <td><?php echo $no?></td>
                        <td><?php echo $r->id_lokasi?></td>
                        <td><?php echo $r->nama_ruas_jalan?></td>
                        <td><?php echo $r->nama_kecamatan?></td>
                        <td><?php echo $r->panjang_ruas?></td>
                        <td><?php echo $r->lebar_ruas?></td>
                        <?php 
                        foreach ($master_jenis as $key => $value) {
                          $sql_type2 = $this->db->query("SELECT panjang from list_jenis_permukaan_map where id_lokasi='".$r->id_lokasi."' and id_type='".$value->id."'");
                          if($sql_type2->num_rows()>0){
                            echo "<td>".$sql_type2->row()->panjang."</td>";
                          }else{
                            echo "<td>&nbsp;</td>";
                          }
                        }?>
                        <?php $sql_type = $this->db->query("SELECT persen, km from list_kondisi_map where id_lokasi='".$r->id_lokasi."'");
                        if($sql_type->num_rows()>0){
                        foreach ($sql_type->result() as $key => $value) {
                            echo "<td>".$value->persen."</td>";
                            echo "<td>".$value->km."</td>";
                          }
                        }else{
                            echo "<td>&nbsp;</td>";
                            echo "<td>&nbsp;</td>";
                            echo "<td>&nbsp;</td>";
                            echo "<td>&nbsp;</td>";
                            echo "<td>&nbsp;</td>";
                            echo "<td>&nbsp;</td>";
                            echo "<td>&nbsp;</td>";
                            echo "<td>&nbsp;</td>";
                        }
                        ?>
                      </tr>
                      <?php $no++; endforeach;?>
                    </tbody>
                    <tfoot></tfoot>
                </table>
                </div>
        </div>
      </div>
    </div>
  </div>