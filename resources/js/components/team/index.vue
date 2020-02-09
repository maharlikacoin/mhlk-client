<template>
    <main class="nk-pages">
        <team-section v-for="(section, index) in sections" :key="index" :section="section" :section-count="index">
        </team-section>
    </main>
</template>

<script>
    import TeamSection from './section';
    import contents from './contents';

	export default {
		name: "team",
        components: {TeamSection},
        data: contents
	}
</script>

<style scoped>

</style>
