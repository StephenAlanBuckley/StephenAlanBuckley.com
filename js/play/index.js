var rotation = 0;
var center_x = 400;
var center_y = 400;
var inner_radius = 10;
var outer_radius = 50;

var ferris_canvas = $('#ferris_canvas');
var paint_context = ferris_canvas.getContext('2d');

var ferris_bounds = ferris_canvas.getBoundingClientRect();
center_x = ferris_bounds.right - ferris_bounds.left;
center_y = ferris_bounds.bottom - ferris_bounds.top;

setInterval(function() {
  var cars = $('.wheel a');
  for (index =0; index < cars.length; ++index) {
    var bounding_rect = cars[index].getBoundingClientRect();
    var width = bounding_rect.right - bounding_rect.left;
    var height = bounding_rect.bottom - bounding_rect.top;
    var new_x = center_x - (width/2) + (Math.cos(rotation + (1 * index)) * Math.PI);
    var new_y = center_y - (height/2) + (Math.sin(rotation + (1 * index)) * Math.PI);
    $(cars[index]).offset({ top: new_y * outer_radius, left: new_x * outer_radius});
    paint_context.moveTo(new_x * inner_radius, new_y * inner_radius);
    paint_context.lineTo(new_x * outer_radius, new_y * outer_radius);
    paint_context.stroke();
  }
  paint_context.arc(center_x, center_y, inner_radius, 0, 2 * Math.PI);
  paint_context.stroke();
  paint_context.arc(center_x, center_y, outer_radius, 0, 2 * Math.PI);
  paint_context.stroke();
  rotation = rotation + .1;
}, 200);
