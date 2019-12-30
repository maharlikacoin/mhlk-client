<template>
    <div class="col-lg-6">
        <div class="contact-wrap split split-left split-lg-left bg-white">
            <h5 class="title title-md">Contact Us</h5>
            <v-observer ref="observer" v-slot="{ invalid }"  tag="form" @submit.prevent="send" @reset="resetForm">

                <!-- name -->
                <v-provider vid="name" name="Name" rules="required|min:2|alpha_spaces" tag="div"
                            v-slot="{ errors, valid }" class="field-item">
                    <input v-model="form.name" id="name" name="name" type="text" class="input-line required"
                           :class="{ 'border-danger' : errors.length }"/>
                    <label for="name" class="field-label field-label-line">Your Name</label>
                    <div class="small text-danger" v-if="errors.length">{{ errors[0] }}</div>
                </v-provider>

                <!-- email -->
                <v-provider vid="email" name="Email" rules="required|email" tag="div"
                            v-slot="{ errors, valid }" class="field-item">
                    <input v-model="form.email" id="email" name="email" type="email" class="input-line required email"
                           :class="{ 'border-danger' : errors.length }"/>
                    <label for="email" class="field-label field-label-line">Your Email</label>
                    <div class="small text-danger" v-if="errors.length">{{ errors[0] }}</div>
                </v-provider>

                <!-- message -->
                <v-provider vid="message" name="Message" rules="required|min:150" tag="div" mode="aggressive"
                            v-slot="{ errors, valid }" class="field-item">
                    <textarea v-model="form.message" id="message" name="message" class="input-line input-textarea required"
                           :class="{ 'border-danger' : errors.length }"></textarea>
                    <label for="message" class="field-label field-label-line">Your Message</label>
                    <div class="small text-danger" v-if="errors.length">{{ errors[0] }}</div>
                </v-provider>

                <div class="row">
                    <div class="col-sm-4">
                        <button class="btn btn-lg btn-grad" :disabled="invalid" type="submit" >Submit</button>
                    </div>
                </div>
            </v-observer>
        </div>
    </div><!-- .col -->
</template>

<script>
    import {ValidationObserver, ValidationProvider, setInteractionMode} from 'vee-validate'

    setInteractionMode('lazy');
    Vue.component('VObserver', ValidationObserver);
    Vue.component('VProvider', ValidationProvider);

    function initialState() {
        return {
            form: {
                name: '',
                email: '',
                message: ''
            }
        }
    }
	export default {
		name: "ContactUs",
        data() {
		    return initialState()
        },
        methods: {
            async send() {
                const isValid = await this.$refs.observer.validate();
                if (!isValid) return;

                let submitButton = this.$swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-md btn-grad text-white ml-2',
                        cancelButton: 'btn btn-secondary mx-2'
                    },
                    buttonsStyling: false
                });
                submitButton
                    .fire({
                        title: 'Send your Message',
                        confirmButtonText: 'Send',
                        showCancelButton: true,
                        text: 'Your message will be sent in a while',
                        showLoaderOnConfirm: true,
                        reverseButtons: true,
                        allowOutsideClick: false,
                        preConfirm: () => {
                            return axios.post('/contact-us', this.form)
                                .catch(error => {
                                    this.$swal.showValidationMessage(`<div>Something went wrong. <br>Please try again.</div>`)
                                }) // end of catch
                        } // end of queue-preconfirm
                    })
                    .then((result) => {
                        if(result.value) this.successModal()
                    })
            },
            successModal() {
                let successButton = this.$swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-md btn-grad text-white ml-2',
                    },
                    buttonsStyling: false
                });
                successButton.fire({
                    type: 'success',
                    title: 'Thank you',
                    html: 'We receive your message!',
                    allowOutsideClick: false,
                    onClose: () => {
                        this.resetForm();
                    }
                });// end of swal
            },
            resetForm() {
                Object.assign(this.$data, initialState());
                requestAnimationFrame(() => {
                    this.$refs.observer.reset();
                });
            }
        }
	}
</script>

<style scoped>

</style>
