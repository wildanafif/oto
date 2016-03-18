<div class="container">
  <div class="row">
     <div class="account-wall" style="widht:100%; margin-bottom:80px;">
     <div class="container">
       
       <?php if (isset($login) && $login==0) {
          # code...
        ?>
          <div class="alert alert-danger fade in" role="alert">
              <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
              <strong>Login gagal!</strong> Cek kembali username dan password anda atau akun anda masih belum aktif.
          </div>   <?php } ?>
     </div>
      
                
                <form class="form-signin" action="<?=base_url()?>auth/" method="POST" style="margin-top:-2%;">
                <div class="panel panel-success" >
              <div class="panel-heading" style="background-color:#4975b7;text-align:left; color:#fff; ">Login</div>
            
              <div class="panel-body" >
                  <center style="margin-left:-10px;"><img  style="height:120px;" src="<?=base_url()?>assets/img/user.png"
                    alt=""></center>
                     <br>
                <input type="text" class="form-control" name="username" placeholder="Email" required autofocus>
                <input type="password" class="form-control" placeholder="Password" name="password" required>
                <button class="btn btn-lg btn-primary btn-block" type="submit">Masuk</button>
                  <div style="border-bottom: 3px solid #E6E6E6;padding-bottom: 7px;margin-bottom: 10px;"></div>
                <a href="<?=base_url()?>auth/login_facebook" class="btn btn-lg btn-info btn-block"><i class="icon-white icon-facebook-3"> </i> Masuk Dengan Facebook</a>
                <hr >
                <p style="text-align:center;margin-top:-32px;">Atau</p>
                 <h3><a href="<?=base_url()?>auth/register" class="text-center new-account">Daftar Sekarang</a></h3>
                 
              </div></div>



              
                </form>
            </div>
  </div>
</div>
</div>