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
  
       
   




	<div class="container">
    <form class="form-inline muncul" method="GET" action="<?php echo site_url(); ?>search_m/cari">
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
              <input type="text" name="sesuatu" class="form-control" placeholder="Search for...">
              <span class="input-group-btn">
                <button class="btn btn-success" type="submit">Cari!</button>
              </span>
            </div><!-- /input-group -->
           
         </div>
         
          
        </form>
		<div class="four">
				<h1>404</h1>
			
				<p>The page you're looking for could not be found.</p>
				
					<a href="index.html" class="more go">Go back</a>
				
			</div>
</div>