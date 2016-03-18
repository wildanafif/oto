<div class="container">
  <div class="row">
     <div class="account-wall" style="widht:100%; margin-bottom:80px;">
     <div class="container">
       
       <div class="row">
        <div class="col-md-8">
          <div class="panel panel-default">
          <div class="panel-heading"><h3>Daftar Menjadi Member</h3></div>
            <div class="panel-body">
            <?php if (isset($cek)) { ?>
            
                <div class="alert alert-danger alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <strong><h3>Alamat Email Sudah Terdaftar</h3></strong>
                </div>
            <?php } ?>
              <form id="defaultForm" method="post" class="form-horizontal" action="<?php echo site_url();?>user/register_member">
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Nama Lengkap</label>
                            <div class="col-lg-5">
                                <input type="text" class="form-control" name="nama" placeholder="Nama Lengkap" />
                            </div>
                            
                        </div>

                        

                        <div class="form-group">
                            <label class="col-lg-3 control-label">Email</label>
                            <div class="col-lg-5">
                                <input type="text" class="form-control" placeholder="Email" name="email" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-3 control-label">Password</label>
                            <div class="col-lg-5">
                                <input type="password" class="form-control" placeholder="Password" name="password" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-3 control-label">Retype password</label>
                            <div class="col-lg-5">
                                <input type="password" class="form-control" placeholder="Ulangi Password" name="confirmPassword" />
                            </div>
                        </div>

                        

                        <div class="form-group">
                            <label class="col-lg-3 control-label" id="captchaOperation"></label>
                            <div class="col-lg-2">
                                <input type="text" class="form-control" name="captcha" />
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-9 col-lg-offset-3">
                                <button class="btn btn-success" type="submit" value="submit" name="pasang">Simpan</button>
                            </div>
                        </div>
                    </form>
            </div>
          </div>
        </div>
        <div class="col-md-4">

            <div class="alert alert-success hilang" role="alert" style="background-color:#674D90;">
                <h5 style="color:#fff;" >Dengan Mendaftarkan akun anda ke otomotifstore.com akan memudahkan anda dalam mengelola iklan </h5>
            </div>
             <div class="alert alert-success hilang" role="alert" style="background-color:#674D90;">
                <h5 style="color:#fff;" >Anda juga dapat menambahkan iklan favorit anda</h5>
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