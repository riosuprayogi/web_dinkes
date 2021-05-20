<style>

	h1 span {
		display: block;
	}
	h1{
		position:relative; 
		z-index: 500; 
		left: 45%;
	}
	.ppid{
		font-size: 100pt;
	}

	@media only screen and (max-width: 768px) {
	/* For mobile phones: */
		h1{
			position:relative; 
			z-index: 500; 
			left: 0 !important;
		}
		.ppid{
			font-size: 50pt;
		}
	}
</style>
<section class="carousel slide cid-sekilas" data-interval="false" id="slider1-4g" data-rv-view="1003">
    <div class="full-screen">
		<div class="mbr-slider slide carousel" data-pause="true" data-keyboard="false" data-ride="false" data-interval="false">
			<ol class="carousel-indicators">
			<?php $i = 1 ?>
				<?php foreach($image as $row) { ?>
				<li data-app-prevent-settings="" data-target="#slider1-4g" class=" <?php echo $i == 1? 'active':'' ?>" data-slide-to="0"></li>
				<?php $i++; } ?>
			</ol>

			
			
			<div class="carousel-inner" role="listbox">
				<?php $i = 1 ?>
				<?php foreach($image as $row) { ?>
					<div class="carousel-item slider-fullscreen-image <?php echo $i == 1? 'active':'' ?>" data-bg-video-slide="false" style="background-image: url(<?php echo base_url('assets/media/image/').$row->image ?>);">
						<div class="container container-slide">
							<div class="image_wrapper">
								<img src="<?php echo base_url('assets/media/image/').$row->image ?>">
							</div>
							<div class="carousel-caption" style="height:100%; right:52%;">
								<h1>
									<span  class="font-weight-bold ppid">PPID</span>
									<span>Kota Tangerang</span>
								</h1>
								<div class="carousel-caption float-left align-middle" style="height:100%; background-color:	#769a87; opacity:0.9;">
								</div>
							</div>
						</div>
					</div>
				<?php $i++; } ?>
				<!-- <div class="carousel-item slider-fullscreen-image" data-bg-video-slide="false" style="background-image: url(<?php echo base_url();?>assets/home2/modules/ppid/images/banner-ppid.png);">
					<div class="container container-slide">
						<div class="image_wrapper">
							<img src="<?php echo base_url();?>assets/home2/modules/ppid/images/banner-ppid.png">
						</div>
						<div class="carousel-caption float-center align-middle" style="height:100%">
						<h1><span class="font-weight-bold">PPID</span><span>Kota Tangerang</span></h1>
						</div>
					</div>
				</div> -->
			</div>
			
			<!-- <div class="carousel-inner" role="listbox">
				<div class="carousel-item slider-fullscreen-image" data-bg-video-slide="false" style="background-image: url(<?php echo base_url();?>assets/home2/modules/ppid/images/banner-ppid.png);">
					<div class="container container-slide">
						<div class="image_wrapper">
							<img src="<?php echo base_url();?>assets/home2/modules/ppid/images/banner-ppid.png">
						</div>
						<div class="carousel-caption float-center align-middle" style="height:100%">
						<h1><span class="font-weight-bold">PPID</span><span>Kota Tangerang</span></h1>
						</div>
					</div>
				</div>
				
				<div class="carousel-item slider-fullscreen-image active" data-bg-video-slide="false" style="background-image: url(<?php echo base_url();?>assets/home2/modules/ppid/images/banner-ppid.png);">
					<div class="container container-slide">
						<div class="image_wrapper">
							<img src="<?php echo base_url();?>assets/home2/modules/ppid/images/banner-ppid.png">
						</div>
					</div>
				</div>
			</div> -->
			
			<a data-app-prevent-settings="" class="carousel-control carousel-control-prev" role="button" data-slide="prev" href="#slider1-4g"><span aria-hidden="true" class="mbri-left mbr-iconfont"></span><span class="sr-only">Previous</span></a>
			<a data-app-prevent-settings="" class="carousel-control carousel-control-next" role="button" data-slide="next" href="#slider1-4g"><span aria-hidden="true" class="mbri-right mbr-iconfont"></span><span class="sr-only">Next</span></a>
		</div>
	</div>
</section>