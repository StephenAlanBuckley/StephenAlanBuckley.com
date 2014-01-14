$(function(){
    $.getJSON('http://www.reddit.com/user/StephenBuckley/comments.json?jsonp=?',
    function(data){
        console.log(data);

        var composite_score = 0;
        var output_html = "<div class='all_comments'>";

        var comments = data.data.children;
        for (var i = 0; i < comments.length; ++i) {
          var body = comments[i].data.body;
          var ups = comments[i].data.ups;
          var downs = comments[i].data.downs;
          var word_count = body.split(" ").length;
          var score = (ups - downs); //* word_count;
          var id = comments[i].data.id
          
          composite_score += score;

          output_html +=
            "<div id='" + id + "' class='comment_score'>" +
              "<p class='comment_body'>" + body + "</p>" +
              "<p class='comment_score'>" + score + "</p>" +
            "</div>";
        }
        output_html += "</div>" +
          "<p class='composite_score'>" + composite_score + "</p>";
        $('#wrap').append(output_html);
    });
});
