function pagination(url) {

    $.get(url, function (response) {
        console.log(response);
        $(".pagination-container").html(response);
    }).fail(function (xhr, status, error) {
        console.log(error);
    });

}

$(function() {
    paginate();
});

function paginate() {
    $(document).on('click', 'ul.pagination li a', function(event) {
        var url = $(this).attr('href');
        pagination(url);
        return false;
    }).click();
}