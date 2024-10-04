<div class="main-content app-content mt-0">
    <div class="side-app">

        <div class="main-container container-fluid">

            <div class="page-header">
                <h1 class="page-title">Ürün Rapor Listele</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Raporlar</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Ürün Rapor Listele</li>
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
                                            <th>Ürün Adı</th>
                                            <th>Toplam Alış Adedi</th>
                                            <th>Toplam Satış Adedi</th>
                                            <th>Kalan Stok Adedi</th>
                                            <th>Toplam Gider</th>
                                            <th>Toplam Gelir</th>
                                            <th>Kar/Zarar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (count($params["products"]) != 0) {
                                            $stockModel = new \App\Models\Stock;
                                            foreach ($params["products"] as $key => $value) {
                                                $productInStock = $stockModel->productInStock($value["id"]);
                                                $productOutStock = $stockModel->productOutStock($value["id"]);
                                                $totalStock = $productInStock["SUM(quantity)"] - $productOutStock["SUM(quantity)"];
                                                $totalPrice = $productOutStock["SUM(price*quantity)"] - $productInStock["SUM(price*quantity)"];
                                        ?>
                                                <tr>
                                                    <td><?= $value["id"] ?></td>
                                                    <td><?= $value["name"] ?></td>
                                                    <td><?= doubleval($productInStock["SUM(quantity)"]) ?></td>
                                                    <td><?= doubleval($productOutStock["SUM(quantity)"]) ?></td>
                                                    <td style="<?php if ($totalStock < 0) {
                                                                    echo "color:red;";
                                                                } else {
                                                                    echo "color:green;";
                                                                } ?> font-weight:700;"><?= $totalStock ?></td>
                                                    <td style="color:red; font-weight:700;"><?= doubleval($productInStock["SUM(price*quantity)"]) ?></td>
                                                    <td style="color:green; font-weight:700;"><?= doubleval($productOutStock["SUM(price*quantity)"]) ?></td>
                                                    <td style="<?php if ($totalPrice < 0) {
                                                                    echo "color:red;";
                                                                } else {
                                                                    echo "color:green;";
                                                                } ?> font-weight:700;"><?= $totalPrice ?></td>
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