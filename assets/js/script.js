$(function () {
    $('.delete-review-btn').on('click', function (e) {
        return confirm('Вы уверены, что хотите удалить запись?');
    });
});