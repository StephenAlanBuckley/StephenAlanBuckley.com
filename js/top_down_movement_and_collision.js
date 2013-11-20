
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

  var removals = [];
  for (var i = game_pieces.length -1; i >= 0; i--) {
    if (game_pieces[i].remove) {
     removals.push(i);
     continue;
    }
  }
  //Now we remove all of the iems marked for removal
  for (index in removals) {
    game_pieces.splice(index, 1);
  }

  if (game_pieces.length-1 >=0) {
    var spatial_hashes = {}; //We create an object so we can make an associative array
    //Make the buckets for spatial hashing!
    for (var i = game_pieces.length -1; i >= 0; i--) {
      game_pieces[i].update(modifier);
      add_piece_to_spatial_hash(game_pieces[i], spatial_hashes);
    }

    add_piece_to_spatial_hash(player, spatial_hashes);

    for (var key in spatial_hashes) {
      if (spatial_hashes[key].length-1 > 1) { //we want to make sure there are at least 2 objects to collide
         for (var i = spatial_hashes[key].length - 1; i >= 0; i--) {
           for (var j = spatial_hashes[key].length - 1; j >= 0; j--) {
             if (i !== j) {
                if (detect_collision(spatial_hashes[key][i], spatial_hashes[key][j])) {
                  spatial_hashes[key][i].collide_with(spatial_hashes[key][j]);
                  spatial_hashes[key][j].collide_with(spatial_hashes[key][i]);
                }
             }
           }
         }
      }
    }

	if (monsters.length-1 >= 0){
		for (var i = monsters.length - 1; i >= 0; i--) {

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
}

/*
 * The Hash_Bucket class is to assist in spatial hashing!
 * The relvant info for each bucket will be made on the fly
 * I should note that there are defaults for all of its values INCLUDING X AND Y!
 * Be careful!
 */
function Hash_Bucket(){
  this.x = 0;
  this.y = 0;
  this.collidables = [];
}

/* detect_collision
 * pretty straightforward- you give it two game pieces and it tells you whether or not they are colliding!
 * nice!
 */
var detect_collision = function(piece_one, piece_two) {
	if ( 
		piece_one.x <= (piece_two.x + piece_two.image.width)
		&& piece_two.x <= (piece_one.x + piece_one.image.width)
		&& piece_one.y <= (piece_two.y + piece_two.image.height)
		&& piece_two.y <= (piece_one.y + piece_one.image.height)
	) { 
    return true;
	} else {
    return false;
	}
}

var make_spatial_hashes = function(piece) {
  var corner_hashes = [];
  corner_hashes.push(Math.floor(piece.x/100) + "x" + Math.floor(piece.y/100));
  corner_hashes.push(Math.floor((piece.x + piece.width)/100) + "x" + Math.floor(piece.y/100));
  corner_hashes.push(Math.floor((piece.x + piece.width)/100) + "x" + Math.floor((piece.y + piece.height)/100));
  corner_hashes.push(Math.floor(piece.x/100) + "x" + Math.floor((piece.y + piece.height)/100));
  return corner_hashes;
}

var add_piece_to_spatial_hash = function(piece, spatial_hashes) {
  var hash_strings = make_spatial_hashes(piece);
  //I'm a bit worried that this whole following if statment won't work at all
  for (hash_string in hash_strings) {
    if (!spatial_hashes.hasOwnProperty[hash_string]) {
      spatial_hashes[hash_string] = new Hash_Bucket();
      spatial_hashes[hash_string].x = Math.floor(piece.x/100);
      spatial_hashes[hash_string].y = Math.floor(piece.y/100);
    }
    spatial_hashes[hash_string].collidables.push(piece);
  }
}
