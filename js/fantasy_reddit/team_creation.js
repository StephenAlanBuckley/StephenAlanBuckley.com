function evaluate_redditor (redditor) {
  var evaluate_redditor_url = "http://" + window.location.host + "/fantasy_reddit/utilities/reddit_functions.php";
  $.ajax({
    dataType: "json",
    url: evaluate_redditor_url,
    async: false,
    type: "GET",
    data: {
      "function" : "evaluate_redditor",
      "redditor" : redditor
    }
  }).done(function(data) {
    if(data.Result === "true") {
      return data.Message;
    } else {
      return "false";
    }
  });
}

$('.evaluate_redditor_button').on("click", function() {
  var id = $(this).attr("id");
  id = id.replace("evaluate_", "");
  var name_input = $("#redditor_" + id).val();
  var evaluation = evaluate_redditor(name_input);
  if (evaluation.localeCompare("false") !== 0) {
    $("#redditor_status_" + id).text(evaluation);
  }
});
