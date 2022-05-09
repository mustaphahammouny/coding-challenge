<template>
    <b-row class="justify-content-center">
        <b-col cols="8">
            <validation-observer ref="observer" v-slot="{ handleSubmit }">
                <b-form @submit.stop.prevent="handleSubmit(onSubmit)">
                    <validation-provider name="Name" :rules="{ required: true, min: 3 }" v-slot="validationContext">
                        <b-form-group label="Name:" label-for="name">
                            <b-form-input
                                id="name"
                                v-model="form.name"
                                placeholder="Enter name"
                                :state="getValidationState(validationContext)"
                                aria-describedby="name-live-feedback"
                            ></b-form-input>

                            <b-form-invalid-feedback id="name-live-feedback">{{
                                    validationContext.errors[0]
                                }}
                            </b-form-invalid-feedback>
                        </b-form-group>
                    </validation-provider>

                    <b-form-group label="Parent category:" label-for="parent-category">
                        <b-form-select
                            id="parent-category"
                            v-model="form.parent_category"
                            :options="categories"
                        ></b-form-select>
                    </b-form-group>

                    <b-button type="submit" variant="primary">Submit</b-button>
                    <b-button type="reset" variant="danger" @click="onReset()">Reset</b-button>
                </b-form>
            </validation-observer>
        </b-col>
    </b-row>
</template>

<script>
import { getCategories, createCategory } from "../services/categoryService";

export default {
    data() {
        return {
            form: {
                name: null,
                parent_category: null,
            },
            categories: [
                {value: null, text: 'Select parent category'},
            ],
        };
    },

    mounted: async function () {
        try {
            const response = await getCategories();
            this.categories.push(...response.data.map(function (category) {
                return {
                    value: category.id,
                    text: category.name,
                };
            }));
        } catch (error) {
            console.log(error);
        }
    },

    methods: {
        getValidationState({dirty, validated, valid = null}) {
            return dirty || validated ? valid : null;
        },

        async onSubmit() {
            try {
                await createCategory(this.form);
                this.$router.push({ path: '/' });
            } catch (error) {
                console.log(error);
            }
        },

        onReset() {
            Object.keys(this.form).forEach(key => {
                this.form[key] = null;
            });

            this.$nextTick(() => {
                this.$refs.observer.reset();
            });
        },
    }
}
</script>
