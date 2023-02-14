<section class="banner-area relative">
    <div class="overlay overlay-bg"></div>
    <div class="container">
        <div class="row justify-content-between align-items-center text-center banner-content">
            <div class="col-lg-12">
                <h1 class="text-white"><?php echo $user['pseudo']?></h1>
                <p>Les membres.</p>
            </div>
        </div>
    </div>
</section>
<!-- End Banner Area -->

<div class="welcome-wrap mt-5 mb-0 pb-5">
    <div class="container pb-0">
        <div class="row">
            <div class="col-12 col-lg-6 order-2 order-lg-1">
                <div class="welcome-content">
                    <header class="entry-header">
                        <h2 class="entry-title text-secondary"><?php echo ucfirst($user['user_name'])?></h2>
                        <h3 class="text-success"><?php echo ucfirst($user['role_utilisateur'])?></h3>
                        <p class="text-secondary">Au sallon des jeunes entrepreneurs.</p>
                    </header><!-- .entry-header -->

                    <div class="entry-content mt-5">
                        <h4>Courte biographie</h4>
                        <p><?php echo ucfirst($user['biographie'])?> </p>
                    </div><!-- .entry-content -->

                    <div class="entry-footer mt-2" >
                        <a class="fa fa-facebook-square fa-lg" href="<?php echo $user['facebook']?>"></a>
                        <a class="fa fa-twitter-square fa-lg pl-5" href="<?php echo $user['twitter']?>"></a>
                    </div><!-- .entry-footer -->
                </div><!-- .welcome-content -->
            </div><!-- .col -->

            <div class="col-12 col-lg-6 centered">
                <img src="<?php echo  base_url()?>assets/img/users/<?php echo $user['user_image']?>" alt="welcome" class="w-50 h-75 img-thumbnail" style="border-radius: 50px">
            </div><!-- .col -->
        </div><!-- .row -->
    </div><!-- .container -->
</div><!-- .home-page-icon-boxes -->

