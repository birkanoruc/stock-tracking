<div class="main-content app-content mt-0">
    <div class="side-app">

        <div class="main-container container-fluid">

            <div class="page-header">
                <h1 class="page-title">Sipariş Listele</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Siparişler</a></li>
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
                                            <th>Müşteri Adı Soyadı</th>
                                            <th>Şirket Adı</th>
                                            <th>Sipariş Tarihi</th>
                                            <th>Detaylar</th>
                                            <th>Düzenle</th>
                                            <th>Sil</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (count($params["orders"]) != 0) {
                                            $customerModel = new \App\Models\Customer;
                                            foreach ($params["orders"] as $key => $value) {
                                                $customer = $customerModel->find($value["customer_id"]);
                                        ?>
                                                <tr>
                                                    <td><?= $value["id"] ?></td>
                                                    <td><?= $customer["name"] . " " . $customer["surname"] ?></td>
                                                    <td><?= $value["company_name"] ?></td>
                                                    <td><?= $value["order_date"] ?></td>
                                                    <td><a target="_blank" class="btn btn-sm btn-info" href="<?= \App\Helpers\Helper::route("/order/show/{$value['id']}") ?>">Görüntüle</a></td>
                                                    <td><a class="btn btn-sm btn-primary" href="<?= \App\Helpers\Helper::route("/order/edit/{$value['id']}") ?>">Düzenle</a></td>
                                                    <td>
                                                        <form method="POST" action="<?= \App\Helpers\Helper::route("/order/delete") ?>">
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