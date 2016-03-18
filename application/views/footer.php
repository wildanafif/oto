<!--footer-->
    <div class="footer" style="background-color:#eae9e9;
  bottom:0px;">
        <div class="container">
            <div class="col-md-5 footer-left">
                <a href="<?php echo site_url() ?>"><img src="<?php echo site_url(); ?>assets/img/logoe.png" alt=""></a>
                <p class="footer-class">© 2015 Otomotifstore.com All Rights Reserved  </p>
            </div>
            <div class="col-md-3 footer-middle">
                <ul>
                    <li><a href="<?=base_url()?>about">Tentang Kami</a> </li>
                    <li><a href="<?=base_url()?>tips">Tips Jual Beli Aman</a> </li>
                </ul>
            </div>
            <div class="col-md-4 footer-middle">
                    <li><a href="<?=base_url()?>panduan">Panduan</a> </li>
                    <li><a href="<?=base_url()?>aturan">Aturan Umum</a> </li>
               
               
            </div>
          
            
        </div>
        
<div class= "modal fade" id= "myModalprovinsi" tabindex= "-1" role= "dialog" aria-labelledby= "myModalLabel" aria-hidden= "true" >
   <div class= "modal-dialog" >
        <div class= "modal-content" style="width:100%">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <center><h3 class="panel-title">Pilih<small> Provinsi</small>  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"> &times; </span></button></h3></center>
                </div>
                <div class="panel-body"> 
                    <?php foreach ($prov as $key) {
                        
                     ?>           
                    <div class="col-md-4"  style="margin-top:10px;"><a href="" onClick="addProv('<?php echo $key->nama_provinsi; ?>','<?php echo $key->id_provinsi; ?>')"  data-dismiss="modal" disabled style=";"><i><b><?php echo $key->nama_provinsi; ?></b></i> </a></div>
                    <?php }  ?>
                </div>
            </div>

 
        </div>
    </div> 
</div>

<div class= "modal fade" id= "myModallokasi" tabindex= "-1" role= "dialog" aria-labelledby= "myModalLabel" aria-hidden= "true" >
   <div class= "modal-dialog" >
        <div class= "modal-content" style="width:100%">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="#" onclick="show_modal_prov()" style="float:left;"  > <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Back</a>
                    <center><h3 class="panel-title" id="prov_title">  </h3></center>
                </div>
                <div class="panel-body" id="lokasi_modal">      
                    <div class="col-md-4"><a href="" onClick="add_lokasi('Tuban')"  data-dismiss="modal" disabled style=";"><i><b>Tuban</b></i> </a></div>
                    <div class="col-md-4"><a href="" onClick="add_lokasi('Bojonegoro')"  data-dismiss="modal" disabled style=";"><i><b>Bojonegoro</b></i> </a></div>             
                </div>
            </div>
        </div>
    </div> 
</div>


<div class= "modal fade" id= "modal_kategori" tabindex= "-1" role= "dialog" aria-labelledby= "myModalLabel" aria-hidden= "true" >
   <div class= "modal-dialog" >
        <div class= "modal-content" style="width:100%">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <center><h3 class="panel-title">Pilih<small> Kategori</small>  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"> &times; </span></button></h3></center>
                </div>
                <div class="panel-body">   
                <div class="row">
                  <div class="col-md-6">
                  <div>- Pilih Kategori - </div>
                    <div class="list-group">
                      
                      <a href="#" id="Mobil" class="list-group-item" onClick="add_kategori('Mobil','1')">Mobil</a>
                      <a href="#" id="Motor" class="list-group-item" onClick="add_kategori('Motor','2')">Motor</a>
                      <a href="#" id="Sewa" class="list-group-item" onClick="add_kategori('Sewa','3')">Jasa / Sewa</a>
                    </div>
                    <hr></hr>
                    
                  </div>
                  <div class="col-md-6" id="sub_kategori_modal">
                      
                  </div>
                </div>
                           
                   
                    
                </div>
            </div>

 
        </div>
    </div> 
</div>

 <div id="simpleModal" class="modal">
<div class="mdl-content" id="o">
<center>
<img src="<?=base_url()?>assets/images/loading.gif" /></center>

</div>

<!-- Button close -->
<a href="" id="boxclose"></a>
</div>
        
<script src="<?=base_url()?>assets/js/menu.js"></script>
<script src="<?=base_url()?>assets/plugins/money/jquery.maskMoney.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
      $('#angka1').maskMoney();
      $('#angka2').maskMoney({prefix:'US$'});
      $('#angka3').maskMoney({prefix:'Rp. ', thousands:'.', decimal:',', precision:0});
      $('#harga_satuan_menu_lain').maskMoney();
        $('#harga_menu_modal').maskMoney();
    });
    </script>

<script>
// just for the demos, avoids form submit
jQuery.validator.setDefaults({

  success: "valid"
});
$( "#pasanght_iklan" ).validate({
  rules: {
    telp: {
    
      number: true
    },
     maile: {
    
      email: true
    },
     
  }
});
</script>

<script>
$(document).ready(function() {
    $('#list').click(function(event){event.preventDefault();$('#products .item').addClass('list-group-item');});
    $('#grid').click(function(event){event.preventDefault();$('#products .item').removeClass('list-group-item');$('#products .item').addClass('grid-group-item');});
});

</script>

 
   <script>
$(document).ready(function(){
    $("#txtSearch").click(function(){
        $("#myModalprovinsi").modal();
    });
});
$(document).ready(function(){
    $("#s_kategori").click(function(){
        $("#modal_kategori").modal();
    });
});
</script>

 <script type="text/javascript">
            $(function () {
  $('[data-toggle="popover"]').popover()
});
        </script>
        <script type="text/javascript">
                        $(document).ready(function() {
                            /*
                            var defaults = {
                                containerID: 'toTop', // fading element id
                                containerHoverID: 'toTopHover', // fading element hover id
                                scrollSpeed: 1200,
                                easingType: 'linear' 
                            };
                            */
                            
                            $().UItoTop({ easingType: 'easeOutQuart' });
                            
                        });
                        $(function(){
        //#gallery
        $('#gallery')
            .supergallery({
                animation:{
                    type:'slide'
                },
                other:{
                    loop:false,
                    changePageEvent:'mouseenter'
                }
            })
            .on('pageChangeStart',function(e,num){
                //console.log(e.type,num);
                })
            .on('pageChangeEnd',function(e,num){
                //console.log(e.type,num);
            });


        //#gallery2
        var gallery2 = $.superThumbGallery('#gallery2');
            
    });

function getdaerah_m(val) {
  $("div#simpleModal").addClass("show");
  jQuery.ajax({
  type: "POST",
  url: "<?php echo site_url()?>search_m/get_data_daerah",
  data:'id_provinsi='+val,
  success: function(data){
    $("#daerah_m").html(data);
    $("div#simpleModal").removeClass("show");
  }
  });
}

</script>



                <a href="#" id="toTop" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>

    </div>

</body>
</html>