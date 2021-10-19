<link href="//cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>   
<script src="//cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>   
 
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js"></script> 
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.html5.min.js"></script>

<div class="row">
  <div class="col-lg-12 shadow">
   <div class="panel panel-default">
        <div class="panel-heading">
            Data Jembatan By Table
        </div>
        <!-- /.panel-heading -->
        <div class="panel-body">
                <table id="table" style="font-size: 12px;" class="datatable table table-hover table-bordered data">
                    <thead>
                        <tr>
                            <th rowspan="3" style="text-align:center;" valign="top">No</th>
                            <th rowspan="3" style="text-align:center;" valign="top">id</th>
                            <th rowspan="3" style="text-align:center;" valign="top">Nama Jembatan</th>
                            <th rowspan="3" style="text-align:center;" valign="top">Nama Ruas Jalan</th>
                            <th rowspan="3" style="text-align:center;">Kec. yang dilalui</th>
                            <th rowspan="3" style="text-align:center;">Panjang Ruas(km)</th>
                            <th rowspan="3" style="text-align:center;">Lebar Ruas(km)</th>
                           <th colspan="8" style="text-align:center;">Tipe Kondisi</th>
                        </tr>
                        <tr>
                         
                          <?php foreach($master_kondisi as $kon):?>
                            <th colspan="2"><?php echo $kon->nama?></th>
                          <?php endforeach;?>
                        </tr>
                        <tr>
                          <?php foreach($master_kondisi as $kon):?>
                            <th>Tipe</th>
                            <th>Kondisi</th>
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
                        <td><?php echo $r->nama_jembatan?></td>
                        <td><?php echo $r->nama_ruas_jalan?></td>
                        <td><?php echo $r->nama_kecamatan?></td>
                        <td><?php echo $r->panjang_ruas?></td>
                        <td><?php echo $r->lebar_ruas?></td>
                        
                        <?php $sql_type = $this->db->query("SELECT b.nama as tipe, c.nama as kondisi from list_kondisi_jembatan_map as a
                          left join master_type_detail_jembatan as b on a.id_type = b.id
                          left join master_kondisi as c on c.id = a.id_kondisi_detail
                          where id_lokasi='".$r->id_lokasi."'");
                        if($sql_type->num_rows()>0){
                        foreach ($sql_type->result() as $key => $value) {
                            echo "<td>".$value->tipe."</td>";
                            echo "<td>".$value->kondisi."</td>";
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
  
    <script type="text/javascript">
      table = $('.datatable').DataTable({
            responsive: true,
            "ordering": false,
            columnDefs: [
              { visible: false, targets: 1 }
            ],
            "dom": 'Bfrtip',
            "buttons": [
             {
                 "text": '<i class="fa fa-download"></i>&nbsp;&nbsp;Download',
                 "titleAttr": 'Download',
                 "className": 'btn btn-primary ExportDialog',
                 "action" : download_excel
             },
            ],
        });

      $('#table tbody').on('click', 'tr', function () {
        var data = table.row( this ).data();
        // alert( 'You clicked on '+data[1]+'\'s row' );
        alert( 'View Data On Map ' );
        window.location.href="<?php echo site_url('index.php/home/show_detail')?>/"+data[1];
    });

      function download_excel(){
        var myurl='<?php echo base_url().'index.php/home/excel_jembatan'; ?>';
        window.location = myurl;
    }
    </script>