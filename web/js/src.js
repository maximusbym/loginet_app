

$(document).ready( function () {
    
    var table1 = $('#table_1').DataTable( {
        "ajax": '/ajax/getTopics'
    } );
    
    $('#table_1 tbody').on('click', 'tr', function () {
        var data = table1.row(this).data();
        document.location.href = '/topic/'+data[0];
    });

    var topicId = $('table').data('topic-id');
    
    var table2 = $('#table_2').DataTable( {
        "ajax": '/ajax/getTopicComments/' + topicId
    } );
    
    var table3 = $('#table_3').DataTable( {
        "ajax": '/ajax/getBannedWords/'
    } );


} );