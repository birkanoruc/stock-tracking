<div class="main-content app-content mt-0">
    <div class="side-app">

        <div class="main-container container-fluid">

            <div class="page-header">
                <h1 class="page-title">Ürün İçe Aktar</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Ürünler</a></li>
                        <li class="breadcrumb-item active" aria-current="page">İçe Aktar</li>
                    </ol>
                </div>
            </div>

            <div class="row ">
                <div class="col-xl-6">
                    <div class="card">
                        <form action="<?= \App\Helpers\Helper::route("/excel/import") ?>" method="POST" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group">
                                        <label for="file" class="form-label">Dosya Seç</label>
                                        <input class="form-control" placeholder="Ürün Adı" type="file" name="file" id="file">
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-success w-100">İçe Aktar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>