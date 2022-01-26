<template>
    <div>
        <div class="row">
            <div class="col-md-3">
                <router-link to="/supplier" class="btn btn-primary"
                    >All Supplier</router-link
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
                                            Update Supplier
                                        </h1>
                                    </div>
                                    <form
                                        class="user"
                                        @submit.prevent="updateCategory"
                                    >
                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-6 col-sm-9">
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        id="exampleInputCategoryName"
                                                        placeholder="Enter Category Name"
                                                        v-model="
                                                            form.category_name
                                                        "
                                                    />
                                                    <small
                                                        class="text-danger"
                                                        v-if="
                                                            errors.category_name
                                                        "
                                                    >
                                                        {{
                                                            errors
                                                                .category_name[0]
                                                        }}
                                                    </small>
                                                </div>
                                                <div class="col-md-1 col-sm-3">
                                                    <button
                                                        type="submit"
                                                        class="btn btn-primary btn-block"
                                                    >
                                                        Submit
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
                category_name: "",
            },
            errors: {},
        };
    },
    created() {
        let id = this.$route.params.id;
        axios
            .get("/api/category/" + id)
            .then(({ data }) => (this.form = data))
            .catch(console.log("error"));
    },
    methods: {
        updateCategory() {
            let id = this.$route.params.id;
            axios
                .patch("/api/category/" + id, this.form)
                .then(() => {
                    this.$router.push({ name: "category" });
                    Notification.success();
                })
                .catch((error) => (this.errors = error.response.data.errors));
        },
    },
};
</script>
<style></style>
