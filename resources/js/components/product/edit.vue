<template>
    <div>
        <div class="row">
            <div class="col-md-3">
                <router-link to="/product" class="btn btn-primary"
                    >All Product</router-link
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
                                            Update Product
                                        </h1>
                                    </div>
                                    <form
                                        class="user"
                                        @submit.prevent="updateProduct"
                                        enctype="multipart/form-data"
                                    >
                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <label
                                                        for="exampleInputProductName"
                                                    >
                                                        product Name</label
                                                    >
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        id="exampleInputProductName"
                                                        v-model="
                                                            form.product_name
                                                        "
                                                    />
                                                    <small
                                                        class="text-danger"
                                                        v-if="
                                                            errors.product_name
                                                        "
                                                    >
                                                        {{
                                                            errors
                                                                .product_name[0]
                                                        }}
                                                    </small>
                                                </div>

                                                <div class="col-md-6">
                                                    <label
                                                        for="exampleFormControlSelect2"
                                                    >
                                                        product Code</label
                                                    >
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        id="exampleFormControlSelect2"
                                                        v-model="
                                                            form.product_code
                                                        "
                                                    />
                                                    <small
                                                        class="text-danger"
                                                        v-if="
                                                            errors.product_code
                                                        "
                                                    >
                                                        {{
                                                            errors
                                                                .product_code[0]
                                                        }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <label
                                                        for="exampleFormControlSelect3"
                                                        >Product Category</label
                                                    >
                                                    <select
                                                        class="form-control"
                                                        id="exampleFormControlSelect3"
                                                        v-model="
                                                            form.category_id
                                                        "
                                                    >
                                                        <option
                                                            :value="category.id"
                                                            v-for="category in categories"
                                                            :key="category.id"
                                                        >
                                                            {{
                                                                category.category_name
                                                            }}
                                                        </option>
                                                    </select>
                                                </div>

                                                <div class="col-md-6">
                                                    <label
                                                        for="exampleFormControlSelect3"
                                                        >Product Supplier</label
                                                    >
                                                    <select
                                                        class="form-control"
                                                        id="exampleFormControlSelect3"
                                                        v-model="
                                                            form.supplier_id
                                                        "
                                                    >
                                                        <option
                                                            :value="supplier.id"
                                                            v-for="supplier in suppliers"
                                                            :key="supplier.id"
                                                        >
                                                            {{
                                                                supplier.supplier_name
                                                            }}
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-4">
                                                    <label
                                                        for="exampleInputJoiningRoot"
                                                        >Product Root</label
                                                    >
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        id="exampleInputJoiningRoot"
                                                        v-model="form.root"
                                                    />
                                                    <small
                                                        class="text-danger"
                                                        v-if="errors.root"
                                                    >
                                                        {{ errors.root[0] }}
                                                    </small>
                                                </div>

                                                <div class="col-md-4">
                                                    <label
                                                        for="exampleInputBuyingPrice"
                                                        >Buying Price</label
                                                    >
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        id="exampleInputBuyingPrice"
                                                        v-model="
                                                            form.buying_price
                                                        "
                                                    />
                                                    <small
                                                        class="text-danger"
                                                        v-if="
                                                            errors.buying_price
                                                        "
                                                    >
                                                        {{
                                                            errors
                                                                .buying_price[0]
                                                        }}
                                                    </small>
                                                </div>
                                                <div class="col-md-4">
                                                    <label
                                                        for="exampleInputSellingPrice"
                                                        >Selling price</label
                                                    >
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        id="exampleInputSellingPrice"
                                                        v-model="
                                                            form.selling_price
                                                        "
                                                    />
                                                    <small
                                                        class="text-danger"
                                                        v-if="
                                                            errors.selling_price
                                                        "
                                                    >
                                                        {{
                                                            errors
                                                                .selling_price[0]
                                                        }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <label
                                                        for="exampleInputBuyingDate"
                                                        >Buying date</label
                                                    >
                                                    <input
                                                        type="date"
                                                        class="form-control"
                                                        id="exampleInputBuyingDate"
                                                        v-model="
                                                            form.buying_date
                                                        "
                                                    />
                                                    <small
                                                        class="text-danger"
                                                        v-if="
                                                            errors.buying_date
                                                        "
                                                    >
                                                        {{
                                                            errors
                                                                .buying_date[0]
                                                        }}
                                                    </small>
                                                </div>
                                                <div class="col-md-6">
                                                    <label
                                                        for="exampleInputQuantity"
                                                        >Product Quantity</label
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
                                            <div class="form-row">
                                                <div class="col-md-6 col-sm-10">
                                                    <input
                                                        type="file"
                                                        class="custom-file-input"
                                                        id="customFile"
                                                        @change="onFileSelected"
                                                    />
                                                    <label
                                                        class="custom-file-label"
                                                        for="customFile"
                                                        >Choose Photo</label
                                                    >
                                                    <small
                                                        class="text-danger"
                                                        v-if="errors.image"
                                                    >
                                                        {{ errors.image[0] }}
                                                    </small>
                                                </div>

                                                <div
                                                    class="col-md-6 col-sm-2"
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
                                                            `${form.image}`
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
        this.getProduct();
        this.getCategory();
        this.getSupplier();
    },
    data() {
        return {
            form: {
                product_name: "",
                product_code: "",
                root: "",
                buying_price: "",
                selling_price: "",
                category_id: "",
                supplier_id: "",
                buying_date: "",
                quantity: "",
                newphoto: "",
            },
            errors: {},
            path: window.baseurl,
            newpreview: "",
            categories: {},
            suppliers: {},
        };
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
        updateProduct() {
            let id = this.$route.params.id;
            axios
                .patch("/api/product/" + id, this.form)
                .then(() => {
                    this.$router.push({ name: "product" });
                    Notification.success();
                })
                .catch((error) => (this.errors = error.response.data.errors));
        },
        getProduct() {
            let id = this.$route.params.id;
            axios
                .get("/api/product/" + id)
                .then(({ data }) => (this.form = data))
                .catch(console.log("error"));
        },
        getCategory() {
            axios
                .get("/api/category/")
                .then(({ data }) => (this.categories = data));
        },
        getSupplier() {
            axios
                .get("/api/supplier/")
                .then(({ data }) => (this.suppliers = data));
        },
    },
};
</script>
<style></style>
