<script src='https://www.google.com/recaptcha/api.js'></script>
<link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/css/slider-pro.min.css">
<script type='text/javascript' src="<?= base_url()?>assets/js/jquery.sliderPro.min.js"></script>





<section id="berita" class="cid-berita mbr-fullscreen mt-3" data-rv-view="1620">
	<div class="container">
        <div class="row">
            <div class="col-md-12">

                <div class="media-container-row align-center">
                    <h1 id="tag_judul">
                        <a style="pointer-events: none;" href="" id="teks_judul" rel="bookmark"><?php echo $artikel['judul'];?></a>
                    </h1>
                </div>

                <div class="media-container-row align-center">
                    <span class="datetime">
                        <datetime="<?php echo $artikel['create_date'];?>"><?php echo indonesian_date($artikel['create_date']);?></datetime>
                    </span>
                </div>

                <div class="media-container-row align-center">
                    <div id="rny_newsgall" class="slider-pro">
                        <div class="sp-slides">
                            <?php 
                            $linkkota = 'https://tangerangkota.go.id/';
								if(!empty($artikel['gallery']))
								{
									foreach($artikel['gallery'] as $gal)
									{

							?>
                            <div class="sp-slide">
                                <img class="sp-image" src="<?php echo $linkkota;?>assets/modules/berita/css/images/blank.gif"

                                    data-src="<?php echo $linkkota.$gal['foto'];?>"  alt="<?php echo $artikel['judul'];?>"/>
                            </div>
							
							<?php }}else {
                            ?>
                                <div class="sp-slide">
                                <img class="sp-image" src="<?php echo $linkkota;?>assets/modules/berita/css/images/blank.gif"

                                    data-src="<?php echo $linkkota.$artikel['foto'];?>"  alt="<?php echo $artikel['judul'];?>"/>
                                </div>
                            <?php

                            }?>

                        </div>
						
						

                        <div class="sp-thumbnails">
							<?php 
								if(!empty($artikel['gallery']))
								{
									foreach($artikel['gallery'] as $gal)
									{

							?>
                            <img class="sp-thumbnail" src="<?php echo $linkkota.$gal['foto'];?>"/>
							<?php }}?>
                        </div>
						
						
                    </div>
                </div>

                <div class="media-container-row align-center">
                    <article id="maincontent" class="maincontent">
                        <?php echo $artikel['content'];?>
						<?php //print_r($this->uri->segment(3));?>
                    </article>
                </div>
				
				
                


                    <!-- Post /////-->

                    
            </div>


        </div>
	</div>				
</section>

<script type="text/javascript">
			$(document).ready(function(){
				
					$('#rny_newsgall').sliderPro({
						width: 860,
						height: 500,
						fade: true,
						arrows: true,
						buttons: false,
						fullScreen: false,
						shuffle: true,
						smallSize: 500,
						mediumSize: 800
					});
				});
		</script>