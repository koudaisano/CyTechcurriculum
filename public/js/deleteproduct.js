document.addEventListener('DOMContentLoaded', function() {
    const deleteButtons = document.querySelectorAll('.btn-delete');

    deleteButtons.forEach(button => {
        button.addEventListener('click', async function(e) {
            e.preventDefault();

            const form = this.closest('form');
            const productId = form.dataset.productId;

            if (confirm('本当に削除しますか？')) {
                try {
                    const response = await fetch(form.action, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            _method: 'DELETE'
                        })
                    });

                    if (!response.ok) {
                        throw new Error('削除に失敗しました');
                    }

                    const data = await response.json();
                    if (data.success) {
                        console.log('削除成功');
                        const productRow = document.getElementById(`product-row-${productId}`);
                        if (productRow) {
                            productRow.remove();
                        }
                    } else {
                        throw new Error(data.message || '削除に失敗しました');
                    }
                } catch (error) {
                    console.error('Error:', error);
                    alert('エラーが発生しました。');
                }
            }
        });
    });
});
