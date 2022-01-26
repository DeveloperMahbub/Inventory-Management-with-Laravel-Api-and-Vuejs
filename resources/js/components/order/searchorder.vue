<template>
    <div>
        <div class="row">
            <div class="col-md-3">
                <router-link to="/order" class="btn btn-primary"
                    >Today Order</router-link
                >
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="card shadow-sm my-3">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <div class="login-form">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">
                                            Search Order
                                        </h1>
                                    </div>
                                    <form
                                        class="user"
                                        @submit.prevent="searchOrder"
                                    >
                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-6 col-sm-9">
                                                    <label
                                                        for="exampleInputSearch"
                                                        ><b
                                                            >Search By Date</b
                                                        ></label
                                                    >
                                                    <input
                                                        type="date"
                                                        class="form-control"
                                                        id="exampleInputSearch"
                                                        required
                                                        v-model="date"
                                                    />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-6 col-sm-9">
                                                    <button
                                                        type="submit"
                                                        class="btn btn-primary btn-block"
                                                    >
                                                        Search
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 mb-4">
                <!-- Simple Tables -->
                <div class="card">
                    <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between"
                    >
                        <h6 class="m-0 font-weight-bold text-primary">
                            Order List
                        </h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th>SL</th>
                                    <th>C.Name</th>
                                    <th>Qty</th>
                                    <th>Sub Total</th>
                                    <th>Vat</th>
                                    <th>Total</th>
                                    <th>Pay</th>
                                    <th>Due</th>
                                    <th>Payby</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="(order, index) in orders"
                                    :key="order.id"
                                >
                                    <td>
                                        {{ index + 1 }}
                                    </td>
                                    <td>
                                        {{ order.name }}
                                    </td>
                                    <td>
                                        {{ order.qty }}
                                    </td>
                                    <td>
                                        {{ order.sub_total }}
                                        TK
                                    </td>
                                    <td>
                                        {{ order.vat }}
                                        %
                                    </td>

                                    <td>
                                        {{ order.total }}
                                        TK
                                    </td>
                                    <td>
                                        {{ order.pay }}
                                        TK
                                    </td>
                                    <td>
                                        <span
                                            class="badge badge-danger"
                                            v-if="order.due > 0"
                                            >{{ order.due }} TK</span
                                        >

                                        <span class="badge badge-success" v-else
                                            >0 TK</span
                                        >
                                    </td>
                                    <td>
                                        {{ order.payby }}
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
    },
    data() {
        return {
            date: "",
            orders: {},
        };
    },
    methods: {
        searchOrder() {
            var data = { date: this.date };
            axios
                .post("/api/search/order", data)
                .then(({ data }) => (this.orders = data))
                .catch((error) => (this.errors = error.response.data.errors));
        },
    },
};
</script>
<style></style>
