var world = new Object();

var background = new Game_Piece();
background.add_source("images/pokemon_red_overworld");

world.width = background.image.width;
world.height = background.image.height;

var hero = new Character();
hero.add_source("images/hero.png");
hero.speed = 256;

world.player = hero;

//Create the logic for placing monsters
var monsters = [];
world.monsters = monsters;

for (var i = 10; i >= 0; i--) {
	var monster = new Monster();
	monster.add_source("images/monster.png");
	monster.speed = Math.random() * 300;
	// Throw the monster somewhere on the screen randomly
	monster.x = 32 + (Math.random() * (world.width - 64));
	monster.y = 32 + (Math.random() * (world.height - 64));

	monsters.push(monster);
};

var monstersCaught = 0;

hero.x = world.width / 2;
hero.y = world.height / 2;

var offset_x = 0;
var offset_y = 0;

// Update game objects
var update = function (modifier) {
  player_change = hero.speed * modifier;
	if (32 in keysDown) { // Player pressing spacebar
	}
	if (38 in keysDown) { // Player holding up
		hero.y -= player_change;
	}
	if (40 in keysDown) { // Player holding down
		hero.y += player_change;
	}
	if (37 in keysDown) { // Player holding left
		hero.x -= player_change;
	}
	if (39 in keysDown) { // Player holding right
		hero.x += player_change;
	}

  if (hero.x >= world.width - hero.image.width) {
    hero.x = world.width - hero.image.width;
  } else if(hero.x <= 0) {
    hero.x = 0;
  }

  if (hero.y >= world.height - hero.image.height) {
    hero.y = world.height - hero.image.height;
  } else if (hero.y <= 0) {
    hero.y = 0;
  }
  
	// Are they touching?
	if (monsters.length-1 >= 0){
		for (var i = monsters.length - 1; i >= 0; i--) {
			if ( //The monster and the hero are intersecting
			hero.x <= (monsters[i].x + monsters[i].image.width)
			&& monsters[i].x <= (hero.x + hero.image.width)
			&& hero.y <= (monsters[i].y + monsters[i].image.height)
			&& monsters[i].y <= (hero.y + hero.image.height)
		) { //Remove the monsters from the queue, increase the monster caught, and continue
			monsters.splice(i, 1);
			++monstersCaught;
			continue;
		} else {
			monsters[i].update(modifier);
		}

		if (monsters[i].x >= (world.width - monsters[i].image.width)) {
			monsters[i].x = (world.width - monsters[i].image.width-1);
		} else if (monsters[i].x < 0) {
			monsters[i].x = 1;
		}

		if (monsters[i].y >= (world.height - monsters[i].image.height)) {
			monsters[i].y = (world.height - monsters[i].image.height -1);
		} else if (monsters[i].y < 0) {
			monsters[i].y = 1;
		}

		};
	};
};

// The main game loop
var main = function () {
	var now = Date.now();
	var delta = now - then;

	update(delta / 1000);
  main_camera = new Camera();
  main_camera.draw_frame(ctx, background, hero, monsters);

	then = now;
};

// Let's play this game!
var then = Date.now();
setInterval(main, 1); // Execute as fast as possible
