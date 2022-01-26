<template>
    <div>
        <div class="row">
            <div class="col-md-3">
                <router-link to="/store-expense" class="btn btn-primary"
                    >Add Expense</router-link
                >
            </div>
        </div>
        <br />
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
                            Expense List
                        </h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th>SL</th>
                                    <th>Expense Details</th>
                                    <th>Amount</th>
                                    <th>Date (Y-M-D)</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="(expense, index) in filtersearch"
                                    :key="expense.id"
                                >
                                    <td>{{ index + 1 }}</td>
                                    <td>
                                        {{
                                            expense.details.substring(0, 20) +
                                            "..."
                                        }}
                                    </td>
                                    <td>{{ expense.amount }}</td>
                                    <td>{{ expense.expense_date }}</td>
                                    <td>
                                        <router-link
                                            :to="{
                                                name: 'edit-expense',
                                                params: { id: expense.id },
                                            }"
                                            class="btn btn-sm btn-primary"
                                            >Edit</router-link
                                        >
                                        <a
                                            @click="deleteExpense(expense.id)"
                                            class="btn btn-sm btn-danger"
                                            >Delete</a
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
        this.allExpense();
    },
    data() {
        return {
            expenses: [],
            searchTerm: "",
        };
    },
    computed: {
        filtersearch() {
            return this.expenses.filter((expense) => {
                return expense.amount.match(this.searchTerm);
            });
        },
    },
    methods: {
        allExpense() {
            axios
                .get("/api/expense/")
                .then(({ data }) => (this.expenses = data))
                .catch();
        },
        deleteExpense(id) {
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
                        .delete("/api/expense/" + id)
                        .then(() => {
                            this.expenses = this.expenses.filter((expense) => {
                                return expense.id != id;
                            });
                        })
                        .catch(() => {
                            this.$router.push({ name: "expense" });
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
