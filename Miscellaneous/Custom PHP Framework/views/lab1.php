<?

class Monkey {

	function talkMonkey($input1, $input2, $input3) {

		//If 3rd argument is true
		if ($input3) {
			//Output the 1st argument 2nd argument amount of times
			for ($x = 0; $x < $input2; $x++) {
				echo "$input1 <br>";
			}
		} else { //If 3rd argument is false
			//Ignore the 1st argument and output MONKEY MONKEY MONKEY 2nd argument amount of times
			for ($x = 0; $x < $input2; $x++) { 
				echo "MONKEY MONKEY MONKEY! <br>";
			}
		}

	}
}

$newMonkey = new Monkey();

$newMonkey->talkMonkey("suh dude", 5, true);


//Activity 1.1
//=================================================

//Part 1
class Hello {
	function helloWorld() {
		echo "Hello world! <br>";
	}
}

$newHello = new Hello();

$newHello->helloWorld();


//Part 2
$name = "Bailey";
$age = 21;
$person = array($name, $age, "name"=>$name, "age"=>$age);

echo "My name is name and age is age. <br>";
echo "$name <br>";
echo "$age <br>";
echo '$name <br>';
echo '$age <br>';
echo $person[0];
echo "<br>";
echo $person[1];
echo "<br>";
echo $person['name'];
echo "<br>";
echo $person['age'];
echo "<br>";
$age = null;
echo $age;
echo "<br>";
unset($name);
echo $name;
echo "<br>";

//Part 3
function checkGrades($grade) {
	if($grade >= 90) {
		echo "A <br>";
	} else if($grade >= 80 && $grade < 90) {
		echo "B <br>";
	} else if($grade >= 70 && $grade < 80) {
		echo "C <br>";
	} else if($grade >= 60 && $grade < 70) {
		echo "D <br>";
	} else if($grade < 60) {
		echo "F <br>";
	}
}

checkGrades(94);
checkGrades(54);
checkGrades(89.9);
checkGrades(60.01);
checkGrades(102.1);

//Part 4
$colors = array("Red", "Pink", "Blue", "Baby Blue", "Green", "Lime", "Purple", "Plum", "Black", "Ebony");
$count = count($colors);

for ($x = 0; $x < $count; $x++) { 
	echo "Color $x is $colors[$x] <br>";
}

?>