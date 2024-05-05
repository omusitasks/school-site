<?php
/**
 * Created by PhpStorm.
 * User: Kip
 * Date: 7/26/2017
 * Time: 1:46 PM
 */

namespace App\Helpers;

use Carbon\Carbon;
use PDF;
use Illuminate\Support\Facades\DB;
use App\Modules\Workflow\Entities\SerialTracker;
use App\Modules\Workflow\Entities\TrackingNoSerialTracker;

class UtilityHelper
{

    static function getTimeDiffHrs($time1, $time2)
    {
        $t1 = StrToTime($time1);
        $t2 = StrToTime($time2);
        $diff = $t1 - $t2;
        $hours = $diff / (60 * 60);
        return $hours;
    }
static function returnTableNamefromModule($table_name,$module_id){
		if($table_name == ''){
				$table_name = getSingleRecordColValue('modules', array('id' => $module_id), 'table_name');
				$table_name = $table_name;
				
			}
		return $table_name;
	}
    static function is_connected()
    {
        $connected = @fsockopen("www.google.com", 80);
        //website, port  (try 80 or 443)
        if ($connected) {
            $is_conn = true; //action when connected
            // fclose($connected);
        } else {
            $is_conn = false; //action in connection failure
        }
        return $is_conn;
    }
	static function toUpperCase($flat_array){
        $ucase = array();
        foreach ($flat_array as $item) {
			$item = strtolower($item);
            $ucase[] = str_replace('_', ' ', ucwords($item));
        }
        return $ucase;
    }
	 static function number_to_alpha($num,$code)
        {   
            $alphabets = array('', 'A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');

            $division = floor($num / 26);
            $remainder = $num % 26; 

            if($remainder == 0)
            {
                $division = $division - 1;
                $code .= 'Z';
            }
            else
                $code .= $alphabets[$remainder];

            if($division > 26)
                return number_to_alpha($division, $code);   
            else
                $code .= $alphabets[$division];     

            return strrev($code);
        }
   static function getfile_extension($fileName) {
        $fileName_arr = explode('.', $fileName);
        //count taken (if more than one . exist; files like abc.fff.2013.pdf
        $file_ext_count = count($fileName_arr);
        //minus 1 to make the offset correct
        $cnt = $file_ext_count - 1;
        // the variable will have a value pdf as per the sample file name mentioned above.
        $ext = $fileName_arr[$cnt];
        return $ext;
    }
    static function generateTraderNo($table_name){
        $trader_no = mt_rand(1000, 99999);
        //check if it exists 
        $where = array('identification_no'=>$trader_no);
        $check = recordExists($table_name, $where);
        if($check){
            return generateTraderNo($table_name);
        }
        else{
            return $trader_no;
        }
    }
    static function formatMoney($money)
    {
        if ($money == '' || $money == 0) {
            $money = '00';
        }
        return is_numeric($money) ? number_format((round($money)), 2, '.', ',') : round($money);
    }

    static function converter1($date)
    {
        $date = str_replace('/', '-', $date);
        $dateConverted = date('Y-m-d H:i:s', strtotime($date));
        return $dateConverted;
    }

    static function converter2($date)
    {
        $date = date_create($date);
        $dateConverted = date_format($date, "d/m/Y H:i:s");
        return $dateConverted;
    }

    static function converter11($date)
    {
        $date = str_replace('/', '-', $date);
        $dateConverted = date('Y-m-d', strtotime($date));
        return $dateConverted;
    }

    static function converter22($date)
    {
        $date = date_create($date);
        $dateConverted = date_format($date, "d/m/Y");
        return $dateConverted;
    }

    static function json_output($data = array(), $content_type = 'json')
    {

        if ($content_type == 'html') {
            header('Content-Type: text/html; charset=utf-8');
        } else {
            header('Content-type: text/plain');
        }

        $data = utf8ize($data);
        echo json_encode($data);

    }

    static function utf8ize($d)
    {
        if (is_array($d))
            foreach ($d as $k => $v)
                $d[$k] = utf8ize($v);

        else if (is_object($d))
            foreach ($d as $k => $v)
                $d->$k = utf8ize($v);

        else
            return utf8_encode($d);

        return $d;
    }

    static function formatDate($date)
    {
        if ($date == '0000-00-00 00:00:00' || $date == '0000-00-00' || strstr($date, '1970-00') != false || strstr($date, '1970') != false) {
            return '';
        } else {
            return ($date == '' or $date == null) ? '0000-00-00' : date('Y-m-d', strtotime($date));
        }
    }

    static function formatDaterpt($date)
    {
        if ($date == '0000-00-00 00:00:00' || $date == '0000-00-00' || strstr($date, '1970-00') != false || strstr($date, '1970') != false) {
            return '';
        } else {
            return ($date == '' or $date == null) ? '' : date('d-m-Y', strtotime($date));
        }
    }

    static function returnUniqueArray($arr, $key)
    {
        $uniquekeys = array();
        $output = array();
        foreach ($arr as $item) {
            if (!in_array($item[$key], $uniquekeys)) {
                $uniquekeys[] = $item[$key];
                $output[] = $item;
            }
        }
        return $output;
    }

    static function getApplicationInitialStatus($module_id, $sub_module_id)
    {
        $statusDetails = (object)array(
            'status_id' => 0,
            'name' => ''
        );
        $where = array(
            'module_id' => $module_id,
            'sub_module_id' => $sub_module_id
        );
        $results = DB::table('par_application_statuses as t1')
            ->join('par_system_statuses as t2', 't1.status_id', '=', 't2.id')
            ->select('t1.status_id', 't2.name')
            ->where($where)
            ->where('t1.status', 1)
            ->first();

        if (!is_null($results)) {
            $statusDetails = $results;
        }
        return $statusDetails;
    }

    static function getPortalApplicationInitialStatus($module_id, $portal_statustype_id)
    {
        $statusDetails = (object)array(//just a default status
            'status_id' => 1,
            'name' => 'New'
        );
        $where = array(
            'module_id' => $module_id,
            'portal_statustype_id' => $portal_statustype_id
        );
        $results = DB::table('par_portalapps_initialmis_statuses as t1')
            ->join('par_system_statuses as t2', 't1.status_id', '=', 't2.id')
            ->select('t1.status_id', 't2.name')
            ->where($where)
            ->first();
        if (!is_null($results)) {
            $statusDetails = $results;
        }
        return $statusDetails;
    }

    static function generateApplicationCode($sub_module_id, $table_name)
    {
        $last_id = 01;
        $max_details = DB::table($table_name)
            ->select(DB::raw("MAX(id) as last_id"))
            ->first();
        if (!is_null($max_details)) {
            $last_id = $max_details->last_id + 1;
        }
        $application_code = '103'.$sub_module_id . $last_id;
        return $application_code;
    }

    static function generateApplicationRefNumber($application_id, $table_name, $sub_module_id, $reference_type_id, $codes_array, $process_id, $zone_id, $user_id, $module_id, $section_id)
    {
        try {
			if(!validateIsNumeric($reference_type_id )){
				$reference_type_id = 1;
			}
            $year = date('Y');
            $where = array(
                'year' => $year,
                'process_id' => $process_id,
                'reference_type_id' => $reference_type_id,
                'zone_id' => $zone_id
            );

            //get ref id
            if ($module_id == 1) {
                $where_ref = array('sub_module_id' => $sub_module_id, 'section_id' => $section_id);
            } else {
                $where_ref = array('sub_module_id' => $sub_module_id);
            }
            $ref_id = DB::table('tra_submodule_referenceformats')
                ->where($where_ref)
                ->where('reference_type_id', $reference_type_id)
                ->value('reference_format_id');
                
            if (!is_numeric($ref_id)) {
                $res = array(
                    'success' => false,
                    'message' => 'Application reference format for the sub module not set!!'
                );
                return $res;
            }
            $serial_num_tracker = new SerialTracker();
            $serial_track = $serial_num_tracker->where($where)->first();
            if ($serial_track == '' || is_null($serial_track)) {
                $current_serial_id = 1;
                $serial_num_tracker->year = $year;
                $serial_num_tracker->process_id = $process_id;
                $serial_num_tracker->zone_id = $zone_id;
                $serial_num_tracker->created_by = $user_id;
                $serial_num_tracker->reference_type_id = $reference_type_id;
                $serial_num_tracker->last_serial_no = $current_serial_id;
                $serial_num_tracker->save();
            } else {
                $last_serial_id = $serial_track->last_serial_no;
                $current_serial_id = $last_serial_id + 1;
                $update_data = array(
                    'last_serial_no' => $current_serial_id,
                    'altered_by' => $user_id
                );
                $serial_num_tracker->where($where)->update($update_data);
            }
            $serial_no = str_pad($current_serial_id, 4, 0, STR_PAD_LEFT);
            $reg_year = substr($year, -2);
            $codes_array['serial_no'] = $serial_no;
            $codes_array['reg_year'] = $reg_year;
            $ref_number = self::generateRefNumber($codes_array, $ref_id);
			
			$check_record = DB::table($table_name)
				->where(array('reference_no' => $ref_number))
				->count();
			if($check_record >0 && $ref_number != ''){
				return self::generateApplicationRefNumber($application_id, $table_name, $sub_module_id, $reference_type_id, $codes_array, $process_id, $zone_id, $user_id, $module_id, $section_id);
			}
			else{
				DB::table($table_name)
                ->where('id', $application_id)
                ->update(array('reference_no' => $ref_number, 'refno_generated' => 1));
				//update the referencenos on the invoices and paymetns and submission table 
				$record = DB::table($table_name)
						->where('id', $application_id)
						->first();
				$application_code = $record->application_code;
				DB::table('tra_submissions')
                ->where('application_code', $application_code)
                ->update(array('reference_no' => $ref_number));
				DB::table('tra_payments')
                ->where('application_code', $application_code)
                ->update(array('reference_no' => $ref_number));
				DB::table('tra_application_invoices')
                ->where('application_code', $application_code)
                ->update(array('reference_no' => $ref_number));
				
				
			}
            
                
            $res = array(
                'success' => true,
                'ref_no' => $ref_number
            );
        } catch (\Exception $exception) {
            $res = array(
                'success' => false,
                'message' => $exception->getMessage()
            );
        } catch (\Throwable $throwable) {
            $res = array(
                'success' => false,
                'message' => $throwable->getMessage()
            );
        }
        return $res;
    }

