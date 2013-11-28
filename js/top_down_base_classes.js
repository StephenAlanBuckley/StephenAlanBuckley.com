//Top Down Pokemon-style base classes

//The root of the Game_Piece object hierarchy
function Game_Piece(){
	this.x = 0;
	this.y = 0;
	this.ready = false;
	this.image = new Image();
	this.collision_type = 'background';
  this.remove = false;
	this.x_move = function(distance) {
		this.x += distance;
	}
	this.y_move = function(distance) {
		this.y += distance;
	}
}
Game_Piece.prototype.add_source = function(source) {
  var root = "http://www.stephenalanbuckley.com/";
  //we make the onload function set the ready to true
  this.image.onload = function() {
    this.ready = true;
  }
	this.image.src = root + source;
}
Game_Piece.prototype.collide_with = function(piece) {
  //This is a placeholder method- actual implementation should be handled
  //by subclasses
}

//The Character class extends the Game_Piece object for PCs and NPCs
function Character(){
	Game_Piece.call(this);
}
Character.prototype = new Game_Piece();
Character.prototype.constructor = Game_Piece;
Character.prototype.speed = 0;
Character.prototype.update = function(modifier){};

//The camera class draws each frame
function Camera() {
  this.offset_x = 0;
  this.offset_y = 0;
  this.frames_drawn = 0;
  this.draw_frame = function(ctx, background, focus, game_objects) {
    max_x = background.width - canvas.width;
    max_y = background.height - canvas.height;
    
    offset_x = focus.x - (canvas.width/2);
    offset_y = focus.y - (canvas.height/2);
    
    //Don't try to draw beyond the bounds of the background's image
    if (offset_x > max_x) {
      offset_x = max_x;
    } else if (offset_x <= 0) {
      offset_x = 0;
    }
    if (offset_y > max_y) {
      offset_y = max_y;
    } else if (offset_y <= 0) {
      offset_y = 0;
    }

	  if (background.ready) {
	  	ctx.drawImage(background.image, offset_x, offset_y, canvas.width, canvas.height, 0, 0, canvas.width, canvas.height);
	  }

	  if (focus.ready) {
	  	ctx.drawImage(focus.image, focus.x - offset_x, focus.y - offset_y);
	  }
	  for (var i = game_objects.length - 1; i >= 0; i--) {	
	  	if (game_objects[i].ready) {
	  		ctx.drawImage(game_objects[i].image, game_objects[i].x - offset_x, game_objects[i].y - offset_y);
	  	}
	  };

	  // Score
	  ctx.fillStyle = "rgb(250, 250, 250)";
	  ctx.font = "24px Helvetica";
	  ctx.textAlign = "left";
	  ctx.textBaseline = "top";
	  ctx.fillText("offset_x: " + offset_x, 32, 32);
  }
}
