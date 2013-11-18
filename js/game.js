var world = new Object();

var BackGround = new GamePiece();
BackGround.add_source("images/background.png");

var Hero = new Character();
Hero.add_source("images/hero.png");
Hero.speed = 256;

world.player = Hero;

//Create the logic for placing monsters
var monsters = [];
world.monsters = monsters;

for (var i = 10; i >= 0; i--) {
	var monster = new Monster();
	monster.add_source("images/monster.png");
	monster.speed = Math.random() * 300;
	// Throw the monster somewhere on the screen randomly
	monster.x = 32 + (Math.random() * (canvas.width - 64));
	monster.y = 32 + (Math.random() * (canvas.height - 64));

	monsters.push(monster);
};

var monstersCaught = 0;

Hero.x = canvas.width / 2;
Hero.y = canvas.height / 2;

var offset_x = 0;
var offset_y = 0;

// Update game objects
var update = function (modifier) {
  player_change = Hero.speed * modifier;
	if (32 in keysDown) { // Player pressing spacebar
	}
	if (38 in keysDown) { // Player holding up
		Hero.y -= player_change;
    offset_y -= player_change;
	}
	if (40 in keysDown) { // Player holding down
		Hero.y += player_change;
    offset_y += player_change;
	}
	if (37 in keysDown) { // Player holding left
		Hero.x -= player_change;
    offset_x -= player_change;
	}
	if (39 in keysDown) { // Player holding right
		Hero.x += player_change;
    offset_x += player_change;
	}

	if (Hero.x >= (canvas.width - Hero.image.width)) {
		Hero.x = canvas.width - Hero.image.width;
	} else if (Hero.x < 0) {
		Hero.x = 0;
	}

	if (Hero.y >= (canvas.height - Hero.image.height)) {
		Hero.y = canvas.height - Hero.image.height;
	} else if (Hero.y < 0) {
		Hero.y = 0;
	}

	// Are they touching?
	if (monsters.length-1 >= 0){
		for (var i = monsters.length - 1; i >= 0; i--) {
			if ( //The monster and the hero are intersecting
			Hero.x <= (monsters[i].x + monsters[i].image.width)
			&& monsters[i].x <= (Hero.x + Hero.image.width)
			&& Hero.y <= (monsters[i].y + monsters[i].image.height)
			&& monsters[i].y <= (Hero.y + Hero.image.height)
		) { //Remove the monsters from the queue, increase the monster caught, and continue
			monsters.splice(i, 1);
			++monstersCaught;
			continue;
		} else {
			monsters[i].update(modifier);
		}

		if (monsters[i].x >= (canvas.width - monsters[i].image.width)) {
			monsters[i].x = (canvas.width - monsters[i].image.width-1);
		} else if (monsters[i].x < 0) {
			monsters[i].x = 1;
		}

		if (monsters[i].y >= (canvas.height - monsters[i].image.height)) {
			monsters[i].y = (canvas.height - monsters[i].image.height -1);
		} else if (monsters[i].y < 0) {
			monsters[i].y = 1;
		}

		};
	};
};

// Draw everything
//ctx is the canvas context object
var render = function () {
  offset_x = Hero.x - (canvas.width/2);
  offset_y = Hero.y - (canvas.height/2);
	if (BackGround.ready) {
		ctx.drawImage(BackGround.image, offset_x, offset_y, canvas.width, canvas.height, 0, 0, canvas.width, canvas.height);
	}

	if (Hero.ready) {
		ctx.drawImage(Hero.image, Hero.x - offset_x, Hero.y - offset_y);
	}
	for (var i = monsters.length - 1; i >= 0; i--) {	
		if (monsters[i].ready) {
			ctx.drawImage(monsters[i].image, monsters[i].x - offset_x, monsters[i].y - offset_y);
		}
	};

	// Score
	ctx.fillStyle = "rgb(250, 250, 250)";
	ctx.font = "24px Helvetica";
	ctx.textAlign = "left";
	ctx.textBaseline = "top";
	ctx.fillText("offset_x: " + offset_x, 32, 32);
};

// The main game loop
var main = function () {
	var now = Date.now();
	var delta = now - then;

	update(delta / 1000);
	render();

	then = now;
};

// Let's play this game!
var then = Date.now();
setInterval(main, 1); // Execute as fast as possible
