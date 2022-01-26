<template>
    <div>
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="./">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    Dashboard
                </li>
            </ol>
        </div>

        <div class="row mb-3">
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col mr-2">
                                <div
                                    class="text-xs font-weight-bold text-uppercase mb-1"
                                >
                                    Today Earnings
                                </div>
                                <div
                                    class="h5 mb-0 font-weight-bold text-gray-800"
                                >
                                    {{ todaysell }} TK
                                </div>
                                <!-- <div class="mt-2 mb-0 text-muted text-xs">
                                    <span class="text-success mr-2"
                                        ><i class="fa fa-arrow-up"></i>
                                        3.48%</span
                                    >
                                    <span>Since last month</span>
                                </div> -->
                            </div>
                            <div class="col-auto">
                                <i
                                    class="fas fa-calendar fa-2x text-primary"
                                ></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Earnings (Annual) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div
                                    class="text-xs font-weight-bold text-uppercase mb-1"
                                >
                                    Today Income
                                </div>
                                <div
                                    class="h5 mb-0 font-weight-bold text-gray-800"
                                >
                                    {{ income }} TK
                                </div>
                                <!-- <div class="mt-2 mb-0 text-muted text-xs">
                                    <span class="text-success mr-2"
                                        ><i class="fas fa-arrow-up"></i>
                                        12%</span
                                    >
                                    <span>Since last years</span>
                                </div> -->
                            </div>
                            <div class="col-auto">
                                <i
                                    class="fas fa-shopping-cart fa-2x text-success"
                                ></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- New User Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div
                                    class="text-xs font-weight-bold text-uppercase mb-1"
                                >
                                    Today Dues
                                </div>
                                <div
                                    class="h5 mb-0 mr-3 font-weight-bold text-gray-800"
                                >
                                    {{ due }} TK
                                </div>
                                <!-- <div class="mt-2 mb-0 text-muted text-xs">
                                    <span class="text-success mr-2"
                                        ><i class="fas fa-arrow-up"></i>
                                        20.4%</span
                                    >
                                    <span>Since last month</span>
                                </div> -->
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-info"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div
                                    class="text-xs font-weight-bold text-uppercase mb-1"
                                >
                                    Today Expense
                                </div>
                                <div
                                    class="h5 mb-0 font-weight-bold text-gray-800"
                                >
                                    {{ expense }} TK
                                </div>
                                <!-- <div class="mt-2 mb-0 text-muted text-xs">
                                    <span class="text-danger mr-2"
                                        ><i class="fas fa-arrow-down"></i>
                                        1.10%</span
                                    >
                                    <span>Since yesterday</span>
                                </div> -->
                            </div>
                            <div class="col-auto">
                                <i
                                    class="fas fa-comments fa-2x text-warning"
                                ></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12 mb-4">
                <!-- Simple Tables -->
                <div class="card">
                    <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between"
                    >
                        <h6 class="m-0 font-weight-bold text-primary">
                            Stock Out Products
                        </h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>P.Code</th>
                                    <th>Photo</th>
                                    <th>S.price</th>
                                    <th>Status</th>
                                    <th>Quantity</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="(product, index) in products"
                                    :key="product.id"
                                >
                                    <td>{{ index + 1 }}</td>
                                    <td>{{ product.product_name }}</td>
                                    <td>{{ product.product_code }}</td>
                                    <td>
                                        <img :src="product.image" id="em_img" />
                                    </td>
                                    <td>{{ product.selling_price }}</td>
                                    <td>
                                        <span class="badge badge-danger"
                                            >Stock Out</span
                                        >
                                    </td>
                                    <td>
                                        <span class="badge badge-danger">{{
                                            product.quantity
                                        }}</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer"></div>
                </div>
            </div>
        </div>
        <!--Row-->
    </div>
</template>
<script>
export default {
    created() {
        if (!User.loggedIn()) {
            this.$router.push({ name: "/" });
        }
        this.todaySell();
        this.todayIncome();
        this.todayDue();
        this.todayExpense();
        this.stockOut();
    },
    data() {
        return {
            todaysell: "",
            income: "",
            due: "",
            expense: "",
            products: "",
        };
    },
    methods: {
        todaySell() {
            axios
                .get("/api/todaySell")
                .then(({ data }) => (this.todaysell = data))
                .catch((error) => (this.errors = error.response.data.errors));
        },
        todayIncome() {
            axios
                .get("/api/todayIncome")
                .then(({ data }) => (this.income = data))
                .catch((error) => (this.errors = error.response.data.errors));
        },
        todayDue() {
            axios
                .get("/api/todayDue")
                .then(({ data }) => (this.due = data))
                .catch((error) => (this.errors = error.response.data.errors));
        },
        todayExpense() {
            axios
                .get("/api/todayExpense")
                .then(({ data }) => (this.expense = data))
                .catch((error) => (this.errors = error.response.data.errors));
        },
        stockOut() {
            axios
                .get("/api/stockOut")
                .then(({ data }) => (this.products = data))
                .catch((error) => (this.errors = error.response.data.errors));
        },
    },
};
</script>
<style></style>
