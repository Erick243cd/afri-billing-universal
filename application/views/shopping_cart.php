<!doctype html>
<html lang="fr">

<!-- Mirrored from getbootstrap.com/docs/4.1/examples/offcanvas/ by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 07 Nov 2018 23:42:06 GMT -->
<meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Ventes des articles pour immeuble</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url()?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url()?>assets/css/offcanvas.css" rel="stylesheet">
    <script src="<?php echo base_url()?>assets/js/jquery-2.2.4.min.js"></script>
</head>

<body class="bg-light">

<nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark">
    <a class="navbar-brand mr-auto mr-lg-0" href="<?php echo base_url()?>">Jambo Mart</a>
    <button class="navbar-toggler p-0 border-0" type="button" data-toggle="offcanvas">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="<?php echo base_url()?>pages/connexion">Dashboard <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Notifications</a>
            </li>
        </ul>
        <a class="btn btn-outline-success my-2 my-sm-0" href="" data-toggle="modal" data-target="#quickview">Mon panier</a>
    </div>
</nav>
<?php if($this->session->flashdata('message')):?>
    <?php echo '<p class="alert alert-success">'.$this->session->flashdata('message').'</p>';?>
<?php endif;?>

<main role="main" class="container">
    <div class="d-flex align-items-center p-3 my-3 text-white-50 bg-purple rounded shadow-sm">
        <img class="mr-3" src="../../assets/brand/bootstrap-outline.svg" alt="" width="48" height="48">
        <div class="lh-100">
            <h6 class="mb-0 text-white lh-100">Catalogue des produits</h6>
            <small>Jambo Market 2020</small>
        </div>

    </div>
       <div class="row">

           <?php
           foreach ($articles as $row){
               echo '

               <div class="col-md-3 bg-light text-center p-5">
                   <img src="'.base_url().'assets/img/articles/'.$row->image_article.'" class="img-thumbnail rounded" alt="">
                   <h4>'.$row->designation.'</h4>
                   <h3 class="text-danger">$ '.number_format($row->prix_unitaire,2,',','').'</h3>
                   <input type="text" name="quantity" class="quantity" id="'.$row->id_article.'">
                   <button type="button"
                           name="add_cart" class="btn btn-success add_cart"
                           data-productname="'.$row->designation.'"
                           data-price="'.$row->prix_unitaire.'"
                           data-productid="'.$row->id_article.'">Ajouter au pannier 
                   </button>
               </div>
               
               ';
           }
          ?>

       </div>
    </div>
        <div class="col col-lg-12">
        <div class="modal fade" id="quickview" tabindex="-1" role="dialog" aria-labelledby="quickview" aria-hidden="true">
            <div  class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                    <div class="modal-header text-center">
                        <h6 class="border-bottom border-gray pb-2 mb-0">Faites vos achats</h6>
                    </div>
                    <div class="modal-body" id="cart_details">
                            <h4 class="text-center">Le pannier est vide</h4>
                    </div>

                    <div class="modal-footer">
                        <a class="btn btn-default" data-dismiss="modal">Fermer</a>
                        <a class="btn btn-primary" href="<?php echo base_url()?>commandes/create" name="envoyer">Commander</a>
                    </div>
                </div>
            </div>
        </div>
        </div>
</main> <!-- /container -->

<script src="<?php echo base_url()?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url()?>assets/js/jquery-2.2.4.min.js"></script>
<script src="<?php echo base_url()?>assets/js/offcanvas.js"></script>
<script src="<?php echo base_url()?>assets/js/holder.min.js"></script>
</body>
</html>

<script>
    $(document).ready(function(){
        $('.add_cart').click(function(){
            var product_id= $(this).data("productid");
            var product_name= $(this).data("productname");
            var product_price= $(this).data("price");
            var quantity= $('#' + product_id).val();
            if(quantity != '' && quantity > 0)
            {
                $.ajax({
                        url:"<?php echo base_url();?>shopping_cart/add",
                        method:"POST",
                        data:{product_id:product_id, product_name:product_name, product_price:product_price, quantity:quantity},
                        success:function (data) {
                            alert("Article ajouté au panier");
                            $('#cart_details').html(data);
                            $('#' + product_id).val('');
                        }
                    });
            }
            else {
                alert("Saisissez la quantité svp !");
            }
        });
        $('#cart_details').load("<?php echo base_url();?>shopping_cart/load");

        //Suppression
        $(document).on('click', '.remove_inventory', function(){
            var row_id = $(this).attr("id");
            if(confirm("Etes-vous sûr de retirer cet article de votre panier ?"))
            {
              $.ajax({

                url:"<?php echo base_url();?>shopping_cart/remove",
                method:"POST",
                data:{row_id:row_id},
                success:function(data)
                {
                  alert("Article retiré du panier");
                  $('#cart_details').html(data);
                }

              });

            }else{
              return false;
            }
        });

        $(document).on('click', '#clear_cart', function(){
          if(confirm("Etes-vous sûr de vider le panier ?"))
          {
            $.ajax({
              url:"<?php echo base_url();?>shopping_cart/clear",
              success:function(data)
                {
                  alert("Votre panier a été vidé avec succès .");
                  $('#cart_details').html(data);
                }
            });
          }
          else{
            return false;
          }
        });
    });
</script>
