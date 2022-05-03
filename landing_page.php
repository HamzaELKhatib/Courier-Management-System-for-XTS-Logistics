<?php
include 'header.php';
?>


<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">
        <img src="assets/dist/img/pic1.png" width="30" height="30" class="d-inline-block align-top" alt="">
        XTS Logistics
    </a>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
        </ul>
        <a href=".php" style="text-decoration: none">
            <button class="btn btn-outline-danger my-2 my-sm-0" type="submit">Suivre colis</button>
        </a>
        &nbsp;&nbsp;&nbsp;
        <a href="login.php" style="text-decoration: none">
            <button class="btn btn-outline-danger my-2 my-sm-0" type="submit"> Espace employés</button>
        </a>
    </div>
</nav>


<body>
<div id="landing-wrapper">

    <div class="main-title">
        <h2 class="text-center" style="font-size: 500%"><img src="assets/dist/img/pic1.png" width="100" height="100" class="d-inline-block align-top" alt="">
            <b style="color: red"> XTS</b><b> Logistics</b></h2>
        <br>
        <p class="text-center">
          <b style="font-size: 150%; font-family: 'Courgette', cursive;">  Votre satisfaction est notre priorité.</b>
        </p>
    </div>
</div>


<main id="main">
    <!-- ======= About Us Section ======= -->
    <section id="about" class="about">
        <div class="container">

            <div class="row mt-2">
                <div class="col-lg-4 col-md-6 icon-box">
                    <div class="icon"><i class="bi bi-briefcase"></i></div>
                    <h4 class="title">Lorem Ipsum</h4>
                    <p class="description">
                        Voluptatum deleniti atque corrupti quos dolores et quas
                        molestias excepturi sint occaecati cupiditate non provident
                    </p>
                </div>
                <div class="col-lg-4 col-md-6 icon-box">
                    <div class="icon"><i class="bi bi-bar-chart"></i></div>
                    <h4 class="title">Dolor Sitema</h4>
                    <p class="description">
                        Minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                        aliquip ex ea commodo consequat tarad limino ata
                    </p>
                </div>
                <div class="col-lg-4 col-md-6 icon-box">
                    <div class="icon"><i class="bi bi-brightness-high"></i></div>
                    <h4 class="title">Sed ut perspiciatis</h4>
                    <p class="description">
                        Duis aute irure dolor in reprehenderit in voluptate velit esse
                        cillum dolore eu fugiat nulla pariatur
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!-- End About Us Section -->

    <!-- ======= Contact Us Section ======= -->
    <section id="contact" class="contact">
        <div class="container">
            <div class="section-title">
                <h2>Trouvez Nous</h2>
            </div>

            <div class="row d-flex justify-content-center">
                <div class="col-lg-5 d-flex align-items-stretch ">
                    <div class="info  ">
                        <div class="address">
                            <i class="bi bi-geo-alt"></i>
                            <h4>Location:</h4>
                            <p>16 Avenue El Hajeb,
                                Lotissement Attar,<br> M'hannech 2, 93000,
                                Tétouan, Tanger-Tétouan-Alhoceima
                                Maroc</p>
                        </div>

                        <div class="email">
                            <i class="bi bi-envelope"></i>
                            <h4>Horaires d'ouverture:</h4>
                            <p>24h/7j</p>
                        </div>

                        <div class="phone">
                            <i class="bi bi-phone"></i>
                            <h4>Appelez:</h4>
                            <p>+212 6-39-49-39-00</p>
                        </div>

                        <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1929.1290879260048!2d-5.361514606840777!3d35.56602779808345!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x69d646b3ffe11e75!2zMzXCsDMzJzU3LjciTiA1wrAyMSczOS4wIlc!5e1!3m2!1sen!2sma!4v1638220762393!5m2!1sen!2sma"
                                frameborder="0"
                                style="border: 0; width: 100%; height: 290px"
                                allowfullscreen
                        ></iframe>
                    </div>
                </div>


            </div>
        </div>
    </section>
    <!-- End Contact Us Section -->
</main>
</body>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Courgette&display=swap');

    main {
        position: absolute;
        z-index:1;
        color: white;
        /* appear under second div */
        top: 200%;
        left: 50%;
        -webkit-transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
    }
    body {
        background: #02162c;
    }

    #landing-wrapper {
        position: absolute;
        z-index: 1;
        height: 130%;
        width: 100%;
        margin: auto;
        background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url(assets/dist/img/timelab-pro-sWOvgOOFk1g-unsplash.jpg) no-repeat bottom center/cover;
    }
    section {
        padding: 60px 0;
        overflow: hidden;
    }

    .main-title{
        position: absolute;
        z-index: 2;
        color: white;
        /*center a div*/
        top: 50%;
        left: 50%;
        -webkit-transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
    }

    .section-title {
        text-align: center;
        padding-bottom: 50%;
    }
    .section-title h2 {
        font-size: 32px;
        font-weight: bold;
        text-transform: uppercase;
        margin-bottom: 20px;
        padding-bottom: 20px;
        position: relative;
    }
    .section-title h2::after {
        content: "";
        position: absolute;
        display: block;
        width: 50px;
        height: 2px;
        background: #24b7a4;
        bottom: 0;
        left: calc(50% - 25px);
    }
    .section-title p {
        margin-bottom: 0;
    }
    .section-title {
        position: absolute;
        z-index: 2;
        color: white;
        /*center a div*/
        top: 50%;
        left: 50%;
        -webkit-transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
    }

    #parcel-wrapper {
        z-index: 1;
        /* appear under #landing-wrapper */
        position: absolute;
        top: 120%;
        left: 50%;
        -webkit-transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
    }
    .about .icon-box {
        margin-bottom: 20px;
        text-align: center;
    }
    .about .icon {
        display: flex;
        justify-content: center;
        margin-bottom: 15px;
    }
    .about .icon i {
        color: #fff;
        font-size: 42px;
        line-height: 0;
    }
    .about .title {
        font-weight: 700;
        margin-bottom: 15px;
        font-size: 18px;
        text-transform: uppercase;
    }
    .about .title a {
        color: #fff;
        transition: 0.3s;
    }
    .about .description {
        line-height: 24px;
        font-size: 14px;
    }
    .contact .info {
        border-top: 3px solid #24b7a4;
        border-bottom: 3px solid #24b7a4;
        padding: 30px;
        background: rgba(255, 255, 255, 0.06);
        width: 100%;
        box-shadow: 0 0 24px 0 rgba(0, 0, 0, 0.12);
    }
    .contact .info i {
        font-size: 20px;
        color: #fff;
        float: left;
        width: 44px;
        height: 44px;
        background: rgba(255, 255, 255, 0.1);
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 50px;
        transition: all 0.3s ease-in-out;
    }
    .contact .info h4 {
        padding: 0 0 0 60px;
        font-size: 22px;
        font-weight: 600;
        margin-bottom: 5px;
    }
    .contact .info p {
        padding: 0 0 10px 60px;
        margin-bottom: 20px;
        font-size: 14px;
    }
    .contact .info .email p {
        padding-top: 5px;
    }
    .contact .info .social-links {
        padding-left: 60px;
    }
    .contact .info .social-links a {
        font-size: 18px;
        display: inline-block;
        background: #333;
        color: #fff;
        line-height: 1;
        padding: 8px 0;
        border-radius: 50%;
        text-align: center;
        width: 36px;
        height: 36px;
        transition: 0.3s;
        margin-right: 10px;
    }
    .contact .info .social-links a:hover {
        background: #24b7a4;
        color: #fff;
    }
</style>