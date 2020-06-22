/*
$(function() {
    $('#btn-good').click(function(e){
        //フォームが送信された時、デフォルトの通信を止める
        e.stopPropagation();
        
        //通信を行う
        $.ajax({
            type: 'POST',
            url: '#',
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
*/
$(function(goodbutton) {
    //e.preventDefault();
    $('#btn-good').on('click',function(e) {
        
        alert('第一段階成功')
        e.preventDefault();
        
        $.ajax({
            type: 'POST',
            url: 'goodstate',
            data: {
                'speechID': $speechID,
                'status': $status,
                'legislator_id': $legislator_id,
                'speech': $speech
            },
            dataType: 'json'
        }).done(function (results) {
            alert('成功');
        }).fail(function (err) {
            alert('データ通信失敗');
        })
    });
});
/*
$(function() {
    $('a#btn-good').on('click',function() {
        alert('成功');
        return false;
    });
})
*/