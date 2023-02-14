

<main class="pt-5 mx-lg-5">
    <div class="container-fluid mt-5">


        <!--Grid row-->
        <div class="row wow fadeIn">
            <!--Grid column-->
            <div class="col-md-12 mb-4">
                <!--Card-->
                <div class="card">
                    <!--Card content-->
                    <div class="card-body">
                        <table id="dt-material-checkbox"class="table table-striped" cellspacing="0"
                               width="100%">
                            <thead>
                                <tr>
                                    <th class="th-sm"></th>
                                    <th class="th-sm">Date retrait</th>
                                    <th class="th-sm">Montant</th>
                                    <th class="th-sm">Motif</th>
                                </tr>
                            </thead>
                            <!-- Table head -->

                            <!-- Table body -->
                            <tbody>
                                <?php foreach ($retrieves as $row):?>
                                    <tr>
                                        <td></td>
                                        <td><?= $row->retrieve_date ?></td>
                                        <td>$ <?= number_format($row->retrieve_amount, 2, '.', '')?></td>
                                        <td><?= $row->motif ?></td>
                                    </tr>
                                <?php endforeach;?>
                            </tbody>
                            <!-- Table body -->
                        </table>
                        <!-- Table  -->

                    </div>

                </div>
                <!--/.Card-->

            </div>
            <!--Grid column-->

            <!--Grid column-->

        </div>
        <!--Grid row-->
        <div class="pt-4 mb-5"></div>
        <div class="pt-3 mb-2"></div>

    </div>
</main>
<!--Main layout-->