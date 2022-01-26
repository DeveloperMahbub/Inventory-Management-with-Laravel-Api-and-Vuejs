<template>
    <div>
        <div class="row">
            <div class="col-md-3">
                <router-link to="/salary" class="btn btn-primary"
                    >Back</router-link
                >
            </div>
        </div>
        <br />
        <input
            type="text"
            class="form-control"
            style="width: 300px"
            v-model="searchTerm"
            placeholder="Search here by Employee Name"
        />
        <div class="row my-3">
            <div class="col-lg-12 mb-4">
                <!-- Simple Tables -->
                <div class="card">
                    <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between"
                    >
                        <h6 class="m-0 font-weight-bold text-primary">
                            Employee Salary Details
                        </h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>Month</th>
                                    <th>Amount</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="(salary, index) in filtersearch"
                                    :key="salary.id"
                                >
                                    <td>{{ index + 1 }}</td>
                                    <td>{{ salary.name }}</td>
                                    <td>{{ salary.salary_month }}</td>
                                    <td>{{ salary.amount }}</td>
                                    <td>{{ salary.salary_date }}</td>
                                    <td>
                                        <router-link
                                            :to="{
                                                name: 'edit-salary',
                                                params: { id: salary.id },
                                            }"
                                            class="btn btn-sm btn-primary"
                                            >Edit salary</router-link
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
        this.viewSalary();
    },
    data() {
        return {
            salaries: [],
            searchTerm: "",
            errors: {},
        };
    },
    computed: {
        filtersearch() {
            return this.salaries.filter((salary) => {
                return salary.name.match(this.searchTerm);
            });
        },
    },
    methods: {
        viewSalary() {
            let id = this.$route.params.id;
            axios
                .get("/api/salary/view/" + id)
                .then(({ data }) => (this.salaries = data))
                .catch((error) => (this.errors = error.response.data.errors));
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
