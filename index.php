<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=600px" />
<style>
body {
  text-align: center;
  font-size: 16px;
  font-family: 'Comic Sans MS', Helvetica, sans-serif;
}
table {
  margin-left:auto; 
  margin-right:auto; 
  width: 551px; 
  -webkit-user-select: none; 
}
td {
  height: 175px;
  width: 175px;
  text-align: center;
  font-size: 120px;
  border: 2px solid #cccccc;
  -webkit-border-radius: 10px;
}
#players {
  margin-left:auto; 
  margin-right:auto;
  padding: 20px 10px 10px 10px;
  width: 511px; 
  text-align: left;
}
#players > div {
  display: inline-block;
  padding-right: 25px;
  color: #cccccc;
  -webkit-transition-duration: 200ms;
}
.button {
  float: right;
}
.current-player {
  color: black !important;
  -webkit-transform: scale(1.5);
}
.X-marker {
  color: #663366;
}
.X-marker:before {
  content: "X";
}
.O-marker {
  color: #CC0033;
}
.O-marker:before {
  content: "O";
}
</style>
  <script type="text/javascript">
  var board = new Array(9);

function init() {
 
  var down = "mousedown"; var up = "mouseup"; 
  if ('createTouch' in document) { down = "touchstart"; up ="touchend"; }
  

  document.querySelector("input.button").addEventListener(up, newGame, false);
  var squares = document.getElementsByTagName("td");
  for (var s = 0; s < squares.length; s++) {
    squares[s].addEventListener(down, function(evt){squareSelected(evt, getCurrentPlayer());}, false);
  }
  

  createBoard();
  setInitialPlayer();
}


function createBoard() {


  if (window.localStorage && localStorage.getItem('tic-tac-toe-board')) {
    
    
    board = (JSON.parse(localStorage.getItem('tic-tac-toe-board')));
    for (var i = 0; i < board.length; i++) {
      if (board[i] != "") {
        fillSquareWithMarker(document.getElementById(i), board[i]);
      }
    }
  }
 
  else {  
    for (var i = 0; i < board.length; i++) {
      board[i] = "";                               
      document.getElementById(i).innerHTML = "";
    }
  }
}


function squareSelected(evt, currentPlayer) {
  var square = evt.target;

  if (square.className.match(/marker/)) {
    alert("Sorry, that space is taken!  Please choose another square.");
    return;
  }
 else {
    fillSquareWithMarker(square, currentPlayer);
    updateBoard(square.id, currentPlayer);
    checkForWinner();
    switchPlayers(); 
  }
}

function fillSquareWithMarker(square, player) {
  var marker = document.createElement('div');
marker.className = player + "-marker";
  square.appendChild(marker);
}

function updateBoard(index, marker) {
  board[index] = marker;
  
 var boardstring = JSON.stringify(board);

 localStorage.setItem('tic-tac-toe-board', boardstring); 
  localStorage.setItem('last-player', getCurrentPlayer());
}


function declareWinner() {
  if (confirm("We have a winner!  New game?")) {
    newGame();
  }
}

function weHaveAWinner(a, b, c) {
  if ((board[a] === board[b]) && (board[b] === board[c]) && (board[a] != "" || board[b] != "" || board[c] != "")) {
    setTimeout(declareWinner(), 100);
    return true;
  }
  else
    return false;
}

function checkForWinner() {

  var a = 0; var b = 1; var c = 2;
  while (c < board.length) {
    if (weHaveAWinner(a, b, c)) {
      return;
    }
    a+=3; b+=3; c+=3;
  }
    

  a = 0; b = 3; c = 6;
  while (c < board.length) {
    if (weHaveAWinner(a, b, c)) {
      return;
    }
    a+=1; b+=1; c+=1;
  }


  if (weHaveAWinner(0, 4, 8)) {
    return;
  }

  if (weHaveAWinner(2, 4, 6)) {
    return;
  }
  
  if (!JSON.stringify(board).match(/,"",/)) {
    if (confirm("It's a draw. New game?")) {
      newGame();
    }
  }
}


function getCurrentPlayer() {
  return document.querySelector(".current-player").id;
}
function setInitialPlayer() {
  var playerX = document.getElementById("X");
  var playerO = document.getElementById("O");
  playerX.className = "";
  playerO.className = "";
    
 if (!window.localStorage || !localStorage.getItem('last-player')) {
    playerX.className = "current-player";
    return;
  } 

  var lastPlayer = localStorage.getItem('last-player');  
  if (lastPlayer == 'X') {
    playerO.className = "current-player";
  }
  else {
    playerX.className = "current-player";
  }
}

function switchPlayers() {
  var playerX = document.getElementById("X");
  var playerO = document.getElementById("O");
  
  if (playerX.className.match(/current-player/)) {
    playerO.className = "current-player";
    playerX.className = "";
  }
  else {
    playerX.className = "current-player";
    playerO.className = "";
  }
}

function newGame() {  

  localStorage.removeItem('tic-tac-toe-board');
  localStorage.removeItem('last-player');
    createBoard();
}
</script>
</head>

<body onload="init();">
<?php
 echo "Mkhabela Phethile 12097561";
 echo "<br/>";
 echo "!!Play me!!";
?>
 <div id="players">
  <div id="X" class="">Player X</div>
  <div id="O" class="">Player O</div>
  <input type="button" class="button" value="New Game">
</div>
<table>
  <tr>
    <td id="0"></td>
    <td id="1"></td>
    <td id="2"></td>
  </tr>
  <tr>
    <td id="3"></td>
    <td id="4"></td>
    <td id="5"></td>
  </tr>
  <tr>
    <td id="6"></td>
    <td id="7"></td>
    <td id="8"></td>
  </tr>
</table> 

</body>
</html>
