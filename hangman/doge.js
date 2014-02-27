var letter_in = $("#guess_letter"),
    hope_button = $("#hope_button"),
    show_letters = $("#show_em_what_it_is");

var doge_words = [
  "wow",
  "such",
  "o",
  "so many",
  "so"];

var sad_words = [
  "sad",
  "stupid",
  "bad",
  "upset",
  "anger",
  "regret"
];

var happy_words = [
  "hooray",
  "smart",
  "geniouse",
  "good job",
  "success",
  "win"
];

var colors = [
  "blue",
  "green",
  "red",
  "black",
  "orange"
];

var guess_word = "doge";
var number_wrong = 0;
var already_guessed = "";

RandomWord();

hope_button.on("click", function () {
  alert("wow");
  guess_letter(letter_in.val());
});

function guess_letter(letter) {
  if (was_already_guessed(letter)) {
    return create_guessed_string(letter);
  }
  already_guessed += letter;

  var success = false;
  for(var i = 0; i < guess_word.length; i++) {
    if (guess_word[i] === letter) {
      reveal_letter_at(i);
      success = true;
    }
  }
  if (success) {
    new_great_job(letter);
    if (check_for_win()) {
      win();
    }
  } else {
    number_wrong += 1;
    new_insult(letter);
    if (check_for_loss()) {
      lose();
    }
  }
}

function win() {
  $('div').remove();
  $('body').append('<p>wow great yay was ' + guess_word + ' o stupendous. win.</p>');
  $('body').append('<iframe width="853" height="480" src="//www.youtube.com/embed/uHZMMrvkLks" frameborder="0" allowfullscreen></iframe>');
}

function lose() {
  $('div').remove();
  $('body').append('<p>wow sorry was ' + guess_word + ' o wow. lose.</p>');
  $('body').append('<img src="sad_doge.png" style="width=50%">');
}

function new_insult(letter) {
  var wrong_string = "";
  for (var i = 1; i <= 2; i++) {
    wrong_string += doge_words[Math.floor(Math.random() * doge_words.length)] + " ";
  }
  wrong_string += letter + " ";
  for (var i = 1; i <= 2; i++) {
    wrong_string += sad_words[Math.floor(Math.random() * sad_words.length)] + " ";
  }
  $("#insult_" + number_wrong).text(wrong_string).show();
  $("#insult_" + number_wrong).css({'color' : colors[Math.floor(Math.random() * colors.length)], 'font-size' : '125%'});
}


function new_great_job(letter) {
  var success_string = "";
  for (var i = 1; i <= 2; i++) {
    success_string += doge_words[Math.floor(Math.random() * doge_words.length)] + " ";
  }
  success_string += letter + " ";
  for (var i = 1; i <= 2; i++) {
    success_string += happy_words[Math.floor(Math.random() * happy_words.length)] + " ";
  }
  $("#success_string").text(success_string).show();
  $("#success_string").css({'color' : colors[Math.floor(Math.random() * colors.length)], 'font-size' : '125%'});
}

function reveal_letter_at(index) {
  $("#letter_" + index).text(guess_word[index]);
}

function check_for_win() {
  for (var i = 0; i < guess_word.length; i++) {
    if (!was_already_guessed(guess_word[i])) {
      return false;
    }
  }
  return true;
}

function check_for_loss() {
  if (number_wrong > 4) {
    return true;
  } else {
    return false;
  }
}

function create_guessed_string(letter) {
  var wow_string = "";
  for (var i = 1; i <= 3; i++) {
    wow_string += doge_words[Math.floor(Math.random() * doge_words.length)] + " ";
  }
  wow_string += letter + " already guessed o no";
}


function was_already_guessed(letter) {
  if (already_guessed.indexOf(letter) !== -1) {
    return true;
  } else {
    return false;
  }
}

function RandomWord() {
  var requestStr = "http://randomword.setgetgo.com/get.php";

  $.ajax({
      type: "GET",
      url: requestStr,
      dataType: "jsonp",
      jsonpCallback: 'RandomWordComplete'
  });
}

function RandomWordComplete(data) {
  guess_word = data.Word.replace(/[^a-zA-Z]+/g, '');
  if (guess_word.length < 7 || guess_word.length > 10) {
    RandomWord();
    return;
  }
  for (var i = 0; i < guess_word.length; i++) {
    var letter = guess_word[i];
    if (/[a-zA-Z0]/.test(letter)) {
      var letter_html = "<p class=\"letter\" id=\"letter_" + i + "\">_</p>";
      $('#show_em_what_it_is').append($(letter_html));
    }
  }
}
