<template>
    <div>
        <div class="row">
            <div class="col-md-3">
                <router-link to="/given-salary" class="btn btn-primary"
                    >Pay salary</router-link
                >
            </div>
        </div>
        <br />
        <input
            type="text"
            class="form-control"
            style="width: 300px"
            v-model="searchTerm"
            placeholder="Search here by Month Name"
        />
        <div class="row my-3">
            <div class="col-lg-12 mb-4">
                <!-- Simple Tables -->
                <div class="card">
                    <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between"
                    >
                        <h6 class="m-0 font-weight-bold text-primary">
                            All Salary Details
                        </h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th>SL</th>
                                    <th>Month Name</th>
                                    <th>Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="(salary, index) in filtersearch"
                                    :key="salary.id"
                                >
                                    <td>{{ index + 1 }}</td>
                                    <td>{{ salary.salary_month }}</td>
                                    <td>
                                        <router-link
                                            :to="{
                                                name: 'view-salary',
                                                params: {
                                                    id: salary.salary_month,
                                                },
                                            }"
                                            class="btn btn-sm btn-primary"
                                            >View Salary</router-link
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
        this.allSalary();
    },
    data() {
        return {
            salaries: [],
            searchTerm: "",
        };
    },
    computed: {
        filtersearch() {
            return this.salaries.filter((salary) => {
                return salary.salary_month.match(this.searchTerm);
            });
        },
    },
    methods: {
        allSalary() {
            axios
                .get("/api/salary/")
                .then(({ data }) => (this.salaries = data))
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
