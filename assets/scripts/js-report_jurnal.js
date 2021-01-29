var tabl = $('#tb_report_jurnal').DataTable({
    "pageLength": 100
});  

// var tablz = $('#tb_header_fixed').DataTable({
//     "pageLength": 100
// });  

// new $.fn.dataTable.FixedHeader( tabl, {
//     // options
// } );

var tableOffset = $("#tb_report_jurnal").offset().top;
var $header = $("#tb_report_jurnal > thead").clone();
var $fixedHeader = $("#tb_header_fixed").append($header);

$(window).bind("scroll", function() {
    var offset = $(this).scrollTop();

    if (offset >= tableOffset && $fixedHeader.is(":hidden")) {
        $fixedHeader.show();
        $("#tb_header_fixed").css('width',$("#tb_report_jurnal").width());
        for(var i =0; i< $("#tb_report_jurnal > tbody > tr").eq(0).find('td').length; i++){
            $("#tb_header_fixed > thead > tr.r_width th").eq(i).css('width',parseInt(parseInt($("#tb_report_jurnal > thead > tr.r_width th").eq(i).width())+parseInt(12))+'px');
            $("#tb_header_fixed > thead > tr.r_width th").eq(i).css('padding','8px 10px 8px 8px');// $("#tb_report_jurnal > tbody > tr").eq(0).find('td').eq(i).width()
        }
        // alert();
    }
    else if (offset < tableOffset) {
        $fixedHeader.hide();
    }
});