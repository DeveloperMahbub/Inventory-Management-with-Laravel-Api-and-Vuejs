<template>
    <div>
        <input
            type="text"
            class="form-control"
            style="width: 300px"
            v-model="searchTerm"
            placeholder="Search here by Phone No"
        />
        <div class="row my-3">
            <div class="col-lg-12 mb-4">
                <!-- Simple Tables -->
                <div class="card">
                    <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between"
                    >
                        <h6 class="m-0 font-weight-bold text-primary">
                            Today Orders
                        </h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>Total Amount</th>
                                    <th>Pay</th>
                                    <th>Due</th>
                                    <th>PayBy</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="(order, index) in filtersearch"
                                    :key="order.id"
                                >
                                    <td>{{ index + 1 }}</td>
                                    <td>
                                        {{ order.name }}
                                    </td>
                                    <td>{{ order.total }} TK</td>
                                    <td>{{ order.pay }} TK</td>
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
                                    <td>{{ order.payby }}</td>
                                    <td>
                                        <router-link
                                            :to="{
                                                name: 'view-order',
                                                params: { id: order.id },
                                            }"
                                            class="btn btn-sm btn-primary"
                                            >View</router-link
                                        >
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer"></div>
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
        this.allOrder();
    },
    data() {
        return {
            orders: [],
            searchTerm: "",
        };
    },
    computed: {
        filtersearch() {
            return this.orders.filter((order) => {
                return order.name.match(this.searchTerm);
            });
        },
    },
    methods: {
        allOrder() {
            axios
                .get("/api/orders/")
                .then(({ data }) => (this.orders = data))
                .catch();
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
