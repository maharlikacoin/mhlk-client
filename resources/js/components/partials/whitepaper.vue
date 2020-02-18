<template>
    <main class="nk-pages" @click="preventOpen" @contextmenu="preventOpen">
        <section class="section section-l bg-light">
            <div class="container">
                <div class="nk-block nk-block-blog">
                    <div class="row">
                        <div class="col-12">
                            <div id="pdf">

                                <pdf v-for="i in numPages" :key="i" :src="src" :page="i"
                                    style="display: inline-block; width: 100%"></pdf>

                                <div class="container" v-if="error.exists">
                                    <div class="bg-black-22 py-5 round shadow text-center text-red">
                                        <p class="font-weight-bold">
                                            <i class="fas fa-times-circle"></i>
                                            {{ error.message }}
                                        </p>
                                        <p class="font-italic error-details">"{{ error.details }}"</p>
                                        <p>Please let us know this problem.</p>
                                        <p>Send us an email at
                                            <a href="mailto:support@formulagreencorp.com">support@formulagreencorp.com</a></p>
                                    </div>
                                </div>

                            </div>
                        </div><!-- .col -->
                    </div><!-- .row -->
                </div><!-- .nk-block -->
            </div><!-- .container -->
        </section><!-- .section -->
    </main>

</template>

<script>
    import pdf from './pdf/vuePdfNoSssNoWorker'

    export default {
		name: "whitepaper",
        components: { pdf },
        data () {
            return {
                src: null,
                numPages: undefined,
                error: {
                    exists: false,
                    message: '',
                    details: ''
                }
            }
        },
        mounted () {
            try {
                this.src = pdf.createLoadingTask(process.env.MIX_WHITEPAPER_URL);

                this.src
                    .then(pdf => this.numPages = pdf.numPages)
                    .catch(err => {
                        this.error.exists = true;
                        this.error.message = 'File does not exist';
                    });
            }catch (e) {
                this.error.exists = true;
                this.error.message = 'Something went wrong.';
                this.error.details = e
            }
        },
        methods: {
            preventOpen (e) {
                e.preventDefault();
            }
        }
	}
</script>

<style lang="css" scoped>
    #pdf {
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        -o-user-select: none;
        user-select: none;
    }
    #pdf, #pdf div, #pdf img {
        cursor: not-allowed;
    }
</style>
