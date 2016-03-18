
    


    <div class="top-header">        
        <div class="container">
        <div class="top-head" >

        <div class="panel panel-default">
  <div class="panel-heading"><h3>Pasang Iklan</h3></div>


  <div class="panel-body" >


    <form id="pasang_iklan" action="<?php echo site_url()?>iklan" method="POST" enctype="multipart/form-data"  class="form-horizontal">
  

  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Judul Iklan</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="inputEmail3"  name="judul_iklan" data-container="body" data-toggle="popover" data-placement="top"data-trigger="focus"  data-content="Tulis Judul yang mampu menarik perhatian para pembeli">
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">Kategori</label>
    <div class="col-sm-10">
      <select class="form-control" required name="kategori"  onChange="getSubKategori(this.value);">
        <option></option>
            <?php foreach ($kategori as $roww): ?>
                <option value="<?php echo $roww->id_kategori; ?>"><?php echo $roww->nama_kategori; ?></option>
                  <?php endforeach; ?> 
          
    </select>
    </div>
  </div>

  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">Sub Kategori</label>
    <div class="col-sm-10">
      <select class="form-control" required id="sub_kategori" name="sub_kategori" >
             <option></option>
                
    </select>
    </div>
  </div>

  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">Kondisi</label>
    <div class="col-sm-10">
      <select class="form-control" required  name="kondisi" >
             <option></option>
             <option>Baru</option>
             <option>Bekas</option>
                
    </select>
    </div>
  </div>


    <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">Upload Foto</label>
    <div class="col-sm-10">
     
            <!-- filer 2 -->
            <a  class="file_input" data-jfiler-name="files" data-jfiler-extensions="jpg, jpeg, png, gif"><i class="icon-jfi-paperclip"></i> Tambahkan Gambar</a>
            
            <br>
            
           
      Max Size 2mb dan jumlah maksimal 10 gambar
        
    </div>     
    </div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Deskripsi Iklan</label>
    <div class="col-sm-10">
     <textarea class="form-control" rows="3" required name="deskripsi_iklan" data-container="body" data-toggle="popover" data-placement="top"data-trigger="focus"  data-content="Tuliskan Deskripsi yang menarik , semua informasi penting dari barang atau jasa yang anda tawarkan " ></textarea>
    </div>
  </div>
   <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Harga</label>
    <div class="col-sm-10">
       
            <input type="text" class="form-control hilang"  id="harga_satuan_menu_lain" ata-affixes-stay="true" data-prefix="Rp. " data-thousands="." data-decimal="," name="harga" data-container="body" data-toggle="popover" data-placement="top" data-trigger="focus"  data-content="Tuliskan dengan harga yang realistis sesuai dengan kondisi barang ,umur dan kualitas barang "  >
            <input type="number" class="form-control muncul"  name="harga_mobile" data-container="body" data-toggle="popover" data-placement="top" data-trigger="focus"  data-content="Tuliskan dengan harga yang realistis sesuai dengan kondisi barang ,umur dan kualitas barang "  >
        <input  type="checkbox" value="1" name="nego">  Nego
      </div>
  </div>
  <h1>Info Kontak</h1>
  <hr>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">Provinsi</label>
    <div class="col-sm-10">
      <select class="form-control" required name="provinsi"  onChange="getState(this.value);">
             <option></option>
              <?php foreach ($data as $row): ?>
                <option value="<?php echo $row->id_provinsi; ?>" <?php if (isset($_SESSION['provinsi'])) {
                  # code...
                if ($row->nama_provinsi==$_SESSION['provinsi']) {
                                                               echo "selected";
                                                            }} ?>><?php echo $row->nama_provinsi; ?></option>
                  <?php endforeach; ?>          
    </select>
    </div>
  </div>

  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">Kab / Kota</label>
    <div class="col-sm-10">
      <select class="form-control" required id="state-list" name="daerah" >
             <option><?php if (isset($_SESSION['daerah'])) {
              echo $_SESSION['daerah'];
             } ?></option>
                
    </select>
    </div>
  </div>


 <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Nama</label>
    <div class="col-sm-10">
      <input type="text" <?php if (isset($_SESSION['nama'])){ ?>
        value="<?php echo $_SESSION['nama']; ?>"
      <?php } ?> required class="form-control" id="inputEmail3" name="nama"  data-container="body" data-toggle="popover" data-placement="top"data-trigger="focus"  data-content="Tuliskan nama anda dengan benar agar lebih mudah untuk ditemukan " >
    </div>
  </div>

   <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
    <div class="col-sm-10">
      <input type="text" <?php if (isset($_SESSION['email'])){ ?>
        value="<?php echo $_SESSION['email']; ?>"
      <?php } ?>  id="maile" name="maile"   class="form-control" id="inputEmail3"   data-container="body" data-toggle="popover" data-placement="top"data-trigger="focus"  data-content="Tuliskan alamat email anda dengan benar " >
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">No Telp / HP</label>
    <div class="col-sm-10">
      <input type="text" required class="form-control" name="telp"  <?php if (isset($_SESSION['telp'])){ ?>
        value="<?php echo $_SESSION['telp']; ?>"
      <?php } ?>   data-container="body" data-toggle="popover" data-placement="top"data-trigger="focus"  data-content="Masukkan Nomor telepon" >
      <input  type="checkbox" value="1" name="wa">  Bisa dihubungi lewat whatsap
    </div>
  </div>

   <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Pin BB</label>
    <div class="col-sm-10">
      <input type="text" class="form-control"  name="pin_bb" id="inputEmail3"  <?php if (isset($_SESSION['pin_bb'])){ ?>
        value="<?php echo $_SESSION['pin_bb']; ?>"
      <?php } ?> data-container="body" data-toggle="popover" data-placement="top"data-trigger="focus"  data-content="Masukkan Pin BB" >
    </div>
  </div>

  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <div class="checkbox">
        <label>
        <?php if (isset($_SESSION['id_member'])) {
          ?>
            <input type="hidden" value="<?php echo $_SESSION['id_member']; ?>" >
          <?php
        } ?>
          <input  type="checkbox" name="acc">Dengan ini  Saya setuju dengan ketentuan yang berlaku di otomotifstore.com dan saya setuju untuk memproses pemasangan iklan 
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
   
      <button class="btn btn-success" type="submit" value="submit" name="pasang">Simpan</button>


    </div>
  </div>
