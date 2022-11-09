var user;
var newChampionshipUsersEmail = Array();
var newChampionshipUsersName = Array();
var session_credentials;

loadUser();
loadChampionshipPageData();

function loadUser() {
    $.ajax({
        url: "./api/get_session.php",
        cache: false
    }).done(function(result){
        session_credentials = $.parseJSON(result);
    
        const formData = new FormData();
        formData.append('email', session_credentials.email);
    
        fetch('./api/get_user_by_email.php', {
            method: 'POST',
            header: {
                'Content-Type': 'application/json'
            },
            body: formData,
        }).then(response => response.json()).then(data => {
            user = data[0];
    
            newChampionshipUsersEmail.push(user.email);
            newChampionshipUsersName.push(user.username);
            buildChampionshipUsersTable();
            buildChampionshipCards();
            
            if(document.getElementById('set_username') && document.getElementById('set_email') && document.getElementById('set_wins') && document.getElementById('set_pole_positions') && document.getElementById('set_podiums')){
                document.getElementById('set_username').innerHTML = user.username;
                document.getElementById('set_email').innerHTML = user.email;
                document.getElementById('set_wins').innerHTML = user.wins;
                document.getElementById('set_pole_positions').innerHTML = user.pole_positions;
                document.getElementById('set_podiums').innerHTML = user.podiums;
            }
        });
    
        fetch('./api/get_most_recent_championship_by_email.php', {
            method: 'POST',
            header: {
                'Content-Type': 'application/json'
            },
            body: formData,
        }).then(response => response.json()).then(data => {
            if (data[0]){
                formData.append('id_championship', data[0].id_championship);
                fetch('./api/get_championship_by_id.php', {
                    method: 'POST',
                    header: {
                        'Content-Type': 'application/json'
                    },
                    body: formData,
                }).then(response => response.json()).then(data => {
                    if (data){
                        document.getElementById('championship-name').innerHTML = "\""+data[0].name+"\"";

                        var tableRows = "<tr><th id=\"column-1\">Posizione</th><th id=\"column-2\">Pilota</th><th id=\"column-3\">Punti</th></tr>";
                        for (var i = 0; i < data.length; i++){
                            tableRows += "<tr><td>"+(i+1)+"°</td><td>"+data[i].username+"</td><td>"+data[i].points+"</td></tr>"
                        }
                        
                        if (document.getElementById('championship-users')) document.getElementById('championship-users').innerHTML = tableRows;
                    }
                });
            }
        });
    });
}

function deleteUser() {
    var formData = new FormData().append("email", user.email);
    fetch('./api/delete_user_by_email.php', {
        method: 'POST',
        header: {
        'Content-Type': 'application/json'
        },
        body: formData,
    });

    window.location.href = './api/logout.php';
}

function changeUsername() {
    var formData = new FormData();
    formData.append("email", user.email);
    formData.append('username', document.getElementById('new-username').value);

    fetch('./api/update_username_by_email.php', {
        method: 'POST',
        header: {
        'Content-Type': 'application/json'
        },
        body: formData,
    }).then(response => response.json()).then(data => {
        user = data[0];
        
        document.getElementById('set_username').innerHTML = user.username;
        history.back();
    });
}

function createNewChampionship(){
    loadUser();

    if (document.getElementById('new-championship-input').value){
        var formData = new FormData();
        formData.append("email", user.email);
        formData.append('new_championship_name', document.getElementById('new-championship-input').value);

        fetch('./api/create_new_championship.php', {
            method: 'POST',
            header: {
            'Content-Type': 'application/json'
            },
            body: formData,
        }).then(response => response.json()).then(data => {
            var championshipFormData = new FormData();
            championshipFormData.append('id_championship', data[0].id);
            for (var i = 0; i < newChampionshipUsersEmail.length; i++){
                championshipFormData.append('email', newChampionshipUsersEmail[i]);
                fetch('./api/email_validation.php', {
                    method: 'POST',
                    header: {
                    'Content-Type': 'application/json'
                    },
                    body: championshipFormData,
                }).then(response => response.json()).then(data => {
                    if (data[0].exists){
                        championshipFormData.append('id_user', data[0].id);

                        fetch('./api/add_user_to_championship.php', {
                            method: 'POST',
                            header: {
                            'Content-Type': 'application/json'
                            },
                            body: championshipFormData,
                        })
                    }
                });
            }
            newChampionshipUsersEmail = [];
            newChampionshipUsersName = [];
            window.location.href = "./championships.php";
        });

        
    }else {
        alert("Inserisci il nome del campionato");
    }
}

