$(function(goodbutton) {
    //e.preventDefault();
    $('#btn-good').on('click',function(e) {
        
        const $this = $(this);
        const $issueID = $this.parent().find('input:hidden[name="issueID"]').val();
        alert($issueID);
        
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
