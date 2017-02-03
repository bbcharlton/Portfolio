// Bailey Charlton

window.addEventListener("load", (e)=> {
    console.log("Application started!");
    var myApp = Game.getInstance();
});

class Game {
    constructor() {
        console.log("Game created!");
        this.score = 0;
        this.images = [];
        this.screen = document.querySelector("#canvas");
        this.loadAssets(["background.png", "background-2.png", "apple.png"]);

        Game.over = false;
        Game.score = 0;
        Game.level = 1;
        Game.count = 0;
        Game.miss = 0;
        Game.ctx = this.screen.getContext("2d");
        Game.snd1 = new Audio("bite.mp3");
    }

    init() {
        console.log("Game initialized!");
        this.screen.style.background = "url(" + this.images[0].src + ")";
        GameFactory.images = this.images;
        this.apple =  GameFactory.createObject("Apple");
        this.apple.x = 0;
        this.apple.y = 225;
        this.keyboard = new Keyboard(this.apple);
        this.keyboard.init();
        this.updateAll();
    }

    loadAssets(arr) {
        var counter = 0;
        var that = this;

        (function loadAsset() {
            var img = new Image();

            img.src = "images/" + arr[counter];
            img.addEventListener("load", function(e) {
                that.images.push(img);
                counter++;

                if (counter < arr.length) {
                    loadAsset();
                } else {
                    console.log("Images loaded!");
                    that.init();
                }
            });
        })();
    }

    updateAll() {
        var that = this;
        (function drawFrame(){
            window.requestAnimationFrame(drawFrame);
            Game.ctx.clearRect(0,0,that.screen.width, that.screen.height);
            if (!Game.over) {
                that.apple.update();
            }
        })();
    }

    static getInstance() {
        if(!Game._instance)
        {
            Game._instance = new Game();
            return Game._instance;
        }
        else
        {
            throw "Game singleton already created!";
        }
    }
}

class Sprite {
    constructor(img) {
        this.x = 0;
        this.y = 0;
        this.width = img.width;
        this.height = img.height;
        this.image = img;
        this.ctx = Game.ctx;
    }

    draw() {
        this.ctx.save();
        this.x = this.x % (800 + (this.image.width * .5));
        this.y = this.y % (450 + (this.image.height * .5));
        this.ctx.translate(this.x, this.y);
        this.ctx.drawImage(this.image, -(this.image.width * .5), -(this.image.height* .5));
        this.ctx.restore();

    }
}

class Apple extends Sprite {
    constructor(img) {
        console.log("Apple created!");
        super(img);
        this.speed = 1.2;
    }

    update() {
        this.x += (5 * this.speed);
        this.draw();
    }
}

class Keyboard {
    constructor(obj) {
        this.apple = obj;
    }

    init() {
        var that = this;
        window.addEventListener("keydown", function(e) {
            if (e.keyCode == 32) {
                document.getElementById("canvas").style.background = "url(images/background-2.png)";
                if (that.apple.x >= 240 && that.apple.x <= 560) {
                    that.apple.x = 0;
                    Game.count++;
                    Game.score += 100;
                    Game.snd1.cloneNode().play();
                    document.querySelector("#score").innerHTML = Game.score;
                    if (Game.count == 5) {
                        that.apple.speed += .2;
                        Game.count = 0;
                        Game.level += 1;
                        document.querySelector("#level").innerHTML = Game.level;
                    }
                } else {
                    if (!Game.over) {
                        Game.miss++;
                        document.querySelector("#miss").innerHTML = "MISSES: " + Game.miss;
                    }
                    if (Game.miss == 3) {
                        that.apple.x = 0;
                        that.apple.speed = 0;
                        Game.over = true;
                        document.querySelector("#miss").innerHTML = "GAME OVER!";
                    }
                }
            }
        })

        window.addEventListener("keyup", function(e) {
            if (e.keyCode == 32) {
                document.getElementById("canvas").style.background = "url(images/background.png)";
            }
        })
    }
}