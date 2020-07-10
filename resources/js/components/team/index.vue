<template>
    <main class="nk-pages">
        <team-section v-for="(trustee, index) in trustees"
                      :key="index" :section="trustee"
                      :section-count="index" />

        <team-section v-for="(advisor, index) in advisors"
                      :key="index"
                      :isTrustee="false"
                      :section="advisor"
                      :section-count="index" />
    </main>
</template>

<script>
    import TeamSection from './section';
    import trustees from './trustees';
    import advisors from './advisors';

	export default {
		name: "team",
        components: {TeamSection},
        data() {
		    return {
                advisors: advisors,
                trustees: trustees
            }

        }
	}
</script>

<style scoped>

</style>
