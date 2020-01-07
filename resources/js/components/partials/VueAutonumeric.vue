<script>
    import AutoNumeric from 'autonumeric';

    const defaultOptions = {};
    export default {
        name: 'VueAutonumeric',
        render(createElement) {
            const isInput = this.tag === 'input';

            let attributes;
            if (isInput) {
                attributes = {
                    type           : 'text',
                    placeholder    : this.placeholder,
                };
            } else {
                attributes = {
                    contenteditable: this.hasContentEditable,
                };
            }

            return createElement(this.tag, {
                attrs: attributes,
                ref  : 'autoNumericElement',
                on   : {
                    'focus': this.updateVModel,
                    'blur': this.updateVModel,
                    'autoNumeric:rawValueModified': this.updateVModel,
                }
            });
        },

        props: {
            value: {
                required: false,
                validator(val) {
                    return typeof val === 'number' || typeof val === 'string' || val === '' || val === null;
                },
            },
            options: {
                type    : [Object, String, Array],
                required: false,
                default() {
                    return defaultOptions;
                },
            },
            resetOnOptions: {
                type    : Boolean,
                required: false,
                default : true,
            },
            placeholder: {
                type    : String,
                required: false,
            },
            tag: {
                type    : String,
                required: false,
                default : 'input',
            },
        },

        computed: {
            anInfo() {
                return {
                    value  : this.value,
                    options: this.options,
                };
            }
        },
        data() {
            return {
                // Store the reference to the AutoNumeric object
                anElement         : null,
                initialOptions    : null, // Store the options that were first used when initializing the component
                hasContentEditable: true, // Store if the element should be set as `contenteditable` on initialization
            };
        },
        methods: {
            updateVModel(event) {
                const eventType = event && event.type || {};
                if (this.anElement !== null) {
                    this.$emit(
                        eventType === 'autoNumeric:rawValueModified'
                            ? 'input'
                            : eventType
                        , this.anElement.getNumber(), event
                    );
                }
            },

            /**
             * Return an option object, whatever the type of `optionElement`.
             * If `optionElement` is as string, then we retrieve the predefined option object, if it's an object, we use it as is.
             *
             * @param {object|string} optionElement
             * @returns {object}
             */
            manageOptionElement(optionElement) {
                let options;
                if (typeof optionElement === 'string' || optionElement instanceof String) {
                    options = AutoNumeric.getPredefinedOptions()[optionElement];
                    if (options === void(0) || options === null) {
                        // If the given `optionElement` does not exist, we switch back to the default options
                        console.warn(`The given pre-defined options [${optionElement}] is not recognized by AutoNumeric.\nSwitching back to the default options.`);
                        options = defaultOptions; // Default value
                    }
                } else { // A `settings` object
                    options = optionElement;
                }

                return options;
            },
        },
        mounted() {
            // Initialize the autoNumeric element
            this.anElement = new AutoNumeric(this.$refs.autoNumericElement, this.initialOptions);
            if (this.value !== null && this.value !== '') {
                this.anElement.set(this.value)

                // The `v-model` must be updated with that default value on startup
                this.updateVModel(); //FIXME Send the `event.timeStamp` info here
            }
        },
        created() {
            if (Array.isArray(this.options)) {
                // This allows the user to use multiple options (strings or objects) in an array, and overwrite the previous one with the next option element ; this is useful to tune the wanted format
                let optionObjects = {};
                this.options.forEach(optionElement => {
                    this.initialOptions = this.manageOptionElement(optionElement);
                    optionObjects       = Object.assign(optionObjects, this.initialOptions); // Merge each options objects one after the other
                });

                this.initialOptions = optionObjects;
            } else {
                this.initialOptions = this.manageOptionElement(this.options);
            }

            // Define if the generated non-input element should have the contenteditable attribute set to `true`
            this.hasContentEditable = !this.initialOptions.readOnly;
        },
        watch: {
            anInfo(newValue, oldValue) {
                if (oldValue.options && JSON.stringify(newValue.options) !== JSON.stringify(oldValue.options)) {
                    if (this.resetOnOptions) {
                        this.anElement.options.reset();
                    }

                    let optionsToUse;
                    if (Array.isArray(newValue.options)) {
                        optionsToUse = AutoNumeric.mergeOptions(newValue.options);
                    } else {
                        optionsToUse = AutoNumeric._getOptionObject(newValue.options);
                    }

                    this.anElement.update(optionsToUse);
                }

                // 2) Then check if the value has changed, if it's defined
                if (newValue.value !== void(0) &&
                    // Make sure this is only called when the value is set by an external script, and not from a user input
                    this.anElement.getNumber() !== newValue.value &&
                    // Compare the 'newValue' with the current 'oldValue' so we do not `set` it again if it's not needed
                    newValue.value !== oldValue.value) {
                    // The modification comes from a script, so we need to reformat the new value `newValue.value`
                    this.anElement.set(newValue.value);
                }
            }
        }
    };
</script>
