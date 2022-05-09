import VueRouter from "vue-router";
import ProductIndex from "../components/ProductIndex";
import ProductCreate from "../components/ProductCreate";
import CategoryCreate from "../components/CategoryCreate";
import NotFound from "../components/NotFound";

const routes = [
    {
        path: '/',
        name: 'product.index',
        component: ProductIndex,
    },
    {
        path: '/products/create',
        name: 'product.create',
        component: ProductCreate,
    },
    {
        path: '/categories/create',
        name: 'category.create',
        component: CategoryCreate,
    },
    {
        path: '/:catchAll(.*)',
        name: 'not.found',
        component: NotFound,
    },
];

export default new VueRouter({
    routes,
    linkActiveClass: 'active',
    linkExactActiveClass: 'exact-active',
});
