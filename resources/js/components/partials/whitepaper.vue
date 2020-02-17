<template>
    <main class="nk-pages" @click="preventOpen" @contextmenu="preventOpen">
        <section class="section section-l bg-light">
            <div class="container">
                <div class="nk-block nk-block-blog">
                    <div class="row">
                        <div class="col-12">
                            <div id="pdfvuer">
                                <pdf :src="pdfSource" v-for="i in numPages" :key="i" :id="i" :page="i" :scale.sync="scale"
                                     style="width:100%;margin:20px auto;">
                                    <template slot="loading">loading content here...</template>
                                </pdf>
                            </div>
                        </div><!-- .col -->
                    </div><!-- .row -->
                </div><!-- .nk-block -->
            </div><!-- .container -->
        </section><!-- .section -->
    </main>

</template>

<script>
    import pdfvuer from 'pdfvuer'

	export default {
		name: "whitepaper",
        components: { pdf:pdfvuer },
        data () {
            return {
                page: 1,
                numPages: 0,
                pdfSource: null,
                errors: [],
                scale: 'page-width'
            }
        },
        computed: {
            formattedZoom () {
                return Number.parseInt(this.scale * 100);
            },
        },
        mounted () {
            this.getPdf()
        },
        watch: {
            show: function (s) {
                if(s) {
                    this.getPdf();
                }
            },
            page: function (p) {
                if( window.pageYOffset <= this.findPos(document.getElementById(p)) || ( document.getElementById(p+1) && window.pageYOffset >= this.findPos(document.getElementById(p+1)) )) {
                    // window.scrollTo(0,this.findPos(document.getElementById(p)));
                    document.getElementById(p).scrollIntoView();
                }
            }
        },
        methods: {
            getPdf () {
                let self = this;
                self.pdfSource = pdfvuer.createLoadingTask('/file/whitepaper');
                self.pdfSource.then(pdf => {
                    self.numPages = pdf.numPages;
                });
            },
            preventOpen (e) {
                e.preventDefault();
            }
        }
	}
</script>

<style lang="css" scoped>
    #pdfvuer {
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        -o-user-select: none;
        user-select: none;
    }
    #pdfvuer, #pdfvuer div, #pdfvuer img {
        cursor: not-allowed;
    }
</style>
