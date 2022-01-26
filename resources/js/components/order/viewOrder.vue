<template>
    <div>
        <div class="row">
            <div class="col-md-3">
                <router-link to="/order" class="btn btn-primary"
                    >Back</router-link
                >
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="card shadow-sm my-3">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="login-form">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">
                                            Order Details
                                        </h1>
                                    </div>

                                    <div class="row my-3">
                                        <div class="col-lg-6 mb-4">
                                            <!-- Simple Tables -->
                                            <div class="card">
                                                <div
                                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between"
                                                >
                                                    <h6
                                                        class="m-0 font-weight-bold text-primary"
                                                    >
                                                        Customer Details
                                                    </h6>
                                                </div>
                                                <div class="table-responsive">
                                                    <ul class="list-group">
                                                        <li
                                                            class="list-group-item"
                                                        >
                                                            <b>Name:</b>
                                                            {{ orders.name }}
                                                        </li>
                                                        <li
                                                            class="list-group-item"
                                                        >
                                                            <b>Phone:</b>
                                                            {{ orders.phone }}
                                                        </li>
                                                        <li
                                                            class="list-group-item"
                                                        >
                                                            <b>Address:</b>
                                                            {{ orders.address }}
                                                        </li>
                                                        <li
                                                            class="list-group-item"
                                                        >
                                                            <b>Pay Through:</b>
                                                            {{ orders.payby }}
                                                        </li>
                                                        <li
                                                            class="list-group-item"
                                                        >
                                                            <b>Order date:</b>
                                                            {{
                                                                orders.order_date
                                                            }}
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 mb-4">
                                            <!-- Simple Tables -->
                                            <div class="card">
                                                <div
                                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between"
                                                >
                                                    <h6
                                                        class="m-0 font-weight-bold text-primary"
                                                    >
                                                        Order Details
                                                    </h6>
                                                </div>
                                                <div class="table-responsive">
                                                    <ul class="list-group">
                                                        <li
                                                            class="list-group-item"
                                                        >
                                                            <b>Sub Total:</b>
                                                            {{
                                                                orders.sub_total
                                                            }}
                                                            TK
                                                        </li>
                                                        <li
                                                            class="list-group-item"
                                                        >
                                                            <b>Vat:</b>
                                                            {{ orders.vat }} %
                                                        </li>
                                                        <li
                                                            class="list-group-item"
                                                        >
                                                            <b>Total:</b>
                                                            {{ orders.total }}
                                                            TK
                                                        </li>
                                                        <li
                                                            class="list-group-item"
                                                        >
                                                            <b>Paid:</b>
                                                            {{ orders.pay }} TK
                                                        </li>
                                                        <li
                                                            class="list-group-item"
                                                        >
                                                            <b>Due:</b>
                                                            <span
                                                                class="badge badge-danger"
                                                                v-if="
                                                                    orders.due >
                                                                    0
                                                                "
                                                                >{{
                                                                    orders.due
                                                                }}
                                                                TK</span
                                                            >

                                                            <span
                                                                class="badge badge-success"
                                                                v-else
                                                                >0 TK</span
                                                            >
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row my-3">
                                        <div class="col-lg-12 mb-4">
                                            <!-- Simple Tables -->
                                            <div class="card">
                                                <div
                                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between"
                                                >
                                                    <h6
                                                        class="m-0 font-weight-bold text-primary"
                                                    >
                                                        Order Products
                                                    </h6>
                                                </div>
                                                <div class="table-responsive">
                                                    <table
                                                        class="table align-items-center table-flush"
                                                    >
                                                        <thead
                                                            class="thead-light"
                                                        >
                                                            <tr>
                                                                <th>SL</th>
                                                                <th>
                                                                    Product Name
                                                                </th>
                                                                <th>P.Code</th>
                                                                <th>P.Image</th>

                                                                <th>
                                                                    Unit Price
                                                                </th>
                                                                <th>Qty</th>
                                                                <th>Total</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr
                                                                v-for="(
                                                                    detail,
                                                                    index
                                                                ) in details"
                                                                :key="detail.id"
                                                            >
                                                                <td>
                                                                    {{
                                                                        index +
                                                                        1
                                                                    }}
                                                                </td>
                                                                <td>
                                                                    {{
                                                                        detail.product_name
                                                                    }}
                                                                </td>
                                                                <td>
                                                                    {{
                                                                        detail.product_code
                                                                    }}
                                                                </td>
                                                                <td>
                                                                    <img
                                                                        :src="
                                                                            '/' +
                                                                            detail.image
                                                                        "
                                                                        id="em_img"
                                                                    />
                                                                </td>
                                                                <td>
                                                                    {{
                                                                        detail.product_price
                                                                    }}
                                                                    TK
                                                                </td>
                                                                <td>
                                                                    {{
                                                                        detail.pro_quantity
                                                                    }}
                                                                </td>

                                                                <td>
                                                                    {{
                                                                        detail.sub_total
                                                                    }}
                                                                    TK
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
        this.getProduct();
    },
    data() {
        return {
            errors: {},
            orders: {},
            details: {},
        };
    },
    methods: {
        getProduct() {
            let id = this.$route.params.id;
            axios
                .get("/api/order/details/" + id)
                .then(({ data }) => (this.orders = data))
                .catch(console.log("error"));

            axios
                .get("/api/order/orderDetails/" + id)
                .then(({ data }) => (this.details = data))
                .catch(console.log("error"));
        },
    },
};
</script>
<style>
#em_img {
    height: 40px;
    width: 40px;
}
</style>
