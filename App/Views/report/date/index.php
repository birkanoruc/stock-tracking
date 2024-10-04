<div class="main-content app-content mt-0">
    <div class="side-app">

        <div class="main-container container-fluid">

            <div class="page-header">
                <h1 class="page-title">Tarih Bazlı Rapor Listele</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Raporlar</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tarih Bazlı Rapor Listele</li>
                    </ol>
                </div>
            </div>

            <div class="row ">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="" method="GET">
                                <div class="row">
                                    <div class="form-group col-4">
                                        <label for="start_date" class="form-label">Başlangıç Tarihi</label>
                                        <input class="form-control" type="date" name="start_date" value="<?php if (isset($_GET["start_date"])) {
                                                                                                                echo $_GET["start_date"];
                                                                                                            } else {
                                                                                                                echo date("Y-m-01");
                                                                                                            } ?>">
                                    </div>
                                    <div class="form-group col-4">
                                        <label for="end_date" class="form-label">Bitiş Tarihi</label>
                                        <input class="form-control" type="date" name="end_date" value="<?php if (isset($_GET["end_date"])) {
                                                                                                            echo $_GET["end_date"];
                                                                                                        } else {
                                                                                                            echo date("Y-m-d");
                                                                                                        } ?>">
                                    </div>
                                    <div class="form-group col-4">
                                        <label for="list" class="form-label">Listele</label>
                                        <button class="btn btn-info w-100">Listele</button>
                                    </div>
                                    <hr>
                                </div>
                            </form>
                            <?php
                            if (count($params["stocks"]) != 0) {
                            ?>
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
                                            $productModel = new \App\Models\Product();
                                            $stockModel = new \App\Models\Stock();

                                            foreach ($params["stocks"] as $key => $value) {
                                                $productRow = $productModel->find($value["product_id"]);
                                                $productInStock = $stockModel->productInStock($value["product_id"]);
                                                $productOutStock = $stockModel->productOutStock($value["product_id"]);
                                                $total = ($productOutStock["SUM(quantity)"] * $productOutStock["SUM(price)"]) - ($productInStock["SUM(quantity)"] * $productInStock["SUM(price)"]);
                                            ?>
                                                <tr>
                                                    <td><?= $value["id"] ?></td>
                                                    <td><?= $productRow["name"] ?></td>
                                                    <td><?= doubleval($productInStock["SUM(quantity)"]) ?></td>
                                                    <td><?= doubleval($productOutStock["SUM(quantity)"]) ?></td>
                                                    <td><?= doubleval($productInStock["SUM(quantity)"] - $productOutStock["SUM(quantity)"]) ?></td>
                                                    <td style="color:red; font-weight:700;"><?= -$productInStock["SUM(price)"] * $productInStock["SUM(quantity)"] ?></td>
                                                    <td style="color:green; font-weight:700;"><?= $productOutStock["SUM(price)"] * $productOutStock["SUM(quantity)"] ?></td>
                                                    <?php
                                                    if ($total < 0) {
                                                    ?>
                                                        <td style="color:red; font-weight:700;"><?= $total ?></td>
                                                    <?php } else { ?>
                                                        <td style="color:green; font-weight:700;"><?= $total ?></td>
                                                    <?php } ?>
                                                </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <?= implode(' ', $params["pagination"]) ?>
                            <?php
                            } else {
                            ?>
                                <div class="row">
                                    <div class="card">
                                        <div class="card-body">
                                            <p>Arama sonucunda kayıt bulunamadı!</p>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>