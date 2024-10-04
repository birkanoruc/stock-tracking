<div class="main-content app-content mt-0">
    <div class="side-app">

        <div class="main-container container-fluid">

            <div class="page-header">
                <h1 class="page-title">Kasa Rapor Listele</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Raporlar</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Kasa Rapor Listele</li>
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
                                            <th>Kasa Adı</th>
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
                                        if (count($params["cashs"]) != 0) {
                                            $stockModel = new \App\Models\Stock;
                                            foreach ($params["cashs"] as $key => $value) {
                                                $cashInStock = $stockModel->cashInStock($value["id"]);
                                                $cashOutStock = $stockModel->cashOutStock($value["id"]);
                                                $totalStock = $cashInStock["SUM(quantity)"] - $cashOutStock["SUM(quantity)"];
                                                $totalPrice = $cashOutStock["SUM(price*quantity)"] - $cashInStock["SUM(price*quantity)"];
                                        ?>
                                                <tr>
                                                    <td><?= $value["id"] ?></td>
                                                    <td><?= $value["name"] ?></td>
                                                    <td><?= doubleval($cashInStock["SUM(quantity)"]) ?></td>
                                                    <td><?= doubleval($cashOutStock["SUM(quantity)"]) ?></td>
                                                    <td style="<?php if ($totalStock < 0) {
                                                                    echo "color:red;";
                                                                } else {
                                                                    echo "color:green;";
                                                                } ?> font-weight:700;"><?= $totalStock ?></td>
                                                    <td style="color:red; font-weight:700;"><?= doubleval($cashInStock["SUM(price*quantity)"]) ?></td>
                                                    <td style="color:green; font-weight:700;"><?= doubleval($cashOutStock["SUM(price*quantity)"]) ?></td>
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