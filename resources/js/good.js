$(function(goodbutton) {
    
    $('.btn-status-change').on('click',function(e) {
        
        e.preventDefault();
        const $this = $(this);
        const $issueID = $this.parent().find('input:hidden[name="issueID"]').val();
        const $speechID = $this.parent().find('input:hidden[name="speechID"]').val();
        const $status = $this.children('input:hidden[name="status"]').val();
        const $speaker = $this.parent().find('input:hidden[name="speaker"]').val();
        const $speech = $this.parent().find('input:hidden[name="speech"]').val();
        
        console.log($status);
        
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
            $this.children().toggleClass('active');
            if ($status==1) {
                $this.parent().children('div.btn-status-change[name$="2"]').children('i').removeClass('active');
            } else {
                $this.parent().children('div.btn-status-change[name$="1"]').children('i').removeClass('active');
            }
        }).fail(function (jqXHR) {
            alert('失敗');
        });
    });
});
