<template>
    <footer class="nk-footer bg-theme-grad has-ovm">
        <!-- top footer -->
        <section class="section no-pdy section-contact bg-transparent has-ovm" id="contact">
            <div class="container">
                <div class="nk-block block-contact">
                    <div class="row justify-content-center no-gutters">
                        <!-- left -->
                        <contact-us></contact-us>

                        <!-- right -->
                        <div class="col-lg-4">
                            <div class="contact-wrap split split-right split-lg-right bg-genitian bg-theme tc-light">
                                <div class="d-flex flex-column justify-content-between h-100">
                                    <!-- top -->
                                    <ul class="contact-list">
                                        <li>
                                            <a href="#"><i class="fas fa-building"></i></a>
                                            <div class="contact-text">
                                                <h6>Formula Green Foundation</h6>
                                                <span>Zug, Switzerland</span>
                                            </div>
                                        </li>
                                        <li>
                                            <a href="mailto:support@maharlikacoin.com"><i class="fas fa-envelope-square"></i></a>

                                            <div class="contact-text"><span>support@maharlikacoin.com</span></div>
                                        </li>
                                    </ul>
                                    <!-- bottom -->
                                    <div class="contact-social d-flex flex-column w-100 align-items-center">
                                        <community></community>
                                    </div>
                                </div>
                            </div>
                        </div><!-- .col -->
                    </div><!-- .row -->
                </div><!-- .block @e -->
            </div>

            <div class="nk-ovm ovm-top ovm-h-60 bg-light"></div><!-- .nk-ovm -->
        </section>
        <!-- bottom footer -->
        <section class="section section-footer section-l tc-light bg-transparent">
            <div class="container">
                <div class="nk-block block-footer">
                    <div class="row">

                        <div class="offset-lg-3 col-lg-4 col-sm-12 mb-4 mb-sm-0 d-flex justify-content-around">
                            <!-- Company -->
                            <company></company>
                            <!-- Legal -->
                            <legal></legal>
                        </div><!-- .col -->

                        <!-- Copyright -->
                        <copyright></copyright>

                    </div><!-- .row -->
                </div><!-- .block @e -->
            </div>

        </section>
        <div class="nk-ovm shape-b"></div>
    </footer>
</template>

<script>
    import Community from '../partials/footer/community'
    import Copyright from '../partials/footer/copyright'
    import Legal from '../partials/footer/legal'
    import Company from '../partials/footer/company'
    import ContactUs from '../partials/ContactUs'

	export default {
		name: "WelcomeFooter",
        components: {
            Community,
            Copyright,
            Legal,
            Company,
            ContactUs
        }
	}
</script>

<style scoped>

</style>
