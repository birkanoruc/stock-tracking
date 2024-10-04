<div class="main-content app-content mt-0">
    <div class="side-app">

        <div class="main-container container-fluid">

            <div class="page-header">
                <h1 class="page-title">Fatura Rapor Listele</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Raporlar</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Fatura Rapor Listele</li>
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
                                            <th>Toplam Gider Faturası</th>
                                            <th>Toplam Gelir Faturası</th>
                                            <th>Fatura Farkı</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (count($params["customers"]) != 0) {
                                            $invoiceModel = new \App\Models\Invoice;
                                            foreach ($params["customers"] as $key => $value) {
                                                $customerInInvoice = $invoiceModel->customerInInvoice($value["id"]);
                                                $customerOutInvoice = $invoiceModel->customerOutInvoice($value["id"]);
                                                $total = $customerOutInvoice["SUM(amount)"] - $customerInInvoice["SUM(amount)"];
                                        ?>
                                                <tr>
                                                    <td><?= $value["id"] ?></td>
                                                    <td><?= $value["name"] . " " . $value["surname"] ?></td>
                                                    <td style="color:green; font-weight:700;"><?= doubleval($customerOutInvoice["SUM(amount)"]) ?></td>
                                                    <td style="color:red; font-weight:700;"><?= doubleval($customerInInvoice["SUM(amount)"]) ?></td>
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