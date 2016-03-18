<div class="container">
  <div class="row">
     <div class="account-wall" style="widht:100%; margin-bottom:80px;">
     <div class="container">
      <?php if (isset($sukses_edit)) { ?>
      <div style="margin-bottom: 10px;" >
         <a href="<?php echo site_url(); ?>iklansaya" type="button" class="btn btn-primary btn-lg">Kembali ke menu sebelumnya</a>
      </div>
       
       
     <div class="alert alert-success" role="alert">Iklan berhasil di update</div>


      <?php } ?>
      <div class="panel panel-default">
        <div class="panel-heading"><h3>Edit Iklan </h3></div>
        <div class="panel-body">
            <form id="edit_iklan" class="form-horizontal" method="POST" action="<?php echo site_url(); ?>iklan/edit_iklan">
              
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Judul Iklan</label>
                <div class="col-sm-10">
                  <input type="text" required class="form-control" id="inputEmail3" value="<?php echo $iklan['judul_iklan']; ?>"  name="judul_iklan" data-container="body" data-toggle="popover" data-placement="top"data-trigger="focus"  data-content="Tulis Judul yang mampu menarik perhatian para pembeli">
                </div>
              </div>
              <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">Kategori</label>
                <div class="col-sm-10">
                  <select class="form-control" required name="kategori"  onChange="getSubKategori(this.value);">
                    <option></option>
                     <?php foreach ($kategori as $row): ?>
                     <option value="<?php echo $row->id_kategori;  ?>" <?php if ($row->nama_kategori==$iklan['kategori']) {
                      echo "selected";
                      } ?> > <?php echo $row->nama_kategori; ?></option>
                     <?php endforeach; ?>    
                               
                      
                </select>
                </div>
              </div>

              <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">Sub Kategori</label>
                <div class="col-sm-10">
                  <select class="form-control" required id="sub_kategori" name="sub_kategori" >
                         <option value="<?php echo $iklan['sub_kategori']; ?>" ><?php echo $iklan['sub_kategori']; ?></option>
                            
                </select>
                </div>
              </div>

              <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">Kondisi</label>
                <div class="col-sm-10">
                  <select class="form-control" required  name="kondisi" >
                         <option></option>
                         <option <?php if ($iklan['kondisi']=="Baru"): ?>
                           <?php echo "selected" ?>
                         <?php endif ?> >Baru</option>
                         <option <?php if ($iklan['kondisi']=="Bekas"): ?>
                           <?php echo "selected" ?>
                         <?php endif ?>>Bekas</option>
                            
                </select>
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Deskripsi Iklan</label>
                <div class="col-sm-10">
                 <textarea class="form-control" rows="3" required name="deskripsi_iklan" data-container="body" data-toggle="popover" data-placement="top"data-trigger="focus"  data-content="Tuliskan Deskripsi yang menarik , semua informasi penting dari barang atau jasa yang anda tawarkan " ><?php echo $iklan['deskripsi_iklan']; ?></textarea>
                </div>
              </div>
               <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Harga</label>
                <div class="col-sm-10">
                   
                        <input type="number" class="form-control"  name="harga" value="<?php echo $iklan['harga']; ?>" data-container="body" data-toggle="popover" data-placement="top" data-trigger="focus"  data-content="Tuliskan dengan harga yang realistis sesuai dengan kondisi barang ,umur dan kualitas barang "  >

                    <input  <?php if ($iklan['nego']==1) {
                      echo "checked";
                    } ?>  type="checkbox" value="1" name="nego">  Nego
                  </div>
              </div>
     
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">Provinsi</label>
    <div class="col-sm-10">
      <select class="form-control" required name="provinsi"  onChange="getState(this.value);">
             <option></option>
                    <?php foreach ($provinsi as $row): ?>
                     <option value="<?php echo $row->id_provinsi;  ?>" <?php if ($row->nama_provinsi==$iklan['provinsi']) {
                      echo "selected";
                      } ?> > <?php echo $row->nama_provinsi ; ?></option>
                     <?php endforeach; ?>  
                            
    </select>
    </div>
  </div>

  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">Kab / Kota</label>
    <div class="col-sm-10">
      <select class="form-control" required id="state-list" name="daerah" >
             <option value="<?php echo $iklan['daerah']; ?>" > <?php echo $iklan['daerah']; ?> </option>
                
    </select>
    </div>
  </div>


             <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Nama</label>
                <div class="col-sm-10">
                  <input type="text" value="<?php echo $iklan['nama']; ?>" required class="form-control" id="inputEmail3" name="nama"  data-container="body" data-toggle="popover" data-placement="top"data-trigger="focus"  data-content="Tuliskan nama anda dengan benar agar lebih mudah untuk ditemukan " >
                </div>
              </div>

               <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                <div class="col-sm-10">
                  <input type="text" value="<?php echo $iklan['mail']; ?>"
                    id="maile" name="maile" required   class="form-control" id="inputEmail3"   data-container="body" data-toggle="popover" data-placement="top"data-trigger="focus"  data-content="Tuliskan email anda dengan benar ,ini akan membantu anda dalam login tranpa harus melakukan registrasi" >
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">No Telp / HP</label>
                <div class="col-sm-10">
                  <input type="text" required class="form-control" name="telp"          value="<?php echo $iklan['telp']; ?>"
                     data-container="body" data-toggle="popover" data-placement="top"data-trigger="focus"  data-content="Masukkan Nomor telepon" >
                  <input <?php if ($iklan['wa']==1): ?>
                    checked 
                  <?php endif ?> type="checkbox" value="1" name="wa">  Bisa dihubungi lewat whatsap
                </div>
              </div>

               <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Pin BB</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control"  name="pin_bb" id="inputEmail3"          value="<?php echo $iklan['pin_bb']; ?>"
                   data-container="body" data-toggle="popover" data-placement="top"data-trigger="focus"  data-content="Masukkan Pin BB" >
                </div>
              </div>

              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <div class="checkbox">
                    <label>
                       <input name="id_iklan" type="hidden" value="<?php echo $iklan['id_iklan']; ?>">
                     
                    </label>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
               
                  <button class="btn btn-success" type="submit" value="submit" name="submit">Simpan Perubahan</button>


                </div>
              </div>
            </form>

        </div>
      </div>
      
    </div>
  </div>
</div>
</div>
</div>


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