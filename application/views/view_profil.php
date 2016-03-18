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
          <div class="panel-heading"><h3>Profil</h3></div>
            <div class="panel-body">
              <div>

                  <!-- Nav tabs -->
                  <ul class="nav nav-tabs" role="tablist">
                    <li ><a href="<?php echo site_url(); ?>iklansaya" >Iklan Saya</a></li>
                    <li role="presentation" <?php if ($class_active=='setting') {
                       echo 'class="active"';
                    } ?> ><a href="<?php echo site_url()?>profil/setting" >Setting</a></li>
                    <li role="presentation"><a href="<?php echo site_url()?>favorite" >Iklan Favorit</a></li>
                  
                  </ul>

                  <!-- Tab panes -->
                  <div class="tab-content">

                    <div role="tabpanel" class="tab-pane" id="profile">...</div>
                    <div role="tabpanel" class="tab-pane active" id="home">
                        <div class="row">
                          <div class="col-md-6">
                             <hr>
                         <?php if (isset($perbarui) && $perbarui=1) {
          # code...
                        ?>
                          
                             <div class="alert alert-success fade in" role="alert">
                                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                  <strong>Sukses Memperbarui Profil Anda</strong>
                             </div>   <?php } ?>
                                     <form class="form-horizontal" method="POST" action="<?php echo site_url(); ?>user/perbarui">
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                                            <div class="col-sm-10">
                                              <input type="text" class="form-control" id="inputEmail3" name="email" value="<?php echo $profil['email'];  ?>"  readonly="" >
                                        </div>
                                          </div>
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Nama</label>
                                            <div class="col-sm-10">
                                              <input type="text" class="form-control" id="inputEmail3" name="nama" value="<?php echo $profil['nama'];  ?>"   >
                                        </div>
                                          </div>
                                            <div class="form-group">
                                                <label for="inputPassword3" class="col-sm-2 control-label">Provinsi</label>
                                                <div class="col-sm-10">
                                                  <select class="form-control" required name="provinsi"  onChange="getState(this.value);">
                                                        <option></option>
                                                          <?php foreach ($data as $row): ?>
                                                            <option value="<?php echo $row->id_provinsi;  ?>" <?php if ($row->nama_provinsi==$profil['provinsi']) {
                                                               echo "selected";
                                                            } ?> > <?php echo $row->nama_provinsi; ?></option>
                                                              <?php endforeach; ?>          
                                                </select>
                                                </div>
                                              </div>

                                              <div class="form-group">
                                                <label for="inputPassword3" class="col-sm-2 control-label">Kab / Kota</label>
                                                <div class="col-sm-10">
                                                  <select class="form-control" required id="state-list" name="daerah" >
                                                         <option> <?php echo $profil['daerah']; ?> </option>
                                                            
                                                </select>
                                                </div>
                                              </div>
                                          <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Telp</label>
                                            <div class="col-sm-10">
                                              <input type="text" class="form-control" id="inputEmail3" name="telp" value="<?php echo $profil['telp'];  ?>" >
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label for="inputPassword3" class="col-sm-2 control-label">Pin BB</label>
                                            <div class="col-sm-10">
                                              <input type="text" class="form-control" id="inputPassword3" name="pin_bb" value="<?php echo $profil['pin_bb'] ;?>" >
                                            </div>
                                          </div>
                                         
                                          <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                              <button type="submit" class="btn btn-primary">Save</button>
                                            </div>
                                          </div>
                                        </form>
                                     
                          </div>
                        </div>
                        
                       
                    </div>
                    <div role="tabpanel" class="tab-pane" id="messages">...</div>
                    <div role="tabpanel" class="tab-pane" id="settings">...</div>
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