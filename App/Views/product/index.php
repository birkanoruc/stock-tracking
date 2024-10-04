<div class="main-content app-content mt-0">
    <div class="side-app">

        <div class="main-container container-fluid">

            <div class="page-header">
                <h1 class="page-title">Ürün Listele</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Ürünler</a></li>
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
                                            <th>Ürün Adı</th>
                                            <th>Kategori Adı</th>
                                            <th>Düzenle</th>
                                            <th>Sil</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (count($params["products"]) != 0) {
                                            $categoryModel = new \App\Models\Category;
                                            foreach ($params["products"] as $key => $value) {
                                                $category = $categoryModel->find($value["category_id"]);
                                        ?>
                                                <tr>
                                                    <td><?= $value["id"] ?></td>
                                                    <td><?= $value["name"] ?></td>
                                                    <td><?= $category["name"] ?></td>
                                                    <td><a class="btn btn-sm btn-primary" href="<?= \App\Helpers\Helper::route("/product/edit/{$value['id']}") ?>">Düzenle</a></td>
                                                    <td>
                                                        <form method="POST" action="<?= \App\Helpers\Helper::route("/product/delete") ?>">
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
                        <div class="card-footer">
                            <a class="btn btn-info" href="<?= SITE_URL ?>/excel/export">Ürünleri Dışa Aktar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>