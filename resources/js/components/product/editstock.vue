<template>
    <div>
        <div class="row">
            <div class="col-md-3">
                <router-link to="/stock" class="btn btn-primary"
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
                                            Stock Product
                                        </h1>
                                    </div>
                                    <form
                                        class="user"
                                        @submit.prevent="updateStock"
                                    >
                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-12">
                                                    <label
                                                        for="exampleInputQuantity"
                                                        >Product Stock</label
                                                    >
                                                    <input
                                                        type="number"
                                                        class="form-control"
                                                        id="exampleInputQuantity"
                                                        v-model="form.quantity"
                                                    />
                                                    <small
                                                        class="text-danger"
                                                        v-if="errors.quantity"
                                                    >
                                                        {{ errors.quantity[0] }}
                                                    </small>
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
        this.getProduct();
    },
    data() {
        return {
            form: {
                quantity: "",
            },
            errors: {},
        };
    },
    methods: {
        getProduct() {
            let id = this.$route.params.id;
            axios
                .get("/api/product/" + id)
                .then(({ data }) => (this.form = data))
                .catch(console.log("error"));
        },
        updateStock() {
            let id = this.$route.params.id;
            axios
                .post("/api/stock/update/" + id, this.form)
                .then(() => {
                    this.$router.push({ name: "stock" });
                    Notification.success();
                })
                .catch((error) => (this.errors = error.response.data.errors));
        },
    },
};
</script>
<style></style>
