$(function() {

  var MARKOV_SENTINEL_WORD = "SENTINEL"; 

  function Markov(source) {
    var words = source.trim().split(/\s+/);

    var prefix_tab = {};

    var current_prefix = [MARKOV_SENTINEL_WORD, MARKOV_SENTINEL_WORD];
        
    for (var i = 0; i<words.length; i++) {
                
        prefix_tab[current_prefix] = prefix_tab[current_prefix] || [];
        prefix_tab[current_prefix].push(words[i]);
        
        current_prefix.shift();
        current_prefix.push(words[i]);
    }

    prefix_tab[current_prefix] = prefix_tab[current_prefix] || [];        
    prefix_tab[current_prefix].push(MARKOV_SENTINEL_WORD);

    this.generate = function(maxwords) {
        var generated = "";
        var current_prefix = [MARKOV_SENTINEL_WORD, MARKOV_SENTINEL_WORD];
        
        while(maxwords-- > 0) {
            var list = prefix_tab[current_prefix];  
            var nextWord = list[Math.floor(Math.random() * list.length)];
            
            if(nextWord == MARKOV_SENTINEL_WORD) break;
            generated += nextWord + " ";
            
            current_prefix.shift();
            current_prefix.push(nextWord);
        }
        
        return generated;
    }
  };
  var numberTexts = $('.txtNumber'),
      madnessButton = $('#madness'),
      injectionDiv = $('#myDiv');

  numberTexts.keypress(function(e) {
    var charCode = (e.which) ? e.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

         return true;
  })

  madnessButton.click(function(e) {
    //Get the three numbers out toot-sweet!
    var hpass_parts = parseInt($('#hpass_parts').val(), 10);
    var hpmor_parts = parseInt($('#hpmor_parts').val(), 10);
    var wpdr_parts = parseInt($('#wpdr_parts').val(), 10);
    var word_count = parseInt($('#word_count').val(), 10);

    e.preventDefault();
    var total_text ='';
    var wpdr_request = $.ajax({
      url: "text_files/harry_potter/wpdr_script.txt",
      type: "get"
    }).done(function (data){
      for(var i =0; i < wpdr_parts; i++){
        total_text += data;
      }
    });

    var wpdr_request = $.ajax({
      url: "text_files/harry_potter/hpmor_script.txt",
      type: "get"
    }).done(function (data){
      for(var i =0; i < hpmor_parts; i++){
        total_text += data;
      }
    });

    var hpass_request = $.ajax({
      url: "text_files/harry_potter/hpass_script.txt",
      type: "get"
    }).done(function (data){
      for(var i =0; i < hpass_parts; i++){
        total_text += data;
      }
      m = new Markov(total_text);
      var mtext = m.generate(word_count);
      injectionDiv.html(mtext);
    });
  });
});