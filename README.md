Check the progress [here](PROCESS.md). All decisions will be explained there.
There's a different repo for the UI. Check it [here](https://github.com/zeratulmdq/minesweeper-ui)

## DOCS & USAGE

### Installation

```bash
# Clone this repo
git clone https://github.com/zeratulmdq/minesweeper.git

# cd into the folder
cd minesweeper

# Install dependencies
composer install

# Run the server
php artisan serve

# Play!
chromium http://localhost:8000
```

### Entities
```js
// Square
{
	row: int, 
	column: int, 
	status: int, 
	hasMine: boolean, 
	neighbours: int
}

// Game (Minesweeper)
{
	rows: int, 
	columns: int, 
	mines: int,
	over: boolean,
	won: boolean,
	squares: Array (Squares),
	created_at: Date,
	updated_at: Date
}
```

### Endpoints

> POST /games
To create a new game. Will be persisted automatically.

```bash
# Expected params
columns: int, required, min:20, max:30
rows: int, required, min:20, max:30
mines: int, required, min:20, max:30

# Returns
An instance of Game
```

> PATCH /games/{id}/squares/{id}/reveal
To reveal the selected mine and necessary neighbours

```bash
# Expected params
columns: int, required, min:20, max:30
rows: int, required, min:20, max:30
mines: int, required, min:20, max:30

# Returns
An instance of Game
```

> GET /games/{id}
Returns the selected game if exists

```bash
# Expected params
None

# Returns
An instance of Game
```