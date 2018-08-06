<div class="product-detail-holder">
        <a href="#" onclick="goBack()" class="btn btn-danger pull-right">Kembali</a>
        <div class="container">
            <form id="sendOrderHitung" action="">
                <div class="col-md-12 col-md-offset-0">
                    <div class="form-group">
                        <label>1. Produk Apa Yang Anda Butuhkan ?</label>
                        <select class="form-control" id="kebutuhan" name="kebutuhan" style="width: 100%;">
                            <option value="gorden">Gorden</option>
                            <option value="vitras">Vitras</option>
                            <option value="gordenvitras">Gorden & Vitras</option>
                            <option value="rollerblind">Roller Blind</option>
                            <option value="vertikalblind">Vertikal Blind</option>
                            <option value="horizontalblind">Horizontal Blind</option>
                            <option value="woddenblind">Wodden Blind</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-12 col-md-offset-0" id="contmodel">
                    <div class="form-group">
                        <label>2. Pilihan Model Yang Tersedia</label>
                        <select class="form-control" id="model" name="model" style="width: 100%;">
                            <option value="minimalis">Minimalis/ Smoke Ring</option>
                            <option value="triplet">Triplet</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-12 col-md-offset-0">
                    <div class="form-group">
                        <label>* Pilihan Bahan ?</label>
                        <select class="form-control" id="kain_1" name="kain_1" style="width: 100%;">
                            <option value="">Pilih Bahan</option>
                            <option value="blackout">Kain Blackout</option>
                            <option value="local">Kain Lokal</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-12 col-md-offset-0">
                    <div class="form-group">
                        <label>* Dimensi (Tinggi x Lebar) ?</label>
                        <div>
                            <input type="number" name="tinggi" placeholder="tinggi" maxlength="5" style="width: 55px" value="100"/>
                            <span class="add-on">cm</span>
                        
                            <input type="number" name="lebar" placeholder="lebar" maxlength="5" style="width: 55px; margin-left: 10px;" value="100"/>
                            <span class="add-on">cm</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-md-offset-0">
                    <div class="form-group">
                        <label>* Pilihan Kualitas</label>
                        <select class="form-control" id="kualitas" name="kualitas" style="width: 100%;">
                            <option value="3">Premium</option>
                            <option value="2.6">Gold</option>
                            <option value="2.3">Silver</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-12 col-md-offset-0">
                    <div class="form-group">
                        <label>* Estimasi Harga ?</label>
                        <input type="text" class="form-control" style="font-size: 30px; height: auto;" name="total" id="hasilhitung" readonly="readonly">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script type="text/javascript">
        function goBack() {
            window.history.back();
        }
    </script>