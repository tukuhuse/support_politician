$(function(goodbutton) {
    //e.preventDefault();
    $('#btn-good').on('click',function(e) {
        
        const $this = $(this);
        const $issueID = $this.parent().find('input:hidden[name="issueID"]').val();
        const $speechID = $this.parent().find('input:hidden[name="speechID"]').val();
        const $status = $this.parent().find('input:hidden[name="status"]').val();
        const $speaker = $this.parent().find('input:hidden[name="speaker"]').val();
        const $speech = $this.parent().find('input:hidden[name="speech"]').val();
        
        e.preventDefault();
        
        $.ajax({
            type: 'POST',
            url: 'goodstate',
            data: {
                'issueID': $issueID,
                'speechID': $speechID,
                'status': $status,
                'speaker': $speaker,
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
