<template>
    <div>
        <div class="row">
            <div class="col-md-3">
                <router-link to="/store-product" class="btn btn-primary"
                    >Add Product</router-link
                >
            </div>
        </div>
        <br />
        <input
            type="text"
            class="form-control"
            style="width: 300px"
            v-model="searchTerm"
            placeholder="Search here by Product Code"
        />
        <div class="row my-3">
            <div class="col-lg-12 mb-4">
                <!-- Simple Tables -->
                <div class="card">
                    <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between"
                    >
                        <h6 class="m-0 font-weight-bold text-primary">
                            Product List
                        </h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>P.Code</th>
                                    <th>B.price</th>
                                    <th>S.price</th>
                                    <th>Photo</th>
                                    <th>category</th>
                                    <th>Supplier</th>
                                    <th>Quantity</th>
                                    <th>BuyD.</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="(product, index) in filtersearch"
                                    :key="product.id"
                                >
                                    <td>{{ index + 1 }}</td>
                                    <td>{{ product.product_name }}</td>
                                    <td>{{ product.product_code }}</td>
                                    <td>{{ product.buying_price }}</td>
                                    <td>{{ product.selling_price }}</td>
                                    <td>
                                        <img :src="product.image" id="em_img" />
                                    </td>
                                    <td>{{ product.category_name }}</td>

                                    <td>{{ product.supplier_name }}</td>
                                    <td>{{ product.quantity }}</td>
                                    <td>{{ product.buying_date }}</td>
                                    <td>
                                        <router-link
                                            :to="{
                                                name: 'edit-product',
                                                params: { id: product.id },
                                            }"
                                            class="btn btn-sm btn-primary"
                                            >Edit</router-link
                                        >
                                        <a
                                            @click="deleteProduct(product.id)"
                                            class="btn btn-sm btn-danger"
                                            >Delete</a
                                        >
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    created() {
        if (!User.loggedIn()) {
            this.$router.push({ name: "/" });
        }
        this.allProduct();
    },
    data() {
        return {
            products: [],
            searchTerm: "",
        };
    },
    computed: {
        filtersearch() {
            return this.products.filter((product) => {
                return product.product_code.match(this.searchTerm);
            });
        },
    },
    methods: {
        allProduct() {
            axios
                .get("/api/product/")
                .then(({ data }) => (this.products = data))
                .catch();
        },
        deleteProduct(id) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!",
            }).then((result) => {
                if (result.value) {
                    axios
                        .delete("/api/product/" + id)
                        .then(() => {
                            this.products = this.products.filter((product) => {
                                return product.id != id;
                            });
                        })
                        .catch(() => {
                            this.$router.push({ name: "product" });
                        });
                    Swal.fire(
                        "Deleted!",
                        "Your file has been deleted.",
                        "success"
                    );
                }
            });
        },
    },
};
</script>
<style>
#em_img {
    height: 40px;
    width: 40px;
}
.btn-danger {
    color: #ffff !important;
}
</style>
