var diceval = 0;
var totdiceval = 0;

var users = [];

var userturn = 1;

function loadGame(user = 2) {
    users = []
    setUsers(user);
    document.getElementById('userDiv1').classList.add('turn');
}

function roleDice() {
    diceval = Math.floor(Math.random() * 6) + 1;
    totdiceval = totdiceval + diceval;

    document.getElementById('diceVal').innerHTML = diceval;
    document.getElementById('totalRole').innerHTML = totdiceval;
    if (diceval == 1) {
        diceval = totdiceval = 0;
        switchUser();
    }
}

function holdScore() {
    users[userturn - 1]['total'] = users[userturn - 1]['total'] + totdiceval;
    document.getElementById('user' + userturn + '_score').innerHTML = users[userturn - 1]['total'];
    diceval = totdiceval = 0;
    document.getElementById('diceVal').innerHTML = diceval;
    document.getElementById('totalRole').innerHTML = totdiceval;
    if (users[userturn - 1]['total'] >= 100) {
        alert('Congratulations.')
        document.getElementById('userDiv' + userturn).classList.add('win');
    } else {
        switchUser();
    }
}


function setUsers(user) {
    var i = 1;
    var html = '';
    var col = 'col-6';
    if (user == 3) {
        var col = 'col-4';
    } else if (user == 4) {
        var col = 'col-3';
    }
    do {
        html += '<div class = "' + col + '" >';
        html += '<div id = "userDiv' + i + '" > ';
        html += '<h4 > User ' + i + ' </h4>';
        html += '<h5 > Holded Score </h5>';
        html += '<span id = "user' + i + '_score" > 0 </span>';
        html += '</div > </div>';
        i++;
        users.push({ total: null })
    } while (i <= user)
    document.getElementById('usersDiv').innerHTML = html;
}

function switchUser() {
    document.getElementById('userDiv' + userturn).classList.remove('turn');

    if (userturn >= users.length) {
        userturn = 1;
    } else {
        userturn++;
    }
    document.getElementById('userDiv' + (userturn)).classList.add('turn');
}