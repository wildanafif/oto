  <?php

                  date_default_timezone_set('Asia/Jakarta');
               function time_since($original)
              {
                date_default_timezone_set('Asia/Jakarta');
                $chunks = array(
                    array(60 * 60 * 24 * 365, 'tahun'),
                    array(60 * 60 * 24 * 30, 'bulan'),
                    array(60 * 60 * 24 * 7, 'minggu'),
                    array(60 * 60 * 24, 'hari'),
                    array(60 * 60, 'jam'),
                    array(60, 'menit'),
                );

                $dayList = array(
                  'Sun' => 'Minggu',
                  'Mon' => 'Senin',
                  'Tue' => 'Selasa',
                  'Wed' => 'Rabu',
                  'Thu' => 'Kamis',
                  'Fri' => 'Jumat',
                  'Sat' => 'Sabtu'
                );
               
                $today = time();
                $since = $today - $original;
               
                if ($since > 604800)
                { 
                  $temp_hari = date("D", $original);
                  $print = $dayList[$temp_hari];
                  $print .= date(" ,d  M Y", $original);
                  // if ($since > 31536000)
                  // {
                  //   $print .= ", KGHSK " . date("Y", $original);
                  // }
                  return $print;
                }
               
                for ($i = 0, $j = count($chunks); $i < $j; $i++)
                {
                  $seconds = $chunks[$i][0];
                  $name = $chunks[$i][1];
               
                  if (($count = floor($since / $seconds)) != 0)
                    break;
                }
               
                $print = ($count == 1) ? '1 ' . $name : "$count {$name}";
                return $print . ' yang lalu';
              }

                ?>

<div class="top-header">        
        <div class="container">
        <div class="top-head" >            
                <div class="search"  >
            <div class="top-heade">
                <form name="prov" method="GET" action="<?php echo site_url(); ?>search/cari">
                       <input type="text" name="kategori" id="s_kategori" placeholder="Pilih Kategori" readonly >
            </div>
                </div>
                <div class="search"  >
            <div class="top-heade">
               
                       <input type="text" name="wilayah" id="txtSearch" placeholder="Pilih Wilayah" readonly >
            </div>
                </div>
            <div class="search">
                <div class="top-heade">
                        <input type="text"  name="sesuatu" placeholder="Cari Sesuatu" >
                        <button id='search-button' type='submit' style="margin-top:-2px;"><span>Search</span></button></div>    
</div>                    
                    </form>
                <div class="clearfix"> </div>
        </div>
        </div>
    </div>
        <!---->

</div>
<div class= "modal fade" id= "myModaldaftar" tabindex= "-1" role= "dialog" aria-labelledby= "myModalLabel" aria-hidden= "true" >
   <div class= "modal-dialog" >
    <div class= "modal-content" style="width:100%">

<div class="panel panel-default">
            <div class="panel-heading">
              <center><h3 class="panel-title">Pilih<small> Provinsi</small>  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"> &times; </span></button></h3></center>
            </div>
            <div class="panel-body">
            
             <div class="col-md-4"><a href="" onClick="addProv('jawa timur')"  data-dismiss="modal" disabled style=";"><i><b>jawa timur</b></i> </a></div>
             <div class="col-md-4"><a href="" onClick="addProv('jawa barat')"  data-dismiss="modal" disabled style=";"><i><b>jawa barat</b></i> </a></div>
               </div>
          </div>
         </div>
        </div> 
      </div>

<div style="margin-bottom:20px;" ></div>

         
        <div class="container">
         <h2 style="margin-bottom:25px;"></h2>
         <div class="hilang">
        <div class="well well-sm">
        <strong>Category Title</strong>
        <div class="btn-group">
            <a href="#" id="list" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-th-list">
            </span>List</a> <a href="#" id="grid" class="btn btn-default btn-sm"><span
                class="glyphicon glyphicon-th"></span>Grid</a>
        </div>
       
    </div>
    </div>
    

        <div class="row">
       
          <div class="col-md-12">
           
      
    <div id="products" class="row list-group">
        <?php
                               if(isset($produk)){
                                foreach($produk as $data_produk){ ?>
                                <?php   $wkt=strtotime($data_produk['tgl']);
                                  $lama_posting=time_since($wkt); ?> 
     
       
        <div class="item  col-xs-4 col-lg-4 list-group-item">
            <div class="thumbnail">
                <img class="group list-group-image" src="<?=base_url()?><?php echo $data_produk['temp_foto']; ?>" alt="" />
                <div class="caption">
                    <h5 class="group inner list-group-item-heading">
                       <p style="float:right;"class="hilang" >di posting : <?php echo $lama_posting; ?></p>

                       <a href="<?php echo site_url()?>iklan/view/<?php echo $data_produk['id_iklan']; ?>/<?php echo $data_produk['waktu']; ?>"><?php echo $data_produk['judul_iklan']; ?></a> <p class="" style="float:; margin-top:10px; margin-bottom:10px;" >
                               <?php 
                               $format_indonesia20 = number_format ($data_produk['harga'], 2, ',', '.');
                               echo "Rp. ".$format_indonesia20; ?></p></h5>
                    <p class="group inner list-group-item-text">
                       <?php echo $data_produk['kategori']; ?> >> <?php echo $data_produk['sub_kategori']; ?></p>
             
                            <p class="" style="margin-bottom:5px;" >
                              <?php echo $data_produk['daerah']; ?> -  <?php echo $data_produk['provinsi']; ?> </p>
                             <p class="muncul" >di posting : <?php echo $lama_posting; ?></p>
                </div>
            </div>
        </div>

          <?php
                 }
                            
                        ?>
                         
    </div>
     <div  ><center><?php echo $halaman;?></center> <?php }else{  ?> <center><h3>Tidak ada hasil untuk pencarian ini</h3></center> <?php } ?></div>

          </div>
             
        </div>
    

</div>        
      
        

