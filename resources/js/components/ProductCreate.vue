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

                    <validation-provider name="Price" :rules="{ required: true, double: 0 }" v-slot="validationContext">
                        <b-form-group label="Price:" label-for="price">
                            <b-form-input
                                id="price"
                                v-model="form.price"
                                placeholder="Enter price"
                                :state="getValidationState(validationContext)"
                                aria-describedby="price-live-feedback"
                            ></b-form-input>

                            <b-form-invalid-feedback id="price-live-feedback">{{
                                    validationContext.errors[0]
                                }}
                            </b-form-invalid-feedback>
                        </b-form-group>
                    </validation-provider>

                    <validation-provider name="Image" :rules="{ required: true, image: true }"
                                         v-slot="validationContext">
                        <b-form-group label="Image:" label-for="image">
                            <b-form-file
                                id="image"
                                v-model="form.image"
                                placeholder="Choose an image or drop it here..."
                                drop-placeholder="Drop image here..."
                                :state="getValidationState(validationContext)"
                                aria-describedby="image-live-feedback"
                            ></b-form-file>

                            <b-form-invalid-feedback id="image-live-feedback">{{
                                    validationContext.errors[0]
                                }}
                            </b-form-invalid-feedback>
                        </b-form-group>
                    </validation-provider>

                    <validation-provider name="Description" :rules="{ required: true, min: 3 }"
                                         v-slot="validationContext">
                        <b-form-group label="Description:" label-for="description">
                            <b-form-textarea
                                id="description"
                                v-model="form.description"
                                placeholder="Enter description..."
                                :state="getValidationState(validationContext)"
                                aria-describedby="description-live-feedback"
                            ></b-form-textarea>

                            <b-form-invalid-feedback id="description-live-feedback">{{
                                    validationContext.errors[0]
                                }}
                            </b-form-invalid-feedback>
                        </b-form-group>
                    </validation-provider>

                    <b-form-group label="Categories:" label-for="categories">
                        <b-form-select
                            id="categories"
                            v-model="form.categories"
                            :options="categories"
                            multiple
                        ></b-form-select>
                    </b-form-group>

                    <b-button type="submit" variant="primary">Submit</b-button>
                    <b-button type="reset" variant="danger" @click="onReset">Reset</b-button>
                </b-form>
            </validation-observer>
        </b-col>
    </b-row>
</template>

<script>
import { getCategories } from "../services/categoryService";
import { createProduct } from "../services/productService";

export default {
    data() {
        return {
            form: {
                name: null,
                price: null,
                image: null,
                description: null,
                categories: [],
            },
            categories: [],
        };
    },

    mounted: async function () {
        try {
            const response = await getCategories();
            this.categories = response.data.map(function (category) {
                return {
                    value: category.id,
                    text: category.name,
                };
            });
        } catch (error) {
            console.log(error);
        }
    },

    methods: {
        getValidationState({dirty, validated, valid = null}) {
            return dirty || validated ? valid : null;
        },

        async onSubmit() {
            let formData = new FormData();

            Object.keys(this.form)
                .filter(key => key !== 'categories')
                .forEach(key => {
                    formData.append(key, this.form[key]);
                });

            for (let i = 0; i < this.form.categories.length; i++) {
                formData.append('categories[]', this.form.categories[i]);
            }

            try {
                await createProduct(formData);
                this.$router.push({ path: '/' });
            } catch (error) {
                console.log(error);
            }
        },

        onReset() {
            Object.keys(this.form).forEach(key => {
                this.form[key] = key === 'categories' ? [] : null;
            });

            this.$nextTick(() => {
                this.$refs.observer.reset();
            });
        },
    }
}
</script>
