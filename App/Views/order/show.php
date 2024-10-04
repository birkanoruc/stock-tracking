<div class="main-content app-content mt-0">
    <div class="side-app">

        <div class="main-container container-fluid">

            <div class="page-header">
                <h1 class="page-title">Sipariş Detayı</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Siparişler</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Detay</li>
                    </ol>
                </div>
            </div>

            <div class="row ">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <span style="font-weight:700;">Müşteri Adı Soyadı: </span>
                            <span><?= $params["customer"]["name"] . " " . $params["customer"]["surname"] ?></span>
                            <hr>
                            <span style="font-weight:700;">Şirket Adı: </span>
                            <span><?= $params["customer"]["company"] ?></span>
                            <hr>
                            <span style="font-weight:700;">Sipariş Tarihi: </span>
                            <span><?= $params["customer"]["date"] ?></span>
                            <hr>
                            <div class="table-responsive">
                                <table class="table text-nowrap text-md-nowrap mb-0 text-center">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Ürün Adı</th>
                                            <th>Birim Fiyat</th>
                                            <th>Adet</th>
                                            <th>Toplam Tutar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (count(json_decode($params["order"]["products"], true)) != 0) {
                                            $productModel = new \App\Models\Product;
                                            foreach (json_decode($params["order"]["products"], true) as $key => $value) {
                                                $product = $productModel->find($value["id"]);
                                        ?>
                                                <tr>
                                                    <td><?= $value["id"] ?></td>
                                                    <td><?= $product["name"] ?></td>
                                                    <td><?= $value["price"] ?></td>
                                                    <td><?= $value["quantity"] ?></td>
                                                    <td><?= $value["price"] * $value["quantity"] ?></td>
                                                </tr>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>