<?php

if(isset($_POST['tgl_pinjam'])){
    $response = $db->insertOne($_POST, "pinjam");

    if($response){
        header("location: ?module=pinjam&routes=index&create-success=true");
    }else{ ?>
        <div class="alert alert-danger">
            Gagal Dibuat
        </div>
    <?php }
}

$anggota = $db->find([], "anggota");
$buku = $db->find([], "buku");

$anggota_list = [];
$buku_list = [];

foreach($anggota as $row){
    $anggota_list[$row->nrp] = $row->nama;
}

foreach($buku as $row){
    $buku_list[$row->kode_buku] = $row->judul;
}

function buildOption($lists, $selected){
    $template = "";

    foreach($lists as $key => $val){
        $is_select = "";
        if($key == $selected) $is_select = "selected";
        $template .= "<option value='$key' $is_select>$val</option>\n";
    }

    return $template;
}


?>

<div class="row">
    <div class="col-md-8">
        <h1>Crete pinjam</h1>
    </div>
</div>

<form class="form" action="" method="POST">
    <div class="mb-3">
        <label for="">Anggota</label>
        <select name="nrp" class="form-control">
            <option value="">-- Pilih Anggota --</option>
            <?= buildOption($anggota_list, $_POST['nrp']) ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="">Buku</label>
        
        <select name="kode_buku" class="form-control">
            <option value="">-- Pilih Buku --</option>
            <?= buildOption($buku_list, $_POST['kode_buku']) ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="">Tanggal Pinjam</label>
        <input type="date" name="tgl_pinjam" class="form-control" value="<?= ($_POST['tgl_pinjam']) ?? "" ?>">
    </div>
    <div class="mb-3">
        <button class="btn btn-primary" value="submit">Submit</button>
        <a href="?module=pinjam&routes=index" class="btn btn-warning">Kembali</a>
    </div>
</form>