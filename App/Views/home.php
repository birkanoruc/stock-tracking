<div class="main-content app-content mt-0">
    <div class="side-app">

        <div class="main-container container-fluid">

            <div class="page-header">
                <h1 class="page-title">Ana Sayfa</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Ana Sayfa</a></li>
                    </ol>
                </div>
            </div>

            <div class="row ">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
                            <div class="card bg-primary img-card box-primary-shadow">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="text-white">
                                            <h2 class="mb-0 number-font"><?= $totalCustomer ?></h2>
                                            <p class="text-white mb-0">Toplam Müşteri Sayısı</p>
                                        </div>
                                        <div class="ms-auto"> <i class="fa fa-user-o text-white fs-30 me-2 mt-2"></i> </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
                            <div class="card bg-secondary img-card box-secondary-shadow">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="text-white">
                                            <h2 class="mb-0 number-font"><?= $totalProduct ?></h2>
                                            <p class="text-white mb-0">Toplam Ürün Sayısı</p>
                                        </div>
                                        <div class="ms-auto"> <i class="fa fa-product-hunt text-white fs-30 me-2 mt-2"></i> </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
                            <div class="card  bg-success img-card box-success-shadow">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="text-white">
                                            <h2 class="mb-0 number-font"><?= $totalOutPrice[0] ?></h2>
                                            <p class="text-white mb-0">Toplam Gelir</p>
                                        </div>
                                        <div class="ms-auto"> <i class="fa fa-plus text-white fs-30 me-2 mt-2"></i> </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
                            <div class="card bg-info img-card box-info-shadow">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="text-white">
                                            <h2 class="mb-0 number-font"><?= $totalInPrice[0] ?></h2>
                                            <p class="text-white mb-0">Toplam Gider</p>
                                        </div>
                                        <div class="ms-auto"> <i class="fa fa-minus text-white fs-30 me-2 mt-2"></i> </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                $search = $params["search"];
                if (count($search) != 0) {
                ?>
                    <div class="row">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table text-nowrap text-md-nowrap mb-0 text-center">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Ürün Adı</th>
                                                <th>Stok Girişi</th>
                                                <th>Stok Çıkışı</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $stockModel = new \App\Models\Stock;
                                            foreach ($search as $key => $value) {
                                                $productInStock = $stockModel->productInStock($value["id"]);
                                                $productOutStock = $stockModel->productOutStock($value["id"]);
                                            ?>
                                                <tr>
                                                    <td><?= $value["id"] ?></td>
                                                    <td><?= $value["name"] ?></td>
                                                    <td><?= doubleval($productInStock["SUM(quantity)"]) ?></td>
                                                    <td><?= doubleval($productOutStock["SUM(quantity)"]) ?></td>
                                                </tr>
                                            <?php
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