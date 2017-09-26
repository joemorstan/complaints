<div class="row">
    <div class="col-md-6 offset-md-3">
        <span class="anchor" id="formContact"></span>

        <div class="card card-outline-secondary">
            <div class="card-header">
                <h3 class="mb-0">Edit complaint</h3>
            </div>
            <div class="card-block">

                <div class="alert alert-success" role="alert" style="display: none;">
                </div>

                <div class="alert alert-danger" role="alert" style="display: none;">
                </div>

                <form action="<?= URL ?>complaints/update" id="complaintEditForm" method="post" class="form" role="form" autocomplete="off">
                    <input type="hidden" name="id" value="<?= $data->id ?>">
                    <fieldset>
                        <label for="name2" class="mb-0">Name</label>
                        <div class="row mb-1">
                            <div class="col-lg-12">
                                <input type="text" name="name" id="name2" class="form-control" required="" value="<?= $data->name ?>">
                            </div>
                        </div>
                        <label for="email2" class="mb-0">Email</label>
                        <div class="row mb-1">
                            <div class="col-lg-12">
                                <input type="email" name="email" id="email2" class="form-control" required="" value="<?= $data->email ?>">
                            </div>
                        </div>

                        <label for="urlInput" class="mb-0">Url</label>
                        <div class="row mb-1">
                            <div class="col-lg-12">
                                <input type="url" name="url" id="urlInput" class="form-control" value="<?= isset($data->url) ? $data->url : '' ?>">
                            </div>
                        </div>

                        <label for="message2" class="mb-0">Message</label>
                        <div class="row mb-1">
                            <div class="col-lg-12">
                                <textarea rows="6" name="content" id="inputContent" class="form-control" required=""><?= $data->content ?></textarea>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-secondary btn-lg float-right">Save changes</button>
                    </fieldset>
                </form>
            </div>
        </div>

</div>
