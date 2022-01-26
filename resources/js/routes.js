let login = require("./components/auth/Login.vue").default;
let register = require("./components/auth/Register.vue").default;
let forget = require("./components/auth/Forget.vue").default;
let logout = require("./components/auth/Logout.vue").default;
//End Authentication
let home = require("./components/home.vue").default;

// Employee
let storeEmployee = require("./components/employee/create.vue").default;
let employee = require("./components/employee/index.vue").default;
let editemployee = require("./components/employee/edit.vue").default;

// Customer
let storeCustomer = require("./components/customer/create.vue").default;
let customer = require("./components/customer/index.vue").default;
let editcustomer = require("./components/customer/edit.vue").default;

// Supplier
let storeSupplier = require("./components/supplier/create.vue").default;
let supplier = require("./components/supplier/index.vue").default;
let editsupplier = require("./components/supplier/edit.vue").default;

// Category
let storeCategory = require("./components/category/create.vue").default;
let category = require("./components/category/index.vue").default;
let editcategory = require("./components/category/edit.vue").default;

// Product
let storeProduct = require("./components/product/create.vue").default;
let product = require("./components/product/index.vue").default;
let editproduct = require("./components/product/edit.vue").default;

// Expense
let storeExpense = require("./components/expense/create.vue").default;
let expense = require("./components/expense/expense.vue").default;
let editexpense = require("./components/expense/edit.vue").default;

// salary
let givenSalary = require("./components/salary/all_employee.vue").default;
let paysalary = require("./components/salary/create.vue").default;
let allsalary = require("./components/salary/index.vue").default;
let viewsalary = require("./components/salary/view.vue").default;
let editsalary = require("./components/salary/edit.vue").default;

//stock
let stock = require("./components/product/stock.vue").default;
let editstock = require("./components/product/editstock.vue").default;

//Pos
let pos = require("./components/pos/pointOfSale.vue").default;
//Order
let order = require("./components/order/order.vue").default;
let viewOrder = require("./components/order/viewOrder.vue").default;
let searchorder = require("./components/order/searchorder.vue").default;

export const routes = [
    { path: "/", component: login, name: "/" },
    { path: "/register", component: register, name: "register" },
    { path: "/forget", component: forget, name: "forget" },
    { path: "/logout", component: logout, name: "logout" },
    { path: "/home", component: home, name: "home" },

    //Employe Route
    {
        path: "/store-employee",
        component: storeEmployee,
        name: "store-employee",
    },
    {
        path: "/employee",
        component: employee,
        name: "employee",
    },
    {
        path: "/edit-employee/:id",
        component: editemployee,
        name: "edit-employee",
    },

    //Customer Route
    {
        path: "/store-customer",
        component: storeCustomer,
        name: "store-customer",
    },
    {
        path: "/customer",
        component: customer,
        name: "customer",
    },
    {
        path: "/edit-customer/:id",
        component: editcustomer,
        name: "edit-customer",
    },

    //Supplier Route
    {
        path: "/store-supplier",
        component: storeSupplier,
        name: "store-supplier",
    },
    {
        path: "/supplier",
        component: supplier,
        name: "supplier",
    },
    {
        path: "/edit-supplier/:id",
        component: editsupplier,
        name: "edit-supplier",
    },

    //Category Route
    {
        path: "/store-category",
        component: storeCategory,
        name: "store-category",
    },
    {
        path: "/category",
        component: category,
        name: "category",
    },
    {
        path: "/edit-category/:id",
        component: editcategory,
        name: "edit-category",
    },

    //Product Route
    {
        path: "/store-product",
        component: storeProduct,
        name: "store-product",
    },
    {
        path: "/product",
        component: product,
        name: "product",
    },
    {
        path: "/edit-product/:id",
        component: editproduct,
        name: "edit-product",
    },

    //Expense Route
    {
        path: "/store-expense",
        component: storeExpense,
        name: "store-expense",
    },
    {
        path: "/expense",
        component: expense,
        name: "expense",
    },
    {
        path: "/edit-expense/:id",
        component: editexpense,
        name: "edit-expense",
    },
    //salary Route
    {
        path: "/given-salary",
        component: givenSalary,
        name: "given-salary",
    },
    {
        path: "/pay-salary/:id",
        component: paysalary,
        name: "pay-salary",
    },
    {
        path: "/salary",
        component: allsalary,
        name: "salary",
    },
    {
        path: "/view-salary/:id",
        component: viewsalary,
        name: "view-salary",
    },
    {
        path: "/edit-salary/:id",
        component: editsalary,
        name: "edit-salary",
    },

    //Stock Route
    {
        path: "/stock",
        component: stock,
        name: "stock",
    },
    {
        path: "/edit-stock/:id",
        component: editstock,
        name: "edit-stock",
    },

    //Pos Route
    {
        path: "/pos",
        component: pos,
        name: "pos",
    },
    //Order Route
    {
        path: "/order",
        component: order,
        name: "order",
    },
    {
        path: "/view-order/:id",
        component: viewOrder,
        name: "view-order",
    },
    {
        path: "/searchorder",
        component: searchorder,
        name: "searchorder",
    },
];
