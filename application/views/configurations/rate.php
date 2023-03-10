<main class="pt-5">
    <div class="container-fluid mt-5">
        <!-- Heading -->
        <div class="card mb-4 wow fadeIn">
            <!--Card content-->
            <div class="card-body d-sm-flex justify-content-between">
                <h4 class="mb-2 mb-sm-0 pt-1">
                    <a href="<?php echo base_url() ?>pages/dashboards">Page d'accueil</a>
                    <span>/</span>
                    <span><?= $title ?? "Taux"; ?></span>
                </h4>
            </div>
        </div>
        <div class="card fadeIn mb-4">
            <?php if ($this->session->flashdata('success')) : ?>
                <div class="alert alert-success alert-dismissible" role="alert" id="connexion-failed">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close" id="btn-close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <strong><?php echo $this->session->flashdata('success'); ?></strong>
                </div>
            <?php endif; ?>
            <div class="card-body">
                <?= form_open('configurations/updateRate'); ?>
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="">TAUX ACTUEL</label>
                            <input type="text" disabled class="form-control" required="required"
                                   value="<?= $rate->rate_value ?> $">

                        </div>
                    </div>

                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="">NOUVEAU TAUX</label>
                            <input type="number" class="form-control" name="rateValue" required="required" step="any">
                        </div>
                    </div>
                    <div class="col-md-12 float-right">
                        <button type="submit" class="btn btn-sm btn-primary float-right">Mettre ?? jour</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</main>


