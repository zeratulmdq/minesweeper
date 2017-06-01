# DEVIGET coding challenge

- [X] Design and implement  a documented RESTful API for the game (think of a mobile app for your API)
- [X] Implement an API client library for the API designed above. Ideally, in a different language, of your preference, to the one used for the API
- [X] When a cell with no adjacent mines is revealed, all adjacent squares will be revealed (and repeat)
- [ ] Ability to 'flag' a cell with a question mark or red flag
- [X] Detect when game is over
- [X] Persistence
- [X] Time tracking
- [X] Ability to start a new game and preserve/resume the old ones
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

### 12:25Hs
* Another functional endpoint:
```bash
# PATCH /games/{id}/squares/{id}/reveal
To modify the state of the selected square and all necessary neighbours. As I did with the previous endpoint, I return the created instance to avoid another hit to the API. It also allows me to keep all the logic server-side (I intentionally hide the hasMine property of the Square model so it can't be revealed client-side).
```
* Persistence / Neighbours
Every model is saved into the database. Performance would have been greater if I had serialized/deserialized an array of objects as a DB text field but it's less of a "Laravel way".

* Time tracking
Returning the created_at field allows to implement time tracking client-side easily.

### 13:45Hs
* Vue.js SPA
A lot of considerations here. Time was limited so I used things I wouldn't normally use. 
1) Instead of a central bus to communicate between components I prefer to use a Vuex store. 
2) There's no routing configured, a lot of v-if/v-else around.
3) Missing components. Some stuff is wrapped in a HTML element to use v-if/v-else.
4) API calls should go into a dedicated service.
5) There's a dedicated repository for this, I don't like the way Laravel handles frontend. Anyway, this repo has de built version of the UI and it's ready to use.

### 14:30Hs
End of time.

* Minor fixes.
* 45min of manual testing. Known issues:

1) There's a problem with a Square method I couldn't fix so I move the logic to the controller. Not the best but it works (need some time to debug).
2) The logic implemented to reveal a mine and neighbours sometimes excedes the MAXIMUM_STACK_SIZE. 10 x 10 x 10 is a safe way to test the app but bigger grids could potentially ruin your life.