//Top Down Pokemon-style base class
function GamePiece(){
	this.x = 0;
	this.y = 0;
	this.ready = true;
	this.image = new Image();
	this.collisionType = 'background';
	this.xMove = function(distance) {
		this.x += distance;
	}
	this.yMove = function(distance) {
		this.y += distance;
	}
}

GamePiece.prototype.add_source = function(source) {
  var root = "http://www.stephenalanbuckley.com/";
	this.image.src = root + source;
}

function Character(){
	GamePiece.call(this);
}

Character.prototype = new GamePiece();
Character.prototype.constructor = GamePiece;
Character.prototype.speed = 0;
Character.prototype.update = function(modifier){};
