<template>
    <b-row>
        <b-col md="4">
            <b-card
                no-body
                border-variant="secondary"
                class="mb-4"
            >
                <b-card-body>
                    <b-card-title>Filters</b-card-title>
                    <div>
                        <b-form-group label="Sort by:">
                            <b-form-radio-group
                                id="sort"
                                v-model="params.sort"
                                name="sort"
                                stacked
                                @change="filter"
                            >
                                <b-form-radio value="name">Name</b-form-radio>
                                <b-form-radio value="price">Price</b-form-radio>
                            </b-form-radio-group>
                        </b-form-group>

                        <b-form-group label="Order by:">
                            <b-form-radio-group
                                id="order"
                                v-model="params.order"
                                name="order"
                                stacked
                                @change="filter"
                            >
                                <b-form-radio value="asc">ASC</b-form-radio>
                                <b-form-radio value="desc">DESC</b-form-radio>
                            </b-form-radio-group>
                        </b-form-group>

                        <b-form-group label="Categories:">
                            <b-form-checkbox-group
                                id="categories"
                                v-model="params.categories"
                                :options="categories"
                                name="categories"
                                stacked
                                @change="filter"
                            ></b-form-checkbox-group>
                        </b-form-group>
                    </div>
                </b-card-body>
            </b-card>
        </b-col>
        <b-col md="8">
            <b-row>
                <template v-if="loading">
                    <b-col>
                        <div class="d-flex align-items-center m-5">
                            <strong>Loading...</strong>
                            <b-spinner class="ml-auto"></b-spinner>
                        </div>
                    </b-col>
                </template>
                <template v-else>
                    <product-item
                        v-for="product in products"
                        :product="product"
                        :key="product.id"
                    ></product-item>
                </template>
            </b-row>
            <b-row>
                <b-col>
                    <b-pagination
                        pills
                        v-model="params.page"
                        :total-rows="meta.total"
                        :per-page="meta.per_page"
                        align="center"
                        @page-click.prevent="paginate"
                    ></b-pagination>
                </b-col>
            </b-row>
        </b-col>
    </b-row>
</template>

<script>
import { getCategories } from "../services/categoryService";
import { getProducts } from "../services/productService";
import ProductItem from "./ProductItem";

export default {
    components: {ProductItem},

    data() {
        return {
            loading: true,
            categories: [],
            products: [],
            meta: {},
            params: {
                page: 1,
                sort: null,
                order: null,
                categories: [],
            }
        }
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
            await this.getProductsData();
        } catch (error) {
            console.log(error);
        }
    },

    methods: {
        async getProductsData() {
            try {
                this.loading = true;
                const response = await getProducts(this.params);
                this.products = response.data;
                this.meta = response.meta;
            } catch (error) {
                console.log(error);
            } finally {
                this.loading = false;
            }
        },

        async paginate(_, page) {
            this.params.page = page;
            await this.getProductsData();
        },

        async filter() {
            this.params.page = 1;
            await this.getProductsData();
        },
    }
}
</script>
