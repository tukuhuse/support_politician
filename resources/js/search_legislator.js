$(function(search_way_flag) {
    
    $('#search_way_constituency').on('click', function() {
        document.getElementById("constituency_id").disabled = false;
        document.getElementById("legislator_id").disabled = true;
        
        document.getElementById("legislator_id").value=null;
    });
    $('#search_way_legislator').on('click', function() {
        document.getElementById("constituency_id").disabled = true;
        document.getElementById("legislator_id").disabled = false;
        
        document.getElementById("constituency_id").value=null;
    });
});
$(function() {
    window.onpageshow = function(event) {
        if (event.persisted) {
          window.location.reload();
        }
    };
});