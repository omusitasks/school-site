<?php
/**
 * Created by PhpStorm.
 * User: Kip
 * Date: 8/2/2017
 * Time: 7:23 PM
 */

namespace App\Helpers;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Carbon\Carbon;

class DbHelper
{
    public static function insertRecordNoTransaction($table_name, $table_data, $user_id, $con = 'mysql')
    {
        $record_id = DB::connection($con)->table($table_name)->insertGetId($table_data);

        $data = serialize($table_data);
        $audit_detail = array(
            'table_name' => $table_name,
            'table_action' => 'insert',
            'record_id' => $record_id,
            'current_tabledata' => $data,
            'ip_address' => self::getIPAddress(),
            'created_by' => $user_id,
            'created_at' => Carbon::now()
        );
      DB::table('api_misaudit_trail')->insert($audit_detail);
        return $record_id;
    }
    public static function updateRecordNoTransaction($con, $table_name, $previous_data, $where_data, $current_data, $user_id)
    {
        try {
            DB::connection($con)->table($table_name)
                ->where($where_data)
                ->update($current_data);
            $record_id = $previous_data[0]['id'];
            $data_previous = serialize($previous_data);
            $data_current = serialize($current_data);
            $audit_detail = array(
                'table_name' => $table_name,
                'table_action' => 'update',
                'record_id' => $record_id,
                'prev_tabledata' => $data_previous,
                'current_tabledata' => $data_current,
                'ip_address' => self::getIPAddress(),
                'created_by' => $user_id,
                'created_at' => Carbon::now()
            );
            DB::table('api_misaudit_trail')->insert($audit_detail);
            $res = array(
                'success' => true,
                'record_id' => $record_id
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

    public static function deleteRecordNoTransaction($table_name, $previous_data, $where_data, $user_id, $con)
    {
        $affectedRows = DB::connection($con)->table($table_name)->where($where_data)->delete();
        if ($affectedRows) {
            $record_id = $previous_data[0]['id'];
            $data_previous = serialize($previous_data);
            $audit_detail = array(
                'table_name' => $table_name,
                'table_action' => 'delete',
                'record_id' => $record_id,
                'prev_tabledata' => $data_previous,
                'ip_address' => self::getIPAddress(),
                'created_by' => $user_id,
                'created_at' => date('Y-m-d H:i:s')
            );
            DB::table('api_misaudit_trail')->insert($audit_detail);
            return true;
        } else {
            return false;
        }
    }

    public static function softDeleteRecordNoTransaction($table_name, $previous_data, $where_data, $user_id)
    {
        $deletion_update = array(
            'is_enabled' => 0
        );
        $affectedRows = DB::table($table_name)->where($where_data)->update($deletion_update);
        if ($affectedRows > 0) {
            $current_data = $previous_data;
            $current_data[0]['is_enabled'] = 0;
            $record_id = $previous_data[0]['id'];
            $data_previous = serialize($previous_data);
            $data_current = serialize($current_data);
            $audit_detail = array(
                'table_name' => $table_name,
                'table_action' => 'softdelete',
                'record_id' => $record_id,
                'prev_tabledata' => $data_previous,
                'current_tabledata' => $data_current,
                'ip_address' => self::getIPAddress(),
                'created_by' => $user_id,
                'created_at' => Carbon::now()
            );
            DB::table('api_misaudit_trail')->insert($audit_detail);
            return true;
        } else {
            return false;
        }
    }

    public static function undoSoftDeletesNoTransaction($table_name, $previous_data, $where_data, $user_id)
    {
        $deletion_update = array(
            'is_enabled' => 1
        );
        $affectedRows = DB::table($table_name)->where($where_data)->update($deletion_update);
        if ($affectedRows > 0) {
            $current_data = $previous_data;
            $current_data[0]['is_enabled'] = 1;
            $record_id = $previous_data[0]['id'];
            $data_previous = serialize($previous_data);
            $data_current = serialize($current_data);
            $audit_detail = array(
                'table_name' => $table_name,
                'table_action' => 'undosoftdelete',
                'record_id' => $record_id,
                'prev_tabledata' => $data_previous,
                'current_tabledata' => $data_current,
                'ip_address' => self::getIPAddress(),
                'created_by' => $user_id,
                'created_at' => Carbon::now()
            );
            DB::table('api_misaudit_trail')->insert($audit_detail);
            return true;
        } else {
            return false;
        }
    }

    static function insertRecord($table_name, $table_data, $user_id, $con)
    {
        $res = array();
        try {

            DB::transaction(function () use ($con, $table_name, $table_data, $user_id, &$res) {

                $res = array(
                    'success' => true,
                    'record_id' => self::insertRecordNoTransaction($table_name, $table_data, $user_id, $con),
                    'message' => 'Data Saved Successfully!!'
                );
            }, 5);
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

    static function insertRecordNoAudit($table_name, $table_data)
    {
        $res = array();
        try {
            DB::transaction(function () use ($table_name, $table_data, &$res) {
                DB::table($table_name)->insert($table_data);
                $res = array(
                    'success' => true,
                    'message' => 'Data Saved Successfully!!'
                );
            }, 5);
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

    static function updateRecord($table_name, $previous_data, $where_data, $current_data, $user_id, $con)
    {
        $res = array();
        try {

            DB::transaction(function () use ($con, $table_name, $previous_data, $where_data, $current_data, $user_id, &$res) {
                $update = self::updateRecordNoTransaction($con, $table_name, $previous_data, $where_data, $current_data, $user_id);
                if ($update['success'] == true) {
                    $res = array(
                        'success' => true,
                        'record_id' => $update['record_id'],
                        'message' => 'Data updated Successfully!!'
                    );
                } else {
                    $res = $update;
                    
                }
            }, 5);
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

    static function deleteRecord($table_name, $previous_data, $where_data, $user_id, $con)
    {
        $res = array();
        try {
            DB::transaction(function () use ($con, $table_name, $previous_data, $where_data, $user_id, &$res) {
                if (self::deleteRecordNoTransaction($table_name, $previous_data, $where_data, $user_id, $con)) {
                    $res = array(
                        'success' => true,
                        'message' => 'Delete request executed successfully!!'
                    );
                } else {
                    $res = array(
                        'success' => false,
                        'message' => 'Zero number of rows affected. No record affected by the delete request!!'
                    );
                }
            }, 5);
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

    static function softDeleteRecord($table_name, $previous_data, $where_data, $user_id)
    {
        $res = array();
        try {
            DB::transaction(function () use ($table_name, $previous_data, $where_data, $user_id, &$res) {
                if (self::softDeleteRecordNoTransaction($table_name, $previous_data, $where_data, $user_id)) {
                    $res = array(
                        'success' => true,
                        'message' => 'Delete request executed successfully!!'
                    );
                } else {
                    $res = array(
                        'success' => false,
                        'message' => 'Zero number of rows affected. No record affected by the delete request!!'
                    );
                }
            }, 5);
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

    static function undoSoftDeletes($table_name, $previous_data, $where_data, $user_id)
    {
        $res = array();

        try {
            DB::transaction(function () use ($table_name, $previous_data, $where_data, $user_id, &$res) {
                if (self::undoSoftDeletesNoTransaction($table_name, $previous_data, $where_data, $user_id)) {
                    $res = array(
                        'success' => true,
                        'message' => 'Delete request executed successfully!!'
                    );
                } else {
                    $res = array(
                        'success' => false,
                        'message' => 'Zero number of rows affected. No record affected by the delete request!!'
                    );
                }
            }, 5);
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

    static function deleteRecordNoAudit($table_name, $where_data)
    {
        $res = array();
        try {
            DB::transaction(function () use ($table_name, $where_data, &$res) {
                $affectedRows = DB::table($table_name)->where($where_data)->delete();
                if ($affectedRows) {
                    $res = array(
                        'success' => true,
                        'message' => 'Delete request executed successfully!!'
                    );
                } else {
                    $res = array(
                        'success' => false,
                        'message' => 'Zero number of rows affected. No record affected by the delete request!!'
                    );
                }
            }, 5);
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

    static function recordExists($table_name, $where, $con)
    {
        $recordExist = DB::connection($con)->table($table_name)->where($where)->get();
        if ($recordExist && count($recordExist) > 0) {
            return true;
        }
        return false;
    }

    static function getPreviousRecords($table_name, $where, $con)
    {
        try {
            $prev_records = DB::connection($con)->table($table_name)->where($where)->get();
            if ($prev_records && count($prev_records) > 0) {
                $prev_records = self::convertStdClassObjToArray($prev_records);
            }
            $res = array(
                'success' => true,
                'results' => $prev_records,
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
        return $res;
    }

    static function auditTrail($table_name, $table_action, $prev_tabledata, $table_data, $user_id)
    {
        $ip_address = self::getIPAddress();
        switch ($table_action) {
            case "insert":
                //get serialised data $row_array = $sql_query->result_array();
                $data = $table_data;
                $audit_detail = array(
                    'table_name' => $table_name,
                    'table_action' => $table_action,
                    'current_tabledata' => $data,
                    'ip_address' => $ip_address,
                    'created_by' => $user_id,
                    'created_at' => date('Y-m-d H:i:s')
                );
                DB::table('api_misaudit_trail')->insert($audit_detail);
                $res = true;
                break;
            case "update":
                //get serialised data $row_array = $sql_query->result_array();
                $data_previous = serialize($prev_tabledata);
                $data_current = serialize($table_data);
                $audit_detail = array(
                    'table_name' => $table_name,
                    'table_action' => 'update',
                    'prev_tabledata' => $data_previous,
                    'current_tabledata' => $data_current,
                    'ip_address' => $ip_address,
                    'created_by' => $user_id,
                    'created_at' => date('Y-m-d H:i:s')
                );
                DB::table('api_misaudit_trail')->insert($audit_detail);
                $res = true;
                break;
            case "delete":
                //get serialised data $row_array = $sql_query->result_array();
                $data_previous = serialize($prev_tabledata);
                $audit_detail = array(
                    'table_name' => $table_name,
                    'table_action' => 'delete',
                    'prev_tabledata' => $data_previous,
                    'ip_address' => $ip_address,
                    'created_by' => $user_id,
                    'created_at' => date('Y-m-d H:i:s')
                );
                DB::table('api_misaudit_trail')->insert($audit_detail);
                $res = true;
                break;
            default:
                $res = false;
        }
        return $res;
    }

    static function getRecordValFromWhere($table_name, $where, $col)
    {
        try {
            $record = DB::table($table_name)
                ->select($col)
                ->where($where)->get();
            return self::convertStdClassObjToArray($record);
        } catch (QueryException $exception) {
            echo $exception->getMessage();
            return false;
        }
    }

    //without auditing
    static function insertReturnID($table_name, $table_data)
    {
        $insert_id = '';
        DB::transaction(function () use ($table_name, $table_data, &$insert_id) {
            try {
                $insert_id = DB::table($table_name)->insertGetId($table_data);
            } catch (QueryException $exception) {
                echo $exception->getMessage();
                $insert_id = '';
            }
        }, 5);
        return $insert_id;
    }

    static function convertStdClassObjToArray($stdObj)
    {
        return json_decode(json_encode($stdObj), true);
    }

    static function convertAssArrayToSimpleArray($assArray, $targetField)
    {
        $simpleArray = array();
        foreach ($assArray as $key => $array) {
            $simpleArray[] = $array[$targetField];
        }
        return $simpleArray;
    }

    static function getIPAddress()
    {

        if (isset($_SERVER)) {
            if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])) {
                $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
                if (strpos($ip, ",")) {
                    $exp_ip = explode(",", $ip);
                    $ip = $exp_ip[0];
                }
            } else if (isset($_SERVER["HTTP_CLIENT_IP"])) {
                $ip = $_SERVER["HTTP_CLIENT_IP"];
            } else {
                $ip = $_SERVER["REMOTE_ADDR"];
            }
        } else {
            if (getenv('HTTP_X_FORWARDED_FOR')) {
                $ip = getenv('HTTP_X_FORWARDED_FOR');
                if (strpos($ip, ",")) {
                    $exp_ip = explode(",", $ip);
                    $ip = $exp_ip[0];
                }
            } else if (getenv('HTTP_CLIENT_IP')) {
                $ip = getenv('HTTP_CLIENT_IP');
            } else {
                $ip = getenv('REMOTE_ADDR');
            }
        }
        return $ip;
    }

    static function getUserGroups($user_id)
    {
        $groupsSimpleArray = array();
        if(validateIsNumeric($user_id)){
            $groups = DB::table('tra_user_group')->where('user_id', $user_id)->get();
            $groupsSimpleArray = self::convertStdClassObjToArray($groups);
            $groupsSimpleArray = self::convertAssArrayToSimpleArray($groupsSimpleArray, 'group_id');
            //get acting groups 
            $acting_usergroups = self::getActingGroups($user_id);
            $groupsSimpleArray = array_merge($groupsSimpleArray,$acting_usergroups);
        
        }
      
        return $groupsSimpleArray;
    }
    static function getActingGroups($user_id){
        $date_today = Carbon::now();
        $groups = DB::table('tra_actingposition_management')
                    ->where('user_id', $user_id)
                    ->whereRaw("acting_date_to >= '".formatDate($date_today)."' ")
                    ->get();
                   
                    $groupsSimpleArray = self::convertStdClassObjToArray($groups);
                    $groupsSimpleArray = self::convertAssArrayToSimpleArray($groupsSimpleArray, 'group_id');
            return $groupsSimpleArray;
    }
    static function convertArrayToString($array){
        $string = '';
            if(is_array($array)){
                $string='';
                foreach($array as $row){
                    $string = $row .','.$string;
                }
            }
            return $string;
    }
    static function getAllUsersOnActingGroups($user_id){
        $date_today = Carbon::now();
        //get all users who are acting 
        $actingUsersList = DB::table('tra_actingposition_management as t1')
                        ->join('tra_user_group as t2', 't1.group_id', 't2.group_id')
                        ->where('t2.user_id', $user_id)
                        ->select('t1.user_id')
                        ->get();
        $actingUsersList = self::convertStdClassObjToArray($actingUsersList);
        $actingUsersList = self::convertAssArrayToSimpleArray($actingUsersList, 'user_id');

        $groupUserdetails = DB::table('tra_actingposition_management as t1')
                    ->join('tra_user_group as t2', 't1.group_id', 't2.group_id')
                    ->where('t1.user_id', $user_id)
                    ->select('t2.id as user_id')
                    ->whereRaw("acting_date_to >= '".formatDate($date_today)."' ")
                    ->get();
                   
                    $groupUserdetails = self::convertStdClassObjToArray($groupUserdetails);
                    $groupUserdetails = self::convertAssArrayToSimpleArray($groupUserdetails, 'user_id');
        $all_users =  array_merge($actingUsersList,$groupUserdetails);
    
            return $all_users;
    }
    static function getSuperUserGroupIds()
    {
        $super_groups_obj = DB::table('par_groups')
            ->where('is_super_group', 1)
            ->get();
        $super_groups_ass = self::convertStdClassObjToArray($super_groups_obj);
        $super_groups_simp = self::convertAssArrayToSimpleArray($super_groups_ass, 'id');
        return $super_groups_simp;
    }

    static function belongsToSuperGroup($user_groups)
    {
        $superUserIDs = self::getSuperUserGroupIds();
        $arr_intersect = array_intersect($superUserIDs, $user_groups);
        if (count($arr_intersect) > 0) {
            return true;
        } else {
            return false;
        }
    }

    static function getAssignedProcessStages($user_id, $module_id)
    {
        //get process stages
        $qry1 = DB::table('wf_tfdaprocesses as t1')
            ->join('wf_workflow_stages as t2', 't1.workflow_id', '=', 't2.workflow_id')
            ->select('t2.id as stage_id');
        if (validateIsNumeric($module_id)) {
            $qry1->where('t1.module_id', $module_id);
        }
        $possible_stages = $qry1->get();

        $possible_stages = convertStdClassObjToArray($possible_stages);
        $possible_stages = self::convertAssArrayToSimpleArray($possible_stages, 'stage_id');

        $groups = self::getUserGroups($user_id);
        
        $qry2 = DB::table('wf_stages_groups')
            ->select('stage_id')
            ->whereIn('group_id', $groups);
        $all_assigned_stages = $qry2->get();
        $all_assigned_stages = convertStdClassObjToArray($all_assigned_stages);
        $all_assigned_stages = self::convertAssArrayToSimpleArray($all_assigned_stages, 'stage_id');
        return array_intersect($possible_stages, $all_assigned_stages);
    }

    static function getAssignedProcesses($user_id)
    {
        $user_groups = self::getUserGroups($user_id);
        $isSuperUser = self::belongsToSuperGroup($user_groups);
        if ($isSuperUser === true) {
            //return array();
        }
        //get keys
        $qry = DB::table('tra_processes_permissions as t1')
            ->join('par_menuitems_processes as t2', 't1.process_id', '=', 't2.id')
            ->select(DB::raw('t2.identifier as process_identifier,MAX(t1.accesslevel_id) as accessibility'))
            ->whereIn('t1.group_id', $user_groups)
            ->groupBy('t2.identifier');
        $results = $qry->get();
        $results = self::convertStdClassObjToArray($results);
        $keys = self::convertAssArrayToSimpleArray($results, 'process_identifier');
        //get values
        $qry = DB::table('tra_processes_permissions as t1')
            ->join('par_menuitems_processes as t2', 't1.process_id', '=', 't2.id')
            ->select(DB::raw('t2.identifier as process_identifier,MAX(t1.accesslevel_id) as accessibility'))
            ->whereIn('t1.group_id', $user_groups)
            ->groupBy('t2.identifier');
        $results = $qry->get();
        $results = self::convertStdClassObjToArray($results);
        $values = self::convertAssArrayToSimpleArray($results, 'accessibility');
        $combined = array_combine($keys, $values);
        return $combined;
    }
    static function getUserSystemDashaboard($user_id){
        $system_dashboardview = '';
        if(validateIsNumeric($user_id)){
            $system_dashboard = DB::table('tra_user_group as t1')
            ->join('par_groups as t2', 't1.group_id', 't2.id')
            ->join('par_system_dashboards as t3', 't2.system_dashboard_id', 't3.id')
            ->select('t3.viewtype')
            ->where('user_id', $user_id)->first();
if($system_dashboard){
$system_dashboardview = $system_dashboard->viewtype;
}
        }
      
        return   $system_dashboardview;


    }
    static function getSingleRecord($table, $where,$con)
    {
        $record = DB::connection($con)->table($table)->where($where)->first();
        return $record;
    }

    static function getSingleRecordColValue($table, $where, $col, $con)
    {
        $val = DB::connection($con)->table($table)->where($where)->value($col);
        return $val;
    }

    static function getTableData($table_name, $where,$col)
    {
        $qry = DB::connection($col)->table($table_name)
            ->where($where);
        $results = $qry->first();
        return $results;
    }
	// handler
	 static function sys_error_handler($error, $level, $me, $class_array, $user_id)
    {
        //defaults
            $function = "failed to fetch";
            //class
            if(isset($class_array[5])){
              $class = $class_array[5];
            }else{
              $class = "Failed to fetch";
            }
            //specifics
            if(isset($me[0]['function'])){
              $function = $me[0]['function'];
            }
            if(isset($me[0]['class'])){
              $class = $me[0]['class'];
            }
            $origin = "function-->".$function." class-->".$class;
        //log error
        DB::table('system_error_logs')->insert(['error'=>$error, 'error_level_id'=>$level, 'originated_from_user_id'=>$user_id, 'error_origin'=>$origin]);

        $res = array(
                'success' => false,
                'message' => "An Error occured please contact system admin",
                'error'=>$error
            );
        return $res;
    }

    static function updateRenewalPermitDetails($primary_id, $current_permit_id, $table_name)
    {
        DB::table($table_name)
            ->where('id', $primary_id)
            ->update(array('permit_id' => $current_permit_id));
    }

    static function updatePortalApplicationStatus($mis_application_id, $portal_status_id, $mis_table_name, $portal_table_name)
    {//application_id=mis application_id
        $portal_db = DB::connection('portal_db');
        try {
            $portal_db->beginTransaction();
            $application_code = DB::table($mis_table_name)
                ->where('id', $mis_application_id)
                ->value('application_code');

            $portal_db->table($portal_table_name)
                ->where('application_code', $application_code)
                ->update(array('application_status_id' => $portal_status_id));
            $portal_db->commit();
            //update the submission details 
            self::savePortalApplicationSubmissionDetails($application_code,$portal_table_name);

            $res = array(
                'success' => true,
                'message' => 'Portal status updated successfully!!'
            );
        } catch (\Exception $exception) {
            $portal_db->rollBack();
            $res = array(
                'success' => false,
                'message' => $exception->getMessage()
            );
        } catch (\Throwable $throwable) {
            $portal_db->rollBack();
            $res = array(
                'success' => false,
                'message' => $throwable->getMessage()
            );
        }
        return $res;
    }
    static function  savePortalApplicationSubmissionDetails($application_code,$table_name){
        $portal_db = DB::connection('portal_db');
            $rec = $portal_db->table($table_name.' as t1')
                            ->join('wb_statuses as t2', 't1.application_status_id', '=','t2.id')
                            ->select('t1.*', 't2.status_type_id')
                            ->where('application_code',$application_code)
                            ->first();
            if($rec){
                $process_id = getSingleRecordColValue('wf_tfdaprocesses', array('section_id' => $rec->section_id,'module_id' => $rec->module_id,'sub_module_id' => $rec->sub_module_id,), 'id');
                $data = array('application_code'=>$rec->application_code,
                                'application_id'=>$rec->id,
                                'reference_no'=>$rec->reference_no,
                                'tracking_no'=>$rec->tracking_no,	
                                'process_id'=>$process_id,	
                                'module_id'=>$rec->module_id,
                                'sub_module_id'=>$rec->sub_module_id,
                                'trader_id'=>$rec->trader_id,
                                'status_type_id'=>$rec->status_type_id,
                                'section_id'=>$rec->section_id,
                                'application_status_id'=>$rec->application_status_id,
                                'date_submitted'=>Carbon::now(),
                                'created_on'=>Carbon::now()
                            );
                            if($rec->module_id == 1){
                                $prodclass_category_id = getSingleRecordColValue('wb_product_information', array('id' => $rec->product_id), 'prodclass_category_id');
                                $data['prodclass_category_id'] = $prodclass_category_id;
                            }
                $sub_data = $portal_db->table('wb_onlinesubmissions')->where('application_code',$application_code)->count();
                if($sub_data >0){
                        //update 
                        $portal_db->table('wb_onlinesubmissions')->where('application_code',$application_code)->update($data);
                }
                else{
                        $portal_db->table('wb_onlinesubmissions')->insert($data);
                }
            }


    }
    static function updatePortalApplicationStatusWithCode($application_code, $portal_table_name, $portal_status_id)
    {//application_id=mis application_id
        $portal_db = DB::connection('portal_db');
        try {
            $portal_db->beginTransaction();

            $portal_db->table($portal_table_name)
                ->where('application_code', $application_code)
                ->update(array('application_status_id' => $portal_status_id));
            $portal_db->commit();
            self::savePortalApplicationSubmissionDetails($application_code,$portal_table_name);
            $res = array(
                'success' => true,
                'message' => 'Portal status updated successfully!!'
            );
        } catch (\Exception $exception) {
            $portal_db->rollBack();
            $res = array(
                'success' => false,
                'message' => $exception->getMessage()
            );
        } catch (\Throwable $throwable) {
            $portal_db->rollBack();
            $res = array(
                'success' => false,
                'message' => $throwable->getMessage()
            );
        }
        return $res;
    }

    static function updatePortalParams($portal_table_name, $portal_params, $where)
    {
        $portal_db = DB::connection('portal_db');
        try {
            $portal_db->beginTransaction();
            $portal_db->table($portal_table_name)
                ->where($where)
                ->update($portal_params);
            $portal_db->commit();
            $res = array(
                'success' => true,
                'message' => 'Portal status updated successfully!!'
            );
        } catch (\Exception $exception) {
            $portal_db->rollBack();
            $res = array(
                'success' => false,
                'message' => $exception->getMessage()
            );
        } catch (\Throwable $throwable) {
            $portal_db->rollBack();
            $res = array(
                'success' => false,
                'message' => $throwable->getMessage()
            );
        }
        return $res;
    }

    public static function getParameterItem($table_name, $record_id, $con)
    {
        $record_name = '';
        $rec = DB::connection($con)->table($table_name)->where(array('id' => $record_id))->value('name');
        if ($rec) {
            $record_name = $rec;
        }
        return $record_name;

    }

    static function unsetPrimaryIDsInArray($array)
    {
        foreach ($array as $key => $item) {
            unset($item['id']);
            $array[$key] = $item;
        }
        return $array;
    }

    static function createInitialRegistrationRecord($reg_table, $application_table, $reg_params, $application_id, $reg_column)
    {
        $reg_id = DB::table($reg_table)
            ->insertGetId($reg_params);
        DB::table($application_table)
            ->where('id', $application_id)
            ->update(array($reg_column => $reg_id));
        return $reg_id;
    }

    static function getExchangeRate($currency_id)
    {
        $exchange_rate = DB::table('par_exchange_rates')
            ->where('currency_id', $currency_id)
            ->value('exchange_rate');
        return $exchange_rate;
    }

    static function generatePaymentRefDistribution($invoice_id, $receipt_id, $amount_paid, $paying_currency, $user_id)
    {
        $shared_qry = DB::table('tra_invoice_details as t1')
            ->where('t1.invoice_id', $invoice_id);

        $qry1 = clone $shared_qry;
        $qry1->select(DB::raw("SUM(exchange_rate*total_element_amount) as invoice_amount"));
        $results1 = $qry1->first();
        $invoice_amount = $results1->invoice_amount;

        $qry2 = clone $shared_qry;
        $qry2->select(DB::raw("(exchange_rate*total_element_amount) as element_cost,element_costs_id"));
        $elements = $qry2->get();

        $exchange_rate = self::getExchangeRate($paying_currency);
        $params = array();

        foreach ($elements as $element) {
            $params[] = array(
                'invoice_id' => $invoice_id,
                'receipt_id' => $receipt_id,
                'paid_on' => Carbon::now(),
                'exchange_rate' => $exchange_rate,
                'element_costs_id' => $element->element_costs_id,
                'currency_id' => $paying_currency,
                'amount_paid' => round((($element->element_cost / $invoice_amount) * $amount_paid), 2),
                'created_by' => $user_id
            );
        }
        DB::table('payments_references')->insert($params);
    }

    static function getParameterItems($table_name, $filter, $con)
    {
        $record_name = '';
        $rec = DB::connection($con)
            ->table($table_name);

        if ($filter != '') {
            $rec = $rec->where($filter);
        }
        $rec = $rec->get();

        return convertStdClassObjToArray($rec);
    }

    static function updateDocumentRegulatoryDetails($app_details, $document_types, $decision_id)
    {
        self::updateApplicationRegulationDetails($app_details, $document_types, $decision_id);
        self::updateApplicationConditionDetails($app_details, $document_types, $decision_id);
    }

    static function updateApplicationRegulationDetails($app_details, $document_types, $decision_id)
    {
       
        $module_id = $app_details->module_id;
        $section_id = $app_details->section_id;
        $application_code = $app_details->application_code;
        foreach ($document_types as $document_type) {
            $where = array(
                'document_type' => $document_type,
                'module_id' => $module_id,
                'section_id' => $section_id
            );
            $where_check = array(
                'application_code' => $application_code,
                'document_type' => $document_type
            );
            $qry = DB::table('tra_document_regulation_sections as t1')
                ->select(DB::raw("t1.id as doc_regulation_id"))
                ->where($where)
                ->where('is_active', 1);
            $results = $qry->first();
            if (!is_null($results)) {
                $results = convertStdClassObjToArray($results);
                if (recordExists('tra_application_doc_regulations', $where_check)) {
                    DB::table('tra_application_doc_regulations')
                        ->where($where_check)
                        ->update($results);
                } else {
                    $results['document_type'] = $document_type;
                    $results['application_code'] = $application_code;
                    DB::table('tra_application_doc_regulations')
                        ->insert($results);
                }
            }
        }
    }

    static function updateApplicationConditionDetails($app_details, $document_types, $decision_id)
    {//delete insert
        $module_id = $app_details->module_id;
        $section_id = $app_details->section_id;
        $application_code = $app_details->application_code;
        foreach ($document_types as $document_type) {
            $where = array(
                'document_type' => $document_type,
                'module_id' => $module_id,
                'section_id' => $section_id
            );
            $where_check = array(
                'application_code' => $application_code,
                'document_type' => $document_type
            );
            //Certificate Conditions
            $qry = DB::table('tra_document_certconditions as t1')
                ->select(DB::raw("t1.cert_condition_id as doc_certcondition_id,t1.order_no,t1.document_type,$application_code as application_code"))
                ->where($where);
            $results = $qry->get();
            $results = convertStdClassObjToArray($results);
            DB::table('tra_applicationdoc_certconditions')
                ->where($where_check)
                ->delete();
            DB::table('tra_applicationdoc_certconditions')
                ->insert($results);
            //Registration
            $qry = DB::table('tra_document_regconditions as t1')
                ->select(DB::raw("t1.reg_condition_id as doc_regcondition_id,t1.order_no,t1.document_type,$application_code as application_code"))
                ->where($where);
            $results = $qry->get();
            $results = convertStdClassObjToArray($results);
            DB::table('tra_applicationdoc_regconditions')
                ->where($where_check)
                ->delete();
            DB::table('tra_applicationdoc_regconditions')
                ->insert($results);
        }
    }

    static function getZoneIdFromRegion($region_id)
    {
        $zone_id = DB::table('par_regions as t1')
            ->where('id', $region_id)
            ->value('zone_id');
        if (validateIsNumeric($zone_id)) {
            $return_zone_id = $zone_id;
        } else {
            $return_zone_id = self::getHQZoneId();
        }
        return $return_zone_id;
    }

    static function getHQZoneId()
    {
        $return_zone_id = 2;
        $zone_details = DB::table('par_zones')
            ->where('is_hq', 1)
            ->first();
        if (!is_null($zone_details)) {
            $return_zone_id = $zone_details->id;
        }
        return $return_zone_id;
    }

    static function _withdrawalReasons($application_code)
    {
        $str = '<ol>';
        $qry = DB::table('tra_application_withdrawaldetails as t1')
            ->join('par_withdrawal_categories as t2', 't1.withdrawal_category_id', '=', 't2.id')
            ->select('t1.reason_for_withdrawal', 't2.name')
            ->where('t1.application_code', $application_code);
        $results = $qry->get();
        $remark = '';
        foreach ($results as $result) {
            if ($result->reason_for_withdrawal != '') {
                $remark = '(' . $result->reason_for_withdrawal . ')';
            }
            $str .= '<li>' . $result->name . $remark . '</li>';
        }
        $str .= '</ol>';
        return $str;
    }

    static function saveNotification($source_application_code, $notification_type_id, $from_module_id, $to_module_id, $section_id, $note, $user_id)
    {
        $where_check = array(
            'source_application_code' => $source_application_code,
            'notification_type_id' => $notification_type_id,
            'from_module_id' => $from_module_id,
            'to_module_id' => $to_module_id,
        );
        if (recordExists('tra_notifications', $where_check)) {
            $update_params = array(
                'note' => $note,
                'dola' => Carbon::now(),
                'altered_by' => $user_id
            );
            DB::table('tra_notifications')
                ->where($where_check)
                ->update($update_params);
        } else {
            $insert_params = array(
                'source_application_code' => $source_application_code,
                'notification_type_id' => $notification_type_id,
                'from_module_id' => $from_module_id,
                'to_module_id' => $to_module_id,
                'section_id' => $section_id,
                'note' => $note,
                'notification_date' => Carbon::now(),
                'created_by' => $user_id,
                'status_id' => 1
            );
            DB::table('tra_notifications')->insert($insert_params);
        }
    }
 static function getStageQueryChecklistCategory($workflow_stage){
       $qry = DB::table('par_checklist_categories as t1')
                ->Join('tra_proc_applicable_checklists as t2', function ($join) use ($workflow_stage) {
                    $join->on('t2.checklist_category_id', '=', 't1.id')
                        ->on('t2.stage_id', '=', DB::raw($workflow_stage));
                })
                ->select('t2.checklist_category_id');
               
            $results = $qry->first();
        if(!empty($results)){
            $category = $results->checklist_category_id;
            return $category;
        }else{
            return 0;
        }
    }

    static function deleteNotification($source_application_code, $notification_type_id, $from_module_id, $to_module_id)
    {
        $where_check = array(
            'source_application_code' => $source_application_code,
            'notification_type_id' => $notification_type_id,
            'from_module_id' => $from_module_id,
            'to_module_id' => $to_module_id
        );
        DB::table('tra_notifications')
            ->where($where_check)
            ->delete();
    }

static function getLastApplicationSubmissionDetails($application_code) {
       $qry = DB::table('tra_submissions')
                ->where('application_code', $application_code)
                ->orderBy('id', 'DESC');
               
            $results = $qry->first();
          
        if(!empty($results)){
            $res = array('success'=>true, 'results'=> $results);
            return $res;
        }else{
            $res = array('success'=>false, 'results'=> $results);
            return $res; 
        }
    }

}