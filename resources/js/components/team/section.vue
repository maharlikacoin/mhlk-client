<template>
    <section :class="[{'bg-light-alt': isTrustee}, 'section-l section-team']">
        <div class="container">
            <div class="nk-block nk-block-team-list team-list">
                <div class="row justify-content-center">
                    <h1 class="mb-5 pb-5 text-center w-100 text-uppercase font-weight-bold goldenrod">
                        {{ isTrustee ? 'Board of Trustees' : 'Board of Advisors' }}
                    </h1>
                    <team-card v-for="(person, index) in section.team" :key="index" :person="person"></team-card>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    import TeamCard from './card';

    export default {
		name: "TeamSection",
        props: {
		    section: Object,
            sectionCount: Number,
            isTrustee: {
		        type: Boolean,
		        default: true
            }
        },
        components: {TeamCard}
	}
</script>

<style scoped>

</style>
