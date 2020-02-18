<template>
    <main class="nk-pages" @contextmenu="preventOpen">
        <section class="section section-l bg-white">
            <div class="container">
                <div class="nk-block nk-block-blog">
                    <div class="row">
                        <div class="col-12">
                            <simple-login v-model="password" v-if="!password"></simple-login>
                            <div id="pdf" v-if="password">
                                <pdf v-for="i in numPages" :key="i" :page="i" :src="src"
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
    import SimpleLogin from './SimpleLogin'

    export default {
        name: "Dossier",
        components: {pdf, SimpleLogin},
        data() {
            return {
                src: null,
                numPages: undefined,
                password: '',
                error: {
                    exists: false,
                    message: '',
                    details: ''
                }
            }
        },
        methods: {
            preventOpen(e) {
                e.preventDefault();
            }
        },
        mounted() {
        },
        watch: {
            password(newValue) {
                try {
                    if ((newValue !== null || newValue !== undefined || newValue !== '')
                        && newValue === process.env.MIX_DOSSIER_PASSWORD) {
                        this.src = pdf.createLoadingTask({url: process.env.MIX_DOSSIER_URL, password: newValue});

                        this.src.then(pdf => this.numPages = pdf.numPages)
                            .catch(err => {
                                this.error.exists = true;
                                this.error.message = 'File does not exist';
                            });
                    }
                } catch (e) {
                    this.error.exists = true;
                    this.error.message = 'Something went wrong.';
                    this.error.details = e
                }

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

    p.error-details {
        -webkit-user-select: all;
        -moz-user-select: all;
        -ms-user-select: all;
        -o-user-select: all;
        user-select: all;
        cursor: text;
    }
</style>
