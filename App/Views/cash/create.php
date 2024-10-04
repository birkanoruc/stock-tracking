<div class="main-content app-content mt-0">
    <div class="side-app">

        <div class="main-container container-fluid">

            <div class="page-header">
                <h1 class="page-title">Kasa Ekle</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Kasalar</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Ekle</li>
                    </ol>
                </div>
            </div>

            <div class="row ">
                <div class="col-xl-6">
                    <div class="card">
                        <form action="<?= \App\Helpers\Helper::route("/cash/store") ?>" method="POST">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name" class="form-label">Kasa Adı</label>
                                    <input class="form-control" placeholder="Kasa Adı" type="text" name="name" id="name">
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