//Just the Game Canvas, no matter what we want to do with it
//And making the controls
var canvas = document.createElement("canvas");
var ctx = canvas.getContext("2d");
canvas.width = 1000;
canvas.height = 1000;
canvas.setAttribute("tabindex", "0");
canvas.setAttribute("id", "game_canvas");
var frame = document.getElementById('game_frame');
frame.appendChild(canvas);

