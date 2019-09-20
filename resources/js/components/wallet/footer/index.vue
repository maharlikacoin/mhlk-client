<template>
    <footer class="nk-footer bg-theme-grad">
        <!-- // -->
        <section class="section section-footer section-l tc-light bg-transparent" style="padding-top:50px; padding-bottom:0;">

            <div class="container">
                <!-- Block @s -->
                <div class="nk-block block-footer">
                    <div class="row">
                        <!-- Community -->
                        <community></community>

                        <div class="col-lg-4 col-sm-12 mb-4 mb-sm-0 d-flex justify-content-around">
                            <!-- Company -->
                            <company :about-us="aboutUs" :team="team"></company>
                            <!-- Legal -->
                            <legal :terms="terms" :privacy="privacy" :whitepaper="whitepaper"></legal>
                        </div><!-- .col -->

                        <!-- Copyright -->
                        <copyright></copyright>
                    </div><!-- .row -->
                </div><!-- .block @e -->
            </div>

        </section>
        <div class="shape-b bg-shape"></div>
    </footer>

</template>

<script>
    import Community from './community';
    import Company from './company';
    import Legal from './legal';
    import Copyright from './copyright';

	export default {
		name: "WalletFooter",
        components: {
		    Community,
            Company,
            Legal,
            Copyright
        },
        props: {
            aboutUs: String,
            team: String,
            terms: String,
            privacy: String,
            whitepaper: String,
        }
	}
</script>

<style scoped>

</style>
