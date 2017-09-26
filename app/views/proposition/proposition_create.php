<div class="row">
    <div class="col-md-6 offset-md-3">
        <span class="anchor" id="formContact"></span>

        <div class="card card-outline-secondary">
            <div class="card-header">
                <h3 class="mb-0">New proposition</h3>
            </div>
            <div class="card-block">

                <div class="alert alert-danger" role="alert" style="display: none">
                </div>

                <form action="<?= URL?>propositions/store" method="post" id="formNewProposition" class="form" role="form" autocomplete="off">
                    <fieldset>
                        <label for="name2" class="mb-0">Name</label>
                        <div class="row mb-1">
                            <div class="col-lg-12">
                                <input type="text" name="name" id="name2" class="form-control" required>
                            </div>
                        </div>
                        <label for="email2" class="mb-0">Email</label>
                        <div class="row mb-1">
                            <div class="col-lg-12">
                                <input type="email" name="email" id="email2" class="form-control">
                            </div>
                        </div>

                        <label for="urlInput" class="mb-0">Url</label>
                        <div class="row mb-1">
                            <div class="col-lg-12">
                                <input type="url" name="url" id="urlInput" class="form-control">
                            </div>
                        </div>

                        <label for="message2" class="mb-0">Message</label>
                        <div class="row mb-1">
                            <div class="col-lg-12">
                                <textarea rows="6" name="content" id="inputContent" class="form-control" ></textarea>
                            </div>
                        </div>

                        <div class="g-recaptcha" data-sitekey="6LfzDTIUAAAAAHKnjiiZK13zKZuE-nxZ_YiHT9aW"></div>
                        <button type="submit" class="btn btn-secondary btn-lg float-right">Save changes</button>
                    </fieldset>

                </form>

                <!-- reCaptcha-->
                <!--<div class="g-recaptcha" data-sitekey="6LfzDTIUAAAAAHKnjiiZK13zKZuE-nxZ_YiHT9aW"></div>-->
            </div>
        </div>

    </div>
