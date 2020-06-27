<?php 

	function defineDate($dateEmp, $dateDev)
	{
		if($dateDev != ""){
			
			if(strtotime($dateDev) == strtotime(date('Y-m-d'))) return 2; //dia de entrega

			else if(strtotime($dateDev) > strtotime(date('Y-m-d'))) return 1; //falta alguns dias

			else if(strtotime($dateDev) < strtotime(date('Y-m-d'))) return 3; //atrasado
		}
		
		else return 4; //sem data de devolucao
		
	}