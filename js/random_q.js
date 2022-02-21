$(function() {
    var arr = [];
    $("#10q .question").each(function() {
        arr.push($(this).html());
    });
    arr.sort(function() {
        return Math.random() - Math.random();
    });
    $("#10q").empty();
    for(i=0; i < arr.length; i++) {
        $("#10q").append('<div class="question">' + arr[i] + '</div>');
    }
});