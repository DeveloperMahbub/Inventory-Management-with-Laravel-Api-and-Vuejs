<template>
    <div>
        <div class="row">
            <div class="col-md-3">
                <router-link to="/store-employee" class="btn btn-primary"
                    >Add Employee</router-link
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
                            Employee List
                        </h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Photo</th>
                                    <th>Phone</th>
                                    <th>Salary</th>
                                    <th>Joining Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="(employee, index) in filtersearch"
                                    :key="employee.id"
                                >
                                    <td>{{ index + 1 }}</td>
                                    <td>{{ employee.name }}</td>
                                    <td>{{ employee.email }}</td>
                                    <td>
                                        <img
                                            :src="employee.photo"
                                            id="em_img"
                                        />
                                    </td>
                                    <td>{{ employee.phone }}</td>
                                    <td>{{ employee.salary }}</td>
                                    <td>{{ employee.joining_date }}</td>
                                    <td>
                                        <router-link
                                            :to="{
                                                name: 'pay-salary',
                                                params: { id: employee.id },
                                            }"
                                            class="btn btn-sm btn-primary"
                                            >Pay Salary</router-link
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
        this.allEmployee();
    },
    data() {
        return {
            employees: [],
            searchTerm: "",
        };
    },
    computed: {
        filtersearch() {
            return this.employees.filter((employee) => {
                return employee.phone.match(this.searchTerm);
            });
        },
    },
    methods: {
        allEmployee() {
            axios
                .get("/api/employee/")
                .then(({ data }) => (this.employees = data))
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
