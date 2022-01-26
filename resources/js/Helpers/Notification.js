class Notification {
    success() {
        new Noty({
            type: "success",
            layout: "topRight",
            text: "Successfully Done !",
            timeout: 1000,
        }).show();
    }
    cart_success() {
        new Noty({
            type: "success",
            layout: "topRight",
            text: "Successfully Add to Cart !",
            timeout: 1000,
        }).show();
    }
    cart_delete() {
        new Noty({
            type: "success",
            layout: "topRight",
            text: "Successfully Deleted Item !",
            timeout: 1000,
        }).show();
    }
    alert() {
        new Noty({
            type: "alert",
            layout: "topRight",
            text: "Are you Sure !",
            timeout: 2000,
        }).show();
    }
    error() {
        new Noty({
            type: "alert",
            layout: "topRight",
            text: "Something Went Worng !",
            timeout: 2000,
        }).show();
    }
    warning() {
        new Noty({
            type: "warning",
            layout: "topRight",
            text: "Ops Worng !",
            timeout: 2000,
        }).show();
    }
    img_validation() {
        new Noty({
            type: "error",
            layout: "topRight",
            text: "Upload Image less then 1MB !",
            timeout: 2000,
        }).show();
    }
}
export default Notification = new Notification();
