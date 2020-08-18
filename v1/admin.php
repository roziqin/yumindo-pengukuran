<?php include "header.php"; ?>
<?php include "sidebar.php"; ?>
  

  
<?php include "kontent-admin.php" ; ?>
<?php include "footer.php" ?>
    <script type="text/javascript">
            function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }
        $('#contmodel').show();

    function hitung() {
        var kebutuhan = $("#kebutuhan :selected").val();
        var model = $("#model :selected").val();
        var kualitas = $("#kualitas :selected").val();
        var kain = $("#kain_1 :selected").val();
        var tinggi = $("input[name='tinggi']").val();
        var lebar = $("input[name='lebar']").val();
        if (tinggi < 100) tinggi = 100;
        if (lebar < 100) lebar = 100;
        var luas = tinggi * lebar;

        var bahan_kain = (lebar * kualitas)/100;
        var bahan_rel = lebar / 100;
        var bahan_ring = bahan_kain*8;
        var bahan_hook = 1;
        var bahan_tali = 1;

        var harga = {
            'minimalis' : {
                    'blackout' : {
                            'gorden' : 160000,
                            'rel' : 60000,
                            'ring' : 3500,
                            'hook' : 20000,
                            'tali': 30000,
                            'vitras' : 85000,
                            'vitras_rel' : 40000
                    },
                    'local' : {
                            'gorden' : 65000,
                            'rel' : 60000,
                            'ring' : 3500,
                            'hook' : 20000,
                            'tali': 30000,
                            'vitras' : 85000,
                            'vitras_rel' : 35000
                    },
                    '' : {
                            'gorden' : 0,
                            'rel' : 0,
                            'ring' : 0,
                            'hook' : 0,
                            'tali': 0,
                            'vitras' : 0,
                            'vitras_rel' : 0

                    }
            },
            'triplet' : {
                    'blackout' : {
                            'gorden' : 160000,
                            'rel' : 35000,
                            'ring' : 3500,
                            'hook' : 20000,
                            'tali': 30000,
                            'vitras' : 85000,
                            'vitras_rel' : 35000
                    },
                    'local' : {
                            'gorden' : 65000,
                            'rel' : 35000,
                            'ring' : 3500,
                            'hook' : 20000,
                            'tali': 30000,
                            'vitras' : 85000,
                            'vitras_rel' : 35000
                    },
                    '' : {
                            'gorden' : 0,
                            'rel' : 0,
                            'ring' : 0,
                            'hook' : 0,
                            'tali': 0,
                            'vitras' : 0,
                            'vitras_rel' : 0

                    }
            }
        };

        harga_blind = {
            'rollerblind' : {
                    'blackoutsuperior' : 415000,
                    'superiordimout' : 310000
            },
            'vertikalblind' : {
                    'blackout' : 270000,
                    'dimout' : 177000
            },
            'horizontalblind' : {
                    'deluxeslatting' : 254000,
                    'perforatedslatting' : 300000,
                    'woodmotiveslatting' : 330000
            },
            'woddenblind' : {
                    '27mm' : 625000,
                    '35mm' : 700000,
                    '50mm' : 810000
            },
        };


        $('.kain').hide();
        $('.rollerblind').hide();
        $('.vertikalblind').hide();
        $('.horizontalblind').hide();
        $('.woddenblind').hide();

        

        var hasilhitung = 0;
        if (kebutuhan == 'rollerblind') {
            hasilhitung = (luas / 10000) * harga_blind['rollerblind'][kain];
        }else if (kebutuhan == 'vertikalblind') {
            hasilhitung = (luas / 10000) * harga_blind['vertikalblind'][kain];
        }else if (kebutuhan == 'horizontalblind') {
            hasilhitung = (luas / 10000) * harga_blind['horizontalblind'][kain];
        }else if (kebutuhan == 'woddenblind') {
            hasilhitung = (luas / 10000) * harga_blind['woddenblind'][kain];
        }else if (kebutuhan == 'vitras') {
            hasilhitung += bahan_kain * harga[model][kain]['vitras'];
            hasilhitung += bahan_rel * harga[model][kain]['vitras_rel'];
        }else if (kebutuhan == 'gorden') {
            hasilhitung += bahan_kain * harga[model][kain]['gorden'];
            console.log(hasilhitung + " - ");
            hasilhitung += bahan_rel * harga[model][kain]['rel'];
            console.log(hasilhitung + " - ");
            hasilhitung += bahan_hook * harga[model][kain]['hook'];
            console.log(hasilhitung + " - ");
            hasilhitung += bahan_tali * harga[model][kain]['tali'];
            console.log(hasilhitung + " - ");
            if (model=='minimalis') 
                hasilhitung += bahan_ring * harga[model][kain]['ring'];
        }else if (kebutuhan == 'gordenvitras') {
            hasilhitung += bahan_kain * harga[model][kain]['gorden'];
            hasilhitung += bahan_rel * harga[model][kain]['rel'];
            hasilhitung += bahan_hook * harga[model][kain]['hook'];
            hasilhitung += bahan_tali * harga[model][kain]['tali'];
            if (model=='minimalis') 
                hasilhitung += bahan_ring * harga[model][kain]['ring'];
            

            console.log(hasilhitung + " - ");


            hasilhitung += bahan_kain * harga[model][kain]['vitras'];
            console.log(hasilhitung + " - ");
            hasilhitung += bahan_rel * harga[model][kain]['vitras_rel'];

            
            console.log(hasilhitung + " - ");
        }
        $('#hasilhitung').val('Rp ' + numberWithCommas(hasilhitung));
    }

    function jeniskain () {
        var kebutuhan = $("#kebutuhan :selected").val();
        if (kebutuhan == 'rollerblind' ){
            //$('.rollerblind').show();

            $('#contmodel').hide();
            $('#kain_1').empty();
            $('#kain_1').append('<option value="">Pilih Bahan</option>');
            $('#kain_1').append('<option value="blackoutsuperior">Black Out Superior</option>');
            $('#kain_1').append('<option value="superiordimout">Superior Dim Out</option>');

        }else if(kebutuhan == 'vertikalblind' ){
            //$('.vertikalblind').show();
            $('#contmodel').hide();
            $('#kain_1').empty();
            $('#kain_1').append('<option value="">Pilih Bahan</option>');
            $('#kain_1').append('<option value="blackout">Black Out</option>');
            $('#kain_1').append('<option value="dimout">Dim Out</option>');

        }else if(kebutuhan == 'horizontalblind' ){
            //$('.horizontalblind').show();
            $('#contmodel').hide();
            $('#kain_1').empty();
            $('#kain_1').append('<option value="">Pilih Bahan</option>');
            $('#kain_1').append('<option value="deluxeslatting">Deluxes Slatting</option>');
            $('#kain_1').append('<option value="perforatedslatting">Perforated Slatting</option>');
            $('#kain_1').append('<option value="woodmotiveslatting">Wood Motive Slatting</option>');

        }else if(kebutuhan == 'woddenblind' ){
            //$('.woddenblind').show();
            $('#contmodel').hide();
            $('#kain_1').empty();
            $('#kain_1').append('<option value="">Pilih Bahan</option>');
            $('#kain_1').append('<option value="27mm">Wodden Blind 27mm</option>');
            $('#kain_1').append('<option value="35mm">Wodden Blind 35mm</option>');
            $('#kain_1').append('<option value="50mm">Wodden Blind 50mm</option>');

        } else {
            //$('.kain').show();
            $('#kain_1').empty();
            $('#kain_1').append('<option value="">Pilih Bahan</option>');
            $('#kain_1').append('<option value="blackout">Kain Blackout</option>');
            $('#kain_1').append('<option value="local">Kain Lokal</option>');
        }
    }


    hitung();
    $("#kebutuhan").change(function() {
         hitung();
         jeniskain();
    })
    $("#model").change(function() {
        hitung();
    })
    $("#kain_1").change(function() {
        hitung();
    })
    $("#kualitas").change(function() {
        hitung();
    })
    $("input[name='tinggi']").keyup(function() {
        hitung();
    })
    $("input[name='lebar']").keyup(function() {
        hitung();
    })
    </script>
