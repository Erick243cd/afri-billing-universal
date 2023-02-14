<main class="pt-5 mx-lg-5">
    <div class="container-fluid mt-5">

        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success alert-dismissible" role="alert" id="connexion-failed">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close" id="btn-close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <strong><?php echo $this->session->flashdata('success'); ?></strong>
            </div>
        <?php endif; ?>

        <div class="card fadeIn">
            <div class="card-body">
                <?php echo form_open_multipart('commandes/saveRetrieve'); ?>
                
                <div class="row">
                    <div class="col-md-4">
                        <div class="md-form">
                            <label for="" class="font-weight-bold text-danger">Solde Actuel</label>
                            <input type="text" class="form-control" name="montant_entree" required="required"
                                   value="$ <?= $current['montant_entree'] ?> " readonly>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="md-form">
                            <label for="" class="font-weight-bold text-info">Montant à retirer</label>
                            <input type="number" class="form-control" name="amount_retrieve" required="required" min="1" max="<?= $current['montant_entree'] ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="md-form">
                            <input type="date" class="form-control" name="date_retrait" required="required">
                            <label for="" class="font-weight-bold text-info">Date de retrait</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="md-form">
                            <input type="text" class="form-control" name="motif_retrait" required="required">
                            <label for="" class="font-weight-bold text-info">Motif de retrait</label>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 mb-0">
                    <button type="submit" class="btn btn-md blue-gradient mt-3" style="margin-bottom: 10px">Enregistrer
                    </button>
                </div>
            </div>
            </form>
        </div>
    </div>
    </div>
</main>