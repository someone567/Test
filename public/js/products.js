//このままだと検証画面のネットワークのレスポンスでエラーが検知
//.readyと.click消した場合、以下の記述あると削除押した後に更新されて削除となる、同期処理
$(document).ready(function () {
    // 削除ボタンのイベントリスナーを追加
    $('.btn-danger').click(function (event) {
        event.preventDefault(); // 元のフォーム送信を防ぐ

        // フォームのaction属性から削除アクションのURLを取得
        // var deleteUrl = $(this).closest('form').attr('action');
        var DeleteId = $(this).data('delete-id')
        var clickButton = $(this)
        // リクエストの送信
        $.ajax({
            url: 'products/' + DeleteId,
            type: 'post',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                '_method': 'delete'
            },
            success: function (response) {
                // リストから削除された製品の行を削除
                // var deletedRow = $(event.target).closest('tr');
                // deletedRow.remove();
                clickButton.parents('tr').remove()
            },
            error: function (error) {
                console.log('Error:', error);
            }
        });
    });
});
