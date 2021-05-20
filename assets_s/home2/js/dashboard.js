var baseUrl = 'https://dev.appdev.id/faradella/';

$.ajax({
		 type: "POST",
		 dataType:"JSON",
		 url: baseUrl+'main/admin/keluarPerbulan',
		 success: function(returnData){
				var dataCharts = [];
				var ctx = document.getElementById("keluarPerbulan").getContext('2d');
				var myChart = new Chart(ctx, {
					type: 'bar',
					data: {
						labels: ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"],
						datasets: [{
							label: '# Record',
							data: returnData,
							backgroundColor: 'rgba(67, 142, 185, 0.6)',
							borderColor: 'rgba(67, 142, 185, 1)',
							borderWidth: 1
						}]
					},
					options: {
						responsive: true,
						scales: {
							yAxes: [{
								ticks: {
									max: 50,
									min: 0,
									stepSize: 10,
									beginAtZero:false
								}
							}]
						},
						title: {
							display: true,
							text: 'Grafik Barang Keluar Perbulan th 2017',
						}
					}
				});
		 }
	});
	
$.ajax({
		 type: "POST",
		 dataType:"JSON",
		 url: baseUrl+'main/admin/keluarPertahun',
		 success: function(returnData){
				var dataCharts = [];
				var ctx = document.getElementById("keluarPertahun").getContext('2d');
				var myChart = new Chart(ctx, {
					type: 'bar',
					data: {
						labels: ['2017','2018','2019','2020', '2021', '2022', '2023', '2024'],
						datasets: [{
							label: '# Record',
							data: returnData,
							backgroundColor: 'rgba(67, 142, 185, 0.6)',
							borderColor: 'rgba(67, 142, 185, 1)',
							borderWidth: 1
						}]
					},
					options: {
						responsive: true,
						scales: {
							yAxes: [{
								ticks: {
									max: 50,
									min: 0,
									stepSize: 10,
									beginAtZero:false
								}
							}]
						},
						title: {
							display: true,
							text: 'Grafik Barang Keluar per Tahun',
						}
					}
				});
		 }
	});
	
