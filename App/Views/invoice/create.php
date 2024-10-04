<div class="main-content app-content mt-0">
    <div class="side-app">

        <div class="main-container container-fluid">

            <div class="page-header">
                <h1 class="page-title">Fatura Ekle</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Faturalar</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Ekle</li>
                    </ol>
                </div>
            </div>

            <div class="row ">
                <div class="col-xl-6">
                    <div class="card">
                        <form action="<?= \App\Helpers\Helper::route("/invoice/store") ?>" method="POST">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="customer_id" class="form-label">Müşteri Adı</label>
                                    <select id="customer_id" name="customer_id" class="form-control form-select" data-bs-placeholder="Müşteri Seç">
                                        <?php
                                        foreach ($params["customers"] as $key => $value) {
                                        ?>
                                            <option value="<?= $value["id"] ?>"><?= $value["name"] ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="amount" class="form-label">Tutar</label>
                                    <input class="form-control" placeholder="Tutar" type="number" name="amount" id="amount">
                                </div>
                                <div class="form-group">
                                    <label for="description" class="form-label">Açıklama</label>
                                    <textarea class="form-control" placeholder="Açıklama" name="description" id="description"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="type" class="form-label">Fatura Tipi</label>
                                    <div class="custom-controls-stacked">
                                        <label class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" name="type" value="0" checked="">
                                            <span class="custom-control-label">Gelir Faturası</span>
                                        </label>
                                        <label class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" name="type" value="1">
                                            <span class="custom-control-label">Gider Faturası</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-success w-100">Ekle</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>