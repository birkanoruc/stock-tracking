<div class="main-content app-content mt-0">
    <div class="side-app">

        <div class="main-container container-fluid">

            <div class="page-header">
                <h1 class="page-title">Müşteri Rapor Listele</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Raporlar</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Müşteri Rapor Listele</li>
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
                                            <th>Müşteri Adı Soyadı</th>
                                            <th>Toplam Alınan Ürün Adedi</th>
                                            <th>Toplam Alış Fiyatı</th>
                                            <th>Toplam Satılan Ürün Adedi</th>
                                            <th>Toplam Satış Fiyatı</th>
                                            <th>Alım/Satım Farkı</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (count($params["customers"]) != 0) {
                                            $stockModel = new \App\Models\Stock;
                                            foreach ($params["customers"] as $key => $value) {
                                                $customerInStock = $stockModel->customerInStock($value["id"]);
                                                $customerOutStock = $stockModel->customerOutStock($value["id"]);
                                                $totalInPrice = $customerInStock["SUM(price*quantity)"];
                                                $totalInStock = $customerInStock["SUM(quantity)"];
                                                $totalOutPrice = $customerOutStock["SUM(price*quantity)"];
                                                $totalOutStock = $customerOutStock["SUM(quantity)"];
                                                $total = $totalOutPrice - $totalInPrice;
                                        ?>
                                                <tr>
                                                    <td><?= $value["id"] ?></td>
                                                    <td><?= $value["name"] . " " . $value["surname"] ?></td>
                                                    <td><?= $totalInStock ?></td>
                                                    <td style="color:red; font-weight:700;"><?= $totalInPrice ?></td>
                                                    <td><?= $totalOutStock ?></td>
                                                    <td style="color:green; font-weight:700;"><?= $totalOutPrice ?></td>
                                                    <td style="<?php if ($total < 0) {
                                                                    echo "color:red;";
                                                                } else {
                                                                    echo "color:green;";
                                                                } ?> font-weight:700;"><?= $total ?></td>
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