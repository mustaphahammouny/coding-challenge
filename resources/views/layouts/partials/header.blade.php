<header>
    <b-navbar class="mb-4" toggleable="lg" type="dark" variant="dark">
        <b-navbar-brand :to="{name: 'product.index'}">Coding challenge</b-navbar-brand>

        <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

        <b-collapse id="nav-collapse" is-nav>
            <b-navbar-nav>
                <b-nav-item :to="{name: 'product.index'}" exact>Home</b-nav-item>
                <b-nav-item :to="{name: 'product.create'}" exact>Create product</b-nav-item>
                <b-nav-item :to="{name: 'category.create'}" exact>Create category</b-nav-item>
            </b-navbar-nav>
        </b-collapse>
    </b-navbar>
</header>
