<nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
	<div class="container-fluid">
		<a class="navbar-brand js-scroll-trigger" href="<?= base_url()?>"><img src="assets/home2/images/logo-navbar.png" alt=""></a>
			<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
			Menu
			<i class="fas fa-bars"></i>
		</button>
		
		<div class="collapse navbar-collapse" id="navbarResponsive">
			<ul class="navbar-nav text-uppercase ml-auto">
				<li class="nav-item">
					<a class="nav-link js-scroll-trigger" href="#ppid">PPID</a>
				</li>
				<li class="nav-item">
					<a class="nav-link js-scroll-trigger" href="#struktur">Struktur</a>
				</li>
				<li class="nav-item">
					<a class="nav-link js-scroll-trigger" href="#visi-misi">Visi Misi</a>
				</li>
				<li class="nav-item">
					<a class="nav-link js-scroll-trigger" href="#alur-informasi">Permohonan Informasi</a>
				</li>
				<!-- <li class="nav-item">
					<a class="nav-link js-scroll-trigger" href="#sengketa-informasi">Sengketa Informasi</a>
				</li> -->
				<li class="nav-item">
					<a class="nav-link js-scroll-trigger" href="#icon-formulir">Formulir</a>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle " href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					Dokumen Informasi	
					</a>
					<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
					<a class="dropdown-item" href="#dokumen" onclick="link_dokumen(1)">Informasi Data dan Dokumen Pelayanan Informsi Publik</a>
					<a class="dropdown-item" href="#dokumen" onclick="link_dokumen(2)">Daftar Informasi Publik</a>
					</div>
				</li>
			</ul>
		</div>
	</div>
</nav>

<script>
	function link_dokumen(id){
		$("#dokumen").show();
		
		
		// window.location.href = '<?= base_url('dokumen?key=') ?>'+id;
		$("#iframe_dokumen").each(function(){
			// $(this).attr("src", $(this).data("src"));
			$(this).attr("src", '<?= base_url('dokumen?key=') ?>'+id);
		}); 
		
	}


</script>