<section class="content-header">
	<h1>Selamat datang di Sistem Informasi Kesehatan Daerah (SIMKESDA)</h1>
	<ol class="breadcrumb">
		<li class="active"><i class="fa fa-home"></i> Home</a></li>
	</ol>
</section>
<section class="content">
	<div class="box">
		<div class="box-body text-center">
			<h2>Pilih Aplikasi</h2><hr>

			<?php if (isset($messages)) { ?>
				<div class="alert alert-danger alert-dismissible">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					<strong>Perhatian!</strong> <?=$messages?>
				</div>
			<?php } ?>

			<?php if ($this->session->has_access) { ?>
				<?php $total_app = count($this->session->has_access); ?>
				<?php foreach ($this->session->has_access as $has_access) { ?>
					<div class="col-md-<?=$total_app<=4?(12/$total_app):3?>">
						<!-- small box -->
						<div class="small-box bg-<?= $has_access->scheme ?>">
							<div class="inner">
								<h3><?= $has_access->short_name ?></h3>
								<h4><?= $has_access->nama_app ?></h4>
								<p><?= $has_access->long_name ?></p>
							</div>
							<div class="icon">
								<i class="<?= $has_access->icon ?>"></i>
							</div>
							<?php if ($has_access->app_id==$this->session->app_id && $has_access->access==$this->session->app_access) { ?>
								<span class="small-box-footer">Anda sedang menggunakan aplikasi ini</span>
							<?php } else { ?>
								<a href="switcher?appid=<?= $has_access->app_id ?>&acc=<?=$has_access->access?>" class="small-box-footer">Akses <?= ($has_access->access=='full'?'Administrator':'User') ?> <i class="fa fa-arrow-circle-right"></i>
								</a>
							<?php } ?>
						</div>
					</div>
				<?php } ?>
			<?php } ?>

		</div>
	</div>
</section>