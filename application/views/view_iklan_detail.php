<div class="content">
	<div class="container">

	<div class="row">
	<div class="container" style="margin-top:10px;">
		
	<div class="panel panel-default">
  <div class="panel-body">
  <?php 	$sub_kategori=str_replace(" ", "-",$iklan['sub_kategori']); ?>
  	<a href="<?=base_url()?><?php echo $iklan['kategori']?>/sub_kategori/<?php echo $sub_kategori; ?>/">
  		
     <h3 ><?php echo $iklan['kategori'] ." -> ".$iklan['sub_kategori'];?></h3>
  	</a>
  </div>
</div>
	

	</div>
	
			     
					
				
  <div class="col-md-7">
<div class="panel panel-default">
  <div class="panel-heading">
  	<h3><?php echo $iklan['judul_iklan']; ?></h3><br>
  	<div class="row">
		  <div class="col-md-6">
		  <?php
		  	$provinsi=str_replace(" ", "-",$iklan['provinsi']);
		  	$daerah=str_replace(" ", "-",$iklan['daerah']);
		  ?>
		  <a href="<?=base_url()?>search/page_location/<?php echo $provinsi; ?>+<?php echo $daerah; ?>">
		  	<h5 style="color:#e6005c;"><span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span> <?php echo $iklan['daerah'].' - '.$iklan['provinsi']; ?></h5> 
		  </a>
		  	
		  </div>
		  <div class="col-md-2">
		  	<h5 ><span class="glyphicon glyphicon-bookmark" aria-hidden="true"></span><?php echo $iklan['kondisi'] ?></h5>
		  </div>
		  <?php if (isset($_SESSION['id_user'])) { ?>
		  
		  <div class="col-md-4">
			  <a href="<?=base_url()?>favorite/add/<?php echo $iklan['id_iklan']; ?>/<?php echo  $iklan['waktu'] ?>">
			   	<h5 style="color:#0099cc;"><span class="glyphicon glyphicon-star-empty" aria-hidden="true"></span> Tambahkan favorit</h5>
			  </a>
		  </div>
		  <?php } ?>
	</div>
  	
  </div>
  <div class="panel-body">
    <center class="hilang">
	<div id="myGallery" >
	<?php $foto_mobile ; $no=1;foreach ($foto as $key => $roww) {
		# code...
	 ?>
		<li><img src="<?=base_url()?><?php echo $roww->url_foto_iklan; ?>" alt="" />
		<?php if ($no==1) {
			$foto_mobile=$roww->url_foto_iklan;
		} ?>
	
		<?php ; $no++; } ?>
		
	</div>
</center>


<center class="muncul">
	<img src="<?=base_url()?><?php echo $foto_mobile; ?>" class="img-responsive" alt="Responsive image">
	<hr>
	<?php if ($no>2) { ?>
		
		<a href="<?php echo site_url(); ?>iklan/show_image/<?php echo $id; ?>/1" >Gambar Selanjutnya</a>
	<?php } ?>
</center>

<div class="alert alert-success muncul" style="background-color:#FFEE7E;margin-top:4%;" role="alert"><label  class="add-to" style="margin-top:0px;text-align:center;"><?php  $format_indonesia20 = number_format ($iklan['harga'], 2, ',', '.'); echo "Rp. ".$format_indonesia20; ?></label>
     	 <center><b><h4><?php if ($iklan['nego']==0) {
					  	echo "Tidak Nego";
					  }else{
					  	echo "Nego";
					  	}  ?></h4></b>
 </div>
