<?php
    include("login.php");//directs to login page
?>


<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!--=============== FAVICON ===============-->
        <link rel="icon" href="#" type="image/x-icon">

        <!--=============== REMIX ICONS ===============-->

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.2.0/remixicon.css" integrity="sha512-OQDNdI5rpnZ0BRhhJc+btbbtnxaj+LdQFeh0V9/igiEPDiWE2fG+ZsXl0JEH+bjXKPJ3zcXqNyP4/F/NegVdZg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <!--=============== CSS ===============-->
        <link rel="stylesheet" href="/assets/CSS/landingpage.css">

        <title>Expense management system</title>
    </head>
    <body>
        <!--==================== HEADER ====================-->
        <header class="header" id="header">
            <nav class="nav container">
                <a href="#" class="nav__logo">
                    <i class="ri-puzzle-2-fill"></i> Money management
                </a>

                <div class="nav__menu" id="nav-menu">
                    <ul class="nav__list">
                        <li class="nav__item">
                            <a href="#home" class="nav__link active-link">Home</a>  <!-- Current page -->
                        </li>
                        <li class="nav__item">
                            <a href="#about" class="nav__link">About</a>
                        </li>
                        <li class="nav__item">
                            <a href="#features" class="nav__link">Features</a>
                        </li>
                        <li class="nav__item">
                            <a href="#faqs" class="nav__link">FAQs</a>
                        </li>
                    </ul>

                    <div class="nav__close" id="nav-close">
                        <i class="ri-close-line"></i>
                    </div>
                </div>

                <div class="nav__btns">
                    <!-- Login/Signup -->
                    <a href="login.php" class="button button--flex"> 
                        Get Started 
                    </a>
                        
                    </div>
                </div>
            </nav>
        </header>

        <main class="main">
            <!--==================== HOME ====================-->
            <section class="home" id="home">
                
                    <div class="home__data">
                        <h1 class="home__title">
                            Platform to <br> make your life better
                        </h1>
                        <p class="home__description">
                            Keep your finances organized.<br>
                            Make thoughtful decisions.
                        </p>
                        <a href="#about" class="button button--flex">
                            Explore <i class="ri-arrow-right-down-line button__icon"></i>
                        </a>
                    </div>

            </section>

            <!--==================== ABOUT ====================-->
            <section class="about section container" id="about">
                <div class="about__container grid">
                    
                    <div class="about__data">
                        <h2 class="section__title about__title">
                            Who we really are & why choose us
                        </h2>

                        <p class="about__description">
                            It's The Expense management System.
                        </p>

                        <div class="about__details">
                            <p class="about__details-description">
                                <i class="ri-focus-fill"></i>
                                We always provide highest security.
                            </p>
                            <p class="about__details-description">
                                <i class="ri-focus-fill"></i>
                                We give you guides to protect and care for your finances.
                            </p>
                            <p class="about__details-description">
                                <i class="ri-focus-fill"></i>
                                We always try to keep the site up-to-date.
                            </p>
                            <p class="about__details-description">
                                <i class="ri-focus-fill"></i>
                                We want to help you to organize your financial life better.
                            </p>
                        </div>

                        <!-- <a href="#" class="button--link button--flex">
                            Get Started <i class="ri-arrow-right-down-line button__icon"></i>
                        </a> -->
                    </div>
                </div>
            </section>

            <!--==================== STEPS ====================-->
            <section class="steps section container">
                <div class="steps__bg">
                    <h2 class="section__title-center steps__title">
                        Get stared right away.
                    </h2>

                    <div class="steps__container grid">
                        <div class="steps__card">
                            <div class="steps__card-number">01</div>
                            <h3 class="steps__card-title">Login/SignUp</h3>
                            <p class="steps__card-description">
                                Try our site.
                            </p>
                        </div>

                        <div class="steps__card">
                            <div class="steps__card-number">02</div>
                            <h3 class="steps__card-title">Customize</h3>
                            <p class="steps__card-description">
                                Set up your own finances better yourself.
                            </p>
                        </div>

                        <div class="steps__card">
                            <div class="steps__card-number">03</div>
                            <h3 class="steps__card-title">Voila!</h3>
                            <p class="steps__card-description">
                                Keep your money organized and tracked at all time.
                            </p>
                        </div>
                    </div>
                </div>
            </section>

            <!--==================== features ====================-->
                <section class="product section container" id="features">
                    <h2 class="section__title-center">
                        Check out our <br> Features.
                    </h2>
                
                    <p class="features__description">
                        Here are some awesome features that just is amazing.
                    </p>
                
                    <div class="features__container grid">
                    <article class="features__card">
                        <i class="ri-wallet-3-line features__icon"></i>
                        <h3 class="features__title">Income</h3>
                        <p class="features__description-text">
                            Manage your income efficiently.
                        </p>
                    </article>
                
                    <article class="features__card">
                        <i class="ri-wallet-3-line features__icon"></i>
                        <h3 class="features__title">Expense</h3>
                        <p class="features__description-text">
                            Track your daily expenses easily.
                        </p>
                    </article>
                
                    <article class="features__card">
                        <i class="ri-wallet-3-line features__icon"></i>
                        <h3 class="features__title">Savings</h3>
                        <p class="features__description-text">
                            Monitor your savings effectively.
                        </p>
                    </article>
                
                    <article class="features__card">
                        <i class="ri-wallet-3-line features__icon"></i>
                        <h3 class="features__title">Investments</h3>
                        <p class="features__description-text">
                            Keep track of your investments.
                        </p>
                    </article>
                    </div>
                </section>
  

            <!--==================== QUESTIONS ====================-->
            <section class="questions section" id="faqs">
                <h2 class="section__title-center questions__title container">
                    Some common questions <br> were often asked
                </h2>

                <div class="questions__container container grid">
                    <div class="questions__group">
                        <div class="questions__item">
                            <header class="questions__header">
                                <i class="ri-add-line questions__icon"></i>
                                <h3 class="questions__item-title">
                                    Is this worth it?
                                </h3>
                            </header>

                            <div class="questions__content">
                                <p class="questions__description">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                </p>
                            </div>
                        </div>

                        <div class="questions__item">
                            <header class="questions__header">
                                <i class="ri-add-line questions__icon"></i>
                                <h3 class="questions__item-title">
                                    Is this worth it?
                                </h3>
                            </header>

                            <div class="questions__content">
                                <p class="questions__description">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                </p>
                            </div>
                        </div>

                        <div class="questions__item">
                            <header class="questions__header">
                                <i class="ri-add-line questions__icon"></i>
                                <h3 class="questions__item-title">
                                    Is this worth it?
                                </h3>
                            </header>

                            <div class="questions__content">
                                <p class="questions__description">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="questions__group">
                        <div class="questions__item">
                            <header class="questions__header">
                                <i class="ri-add-line questions__icon"></i>
                                <h3 class="questions__item-title">
                                    Is this worth it?
                                </h3>
                            </header>

                            <div class="questions__content">
                                <p class="questions__description">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                </p>
                            </div>
                        </div>

                        <div class="questions__item">
                            <header class="questions__header">
                                <i class="ri-add-line questions__icon"></i>
                                <h3 class="questions__item-title">
                                    Is this worth it?
                                </h3>
                            </header>

                            <div class="questions__content">
                                <p class="questions__description">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                </p>
                            </div>
                        </div>

                        <div class="questions__item">
                            <header class="questions__header">
                                <i class="ri-add-line questions__icon"></i>
                                <h3 class="questions__item-title">
                                    Is this worth it?
                                </h3>
                            </header>

                            <div class="questions__content">
                                <p class="questions__description">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </main>

        <!--==================== FOOTER ====================-->
        <footer class="footer section">
            <div class="footer__container container grid">
                <div class="footer__content">
                    <a href="#" class="footer__logo">
                        <i class="ri-puzzle-2-fill"></i> MoneyMan
                    </a>

                    <!-- <h3 class="footer__title">
                        
                    </h3> -->

                </div>

                <div class="footer__content">
                    <h3 class="footer__title">Our Address</h3>

                    <ul class="footer__data">
                        <li class="footer__information">1234 - Peru</li>
                        <li class="footer__information">La Libertad - 43210</li>
                        <li class="footer__information">123-456-789</li>
                    </ul>
                </div>

                <div class="footer__content">
                    <h3 class="footer__title">Contact Us</h3>

                    <ul class="footer__data">
                        <li class="footer__information">+999 888 777</li>
                        
                        <div class="footer__social">
                            <a href="https://www.facebook.com/" class="footer__social-link">
                                <i class="ri-facebook-fill"></i>
                            </a>
                            <a href="https://www.instagram.com/" class="footer__social-link">
                                <i class="ri-instagram-line"></i>
                            </a>
                            <a href="https://twitter.com/" class="footer__social-link">
                                <i class="ri-twitter-fill"></i>
                            </a>
                        </div>
                    </ul>
                </div>

                <div class="footer__content">
                    <h3 class="footer__title">
                        Have a Great journey with us.
                    </h3>

                </div>
            </div>

            <p class="footer__copy">&#169; By CSE Students</p>
        </footer>
        
        <!--=============== SCROLL UP ===============-->
        <a href="#" class="scrollup" id="scroll-up"> 
            <i class="ri-arrow-up-fill scrollup__icon"></i>
        </a>

        <!--=============== SCROLL REVEAL ===============-->
        <script src="assets/js/scrollreveal.min.js"></script>
        
        <!--=============== MAIN JS ===============-->
        <script src="assets/js/main.js"></script>
    </body>
</html>
