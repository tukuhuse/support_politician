$(function() {
    $('#btn-good').on('click',function(e){
        //フォームが送信された時、デフォルトの通信を止める
        e.stopPropagation();
        //通信を行う
        $.ajax({
            type: 'POST',
            url: '',
            data: {
                'speechID': $speechID,
                'status': $status,
                'legislator_id': $legislator_id,
                'speech': $speech
            },
            dataType: 'json'
        }).done(function (results) {
            //通信成功時の処理
            alert('成功');
        }).fail(function (err) {
            //通信失敗時の処理
            alert('データの同期に失敗');
        })
        
    })
});