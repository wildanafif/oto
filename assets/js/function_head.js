
  function addProv(textToAdd , id){
  document.prov.wilayah.value = textToAdd;
   $("div#simpleModal").addClass("show");
   $('#prov_title').html('Provinsi : '+textToAdd + '<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"> &times; </span></button>');
   $.ajax({
        type: 'POST',
        url: '<?php echo site_url()?>search/data_lokasi_modal',
        data:'id_provinsi='+id,
        success: function(data) {   
            $("div#simpleModal").removeClass("show");                  
            $('#lokasi_modal').html(data);
            $("#myModallokasi").modal();
            
        }
    });
 
}
 function add_lokasi(textToAdd){
  document.prov.wilayah.value += '->'+textToAdd;
   
 
}
function show_modal_prov(){
    $("#myModallokasi").modal('hide');
    $("#myModalprovinsi").modal('show');
}

function add_kategori(add , id){
    document.prov.kategori.value = add;
    if (true) {};
    if (add=='Mobil') {
        $("#Motor").attr("class", "list-group-item");
        $("#Sewa").attr("class", "list-group-item");
    }else if(add=='Motor'){
        $("#Mobil").attr("class", "list-group-item");
        $("#Sewa").attr("class", "list-group-item");
    }else if (add=='Sewa') {
        $("#Mobil").attr("class", "list-group-item");
        $("#Motor").attr("class", "list-group-item");
    };
    $("div#simpleModal").addClass("show");
     $("#"+add).attr("class", "list-group-item active");
       $.ajax({
            type: 'POST',
            url: '<?php echo site_url()?>search/data_kategori',
            data:'id_kategori='+id+'&nama_kategori='+add,
            success: function(data) {    
                $('#sub_kategori_modal').hide();                 
                $('#sub_kategori_modal').html(data);
                $("div#simpleModal").removeClass("show");
                $('#sub_kategori_modal').show('slow');
                
                
            }
        });

}

function add_modal_sub_kategori(nama_sub_kategori){
     document.prov.kategori.value +=nama_sub_kategori;
      $("#modal_kategori").modal('hide');
     
};

