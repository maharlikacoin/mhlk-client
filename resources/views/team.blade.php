@extends('layouts.app')

@section('title') Team @stop
@section('banner')
    <div class="header-banner bg-theme-grad has-ovm">
        <div class="nk-banner">
            <div class="banner banner-page">
                <div class="banner-wrap">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-xl-6 col-lg-9">
                                <div class="banner-caption cpn tc-light text-center">
                                    <div class="cpn-head">
                                        <h2 class="title ttu">Team</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- .nk-banner -->
        <div class="nk-ovm shape-a-sm"></div>
    </div>
@stop

@section('content')
    <main class="nk-pages">
        <section class="section section-l section-team bg-light">

            <div class="container">
                <!-- Block @s -->
                <div class="nk-block nk-block-team-featured team-featured">
                    <div class="row align-items-center">
                        <div class="col-lg-5 mb-4 mb-lg-0 text-center">
                            <div class="team-photo team-photo-sm">
                                <img src="/images/team/01-paul.jpg" alt="Mr. Paul Infante Moñozca">
                                <ul class="team-social">
                                    <li>
                                        <a href="https://www.linkedin.com/in/paul-infante-mo%C3%B1ozca-99185347/" target="_blank">
                                            <em class="fab fa-linkedin-in"></em>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <h5 class="mt-4">
                                Mr. Paul Infante Moñozca
                            </h5>
                        </div>
                        <div class="col-lg-7">
                            <div class="team-featured-cont">
                                <h2 class="title title-lg title-dark">
                                    Executive Chairman & CEO
                                    <span class="flag-size-md flag-icon flag-icon-ph"></span>
                                </h2>
                                <p class="text-justify">Paul is the chairman of the European-based Maharlika Trust and
                                    the Dr. AB Moñozca
                                    Foundation. His other interests include property, financial technology, food &
                                    beverage, and sports. Awarded the Singapore Sports Inspiration Award by the
                                    Singapore government and given various recognitions for his advocacy on
                                    philanthrocapitalism, he also held multinational positions in such global companies such
                                    as PricewaterhouseCoopers, Siemens, and the Quaker Oats Company with roles in
                                    corporate finance, business development and brand communications during his 20-year
                                    career in Singapore. He continuously serves as a Director for Philanthropy for
                                    European and Emirati royal family offices, respectively, and advocates a shared
                                    resources economy for humanity.</p>
                            </div>
                        </div>
                    </div><!-- .row -->
                </div>
                <!-- Block @e -->
            </div>

        </section>
        <!-- // -->
        <section class="section section-l section-team bg-light-alt">

            <div class="container">
                <!-- Section Head @s -->
                <div class="section-head text-center wide-auto">
                    <h2 class="title title-lg title-dark">Our People</h2>
                </div><!-- .section-head @e -->
                <!-- Block @s -->
                <div class="nk-block nk-block-team-list team-list">
                    <div class="row justify-content-center">

                        <!-- Mr. Demitri Hopkins -->
                        <div class="col-md-3 col-6">
                            <div class="team">
                                <div class="team-photo team-photo-sm">
                                    <img src="/images/team/02-demitri.jpg" alt="Mr. Demitri Hopkins">
                                    <a href="#team-popup-2" class="team-show content-popup"></a>
                                    <ul class="team-social">
                                        <li>
                                            <a href="https://www.linkedin.com/in/demitri-hopkins-54260a106" target="_blank">
                                                <em class="fab fa-linkedin-in"></em>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <h5 class="team-name title title-sm">Mr. Demitri Hopkins</h5>
                                <span class="team-position">Director for Fusion Energy</span>
                                <br><span class="flag-size-md flag-icon flag-icon-us"></span>
                            </div>
                            <!-- Start .team-profile  -->
                            <div id="team-popup-2" class="team-popup mfp-hide">
                                <a title="Close" class="mfp-close">×</a>
                                <div class="row align-items-start">
                                    <div class="col-md-6">
                                        <div class="team-photo">
                                            <img src="/images/team/02-demitri.jpg" alt="Mr. Demitri Hopkins">
                                        </div>
                                    </div><!-- .col  -->
                                    <div class="col-md-6">
                                        <div class="team-popup-info pl-md-3">
                                            <h3 class="team-name title title-lg pt-4">
                                                Mr. Demitri Hopkins
                                                <span class="flag-size-md flag-icon flag-icon-us"></span>
                                            </h3>
                                            <p class="team-position">Director for Fusion Energy</p>
                                            <p class="text-justify">Demitri heads the Fusion Program of FGC together
                                                with a select group of
                                                scientists. He is a 25-year old physics and mathematical savant and an
                                                advocate of fusion energy. He co-founded AGNI Energy Inc. which is
                                                developing a modular fusion reactor which design combines the stability
                                                of magnetic containment with beam to target inertial fusion. His vision
                                                is to power humanity and explore new worlds through fusion energy for
                                                space exploration and travel.</p>
                                        </div>
                                    </div><!-- .col  -->
                                </div><!-- .row  -->
                            </div><!-- .team-profile  -->
                        </div><!-- .col -->

                        <!-- Mr. Simon Thomas  -->
                        <div class="col-md-3 col-6">
                            <div class="team">
                                <div class="team-photo team-photo-sm">
                                    <img src="/images/team/03-simon.jpg" alt="Mr. Simon Thomas ">
                                    <a href="#team-popup-3" class="team-show content-popup"></a>
                                    <ul class="team-social">
                                        <li>
                                            <a href="#" target="_blank">
                                                <em class="fab fa-linkedin-in"></em>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <h5 class="team-name title title-sm">Mr. Simon Thomas </h5>
                                <span class="team-position">Director for Finance</span>
                                <br><span class="flag-size-md flag-icon flag-icon-gb"></span>
                            </div>
                            <!-- Start .team-profile  -->
                            <div id="team-popup-3" class="team-popup mfp-hide">
                                <a title="Close" class="mfp-close">×</a>
                                <div class="row align-items-start">
                                    <div class="col-md-6">
                                        <div class="team-photo">
                                            <img src="/images/team/03-simon.jpg" alt="Mr. Simon Thomas ">
                                        </div>
                                    </div><!-- .col  -->
                                    <div class="col-md-6">
                                        <div class="team-popup-info pl-md-3">
                                            <h3 class="team-name title title-lg pt-4">
                                                Mr. Simon Thomas
                                                <span class="flag-size-md flag-icon flag-icon-gb"></span>
                                            </h3>
                                            <p class="team-position">Director for Finance</p>
                                            <p class="text-justify">Simon has been a finance professional for the past
                                                30 years and heads
                                                mergers & acquisitions (M&A) with overall corporate finance functions
                                                for FGC. He has had a close working relationship with a diverse range of
                                                family offices and funds all over the world and specializes in
                                                structured finance, bonds and fixed income instruments.
                                            </p>
                                        </div>
                                    </div><!-- .col  -->
                                </div><!-- .row  -->
                            </div><!-- .team-profile  -->
                        </div><!-- .col -->

                        <!-- Mr. Richard Cabael   -->
                        <div class="col-md-3 col-6">
                            <div class="team">
                                <div class="team-photo team-photo-sm">
                                    <img src="/images/team/04-rich.jpg" alt="Mr. Richard Cabael">
                                    <a href="#team-popup-4" class="team-show content-popup"></a>
                                    <ul class="team-social">
                                        <li>
                                            <a href="https://www.linkedin.com/in/richcabael" target="_blank">
                                                <em class="fab fa-linkedin-in"></em>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <h5 class="team-name title title-sm">Mr. Richard Cabael</h5>
                                <span class="team-position">Director for Corporate Development</span>
                                <br>
                                <span class="flag-size-md flag-icon flag-icon-ph"></span>
                                <span class="flag-size-md flag-icon flag-icon-us"></span>
                            </div>
                            <!-- Start .team-profile  -->
                            <div id="team-popup-4" class="team-popup mfp-hide">
                                <a title="Close" class="mfp-close">×</a>
                                <div class="row align-items-start">
                                    <div class="col-md-6">
                                        <div class="team-photo">
                                            <img src="/images/team/04-rich.jpg" alt="Mr. Richard Cabael">
                                        </div>
                                    </div><!-- .col  -->
                                    <div class="col-md-6">
                                        <div class="team-popup-info pl-md-3">
                                            <h3 class="team-name title title-lg pt-4">
                                                Mr. Richard Cabael
                                                <span class="flag-size-md flag-icon flag-icon-ph"></span>
                                                <span class="flag-size-md flag-icon flag-icon-us"></span>
                                            </h3>
                                            <p class="team-position">Director for Corporate Development</p>
                                            <p class="text-justify">Tasked to head overall corporate development, Rich
                                                has prior interests in
                                                technology and consumer good startups. He is behind the development,
                                                launch, and distribution of several liquor brands with presence in the
                                                Philippines, the Netherlands and the United States. Rich previously held
                                                positions with various technology companies in Silicon Valley, CA. He
                                                has provided value in organizational structure, product development,
                                                partnerships/alliances and has negotiated acquisitions and leveraged
                                                buy-outs.
                                            </p>
                                        </div>
                                    </div><!-- .col  -->
                                </div><!-- .row  -->
                            </div><!-- .team-profile  -->
                        </div><!-- .col -->

                        <!-- Mr. Allen Mascenon   -->
                        <div class="col-md-3 col-6">
                            <div class="team">
                                <div class="team-photo team-photo-sm">
                                    <img src="/images/team/05-allen.jpg" alt="Mr. Allen Mascenon">
                                    <a href="#team-popup-5" class="team-show content-popup"></a>
                                    <ul class="team-social">
                                        <li>
                                            <a href="https://www.linkedin.com/in/allenmascenon" target="_blank">
                                                <em class="fab fa-linkedin-in"></em>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <h5 class="team-name title title-sm">Mr. Allen Mascenon</h5>
                                <span class="team-position">Director for Ecosystems</span>
                                <br>
                                <span class="flag-size-md flag-icon flag-icon-ph"></span>
                            </div>
                            <!-- Start .team-profile  -->
                            <div id="team-popup-5" class="team-popup mfp-hide">
                                <a title="Close" class="mfp-close">×</a>
                                <div class="row align-items-start">
                                    <div class="col-md-6">
                                        <div class="team-photo">
                                            <img src="/images/team/05-allen.jpg" alt="Mr. Allen Mascenon">
                                        </div>
                                    </div><!-- .col  -->
                                    <div class="col-md-6">
                                        <div class="team-popup-info pl-md-3">
                                            <h3 class="team-name title title-lg pt-4">
                                                Mr. Allen Mascenon
                                                <span class="flag-size-md flag-icon flag-icon-ph"></span>
                                            </h3>
                                            <p class="team-position">Director for Ecosystems</p>
                                            <p class="text-justify">Allen is FGC’s Ecosystems Leader tasked to ensure
                                                that humanity as a
                                                whole enjoy a dividend system in this era of advocating a shared
                                                resources economy. He is behind one of the largest bill payment systems
                                                in the Philippines with over 1,500 franchises nationwide and expanding
                                                global operations. He has been recognized by the Business Initiative
                                                Directions Convention in Geneva, Switzerland for his efforts focused on
                                                electronic and mobile commerce.
                                            </p>
                                        </div>
                                    </div><!-- .col  -->
                                </div><!-- .row  -->
                            </div><!-- .team-profile  -->
                        </div><!-- .col -->

                        <!-- Mr. Ern Andrew Gregorio  -->
                        <div class="col-md-3 col-6">
                            <div class="team">
                                <div class="team-photo team-photo-sm">
                                    <img src="/images/team/06-ern.jpg" alt="Mr. Ern Andrew Gregorio">
                                    <a href="#team-popup-6" class="team-show content-popup"></a>
                                    <ul class="team-social">
                                        <li>
                                            <a href="https://www.linkedin.com/in/eacgregorio/" target="_blank">
                                                <em class="fab fa-linkedin-in"></em>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <h5 class="team-name title title-sm">Mr. Ern Gregorio</h5>
                                <span class="team-position">Head of Technology</span>
                                <br><span class="flag-size-md flag-icon flag-icon-ph"></span>
                            </div>
                            <!-- Start .team-profile  -->
                            <div id="team-popup-6" class="team-popup mfp-hide">
                                <a title="Close" class="mfp-close">×</a>
                                <div class="row align-items-start">
                                    <div class="col-md-6">
                                        <div class="team-photo">
                                            <img src="/images/team/06-ern.jpg" alt="Mr. Ern Andrew Gregorio">
                                        </div>
                                    </div><!-- .col  -->
                                    <div class="col-md-6">
                                        <div class="team-popup-info pl-md-3">
                                            <h3 class="team-name title title-lg pt-4">
                                                Mr. Ern Gregorio
                                                <span class="flag-size-md flag-icon flag-icon-ph"></span>
                                            </h3>
                                            <p class="team-position">Head of Technology</p>
                                            <p class="text-justify">Ern is FGC’s acting Chief Technology Officer (CTO)
                                                who oversees all aspects of technology including digital assets,
                                                artificial intelligence, machine learning, cloud and future initiatives
                                                of FGC.
                                                He has worked for companies such as IBM and Sonic Corporation,
                                                developing front
                                                and back-end systems along with design and integrations.
                                            </p>
                                        </div>
                                    </div><!-- .col  -->
                                </div><!-- .row  -->
                            </div><!-- .team-profile  -->
                        </div><!-- .col -->

                        <!-- Mr. Denis Lucindo  -->
                        <div class="col-md-3 col-6">
                            <div class="team">
                                <div class="team-photo team-photo-sm">
                                    <img src="/images/team/07-dennis.jpg" alt="Mr. Denis Lucindo">
                                    <a href="#team-popup-7" class="team-show content-popup"></a>
                                    <ul class="team-social">
                                        <li>
                                            <a href="https://www.linkedin.com/in/denis-lucindo-649a117" target="_blank">
                                                <em class="fab fa-linkedin-in"></em>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <h5 class="team-name title title-sm">Mr. Denis Lucindo</h5>
                                <span class="team-position">Director for Shared Resources</span>
                                <br><span class="flag-size-md flag-icon flag-icon-ph"></span>
                            </div>
                            <!-- Start .team-profile  -->
                            <div id="team-popup-7" class="team-popup mfp-hide">
                                <a title="Close" class="mfp-close">×</a>
                                <div class="row align-items-start">
                                    <div class="col-md-6">
                                        <div class="team-photo">
                                            <img src="/images/team/07-dennis.jpg" alt="Mr. Denis Lucindo">
                                        </div>
                                    </div><!-- .col  -->
                                    <div class="col-md-6">
                                        <div class="team-popup-info pl-md-3">
                                            <h3 class="team-name title title-lg pt-4">
                                                Mr. Denis Lucindo
                                                <span class="flag-size-md flag-icon flag-icon-ph"></span>
                                            </h3>
                                            <p class="team-position">Director for Shared Resources</p>
                                            <p class="text-justify">Denis has been a strategy, business development, and
                                                M&A professional for the past 20 years. He was previously with Metro
                                                Pacific Investments Corporation, the Philippine arm of Hong Kong listed
                                                First Pacific Corporation. He led the acquisition of Philex Mining as
                                                well as implementing best practices on several other natural resource
                                                and infrastructure investments. He has also held executive positions in
                                                food and media companies. Denis leads the 'Shared Resources Economy'
                                                initiative of FGC in partnership with various institutions worldwide.

                                            </p>
                                        </div>
                                    </div><!-- .col  -->
                                </div><!-- .row  -->
                            </div><!-- .team-profile  -->
                        </div><!-- .col -->

                        <!-- Mr. Arnold Alafriz   -->
                        <div class="col-md-3 col-6">
                            <div class="team">
                                <div class="team-photo team-photo-sm">
                                    <img src="/images/team/08-arnold.jpg" alt="Mr. Arnold Alafriz">
                                    <a href="#team-popup-8" class="team-show content-popup"></a>
                                    <ul class="team-social">
                                        <li>
                                            <a href="#" target="_blank">
                                                <em class="fab fa-linkedin-in"></em>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <h5 class="team-name title title-sm">Mr. Arnold Alafriz</h5>
                                <span class="team-position">Director for Special Projects</span>
                                <br>
                                <span class="flag-size-md flag-icon flag-icon-ph"></span>
                                <span class="flag-size-md flag-icon flag-icon-ca"></span>
                            </div>
                            <!-- Start .team-profile  -->
                            <div id="team-popup-8" class="team-popup mfp-hide">
                                <a title="Close" class="mfp-close">×</a>
                                <div class="row align-items-start">
                                    <div class="col-md-6">
                                        <div class="team-photo">
                                            <img src="/images/team/08-arnold.jpg" alt="Mr. Arnold Alafriz">
                                            <ul class="team-social">
                                                <li>
                                                    <a href="https://www.linkedin.com/in/arnie-alafriz-564637145" target="_blank">
                                                        <em class="fab fa-linkedin-in"></em>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div><!-- .col  -->
                                    <div class="col-md-6">
                                        <div class="team-popup-info pl-md-3">
                                            <h3 class="team-name title title-lg pt-4">
                                                Mr. Arnold Alafriz
                                                <span class="flag-size-md flag-icon flag-icon-ph"></span>
                                                <span class="flag-size-md flag-icon flag-icon-ca"></span>
                                            </h3>
                                            <p class="team-position">Director for Special Projects</p>
                                            <p class="text-justify">Arnie is a finance professional and handles in Belt
                                                & Road Initiatives with China. He has interests in aquaculture, food &
                                                beverage and tourism. He previously held various positions for such
                                                multinational banks as Bankers Trust (Hongkong and Singapore), Banque
                                                Paribas (Singapore) and RBC Dominion Securities (Canada) with a role in
                                                securities trading, debt and capital markets, and portfolio management
                                                during his career. He currently also serves as director for Symbiotic
                                                Holdings Corporation and the Coral World Park Undersea Resorts Inc.
                                            </p>
                                        </div>
                                    </div><!-- .col  -->
                                </div><!-- .row  -->
                            </div><!-- .team-profile  -->
                        </div><!-- .col -->

                        <!-- Mr. Steven Yamaji   -->
                        <div class="col-md-3 col-6">
                            <div class="team">
                                <div class="team-photo team-photo-sm">
                                    <img src="/images/team/09-steven.jpg" alt="Mr. Steven Yamaji">
                                    <a href="#team-popup-9" class="team-show content-popup"></a>
                                    <ul class="team-social">
                                        <li>
                                            <a href="https://www.linkedin.com/in/steven-s-yamaji-4609a01" target="_blank">
                                                <em class="fab fa-linkedin-in"></em>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <h5 class="team-name title title-sm">Mr. Steven Yamaji</h5>
                                <span class="team-position">Director for Digital Assets</span>
                                <br>
                                <span class="flag-size-md flag-icon flag-icon-jp bordered"></span>
                                <span class="flag-size-md flag-icon flag-icon-us"></span>
                            </div>
                            <!-- Start .team-profile  -->
                            <div id="team-popup-9" class="team-popup mfp-hide">
                                <a title="Close" class="mfp-close">×</a>
                                <div class="row align-items-start">
                                    <div class="col-md-6">
                                        <div class="team-photo">
                                            <img src="/images/team/09-steven.jpg" alt="Mr. Steven Yamaji">
                                        </div>
                                    </div><!-- .col  -->
                                    <div class="col-md-6">
                                        <div class="team-popup-info pl-md-3">
                                            <h3 class="team-name title title-lg pt-4">
                                                Mr. Steven Yamaji
                                                <span class="flag-size-md flag-icon flag-icon-jp bordered"></span>
                                                <span class="flag-size-md flag-icon flag-icon-us"></span>
                                            </h3>
                                            <p class="team-position">Director for Digital Assets</p>
                                            <p class="text-justify">Steven is the Digital Assets Lead tasked to ensure
                                                that FGC’s resources are decentralized through blockchain and
                                                asset-backed cryptocurrency technology. Based in Silicon Valley for
                                                close to 30 years, he founded the Blockchain Initiative Silicon Valley
                                                (BCI SV) company, promoting collaboration between the United States
                                                various Asian countries on blockchain technology. Previous to his career
                                                handling blockchain, he was an executive with Nippon Steel Corporation
                                                in Tokyo, Japan.
                                            </p>
                                        </div>
                                    </div><!-- .col  -->
                                </div><!-- .row  -->
                            </div><!-- .team-profile  -->
                        </div><!-- .col -->
                    </div><!-- .row -->
                </div>
                <!-- Block @r -->
            </div>
        </section>
        <!-- // -->
        <section class="section section-l section-team bg-light">

            <div class="container">
                <!-- Block @s -->
                <div class="nk-block nk-block-team-list team-list">
                    <div class="row justify-content-center">

                        <!-- Madam Ruslana Golunova  -->
                        <div class="col-md-3 col-6">
                            <div class="team">
                                <div class="team-photo team-photo-sm">
                                    <img src="/images/team/10-ruslana.jpg" alt="Madam Ruslana Golunova">
                                    <a href="#team-popup-10" class="team-show content-popup"></a>
                                    <ul class="team-social">
                                        <li>
                                            <a href="https://www.linkedin.com/in/ruslana-golunova-b38b577a" target="_blank">
                                                <em class="fab fa-linkedin-in"></em>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <h5 class="team-name title title-sm">Madam Ruslana Golunova</h5>
                                <span
                                    class="team-position">Product Development & Service Delivery – Digital Assets</span>
                                <br>
                                <span class="flag-size-md flag-icon flag-icon-ru bordered"></span>
                                <span class="flag-size-md flag-icon flag-icon-us"></span>
                            </div>
                            <!-- Start .team-profile  -->
                            <div id="team-popup-10" class="team-popup mfp-hide">
                                <a title="Close" class="mfp-close">×</a>
                                <div class="row align-items-start">
                                    <div class="col-md-6">
                                        <div class="team-photo">
                                            <img src="/images/team/10-ruslana.jpg" alt="Madam Ruslana Golunova">
                                        </div>
                                    </div><!-- .col  -->
                                    <div class="col-md-6">
                                        <div class="team-popup-info pl-md-3">
                                            <h3 class="team-name title title-lg pt-4">
                                                Madam Ruslana Golunova
                                                <br>
                                                <span class="flag-size-md flag-icon flag-icon-ru bordered"></span>
                                                <span class="flag-size-md flag-icon flag-icon-us"></span>
                                            </h3>
                                            <p class="team-position">Product Development & Service Delivery – Digital Assets</p>
                                            <p class="text-justify">
                                                Ruslana leads product development and service delivery options in a
                                                global role for FGC. She specializes in education and systems across
                                                blockchain technologies. She sits in a senior position with the
                                                Blockchain Initiative Silicon Valley (BCI SV) and provides collaboration
                                                between Russia, the US and Asia on various programs.
                                            </p>
                                        </div>
                                    </div><!-- .col  -->
                                </div><!-- .row  -->
                            </div><!-- .team-profile  -->
                        </div><!-- .col -->

                        <!-- Mr. Iliya Bugaev -->
                        <div class="col-md-3 col-6">
                            <div class="team">
                                <div class="team-photo team-photo-sm">
                                    <img src="/images/team/11-ilya.jpg" alt="Mr. Iliya Bugaev">
                                    <a href="#team-popup-11" class="team-show content-popup"></a>
                                    <ul class="team-social">
                                        <li>
                                            <a href="#" target="_blank">
                                                <em class="fab fa-linkedin-in"></em>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <h5 class="team-name title title-sm">Mr. Iliya Bugaev</h5>
                                <span class="team-position">Digital Assets</span>
                                <br><span class="flag-size-md flag-icon flag-icon-ru bordered"></span>
                            </div>
                            <!-- Start .team-profile  -->
                            <div id="team-popup-11" class="team-popup mfp-hide">
                                <a title="Close" class="mfp-close">×</a>
                                <div class="row align-items-start">
                                    <div class="col-md-6">
                                        <div class="team-photo">
                                            <img src="/images/team/11-ilya.jpg" alt="Mr. Iliya Bugaev">
                                        </div>
                                    </div><!-- .col  -->
                                    <div class="col-md-6">
                                        <div class="team-popup-info pl-md-3">
                                            <h3 class="team-name title title-lg pt-4">
                                                Mr. Iliya Bugaev
                                                <span class="flag-size-md flag-icon flag-icon-ru bordered"></span>
                                            </h3>
                                            <p class="team-position">Digital Assets</p>
                                            <p class="text-justify">
                                                Iliya is a data-driven architect with special focus on Distributed
                                                Ledger Technology (DLT) solutions with artificial intelligence (A.I.)
                                                and machine learning (ML) reinforcement for data security. He has worked
                                                on philanthropy-driven initiatives in social science and humanity
                                                together with financial institutions, telecoms, and IT clients. He is
                                                recognized in the top 5 in the academic field of economic cybernetics in
                                                the Ukraine. He was a member of the working committee of the Digital
                                                Economy of the Russian Federation and his team was awarded by Ethereum
                                                founder Vitalik Buterin as the “Best Blockchain Development Team” in
                                                Russia for CPA network on Smart Contracts. Iliya is considered one of
                                                the top 100 in the world for the development of complex socially
                                                significant IT projects.
                                            </p>
                                        </div>
                                    </div><!-- .col  -->
                                </div><!-- .row  -->
                            </div><!-- .team-profile  -->
                        </div><!-- .col -->

                        <!-- Mr. Dennis Duran -->
                        <div class="col-md-3 col-6">
                            <div class="team">
                                <div class="team-photo team-photo-sm">
                                    <img src="/images/team/12-dennis.jpg" alt="Mr. Dennis Duran">
                                    <a href="#team-popup-12" class="team-show content-popup"></a>
                                    <ul class="team-social">
                                        <li>
                                            <a href="#" target="_blank">
                                                <em class="fab fa-linkedin-in"></em>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <h5 class="team-name title title-sm">Mr. Dennis Duran</h5>
                                <span class="team-position">General Manager for Operations</span>
                                <br>
                                <span class="flag-size-md flag-icon flag-icon-ph"></span>
                            </div>
                            <!-- Start .team-profile  -->
                            <div id="team-popup-12" class="team-popup mfp-hide">
                                <a title="Close" class="mfp-close">×</a>
                                <div class="row align-items-start">
                                    <div class="col-md-6">
                                        <div class="team-photo">
                                            <img src="/images/team/12-dennis.jpg" alt="Mr. Dennis Duran">
                                        </div>
                                    </div><!-- .col  -->
                                    <div class="col-md-6">
                                        <div class="team-popup-info pl-md-3">
                                            <h3 class="team-name title title-lg pt-4">
                                                Mr. Dennis Duran
                                                <span class="flag-size-md flag-icon flag-icon-ph"></span>
                                            </h3>
                                            <p class="team-position">General Manager for Operations</p>
                                            <p class="text-justify">Tasked to head overall corporate development, Rich
                                                has prior interests in
                                                technology and consumer good startups. He is behind the development,
                                                launch, and distribution of several liquor brands with presence in the
                                                Philippines, the Netherlands and the United States. Rich previously held
                                                positions with various technology companies in Silicon Valley, CA. He
                                                has provided value in organizational structure, product development,
                                                partnerships/alliances and has negotiated acquisitions and leveraged
                                                buy-outs.
                                            </p>
                                        </div>
                                    </div><!-- .col  -->
                                </div><!-- .row  -->
                            </div><!-- .team-profile  -->
                        </div><!-- .col -->

                    </div><!-- .row -->
                </div>
                <!-- Block @r -->
            </div>
        </section>
    </main>
@stop('content')