<br>
<div id="horizontalTab" style="display: block; width: 100%; margin: 0px;">
						  <ul class="resp-tabs-list">
						  	  <li class="resp-tab-item " aria-controls="tab_item-0" role="tab"><span>Deskripsi </span></li>
							  
							  <div class="clearfix"></div>
						  </ul>				  	 
							<div class="resp-tabs-container">
							    <h2 class="resp-accordion resp-tab-active" role="tab" aria-controls="tab_item-0"><span class="resp-arrow"></span>Product Description</h2><div class="tab-1 resp-tab-content resp-tab-content-active" aria-labelledby="tab_item-0" style="display:block">
									<div class="facts">
									 	<?php echo $iklan['deskripsi_iklan']; ?>        
							        </div>
							    	</div>
							     									
							  
					      </div>

					 </div>
					 <hr>
					      Dilihat : <?php echo $iklan['dilihat']; ?>

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
							 
							  $today = time();
							  $since = $today - $original;
							 
							  if ($since > 604800)
							  {
							    $print = date("M jS", $original);
							    if ($since > 31536000)
							    {
							      $print .= ", " . date("Y", $original);
							    }
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
					      <?php
					      	$wkt=strtotime($iklan['tgl']);
					       $lama_posting=time_since($wkt); ?>

					      <div>Diposting : <?php echo $lama_posting; ?></div>
  </div>
</div>








</div>
  <div class="col-md-5">
  
     
     <div class="alert alert-success hilang" style="background-color:#FFEE7E;" role="alert"><label  class="add-to" style="margin-top:0px;text-align:center;"><?php  $format_indonesia20 = number_format ($iklan['harga'], 2, ',', '.'); echo "Rp. ".$format_indonesia20; ?></label>
     	 <center><b><h4><?php if ($iklan['nego']==0) {
					  	echo "Tidak Nego";
					  }else{
					  	echo "Nego";
					  	}  ?></h4></b></center>
     </div>
  	<div class="alert alert-info" role="alert" style="margin-top:10px;">
  		<span class="glyphicon glyphicon-user" aria-hidden="true" style="float:left; margin-right:30px; margin-left:20px;"></span>
  		<b style="float:left;"><h4>Nama : <?php echo $iklan['nama']; ?></h4></b>
  		<br><br>
  		<div><?php if ($iklan['user_register']==1) { ?>
  			<center> <a href="<?=base_url()?>iklan/c/<?php echo $iklan['id_user']; ?>"> Lihat Iklan Lainnya</a> </center>
  		<?php
  		}  ?></div>
  		
  		<hr>
  		<span class="glyphicon glyphicon-phone-alt" aria-hidden="true" style="float:left; margin-right:30px; margin-left:20px;"></span>
  		<b style="float:left;"><h4><?php if (isset($iklan['telp'])) {
					  	echo "Telp : ".$iklan['telp'];
					  }  ?></h4></b> <br><br>
					  <?php if ($iklan['wa']==1) { ?>
					  			<p style="text-align:center;">Bisa Di hubungi Via Whatsap</p> 

			
							<?php } ?>
  		
  		<hr>
  			<span class="glyphicon glyphicon-phone" aria-hidden="true" style="float:left; margin-right:30px; margin-left:20px;"></span>
  		<b style="float:left;"><h4>Pin BB : <?php echo $iklan['pin_bb']; ?></h4></b>
  		<br>
  	</div>
  	<div class="alert alert-warning alert-dismissible" role="alert">
		  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		  <strong><h2 style="color:#ffa31a;">Tips untuk setiap pembelian</h2></strong>
		   <p style="margin-top:5%;">- Usahakan ketemuan/COD</p>
		   <p>- Cari informasi penjual</p>
		   <center style="margin-top:5%;">
		   	<a href="<?php echo site_url(); ?>tips" ><h3>Baca Selengkapnya >> </h3></a>
		   </center>
		   
	</div>
		<div class="share-buttons" style="margin-bottom: 20px;">
					<!-- Facebook -->
					<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $share; ?>" title="Share on Facebook" target="_blank" class="btn btn-facebook"><i class="icon-white icon-facebook"></i> Facebook</a>
					<!-- Twitter -->
					<a href="http://twitter.com/home?status=<?php echo $share; ?>" title="Share on Twitter" target="_blank" class="btn btn-twitter"><i class="icon-white icon-twitter"></i> Twitter</a>
					<!-- Google+ -->
					<a href="https://plus.google.com/share?url=<?php echo $share; ?>" title="Share on Google+" target="_blank" class="btn btn-googleplus"><i class="icon-white icon-google"></i> Google+</a>
					
					<!-- LinkedIn --> 
					<a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=&amp;title=&amp;summary=<?php echo $share; ?>" title="Share on LinkedIn" target="_blank" class="btn btn-stumbleupon"><i class="icon-white  icon-linkedin"></i>LinkedIn</a>
				</div>

  </div>
</div>
</div>
</div>
</div>
		