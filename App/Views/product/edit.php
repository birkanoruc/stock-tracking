<div class="main-content app-content mt-0">
    <div class="side-app">

        <div class="main-container container-fluid">

            <div class="page-header">
                <h1 class="page-title">Ürün Düzenle</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Ürünler</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Düzenle</li>
                    </ol>
                </div>
            </div>

            <div class="row ">
                <div class="col-xl-12">
                    <div class="card">
                        <form action="<?= \App\Helpers\Helper::route("/product/update/{$params["product"]["id"]}") ?>" method="POST">
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-xl-5">
                                        <label for="name" class="form-label">Ürün Adı</label>
                                        <input class="form-control" placeholder="Ürün Adı" type="text" name="name" id="name" value="<?= $params["product"]["name"] ?>">
                                    </div>
                                    <div class="form-group col-xl-5">
                                        <label for="category_id" class="form-label">Kategori Adı</label>
                                        <select id="category_id" name="category_id" class="form-control form-select" data-bs-placeholder="Kategori Seç">
                                            <?php
                                            foreach ($params["categories"] as $key => $value) {
                                            ?>
                                                <option <?php if ($value["id"] == $params["product"]["category_id"]) {
                                                            echo "selected";
                                                        } ?> value="<?= $value["id"] ?>"><?= $value["name"] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-xl-2">
                                        <label for="attiributes" class="form-label">Özellik Ekle</label>
                                        <a class="btn btn-info w-100" id="addAttiributes">Özellik Ekle</a>
                                    </div>
                                    <div id="attiributesDiv">
                                        <?php
                                        if (count(json_decode($params["product"]["attributes"], true)) != 0) {
                                            foreach (json_decode($params["product"]["attributes"], true) as $key => $value) {
                                        ?>
                                                <div class="row">
                                                    <div class="col-xl-5">
                                                        <label class="form-label">Ürün Özellik Adı</label>
                                                        <input class="form-control attributesCount" type="text" name="attributes[<?= $key ?>][name]" value="<?= $value["name"] ?>">
                                                    </div>
                                                    <div class="col-xl-5">
                                                        <label class="form-label">Ürün Özellik Değeri</label>
                                                        <input class="form-control" type="text" name="attributes[<?= $key ?>][value]" value="<?= $value["value"] ?>">
                                                    </div>
                                                    <div class="form-group col-xl-2">
                                                        <label for="deleteAttributes" class="form-label">Sil</label>
                                                        <button type="button" class="btn btn-danger w-100 text-light" id="deleteAttributes"><i class="fa fa-trash"></i></button>
                                                    </div>
                                                </div>
                                        <?php
                                            }
                                        }
                                        ?>

                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-success w-100">Düzenle</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>