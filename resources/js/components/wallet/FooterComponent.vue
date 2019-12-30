<template>
    <footer class="nk-footer bg-theme-grad">
        <!-- // -->
        <section class="section section-footer section-l tc-light bg-transparent" style="padding-top:50px; padding-bottom:0;">

            <div class="container">
                <!-- Block @s -->
                <div class="nk-block block-footer">
                    <div class="row">
                        <!-- Community -->
                        <div class="col-lg-3 col-sm-12 mb-4 mb-sm-0">
                            <div class="wgs wgs-menu d-flex flex-column w-100 align-items-center">
                                <community></community>
                            </div>
                        </div><!-- .col -->


                        <div class="col-lg-4 col-sm-12 mb-4 mb-sm-0 d-flex justify-content-around">
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
        <div class="shape-b bg-shape"></div>
    </footer>

</template>

<script>
    import Community from '../partials/footer/community';
    import Company from '../partials/footer/company';
    import Legal from '../partials/footer/legal';
    import Copyright from '../partials/footer/copyright';

	export default {
		name: "WalletFooter",
        components: {
		    Community,
            Company,
            Legal,
            Copyright
        }
	}
</script>

<style scoped>

</style>
