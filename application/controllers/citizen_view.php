<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Citizen_view extends CI_Controller {
	/**
	*/
	public function index(){
	    $this->load->helper('common_helper');
	    $this->load->library('session');
	    $data['session'] = $this->session->all_userdata();
	    $this->load->model('Link');
	    $data['menu'] = $this->Link->fetch_menu();
	    $this->load->view('templates/header', $data);
		$this->load->view('citizen_view/index');
	    $this->load->view('templates/footer');
	}
	public function citizen_list()
	{
		try 
		{
			$sql = "SELECT a.*,
			               concat(a.fname, ' ', a.lname) as full_name,
			               b.description as region,
			               c.description as zone,
			               d.description as woreda,
			               e.description as nationality,
			               IF(sex=0, 'Male', 'Female') as sex
						FROM citizen a
						left join region b on b.id = a.region_id
						left join zone c on c.id = a.zone_id
						left join woreda d on d.id = a.woreda_id
						left join nationality e on e.id = a.nationality 
						order by a.id asc";
			$result = $this->db->query($sql);
			$return_data = $result->result(); 

			$data = array();

			foreach($return_data as $key => $value) 
			{	
				$status = $value->status;
				$status_label = "";
				if($status == "Pending")
					$status_label = "badge bg-label-warning me-1";
				if($status == "Approved")
					$status_label = "badge bg-label-success me-1";
				if($status == "Denied")
					$status_label = "badge bg-label-danger me-1";
				$data['data'][] = array(
					'id'         => $value->id,
					'full_name'  => $value->full_name,
					'username'   => $value->username,
					'age'        => $value->age,
					'sex'        => $value->sex,
					'phone_no'   => $value->phone_no,
					'email'      => $value->email,
					'citizen_id'      => $value->citizen_id,
					'region'     => $value->region,
					'zone'       => $value->zone,
					'woreda'     => $value->woreda,
					'kebele'     => $value->kebele,
					'nationality'  => $value->nationality,
					'status'       => $status,
					'status_label'  => $status_label,
					'profile_pic' => base_url() . $value->profile_pic
				);
			}
            
			$data['success'] = true;
			die(json_encode($data));
		} 
		catch (Exception $e) 
		{

		}
	}
	public function citizen_approve()
	{
		try 
		{
			$id = $_POST['id'];
			$leading = "";
			if($id > 10 && $id < 100)
				$leading = "00";
			elseif ($id > 100) {
				$leading = "0";
			}
			else {
				$leading = "000";
			}
			$citizen_id = "ETH/" . $leading . $id . "/15";

			$sql = "UPDATE  citizen SET status = 'Approved', citizen_id='$citizen_id'where id = $id";
			$result = $this->db->query($sql); 

			$data = array();  
			$data['data'] = "Citizen Approved Sucessfully";
			$data['success'] = true;
			die(json_encode($data));
		} 
		catch (Exception $e) 
		{

		}
	}
	public function citizen_deny()
	{
		try 
		{
			$id = $_POST['id'];
			$sql = "UPDATE  citizen SET status = 'Denied' where id = $id";
			$result = $this->db->query($sql); 

			$data = array();  
			$data['data'] = "Citizen Denied Sucessfully";
			$data['success'] = true;
			die(json_encode($data));
		} 
		catch (Exception $e) 
		{

		}
	}
	public function exportpdfIDNational()
	{

		try 
		{
			$this->load->library('tcpdf/tcpdf');
			$width = 91;  
            $height = 57; 
            $id = $_POST['id'];

             $sql = "SELECT a.id, 
                      CONCAT(fname,' ', mname, ' ', lname) AS full_name,
                      IF(sex = 0, 'Female','Male') AS sex,
                      a.blood_type,
                      a.phone_no,
                      a.email,
                      a.citizen_id,
                      a.profile_pic,
                      e.description as nationality,
                      CONCAT(b.description, ' ', c.description, ' ', d.description, ' ', a.kebele) AS address 
                   FROM `citizen` a
                   LEFT JOIN `region` b ON b.id = a.`region_id`
                   LEFT JOIN zone c ON c.id = a.`zone_id`
                   LEFT JOIN woreda d ON d.`id` = a.`woreda_id`
                   LEFT JOIN nationality e ON e.id = a.`nationality`
                   WHERE a.id = $id and status='Approved'";
			$result = $this->db->query($sql);
			$return_data = $result->result(); 
			if(count($return_data) == 0){
				$arr['success'] = false;
				$arr['data'] = "Citizen not Approved yet. please approve and print id";
				die(json_encode($arr));
			}

			$custom_layout = array($width, $height);
			$pdf = new TCPDF('L', 'mm', $custom_layout, true, 'UTF-8', false);
			//$pdf = new CUSTOMPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
			$fDate = date("Ymd_His"); 
			$filename = "nationalidcard".rand(1000, 100000).".pdf";
 
			// set document information
			$pdf->SetCreator('test@gmail.com');
			$pdf->SetAuthor('Bezawit');
			$pdf->SetTitle('NationalIDCard');
			$pdf->SetSubject('NationalIDCard');
			$pdf->SetKeywords('ID');
			$lg = Array();
            $lg['a_meta_charset'] = 'UTF-8';
            $lg['a_meta_dir'] = 'ltr';
            $lg['a_meta_language'] = 'am';
            $lg['w_page'] = 'page';
            $pdf->setLanguageArray($lg);

			$pdf->SetFont("times", '', 9, '', false);
			$count = 2;

			for($i=0; $i < $count; $i++){


			//set margins
			$pdf->SetPrintHeader(false);
			$pdf->SetPrintFooter(false);
			$pdf->SetAutoPageBreak(false, 0);

			// add a page
			if($i == 1){
				$pdf->AddPage('L');
			}
			else
			   $pdf->AddPage('L');
			

			$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP-40, PDF_MARGIN_RIGHT-35);
            $style = array(
                          'position' => '',
                          'align' => 'C',
                          'stretch' => true,
                          'fitwidth' => true,
                          'cellfitalign' => '',
                          'border' => false,
                          'hpadding' => 'auto',
                          'vpadding' => 'auto',
                          'fgcolor' => array(0,0,0),
                          'bgcolor' => false, //array(255,255,255),
                          'text' => true,
                          'font' => 'helvetica',
                          'fontsize' => 4,
                          'stretchtext' => 4
                      );
            

            $barcode = $return_data[0]->citizen_id;
            $encrypted = base64_encode($barcode);
            if($i == 0) {
            $src = $return_data[0]->profile_pic;

            $pdf->Image('image/id/front.png', 0.1, 0, 117, 57, '', '', '', false, 0, '', false, false, 0,true,false,false);
          
            $nationality = $return_data[0]->nationality;
      if(!file_exists ($src)){
      	$arr['success'] = false;
				$arr['data'] = "Profile Picture not found";
				die(json_encode($arr));
      }
					
			$pdf->Image($src, 4, 18, 25.8, 32, '', '', '', false, 0, '', false, false, 1);
			
			//upper line
			//$pdf->Line(35, 64, 260, 64);
			$pdf->setPageMark();
			$pdf->SetTextColor(0, 0, 0);
			//$pdf->SetFont('times', '', 9);

			$pdf->SetFont('times', 'B', 10,'', false);
			$pdf->SetXY(41, 19.5);
			$pdf->Cell(24, 3, $barcode, 0, $ln=0, 'L', 0, '', 0, false, 'C', 'C');

            $pdf->SetXY(33.5, 28);
            $pdf->SetFont("times", 'B', 10, '', false);
			$pdf->Cell(31.893, 4.816, $return_data[0]->full_name, 0, $ln=0, 'L', 0, '', 0, false, 'C', 'C');
			$pdf->SetXY(33.5, 38);
			$pdf->SetFont("times", 'B', 9, '', false);
			$pdf->Cell(31.893, 4.816, $return_data[0]->address, 0, $ln=0, 'L', 0, '', 0, false, 'C', 'C');
            
            $pdf->SetXY(40, 47);			
			$pdf->SetFont("times", 'B', 10, '', false);
			$pdf->Cell(30, 3, $return_data[0]->sex, 0, $ln=0, 'L', 0, '', 0, false, 'C', 'C');

			$pdf->SetXY(70, 46.4);			
			$pdf->SetFont("times", 'B', 10, '', false);
			$pdf->Cell(30, 3, $return_data[0]->blood_type, 0, $ln=0, 'L', 0, '', 0, false, 'C', 'C');
		

	
		
            $html = "";
			$this->load->library('session');
			$pdf->writeHTML($html, true, false, true, false, '');
			
		   }
		   else {
		   //	$barcode = $data['data'][$i]['barcode'];
           
            	$pdf->Image('image/id/back.png', 0.1, 0, 117, 57, '', '', '', false, 0, '', false, false, 0,true,false,false);
            
		   	
            $pdf->SetTextColor(0, 73, 177);
            $pdf->SetFont('times', '', 12,'', false);
			$pdf->SetXY(6, 52);
			$pdf->Cell(24, 3, "ID: " .$barcode, 0, $ln=0, 'L', 0, '', 0, false, 'C', 'C');
            
            $pdf->SetTextColor(0, 0, 0);
		   	$pdf->SetFont('times', '', 10);
		   	$pdf->SetXY(23, 15.9);
			$pdf->Cell(25, 3, date('Y-m-d'), 0, $ln=0, 'L', 0, '', 0, false, 'C', 'C');
			$pdf->SetXY(23, 22);
			$pdf->Cell(25, 3, date('Y-m-d', strtotime(' + 3 years')), 0, $ln=0, 'L', 0, '', 0, false, 'C', 'C');

		  $html = '';
		  $pdf->writeHTML($html, true, false, true, false, '');
			$pdf->write2DBarcode($encrypted, 'QRCODE,L', 66, 2, 25, 25.3, $style, 'N');
		   }
	    }
			$path = "idcard";
			$pdf->Output("$path/$filename", 'F');

			$response['filename'] =  "$path/$filename";
			die(json_encode($response));
		} 
		catch (Exception $e) 
		{
			print $e->getMessage();
			die();	
		}
	}

}