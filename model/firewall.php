<?php

class firewall
{
	public function gera_random()
	{
		$a = rand(1,11);
		$b = rand(11,20);
		$c = rand(21,30);
		$d = rand(31,40);
		$e = rand(41,50);
		$f = rand(51,60);
		$g = rand(61,70);
		$h = rand(71,80);
		$i = rand(81,90);
		$j = rand(91,100);
		$k = rand(101,110);
		$l = rand(111,120);
		$m = rand(121,130);
		$n = rand(131,140);
		$o = rand(141,150);
		$p = rand(151,160);
		$q = rand(161,170);

		$var_hash = $a.$b.$c.$d.$e.$f.$g.$h.$i.$j.$k.$l.$m.$m.$o.$p.$q;
		return $var_hash;
	}
}

?>