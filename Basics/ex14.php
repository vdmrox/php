<?php
print "Digite um valor \"a\" (base): ";
$a = trim(fgets(STDIN));
$pot = 1;

print "Digite um valor \"b\" (potência): ";
$b = trim(fgets(STDIN));

for ($i = 1; $i <= $b; $i++){
	
	if ($i != $b){
		$pot = $a * $pot;
		print $a . " x ";	
	}

	else{
		$pot = $a * $pot;
		print $a . " = " . $pot;
	}
}

?>