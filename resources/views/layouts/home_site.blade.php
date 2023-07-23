<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Arsha Bootstrap Template - Index</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{ url('/') }}/img/favicon.png" rel="icon">
  <link href="{{ url('/') }}/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Jost:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ url('/') }}/css/aos/aos.css" rel="stylesheet">
  <link href="{{ url('/') }}/css/bootstrap.min.css" rel="stylesheet">
  <link href="{{ url('/') }}/css/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="{{ url('/') }}/css/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="{{ url('/') }}/css/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="{{ url('/') }}/css/remixicon/remixicon.css" rel="stylesheet">
  <link href="{{ url('/') }}/css/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ url('/') }}/css/template/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Arsha
  * Updated: Mar 10 2023 with Bootstrap v5.2.3
  * Template URL: https://bootstrapmade.com/arsha-free-bootstrap-html-template-corporate/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top ">
    <div class="container d-flex align-items-center">

      <h1 class="logo me-auto"><a href="index.html">PAT-GOMME</a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
          <li><a class="nav-link scrollto" href="#about">Chi siamo</a></li>
          <li><a class="nav-link scrollto" href="#services">Servizi</a></li>
          <li><a class="nav-link scrollto" href="#faq">FAQ</a></li>
          <li><a class="nav-link scrollto" href="#contact">Contatti</a></li>
          <li><a class="getstarted scrollto" href="{{ route('user.loginPage') }}">Accedi</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center">

    <div class="container">
      <div class="row">

        <div class="col-lg-6 d-flex flex-column justify-content-center pt-4 pt-lg-0 order-2 order-lg-1" data-aos="fade-up" data-aos-delay="200">

          <h1>La tua officina di fiducia</h1>
          <h2>Gommista auto e furgoni - Meccanica leggera</h2>
          <div class="d-flex justify-content-center justify-content-lg-start">
            <a href="#about" class="btn-get-started scrollto" style="margin-right: 10px;">Chi siamo</a>
            <a href="#contact" class="btn-get-started scrollto">Contatti</a>
          </div>

        </div>

        <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-in" data-aos-delay="200">
          <img src="{{ url('/') }}/img/foto_officina_stilizzata.png" class="img-fluid animated" alt="">
        </div>

      </div>
    </div>

  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= marchi Section ======= -->
    <section id="clients" class="clients section-bg">
      <div class="container">

        <div class="row" data-aos="zoom-in">

          <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
            <img src="{{ url('/') }}/img/marchi/kleber.png" class="img-fluid" alt="">
          </div>

          <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
            <img src="{{ url('/') }}/img/marchi/nexen2.png" class="img-fluid" alt="">
          </div>

          <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
            <img src="{{ url('/') }}/img/marchi/hankook.png" class="img-fluid" alt="">
          </div>

          <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
            <img src="{{ url('/') }}/img/marchi/bridgestone.png" class="img-fluid" alt="">
          </div>

          <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
            <img src="{{ url('/') }}/img/marchi/michelin.png" class="img-fluid" alt="">
          </div>

          <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
            <img src="{{ url('/') }}/img/marchi/pirelli.png" class="img-fluid" alt="">
          </div>

          <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
            <img src="{{ url('/') }}/img/marchi/goodyear.png" class="img-fluid" alt="">
          </div>

          <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
            <img src="{{ url('/') }}/img/marchi/continental.png" class="img-fluid" alt="">
          </div>
          
          <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
            <img src="{{ url('/') }}/img/marchi/momo.png" class="img-fluid" alt="">
          </div>

          <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
            <img src="{{ url('/') }}/img/marchi/kumho.png" class="img-fluid" alt="">
          </div>

          <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
            <img src="{{ url('/') }}/img/marchi/sailun.png" class="img-fluid" alt="">
          </div>

          <!-- fine loghi pneumatici -->

          <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
            <img src="{{ url('/') }}/img/marchi/fiamm.png" class="img-fluid" alt="">
          </div>

          <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
            <img src="{{ url('/') }}/img/marchi/bosch.png" class="img-fluid" alt="">
          </div>

          <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
            <img src="{{ url('/') }}/img/marchi/osram.png" class="img-fluid" alt="">
          </div>

          <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
            <img src="{{ url('/') }}/img/marchi/brembo.png" class="img-fluid" alt="">
          </div>

          <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
            <img src="{{ url('/') }}/img/marchi/ferodo.png" class="img-fluid" alt="">
          </div>

          <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
            <img src="{{ url('/') }}/img/marchi/ufi.png" class="img-fluid" alt="">
          </div>

          <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
            <img src="{{ url('/') }}/img/marchi/mann_filter.png" class="img-fluid" alt="">
          </div>

      </div>
    </section><!-- End Cliens Section -->

    <!-- ======= About Us Section ======= -->
    <section id="about" class="about">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Chi siamo</h2>
        </div>

        <div class="row content">
          <div class="col-lg-6">
            <p>
            Gommista da oltre 20 anni. Sempre a disposizione del cliente.  
            Montiamo anche le gomme acquistate dal cliente su Internet. Vieni a trovarci in officina per scoprire gli altri servizi!
            </p>
            <ul>
              <li><i class="ri-check-double-line"></i> Sostituzione e riparazioni gomme</li>
              <li><i class="ri-check-double-line"></i> Convergenza</li>
              <li><i class="ri-check-double-line"></i> tagliando</li>
              <li><i class="ri-check-double-line"></i> ... tanti altri servizi</li>
            </ul>
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0">
            <p>
              Visita il nostro profilo su google per scoprire cosa pensano di noi i clienti!
            </p>
            <a href="https://goo.gl/maps/BnhaZRmGSYPZHp4u7" class="btn-learn-more">Vai!</a>
          </div>
        </div>

      </div>
    </section><!-- End About Us Section -->

    <!-- ======= Services Section ======= -->
    <section id="services" class="services section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Servizi</h2>
          <p> Nella nostra officina trovi molti servizi. Registrati al nostro portale per richiedere un appuntamento per i tuoi veicoli.
            <br> Non trovi quello che cerchi? Per richeste particolari passa in officina.
          </p>
        </div>

        <div class="row">
          <div class="col-xl-3 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
            <div class="icon-box">
              <div class="icon"><i class="bx bx-layer"></i></div>
              <h4><a href="">Cambio pneumatici </a></h4>
              <p>Sia per la stagione estiva che per la stagione invernale. </p>
            </div>
          </div>

          <div class="col-xl-3 col-md-6 d-flex align-items-stretch mt-4 mt-md-0" data-aos="zoom-in" data-aos-delay="200">
            <div class="icon-box">
              <div class="icon"><i class="bx bx-layer"></i></div>
              <h4><a href="">Inversione pneumatici</a></h4>
              <p>Controlla lo stato e rendi più duraturi i tuoi pneumatici.</p>
            </div>
          </div>

          <div class="col-xl-3 col-md-6 d-flex align-items-stretch mt-4 mt-xl-0" data-aos="zoom-in" data-aos-delay="400">
            <div class="icon-box">
              <div class="icon"><i class="bx bx-layer"></i></div>
              <h4><a href="">Deposito pneumatici auto</a></h4>
              <p>Se c'è spazio te li teniamo noi!</p>
            </div>
          </div>

          <div class="col-xl-3 col-md-6 d-flex align-items-stretch mt-4 mt-xl-0" data-aos="zoom-in" data-aos-delay="300">
            <div class="icon-box">
              <div class="icon"><i class="bx bx-layer"></i></div>
              <h4><a href="">Convergenza auto</a></h4>
              <p>La macchina va storta? Verifichiamo e sistemiamo l'assetto delle ruote.</p>
            </div>
          </div>

          <div class="col-xl-3 col-md-6 d-flex align-items-stretch mt-4 mt-xl-0" data-aos="zoom-in" data-aos-delay="400">
            <div class="icon-box">
              <div class="icon"><i class="bx bx-layer"></i></div>
              <h4><a href="">Tagliando</a></h4>
              <p>Effettua una manutenzione periodica, cambia i filtri quando serve.</p>
            </div>
          </div>
          
          <div class="col-xl-3 col-md-6 d-flex align-items-stretch mt-4 mt-xl-0" data-aos="zoom-in" data-aos-delay="400">
            <div class="icon-box">
              <div class="icon"><i class="bx bx-layer"></i></div>
              <h4><a href="">Dischi e pastiglie</a></h4>
              <p>Fermarsi è importante tanto quanto partire.</p>
            </div>
          </div>

          <div class="col-xl-3 col-md-6 d-flex align-items-stretch mt-4 mt-xl-0" data-aos="zoom-in" data-aos-delay="400">
            <div class="icon-box">
              <div class="icon"><i class="bx bx-layer"></i></div>
              <h4><a href="">Lampadine</a></h4>
              <p>Chi ha spento le luci? Ci pensiamo noi a far brillare il tuo veicolo.</p>
            </div>
          </div>

          <div class="col-xl-3 col-md-6 d-flex align-items-stretch mt-4 mt-xl-0" data-aos="zoom-in" data-aos-delay="400">
            <div class="icon-box">
              <div class="icon"><i class="bx bx-layer"></i></div>
              <h4><a href="">Sostituzione batteria</a></h4>
              <p>Non parte? Ti diamo una nuova spinta.</p>
            </div>
          </div>
        </div>

      </div>
    </section><!-- End Services Section -->

    <!-- ======= Frequently Asked Questions Section ======= -->
    <section id="faq" class="faq">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Frequently Asked Questions</h2>
        </div>

        <div class="faq-list">
          <ul>
            <li data-aos="fade-up" data-aos-delay="100">
              <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" class="collapse" data-bs-target="#faq-list-1">Quando devo effettuare il tagliando? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
              <div id="faq-list-1" class="collapse show" data-bs-parent=".faq-list">
                <p>
                  La risposta dipende molto da cosa suggerisce la casa produttrice. Raccomandiamo di controllare nei manuali del veicolo, inoltre suggeriamo di svolgere sempre un cambio olio e filtro olio ogni circa 15 000 km.
                </p>
              </div>
            </li>

            <li data-aos="fade-up" data-aos-delay="200">
              <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" data-bs-target="#faq-list-2" class="collapsed">Sento i freni fischiare, cosa può essere? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
              <div id="faq-list-2" class="collapse" data-bs-parent=".faq-list">
                <p>
                  Quando i freni iniziano a fischiare molto probabilmente si stanno usurando e sono da sostituire. Non sempre però è questo il motivo, suggeriamo quindi di passare in officina per un controllo.
                </p>
              </div>
            </li>

            <li data-aos="fade-up" data-aos-delay="300">
              <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" data-bs-target="#faq-list-3" class="collapsed">Quando devo montare gli pneumatici invernali? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
              <div id="faq-list-3" class="collapse" data-bs-parent=".faq-list">
                <p>
                  L'obbligo degli pneumatici invernali inizia dal 15 Novembre, abbiamo però la possibilità di iniziare a sostituire gli pneumatici già dal 15 Ottobre.
                </p>
              </div>
            </li>

            <li data-aos="fade-up" data-aos-delay="400">
              <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" data-bs-target="#faq-list-4" class="collapsed">Quando devo montare gli pneumatici estivi? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
              <div id="faq-list-4" class="collapse" data-bs-parent=".faq-list">
                <p>
                  L'obbligo degli pneumatici invernali termina il 15 Aprile, abbiamo tempo fino al 15 Maggio per montare gli pneumatici estivi.
                </p>
              </div>
            </li>

            <li data-aos="fade-up" data-aos-delay="500">
              <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" data-bs-target="#faq-list-5" class="collapsed">Come mi devo comportare con gli pneumatici 4 stagioni? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
              <div id="faq-list-5" class="collapse" data-bs-parent=".faq-list">
                <p>
                  Gli pneumatici 4 stagioni posso essere usate per tutto l'anno, raccomandiamo l'inversione degli pneumatici tra l'asse anteriore e l'asse posteriore ogni circa 10 000 km.
                </p>
              </div>
            </li>

          </ul>
        </div>

      </div>
    </section><!-- End Frequently Asked Questions Section -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Contatti</h2>
          <p>Passa direttamente in officina per un preventivo gratuito. Registrati e utilizza il nostro sistema di prenotazione.</p>
        </div>

        <div class="row d-flex justify-content-center">

          <div class="col-lg-5 d-flex align-items-stretch">
            <div class="info">
              <div class="address">
                <i class="bi bi-geo-alt"></i>
                <h4>Luogo:</h4>
                <p>Via Angelo Antoni, 41 Sarezzo (BS)</p>
              </div>

              <div class="email">
                <i class="bi bi-envelope"></i>
                <h4>Email:</h4>
                <p>info@patgomme.com</p>
              </div>

              <div class="phone">
                <i class="bi bi-phone"></i>
                <h4>Telefono:</h4>
                <p>030 11111</p>
              </div>

              <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d11156.26874536354!2d10.2035812!3d45.6494725!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4781796fbcbde82f%3A0x729adf9d9fabeca5!2sPat-Gomme!5e0!3m2!1sit!2sit!4v1684923853064!5m2!1sit!2sit" frameborder="0" style="border:0; width: 100%; height: 290px;" allowfullscreen></iframe>
            </div>

          </div>

        </div>

      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="container footer-bottom clearfix">
      <div class="copyright">
        &copy; Copyright <strong><span>Youssef El fadi</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/arsha-free-bootstrap-html-template-corporate/ -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{ url('/') }}/js/aos/aos.js"></script>
  <script src="{{ url('/') }}/js/bootstrap.bundle.min.js"></script>
  <script src="{{ url('/') }}/js/glightbox/glightbox.min.js"></script>
  <script src="{{ url('/') }}/js/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="{{ url('/') }}/js/swiper/swiper-bundle.min.js"></script>
  <script src="{{ url('/') }}/js/waypoints/noframework.waypoints.js"></script>

  <!-- Template Main JS File -->
  <script src="{{ url('/') }}/js/template/main.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment-with-locales.min.js"></script>
</body>

</html>