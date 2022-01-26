<template>
    <div>
        <div class="container-fluid" id="container-wrapper">
            <div
                class="d-sm-flex align-items-center justify-content-between mb-4"
            >
                <h1 class="h3 mb-0 text-gray-800">POS Dashboard</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <router-link to="/home">Home</router-link>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        POS
                    </li>
                </ol>
            </div>

            <div class="row mb-3">
                <div class="col-xl-5 col-lg-5">
                    <div class="card mb-4">
                        <div
                            class="card-header py-3 d-flex flex-row align-items-center justify-content-between"
                        >
                            <h6 class="m-0 font-weight-bold text-primary">
                                Expense Insert
                            </h6>
                            <a class="btn btn-sm btn-info"
                                ><font color="#ffffff">Add Customer</font></a
                            >
                        </div>
                        <div class="table-responsive" style="font-size: 12px">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Name</th>
                                        <th>Qty</th>
                                        <th>Price</th>
                                        <th>Total</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="cart in carts" :key="cart.id">
                                        <td>{{ cart.pro_name }}</td>
                                        <td>
                                            <input
                                                type="text"
                                                style="width: 50px"
                                                readonly
                                                :value="cart.pro_quantity"
                                            />
                                            <button
                                                @click.prevent="
                                                    increment(cart.id)
                                                "
                                                class="btn btn-sm btn-success"
                                            >
                                                +
                                            </button>
                                            <button
                                                @click.prevent="
                                                    deccrement(cart.id)
                                                "
                                                class="btn btn-sm btn-primary"
                                                v-if="cart.pro_quantity >= 2"
                                            >
                                                -
                                            </button>
                                            <button
                                                class="btn btn-sm btn-primary"
                                                v-else
                                                disabled
                                            >
                                                -
                                            </button>
                                        </td>
                                        <td>{{ cart.product_price }}</td>
                                        <td>{{ cart.sub_total }}</td>
                                        <td>
                                            <a
                                                @click="removeItem(cart.id)"
                                                class="btn btn-sm btn-danger"
                                                >X</a
                                            >
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">
                            <ul class="list-group">
                                <li
                                    class="list-group-item d-flex justify-content-between align-items-center"
                                >
                                    Total Quantity:
                                    <strong>{{ qty }}</strong>
                                </li>
                                <li
                                    class="list-group-item d-flex justify-content-between align-items-center"
                                >
                                    Sub Total:
                                    <strong>{{ subTotal }} ৳</strong>
                                </li>
                                <li
                                    class="list-group-item d-flex justify-content-between align-items-center"
                                >
                                    Vat:
                                    <strong>{{ vats.vat }} %</strong>
                                </li>
                                <li
                                    class="list-group-item d-flex justify-content-between align-items-center"
                                >
                                    Total Amount:
                                    <strong
                                        >{{
                                            (subTotal * vats.vat) / 100 +
                                            subTotal
                                        }}
                                        ৳</strong
                                    >
                                </li>
                            </ul>
                            <br />

                            <form @submit.prevent="orderDone">
                                <label for="">Customer Name</label>
                                <select
                                    v-model="customer_id"
                                    class="form-control"
                                >
                                    <option
                                        :value="customer.id"
                                        v-for="customer in customers"
                                        :key="customer.id"
                                    >
                                        {{ customer.name }}
                                    </option>
                                </select>
                                <label for="">Pay</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    required
                                    v-model="pay"
                                />
                                <label for="">Due</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    required
                                    v-model="due"
                                />
                                <label for="">Pay By</label>
                                <select v-model="payby" class="form-control">
                                    <option value="HandCash">Hand Cash</option>
                                    <option value="Cheaque">Cheaque</option>
                                    <option value="GiftCard">Gift Card</option>
                                </select>
                                <br />
                                <button
                                    type="submit"
                                    class="btn btn-sm btn-success"
                                >
                                    Submit
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-xl-7 col-lg-7">
                    <div class="card mb-4">
                        <div
                            class="card-header py-3 d-flex flex-row align-items-center justify-content-between"
                        >
                            <h6 class="m-0 font-weight-bold text-primary">
                                Products
                            </h6>
                        </div>
                        <!-- Category wise Product -->

                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a
                                    class="nav-link active"
                                    id="home-tab"
                                    data-toggle="tab"
                                    href="#home"
                                    role="tab"
                                    aria-controls="home"
                                    aria-selected="true"
                                    >All Products</a
                                >
                            </li>
                            <li
                                class="nav-item"
                                v-for="category in categories"
                                :key="category.id"
                            >
                                <a
                                    class="nav-link"
                                    id="profile-tab"
                                    data-toggle="tab"
                                    href="#profile"
                                    role="tab"
                                    aria-controls="profile"
                                    aria-selected="false"
                                    @click="subProduct(category.id)"
                                    >{{ category.category_name }}</a
                                >
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div
                                class="tab-pane fade show active"
                                id="home"
                                role="tabpanel"
                                aria-labelledby="home-tab"
                            >
                                <div class="card-body">
                                    <input
                                        type="text"
                                        class="form-control mb-4"
                                        style="width: 650px"
                                        v-model="searchTerm"
                                        placeholder="Search product"
                                    />
                                    <div class="row product-row">
                                        <div
                                            class="col-lg-3 col-md-3 col-sm-6 col-6 mb-4"
                                            v-for="product in filtersearch"
                                            :key="product.id"
                                        >
                                            <button
                                                class="btn btn-sm"
                                                @click.prevent="
                                                    AddToCart(product.id)
                                                "
                                            >
                                                <div
                                                    class="card"
                                                    style="width: 8.5rem"
                                                >
                                                    <img
                                                        :src="product.image"
                                                        id="em_img"
                                                        class="card-img-top"
                                                    />
                                                    <div
                                                        class="card-body text-center"
                                                    >
                                                        <h6 class="card-title">
                                                            {{
                                                                product.product_name.substring(
                                                                    0,
                                                                    10
                                                                ) + "..."
                                                            }}
                                                        </h6>
                                                        <span
                                                            class="badge badge-success"
                                                            v-if="
                                                                product.quantity >=
                                                                3
                                                            "
                                                            >Available
                                                            {{
                                                                product.quantity
                                                            }}</span
                                                        >
                                                        <span
                                                            class="badge badge-danger"
                                                            v-else
                                                            >Stock Out</span
                                                        >
                                                    </div>
                                                </div>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- End Tabs All Products -->

                            <div
                                class="tab-pane fade"
                                id="profile"
                                role="tabpanel"
                                aria-labelledby="profile-tab"
                            >
                                <div class="card-body">
                                    <input
                                        type="text"
                                        class="form-control mb-4"
                                        style="width: 650px"
                                        v-model="searchTerm"
                                        placeholder="Search product"
                                    />
                                    <div class="row product-row">
                                        <div
                                            class="col-lg-3 col-md-3 col-sm-6 col-6 mb-4"
                                            v-for="getproduct in getfiltersearch"
                                            :key="getproduct.id"
                                        >
                                            <button
                                                class="btn btn-sm"
                                                @click.prevent="
                                                    AddToCart(getproduct.id)
                                                "
                                            >
                                                <div
                                                    class="card"
                                                    style="width: 8.5rem"
                                                >
                                                    <img
                                                        :src="getproduct.image"
                                                        id="em_img"
                                                        class="card-img-top"
                                                    />
                                                    <div
                                                        class="card-body text-center"
                                                    >
                                                        <h6 class="card-title">
                                                            {{
                                                                getproduct.product_name.substring(
                                                                    0,
                                                                    10
                                                                ) + "..."
                                                            }}
                                                        </h6>
                                                        <span
                                                            class="badge badge-success"
                                                            v-if="
                                                                getproduct.quantity >=
                                                                3
                                                            "
                                                            >Available
                                                            {{
                                                                getproduct.quantity
                                                            }}</span
                                                        >
                                                        <span
                                                            class="badge badge-danger"
                                                            v-else
                                                            >Stock Out</span
                                                        >
                                                    </div>
                                                </div>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Category wise Product End-->
                    </div>
                </div>
            </div>
        </div>
        <!---Container Fluid-->
    </div>
