$(document).ready(function () {

    //csrfトークンをmetaから取得※削除機能に必要
    let csrfToken = $('meta[name = "csrf-token"]').attr('content');

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
                // テーブルのデータ部分をクリア
                let tableBody = $('#product-list tbody');
                tableBody.empty();

                // 検索結果を反映
                $.each(response.products.data, function(index, product) {
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

                // ページネーション部分の更新
                $('#pagination').html(response.pagination);
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
    $(document).off('click', '.btn-delete').on('click', '.btn-delete', function() {
        let productId = $(this).data('id');
        if (confirm('本当に削除しますか？')) {
            $.ajax({
                url: '/products/' + productId,
                type: 'DELETE',
                data: {
                    _token: csrfToken //csrfトークン追加
                },
                success: function(response) {
                    alert('削除が完了しました。');
                    //削除した商品を非同期で削除
                     $('#product-list tbody tr').filter(function(){
                        return $(this).find('btn-delete').data('id') == productId;
                    }).remove();

                    //検索結果後に商品を削除した後の検索結果を再送信して、結果を保持する
                     $('#search-erea').submit();
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
                let tableBody = $('#product-list tbody');
                tableBody.empty();

                // 検索結果を反映
                $.each(response.products.data, function(index, product) {
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

                // ページネーション部分の更新
                $('#pagination').html(response.pagination);
            },
            error: function(xhr) {
                console.error(xhr.responseText);
            }
        });
    });
});
