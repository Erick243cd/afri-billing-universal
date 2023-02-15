<main class="pt-5">
    <div class="container-fluid mt-5">
        <!-- Heading -->
        <div class="card mb-4 wow fadeIn">
            <!--Card content-->
            <div class="card-body d-sm-flex justify-content-between">
                <h4 class="mb-2 mb-sm-0 pt-1">
                    <a href="<?php echo base_url() ?>pages/dashboards">Page d'accueil</a>
                    <span>/</span>
                    <span><?= $title; ?></span>
                </h4>
            </div>
        </div>
        <div class="card fadeIn mb-4">
            <div class="text-danger">
                <?php echo validation_errors(); ?>
            </div>
            <div class="card-body">
                <?php echo form_open_multipart('configurations/updateCompanyInfos'); ?>
                <div class="row">
                    <div class="col-md-3 col-sm-3">
                        <div class="form-group">
                            <label for="">Nom de l'entreprise</label>
                            <input type="text" class="form-control" required="required"
                                   value="<?= $company->company_name ?>" name="company_name">

                        </div>
                    </div>

                    <div class="col-md-3 col-sm-3">
                        <div class="form-group">
                            <label for="">Numéro téléphone</label>
                            <input type="text" class="form-control"
                                   value="<?= $company->company_phone ?>" name="company_phone">

                        </div>
                    </div>


                    <div class="col-md-3 col-sm-3">
                        <div class="form-group">
                            <label for="">Adresse mail</label>
                            <input type="email" class="form-control"
                                   value="<?= $company->company_email ?>" name="company_email">

                        </div>
                    </div>

                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <label for="">Adresse</label>
                            <input type="text" class="form-control"
                                   value="<?= $company->company_address ?>" name="company_address">
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <div class="form-group">
                            <label for="">Numéro RCCM</label>
                            <input type="text" class="form-control"
                                   value="<?= $company->company_rccm ?>" name="company_rccm">
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <div class="form-group">
                            <label for="">Identification nationale</label>
                            <input type="text" class="form-control"
                                   value="<?= $company->company_idnat ?>" name="company_idnat">
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <div class="form-group">
                            <label for="">Numéro Impôt</label>
                            <input type="text" class="form-control"
                                   value="<?= $company->company_tax_number ?>" name="company_tax_number">
                        </div>
                    </div>

                    <div class="col-md-12 float-right">
                        <button type="submit" class="btn btn-sm btn-primary float-right">Mettre à jour</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</main>

