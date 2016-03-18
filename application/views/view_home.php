  







    <div class="top-header">        
        <div class="container">
        <div class="top-head hilang" >
            
                <div class="search hilang"  style="width:50%;">
            <div class="top-heade">
                <form name="prov" method="GET" action="<?php echo site_url(); ?>search/search_">
                  <input type="text" name="wilayah" id="txtSearch" placeholder="Pilih provinsi" readonly >
            </div>
                    
                        
                    
                </div>
            
            <div class="search" style="width:50%;">
                <div class="top-heade"><input type="text"  name="sesuatu" placeholder="Cari Sesuatu"  >
                        <button id='search-button' type='submit' style="margin-top:-2px;"><span class="glyphicon glyphicon-search" aria-hidden="true"></span><span>Cari</span></button></div>
                        
        </div>
                    
                    </form>

                
            
                <div class="clearfix"> </div>
        </div>
        </div>
  
       
    
 

<!--banner-->


<div class="content">
    <div class="container">
    <div class="row">

        <!--for mobile-->
         <div class="container muncul" style=" margin-top:10px;">
         <form class="form-inline" method="GET" action="<?php echo site_url(); ?>search_m/cari">
         <div class="form-group">
             <select name="provinsi" class="form-control" onChange="getdaerah_m(this.value);">
                  <option value="0">-Pilih Provinsi-</option>
                  <?php
                    foreach ($prov as $key) {
                      ?>
                        <option value="<?php echo $key->id_provinsi; ?>"><?php echo $key->nama_provinsi; ?></option>
                      <?php
                    }
                  ?>
                  
                </select>
            
         </div>
         <div class="form-group" id="daerah_m">
           
         </div>
         <div class="form-group">
            <div class="input-group">
              <input type="text" name="sesuatu" class="form-control" placeholder="Cari sesuatu ...">
              <span class="input-group-btn">
                <button class="btn btn-success" type="submit">Cari!</button>
              </span>
            </div><!-- /input-group -->
           
         </div>
         
          
        </form>
        <div  style=" border-bottom: 3px solid #E6E6E6;padding-bottom: 7px; margin-bottom:10px;"></div>
          <a href="<?php echo site_url()?>iklan" type="button" class="btn btn-primary btn-lg" style="width:100%;">Pasang Iklan</a>
         <div  style=" border-bottom: 3px solid #E6E6E6;padding-bottom: 7px; margin-bottom:10px;"></div>


          <h4>Kategori :</h4>
          <br>
         <a   href="<?php echo site_url()?>Mobil">
         <div class="panel panel-default link_home_mobile" style="webkit-box-shadow: 5px 5px 3px 0px #666666;-moz-box-shadow: 5px 5px 3px 0px #666666;box-shadow: 5px 5px 3px 0px #666666;" >
  
          <div class="panel-body">

            <div class="col-xs-4 col-md-3"><img src="<?=base_url()?>assets/img/lg_mb.png" class="img-responsive"  alt=""></div>
            <div class="col-xs-8 col-md-3" style="margin-top:5%;font-size:175%;">Mobil</div>
          </div>
        </div>
        </a>
        <a  href="<?php echo site_url()?>Motor">
        <div class="panel panel-default link_home_mobile" style="webkit-box-shadow: 5px 5px 3px 0px #666666;-moz-box-shadow: 5px 5px 3px 0px #666666;box-shadow: 5px 5px 3px 0px #666666;">
  
          <div class="panel-body">
            <div class="col-xs-4 col-md-3"><img src="<?=base_url()?>assets/img/lg_mt.png" class="img-responsive"  alt=""></div>
            <div class="col-xs-8 col-md-3" style="margin-top:5%; font-size:175%;">Motor</div>
          </div>
        </div>
        </a>

         <a  href="<?php echo site_url()?>Sewa">
        <div class="panel panel-default link_home_mobile">
  
          <div class="panel-body" style="webkit-box-shadow: 5px 5px 3px 0px #666666;-moz-box-shadow: 5px 5px 3px 0px #666666;box-shadow: 5px 5px 3px 0px #666666;">
            <div class="col-xs-4 col-md-3"><img src="<?=base_url()?>assets/img/lg_sw.png" class="img-responsive"  alt=""></div>
            <div class="col-xs-8 col-md-3" style="margin-top:5%; font-size:175%;">Sewa</div>
          </div>
        </div>
        </a>
                 


         </div>
         
      
    </div>
    <div class="account-wall hilang" style="widht:100%; margin-bottom:80px;">
         <div class="container">
            <div class="row">
              <div class="col-md-4 link_home" >
                  <a   href="<?php echo site_url()?>Mobil"><center><img src="<?=base_url()?>assets/img/lg_mb.png" class="img-responsive " style="height:240px;" alt="">Mobil</center></a>
              </div>
              <div class="col-md-4 link_home" ><a  href="<?php echo site_url()?>Motor"><center><img src="<?=base_url()?>assets/img/lg_mt.png" class="img-responsive" style="height:240px;" alt="">Motor</center></div>
              <div class="col-md-4 link_home" ><a  href="<?php echo site_url()?>Sewa"><center><img src="<?=base_url()?>assets/img/lg_sw.png" class="img-responsive" style="height:240px;" alt="">Sewa</center></a></div>
            </div>
           
         </div>
    </div>
    <h1 class="middle hilang" style="margin-top:50px; margin-bottom:-70px;"><center>Iklan Terbaru</center></h1>
        <div class="col-best">
            
            </div>
           
<div class="row hilang">
   <?php foreach ($iklan as $key ) { ?>
        <a href="<?php echo site_url()?>iklan/view/<?php echo $key->id_iklan; ?>/<?php echo $key->waktu; ?>" >
            <div class="col-xs-6 col-md-3 " >
                <div class="product" style="background-color:#eae9e9; text-align:center;-webkit-box-shadow: 5px 5px 3px 0px #666666;-moz-box-shadow: 5px 5px 3px 0px #666666;box-shadow: 5px 5px 3px 0px #666666;">
                    <center><img src="<?=base_url()?><?php echo $key->temp_foto; ?>" alt="..." class="img-thumbnail"></center>
                    <br>
                    <span style="font-size: 20px; color: #000000; margin-top:20px;";> <?php echo substr($key->judul_iklan, 0,20) ; ?> </span>
                    <br><h4 style="padding-left:10px;padding-top:10px;color:#00bcc9;"><span class="glyphicon glyphicon-tags" aria-hidden="true"></span><b><?php  $format_indonesia20 = number_format ($key->harga, 2, ',', '.'); echo "Rp. ". $format_indonesia20; ?></b></h4> 
                    <br><br> <br> 
                </div>
            </div></a>
       
    <?php
   } ?>

</div>
        
    
        <!---->

            
            <div class="clearfix"> </div>
        </div>
    </div>
    <!---->
      
        

 
    
    </div>
</div>
