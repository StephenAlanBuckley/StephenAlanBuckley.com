//Has to come before movement and collision classes
var world = new Object();

var background = new Game_Piece();
background.add_source("images/pokemon_red_overworld");

world.width = background.image.width;
world.height = background.image.height;

