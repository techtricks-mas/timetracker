let token = document.getElementsByTagName("meta")[0].content;

function statusUpdate(data) {
    const id = data.dataset.id;
    const url = window.location.origin;
    $.ajax({
        type: "post",
        url: `${url}/admin/dailystatus`,
        data: {
            _token: token,
            id: id,
            status: data.value,
        },
        success: function (response) {
            $.toaster(
                response[0],
                "",
                "danger bg-green-500 py-3 px-2 rounded-2 text-white"
            );
        },
        error: function (response) {
            console.log(response);
        },
    });
}
