<div class="main-content app-content mt-0">
    <div class="side-app">

        <div class="main-container container-fluid">

            <div class="page-header">
                <h1 class="page-title">Sipariş Ekle</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Siparişler</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Ekle</li>
                    </ol>
                </div>
            </div>

            <div class="row ">
                <div class="col-xl-12">
                    <div class="card">
                        <form action="<?= \App\Helpers\Helper::route("/order/store") ?>" method="POST">
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-xl-4">
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
                                    <div class="form-group col-xl-3">
                                        <label for="company_name" class="form-label">Şirket Adı</label>
                                        <input class="form-control" placeholder="Şirket Adı" type="text" name="company_name" id="company_name">
                                    </div>
                                    <div class="form-group col-xl-3">
                                        <label for="order_date" class="form-label">Sipariş Tarihi</label>
                                        <input class="form-control" placeholder="Sipariş Tarihi" type="date" name="order_date" id="order_date" value="<?= date("Y-m-d") ?>">
                                    </div>
                                    <div class="form-group col-xl-2">
                                        <label for="addProduct" class="form-label">Ürün Ekle</label>
                                        <a class="btn btn-info w-100" id="addProduct">Ürün Ekle</a>
                                    </div>
                                </div>
                                <div id="productsDiv"></div>
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