    static function generateApplicationTrackingNumber($sub_module_id, $reference_type_id, $codes_array, $process_id, $zone_id, $user_id, $is_refno)
    {
        try {
			$module_id = getSingleRecordColValue('sub_modules', array('id'=>$sub_module_id), 'module_id');
			$table_name = getSingleRecordColValue('modules', array('id'=>$module_id), 'table_name');
            $year = date('Y');
            $where = array(
                'year' => $year,
                'process_id' => $process_id,
				'reference_type_id'=>$reference_type_id,
                
                'zone_id' => $zone_id
            );
            //get ref id
            $ref_id = DB::table('tra_submodule_referenceformats')
                ->where('sub_module_id', $sub_module_id)
                ->where('reference_type_id', $reference_type_id)
                ->value('reference_format_id');
            if (!is_numeric($ref_id)) {
                $res = array(
                    'success' => false,
                    'message' => 'Application reference format for the sub module not set!!'
                );
                return $res;
            }
            $serial_num_tracker = new TrackingNoSerialTracker();
            $serial_track = $serial_num_tracker->where($where)->first();
            if ($serial_track == '' || is_null($serial_track)) {
                $current_serial_id = 1;
                $serial_num_tracker->year = $year;
                $serial_num_tracker->process_id = $process_id;
                $serial_num_tracker->zone_id = $zone_id;
                $serial_num_tracker->created_by = $user_id;
                $serial_num_tracker->last_serial_no = $current_serial_id;
                $serial_num_tracker->reference_type_id = $reference_type_id;
                $serial_num_tracker->save();
            } else {
                $last_serial_id = $serial_track->last_serial_no;
                $current_serial_id = $last_serial_id + 1;
                $update_data = array(
                    'last_serial_no' => $current_serial_id,
                    'altered_by' => $user_id
                );
                $serial_num_tracker->where($where)->update($update_data);
            }
            $serial_no = str_pad($current_serial_id, 4, 0, STR_PAD_LEFT);
            $reg_year = substr($year, -2);
            $codes_array['serial_no'] = $serial_no;
            $codes_array['reg_year'] = $reg_year;
            $ref_number = self::generateRefNumber($codes_array, $ref_id);
            if ($is_refno == true || $is_refno === true) {
                $tracking_number = $ref_number;
            } else {
                $trac_refcode = Config('constants.trackref_code');
                $tracking_number = str_replace("TMDA", $trac_refcode, $ref_number);
            }
            $res = array(
                'success' => true,
                'tracking_no' => $tracking_number
            );
        } catch (\Exception $exception) {
            $res = array(
                'success' => false,
                'message' => $exception->getMessage()
            );
        } catch (\Throwable $throwable) {
            $res = array(
                'success' => false,
                'message' => $throwable->getMessage()
            );
        }
        return $res;
    }
static function convert_number_to_words($number) {
		   
			$hyphen      = '-';
			$conjunction = ' and ';
			$separator   = ', ';
			$negative    = 'negative ';
			$decimal     = ' point ';
			$dictionary  = array(
				0                   => 'zero',
				1                   => 'one',
				2                   => 'two',
				3                   => 'three',
				4                   => 'four',
				5                   => 'five',
				6                   => 'six',
				7                   => 'seven',
				8                   => 'eight',
				9                   => 'nine',
				10                  => 'ten',
				11                  => 'eleven',
				12                  => 'twelve',
				13                  => 'thirteen',
				14                  => 'fourteen',
				15                  => 'fifteen',
				16                  => 'sixteen',
				17                  => 'seventeen',
				18                  => 'eighteen',
				19                  => 'nineteen',
				20                  => 'twenty',
				30                  => 'thirty',
				40                  => 'fourty',
				50                  => 'fifty',
				60                  => 'sixty',
				70                  => 'seventy',
				80                  => 'eighty',
				90                  => 'ninety',
				100                 => 'hundred',
				1000                => 'thousand',
				1000000             => 'million',
				1000000000          => 'billion',
				1000000000000       => 'trillion',
				1000000000000000    => 'quadrillion',
				1000000000000000000 => 'quintillion'
			);
		   
			if (!is_numeric($number)) {
				return false;
			}
		   
			if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
				// overflow
				trigger_error(
					'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
					E_USER_WARNING
				);
				return false;
			}
		
			if ($number < 0) {
				return $negative . self::convert_number_to_words(abs($number));
			}
		   	
			$string = $fraction = null;
		   
			if (strpos($number, '.') !== false) {
				list($number, $fraction) = explode('.', $number);
			}
		   
			switch (true) {
				case $number < 21:
					$string = $dictionary[$number];
					break;
				case $number < 100:
					$tens   = ((int) ($number / 10)) * 10;
					$units  = $number % 10;
					$string = $dictionary[$tens];
					if ($units) {
						$string .= $hyphen . $dictionary[$units];
					}
					break;
				case $number < 1000:
					$hundreds  = (int)($number / 100);
					$remainder = $number % 100;
					$string = $dictionary[$hundreds] . ' ' . $dictionary[100];
					if ($remainder) {
						$rem=self::convert_number_to_words($remainder);
						$string .= $conjunction . $rem;
					}
					break;
				default:
					$baseUnit = pow(1000, floor(log($number, 1000)));
					$numBaseUnits = (int) ($number / $baseUnit);
					$remainder = $number % $baseUnit;
					$num=self::convert_number_to_words($numBaseUnits);
					$string =  $num. ' ' . $dictionary[$baseUnit];
					if ($remainder) {
						$string .= $remainder < 100 ? $conjunction : $separator;
						$rem=self::convert_number_to_words($remainder);
						$string .= $rem;
					}
					break;
			}
		   
			if (null !== $fraction && is_numeric($fraction)) {
				$string .= $decimal;
				$words = array();
				foreach (str_split((string) $fraction) as $number) {
					$words[] = $dictionary[$number];
				}
				$string .= implode(' ', $words);
			}
		   
			return $string;
		}
    static function generatePremiseRefNumber($ref_id, $codes_array, $year, $process_id, $zone_id, $user_id)
    {
        $where = array(
            'year' => $year,
            'process_id' => $process_id,
			
                'reference_type_id' => 1,
            'zone_id' => $zone_id
        );
        $serial_num_tracker = new SerialTracker();
        $serial_track = $serial_num_tracker->where($where)->first();
        if ($serial_track == '' || is_null($serial_track)) {
            $current_serial_id = 1;
            $serial_num_tracker->year = $year;
            $serial_num_tracker->process_id = $process_id;
            $serial_num_tracker->zone_id = $zone_id;
            $serial_num_tracker->created_by = $user_id;
            $serial_num_tracker->reference_type_id = 1;
            $serial_num_tracker->last_serial_no = $current_serial_id;
            $serial_num_tracker->save();
        } else {
            $last_serial_id = $serial_track->last_serial_no;
            $current_serial_id = $last_serial_id + 1;
            $update_data = array(
                'last_serial_no' => $current_serial_id,
                'altered_by' => $user_id
            );
            $serial_num_tracker->where($where)->update($update_data);
        }
        $serial_no = str_pad($current_serial_id, 4, 0, STR_PAD_LEFT);
        $reg_year = substr($year, -2);
        $codes_array['serial_no'] = $serial_no;
        $codes_array['reg_year'] = $reg_year;
        $ref_number = self::generateRefNumber($codes_array, $ref_id);
        return $ref_number;
    }

    static function generateProductsRefNumber($ref_id, $codes_array, $year, $process_id, $zone_id, $user_id)
    {
        $where = array(
            'year' => $year,
            'process_id' => $process_id,
			
                'reference_type_id' => 1,
            'zone_id' => $zone_id
        );
        $serial_num_tracker = new SerialTracker();
        $serial_track = $serial_num_tracker->where($where)->first();
        if ($serial_track == '' || is_null($serial_track)) {
            $current_serial_id = 1;
            $serial_num_tracker->year = $year;
            $serial_num_tracker->process_id = $process_id;
            $serial_num_tracker->zone_id = $zone_id;
            $serial_num_tracker->created_by = $user_id;
            $serial_num_tracker->last_serial_no = $current_serial_id;
            $serial_num_tracker->reference_type_id = 1;
            $serial_num_tracker->save();
        } else {
            $last_serial_id = $serial_track->last_serial_no;
            $current_serial_id = $last_serial_id + 1;
            $update_data = array(
                'last_serial_no' => $current_serial_id,
                'altered_by' => $user_id
            );
            $serial_num_tracker->where($where)->update($update_data);
        }
        $serial_no = str_pad($current_serial_id, 4, 0, STR_PAD_LEFT);
        $reg_year = substr($year, -2);
        $codes_array['serial_no'] = $serial_no;
        $codes_array['reg_year'] = $reg_year;
        $ref_number = self::generateRefNumber($codes_array, $ref_id);
        return $ref_number;
    }

    static function generateProductsSubRefNumber($reg_product_id, $table_name, $ref_id, $codes_array, $sub_module_id, $user_id)
    {

        $app_counter = DB::table($table_name)
            ->where(array('reg_product_id' => $reg_product_id, 'sub_module_id' => $sub_module_id))
            ->count();
        $serial_no = $app_counter + 1;

        $codes_array['serial_no'] = $serial_no;
        $ref_number = self::generateRefNumber($codes_array, $ref_id);
        return $ref_number;
    }
