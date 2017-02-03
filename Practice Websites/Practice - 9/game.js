(function(){

	function setChar(charSelect, num){

    	if (num == 1){
    		document.getElementById("men-1").style.visibility = "hidden";

    		if (charSelect == "human"){
    			document.getElementById("cont-1").style.backgroundImage = "url('human-symbol.png')";
                document.getElementById("but-1").innerHTML = "EMPOWER";
                document.getElementById("but-2").innerHTML = "ATTACK";
                document.getElementById('but-1').addEventListener('click', function(){
                    useMove("empower");
                });
                document.getElementById('but-2').addEventListener('click', function(){
                    useMove("attack");
                });
    		} else if (charSelect == "dwarf") {
    			document.getElementById("cont-1").style.backgroundImage = "url('dwarf-symbol.png')";
                document.getElementById("but-1").innerHTML = "DEFEND";
                document.getElementById("but-2").innerHTML = "ATTACK";
                document.getElementById('but-1').addEventListener('click', function(){
                    useMove("defend");
                });
                document.getElementById('but-2').addEventListener('click', function(){
                    useMove("attack");
                });
    		} else if (charSelect == "elf") {
    			document.getElementById("cont-1").style.backgroundImage = "url('elf-symbol.png')";
                document.getElementById("but-1").innerHTML = "HEAL";
                document.getElementById("but-2").innerHTML = "ATTACK";
                document.getElementById('but-1').addEventListener('click', function(){
                    useMove("heal");
                });
                document.getElementById('but-2').addEventListener('click', function(){
                    useMove("attack");
                });
    		}

    	} else if (num == 2){
    		document.getElementById("men-2").style.visibility = "hidden";

    		if (charSelect == "human"){
    			document.getElementById("cont-2").style.backgroundImage = "url('human-symbol.png')";
                document.getElementById("but-3").innerHTML = "EMPOWER";
                document.getElementById("but-4").innerHTML = "ATTACK";
                document.getElementById('but-3').addEventListener('click', function(){
                    useMove("empower");
                });
                document.getElementById('but-4').addEventListener('click', function(){
                    useMove("attack");
                });
    		} else if (charSelect == "dwarf") {
    			document.getElementById("cont-2").style.backgroundImage = "url('dwarf-symbol.png')";
                document.getElementById("but-3").innerHTML = "DEFEND";
                document.getElementById("but-4").innerHTML = "ATTACK";
                document.getElementById('but-3').addEventListener('click', function(){
                    useMove("defend");
                });
                document.getElementById('but-4').addEventListener('click', function(){
                    useMove("attack");
                });
    		} else if (charSelect == "elf") {
    			document.getElementById("cont-2").style.backgroundImage = "url('elf-symbol.png')";
                document.getElementById("but-3").innerHTML = "HEAL";
                document.getElementById("but-4").innerHTML = "ATTACK";
                document.getElementById('but-3').addEventListener('click', function(){
                    useMove("heal");
                });
                document.getElementById('but-4').addEventListener('click', function(){
                    useMove("attack");
                });
    		}
    	}

        ready++;	
        if (ready == 2) {
            setTurn(1);
        }

    }

    function setBoard() {
    	document.getElementById("but-1").style.visibility = "hidden";
    	document.getElementById("but-2").style.visibility = "hidden";
    	document.getElementById("but-3").style.visibility = "hidden";
    	document.getElementById("but-4").style.visibility = "hidden";
        document.getElementById('char-1-1').addEventListener('click', function(){
            setChar("human", 1);
        });
        document.getElementById('char-1-2').addEventListener('click', function(){
            setChar("dwarf", 1);
        });
        document.getElementById('char-1-3').addEventListener('click', function(){
            setChar("elf", 1);
        });
        document.getElementById('char-2-1').addEventListener('click', function(){
            setChar("human", 2);
        });
        document.getElementById('char-2-2').addEventListener('click', function(){
            setChar("dwarf", 2);
        });
        document.getElementById('char-2-3').addEventListener('click', function(){
            setChar("elf", 2);
        });

    }

    function setTurn(player) {

        if (player == 1){
            turn = 1;
            document.getElementById("but-1").style.visibility = "visible";
            document.getElementById("but-2").style.visibility = "visible";
            document.getElementById("but-3").style.visibility = "hidden";
            document.getElementById("but-4").style.visibility = "hidden";
            if (p1_Empowers == 1){
                document.getElementById("but-1").style.color = "#858585"
            } else if (p1_Empowers == 0){
                document.getElementById("but-1").style.color = "#FFFFFF"
            }
        } else if (player == 2){
            turn = 2;
            document.getElementById("but-1").style.visibility = "hidden";
            document.getElementById("but-2").style.visibility = "hidden";
            document.getElementById("but-3").style.visibility = "visible";
            document.getElementById("but-4").style.visibility = "visible";
            if (p2_Empowers == 1){
                document.getElementById("but-3").style.color = "#858585"
            } else if (p2_Empowers == 0){
                document.getElementById("but-3").style.color = "#FFFFFF"
            }
        }

    }

    function useMove(move) {

        if (turn == 1){
            if (move == "attack"){
                if (p1_Empowers == 1){
                    if (p2_Defends == 1){
                        p2Health -= 105;
                        p1_Empowers = 0;
                        p2_Defends = 0;
                    } else {
                        p2Health -= 125
                        p1_Empowers = 0;
                    }
                } else {
                    if (p2_Defends == 1){
                        p2Health -= 30;
                        p2_Defends = 0;
                    } else {
                        p2Health -= 50
                    }
                }
                setTurn(2);
            } else if (move == "empower"){
                if (p1_Empowers != 1){
                    p1_Empowers++;
                    setTurn(2);
                }
            } else if (move == "defend"){
                if (p1_Defends != 1){
                    p1_Defends++;
                    setTurn(2);
                }
            } else if (move == "heal"){
                if (p1Health < 1000){
                    p1Health += 40;
                    if (p1Health > 1000){
                        p1Health = 1000;
                    }
                    setTurn(2);
                }
            }
            console.log(p1Health);
            console.log(p2Health);
        } else if (turn == 2){
            if (move == "attack"){
                if (p2_Empowers == 1){
                    if (p1_Defends == 1){
                        p1Health -= 105;
                        p2_Empowers = 0;
                        p1_Defends = 0;
                    } else {
                        p1Health -= 125
                        p2_Empowers = 0;
                    }
                } else {
                    if (p1_Defends == 1){
                        p1Health -= 30;
                        p1_Defends = 0;
                    } else {
                        p1Health -= 50
                    }
                }
                setTurn(1);
            } else if (move == "empower"){
                if (p2_Empowers != 1){
                    p2_Empowers++;
                    setTurn(1);
                }
            } else if (move == "defend"){
                if (p2_Defends != 1){
                    p2_Defends++;
                    setTurn(1);
                }
            } else if (move == "heal"){
                if (p2Health < 1000){
                    p2Health += 40;
                    if (p2Health > 1000){
                        p2Health = 1000;
                    }
                    setTurn(1);
                }
            }
            console.log(p1Health);
            console.log(p2Health);
        }

        calcHealth();

    }

    function calcHealth(){

        var health = (p1Health / 10) / 2;

        document.getElementById("health-1").style.width = health + "%";

        if (health <= 5){
            document.getElementById("health-1").style.backgroundColor = "red";
        }

        health = (p2Health / 10) / 2;

        document.getElementById("health-2").style.width = health + "%";

        if (health <= 5){
            document.getElementById("health-2").style.backgroundColor = "red";
        }

        if (p1Health <= 0){
            document.getElementById("health-1").style.width = "0%";
            document.getElementById("health-1-nums").innerHTML = "0/1000";
            document.getElementById("cont-1").style.backgroundImage = "url('winner-2.png')";
            document.getElementById("cont-2").style.backgroundImage = "url('winner-2.png')";
            document.getElementById("but-1").style.visibility = "hidden";
            document.getElementById("but-2").style.visibility = "hidden";
            document.getElementById("but-3").style.visibility = "hidden";
            document.getElementById("but-4").style.visibility = "hidden";
            var replayGame = setInterval(replay, 500);
            document.getElementById("player-1").innerHTML = "REPLAY?";
            document.getElementById("player-2").innerHTML = "REPLAY?";
            document.getElementById('player-1').addEventListener('click', function(){
                window.location.reload();
            });
            document.getElementById('player-2').addEventListener('click', function(){
                window.location.reload();
            });
            document.getElementById("player-1").style.cursor = "pointer";
            document.getElementById("player-2").style.cursor = "pointer";
        } else if (p2Health <= 0){
            document.getElementById("health-2").style.width = "0%";
            document.getElementById("health-2-nums").innerHTML = "0/1000";
            document.getElementById("cont-1").style.backgroundImage = "url('winner-1.png')";
            document.getElementById("cont-2").style.backgroundImage = "url('winner-1.png')";
            document.getElementById("but-1").style.visibility = "hidden";
            document.getElementById("but-2").style.visibility = "hidden";
            document.getElementById("but-3").style.visibility = "hidden";
            document.getElementById("but-4").style.visibility = "hidden";
            var replayGame = setInterval(replay, 500);
            document.getElementById("player-1").innerHTML = "REPLAY?";
            document.getElementById("player-2").innerHTML = "REPLAY?";
            document.getElementById('player-1').addEventListener('click', function(){
                window.location.reload();
            });
            document.getElementById('player-2').addEventListener('click', function(){
                window.location.reload();
            });
            document.getElementById("player-1").style.cursor = "pointer";
            document.getElementById("player-2").style.cursor = "pointer";
        } else {
            document.getElementById("health-1-nums").innerHTML = p1Health + "/1000";
            document.getElementById("health-2-nums").innerHTML = p2Health + "/1000";
        }

    }

    function replay() {

        if (replayCount % 2 == 0) {
            document.getElementById("player-1").style.color = "#1A1A1A";
            document.getElementById("player-2").style.color = "#1A1A1A";
        } else {
            document.getElementById("player-1").style.color = "#FFFFFF";
            document.getElementById("player-2").style.color = "#FFFFFF";
        }

        replayCount ++;
        
    }

    var ready = 0;
    var turn = 0;
    var replayCount = 0;
    var p1Health = 1000;
    var p2Health = 1000;
    var p1_Empowers = 0;
    var p1_Defends = 0;
    var p2_Empowers = 0;
    var p2_Defends = 0;

    setBoard();

})();