<?php 
	
	include('../db_config.php');

	require_once '../PHPExcel/PHPExcel.php';

	// Excel Header

	/*$objPHPExcel = new PHPExcel();
	$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
	$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
	$objPHPExcel->setActiveSheetIndex(0);
	$objPHPExcel->getActiveSheet()->setCellValue('A1', 'Student No');
	$objPHPExcel->getActiveSheet()->setCellValue('B1', 'Student Name');
	$objPHPExcel->getActiveSheet()->setCellValue('C1', 'Gender');*/

	$camp_id = $_GET['id'];
	$sql = "SELECT a.*,p.* FROM school_application a LEFT JOIN student_profile p ON a.student_app_id=p.student_app_id  WHERE a.camp_management_id = '$camp_id'";

	$q1 = mysqli_query($db, $sql);
	$index = 1;
	while($res = mysqli_fetch_assoc($q1)) {
		$no = $index;
		$row = $index + 1;
		$student_name = $res['student_name'];
		$gender = $res['gender'];
		$dob = $res['dob'];
		var_dump($dob);
		/*$objPHPExcel->getActiveSheet()->setCellValue('A'.$row, $no);
		$objPHPExcel->getActiveSheet()->setCellValue('B'.$row, $student_name );
		$objPHPExcel->getActiveSheet()->setCellValue('C'.$row, $gender );*/
		//var_dump($res['student_app_id']);
		
		$index++;
	}

	// $objPHPExcel->getActiveSheet()->setTitle('Cheese1');

	/*header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment;filename="helloworld.xlsx"');
	header('Cache-Control: max-age=0');

	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	$objWriter->save('php://output');*/
?>