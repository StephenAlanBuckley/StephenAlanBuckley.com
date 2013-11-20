
//Keyboard controls
var keys_down = {};

addEventListener("keydown", function (e) {
  e.preventDefault();
	keys_down[e.keyCode] = true;
}, false);

addEventListener("keyup", function (e) {
	delete keys_down[e.keyCode];
}, false);


/* Update
 * This function will update the positions of every game piece
 * based on recent input and calling each game piece's update() function.
 * This also is where we do spatially hashed collision detection,
 * though what to do in case of coliision is handled in each particular
 * game piece's class implementations.
 * 
 * @param modifier    the time elapsed since the last time that update was called
 * @param player      the game_piece that the player's input controls
 * @param game_pieces all of the non-player game pieces which need to be updated.
 * @param world       the world object containing environment specific information
 */
var update = function(modifier, player, game_pieces, world) {
  //No matter what direction they're moving in, they use their speed * the modifier.
  player_change = player.speed * modifier;
	if (32 in keys_down) { // Player pressing spacebar
	}
	if (38 in keys_down) { // Player pressing up
		player.y -= player_change;
	}
	if (40 in keys_down) { // Player pressing down
		player.y += player_change;
	}
	if (37 in keys_down) { // Player pressing left
		player.x -= player_change;
	}
	if (39 in keys_down) { // Player pressing right
		player.x += player_change;
	}

  //I'm fairly certain this isn't working.
  if (player.x >= world.width - player.image.width) {
    player.x = world.width - player.image.width;
  } else if(player.x <= 0) {
    player.x = 0;
  }
  if (player.y >= world.height - player.image.height) {
    player.y = world.height - player.image.height;
  } else if (player.y <= 0) {
    player.y = 0;
  }

  //We have to have a bucketed approach to collision- this is fairly dumb.
  if (game_pieces.length-1 >=0) {
    var spatial_hashes = {}; //We create an object so we can make an associative array
    //Make the buckets for spatial hashing!
    for (var i = game_pieces.length -1; i >= 0; i--) {
      var hash_string = game_pieces[i].x + "x" + game_pieces[i].y;
      //I'm a bit worried that this whole if statment won't work at all
      if (spatial_hashes.hasOwnProperty[hash_string]) {
        spatial_hashes[hash_string].push(game_pieces[i]);
      } else {
        spatial_hashes[hash_string] = [game_pieces[i]];
      }
    }
    if (spatial_hashes.hasOwnProperty(player.x + "x" + player.y) {
      spatial_hashes[player.x + "x" + player.y].push(player);
    }

    for (var key in spatial_hashes) {
      if (spatial_hashes[key].length-1 > 1) { //we want to make sure there are at least 2 objects to collide
        //--------------------------------------THIS IS WHERE I STOPPED WORKING--------------------------------->>
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
