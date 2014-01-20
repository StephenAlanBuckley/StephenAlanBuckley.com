var rotation = 0;
var center_x = 100;
var center_y = 100;

setInterval(function() {
  var cars = $('.wheel a');
  for (index =0; index < cars.length; ++index) {
    var new_x = center_x + (cos(rotation + 10 * index) * Math.PI);
    var new_y = center_y + (sin(rotation + 10 * index) * Math.PI);
    cars[index].offset({ top: new_y, left: new_x});
  }
  rotation = rotation + 1;
}, 20);
