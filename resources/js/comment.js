$(function(commentadd) {
    
    $('#commentadd').on('click',function() {
        
        const $this = $(this);
        const $issueID = $this.parent().parent().find('div[name="comment"]').children('input:hidden[name="issueID"]').val();
        const $comment = $this.parent().parent().find('div[name="comment"]').children('textarea[name="create_comment"]').val();
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: '/comments',
            dataType: "json",
            data: { 'issueID':$issueID, 'comment':$comment },
        }).done(function (results) {
            location.reload();
        }).fail(function (jqXHR) {
            alert('失敗');
        });
    });
});

$(function(commentdelete) {
    
    $('.commentdelete').on('click', function() {
        
        const $this = $(this);
        const $commentid = $this.parent().find('input:hidden[name="commentid"]').val();
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: '/comments/' + $commentid,
            dataType: 'json',
            data: { '_method': 'DELETE' },
        }).done(function (results) {
            location.reload();
        }).fail(function (jqXHR) {
            alert('失敗');
        });
    });
});