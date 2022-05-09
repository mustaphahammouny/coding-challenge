<template>
    <b-col class="mb-3 d-flex align-items-stretch" md="6" lg="4">
        <b-card
            no-body
            border-variant="secondary"
            align="center"
        >
            <b-card-img :src="product.image" alt="Image" top></b-card-img>

            <b-card-body class="pb-0">
                <b-card-title v-text="product.name"></b-card-title>
            </b-card-body>

            <b-card-footer footer-bg-variant="white" footer-border-variant="white">
                <b-card-sub-title class="mb-2">$ {{ product.price }}</b-card-sub-title>
            </b-card-footer>
        </b-card>
    </b-col>
</template>

<script>
export default {
    props: ['product'],
}
</script>
