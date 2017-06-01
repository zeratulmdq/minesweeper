Check the progress [here](PROCESS.md). All decisions will be explained there.

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
	won: boolean
}
```