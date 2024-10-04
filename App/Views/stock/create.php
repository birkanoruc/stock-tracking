<div class="main-content app-content mt-0">
    <div class="side-app">

        <div class="main-container container-fluid">

            <div class="page-header">
                <h1 class="page-title">Stok Ekle</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Stoklar</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Ekle</li>
                    </ol>
                </div>
            </div>

            <div class="row ">
                <div class="col-xl-6">
                    <div class="card">
                        <form action="<?= \App\Helpers\Helper::route(url: "/stock/store") ?>" method="POST">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="product_id" class="form-label">Ürün Adı</label>
                                    <select id="product_id" name="product_id" class="form-control form-select" data-bs-placeholder="Ürün Seç">
                                        <?php
                                        foreach ($params["products"] as $key => $value) {
                                        ?>
                                            <option value="<?= $value["id"] ?>"><?= $value["name"] ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="customer_id" class="form-label">Müşteri Adı</label>
                                    <select id="customer_id" name="customer_id" class="form-control form-select" data-bs-placeholder="Müşteri Seç">
                                        <?php
                                        foreach ($params["customers"] as $key => $value) {
                                        ?>
                                            <option value="<?= $value["id"] ?>"><?= $value["name"] ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="cash_id" class="form-label">Kasa Adı</label>
                                    <select id="cash_id" name="cash_id" class="form-control form-select" data-bs-placeholder="Kasa Seç">
                                        <?php
                                        foreach ($params["cashs"] as $key => $value) {
                                        ?>
                                            <option value="<?= $value["id"] ?>"><?= $value["name"] ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="action_type" class="form-label">İşlem Tipi</label>
                                    <div class="custom-controls-stacked">
                                        <label class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" name="action_type" value="0" checked="">
                                            <span class="custom-control-label">Stok Girişi</span>
                                        </label>
                                        <label class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" name="action_type" value="1">
                                            <span class="custom-control-label">Stok Çıkışı</span>
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="quantity" class="form-label">Ürün Adedi</label>
                                    <input type="number" class="form-control" name="quantity">
                                </div>

                                <div class="form-group">
                                    <label for="price" class="form-label">Ürün Birim Fiyatı</label>
                                    <input type="number" step="0.01" class="form-control" name="price">
                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-success w-100">Ekle</button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>