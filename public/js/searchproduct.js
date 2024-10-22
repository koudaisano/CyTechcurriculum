//削除機能をdeleteproduct.jsから移行

$(document).ready(function () {
    //csrfトークンをmetaから取得※削除機能に必要
    let csrfToken = $('meta[name = "csrf-token"]').attr('content');

    //tablesorterを初期化
    $("#product-list").tablesorter({
        headers:{
            6:{ sorter: false} //削除・詳細ボタンがある列はソートしないのでfalse設定
        }
    });

    function updateTableContent(response) {
        let tableBody = $('#product-list tbody');
        tableBody.empty();

        $.each(response.products.data, function(index,product){
            let row = '<tr>';
                    row += '<td>' + product.id + '</td>';
                    row += '<td><img src="/storage/' + product.img_path + '" alt="' + product.product_name + '"></td>';
                    row += '<td>' + product.product_name + '</td>';
                    row += '<td>' + product.price + '</td>';
                    row += '<td>' + product.stock + '</td>';
                    row += '<td>' + product.company_name + '</td>';
                    row += '<td>';
                    row += '<button class="btn-info" data-id="' + product.id + '">詳細</button>';
                    row += '<button class="btn-delete" data-id="' + product.id + '">削除</button>';
                    row += '</td>';
                    row += '</tr>';

                    tableBody.append(row);
        });

        //ページネーション部分の更新
        $('#pagination').html(response.pagination);
    // tablesorterを更新
    $("#product-list").trigger("update");
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
    $(document).on('click', '.btn-delete',function() {
        let productId = $(this).data('id');
        console.log(productId);
        if (confirm('本当に削除しますか？')) {
            console.log('か');
            $.ajax({
                url: '/products/' + productId,
                type: 'DELETE',
                data: {
                    _token: csrfToken //csrfトークン追加
                },
                success: function(response) {
                    console.log('き');
                    alert('削除が完了しました。');
                    // 商品を非同期で削除
                     $('button.btn-delete[data-id="' + productId + '"]').closest('tr').remove();
                     //tablesorterを更新
                    $("#product-list").trigger("update");
                },
                error: function(xhr) {
                    console.log('く');
                     console.error(xhr.responseText);
                }
            });
            console.log('け');
        }
        return false;
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