static function getPermitSignatoryDetails()
    {
        $record = DB::table('authority_directors as t1')
			->leftJoin('users as t2', 't1.director_id', 't2.id')
			->select('t1.*',  DB::raw("concat(decrypt(t2.first_name),' ',decrypt(t2.last_name)) as director"))
            ->where('is_active', 1)
			->first();
        return $record;
    }static function getUserSignatureDetails($usr_id){
		
		$usr_signature = '';
		$record = DB::table('tra_users_signature_uploads as t1')
						->select('t1.*')
						->where(array('t1.user_id'=>$usr_id))
						->first();
		if($record){
			$usr_signature = $record->savedname;
		}
		else{
			
			$usr_signature = 'signature_placeholder.png';
		}
		return $usr_signature;
		
	}
    static function generateApplicationCertificateNumber($application_id, $table_name, $sub_module_id, $reference_type_id, $codes_array, $process_id, $zone_id, $user_id, $module_id, $section_id)
    {
        try {
            $year = date('Y');
            $where = array(
                'year' => $year,
                'process_id' => $process_id,
                'reference_type_id' => $reference_type_id,
                'zone_id' => $zone_id
            );

            //get ref id
            
                $where_ref = array('sub_module_id' => $sub_module_id);
            
            $ref_id = DB::table('tra_submodule_referenceformats')
                ->where($where_ref)
                ->where('reference_type_id', $reference_type_id)
                ->value('reference_format_id');

            if (!is_numeric($ref_id)) {
                $res = array(
                    'success' => false,
                    'message' => 'Application reference format for the sub module not set!!'
                );
                return $res;
            }
            $serial_num_tracker = new SerialTracker();
            $serial_track = $serial_num_tracker->where($where)->first();
            if ($serial_track == '' || is_null($serial_track)) {
                $current_serial_id = 1;
                $serial_num_tracker->year = $year;
                $serial_num_tracker->process_id = $process_id;
                $serial_num_tracker->zone_id = $zone_id;
                $serial_num_tracker->created_by = $user_id;
                $serial_num_tracker->last_serial_no = $current_serial_id;
				 $serial_num_tracker->reference_type_id = $reference_type_id;
                $serial_num_tracker->save();
            } else {
                $last_serial_id = $serial_track->last_serial_no;
                $current_serial_id = $last_serial_id + 1;
                $update_data = array(
                    'last_serial_no' => $current_serial_id,
                    'altered_by' => $user_id
                );
                $serial_num_tracker->where($where)->update($update_data);
            }
			
            $serial_no = str_pad($current_serial_id, 4, 0, STR_PAD_LEFT);
            $reg_year = substr($year, -2);
            $codes_array['serial_no'] = $serial_no;
            $codes_array['reg_year'] = $reg_year;

            $certificate_no = self::generateRefNumber($codes_array, $ref_id);
			
            $res = array(
                'success' => true,
                'certificate_no' => $certificate_no
            );
        } catch (\Exception $exception) {
            $res = array(
                'success' => false,
                'message' => $exception->getMessage()
            );
        } catch (\Throwable $throwable) {
            $res = array(
                'success' => false,
                'message' => $throwable->getMessage()
            );
        }
		$rec = DB::table('tra_approval_recommendations')->where(array('certificate_no'=>$certificate_no))->count();
		if($rec > 0 && $res['success']){
			return  self::generateApplicationCertificateNumber($application_id, $table_name, $sub_module_id, $reference_type_id, $codes_array, $process_id, $zone_id, $user_id, $module_id, $section_id);
		}
		else{
			 return $res;
		}
        
    }

    static function generateRefNumber($codes_array, $ref_id)
    {
        $serial_format = DB::table('refnumbers_formats')
            ->where('id', $ref_id)
            ->value('ref_format');
        $arr = explode("|", $serial_format);
        $serial_variables = $serial_format = DB::table('refnumbers_variables')
            ->select('identifier')
            ->get();
        $serial_variables = convertStdClassObjToArray($serial_variables);
        $serial_variables = convertAssArrayToSimpleArray($serial_variables, 'identifier');
        $ref = '';
        foreach ($arr as $code) {
            if (in_array($code, $serial_variables)) {
                isset($codes_array[$code]) ? $code = $codes_array[$code] : '';
            }
            $ref = $ref . $code;
        }
        return $ref;
    }

    static function unsetArrayData($postData, $unsetData)
    {
        foreach ($unsetData as $unsetDatum) {
            unset($postData[$unsetDatum]);
        }
        return $postData;
    }

    static function formatBytes($size, $precision)
    {
        if ($size > 0) {
            $size = (int)$size;
            $base = log($size) / log(1024);
            $suffixes = array(' bytes', ' KB', ' MB', ' GB', ' TB');
            return round(pow(1024, $base - floor($base)), $precision) . $suffixes[floor($base)];
        } else {
            return $size;
        }
    }

    static function generateInvoiceNo($user_id)
    {
        $registration_year = date("Y");
		$prefix = 101;
        $qry = DB::table('invoice_serials');
        $qry1 = $qry->where('registration_year', $registration_year);
        $last_serial = $qry->value('last_serial');
        if (is_numeric($last_serial) && $last_serial != '') {
            $serial_no = $last_serial + 1;
            $update_params = array(
                'last_serial' => $serial_no,
                'dola' => Carbon::now(),
                'altered_by' => $user_id
            );
            $qry1->update($update_params);
        } else {
            $serial_no = 1;
            $insert_params = array(
                'registration_year' => $registration_year,
                'last_serial' => $serial_no,
                'created_on' => Carbon::now(),
                'created_by' => $user_id
            );
            $qry->insert($insert_params);
        }
        $serial_no = $serial_no = str_pad($serial_no, 4, 0, STR_PAD_LEFT);
        $invoice_no = $prefix.$registration_year . $serial_no;
        return $invoice_no;
    }

    static function generateReceiptNo($user_id)
    {
        $registration_year = date("Y");
        $qry = DB::table('receipt_serials');
        $qry1 = $qry->where('registration_year', $registration_year);
        $last_serial = $qry->value('last_serial');
        if (is_numeric($last_serial) && $last_serial != '') {
            $serial_no = $last_serial + 1;
            $update_params = array(
                'last_serial' => $serial_no,
                'dola' => Carbon::now(),
                'altered_by' => $user_id
            );
            $qry1->update($update_params);
        } else {
            $serial_no = 1;
            $insert_params = array(
                'registration_year' => $registration_year,
                'last_serial' => $serial_no,
                'created_on' => Carbon::now(),
                'created_by' => $user_id
            );
            $qry->insert($insert_params);
        }
        $serial_no = str_pad($serial_no, 4, 0, STR_PAD_LEFT);
        $receipt_no = $registration_year . $serial_no;
        return $receipt_no;
    }

    static function getApplicationPaymentsRunningBalance($application_code, $invoice_id)
    {
        //get invoiced amount
        $qry1 = DB::table('tra_invoice_details as t1')
            ->join('tra_application_invoices as t2', 't1.invoice_id', 't2.id')
            ->select(DB::raw("SUM((t1.total_element_amount*t1.paying_exchange_rate)) as invoiced_amount, SUM(t1.total_element_amount) as total_element_amount,t1.paying_currency_id,t1.paying_exchange_rate"));

        if(validateIsNumeric($application_code)){
            $qry1->where('t2.application_code', $application_code)
                ->groupBy('t2.application_code');
        } if(validateIsNumeric($invoice_id)){
            $qry1->where('t2.id', $invoice_id)
                ->groupBy('t2.id');
        }
        
           
        $results1 = $qry1->first();
        $invoiced_amount = 0;
        $paying_exchange_rate = 0;
        $paying_exchange_rate = 0;
        $paying_currency_id = 0;
        $total_element_amount = 0;
        if (!is_null($results1)) {
            $invoiced_amount = $results1->invoiced_amount;
            $paying_exchange_rate = $results1->paying_exchange_rate;
            $total_element_amount = $results1->total_element_amount;
            $paying_currency_id = $results1->paying_currency_id;
        }
        //get total payments
        $qry2 = DB::table('tra_payments as t2')
            ->select(DB::raw("SUM((t2.amount_paid*t2.exchange_rate)) as paid_amount,exchange_rate,sum(amount_paid) as amount_paid, currency_id "));

        if(validateIsNumeric($application_code)){
            $qry2->where('t2.application_code', $application_code)
                ->groupBy('t2.application_code');
        }
         if(validateIsNumeric($invoice_id)){
            $qry2->where('t2.invoice_id', $invoice_id)
                ->groupBy('t2.invoice_id');
        }
			
        $results2 = $qry2->first();
       
        $amount_paid = 0;
        $paid_amount = 0;
        $currency_id = 0;
        $currency_name = '';
        if ($results2) {
            $paid_amount = $results2->paid_amount;
            $amount_paid = $results2->amount_paid;
            $exchange_rate = $results2->exchange_rate;
            $currency_id = $results2->currency_id;
			if($paying_exchange_rate > $exchange_rate){
				$invoiced_amount = $total_element_amount*$exchange_rate;
			}
        }

		if($paying_currency_id == $currency_id){
			$running_balance =  $total_element_amount-$amount_paid;
		}
		else{
			$running_balance =  $invoiced_amount-$paid_amount;
		}
		//currency 
      
	  
		if(validateIsNumeric($currency_id)){
			$currency_name = getSingleRecordColValue('par_currencies', array('id'=>$currency_id), 'name');
        
		}
		$details = array(
            'invoice_amount' => round($invoiced_amount,2),
            'running_balance' => round($running_balance,2),
            'amount_paid' => round($amount_paid,2),
            'currency_name' => $currency_name,
        );
        return $details;
    }

    static function getPermitSignatory()
    {
        $qry = DB::table('authority_directors')
            ->where('is_active', 1);
        $signatory = $qry->value('director_id');
        return $signatory;
    }

    static function getPermitSignatorySignature()
    {
        $signatory = self::getPermitSignatory();
        $signature = DB::table('tra_users_signature_uploads')
            ->where('user_id', $signatory)
            ->value('savedname');
        return $signature;
    }

    static function generateProductRegistrationNo($zone_id, $section_id, $classification_id, $product_type_id, $device_type_id, $table_name, $user_id, $ref_id)
    {
        //redefine the reference serials to accomodate
        $zone_code = getSingleRecordColValue('par_zones', array('id' => $zone_id), 'zone_code');
        $section_code = getSingleRecordColValue('par_sections', array('id' => $section_id), 'code');
        $class_code = getSingleRecordColValue('par_classifications', array('id' => $classification_id), 'code');
        $prodtype_code = getSingleRecordColValue('par_product_types', array('id' => $product_type_id), 'code');
        $prodtype_code = $section_code . $prodtype_code;
        $registration_year = date('Y');
		
        $reg_year = $registration_year;
        if ($ref_id == 10 || $ref_id == 13) {
            $reg_year = substr($registration_year, -2);
        }
        $where = array(
            'section_id' => $section_id,
            'registration_year' => $registration_year,
            'zone_id' => $zone_id,
            'table_name' => $table_name
        );
        $qry = DB::table('product_registration_serials');
        $qry_where = $qry->where($where);
        $details = $qry->first();
        if (!is_null($details)) {
            $last_serial = $details->last_serial;
            $serial_no = $last_serial + 1;
            $update_params = array(
                'last_serial' => $serial_no,
                'altered_by' => $user_id
            );
            $qry_where->update($update_params);
        } else {
            $last_serial = 0;
            $serial_no = $last_serial + 1;
            $insert_params = array(
                'section_id' => $section_id,
                'table_name' => $table_name,
                'last_serial' => $serial_no,
                'classification_id' => $classification_id,
                'product_type_id' => $product_type_id,
                'device_type_id' => $device_type_id,
                'registration_year' => $registration_year,
                'created_by' => $user_id
            );
            $qry->insert($insert_params);
        }

        $serial_no = str_pad($serial_no, 4, 0, STR_PAD_LEFT);

        $codes_array = array(
            'zone_code' => $zone_code,
            'reg_year' => $reg_year,
            'section_code' => $section_code,
            'prodtype_code' => $prodtype_code,
            'class_code' => $class_code,
            'serial_no' => $serial_no
        );

        $permit_no = self::generateRefNumber($codes_array, $ref_id);
       $rec = DB::table('tra_approval_recommendations')->where(array('certificate_no'=>$permit_no))->count();
		if($rec >0){
			return  self::generateProductRegistrationNo($zone_id, $section_id, $classification_id, $product_type_id, $device_type_id, $table_name, $user_id, $ref_id);
		}
		else{
			 return $permit_no;
		}
    }
	static function funcReportGenerationLog($table_data,$user_id){
				
		insertRecord('registration_certificate_logs', $table_data, $user_id);
	}

    static function generatePremisePermitNo($zone_id, $section_id, $table_name, $user_id, $ref_id,$sub_module_id)
    {
		if(!validateIsNumeric($zone_id)){
			$zone_id = 2;
		}
        $zone_code = getSingleRecordColValue('par_zones', array('id' => $zone_id), 'zone_code');
		if($sub_module_id == 10 || $sub_module_id == 11){
			 $section_code = 'CT';
       
		}
		else{
			 $section_code = getSingleRecordColValue('par_sections', array('id' => $section_id), 'code');
       
		}
        $registration_year = date('y');
        $reg_year = $registration_year;
        if ($ref_id == 10 || $ref_id == 13) {
            $reg_year = substr($registration_year, -2);
        }
        $where = array(
            'section_id' => $section_id,
            'registration_year' => $registration_year,
            'sub_module_id' => $sub_module_id,
            'zone_id' => $zone_id,
            'table_name' => $table_name
        );
        $qry = DB::table('premise_permit_serials');
        $qry_where = $qry->where($where);
        $details = $qry->first();
        if (!is_null($details)) {
            $last_serial = $details->last_serial;
            $serial_no = $last_serial + 1;
            $update_params = array(
                'last_serial' => $serial_no,
                'altered_by' => $user_id
            );
            $qry_where->update($update_params);
        } else {
            $last_serial = 0;
            $serial_no = $last_serial + 1;
            $insert_params = array(
                'section_id' => $section_id,
                'table_name' => $table_name,
                'sub_module_id' => $sub_module_id,
                'last_serial' => $serial_no,
                'zone_id' => $zone_id,
                'registration_year' => $registration_year,
                'created_by' => $user_id
            );
            $qry->insert($insert_params);
        }
        $serial_no = str_pad($serial_no, 4, 0, STR_PAD_LEFT);
        $codes_array = array(
            'zone_code' => $zone_code,
            'reg_year' => $reg_year,
            'section_code' => $section_code,
            'serial_no' => $serial_no
        );
        $permit_no = self::generateRefNumber($codes_array, $ref_id);
		//check the permit number for existence
		if($sub_module_id == 10 || $sub_module_id == 11){
			$where =array('certificate_no'=>$permit_no);
		}
		else{
			$where =array('permit_no'=>$permit_no);
		}
		$rec = DB::table('tra_approval_recommendations')->where($where)->count();
		if($rec >0){
			return  self::generatePremisePermitNo($zone_id, $section_id, $table_name, $user_id, $ref_id,$sub_module_id);
		}
		else{
			 return $permit_no;
		}
    }

    static function updateInTraySubmissions($application_id, $application_code, $from_stage, $user_id)
    {
        try {
			
            $update = array(
                'isRead' => 1,
                'isDone' => 1,
                'date_released' => Carbon::now(),
                'altered_by' => $user_id,
                'released_by' => $user_id,
                'isComplete' => 1
            );
            DB::table('tra_submissions')
                ->where('application_code', $application_code)
                ->where('current_stage', $from_stage)
                ->where('isDone', 0)
                ->update($update);
            $res = array(
                'success' => true,
                'message' => 'Update successful!!'
            );
        } catch (\Exception $exception) {
            $res = array(
                'success' => false,
                'message' => $exception->getMessage()
            );
        } catch (\Throwable $throwable) {
            $res = array(
                'success' => false,
                'message' => $throwable->getMessage()
            );
        }
        return $res;
    }

    static function updateInTraySubmissionsBatch($application_ids, $application_codes, $from_stage, $user_id)
    {
        try {
            $update = array(
                'isRead' => 1,
                'isDone' => 1,
                'date_released' => Carbon::now(),
                'altered_by' => $user_id,
                'released_by' => $user_id,
                'dola' => Carbon::now(),
                'isComplete' => 1
            );

            DB::table('tra_submissions')
                ->whereIn('application_code', $application_codes)
                ->where('current_stage', $from_stage)
                ->where('isDone', 0)
                ->update($update);
            $res = array(
                'success' => true,
                'message' => 'Update successful!!'
            );
        } catch (\Exception $exception) {
            $res = array(
                'success' => false,
                'message' => $exception->getMessage()
            );
        } catch (\Throwable $throwable) {
            $res = array(
                'success' => false,
                'message' => $throwable->getMessage()
            );
        }
        return $res;
    }

    static function updateInTrayReading($application_id, $application_code, $current_stage, $user_id)
    {
        try {
            DB::table('tra_submissions')
                //->where('application_id', $application_id)
                ->where('application_code', $application_code)
                ->where('current_stage', $current_stage)
                //->where('usr_to', $user_id)
                ->update(array('isRead' => 1));
            $res = array(
                'success' => true,
                'message' => 'Update successful!!'
            );
        } catch (\Exception $exception) {
            $res = array(
                'success' => false,
                'message' => $exception->getMessage()
            );
        } catch (\Throwable $throwable) {
            $res = array(
                'success' => false,
                'message' => $throwable->getMessage()
            );
        }
        return $res;
    }

    static function getApplicationTransitionStatus($prev_stage, $action, $next_stage, $static_status)
    {
        if (isset($static_status) && $static_status != '') {
            return $static_status;
        }
        $where = array(
            'stage_id' => $prev_stage,
            'action_id' => $action,
            'nextstage_id' => $next_stage
        );
        $status = DB::table('wf_workflow_transitions')
            ->where($where)
            ->value('application_status_id');
        return $status;
    }

    static function updateApplicationQueryRef($application_id, $application_code, $ref_no, $table_name, $user_id, $module_id, $remark)
    {
        $where = array(
            'application_code' => $application_code
        );
        $counter = DB::table('tra_application_query_reftracker')
            ->where($where)
            ->count();
        if ($counter > 0) {
            $serial_no = $counter + 1;
        } else {
            $serial_no = 1;
        }
        $codes_array = array(
            'ref_no' => $ref_no,
            'serial_no' => $serial_no
        );
        $queryRefNo = self::generateRefNumber($codes_array, 6);
        $insert_params = array(
            'application_id' => $application_id,
            'application_code' => $application_code,
            'query_ref' => $queryRefNo,
            'query_remark' => $remark,
            'table_name' => $table_name,
            'created_on' => Carbon::now(),
            'created_by' => $user_id,
            'queried_on' => Carbon::now(),
            'queried_by' => $user_id,
            'queryref_status_id' => 1
        );
        $query_ref_id = DB::table('tra_application_query_reftracker')
            ->insertGetId($insert_params);

        $portal_table_name = self::getPortalApplicationsTable($module_id);
        $mis_table_name = getSingleRecordColValue('modules', array('id' => $module_id), 'table_name');
        DB::table($mis_table_name)
            ->where('application_code', $application_code)
            ->update(array('last_query_ref_id' => $query_ref_id));
        $portal_db = DB::connection('portal_db');
        $portal_db->table($portal_table_name)
            ->where('application_code', $application_code)
            ->update(array('last_query_ref_id' => $query_ref_id));

        self::insertIntoQueryReferencing($application_code, $query_ref_id, $user_id);
    }

    static function insertIntoQueryReferencing($application_code, $query_ref_id, $user_id)
    {
        $sql = DB::table('checklistitems_responses as t1')
            ->join('checklistitems_queries as t2', 't1.id', '=', 't2.item_resp_id')
            ->select(DB::raw("$query_ref_id as query_ref_id,t2.id as query_id,$user_id as created_by"))
            ->where('t1.application_code', $application_code)
            ->whereIn('t2.status', array(1, 3));

        $queries = $sql->get();
        $queries = convertStdClassObjToArray($queries);
        DB::table('tra_queries_referencing')
            ->insert($queries);
        //unstructured queries
        $sql = DB::table('checklistitems_queries as t2')
            ->select(DB::raw("$query_ref_id as query_ref_id,t2.id as query_id,$user_id as created_by"))
            ->where('t2.application_code', $application_code)
            ->whereIn('t2.status', array(1, 3))
            ->whereNull('item_resp_id');

        $queries = $sql->get();
        $queries = convertStdClassObjToArray($queries);
        DB::table('tra_queries_referencing')
            ->insert($queries);


    }

    //tra_queries_referencing

    static function updateApplicationChecklistsRef($workflow_stage_id, $application_code, $tracking_no, $user_id, $table_name)
    {
        try {
            $where = array(
                'application_code' => $application_code,
                'workflow_stage_id' => $workflow_stage_id
            );
            $counter = DB::table('tra_application_checklists_reftracker')
                ->where($where)
                ->count();
            if ($counter > 0) {
                $serial_no = $counter + 1;
            } else {
                $serial_no = 1;
            }
            $codes_array = array(
                'tracking_no' => $tracking_no,
                'serial_no' => $serial_no
            );
            $checklistRefNo = self::generateRefNumber($codes_array, 29);
            $insert_params = array(
                'application_code' => $application_code,
                'workflow_stage_id' => $workflow_stage_id,
                'checklist_ref' => $checklistRefNo,
                'table_name' => $table_name,
                'created_on' => Carbon::now(),
                'created_by' => $user_id,
                'submission_date' => Carbon::now(),
                'submission_by' => $user_id
            );
            $checklist_ref_id = DB::table('tra_application_checklists_reftracker')
                ->insertGetId($insert_params);
            self::updateChecklistResponsesRef($application_code, $checklist_ref_id);
            $res = array(
                'success' => true,
                'message' => 'Checklist Ref updated successfully!!'
            );
        } catch (\Exception $exception) {
            $res = array(
                'success' => false,
                'message' => $exception->getMessage()
            );
        } catch (\Throwable $throwable) {
            $res = array(
                'success' => false,
                'message' => $throwable->getMessage()
            );
        }
        return $res;
    }

    static function updateChecklistResponsesRef($application_code, $checklist_ref_id)
    {
        DB::table('checklistitems_responses as t1')
            ->where('t1.application_code', $application_code)
            ->where('t1.status', 1)
            ->update(array('checklist_ref_id' => $checklist_ref_id));
    }

    static function inValidateApplicationChecklist($module_id, $sub_module_id, $section_id, $checklist_category, $application_codes)
    {
        $where = array(
            'module_id' => $module_id,
            'sub_module_id' => $sub_module_id,
            'section_id' => $section_id,
            'checklist_category_id' => $checklist_category
        );
        DB::table('checklistitems_responses as t1')
            ->whereIn('application_code', $application_codes)
            ->whereIn('checklist_item_id', function ($query) use ($where) {
                $query->select(DB::raw('t2.id'))
                    ->from('par_checklist_items as t2')
                    ->whereIn('t2.checklist_type_id', function ($query) use ($where) {
                        $query->select(DB::raw('t3.id'))
                            ->from('par_checklist_types as t3')
                            ->where($where);
                    });
            })
            ->update(array('status' => 0));
        if ($module_id == 2) {
            self::invalidatePremiseInspectionDetails($application_codes);
        }
    }

    static function invalidatePremiseInspectionDetails($application_codes)
    {
        DB::table('tra_premiseinspection_applications as t1')
            ->join('tra_premise_inspection_details as t2', 't1.inspection_id', '=', 't2.id')
            ->whereIn('t1.application_code', $application_codes)
            ->update(array('t2.status' => 0));
    }

    static function uploadFile($req, $params, $table_name, $folder, $user_id)
    {
        try {
            $res = array();
            if ($req->hasFile('uploaded_doc')) {
                $file = $req->file('uploaded_doc');
                $origFileName = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $fileSize = $file->getClientSize();
                //$folder = '\resources\uploads';
                $destination = getcwd() . $folder;
                $savedName = str_random(5) . time() . '.' . $extension;
                $file->move($destination, $savedName);
                $params['initial_filename'] = $origFileName;
                $params['savedname'] = $savedName;
                $params['filesize'] = formatBytes($fileSize);
                $params['filetype'] = $extension;
                $params['server_filepath'] = $destination;
                $params['server_folder'] = $folder;
                $params['created_on'] = Carbon::now();
                $params['created_by'] = $user_id;
                $res = insertRecord($table_name, $params, $user_id);
            }
        } catch (\Exception $exception) {
            $res = array(
                'success' => false,
                'message' => $exception->getMessage()
            );
        } catch (\Throwable $throwable) {
            $res = array(
                'success' => false,
                'message' => $throwable->getMessage()
            );
        }
        return $res;
    }

    static function checkForOngoingApplications($registered_id, $table_name, $reg_column, $process_id)
    {
        $qry = DB::table($table_name . ' as t1')
            ->join('wf_workflow_stages as t2', 't1.workflow_stage_id', '=', 't2.id')
            ->where('t1.process_id', $process_id)
            ->where('t1.' . $reg_column, $registered_id)
            ->whereIn('t2.stage_status', array(1, 2));

        $app_details = $qry->first();
        if (is_null($app_details)) {
            $res = array(
                'exists' => false,
                'ref_no' => ''
            );
        } else {
            $res = array(
                'exists' => true,
                'tracking_no' => $app_details->tracking_no,
                'ref_no' => $app_details->reference_no,
            );
        }

        return $res;
    }

    static function checkForProductOngoingApplications($reg_product_id, $table_name, $reg_column, $process_id)
    {
        $qry = DB::table($table_name . ' as t1')
            ->join('wf_workflow_stages as t2', 't1.workflow_stage_id', '=', 't2.id')
            ->where('t1.process_id', $process_id)
            ->where('t1.' . $reg_column, $reg_product_id)
            ->whereIn('t2.stage_status', array(1, 2));

        $app_details = $qry->first();

        //must have an approval
        if (is_null($app_details)) {
            $res = array(
                'exists' => false,
                'ref_no' => ''
            );
        } else {
            $res = array(
                'exists' => true,
                'ref_no' => $app_details->reference_no
            );
        }

        return $res;
    }

    static function getPortalApplicationsTable($module_id)
    {
		$record = DB::table('modules')->where('id',$module_id)->first();
		$portal_table = $record->portaltable_name;
		
		return $portal_table;
		
    }

    static function validateIsNumeric($value)
    {
        if (is_numeric($value) && $value > 0) {
            return true;
        } else {
            return false;
        }

    }

    static function getPermitExpiryDate($approval_date, $duration, $duration_mode)
    {
		
        $approval_date = Carbon::parse($approval_date);
        $expiry_date = Carbon::now();
        if ($duration_mode == 1) {//month
            $expiry_date = $approval_date->addMonths($duration);
        } else if ($duration_mode == 2) {//year
            $expiry_date = $approval_date->addYears($duration);
        }
        return $expiry_date;
    }

    static function getApplicationExpiryDate($approval_date, $sub_module_id, $module_id, $section_id)
    {
        $expiry_date = '';
        $table_name = 'par_registration_expirytime_span as t1';
        $data = DB::table($table_name)
            ->leftJoin('modules as t2', 't1.module_id', '=', 't2.id')
            ->leftJoin('sub_modules as t3', 't1.sub_module_id', '=', 't3.id')
            ->leftJoin('par_sections as t4', 't1.section_id', '=', 't2.id')
            ->leftJoin('par_timespan_defination as t5', 't1.timespan_defination_id', '=', 't5.id')
            ->select('time_span', 't5.name as timespan_defination')
            ->where(array('sub_module_id' => $sub_module_id, 't1.module_id' => $module_id, 'section_id' => $section_id))
            ->first();
        if ($data) {
            $time_span = $data->time_span;
            $timespan_defination = $data->timespan_defination;
            $expiry_date = date('Y-m-d', strtotime($approval_date . " + $time_span  $timespan_defination"));
            $expiry_date = date('Y-m-d', strtotime($expiry_date . ' - 1 days'));
        }
        return $expiry_date;
    }

    static function saveApplicationRegistrationDetails($table_name, $registration_data, $where_statement, $user_id)
    {
        if (recordExists($table_name, $where_statement)) {
            //update
            $prev_data = getPreviousRecords($table_name, $where_statement);

            $res = updateRecord($table_name, $prev_data['results'], $where_statement, $registration_data, $user_id);

        } else {
            //insert
            $res = insertRecord($table_name, $registration_data, $user_id);

        }
        return $res;
    }

    
 static function getProductPrimaryReferenceNo($where_statement, $applications_table){
        $sub_module_id = 7; //primary sub-module
		//check on the registered products 
		$primary_ref ='';
		$reg_product_id = $where_statement['t1.reg_product_id'];
		$record = DB::table('tra_registered_products as t1')
                        ->where(array('id'=>$reg_product_id))
						->first();
		if($record){
			$primary_ref = $record->registration_ref_no;
		}
		if($primary_ref =='' || $primary_ref == null){
				 $primary_ref = DB::table($applications_table.' as t1')
                        ->join('tra_product_information as t2', 't1.product_id','=','t2.id')
                        ->where($where_statement)
                        ->value('reference_no');
		}
       if($primary_ref =='' || $primary_ref == null){
		   $primary_ref = DB::table($applications_table.' as t1')
                        ->join('tra_product_information as t2', 't1.product_id','=','t2.id')
                        ->where(array('reg_product_id'=>$reg_product_id))
                        ->select('reference_no')
						->orderBy('t1.sub_module_id','desc')->first();
			$primary_ref = $primary_ref->reference_no;
	   }
        
        return $primary_ref;
    }
	  static function getTableName($module, $portal_db = 0){

          $qry=DB::table('modules')
                ->where('id',$module)->first();

        if($portal_db){
          $table=$qry->portaltable_name;
        }else{
          $table=$qry->table_name;
        }

        return $table;
   }
	
    static function getPreviousProductRegistrationDetails($where_statement, $applications_table)
    {
        $sub_module_id = 7; //primary sub-module //tra_registered_products t1.product_id
        $data = DB::table($applications_table . ' as t1')
            ->leftJoin('tra_product_information as t2', 't1.tra_product_id', '=', 't2.id')
            ->leftJoin('tra_product_applications as t3', 't2.id', '=', 't3.product_id')
            ->leftJoin('tra_approval_recommendations as t4', function ($join) {
                $join->on("t3.application_code", "=", "t4.application_code")
                    ->on("t3.id", "=", "t4.application_id");
            })
            ->where($where_statement)
            ->select('t4.*','t1.active_application_code','t1.active_app_referenceno', 't1.status_id','t3.sub_module_id', 't1.validity_status_id', 't1.registration_status_id', 't1.prev_product_id as regprev_product_id', 't2.id as prev_product_id')
			->orderBy('t4.expiry_date','desc')
            ->first();

        return $data;
    }
	static function sendQueryNotification($application_code, $module_id){
		$table_name = getSingleRecordColValue('modules', array('id' => $module_id), 'table_name');
				
				$record = DB::table($table_name.' as t1')
							->join('wb_trader_account as t2', 't1.applicant_id','t2.id')
							->select('t1.*','t2.name as applicant_name', 't2.email as applicant_email', 't2.identification_no')
							->where(array('application_code'=>$application_code))
							->first();
				if($record){
					$applicant_email = $record->applicant_email;
					$reference_no = $record->reference_no;
					$tracking_no = $record->tracking_no;
                    $identification_no = $record->identification_no;
                    $module_id = $record->module_id;

					if($reference_no != ''){
						$tracking_no = $tracking_no.' Reference No: '.$reference_no;
					}
							
                    if($module_id == 89){
                         $message_details = "Reference to the Subject, find attached product Query Letter and further login to your portal to respond to the raised queries for the :".$tracking_no;
                        $file_path = public_path('/resources/uploads/Query Letter.pdf');
                        self::generateProductQueryletter($application_code,$file_path);
                      sendMailNotification($record->applicant_name, $application_details->applicant_email,'Query Notification',$message,'','', $file_path,'Query Letter','', array());
                    }
                    else{
                        $vars = array(
                            '{tracking_no}' =>$tracking_no
                        );
                        onlineApplicationNotificationMail(3, $applicant_email, $vars,$identification_no);
                    }
							
				}
		
		
	}
    
    static function returnMessage($results)
    {
        return count(convertStdClassObjToArray($results)) . ' records fetched!!';
    }

    static function returnParamFromArray($dataArray, $dataValue)
    {
        $dataPrint = array_filter($dataArray, function ($var) use ($dataValue) {
            return ($var['id'] == $dataValue);
        });
        $data = array();
        foreach ($dataPrint as $rec) {
            $data = array('name' => $rec['name'],
                'id' => $rec['id']
            );
        }
        if (!empty($data)) {
            return $data['name'];
        } else {
            return '';
        }

    }

    static function funcSaveOnlineImportExportOtherdetails($application_code, $user_id)
    {
		$record = DB::table('tra_permits_products')->where(array('application_code' => $application_code))->count();
		if($record >0){
			DB::table('tra_permits_products')->where(array('application_code' => $application_code))
            ->delete();
		}
        
        $portal_db = DB::connection('portal_db');
        $previous_permitdetails = $portal_db->table('wb_permits_products as t2')
            ->select(DB::raw("prodcertificate_no,country_oforigin_id, product_batch_no,product_expiry_date,product_manufacturing_date,regulated_prodpermit_id, permitbrand_name, permitcommon_name,is_regulated_product,laboratory_no,device_type_id,product_id,quantity,unit_price,currency_id,application_code,packaging_unit_id,product_packaging,total_weight,weights_units_id,product_category_id,id as portal_id, $user_id as created_by, now() as created_on"))
            ->where('application_code', $application_code)
            ->get();

        $previous_permitdetails = convertStdClassObjToArray($previous_permitdetails);
        DB::table('tra_permits_products')
            ->insert($previous_permitdetails);

    }

    static function funcSaveOnlineDisposalOtherdetails($application_code, $user_id)
    {
        DB::table('tra_disposal_products')->where(array('application_code' => $application_code))
            ->delete();

        $portal_db = DB::connection('portal_db');
        $previous_permitdetails = $portal_db->table('wb_disposal_products as t2')
            ->select(DB::raw("application_code,product_id,product_description,quantity,packaging_unit_id,estimated_value,currency_id,id as portal_id, $user_id as created_by, now() as created_on"))
            ->where('application_code', $application_code)
            ->get();

        $previous_permitdetails = convertStdClassObjToArray($previous_permitdetails);
        DB::table('tra_disposal_products')
            ->insert($previous_permitdetails);

    }

    static function funcSaveOnlineMedicalNotificationOtherdetails($portal_product_id, $product_id, $reg_product_id, $user_id)
    {
        $portal_db = DB::connection('portal_db');


        $previous_prodmanufacturers = $portal_db->table('wb_product_manufacturers as t2')
            ->select(DB::raw("$product_id as product_id,man_site_id, manufacturer_id,manufacturer_role_id,manufacturer_status_id,manufacturer_type_id,active_ingredient_id,$user_id as created_by, now() as created_on"))
            ->where('product_id', $portal_product_id)
            ->get();
        $previous_prodmanufacturers = convertStdClassObjToArray($previous_prodmanufacturers);

        DB::table('tra_product_manufacturers')
            ->insert($previous_prodmanufacturers);

    }

    //save details
    static function funcSaveOnlineProductOtherdetails($portal_product_id, $product_id, $reg_product_id, $user_id)
    {
        $portal_db = DB::connection('portal_db');

        $active_ingredient_id = '';

        //packaging
        $where_statement = array('product_id' => $product_id);
        $previous_prodpackaging = $portal_db->table('wb_product_packaging as t2')
            ->select(DB::raw("$product_id as product_id, container_type_id,container_id,container_material_id,closure_material_id,seal_type_id,retail_packaging_size,packaging_units_id,unit_pack,product_unit, $user_id as created_by, now() as created_on,id as portal_id"))
            ->where('product_id', $portal_product_id)
            ->get();
        if (count($previous_prodpackaging) > 0) {
            $previous_prodpackaging = convertStdClassObjToArray($previous_prodpackaging);
            DB::table('tra_product_packaging')->where($where_statement)->delete();

            DB::table('tra_product_packaging')
                ->insert($previous_prodpackaging);
        }

        //nutrients
        $previous_prodnutrients = $portal_db->table('wb_product_nutrients as t2')
            ->select(DB::raw("$product_id as product_id, nutrients_category_id,nutrients_id,units_id,proportion,$user_id as created_by, now() as created_on"))
            ->where('product_id', $portal_product_id)
            ->get();

        if (count($previous_prodnutrients) > 0) {
            $previous_prodnutrients = convertStdClassObjToArray($previous_prodnutrients);
            DB::table('tra_product_nutrients')->where($where_statement)->delete();

            DB::table('tra_product_nutrients')
                ->insert($previous_prodnutrients);


        }
        $previous_prodingredients = $portal_db->table('wb_product_ingredients as t2')
            ->select(DB::raw("$product_id as product_id,t2.id, ingredient_type_id,ingredient_id,specification_type_id,strength,proportion,ingredientssi_unit_id,inclusion_reason_id,acceptance_id, $user_id as created_by, now() as created_on"))
            ->where('product_id', $portal_product_id)
            ->get();

        DB::table('tra_product_ingredients')->where($where_statement)->delete();
        DB::table('tra_product_manufacturers')->where($where_statement)->delete();

        foreach ($previous_prodingredients as $rec) {
            $prevactive_ingredient_id = $rec->id;

            $data = array('product_id' => $product_id,
                'ingredient_type_id' => $rec->ingredient_type_id,
                'ingredient_id' => $rec->ingredient_id,
                'specification_type_id' => $rec->specification_type_id,
                'strength' => $rec->strength,
                'proportion' => $rec->proportion,
                'ingredientssi_unit_id' => $rec->ingredientssi_unit_id,
                'acceptance_id' => $rec->acceptance_id,
                'created_by' => $user_id,
                'created_on' => Carbon::now());

            $active_ingredient_id = DB::table('tra_product_ingredients')
                ->insertGetId($data);

            $previous_prodmanufacturers = $portal_db->table('wb_product_manufacturers as t2')
                ->select(DB::raw("$product_id as product_id,man_site_id, manufacturer_id,manufacturer_role_id,manufacturer_status_id,manufacturer_type_id,$active_ingredient_id as active_ingredient_id,$user_id as created_by, now() as created_on"))
                ->where(array('product_id' => $portal_product_id, 'active_ingredient_id' => $prevactive_ingredient_id, 'manufacturer_type_id' => 2))
                ->get();
            $previous_prodmanufacturers = convertStdClassObjToArray($previous_prodmanufacturers);

            DB::table('tra_product_manufacturers')
                ->insert($previous_prodmanufacturers);

        }

        $previous_prodmanufacturers = $portal_db->table('wb_product_manufacturers as t2')
            ->select(DB::raw("$product_id as product_id,man_site_id, manufacturer_id,manufacturer_role_id,manufacturer_status_id,manufacturer_type_id,$user_id as created_by, now() as created_on"))
            ->where(array('product_id' => $portal_product_id, 'manufacturer_type_id' => 1))
            ->get();
        $previous_prodmanufacturers = convertStdClassObjToArray($previous_prodmanufacturers);
        DB::table('tra_product_manufacturers')
            ->insert($previous_prodmanufacturers);


        $previous_prodgmpinspection = $portal_db->table('wb_product_gmpinspectiondetails as t2')
            ->select(DB::raw("$product_id as product_id,$reg_product_id as reg_product_id,  manufacturing_site_id,reg_site_id,gmp_productline_id,$user_id as created_by, now() as created_on"))
            ->where('product_id', $portal_product_id)
            ->get();

        $previous_prodgmpinspection = convertStdClassObjToArray($previous_prodgmpinspection);
        DB::table('tra_product_gmpinspectiondetails')->where($where_statement)->delete();

        DB::table('tra_product_gmpinspectiondetails')
            ->insert($previous_prodgmpinspection);

        //update tra_uploadedproduct_images
        $data = array('product_id' => $product_id);

        DB::table('tra_uploadedproduct_images')
            ->where(array('portal_product_id' => $portal_product_id))
            ->update($data);

    }

    static function generateApplicationViewID()
    {
        $view_id = 'tfda' . str_random(10) . date('s');
        return $view_id;
    }

    static function getFinancial_year()
    {
        $current_year = date('y');
        //returns year in four digits 2015
        $current_month = date('m');
        //returns year in four digits 15
        $financial_year = '';
        if ($current_month > 6) {
            $financial_year = $current_year . '' . ($current_year + 1);
        } else if ($current_month <= 6) {
            $financial_year = ($current_year - 1) . '' . $current_year;
        }
        return $financial_year;
    }

    static function genLaboratoryReference_number($section_id, $zone_id, $sample_category_id, $laboratory_id, $device_type_id, $user_id,$analysis_type_id)
    {
        $financial_year = self::getFinancial_year();
        $where = array('section_id' => $section_id,
            'sample_category_id' => $sample_category_id,
            'financial_year' => $financial_year,
            'laboratory_id' => $laboratory_id);
	$text = '';
		if($analysis_type_id == 4){
			$text = '-CF';
		}
		else{
			$text = '-SC';
		}
        $serial_no = getSingleRecordColValue('reference_serial_nos', $where, 'serial_number', 'lims_db');


        if ($serial_no > 0) {

            $serial_no = $serial_no + 1;
            DB::connection('lims_db')->table('reference_serial_nos')->where($where)->update(array('serial_number' => $serial_no));


        } else {
            //insert a new record
            $serial_no = 1;
            $where['serial_number'] = $serial_no;

            DB::connection('lims_db')->table('reference_serial_nos')->insert($where);

        }

        $serial_no = sprintf("%04d", $serial_no);

        $section_code = getSingleRecordColValue('sections', array('id' => $section_id), 'section_code', 'lims_db');
        $zone_code = getSingleRecordColValue('zones', array('id' => $zone_id), 'zone_code', 'lims_db');
        $category_code = getSingleRecordColValue('samplecategory', array('id' => $sample_category_id), 'category_code', 'lims_db');
        $laboratory_code = getSingleRecordColValue('laboratory_stations', array('id' => $laboratory_id), 'acryonym', 'lims_db');

        if ($section_id == 4) {
            $device_code = getSingleRecordColValue('medicaldevices_types', array('id' => $device_type_id), 'acronym', 'lims_db');

            $reference_no = "TMDA" . $zone_code . "/" . "L/" . $device_code . $laboratory_code . $category_code.$text. "/" . $financial_year . "/" . $serial_no;

        } else {
            if ($sample_category_id == 18) {

                $reference_no = "TMDA" . $zone_code . "/" . "L/" . $laboratory_code . $category_code.$text . "/R/" . $financial_year . "/" . $serial_no;

            } else {

                $reference_no = "TMDA" . $zone_code . "/" . "L/" . $section_code . "/" . $laboratory_code . $category_code.$text . "/" . $financial_year . "/" . $serial_no;

            }


        }


        if (recordExists('sample_applications', array('reference_no' => $reference_no), 'lims_db')) {
            //return to the save function
            return genReference_number($section_id, $zone_id, $sample_category_id, $laboratory_id = null, $device_type_id, $user_id);
        } else {
            return $reference_no;

        }


    }

    static function getLIMSApplicantRecord($trader_id, $user_id)
    {
        $applicant_id = '';
        $record = DB::connection('lims_db')
            ->table('companies')
            ->where(array('mis_applicant_id' => $trader_id))
            ->first();
        if ($record) {
            $applicant_id = $record->id;
        } else {
            //get the record
            $record = DB::table('wb_trader_account')
                ->where(array('id' => $trader_id))
                ->first();
            if ($record) {
                $data = array('name' => $record->name,
                    'email' => $record->email,
                    'telephone' => $record->telephone_no,
                    'region_id' => $record->region_id,
                    'physical_address' => $record->physical_address,
                    'postal_address' => $record->postal_address,
                    'country_id' => $record->country_id,
                    'mis_applicant_id' => $trader_id,
                    'created_by' => $user_id,
                    'created_on' => Carbon::now());
                $res = insertRecord('companies', $data, $user_id, 'lims_db');
                $applicant_id = $res['record_id'];
            }
        }
        return $applicant_id;
    }
    static function funcSaveProvisionalRejectionDetails($request,$permit_id,$decision_id,$application_id, $application_code,$user_id){
                //check if exists 
                $where = array('application_code'=>$application_code,'permit_id'=>$permit_id);
               $rec = DB::table('tra_apprejprovisional_recommendation')->where($where)->first();
               $data = array('application_id'=>$application_id,
                            'permit_id'=>$permit_id,
                            'decision_id'=>$decision_id,
                            'reason_for_conditionalapproval'=>$request->reason_for_conditionalapproval,
                            'reason_for_rejection'=>$request->reason_for_rejection,
                            'application_code'=>$application_code
                            );
               if($rec){
                    $data['altered_by'] =  $user_id;
                    $data['dola'] =  Carbon::now();;
                    $prev_data = getPreviousRecords('tra_apprejprovisional_recommendation', $where);
                    $res= updateRecord('tra_apprejprovisional_recommendation', $prev_data['results'], $where, $data, $user_id);
               }
               else{
                    $data['created_by'] =  $user_id;
                    $data['created_on'] =  Carbon::now();
                   $res = insertRecord('tra_apprejprovisional_recommendation', $data, $user_id);
               }
               
    }
    public function getSubmissionWorkflowStages(Request $request)
    {
        $process_id = $request->input('process_id');
        try {
            $qry = DB::table('wf_tfdaprocesses as t1')
                ->join('wf_workflows as t2', 't1.workflow_id', '=', 't2.id')
                ->join('wf_workflow_stages as t3', 't2.id', '=', 't3.workflow_id')
                ->select('t3.*')
                ->where('t1.id', $process_id);
            $results = $qry->get();
            $res = array(
                'success' => true,
                'results' => $results,
                'message' => 'All is well'
            );
        } catch (\Exception $exception) {
            $res = array(
                'success' => false,
                'message' => $exception->getMessage()
            );
        } catch (\Throwable $throwable) {
            $res = array(
                'success' => false,
                'message' => $throwable->getMessage()
            );
        }
        return response()->json($res);
    }
    static function getUserScheduledtcmeetingCounter($user_id){
        //add status_id from the meeting statuses
DB::enableQueryLog();
        $data_today = formatDate(Carbon::now());
          $counter =  DB::table('tc_meeting_details as t1')
                    ->join('tc_meeting_participants as t2', 't1.id', 't2.meeting_id')
                    ->where(array('user_id'=>$user_id))
                    ->whereRaw(" date_format(date_requested, '%Y-%m-%d') >= '".$data_today."'")->distinct()
                    ->count('t1.id');

        return $counter;
    }
	static function getDefaultDirectorateDirector($section_id){
		$director_id = '';
		$record = DB::table('tra_directorate_directors as t1')
						->join('par_directorates as t2','t1.directorate_id','t2.id')
						->join('par_sections as t3','t3.directorate_id','t2.id')
						->select('t1.director_id')
						->where(array('t3.id'=>$section_id))
						->first();
		if($record){
			$director_id = $record->director_id;
			
		}
		return $director_id;
		
	}
	 static function getPenaltyCosts($section_id){

        $data = '';
        $record = DB::table('element_costs as t1')
                        ->join('par_cost_sub_categories as t2', 't1.sub_cat_id','t2.id')
                        ->join('par_cost_categories as t3', 't2.cost_category_id','t3.id')
                        ->select(DB::raw("t1.cost,t1.currency_id,t1.id,t3.section_id"))
                        ->where(array('t1.feetype_id'=>3,'t1.formula'=>1))
                        ->first();

        if($record){
            $data = $record;
            
        }
        return $data;

    }
    static function save_renewalsInvoicePenalty($application_code,$invoice_id,$paying_currency_id,$paying_exchange_rate,$user_id){
                $row = DB::table('tra_product_applications')
                                ->select("*")
                                ->where(array('application_code'=>$application_code))
                                ->first();

                if($row){
                    
                        $product_id = $row->product_id;
                        $section_id = $row->section_id;
                        $reg_product_id = $row->reg_product_id;
                        
                        $sub_module_id = $row->sub_module_id;
                        //check if expired 
                        $active_record = DB::table('tra_registered_products')
                                        ->where(array('id'=>$reg_product_id))
                                        ->whereRaw("date_format(expiry_date,'%Y-%m-%d') <  date_format(DATE_SUB(now(), INTERVAL 3 MONTH),'%Y-%m-%d')")
                                        ->first();
                                        if($row){
                        if($active_record  && $sub_module_id == 8){
                                    //get the costs formula
                                    $data = self::getPenaltyCosts($section_id);
                                    if($data){
                                            $cost = $data->cost;
                                            $element_cost_id = $data->id;
                                            $inv_record = DB::table('tra_application_invoices as t1')
                                                        ->join('tra_invoice_details as t2', 't1.id', 't2.invoice_id')
                                                        ->select(DB::raw("SUM(t2.total_element_amount) AS  invoice_amount,t1.paying_exchange_rate as exchange_rate,t1.paying_currency_id as currency_id"))
                                                        ->where(array('t1.id'=>$invoice_id, 't1.application_code'=>$application_code))
                                                        ->first();
                                            if($inv_record){
                                                        //dtaa 
                                                        $invoice_amount = $inv_record->invoice_amount * $cost/100;
                                                        $params = array(
                                                            'invoice_id' => $invoice_id,
                                                            'element_costs_id' => $element_cost_id,
                                                            'element_amount' => $invoice_amount,
                                                            'quantity' => 1,
                                                            'paying_currency_id'=>$inv_record->currency_id,
                                                            'total_element_amount'=>round($invoice_amount, 2),
                                                            'paying_exchange_rate'=>$inv_record->exchange_rate,
                                                            'currency_id' => $inv_record->currency_id,
                                                            'exchange_rate' => $inv_record->exchange_rate,
                                                            'created_by'=>$user_id,
                                                            'created_on'=>Carbon::now()
                                                        );
                                        
                                                        $res = insertRecord('tra_invoice_details', $params, $user_id);
                                            }
                                        
                                            
                                    }
                            
                        }
                    }
                    
                }
                
            
}
	static function saveSingleInvoiceDetailstoIntergration($invoice_id,$application_code,$paying_currency_id,$paying_exchange_rate,$user_id,$zone_id){
            $res = array('success'=>false,'message'=>'Error Occurred');
			//generate the penalty 
			
            
			$where_statement = array('t1.id'=>$invoice_id);
			if(validateIsNumeric($application_code)){
				$where_statement = array('t1.id'=>$invoice_id, 't1.application_code'=>$application_code);
			}
			$invoice_no = getSingleRecordColValue('tra_application_invoices',array('id'=>$invoice_id, 'application_code'=>$application_code), 'invoice_no');
			$check_records = DB::connection('financial_db')
                                    ->table('sys_application_invoices')
									->where(array('invoice_no'=>$invoice_no))
									->get();
				if(!$check_records){
					  self::save_renewalsInvoicePenalty($application_code,$invoice_id,$paying_currency_id,$paying_exchange_rate,$user_id);
				}
            $record = DB::table('tra_application_invoices as t1')
            ->select(DB::raw("t1.invoice_no,t1.tracking_no,t1.reference_no, t1.invoice_amount AS inv_amount,t1.date_of_invoicing, 'System Invoice' as created_by,SUM(t2.total_element_amount) AS  invoice_amount,PayCntrNum,t1.paying_exchange_rate as exchange_rate,t1.paying_currency_id as currency_id,t1.applicant_id,t3.name AS  applicant_name,t1.gepg_submission_status,t3.email as email_address ,t3.telephone_no"))
            ->join('tra_invoice_details as t2', 't1.id','=','t2.invoice_id')
            ->leftJoin('wb_trader_account as t3', 't1.applicant_id','=','t3.id')
            ->where($where_statement)//,'application_code'=>$application_code
            ->groupBy('t1.id')
            ->first();
            if($record){
                    $data = array();
					$reference_no = $record->tracking_no;
					if($reference_no == '' || $reference_no == 0){
						
						$reference_no = $record->reference_no;
					}
                    $table_data = array('invoice_no'=>$record->invoice_no,
                            'invoice_amount'=>$record->invoice_amount,
                            'reference_no'=>$reference_no,
                            'currency_id'=>$record->currency_id,
                            'zone_id'=>$zone_id,
                            'exchange_rate'=>$record->exchange_rate,
                            'applicant_id'=>$record->applicant_id,
                            'applicant_name'=>$record->applicant_name,
                            'gepg_submission_status'=>2,
                            'created_by'=>$user_id,
                            'created_on'=>Carbon::NOW()
                        );
                        DB::connection('financial_db')
                                    ->table('sys_application_invoices')
                                    ->insert($data);
                        
                       $res =  insertRecord('sys_application_invoices', $table_data, $user_id, 'financial_db');
					 
            }
			
            return $res;
   }
   static function validateEmail($email_address){
		$email_address = preg_replace('/\s+/', '', $email_address);
		// Check the formatting is correct
		if(filter_var($email_address, FILTER_VALIDATE_EMAIL) === false){
			$email_address = '';
		}
		return $email_address;
		
    }
    
	static function validatePhoneNo($telephone){
			//remove white spaces
			$telephone = preg_replace('/\s+/', '', $telephone);
			$tel_value = '';
			$telephone = trim($telephone);
			//echo $telephone;
			$firstCharacter = substr($telephone, 0, 1);
			$tel_value = '';
			if($firstCharacter == '0'){
				//check the string size
				if(strlen($telephone) == 10){
					
					$tel_value = $telephone;
				}
				
			}
			else if($firstCharacter == '+'){
				
				$telephone = ltrim ($telephone,'+');
				if(strlen($telephone) == 12){
					
					$tel_value = $telephone;
				}
				
			}
			
			return $tel_value;
		
	}
}