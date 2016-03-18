<div class="container">
  <div class="row">
     <div class="account-wall" style="widht:100%; margin-bottom:80px;">
     
      
                <div class="container row">
                  <div class="col-md-5">
                    <div class="panel panel-default">
                    <div class="panel-heading"><h3 style="text-align:center;">Otomofifstore.com</h3></div>
                    <div class="panel-body" style="background-color:#f5f5f5;" >
                    <br> 
                    <a href="<?=base_url()?>about">
                        <h4 
                      <?php if ($aktif=="about") { ?>
                      style="color:#21aee8;"
                      <?php } else{
                        echo 'style="color:#000000;"';
                        }?>
                        > <i class="icon-point-right"></i> Tentang otomotifstore.com</h4>

                   </a>
                      <hr >
                       <a href="<?=base_url()?>tips">
                        <h4 
                      <?php if ($aktif=="tips") { ?>
                      style="color:#21aee8;"
                      <?php }else{
                        echo 'style="color:#000000;"';
                        } ?>
                        > <i class="icon-point-right"></i> Tips Jual Beli Aman</h4>

                   </a>
                      <hr >
                        <a href="<?=base_url()?>panduan">
                        <h4 
                      <?php if ($aktif=="panduan") { ?>
                      style="color:#21aee8;"
                      <?php }else{
                        echo 'style="color:#000000;"';
                        } ?>
                        > <i class="icon-point-right"></i> Panduan otomotifstore.com</h4>

                   </a>
                      <hr >

                       <a href="<?=base_url()?>aturan">
                        <h4 
                      <?php if ($aktif=="aturan") { ?>
                      style="color:#21aee8;"
                      <?php }else{
                        echo 'style="color:#000000;"';
                        } ?>
                        > <i class="icon-point-right"></i> Aturan Umum</h4>

                   </a>
                      <hr >
                    </div>
                  </div>
                  </div>
                  <div class="col-md-7">
                    <div  style=" border-bottom: 3px solid #E6E6E6;padding-bottom: 7px; margin-bottom:10px;"><h1><b><?php echo $judul_konten; ?></b></h1></div>
                    <p><?php echo $isi_konten; ?></p>
                    
                  </div>
                </div>
            </div>
  </div>
</div>
</div>