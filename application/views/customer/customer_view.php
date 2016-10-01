<div class="right_col" role="main">
  <div class="page-title">
    <div class="title_left">
      <h3>Pelanggan <small>Semua Pelanggan</small></h3>
    </div>
  </div>

  <div class="clearfix"></div>

  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Pelanggan <small>Semua Pelanggan</small></h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="#">Settings 1</a>
                </li>
                <li><a href="#">Settings 2</a>
                </li>
              </ul>
            </li>
            <li><a class="close-link"><i class="fa fa-close"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <p class="text-muted font-13 m-b-30">
                      DataTables has most features enabled by default, so all you need to do to use it with your own tables is to call the construction function: <code>$().DataTable();</code>
          </p>
          <a href="<?php echo base_url(); ?>customer/add_form"><button type="button" class="btn btn-success">Tambah</button></a>
          <table id="datatable" class="table table-striped table-bordered">
            <thead>
                <tr>
                  <th>Nama</th>
                  <th>Alamat</th>
                  <th>Organisasi</th>
                  <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
              <?php
                if(!empty($results)){
                  foreach($results as $data) {
                    echo "<tr>
                            <td>".$data->customer_name."</td>
                            <td>".$data->address."</td>
                            <td>".$data->company."</td>
                            <td><a href='".base_url()."customer/edit_form/".$data->customer_id."'>Edit</a> | <a href='".base_url()."customer/delete/".$data->customer_id."' onClick='confirmDelete()'>Delete</a></td>
                          </tr>";
                  }
                }
              ?>
            </tbody>
          </table>

        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
    function confirmDelete(){
        var answer = confirm("Yakin menghapus data ini?");
        return !!answer;
    };
</script>