//Just the Game Canvas, no matter what we want to do with it
//And making the controls
var canvas = document.createElement("canvas");
var ctx = canvas.getContext("2d");
canvas.width = 512;
canvas.height = 480;
canvas.setAttribute("tabindex", "0");
canvas.setAttribute("id", "game_canvas");
var frame = document.getElementById('game_frame');
frame.appendChild(canvas);

//Keyboard controls
var keysDown = {};

addEventListener("keydown", function (e) {
  e.preventDefault();
	keysDown[e.keyCode] = true;
}, false);

addEventListener("keyup", function (e) {
	delete keysDown[e.keyCode];
}, false);