</form>
                
  </div>
</div>


            
                
            
                <div class="clearfix"> </div>
        </div>
        </div>
    </div>
    </div>
        <!---->

 <script type="text/javascript">
$(document).ready(function() {
    $('#pasang_iklan')
        .bootstrapValidator({
            message: 'This value is not valid',
            //live: 'submitted',
            feedbackIcons: {
                valid: 'icon-white icon-checkmark',
                invalid: 'icon-white icon-close',
                validating: 'icon-spinner-5'
            },
            fields: {
                judul_iklan: {
                    
                    validators: {
                        notEmpty: {
                            message: '<div class="alert alert-danger"  role="alert"><h6>Judul iklan Tidak Boleh Kosong</h6></div>'
                        },
                        stringLength: {
                            min: 10,
                            
                            message: '<div class="alert alert-danger"  role="alert"><h6>Judul iklan minimal 10 karakter</h6></div>'
                        },
                        /*remote: {
                            url: 'remote.php',
                            message: 'The username is not available'
                        },*/
                       
                    }
                },
                kategori: {
                    validators: {
                        notEmpty: {
                            message: '<div class="alert alert-danger"  role="alert"><h6>Kategori iklan Tidak Boleh Kosong</h6></div>'
                        }
                    }
                },
                sub_kategori: {
                    validators: {
                        notEmpty: {
                            message: '<div class="alert alert-danger"  role="alert"><h6>Sub Kategori iklan Tidak Boleh Kosong</h6></div>'
                        }
                    }
                },
                 kondisi: {
                    validators: {
                        notEmpty: {
                            message: '<div class="alert alert-danger"  role="alert"><h6>Kondisi barang Tidak Boleh Kosong</h6></div>'
                        }
                    }
                },
                deskripsi_iklan: {
                    validators: {
                         notEmpty: {
                            message: '<div class="alert alert-danger"  role="alert"><h6>Deskripsi iklan Tidak Boleh Kosong</h6></div>'
                        },
                        stringLength: {
                            min: 20,
                            
                            message: '<div class="alert alert-danger"  role="alert"><h6>Deskripsi iklan minimal 20 karakter</h6></div>'
                        },
                    }
                },
                provinsi: {
                    validators: {
                         notEmpty: {
                            message: '<div class="alert alert-danger"  role="alert"><h6>Provinsi Tidak Boleh Kosong</h6></div>'
                        }
                      
                    }
                },
                 daerah: {
                    validators: {
                         notEmpty: {
                            message: '<div class="alert alert-danger"  role="alert"><h6>Daerah Tidak Boleh Kosong</h6></div>'
                        }
                      
                    }
                },
                nama: {
                    validators: {
                         notEmpty: {
                            message: '<div class="alert alert-danger"  role="alert"><h6>Nama Tidak Boleh Kosong</h6></div>'
                        }
                      
                    }
                },
                telp: {
                    validators: {
                         notEmpty: {
                            message: '<div class="alert alert-danger"  role="alert"><h6>Telepon Tidak Boleh Kosong</h6></div>'
                        },
                         digits: {
                            message: '<div class="alert alert-danger"  role="alert"><h6>Format salah</h6></div>'
                        }
                      
                    }
                },
                pin_bb: {
                    validators: {
                        stringLength: {
                            min: 8,
                            Max:9,
                            
                            message: '<div class="alert alert-danger"  role="alert"><h6>Format Pin min 8 karakter Max 8 karakter</h6></div>'
                        },
                      
                    }
                },
            maile: {
              
                validators: {
                   notEmpty: {
                            message: '<div class="alert alert-danger"  role="alert"><h6>Email Tidak Boleh Kosong</h6></div>'
                        },
                    emailAddress: {
                        message: '<div class="alert alert-danger"  role="alert"><h6>Format email salah</h6></div>'
                    }
                }
            },
            'acc': {
                validators: {
                    notEmpty: {
                        message: '<div class="alert alert-danger"  role="alert"><h6>Silahkan Centang persetujuan Untuk proses iklan</h6></div>'
                    }
                }
            }

            }
        })
      
});
</script>
<script>
function getState(val) {
  $("div#simpleModal").addClass("show");
  jQuery.ajax({
  type: "POST",
  url: "<?php echo site_url()?>iklan/view_daerah",
  data:'country_id='+val,
  success: function(data){
    $("#state-list").html(data);
    $("div#simpleModal").removeClass("show");
  }
  });
}


function getSubKategori(val) {
  $("div#simpleModal").addClass("show");
  jQuery.ajax({
  type: "POST",
  url: "<?php echo site_url()?>iklan/view_sub_kategori",
  data:'id_sub='+val,
  success: function(data){
    $("#sub_kategori").html(data);
    $("div#simpleModal").removeClass("show");
  }
  });
}

</script>