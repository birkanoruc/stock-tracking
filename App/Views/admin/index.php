<div class="main-content app-content mt-0">
    <div class="side-app">

        <div class="main-container container-fluid">

            <div class="page-header">
                <h1 class="page-title">Admin Listele</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Adminler</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Listele</li>
                    </ol>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-nowrap text-md-nowrap mb-0 text-center">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Adı Soyad</th>
                                    <th>E-Posta</th>
                                    <th>Düzenle</th>
                                    <th>Sil</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($params["admins"] as $key => $value) {
                                ?>
                                    <tr>
                                        <td><?= $value["id"] ?></td>
                                        <td><?= $value["name"] . " " . $value["surname"] ?></td>
                                        <td><?= $value["email"] ?></td>
                                        <td><a class="btn btn-sm btn-primary" href="<?= \App\Helpers\Helper::route("/admin/edit/{$value['id']}") ?>">Düzenle</a></td>
                                        <td>
                                            <form method="POST" action="<?= \App\Helpers\Helper::route("/admin/delete") ?>">
                                                <input type="hidden" name="id" value="<?= $value["id"] ?>">
                                                <button type="submit" class="btn btn-sm btn-danger">Sil</button>
                                            </form>
                                        </td>
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
</div>
</div>