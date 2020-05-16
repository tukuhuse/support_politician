$(function() {
    $('.btn-good').on('click',function(e){
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
        })
        
    })
});