function numberWithCommas(x) {
		return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

function hitung() {
		var kebutuhan = $("input[name='kebutuhan']:checked").val();
		var model = $("input[name='model']:checked").val();
		var kain = $("input[name='kain']:checked").val();
		var tinggi = $("input[name='tinggi']").val();
		var lebar = $("input[name='lebar']").val();
		if (tinggi < 100) tinggi = 100;
		if (lebar < 100) lebar = 100;
		var luas = tinggi * lebar;

		tinggi = parseInt(tinggi);
		lebar = parseInt(lebar);

		var bahan_kain = (lebar * 3)/100;
		var bahan_kain_vitras = (lebar * 2.6)/100; //edt

		if (model == "triplet" && kain == "blackout") {
		// if (kebutuhan == "gorden" && model == "triplet" && kain == "blackout") {
			var bahan_kain = (lebar * 2.6)/100; //edt
		} else if (kebutuhan == "gordenvitras") {

			
			var bahan_kain = (lebar * 2.6)/100; //edt

			if (kain == "blackout" && model == "minimalis") {
				var bahan_kain = (lebar * 3)/100;
			}

			if (kain == "local") {
				var bahan_lembar	= Math.ceil(lebar/50); // dibulatkan keatas
				var bahan_kain 		= bahan_lembar * ((tinggi+50)/100);
			}
			
		} else if ( kain == "local") {
		// } else if (kebutuhan == "gorden" && kain == "local") {
			var bahan_lembar	= Math.ceil(lebar/50); // dibulatkan keatas
			var bahan_kain 		= bahan_lembar * ((tinggi+50)/100); //edt
		} else if (kebutuhan == "vitras") {
			var bahan_kain = (lebar * 2.6)/100; //edt
		}

		var bahan_rel  = (lebar)/100; //edt

		if (kain == "local" && model == "minimalis") {
			var bahan_ring = bahan_lembar*8;
		} else {
			var bahan_ring = bahan_kain*8;
		}

		var bahan_hook = 1;
		var bahan_tali = 1;

		var harga = {
			'minimalis' : {
									'blackout' : {
													'gorden' : 170000, //kain BO
													'rel' : 60000, //rolet
													'ring' : 3500,
													'hook' : 20000,
													'tali': 30000, //acc
													'vitras' : 85000,
													'vitras_rel' : 40000 //edt
									},
									'local' : {
													'gorden' : 65000,
													'rel' : 60000,
													'ring' : 3500,
													'hook' : 20000,
													'tali': 30000, //acc
													'vitras' : 85000,
													'vitras_rel' : 40000 //edt
									}
			},
			'triplet' : {
									'blackout' : {
													'gorden' : 170000, //kain BO 160.000
													'rel' : 60000, //35000
													'ring' : 3500, //smokring
													'hook' : 20000,
													'tali': 30000, //acc
													'vitras' : 85000, //vitras
													'vitras_rel' : 40000 //edt
									},
									'local' : {
													'gorden' : 65000, //kain local
													'rel' : 40000, // rolet kotak
													'ring' : 3500,
													'hook' : 20000,
													'tali': 30000, //acc
													'vitras' : 85000,
													'vitras_rel' : 40000 //edt
									}
			}
		};

		harga_blind = {
			'rollerblind' : {
									'blackoutsuperior' : 473000, //edt
									'superiordimout' : 385000 //edt
			},
			'vertikalblind' : {
									'blackout' : 292000, // edt
									'dimout' : 192000 //edt
			},
			'horizontalblind' : {
									'deluxeslatting' : 275000, //edt
									'perforatedslatting' : 325000, //edt
									'woodmotiveslatting' : 357000 //edt
			},
			'woddenblind' : {
									'27mm' : 687500, //edt
									'35mm' : 770000, //edt
									'50mm' : 891000 //edt
			},
		};

		$('#contmodel').hide();

		$('.kain').hide();
		$('.rollerblind').hide();
		$('.vertikalblind').hide();
		$('.horizontalblind').hide();
		$('.woddenblind').hide();

		if (kebutuhan == 'rollerblind' ){
			$('.rollerblind').show();
		}else if(kebutuhan == 'vertikalblind' ){
			$('.vertikalblind').show();
		}else if(kebutuhan == 'horizontalblind' ){
			$('.horizontalblind').show();
		}else if(kebutuhan == 'woddenblind' ){
				$('.woddenblind').show();
		} else {
				$('#contmodel').show();
				$('.kain').show();
		}

		var hasilhitung = 0;
		if (kebutuhan == 'rollerblind') {
			hasilhitung = (luas / 10000) * harga_blind['rollerblind'][kain];
			if (isNaN(harga_blind['rollerblind'][kain])) hasilhitung = 0; //edt
		}else if (kebutuhan == 'vertikalblind') {
			hasilhitung = (luas / 10000) * harga_blind['vertikalblind'][kain];
			if (isNaN(harga_blind['vertikalblind'][kain])) hasilhitung = 0;  //eddt
		}else if (kebutuhan == 'horizontalblind') {
			hasilhitung = (luas / 10000) * harga_blind['horizontalblind'][kain];
			if (isNaN(harga_blind['horizontalblind'][kain])) hasilhitung = 0;  //edt
		}else if (kebutuhan == 'woddenblind') {
			hasilhitung = (luas / 10000) * harga_blind['woddenblind'][kain];
			if (isNaN(harga_blind['woddenblind'][kain])) hasilhitung = 0;  //edt
		}else if (kebutuhan == 'vitras') {

			if (tinggi <= 260) { //edt
				hasilhitung += bahan_kain_vitras * harga[model][kain]['vitras'];
				hasilhitung += bahan_tali * harga[model][kain]['tali'];
				hasilhitung += bahan_rel * harga[model][kain]['vitras_rel'];
				hasilhitung = 'Rp. ' + hasilhitung;
			} else { //edt
				hasilhitung = "Silahkan hubungi CS kami"; //edt
			} //edt

		}else if (kebutuhan == 'gorden') {

			if (tinggi <= 260) { //edt

				// hasilhitung += bahan_hook * harga[model][kain]['hook']; 	// edt hapus
				hasilhitung += Math.round(bahan_kain * harga[model][kain]['gorden']);
				hasilhitung += bahan_rel * harga[model][kain]['rel'];
				hasilhitung += bahan_tali * harga[model][kain]['tali'];
					if (model=='minimalis'){
						hasilhitung += bahan_ring * harga[model][kain]['ring'];
					}
					hasilhitung = 'Rp. ' + hasilhitung;
			} else { //edt
				hasilhitung = "Silahkan hubungi CS kami"; //edt
			} //edt

		}else if (kebutuhan == 'gordenvitras') {

			if (parseInt(tinggi) <= 260) { //edt

				

				hasilhitung += bahan_kain * harga[model][kain]['gorden'];
				hasilhitung += bahan_rel * harga[model][kain]['rel'];
				hasilhitung += bahan_tali * harga[model][kain]['tali'];
				

					if (model=='minimalis'){
						console.log("bahan_tali", bahan_ring * harga[model][kain]['ring']);
						hasilhitung += bahan_ring * harga[model][kain]['ring'];
					}

				
				hasilhitung += bahan_kain_vitras * harga[model][kain]['vitras'];
				hasilhitung += bahan_tali * harga[model][kain]['tali']; //ini pakai atau tidak ?
				hasilhitung += bahan_rel * harga[model][kain]['vitras_rel'];

				hasilhitung = 'Rp. ' + hasilhitung;
			} else { //edt
				hasilhitung = "Silahkan hubungi CS kami"; //edt
			} //edt

		}

		// cek tinggi gorden < 260
		if (kebutuhan == 'gorden' || kebutuhan == 'vitras' || kebutuhan == 'gordenvitras') {
			$('#hasilhitung').val(numberWithCommas(hasilhitung));
		} else {
			$('#hasilhitung').val('Rp. ' + numberWithCommas(hasilhitung));
		}

}


hitung();
$("input[name='kebutuhan']").click(function() {
		hitung();
})
$("input[name='model']").change(function() {
		hitung();
})
$("input[name='kain']").change(function() {
		hitung();
})
$("input[name='tinggi']").keyup(function() {
		hitung();
})
$("input[name='lebar']").keyup(function() {
		hitung();
})