function addNewChampionshipUsers(){
    var userToAddFormData = new FormData();
    userToAddFormData.append('email', document.getElementById('new-user-input').value);
    newChampionshipUsersEmail.push(document.getElementById('new-user-input').value);

    fetch('./api/email_validation.php', {
        method: 'POST',
        header: {
        'Content-Type': 'application/json'
        },
        body: userToAddFormData,
    }).then(response => response.json()).then(data => {
        if (data[0].exists){
            newChampionshipUsersName.push(data[0].username);
            history.back();
            buildChampionshipUsersTable();
        }
    });
}

function buildChampionshipCards(){
    if (user){
        var formData = new FormData();
        formData.append("email", user.email);
        fetch('./api/get_users_championships_by_email.php', {
            method: 'POST',
            header: {
            'Content-Type': 'application/json'
            },
            body: formData,
        }).then(response => response.json()).then(data => {
            var cards = "";
            for (var i = 0; i < data.length; i++){
                cards += "<div class=\"old-championship\"><div class=\"old-championship-top\"><h2>Campionato</h2><h3>\""+data[i].name+"\"</h3></div><div class=\"old-championship-info\"><div><h5>Gare disputate</h5><p>"+data[i].races+"</p></div><div><h5>La mia posizione in classifica</h5><p>"+data[i].position+"°</p></div><div><h5>Partecipanti</h5><p>"+data[i].participants+"</p></div></div><form action=\"./championship.php?id="+data[i].id+"\" method=\"POST\"><button type=\"submit\" class=\"championship-btn\">VEDI</button></form></div>";
            }
            cards += "<a class=\"new-championship\" href=\"./new-championship.php\"><h4>+</h4><p>NUOVO CAMPIONATO</p></a>"

            if (document.getElementById('championships__content')){
                document.getElementById('championships__content').innerHTML = cards;
            }
        });
    }
}

function buildChampionshipUsersTable(){
    var table = "";
    for (var i = 0; i < newChampionshipUsersName.length; i++){
    table += "<tr><td class=\"name\"><p>"+newChampionshipUsersName[i]+"</p></td><td><a href=\"#\">×</a></td></tr>";
    }

    if (document.getElementById('championship-users-table')){ 
        document.getElementById('championship-users-table').innerHTML = table;
    }
}

function loadChampionshipPageData() {
    if (document.getElementById('championship-classification')){
        let paramString = document.URL.split('?')[1];
        let queryString = new URLSearchParams(paramString);

        // queryString.entries().next().value returns the first url parameter -> [0] returns its name and [1] returns its value
        let championshipId = queryString.entries().next().value[1];
        if (championshipId){
            var formData = new FormData();
            formData.append('id_championship', parseInt(championshipId));

            fetch('./api/get_championship_by_id.php', {
                method: 'POST',
                header: {
                    'Content-Type': 'application/json'
                },
                body: formData,
            }).then(response => response.json()).then(data => {
                if (data){
                    document.getElementById('championship-name').innerHTML = "\""+data[0].name+"\"";

                    var tableRows = "<tr><th id=\"column-1\">Posizione</th><th id=\"column-2\">Pilota</th><th id=\"column-3\">Punti</th></tr>";
                    for (var i = 0; i < data.length; i++){
                        tableRows += "<tr><td>"+(i+1)+"°</td><td>"+data[i].username+"</td><td>"+data[i].points+"</td></tr>"
                    }
                    
                    document.getElementById('championship-classification').innerHTML = tableRows;
                }
            });
        }
    }
}