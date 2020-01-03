<template>
    <div class="col-lg-5 mb-4 mb-lg-0 order-lg-first text-center">
        <div class="wgs wgs-text">
            <div class="wgs-body">
                <a href="./" class="wgs-logo">
                    <img src="/images/logo-full-white.png" style="width:15em;" srcset="/images/logo-full-white2x.png 2x" alt="logo">
                </a>
                <p>Copyright © {{ year }} Formula Green Foundation <br>All rights reserved. </p>
            </div>
        </div>
    </div><!-- .col -->
</template>

<script>
	export default {
		name: "copyright",
        data() {
		    return {
		        year: new Date().getFullYear()
            }
        }
	}
</script>

<style scoped>

</style>
