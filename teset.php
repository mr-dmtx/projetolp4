<form action="#">
	<input type="date" name="data">
	<input type="submit" name="vai" value="vaiu">
</form>
	
<?php 	

		$dataEmp = $_GET['data'];

		if(strtotime($dataEmp) < strtotime(date('Y-m-d'))){
			echo "Data: " . strtotime($dataEmp) ;
		}
		else{
			echo strtotime(date('Y-m-d'));
		}

		/*
		$dataF = $_GET['data'];
		$dateEmp = new DateTime($dataF);
		$dataDev = new DateTime(date('Y-m-d'));

		if($dateEmp < $dataDev) echo "Ta mec";

		else if($dateEmp == $dataDev) echo "É hj";

		else echo "Atrasado";

		$dateDiff = $dateEmp->diff($dataDev);

		echo $dateDiff->days;

		$dataA = date_create('2020-05-24');
		$dataB = date_create(date('Y-m-d'));
		$d = date_diff($dataA, $dataB);
		var_dump($d);
		echo "Se passaram ".$d->days." dias";

		/*for ($i=1; $i <= 5 ; $i++) { 
			echo "$i-)".mt_rand(1,7).",". mt_rand(1,9) . "x" . "10^" . mt_rand(1, 9) . " | " .mt_rand(1,7).",". mt_rand(1,9) . "x" . "10^" . mt_rand(1, 9) . "\n";
		}
*/		/*
		for ($i=0; $i < 5; $i++) { 
			$a = mt_rand(3,25);
			$b = mt_rand(3,25);
			$c = $a * $b;
			echo "SQL = \"INSERT INTO questions(description, answer, answerwrong1, answerwrong2, answerwrong3)"
                    . " VALUES ('Quanto é $a x $b?', '$c', '".mt_rand($c-10, $c+10)."', '".mt_rand($c-16, $c+10)."', '".mt_rand($c-9, $c+20)."')\";\n";
                    echo "stmt.executeUpdate(SQL);\n";
		}

		for ($i=0; $i < 5; $i++) { 
			$a = mt_rand(100,900);
			$b = mt_rand(100,900);
			$c = $a + $b;
			echo "SQL = \"INSERT INTO questions(description, answer, answerwrong1, answerwrong2, answerwrong3)"
                    . " VALUES ('Quanto é $a + $b?', '$c', '".mt_rand($c-20, $c+10)."', '".mt_rand($c-15, $c+10)."', '".mt_rand($c-4, $c+4)."')\";\n";
                    echo "stmt.executeUpdate(SQL);\n";
		}

		for ($i=0; $i < 5; $i++) { 
			$a = mt_rand(100,900);
			$b = mt_rand(100,900);
			$c = $a - $b;
			echo "SQL = \"INSERT INTO questions(description, answer, answerwrong1, answerwrong2, answerwrong3)"
                    . " VALUES ('Quanto é $a - $b?', '$c', '".mt_rand($c-15, $c+15)."', '".mt_rand($c-20, $c+20)."', '".mt_rand($c-5, $c+5)."')\";\n";
                    echo "stmt.executeUpdate(SQL);\n";
		}
*/

 ?>

 