var hero = new Character();
hero.add_source("images/hero.png");
hero.speed = 256;
hero.collision_type = "player character";

world.player = hero;

//Create the logic for placing monsters
var monsters = [];
world.monsters = monsters;

for (var i = 10; i >= 0; i--) {
	var monster = new Monster();
	monster.add_source("images/monster.png");
	monster.speed = 0;
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

// The main game loop
var main = function () {
	var now = Date.now();
	var delta = now - then;

	update(delta / 1000, hero, monsters, world);
  main_camera = new Camera();
  main_camera.draw_frame(ctx, background, hero, monsters);

	then = now;
};

// Let's play this game!
var then = Date.now();
setInterval(main, 1); // Execute as fast as possible
