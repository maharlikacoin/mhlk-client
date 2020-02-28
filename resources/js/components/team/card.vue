<template>
    <div class="col-md-3 col-sm-6 col-6">
        <div class="team">
            <div class="team-photo team-photo-sm">
                <img :src="'/images/team/'+person.image" class="cursor" :alt="person.name" @click="show = true">
                <ul class="team-social">
                    <li>
                        <a :href="person.social.linkedIn.url"
                           target="_blank">
                            <em :class="'fab '+person.social.linkedIn.icon"></em>
                        </a>
                    </li>
                </ul>
            </div>
            <h5 class="team-name title title-sm">{{ person.name }}</h5>
            <span class="team-position">{{ person.position }}</span>
            <br>
            <span v-for="(nationality, index) in person.nationalities" :key="index"
                  :class="[{'ml-1': index!==0 }, `flag-size-md flag-icon flag-icon-${nationality}`]"></span>
        </div>

        <!-- Start .team-profile  -->
        <b-modal v-model="show" centered hide-header hide-footer no-close-on-backdrop size="xl">
            <button title="Close" class="mfp-close cursor text-black-50" @click="show = false">×</button>
            <div class="team-popup">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="team-photo">
                            <img :src="'/images/team/'+person.image" :alt="person.name">
                        </div>
                    </div><!-- .col  -->
                    <div class="col-md-6 pb-5 px-5">
                        <div class="team-popup-info pl-md-3">
                            <h3 class="team-name title title-lg pt-4">
                                {{ person.name }}
                                <span v-for="(nationality, index) in person.nationalities" :key="index"
                                      :class="[{'ml-1': index!==0 }, `flag-size-md flag-icon flag-icon-${nationality}`]"></span>
                            </h3>
                            <p class="team-position">{{ person.position}}</p>
                            <p class="text-justify">
                                {{ person.bio }}
                            </p>
                        </div>
                    </div><!-- .col  -->
                </div><!-- .row  -->
            </div>
        </b-modal>
    </div>
</template>

<script>
    import {BModal} from 'bootstrap-vue';

    export default {
		name: "card",
        props: {
		    person: Object
        },
        components: {BModal},
        data() {
		    return {
		        show: false
            }
        }
	}
</script>

<style scoped>
    .cursor{
        cursor: pointer;
    }
    .bg-black-70 {
        background-color:  rgba(0, 0, 0, 0.70);
    }
    .team-popup {
        padding: 0;
    }

    .modal-content, .modal-body {
        background: transparent!important;
    }
    .modal-content {
        border: 0;
        width: auto;
    }
    .modal-body {
        padding: 0;
    }
</style>
