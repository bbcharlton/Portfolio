// PROTOTYPE
function Dog() {
	console.log("Dog created!");
	this.name = "Spot";
	this.breed = "Schnauzer";
}

Dog.prototype.bark = function() {
	console.log("BARK");
}

var dog = new Dog();

dog.bark();

//CUSTOM EVENTS
var node = document.createElement("null");
var evt = new Event("doneEating");

evt.data = "I'm the data";
node.dispatchEvent("doneEating");

node.addEventListener("doneEating", (e)=> {
	console.log("I'm done eating!");
});

static getInstance() {
	if (!Dog._instance) {
		Dog._instance = new Dog();
		return Dog._instance;
	} else {
		throw "ERROR"
	}
}