function Monster(){
	Character.call(this);
}

Monster.prototype = new Character();
Monster.prototype.constructor = Character;
Monster.prototype.sensitivity = 100;

//This is the basic monster so it just avoids the hero if he comes within sensitivity range
Monster.prototype.update = function(modifier) {
	if (Math.abs(world.player.x - this.x) < this.sensitivity && Math.abs(world.player.y - this.y) < this.sensitivity) {
		var x_mod = -(world.player.x - this.x)/Math.abs(world.player.x - this.x);
		var y_mod = -(world.player.y - this.y)/Math.abs(world.player.y - this.y);

		this.x_move(this.speed * x_mod * modifier);
		this.y_move(this.speed * y_mod * modifier);
	}
}
