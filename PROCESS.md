# DEVIGET coding challenge

- [X] Design and implement  a documented RESTful API for the game (think of a mobile app for your API)
- [ ] Implement an API client library for the API designed above. Ideally, in a different language, of your preference, to the one used for the API
- [X] When a cell with no adjacent mines is revealed, all adjacent squares will be revealed (and repeat)
- [ ] Ability to 'flag' a cell with a question mark or red flag
- [X] Detect when game is over
- [X] Persistence
- [X] Time tracking
- [ ] Ability to start a new game and preserve/resume the old ones
- [X] Ability to select the game parameters: number of rows, columns, and mines
- [ ] Ability to support multiple users/accounts

### 9:30Hs
* Started here. I spent 1 hour to think about the problem.

### 10:30Hs 
* Created the project. First push. 4 hours left.

### 11:40Hs
* Created models, migrations, api routes, GameController and GameRequest.

* There is only one working endpoints so far:
```bash
# POST /games
To create a new game. I prefer to return the created instance to avoid another hit to the API. It could have been a link to the resource as well.
```

### 12:40Hs
* Another functional endpoint:
```bash
# PATCH /games/{id}/squares/{id}/reveal
To modify the state of the selected square and all necessary neighbours. As I did with the previous endpoint, I return the created instance to avoid another hit to the API. It also allows me to keep all the logic server-side (I intentionally hide the hasMine property of the Square model so it can't be revealed client-side).
```
* Persistence / Neighbours
Every model is saved into the database. Performance would have been greater if I had serialized/deserialized an array of objects as a DB text field but it's less of a "Laravel way".

* Time tracking
Returning the created_at field allows to implement time tracking client-side easily.