</template>
<script>
export default {
    created() {
        if (!User.loggedIn()) {
            this.$router.push({ name: "/" });
        }
        this.allProduct();
        this.allCategory();
        this.allCustomer();
        this.CartProduct();
        this.vat();
        Reload.$on("AfterAdd", () => {
            this.CartProduct();
        });
    },
    data() {
        return {
            customer_id: "",
            pay: "",
            due: "",
            payby: "",

            products: [],
            categories: "",
            getproducts: [],
            searchTerm: "",
            customers: "",
            errors: "",
            vats: "",
            carts: [],
        };
    },
    computed: {
        filtersearch() {
            return this.products.filter((product) => {
                return product.product_name.match(this.searchTerm);
            });
        },
        getfiltersearch() {
            return this.getproducts.filter((getproduct) => {
                return getproduct.product_name.match(this.searchTerm);
            });
        },
        qty() {
            let sum = 0;
            for (let i = 0; i < this.carts.length; i++) {
                sum += parseFloat(this.carts[i].pro_quantity);
            }
            return sum;
        },
        subTotal() {
            let sum = 0;
            for (let i = 0; i < this.carts.length; i++) {
                sum +=
                    parseFloat(this.carts[i].pro_quantity) *
                    parseFloat(this.carts[i].product_price);
            }
            return sum;
        },
    },
    methods: {
        //Add to card
        AddToCart(id) {
            axios
                .get("/api/addToCart/" + id)
                .then(() => {
                    Reload.$emit("AfterAdd");
                    Notification.cart_success();
                })
                .catch();
        },
        removeItem(id) {
            axios
                .get("/api/remove/Cart/" + id)
                .then(() => {
                    Reload.$emit("AfterAdd");
                    Notification.cart_delete();
                })
                .catch();
        },
        CartProduct() {
            axios
                .get("/api/cart/product/")
                .then(({ data }) => (this.carts = data))
                .catch();
        },
        increment(id) {
            axios
                .get("/api/increment/" + id)
                .then(() => {
                    Reload.$emit("AfterAdd");
                    Notification.success();
                })
                .catch();
        },
        deccrement(id) {
            axios
                .get("/api/deccrement/" + id)
                .then(() => {
                    Reload.$emit("AfterAdd");
                    Notification.cart_success();
                })
                .catch();
        },
        vat() {
            axios
                .get("/api/vats/")
                .then(({ data }) => (this.vats = data))
                .catch(console.log("error"));
        },

        orderDone() {
            // alert("done");
            let total = (this.subTotal * this.vats.vat) / 100 + this.subTotal;
            var data = {
                qty: this.qty,
                subTotal: this.subTotal,
                customer_id: this.customer_id,
                payby: this.payby,
                due: this.due,
                pay: this.pay,
                vat: this.vats.vat,
                total: total,
            };
            axios.post("/api/orderdone", data).then(() => {
                Notification.success();
                this.$router.push({ name: "home" });
            });
        },
        //End Add to cart
        allProduct() {
            axios
                .get("/api/product/")
                .then(({ data }) => (this.products = data))
                .catch();
        },
        allCategory() {
            axios
                .get("/api/category/")
                .then(({ data }) => (this.categories = data))
                .catch();
        },
        subProduct(id) {
            axios
                .get("/api/getting/product/" + id)
                .then(({ data }) => (this.getproducts = data))
                .catch();
        },
        allCustomer() {
            axios
                .get("/api/customer/")
                .then(({ data }) => (this.customers = data))
                .catch(console.log("error"));
        },
    },
};
</script>
<style scoped>
.product-row a {
    text-decoration: none;
}
.product-row h6 {
    color: #6e707e;
}

#em_img {
    height: 100px;
    width: 135px;
}
.btn-danger {
    color: #ffff !important;
}

.card .table td,
.card .table th {
    padding-right: 0;
}
</style>
