<template>
    <section :class="[{'bg-light-alt': isEven}, 'section-l section-team']">
        <div class="container">
            <div class="nk-block nk-block-team-list team-list">
                <div class="row justify-content-center">
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
            sectionCount: Number
        },
        components: {TeamCard},
        computed: {
		    isEven() {
		        return this.sectionCount % 2 === 0
            }
        }
	}
</script>

<style scoped>

</style>
