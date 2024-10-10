document.addEventListener('DOMContentLoaded', function() {
    const deleteButtons = document.querySelectorAll('.btn-delete');


    deleteButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault(); //ページの再読みを防ぐ
            const form = this.closest('form');
            const productId = form.dataset.productId;  // フォームのデータセットから商品IDを取得

            if (confirm('本当に削除しますか？')) {
                fetch(form.action, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        _method: 'DELETE'
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        console.log('削除成功');
                        const productRow = document.getElementById(`product-row-${productId}`);
                        productRow.remove();
                    } else {
                        alert(data.message || '商品の削除に失敗しました。');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('エラーが発生しました。');
                });
            }
        });
    });
});

