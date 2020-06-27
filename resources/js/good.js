$(function(goodbutton) {
    //e.preventDefault();
    $('#btn-good').on('click',function(e) {
        
        e.preventDefault();
        const $this = $(this);
        const $issueID = $this.parent().find('input:hidden[name="issueID"]').val();
        const $speechID = $this.parent().find('input:hidden[name="speechID"]').val();
        const $status = $this.parent().find('input:hidden[name="status"]').val();
        const $speaker = $this.parent().find('input:hidden[name="speaker"]').val();
        const $speech = $this.parent().find('input:hidden[name="speech"]').val();
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: '/ajaxupdate',
            dataType: "json",
            data: { 'issueID':$issueID, 'speechID':$speechID, 'status':$status, 'speaker':$speaker, 'speech':$speech },
        }).done(function (results) {
            alert('成功');
        }).fail(function (jqXHR) {
            alert('失敗');
        });
    });
});
