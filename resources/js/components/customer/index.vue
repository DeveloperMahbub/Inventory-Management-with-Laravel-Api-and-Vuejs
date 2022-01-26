<template>
    <div>
        <div class="row">
            <div class="col-md-3">
                <router-link to="/store-customer" class="btn btn-primary"
                    >Add Customer</router-link
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
                            Customer List
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
                                    <th>Address</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="(customer, index) in filtersearch"
                                    :key="customer.id"
                                >
                                    <td>{{ index + 1 }}</td>
                                    <td>{{ customer.name }}</td>
                                    <td>{{ customer.email }}</td>
                                    <td>
                                        <img
                                            :src="customer.photo"
                                            id="em_img"
                                        />
                                    </td>
                                    <td>{{ customer.phone }}</td>
                                    <td>{{ customer.address }}</td>
                                    <td>
                                        <router-link
                                            :to="{
                                                name: 'edit-customer',
                                                params: { id: customer.id },
                                            }"
                                            class="btn btn-sm btn-primary"
                                            >Edit</router-link
                                        >
                                        <a
                                            @click="deleteCustomer(customer.id)"
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
        this.allCustomer();
    },
    data() {
        return {
            customers: [],
            searchTerm: "",
        };
    },
    computed: {
        filtersearch() {
            return this.customers.filter((customer) => {
                return customer.phone.match(this.searchTerm);
            });
        },
    },
    methods: {
        allCustomer() {
            axios
                .get("/api/customer/")
                .then(({ data }) => (this.customers = data))
                .catch();
        },
        deleteCustomer(id) {
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
                        .delete("/api/customer/" + id)
                        .then(() => {
                            this.customers = this.customers.filter(
                                (customer) => {
                                    return customer.id != id;
                                }
                            );
                        })
                        .catch(() => {
                            this.$router.push({ name: "customer" });
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
