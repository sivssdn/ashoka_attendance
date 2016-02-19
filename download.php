<?php
		date_default_timezone_set("Asia/Kolkata");


		//preparing file name
			
			if(!empty($_POST['eventname']) && $_POST['eventname']!=" ")
			{
				$name=$_POST['eventname']."_".date("Y_m_d").".xlsx";
			}	
			else
			$name=date("Y_m_d").".xlsx"; //date
			
		//for auto download excel file
		header("Content-Type: application/vnd.ms-excel;charset=utf-8");
		header("Content-Disposition: attachment;filename={$name}");
		header('Cache-Control: max-age=0');
		
			
			require_once($_SERVER['DOCUMENT_ROOT'].'/PHPExcel-1.8/PHPExcel-1.8/Classes/PHPExcel/IOFactory.php');
			//$obj=PHPExcel_IOFactory::load("template.xlsx");
			$obj=new PHPExcel();
			$obj->setActiveSheetIndex(0); //set first sheet as active

			//since every even value is name to be filled in first column,
			//this variable will help in deciding which value goes in which column
			$decidecol=1;
			//looping through all post values and writing them in excel
			
			foreach($_POST as $key=>$value)
			{
				//echo $key. "=>" .$value."<br>";

			
			
			
			
			
			if($decidecol%2!=0) //for every second value, NAME
			{
				$row=$obj->getActiveSheet()->getHighestRow();
				$secondcol='B'.$row;
				$obj->getActiveSheet()->setCellValue("{$secondcol}",$value); //for time
			}	
			else //for TIME
			{
				$row=$obj->getActiveSheet()->getHighestRow()+1;
				$firstcol='A'.$row;
				$obj->getActiveSheet()->setCellValue("{$firstcol}",$value); //for name
			}	
			
			$decidecol++;
			}
			$objectWriter=PHPExcel_IOFactory::createWriter($obj,'Excel2007');
			$objectWriter->save("{$name}");
			//to output it to user 
			$objectWriter->save('php://output');

			//echo "done with saving to template.xlsx";
			
			exit;
?>