<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Google Font: Nunito -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@1,300;1,400&family=Montserrat:wght@400;700;800&display=swap" rel="stylesheet">  <!-- Custom styles -->
</head>
<body <?php body_class(); ?>>

 <header>
    <div  class="d-flex justify-content-center flex-column w-100">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="text-center">
            <img src="https://timothyblake.com/_astro/timothy-blake-logo-black.D9h9S3wC_ZVwjfD.svg" class="mx-auto text-center" alt="Timothy Blake" width="70" />
        </a>
    </div>
</header>