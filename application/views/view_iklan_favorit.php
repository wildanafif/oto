<div id="simpleModal" class="modal">
<div class="mdl-content" id="o">
<center>
<img src="<?=base_url()?>assets/images/loading.gif" /></center>

</div>

<!-- Button close -->
<a href="" id="boxclose"></a>
</div>

<div class="container">
  <div class="row">
     <div class="account-wall" style="widht:100%; margin-bottom:80px;">
     <div class="container">
       
          <div class="panel panel-default">
          <div class="panel-heading"><h3>Iklan Favorit</h3></div>
            <div class="panel-body">
              <div>

                  <!-- Nav tabs -->
                  <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" ><a href="<?php echo site_url(); ?>iklansaya" >Iklan Saya</a></li>
                    <li role="presentation" ><a href="<?php echo site_url()?>profil/setting">Setting</a></li>
                    <li role="presentation" class="active"><a href="#" >Iklan Favorit</a></li>
                  </ul>

                  <!-- Tab panes -->
                  <div class="tab-content">

                    <div role="tabpanel" class="tab-pane active" id="profile">
                      
                       <div class="row">
                          <div class="col-md-12">
                             <hr>
                             <div id="products" class="row list-group">
        <?php
                               if(isset($produk)){
                                foreach($produk as $data_produk){ ?>
     
                                 
                                  <div class="item  col-xs-4 col-lg-4 list-group-item">
                                      <div class="thumbnail">
                                          <img class="group list-group-image" src="<?=base_url()?><?php echo $data_produk['temp_foto']; ?>" alt="" />
                                          <div class="caption">
                                                <a href="<?= base_url()?>favorite/hapus/<?php echo $data_produk['id_iklan'].'/'.$data_produk['waktu']; ?>" type="button" class="btn btn-info hilang" style="float:right;">Hapus dari Favorit</a>
                                              <h5 class="group inner list-group-item-heading">
                                                 <a href="<?php echo site_url()?>iklan/view/<?php echo $data_produk['id_iklan']; ?>/<?php echo $data_produk['waktu']; ?>"><?php echo $data_produk['judul_iklan']; ?></a> <p class="" style="float:; margin-top:10px; margin-bottom:10px;" >
                                                         <?php 
                                                         $format_indonesia20 = number_format ($data_produk['harga'], 2, ',', '.');
                                                         echo "Rp. ".$format_indonesia20; ?></p></h5>
                                              <p class="group inner list-group-item-text">
                                                 <?php echo $data_produk['kategori']; ?> >> <?php echo $data_produk['sub_kategori']; ?></p>
                                       
                                                      <p class="" style="margin-bottom:5px;" >
                                                        <?php echo $data_produk['daerah']; ?> -  <?php echo $data_produk['provinsi']; ?> </p>
                                                   <a href="<?= base_url()?>favorite/hapus/<?php echo $data_produk['id_iklan'].'/'.$data_produk['waktu']; ?>"   class="muncul" ><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Hapus dari favorit</a>
                                          </div>
                                      </div>
                                  </div>

                                    <?php


                                                              // $no++;
                                                              // $this->table->add_row(
                                                              // $no,
                                                              // $data_produk['kategori'],
                                                              // $data_produk['judul_iklan'],
                                                              // $data_produk['provinsi']
                                                              // ); 
                                                          }
                                                      
                                                  ?>
                                                   
                              </div>
                               <div  ><center><?php echo $halaman;?></center> </div>
                                  <?php }else{ ?>
                          <div class="row" > <div class="container" >                               <div class="alert alert-success" role="alert">Anda belum menambahkan iklan favorit</div>
</div> </div>
                                <?php } ?>   
                          </div>
                        </div>
                    </div>
                  
                  </div>

                </div>
            </div>
          </div>
     
     </div>
      
                
                
            </div>
  </div>
</div>
</div>
</div>

<script type="text/javascript">
$(document).ready(function() {
    // Generate a simple captcha
    function randomNumber(min, max) {
        return Math.floor(Math.random() * (max - min + 1) + min);
    };
    $('#captchaOperation').html([randomNumber(1, 100), '+', randomNumber(1, 200), '='].join(' '));

    $('#defaultForm').bootstrapValidator({
//        live: 'disabled',
        message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'icon-white icon-user',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            nama: {
                group: '.col-lg-4',
                validators: {
                    notEmpty: {
                        message: 'The first name is required and cannot be empty'
                    }
                }
            },
           
          
            email: {
                validators: {
                   notEmpty: {
                        message: 'The password is required and cannot be empty'
                    },
                    emailAddress: {
                        message: 'The input is not a valid email address'
                    }
                }
            },
            password: {
                validators: {
                    notEmpty: {
                        message: 'The password is required and cannot be empty'
                    },
                    identical: {
                        field: 'confirmPassword',
                        message: 'The password and its confirm are not the same'
                    },
                    different: {
                        field: 'username',
                        message: 'The password cannot be the same as username'
                    }
                }
            },
            confirmPassword: {
                validators: {
                    notEmpty: {
                        message: 'The confirm password is required and cannot be empty'
                    },
                    identical: {
                        field: 'password',
                        message: 'The password and its confirm are not the same'
                    },
                    different: {
                        field: 'username',
                        message: 'The password cannot be the same as username'
                    }
                }
            },
           
            captcha: {
                validators: {
                    callback: {
                        message: 'Wrong answer',
                        callback: function(value, validator) {
                            var items = $('#captchaOperation').html().split(' '), sum = parseInt(items[0]) + parseInt(items[2]);
                            return value == sum;
                        }
                    }
                }
            }
        }
    });

    // Validate the form manually
    $('#validateBtn').click(function() {
        $('#defaultForm').bootstrapValidator('validate');
    });

    $('#resetBtn').click(function() {
        $('#defaultForm').data('bootstrapValidator').resetForm(true);
    });
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