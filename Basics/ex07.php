<?php
$repeat = "s";

while ($repeat == "s"){
	print "Digite um valor de temperatura em graus Celsius: ";
	$celsius = trim(fgets(STDIN));
	
	$faren = $celsius * 1.8 + 32;
	
	print "O valor em Farenheit щ " . $faren . "АF.\n\n";
	print "Deseja repetir a operaчуo (S/N)?";
	$repeat = trim(fgets(STDIN));	
	}

print "Fim do programa!";