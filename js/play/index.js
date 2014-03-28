var up = false;
$('.seesaw_wrapper').on('click', function() {
    if(up) {
        $("#left_box").animate({left:10,
                                height:16,
                                width: 16,
                                top: -17},400);
        $("#right_box").animate({left:278,
                                 height:22,
                                 width: 22,
                                 top: -23},800);
        $(".bar").rotate({animateTo:15});
        up = false;
    } else {
        $("#left_box").animate({left:00,
                                height:22,
                                width: 22,
                                top: -23},800);
        $("#right_box").animate({left:274,
                                 height:16,
                                 width: 16,
                                 top: -17},400);
        $(".bar").rotate({animateTo:-15});
        up = true;        
    }
});
