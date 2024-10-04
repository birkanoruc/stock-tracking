<div class="main-content app-content mt-0">
    <div class="side-app">

        <div class="main-container container-fluid">

            <div class="page-header">
                <h1 class="page-title">Stok Listele</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Stoklar</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Listele</li>
                    </ol>
                </div>
            </div>

            <div class="row ">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table text-nowrap text-md-nowrap mb-0 text-center">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Müşteri Adı</th>
                                            <th>Kasa Adı</th>
                                            <th>Ürün Adı</th>
                                            <th>İşlem Adı</th>
                                            <th>Stok Adedi</th>
                                            <th>Toplam Fiyat</th>
                                            <th>Düzenle</th>
                                            <th>Sil</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $productModel = new \App\Models\Product;
                                        $customerModel = new \App\Models\Customer;
                                        $cashModel = new \App\Models\Cash;
                                        if (count($params["stocks"]) != 0) {
                                            foreach ($params["stocks"] as $key => $value) {
                                                $product = $productModel->find($value["product_id"]);
                                                $customer = $customerModel->find($value["customer_id"]);
                                                $cash = $cashModel->find($value["cash_id"]);
                                                $total = $value["quantity"] * $value["price"];
                                                if ($value["action_type"] == 0) {
                                                    $action = "<b style='color:green'>Stok Girişi</b>";
                                                    $total = "<b style='color:red'> -" . $total . "</b>";
                                                } else {
                                                    $action = "<b style='color:red'>Stok Çıkışı</b>";
                                                    $total = "<b style='color:green'>" . $total . "</b>";
                                                }
                                        ?>
                                                <tr>
                                                    <td><?= $value["id"] ?></td>
                                                    <td><?= $customer["name"] ?></td>
                                                    <td><?= $cash["name"] ?></td>
                                                    <td><?= $product["name"] ?></td>
                                                    <td><?= $action ?></td>
                                                    <td><?= $value["quantity"] ?></td>
                                                    <td><?= $total ?></td>
                                                    <td><a class="btn btn-sm btn-primary" href="<?= \App\Helpers\Helper::route("/stock/edit/{$value['id']}") ?>">Düzenle</a></td>
                                                    <td>
                                                        <form method="POST" action="<?= \App\Helpers\Helper::route("/stock/delete") ?>">
                                                            <input type="hidden" name="id" value="<?= $value["id"] ?>">
                                                            <button type="submit" class="btn btn-sm btn-danger">Sil</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <?= implode(' ', $params["pagination"]) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>