var explanation = $('#explanation');
var help_button = $('#help_button');
var display_total_redditors = $('#total_redditors');
var display_total_karma = $('#total_karma');

var maximum_team_karma = 2000;
var maximum_team_members = 10;
$(".input_redditor_row").hide();

explanation.hide();

var showing_redditors_up_to = 0;
var team_karma =0;
show_next_available_slot(0);

help_button.on("click", function() {
  explanation.toggle();
  $(this).parent().hide();
});

$('#add_player').on("click", function() {
  if (showing_redditors_up_to < maximum_team_members-1) {
    showing_redditors_up_to += 1;
    show_next_available_slot(showing_redditors_up_to);
  }
});

$('.enter_redditor_name').on("blur", function() {
  var id = $(this).attr("id");
  var index = id.replace("redditor_", "");
  var redditor = $(this).val();
  var evaluation = evaluate_redditor(redditor);
  update_evaluation(index, evaluation);
});

$('.evaluate_redditor_button').on("click", function() {
  var id = $(this).attr("id");
  var index = id.replace("evaluate_", "");
  var name_input = $("#redditor_" + index).val();
  var evaluation = evaluate_redditor(name_input);
  update_evaluation(index, evaluation);
});

function update_evaluation(index, evaluation) {
  if (evaluation !== "false") {
    $("#redditor_status_" + index).text(evaluation);
    var display_karma = Math.ceil(get_team_karma());
    display_total_karma.text(display_karma + "/" + maximum_team_karma);
    display_total_redditors.text(showing_redditors_up_to + 1 + "/" + maximum_team_members);
  }
}

function get_team_karma() {
  var stati = $('.redditor_status');
  var stati_count = stati.length;
  var total = 0;
  for (i =0; i < stati_count; i++) {
    if ($(stati[i]).text() !== "") {
      var some = $(stati[i]).text();
      total += parseFloat($(stati[i]).text());
    }
  }
  return total;
}

function show_next_available_slot(index) {
  var redditor_rows = $(".input_redditor_row");
  $(redditor_rows[index]).show();
}

function evaluate_redditor (redditor) {
  var evaluation = "false";
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
      evaluation = data.Message;
    } else {
      evaluation = "false";
    }
  });
  return evaluation;
}

