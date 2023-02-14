<main class="pt-5">
    <div class="container-fluid mt-5">

        <?php if ($this->session->flashdata('reappro_enable')): ?>
            <div class="alert alert-danger alert-dismissible" role="alert" id="connexion-failed">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close" id="btn-close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <strong><?php echo $this->session->flashdata('reappro_enable'); ?></strong>
            </div>
        <?php endif; ?>
        <div class="card mb-4 wow fadeIn">
            <div class="card-body d-sm-flex justify-content-between">
                <h4 class="mb-2 mb-sm-0 pt-1">
                    <a href="<?php echo base_url() ?>pages/dashboards">Page d'accueil</a>
                    <span>/</span>
                    <span><?php echo $title; ?></span>
                </h4>
            </div>
        </div>
        <div class="card fadeIn">
            <div class="card-body">
                <?php echo form_open_multipart('articles/reapprovisionner'); ?>
                <input type="hidden" name="id_article" value="<?= $article['id_article'] ?>" required>
                <input type="hidden" name="qte_actuelle" value="<?= $article['qte_actuelle'] ?>" required>
                <div class="row">
                    <div class="col-md-6">
                        <div class="md-form">
                            <label class="font-weight-bold" for="">Nom de l'article</label>
                            <input disabled type="text" class="form-control" name="designation" required="required"
                                   value="<?= $article['designation'] ?>">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="md-form">
                            <select disabled class="browser-default custom-select mdb-select" name="id_categorie"
                                    required="required">
                                <option value="<?= $article['id_categorie'] ?>"
                                        selected><?= $article['nom_categorie'] ?></option>
                                <option value="" disabled>Catégorie</option>
                                <?php foreach ($categories as $row): ?>
                                    <option value="<?= $row->id_categorie; ?>"><?= $row->nom_categorie; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="md-form">
                            <label class="font-weight-bold" for="">Prix Unitaire</label>
                            <input disabled type="text" class="form-control" name="prix_unitaire" required="required"
                                   value="<?= $article['devise'] ?> <?= $article['prix_unitaire'] ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="md-form">
                            <label for="" class="font-weight-bold text-danger">Quantité en stock</label>
                            <input disabled type="text" class="form-control" name="qte_initial" required="required"
                                   value="<?= $article['qte_actuelle'] ." ".$article['unityName'] ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="md-form">
                            <label for="" class="font-weight-bold text-info">Quantité à reapprovisionner</label>
                            <input type="number" class="form-control" name="qte_reappro" required="required" min="1">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="md-form">
                            <input type="date" class="form-control" name="date_reappro" required="required">
                            <label for="" class="font-weight-bold text-info">Date de reapprovisionnement</label>
                        </div>
                    </div>
                    <div class="col-sm-12 mb-0">
                        <div class="md-form">
                            <label for="" class="font-weight-bold text-info">Nom du fournisseur</label>
                            <input type="text" class="form-control" name="nom_fournisseur" required="required">
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 mb-0">
                    <button type="submit" class="btn btn-md blue-gradient mt-3" style="margin-bottom: 10px">Reapprovisionner
                    </button>
                </div>
            </div>
            </form>
        </div>
    </div>
    </div>
</main>
