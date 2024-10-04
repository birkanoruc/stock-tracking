<div class="main-content app-content mt-0">
    <div class="side-app">

        <div class="main-container container-fluid">

            <div class="page-header">
                <h1 class="page-title">Sipariş Düzenle</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Siparişler</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Düzenle</li>
                    </ol>
                </div>
            </div>

            <div class="row ">
                <div class="col-xl-12">
                    <div class="card">
                        <form action="<?= \App\Helpers\Helper::route("/order/update/{$params["order"]["id"]}") ?>" method="POST">
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="customer_id" class="form-label">Müşteri Adı</label>
                                        <select id="customer_id" name="customer_id" class="form-control form-select" data-bs-placeholder="Müşteri Seç">
                                            <?php
                                            foreach ($params["customers"] as $key => $value) {
                                            ?>
                                                <option value="<?= $value["id"] ?>" <?php if ($value["id"] == $params["order"]["customer_id"]) {
                                                                                        echo "checked";
                                                                                    } ?>><?= $value["name"] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="company_name" class="form-label">Şirket Adı</label>
                                        <input class="form-control" placeholder="Şirket Adı" type="text" name="company_name" id="company_name" value="<?= $params["order"]["company_name"] ?>">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="order_date" class="form-label">Sipariş Tarihi</label>
                                        <input class="form-control" placeholder="Sipariş Tarihi" type="date" name="order_date" id="order_date" value="<?= $params["order"]["order_date"] ?>">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="addProduct" class="form-label">Ürün Ekle</label>
                                        <a class="btn btn-info w-100" id="addProduct">Ürün Ekle</a>
                                    </div>
                                </div>
                                <div id="productsDiv">
                                    <?php
                                    if (count(json_decode($params["order"]["products"], true)) != 0) {
                                        foreach (json_decode($params["order"]["products"], true) as $key => $value) {
                                    ?>
                                            <div class="row">
                                                <div class="form-group col-xl-4">
                                                    <label class="form-label">Ürün Adı</label>
                                                    <select class="form-control form-select productCount" data-bs-placeholder="Ürün Seç" name="products[<?= $key ?>][id]">
                                                        <?php
                                                        foreach ($params["products"] as $a => $product) {
                                                        ?>
                                                            <option value="<?= $product["id"] ?>" <?php if ($product["id"] == $value["id"]) {
                                                                                                        echo "selected";
                                                                                                    } ?>><?= $product["name"] ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="form-group col-xl-3">
                                                    <label class="form-label">Ürün Adedi</label>
                                                    <input class="form-control" type="number" name="products[<?= $key ?>][quantity]" value="<?= $value["quantity"] ?>">
                                                </div>
                                                <div class="form-group col-xl-3">
                                                    <label class="form-label">Ürün Birim Fiyatı</label>
                                                    <input class="form-control" type="number" step="0.01" name="products[<?= $key ?>][price]" value="<?= $value["price"] ?>">
                                                </div>
                                                <div class="form-group col-xl-2">
                                                    <label for="deleteProduct" class="form-label">Sil</label>
                                                    <button type="button" class="btn btn-danger w-100 text-light" id="deleteProduct"><i class="fa fa-trash"></i></button>
                                                </div>
                                            </div>
                                    <?php
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-success w-100">Düzenle</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>