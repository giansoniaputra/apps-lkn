// NProgress.configure({
//     minimum: 0.1, // Minimum percentage progress bar starts at
//     easing: "ease", // CSS easing to use
//     speed: 500, // Speed in ms to move the progress bar
//     trickle: true, // Turn off to disable the trickling behavior
//     trickleSpeed: 200, // How often to trickle, in ms
//     showSpinner: true, // Turn off to disable loading spinner
//     parent: ".nav-shadow", // Specify this to change the parent container
// });
const csrfToken = $("meta[name='csrfToken']").attr("content");
// const curDate = $("meta[name='curDate']").attr("content");
let renderFile = (url, element, data = {}, obj = []) => {
    $.ajax({
        data: data,
        url: url,
        type: "GET",
        dataType: "json",
        success: function (response) {
            $(element).html(response.view);
            for (let i = 0; i < obj.length; i++) {
                obj[i];
            }
        },
    });
};
let renderFileProgress = (
    url,
    element,
    data = {},
    obj = [],
    res = [],
    resEl = []
) => {
    NProgress.start();
    $.ajax({
        data: data,
        url: url,
        type: "GET",
        dataType: "json",
        success: function (response) {
            NProgress.done();
            $(element).html(response.view);
            for (let i = 0; i < obj.length; i++) {
                obj[i];
            }
        },
    });
};
