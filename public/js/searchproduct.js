$(document).ready(function (){
// 検索フォームの送信イベントをキャッチしてAjaxリクエストを送信
$('#serch-erea').on('submit', function(e) {
    e.preventDefault();

    //フォームデータを取得
    let formData = $(this).serialize();

    //Ajaxリクエストを送信
    $.ajax({
        url: $(this).attr('action'), //フォームのaction属性を使用
        type:"GET",
        data: formData,
        success: function (response) {
            //成功した場合、検索結果部分を更新
            $('#product-list').html(response.products);
            $('#pagination').html(response.pagination);
        },
        error: function (xhr) {
            console.error(xhr.responseText);
        }
    });
});
});
