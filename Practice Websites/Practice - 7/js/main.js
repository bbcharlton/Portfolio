(function(){

	//Arrow Functions
	var arrBtn = document.querySelector('#arrBtn');
	var btnClick = 0;
    arrBtn.addEventListener('click', () => {
    	if (btnClick == 0) {
    		arrBtn.innerHTML = "Harder, daddy.";
    		btnClick++;
    	} else if (btnClick == 1) {
    		arrBtn.innerHTML = "CLICK HARDER!"
    		btnClick++;
    	} else {
    		arrBtn.innerHTML = "Ok thanks."
    	}
    });

    //Block Scope
    function fooX() {
    	let x = 2;
    	document.querySelector('#block-num').innerHTML = x;
    	if (x < 100) {
    		let x = 100;
    		document.querySelector('#block-num2').innerHTML = x;
    	}
    	document.querySelector('#block-num3').innerHTML = x;
    }

    fooX();

    //Classes and Inheritance
    class Person {
	  constructor(type, size, mood) {
	    this.type = type;
	    this.size = size;
	    this.mood = mood;
	  }
	};

	Person.prototype.output = function() {
		document.querySelector('#personType').innerHTML = this.type;
		document.querySelector('#personSize').innerHTML = this.size;
		document.querySelector('#personMood').innerHTML = this.mood;
	};

	var clBtn = document.querySelector('#classBtn');

	clBtn.addEventListener('click', () => {
		if (document.querySelector('#in-1').value != '' && document.querySelector('#in-2').value != '' && document.querySelector('#in-3').value != ''){
			var dude = new Person(document.querySelector('#in-1').value, document.querySelector('#in-2').value, document.querySelector('#in-3').value);
			dude.output();
			document.querySelector('#inherit').innerHTML = "You also created an Alien that inherits a person's attributes. It's " + alien.type + ", " + alien.size + ", and " + alien.mood + ".";
		}
	});

	var alien = Object.create(Person);

	alien.type = "weird";
	alien.size = "large";
	alien.mood = "observant";

	//Default Parameters
	var defBtn = document.querySelector('#defBtn');
    defBtn.addEventListener('click', function() {changeColors(defBtn)});

    function changeColors (el, color = '#465775', color2 = '#EEE') {
    	el.style.backgroundColor = color;
    	defBtn.style.color = '#EEE';
    	defBtn.innerHTML = "Woo!";
    	document.querySelector('#default').style.backgroundColor = color2;

    }

    //Destructured Assignment

    var a, b, c, d;

    [a, b, c, d] = ['Dog', 'Cat', 'Fish', 'Monkey'];

    document.querySelector('#animal-a').innerHTML = a;
    document.querySelector('#animal-b').innerHTML = b;
    document.querySelector('#animal-c').innerHTML = c;
    document.querySelector('#animal-d').innerHTML = d;

    //Generators

    var genBtn = document.querySelector('#genBtn');
    genBtn.addEventListener('click', doNum);

    function* numGen(){
  		var index = document.querySelector('#gen-in').value;
 		while(true){
 			yield index++;
 		}
	}

	function doNum() {
		var gen = numGen();
		genBtn.innerHTML = gen.next().value;
	}

	//Promises

	//Rest Parameters

	function restPar(...theArgs) {
		document.querySelector('#rest-count').innerHTML = theArgs.length;
	}

	restPar(1, 5, 3, 5, 7);

	//Spread Operator

	var arr1 = [1,2,3],
 		arr2 = [arr1, [4,5,6]],
 			arr3 = [arr2,[7,8,9]],
 				arr4 = [arr3, [10,11,12]],
 					arr5 = [arr4, [13,14,15]];
	document.querySelector('#spreadResult').innerHTML = arr5;

	//Template Literals

	var tempBtn = document.querySelector('#templateBtn');
    tempBtn.addEventListener('click', updateName);

    function updateName() {
    	if (document.querySelector('#fName').value != "" && document.querySelector('#mName').value != "" && document.querySelector('#lName').value != "") {
    		let first = document.querySelector('#fName').value;
    		let second = document.querySelector('#mName').value;
    		let third = document.querySelector('#lName').value;
    		document.querySelector('#setName').innerHTML = `Your full name is ${first} ${second} ${third}.`;
    	}
    }

})();
