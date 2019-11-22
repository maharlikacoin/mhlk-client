<footer class="nk-footer bg-theme-grad has-ovm">
    <section class="section no-pdy section-contact bg-transparent has-ovm" id="contact">

        <div class="container">
            <div class="nk-block block-contact">
                <div class="row justify-content-center no-gutters">
                    <div class="col-lg-6">
                        <div class="contact-wrap split split-left split-lg-left bg-white">
                            <h5 class="title title-md">Contact Us</h5>

                            <form method="POST" action="{{ route('contact-us') }}">
                                @csrf
                                <div class="field-item">
                                    <input id="name" name="name" type="text" class="input-line required">
                                    <label for="name" class="field-label field-label-line">Your Name</label>
                                </div>
                                <div class="field-item">
                                    <input id="email" name="email" type="email" class="input-line required email">
                                    <label for="email" class="field-label field-label-line">Your Email</label>
                                </div>
                                <div class="field-item">
                                    <textarea id="message" name="message"
                                              class="input-line input-textarea required"></textarea>
                                    <label for="message" class="field-label field-label-line">Your Message</label>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <button class="btn btn-lg btn-grad" type="submit">Submit</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div><!-- .col -->
                    <div class="col-lg-4">
                        <div class="contact-wrap split split-right split-lg-right bg-genitian bg-theme tc-light">
                            <div class="d-flex flex-column justify-content-between h-100">
                                <ul class="contact-list">
                                    <li>
                                        <a href="#">
                                            <i class="fas fa-building"></i>
                                        </a>
                                        <div class="contact-text">
                                            <h6>Formula Green Foundation</h6>
                                            <span>Zug, Switzerland</span>
                                        </div>
                                    </li>
                                    <li>
                                        <a href="mailto:support@maharlikacoin.com">
                                            <i class="fas fa-envelope-square"></i>
                                        </a>

                                        <div class="contact-text">
                                            <span>support@maharlikacoin.com</span>
                                        </div>
                                    </li>
                                </ul>
                                <div class="contact-social d-flex flex-column w-100 align-items-center">
                                    <h6>Be a part of our community</h6>
                                    <ul class="social-links">
                                        <li>
                                            <a href="https://www.facebook.com/maharlikacoin" target="_blank">
                                                <i class="fab fa-facebook-square"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://medium.com/maharlika-coin" target="_blank">
                                                <i class="fab fa-medium"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://twitter.com/maharlikacoin" target="_blank">
                                                <i class="fab fa-twitter-square"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://t.me/themaharlikacoin" target="_blank">
                                                <i class="fab fa-telegram-plane"></i>
                                            </a>
                                        </li>
                                    </ul>
                                    <ul class="social-links">
                                        <li>
                                            <a href="https://www.youtube.com/channel/UCS3wH4WzTQ1_cdFcdK6NphQ" target="_blank">
                                                <i class="fab fa-youtube"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://www.reddit.com/user/maharlikacoin" target="_blank">
                                                <i class="fab fa-reddit-square"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://github.com/maharlikacoin" target="_blank">
                                                <i class="fab fa-github-square"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://linkedin.com/company/maharlika-coin" target="_blank">
                                                <i class="fab fa-linkedin"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div><!-- .col -->
                </div><!-- .row -->
            </div><!-- .block @e -->
        </div>

        <div class="nk-ovm ovm-top ovm-h-60 bg-light"></div><!-- .nk-ovm -->
    </section>
    <!-- // -->
    <section class="section section-footer section-l tc-light bg-transparent">
        <div class="container">
            <div class="nk-block block-footer">
                <div class="row">

                    <div class="offset-lg-3 col-lg-4 col-sm-12 mb-4 mb-sm-0 d-flex justify-content-around">
                        <!-- Company -->
                        <div class="wgs wgs-menu">
                            <h6 class="wgs-title">Company</h6>
                            <div class="wgs-body">
                                <ul class="wgs-links">
                                    <li><a href="{{ route('about-us') }}">About Us</a></li>
                                    <li><a href="{{ route('team') }}">Meet Our Team</a></li>
                                    <li><a href="mailto:support@maharlikacoin.com">Contact Us</a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- Legal -->
                        <div class="wgs wgs-menu">
                            <h6 class="wgs-title">Legal</h6>
                            <div class="wgs-body">
                                <ul class="wgs-links">
                                    <li><a href="{{ route('terms') }}">Terms & Conditions</a></li>
                                    <li><a href="{{ route('privacy') }}">Privacy</a></li>
                                    <li><a href="{{ route('whitepaper') }}" target="_blank">Whitepaper</a></li>
                                </ul>
                            </div>
                        </div>
                    </div><!-- .col -->

                    <!-- Copyright -->
                    <div class="col-lg-5 mb-4 mb-lg-0 order-lg-first text-center">
                        <div class="wgs wgs-text">
                            <div class="wgs-body">
                                <a href="./" class="wgs-logo">
                                    <img src="/images/logo-full-white.png"
                                         style="width:15em;"
                                         srcset="/images/logo-full-white2x.png 2x" alt="logo">
                                </a>
                                <p>Copyright © 2019 Formula Green Foundation <br>All rights reserved. </p>
                            </div>
                        </div>
                    </div><!-- .col -->
                </div><!-- .row -->
            </div><!-- .block @e -->
        </div>

    </section>
    <div class="nk-ovm shape-b"></div>
</footer>
