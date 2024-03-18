<!DOCTYPE html>
<html <?php language_attributes(); ?> >
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Maximum</title>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<header class="header">
    <div class="container">
        <div class="header__wrapper">
            <div class="header__logo"><a href="/"> <img src="<?=get_template_directory_uri()?>/img/logo/logo.webp" alt="Logo" /></a></div>
            <nav class="header__nav">
                <div class="btn--burger"><span></span><span></span></div>
                <ul class="menu">
                    <li class="mob header__cart"><a href="#">Cart</a></li>
                    <li class="mob"> <a href="#">Wish list</a></li>
                    <li> <a href="/#">Shop</a></li>
                    <li> <a href="#">Sale</a></li>
                    <li> <a href="#">About</a></li>
                    <li> <a href="#">Inspiration</a></li>
                </ul>
            </nav>
            <div class="header__search">
                <div class="header__search-icon"><svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M11.5 21.3369C16.7467 21.3369 21 17.0836 21 11.8369C21 6.59021 16.7467 2.33691 11.5 2.33691C6.25329 2.33691 2 6.59021 2 11.8369C2 17.0836 6.25329 21.3369 11.5 21.3369Z" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M22 22.3369L20 20.3369" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
            </div>
            <div class="header__icons"><a class="header__wish" href="#"><svg viewBox="0 0 32 33" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M16.8267 28.084C16.3734 28.244 15.6267 28.244 15.1734 28.084C11.3067 26.764 2.66675 21.2574 2.66675 11.924C2.66675 7.80404 5.98675 4.4707 10.0801 4.4707C12.5067 4.4707 14.6534 5.64404 16.0001 7.45737C17.3467 5.64404 19.5067 4.4707 21.9201 4.4707C26.0134 4.4707 29.3334 7.80404 29.3334 11.924C29.3334 21.2574 20.6934 26.764 16.8267 28.084Z" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg></a>
                <div class="header__cart"><svg viewBox="0 0 32 33" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10 10.5636V9.27026C10 6.27026 12.4133 3.32359 15.4133 3.04359C18.9867 2.69693 22 5.51026 22 9.01693V10.8569" stroke="#292D32" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M12 29.6706H20C25.36 29.6706 26.32 27.5239 26.6 24.9106L27.6 16.9106C27.96 13.6572 27.0267 11.0039 21.3333 11.0039H10.6667C4.97335 11.0039 4.04001 13.6572 4.40001 16.9106L5.40001 24.9106C5.68001 27.5239 6.64001 29.6706 12 29.6706Z" stroke="#292D32" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M20.6606 16.3366H20.6725" stroke="#292D32" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M11.3261 16.3366H11.3381" stroke="#292D32" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
            </div>
        </div>

    </div>
</header>