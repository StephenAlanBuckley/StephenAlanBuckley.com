$('.int_only').keyup(
  function() { 
    this.value = this.value.replace(/[^0-9]/g,'');
  }
);

$('#create_the_league').on('click', function() {
  var days = $('#league_days_text').val();
  var name = $('#league_name_text').val();
  if (name.length < 3) {
    set_status("Mmmmmmmmnope.", "Sorry, but the name of your league has to be at least 3 characters long. Mostly because who wants a 2 character long league? That would... that would be kinda silly, I think we can all agree on that!", "danger");
  }

  if (days < 1) {
    set_status("Come on!", "You have to enter how often you want game days! Make it a number that's at LEAST 1. You've got this. I know you can handle this number thing. I mean look at you! You're on the internet! You're typing and stuff! Yeah! Yeah! Go you!", "danger");
    return;
  }

  var user_info_url = "/utilities/session_functions.php";
  var user_id = -1;
  $.ajax({
    dataType: "json",
    url: user_info_url,
    async: false,
    type: "GET",
    data: {
      "function" : "get_user_info"
    }
  }).done(function(data) {
    if(data !== null) {
     user_id = data.user_id;
    }
  });

  if (user_id === -1) {
    set_status(user_id, "Something's gone wrong with your session! Try logging in again and then making a league. This is totally my bad!", "danger");
    return;
  }

 var league_creation_url = '/fantasy_reddit/utilities/league_functions.php';

 $.ajax({
   dataType: "json",
   url: league_creation_url,
   async: false,
   type: "GET",
   data: {
     "function" : "create_league",
     "id"       : user_id,
     "name"     : name,
     "days"     : days
   }
 }).done(function(data) {
  if (data.Result === "true") {
    set_status("Whoohoo!", "Your brand spanking new Fantasy Reddit League has been created! So make a team, invite some friends, and get going!", "success");
  } else {
    set_status("Bah!", "Something went wrong with your league being made. " + data.Message + ". <---- That's what went wrong!", "danger");
  }
 });
 console.log("AJAX ended.");
});

function set_status(header, body, panel_type) {
  $("#status_header").html(header);
  $("#status_body").html(body);
  $("#league_creation_status").addClass("panel-" + panel_type);
}
