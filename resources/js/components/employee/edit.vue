<template>
    <div>
        <div class="row">
            <div class="col-md-3">
                <router-link to="/employee" class="btn btn-primary"
                    >All Employee</router-link
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
                                            Update Employee
                                        </h1>
                                    </div>
                                    <form
                                        class="user"
                                        @submit.prevent="updateEmployee"
                                        enctype="multipart/form-data"
                                    >
                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-6">
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
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        id="exampleInputAddress"
                                                        placeholder="Enter Your Address"
                                                        v-model="form.address"
                                                    />
                                                    <small
                                                        class="text-danger"
                                                        v-if="errors.address"
                                                    >
                                                        {{ errors.address[0] }}
                                                    </small>
                                                </div>

                                                <div class="col-md-6">
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
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <input
                                                        type="date"
                                                        class="form-control"
                                                        id="exampleInputJoiningDate"
                                                        placeholder="Enter Your Joining Date"
                                                        v-model="
                                                            form.joining_date
                                                        "
                                                    />
                                                    <small
                                                        class="text-danger"
                                                        v-if="
                                                            errors.joining_date
                                                        "
                                                    >
                                                        {{
                                                            errors
                                                                .joining_date[0]
                                                        }}
                                                    </small>
                                                </div>

                                                <div class="col-md-6">
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        id="exampleInputNID"
                                                        placeholder="Enter Your NID"
                                                        v-model="form.nid"
                                                    />
                                                    <small
                                                        class="text-danger"
                                                        v-if="errors.nid"
                                                    >
                                                        {{ errors.nid[0] }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        id="exampleInputNumber"
                                                        placeholder="Enter Your phone Number"
                                                        v-model="form.phone"
                                                    />
                                                    <small
                                                        class="text-danger"
                                                        v-if="errors.phone"
                                                    >
                                                        {{ errors.phone[0] }}
                                                    </small>
                                                </div>

                                                <div class="col-md-6"></div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <input
                                                        type="file"
                                                        class="custom-file-input"
                                                        id="customFile"
                                                        @change="onFileSelected"
                                                    />
                                                    <label
                                                        class="custom-file-label"
                                                        for="customFile"
                                                        >Choose file</label
                                                    >
                                                </div>

                                                <div
                                                    class="col-md-6"
                                                    v-if="newpreview"
                                                >
                                                    <img
                                                        :src="newpreview"
                                                        style="
                                                            height: 40px;
                                                            width: 40px;
                                                        "
                                                    />
                                                </div>
                                                <div class="col-md-6" v-else>
                                                    <img
                                                        :src="
                                                            path +
                                                            `${form.photo}`
                                                        "
                                                        style="
                                                            height: 40px;
                                                            width: 40px;
                                                        "
                                                    />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <button
                                                type="submit"
                                                class="btn btn-primary btn-block"
                                            >
                                                Submit
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
                phone: "",
                salary: "",
                address: "",
                newphoto: "",
                nid: "",
                joining_date: "",
            },
            errors: {},
            path: window.baseurl,
            newpreview: "",
        };
    },
    created() {
        let id = this.$route.params.id;
        axios
            .get("/api/employee/" + id)
            .then(({ data }) => (this.form = data))
            .catch(console.log("error"));
    },
    methods: {
        onFileSelected(event) {
            let file = event.target.files[0];
            if (file.size > 1048770) {
                Notification.img_validation();
            } else {
                let reader = new FileReader();
                reader.onload = (event) => {
                    this.newpreview = event.target.result;
                    this.form.newphoto = event.target.result;
                };
                reader.readAsDataURL(file);
            }
        },
        updateEmployee() {
            let id = this.$route.params.id;
            axios
                .patch("/api/employee/" + id, this.form)
                .then(() => {
                    this.$router.push({ name: "employee" });
                    Notification.success();
                })
                .catch((error) => (this.errors = error.response.data.errors));
        },
    },
};
</script>
<style></style>
