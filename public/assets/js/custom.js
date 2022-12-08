let statusUpdate = document.querySelector("[statusUpdate]");
let token = document.getElementsByTagName("meta")[0].content;

statusUpdate.addEventListener("change", function () {
    const id = this.dataset.id;
    $.ajax({
        type: "post",
        url: "/dailystatus",
        data: {
            _token: token,
            id: id,
            status: this.value,
        },
        success: function (response) {
            $.toaster(
                response[0],
                "",
                "danger bg-green-500 py-3 px-2 rounded-2 text-white"
            );
        },
    });
});
