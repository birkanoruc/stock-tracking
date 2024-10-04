<div class="main-content app-content mt-0">
    <div class="side-app">

        <div class="main-container container-fluid">

            <div class="page-header">
                <h1 class="page-title">Faturalar Düzenle</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Faturalar</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Düzenle</li>
                    </ol>
                </div>
            </div>

            <div class="row ">
                <div class="col-xl-6">
                    <div class="card">
                        <form action="<?= \App\Helpers\Helper::route("/invoice/update/{$params["invoice"]["id"]}") ?>" method="POST">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="customer_id" class="form-label">Müşteri Adı</label>
                                    <select id="customer_id" name="customer_id" class="form-control form-select" data-bs-placeholder="Müşteri Seç">
                                        <?php
                                        foreach ($params["customers"] as $key => $value) {
                                        ?>
                                            <option value="<?= $value["id"] ?>" <?php if ($invoice["customer_id"] == $value["id"]) {
                                                                                    echo "selected";
                                                                                } ?>><?= $value["name"] ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="amount" class="form-label">Tutar</label>
                                    <input class="form-control" placeholder="Tutar" type="number" name="amount" id="amount" value="<?= $invoice["amount"] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="description" class="form-label">Açıklama</label>
                                    <textarea class="form-control" placeholder="Açıklama" name="description" id="description"><?= $invoice["description"] ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="type" class="form-label">Fatura Tipi</label>
                                    <div class="custom-controls-stacked">
                                        <label class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" name="type" value="0" <?php if ($invoice["type"] == 0) {
                                                                                                                        echo "checked";
                                                                                                                    } ?>>
                                            <span class="custom-control-label">Gelir Faturası</span>
                                        </label>
                                        <label class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" name="type" value="1" <?php if ($invoice["type"] == 1) {
                                                                                                                        echo "checked";
                                                                                                                    } ?>>
                                            <span class="custom-control-label">Gider Faturası</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-success w-100">Düzenle</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>