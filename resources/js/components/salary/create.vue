<template>
    <div>
        <div class="row">
            <div class="col-md-3">
                <router-link to="/given-salary" class="btn btn-primary"
                    >All Salary</router-link
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
                                            Pay salary
                                        </h1>
                                    </div>
                                    <form
                                        class="user"
                                        @submit.prevent="salaryPaid"
                                    >
                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <label
                                                        for="exampleInputName"
                                                        >Name</label
                                                    >
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        id="exampleInputName"
                                                        placeholder="Enter Your Full Name"
                                                        v-model="form.name"
                                                    />
                                                    <small
                                                        class="text-danger"
                                                        v-if="errors.name"
                                                    >
                                                        {{ errors.name[0] }}
                                                    </small>
                                                </div>

                                                <div class="col-md-6">
                                                    <label
                                                        for="exampleInputEmail"
                                                        >Email</label
                                                    >
                                                    <input
                                                        type="email"
                                                        class="form-control"
                                                        id="exampleInputEmail"
                                                        placeholder="Enter Your Email"
                                                        v-model="form.email"
                                                    />
                                                    <small
                                                        class="text-danger"
                                                        v-if="errors.email"
                                                    >
                                                        {{ errors.email[0] }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <label
                                                        for="exampleFormControlSelect3"
                                                        >Months</label
                                                    >
                                                    <select
                                                        class="form-control"
                                                        id="exampleFormControlSelect3"
                                                        v-model="
                                                            form.salary_month
                                                        "
                                                    >
                                                        <option value="January">
                                                            January
                                                        </option>
                                                        <option
                                                            value="February"
                                                        >
                                                            February
                                                        </option>
                                                        <option value="March">
                                                            March
                                                        </option>
                                                        <option value="April">
                                                            April
                                                        </option>
                                                        <option value="May">
                                                            May
                                                        </option>
                                                        <option value="June">
                                                            June
                                                        </option>
                                                        <option value="July">
                                                            July
                                                        </option>
                                                        <option value="August">
                                                            August
                                                        </option>
                                                        <option
                                                            value="September"
                                                        >
                                                            September
                                                        </option>
                                                        <option value="October">
                                                            October
                                                        </option>
                                                        <option
                                                            value="November"
                                                        >
                                                            November
                                                        </option>
                                                        <option
                                                            value="December"
                                                        >
                                                            December
                                                        </option>
                                                    </select>
                                                    <small
                                                        class="text-danger"
                                                        v-if="
                                                            errors.salary_month
                                                        "
                                                    >
                                                        {{
                                                            errors
                                                                .salary_month[0]
                                                        }}
                                                    </small>
                                                </div>

                                                <div class="col-md-6">
                                                    <label
                                                        for="exampleInputSalary"
                                                        >Salary</label
                                                    >
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        id="exampleInputSalary"
                                                        placeholder="Enter Your Salary"
                                                        v-model="form.salary"
                                                    />
                                                    <small
                                                        class="text-danger"
                                                        v-if="errors.salary"
                                                    >
                                                        {{ errors.salary[0] }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <button
                                                type="submit"
                                                class="btn btn-primary btn-block"
                                            >
                                                Pay Now
                                            </button>
                                        </div>
                                    </form>
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
    },
    data() {
        return {
            form: {
                name: "",
                email: "",
                salary_month: "",
                salary: "",
            },
            errors: {},
        };
    },
    created() {
        let id = this.$route.params.id;
        axios
            .get("/api/employee/" + id)
            .then(({ data }) => (this.form = data))
            .catch((error) => (this.errors = error.response.data.errors));
    },
    methods: {
        salaryPaid() {
            let id = this.$route.params.id;
            axios
                .post("/api/salary/paid/" + id, this.form)
                .then(() => {
                    this.$router.push({ name: "given-salary" });
                    Notification.success();
                })
                .catch((error) => (this.errors = error.response.data.errors));
        },
    },
};
</script>
<style></style>
