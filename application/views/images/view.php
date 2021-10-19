<?php 
// echo count($list);
if(count($list)>0): ?>
<div id="carouselExample" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
    <?php 
    
    foreach ($list as $key => $value) { 
      if($key==0){
        $active="active";
      }else{
        $active="";
      }
      ?>
      <div class="carousel-item <?php echo $active?>">
        <img class="d-block w-100" src="<?php echo base_url()?>uploads/image_lokasi3/<?php echo $value->file_path?>">
      </div>
    <?php } ?>
    <!-- <div class="carousel-item active">
      <img class="mySlides" src="https://pbs.twimg.com/media/EXFwTNcUcAE5Ers?format=jpg&name=large" style="width:100%">
    </div> -->
    <!-- <div class="carousel-item active">
      <img class="d-block w-100" src="/image-1.jpg">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="/image-2.jpg">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="/image-3.jpg">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="/image-4.jpg">
    </div> -->
  </div>
  <a class="carousel-control-prev" href="#carouselExample" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExample" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
<?php 
 else:
    echo "Belum Ada Image yang di Upload";
  endif;
  ?>