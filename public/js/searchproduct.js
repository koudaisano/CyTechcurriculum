//削除機能をdeleteproduct.jsから移行

console.log('jQuery version:', $.fn.jquery);
console.log('tablesorter plugin:', $.tablesorter ? 'loaded' : 'not loaded');


$(document).ready(function () {
    //csrfトークンをmetaから取得※削除機能に必要
    let csrfToken = $('meta[name = "csrf-token"]').attr('content');

    //tablesorterを初期化
    $("#product-table").tablesorter({
        headers:{
            6:{ sorter: false } //削除・詳細ボタンがある列はソートしないのでfalse設定
        }
    });

    function updateTableContent(response) {
        let tableBody = $('#product-list tbody');
        let rows = '';

        $.each(response.products.data, function(index, product) {
            rows += '<tr id="product-row-' + product.id + '">';
            rows += '<td>' + product.id + '</td>';
            rows += '<td><img src="/storage/' + product.img_path + '" alt="' + product.product_name + '"></td>';
            rows += '<td>' + product.product_name + '</td>';
            rows += '<td>' + product.price + '</td>';
            rows += '<td>' + product.stock + '</td>';
            rows += '<td>' + product.company_name + '</td>';
            rows += '<td>';
            rows += '<button class="btn-info" data-id="' + product.id + '">詳細</button>';
            rows += '<button class="btn-delete" data-id="' + product.id + '">削除</button>';
            rows += '</td>';
            rows += '</tr>';
        });
        tableBody.html(rows);

        //ページネーション部分の更新
        $('#pagination').html(response.pagination);
    // tablesorterを更新
    $("#product-table").trigger("update");
    }

    // 検索フォームの送信イベントをキャッチしてAjaxリクエストを送信
    $('#search-erea').on('submit', function(e) {
        e.preventDefault();
        // フォームデータを取得
        let formData = $(this).serialize();

        // Ajaxリクエストを送信
        $.ajax({
            url: $(this).attr('action'),
            type: "GET",
            data: formData,
            success: function (response) {
                updateTableContent(response);
            },
            error: function (xhr) {
                console.error(xhr.responseText);
            }
        });
    });

    //詳細ボタン押下時の設定
    $(document).on('click', '.btn-info', function() {
        let productId = $(this).data('id');
        window.location.href = '/products/' + productId; // 商品詳細ページへリダイレクト
    });

    //検索後の削除ボタン押下時の設定
    $(document).on('click', '.btn-delete',function(e) {
        e.preventDefault();//デフォルトの動作を防ぐ
        let productId = $(this).data('id');
        let form = $(this).closest('form');
        if (confirm('本当に削除しますか？')) {
            $.ajax({
                url: '/products/' + productId,
                type: 'DELETE',
                data: {
                    _token: csrfToken // CSRFトークンを手動で追加
                },
                success: function(response) {
                    if (response.success) {
                        alert('削除が完了しました。');
                        $('#product-row-' + productId).remove();
                        $("#product-table").trigger("update");
                    } else {
                        alert('削除に失敗しました：' + response.message);
                    }
                },
                error: function(xhr) {
                     console.error(xhr.responseText);
                }
            });
        }
    });

    // 検索後の条件を保持したまま2ページ以降を表示する処理
    $(document).on('click', '#pagination a', function(e) {
        e.preventDefault();
        let url = $(this).attr('href'); // ページネーションのURLを取得
        let formData = $('#search-erea').serialize(); // 現在の検索条件を取得

        $.ajax({
            url: url,
            type: 'GET',
            data: formData,
            success: function(response) {
                updateTableContent(response);
            },
            error: function(xhr) {
                console.error(xhr.responseText);
            }
        });
    });
});
