<div class="main-content app-content mt-0">
    <div class="side-app">

        <div class="main-container container-fluid">

            <div class="page-header">
                <h1 class="page-title">Ürün Ekle</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Ürünler</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Ekle</li>
                    </ol>
                </div>
            </div>

            <div class="row ">
                <div class="col-xl-12">
                    <div class="card">
                        <form action="<?= \App\Helpers\Helper::route("/product/store") ?>" method="POST">
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-xl-5">
                                        <label for="name" class="form-label">Ürün Adı</label>
                                        <input class="form-control" placeholder="Ürün Adı" type="text" name="name" id="name">
                                    </div>
                                    <div class="form-group col-xl-5">
                                        <label for="category_id" class="form-label">Kategori Adı</label>
                                        <select id="category_id" name="category_id" class="form-control form-select" data-bs-placeholder="Kategori Seç">
                                            <?php
                                            foreach ($params["categories"] as $key => $value) {
                                            ?>
                                                <option value="<?= $value["id"] ?>"><?= $value["name"] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-xl-2">
                                        <label for="attiributes" class="form-label">Özellik Ekle</label>
                                        <a class="btn btn-info w-100" id="addAttiributes">Özellik Ekle</a>
                                    </div>
                                </div>
                                <div id="attiributesDiv"></div>

                            </div>
                            <div class="card-footer">
                                <button class="btn btn-success w-100">Ekle</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>