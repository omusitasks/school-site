<?php

use App\Helpers\SecurityHelper;
use App\Helpers\AuthHelper;
use App\Helpers\UtilityHelper;
use App\Helpers\DbHelper;
use App\Helpers\DMSHelper;
use App\Helpers\ReportsHelper;
use App\Helpers\EmailHelper;

if (!function_exists('aes_encrypt')) {
    function aes_encrypt($value)
    {
        return SecurityHelper::aes_encrypt($value);
    }
}
if (!function_exists('authenticateApiUser')) {
    function authenticateApiUser($username,$password,$request)
    {
        return SecurityHelper::authenticateApiUser($username,$password,$request);
    }
}
if (!function_exists('aes_encryptAll')) {
    function aes_encryptAll($value)
    {
        return SecurityHelper::aes_encryptAll($value);
    }
}

if (!function_exists('aes_decrypt')) {
    function aes_decrypt($value)
    {
        return SecurityHelper::aes_decrypt($value);
    }
}

if (!function_exists('returnTableNamefromModule')) {
    function returnTableNamefromModule($table_name, $module_id)
    {
        return UtilityHelper::returnTableNamefromModule($table_name, $module_id);
    }
}
if (!function_exists('getStageQueryChecklistCategory')) {
    function getStageQueryChecklistCategory($stage_id)
    {
        return DbHelper::getStageQueryChecklistCategory($stage_id);
    }
}if (!function_exists('getLastApplicationSubmissionDetails')) {
    function getLastApplicationSubmissionDetails($application_code)
    {
        return DbHelper::getLastApplicationSubmissionDetails($application_code);
    }
}
if (!function_exists('getParameterItgenems')) {
    function getParameterItems($table_name, $filter, $con = 'mysql')
    {
        return DbHelper::getParameterItems($table_name, $filter, $con);
    }
}
if (!function_exists('saveSingleInvoiceDetailstoIntergration')) {
    function saveSingleInvoiceDetailstoIntergration($invoice_id,$application_code,$paying_currency_id,$paying_exchange_rate,$user_id,$zone_id)
    {
        return UtilityHelper::saveSingleInvoiceDetailstoIntergration($invoice_id,$application_code,$paying_currency_id,$paying_exchange_rate,$user_id,$zone_id);
    }
}

if (!function_exists('generateProductQueryletter')) {
    function generateProductQueryletter($application_code,$file_path = null)
    {
        return UtilityHelper::generateProductQueryletter($application_code,$file_path = null);
    }
}
if (!function_exists('validateEmail')) {
    function validateEmail($email_address)
    {
        return UtilityHelper::validateEmail($email_address);
    }
}
if (!function_exists('validatePhoneNo')) {
    function validatePhoneNo($telephone_no)
    {
        return UtilityHelper::validatePhoneNo($telephone_no);
    }
}

if (!function_exists('sendQueryNotification')) {
    function sendQueryNotification($application_code, $module_id)
    {
        return UtilityHelper::sendQueryNotification($application_code, $module_id);
    }
}

if (!function_exists('encryptArray')) {
    function encryptArray($array, $skipArray)
    {
        return SecurityHelper::encryptArray($array, $skipArray);
    }
}

if (!function_exists('decryptArray')) {
    function decryptArray($array)
    {
        return SecurityHelper::decryptArray($array);
    }
}
//Auth Helpers
if (!function_exists('generateUniqID')) {
    function generateUniqID()
    {
        return AuthHelper::generateUniqID();
    }
}

if (!function_exists('generatePwdSaltOnRegister')) {
    function generatePwdSaltOnRegister($username)
    {
        return AuthHelper::generatePwdSaltOnRegister($username);
    }
}

if (!function_exists('generatePwdSaltOnLogin')) {
    function generatePwdSaltOnLogin($username, $uuid)
    {
        return AuthHelper::generatePwdSaltOnLogin($username, $uuid);
    }
}

if (!function_exists('hashPwdOnRegister')) {
    function hashPwdOnRegister($username, $pwd)
    {
        return AuthHelper::hashPwdOnRegister($username, $pwd);
    }
}

if (!function_exists('hashPwd')) {
    function hashPwd($username, $uuid, $pwd)
    {
        return AuthHelper::hashPwd($username, $uuid, $pwd);
    }
}

if (!function_exists('hashPwdOnLogin')) {
    function hashPwdOnLogin($username, $uuid, $pwd)
    {
        return AuthHelper::hashPwdOnLogin($username, $uuid, $pwd);
    }
}

if (!function_exists('getTimeDiffHrs')) {
    function getTimeDiffHrs($time1, $time2)
    {
        return UtilityHelper::getTimeDiffHrs($time1, $time2);
    }
}
if (!function_exists('getDefaultDirectorateDirector')) {
    function getDefaultDirectorateDirector($section_id)
    {
        return UtilityHelper::getDefaultDirectorateDirector($section_id);
    }
}

if (!function_exists('is_connected')) {
    function is_connected()
    {
        return UtilityHelper::is_connected();
    }
}
if (!function_exists('getfile_extension')) {
    function getfile_extension($fileName)
    {
        return UtilityHelper::getfile_extension($fileName);
    }
}
if (!function_exists('funcSaveProvisionalRejectionDetails')) {
    function funcSaveProvisionalRejectionDetails($request,$permit_id,$decision_id,$application_id, $application_code,$user_id)
    {
        return UtilityHelper::funcSaveProvisionalRejectionDetails($request,$permit_id,$decision_id,$application_id, $application_code,$user_id);
    }
}

if (!function_exists('convertStdClassObjToArray')) {
    function convertStdClassObjToArray($stdObjArray)
    {
        return DbHelper::convertStdClassObjToArray($stdObjArray);
    }
}
if (!function_exists('funcForeignexistValidation')) {
    function funcForeignexistValidation($foreign_key, $record_id, $check_foreigntable)
    {
        return DbHelper::funcForeignexistValidation($foreign_key, $record_id, $check_foreigntable);

    }
}

if (!function_exists('insertRecordNoTransaction')) {
    function insertRecordNoTransaction($table_name, $table_data, $user_id)
    {
        return DbHelper::insertRecordNoTransaction($table_name, $table_data, $user_id);
    }
}

if (!function_exists('insertRecord')) {
    function insertRecord($table_name, $table_data, $user_id= 0, $con = 'mysql')
    {

        return DbHelper::insertRecord($table_name, $table_data, $user_id, $con);
    }
}
if(!function_exists('sendMailNotification')){
	function sendMailNotification($trader_name, $to,$subject,$message,$cc=null,$bcc=null,$attachement=null,$attachement_name = null,$template_id =null, $vars=null) {
		 return EmailHelper::sendMailNotification($trader_name, $to,$subject,$message,$cc,$bcc,$attachement,$attachement_name,$template_id, $vars);
	
	}
}
if(!function_exists('sendMailFromNotification')){
    function sendMailFromNotification($trader_name, $to,$subject,$message,$cc=null,$from){
         return EmailHelper::sendMailFromNotification($trader_name, $to,$subject,$message,$cc,$from);
    
    }
}
if (!function_exists('updateRecord')) {
    function updateRecord($table_name, $previous_data, $where, $table_data, $user_id, $con = 'mysql')
    {
        return DbHelper::updateRecord($table_name, $previous_data, $where, $table_data, $user_id, $con);
    }
}

if (!function_exists('updateRecordNoTransaction')) {
    function updateRecordNoTransaction($table_name, $previous_data, $where, $table_data, $user_id)
    {
        return DbHelper::updateRecordNoTransaction($table_name, $previous_data, $where, $table_data, $user_id);
    }
}

if (!function_exists('deleteRecord')) {
    function deleteRecord($table_name, $previous_data, $where_data, $user_id, $con = 'mysql')
    {
        return DbHelper::deleteRecord($table_name, $previous_data, $where_data, $user_id, $con);
    }
}

if (!function_exists('deleteRecordNoTransaction')) {
    function deleteRecordNoTransaction($table_name, $previous_data, $where_data, $user_id, $con = 'mysql')
    {
        return DbHelper::deleteRecordNoTransaction($table_name, $previous_data, $where_data, $user_id, $con);
    }
}

if (!function_exists('softDeleteRecord')) {
    function softDeleteRecord($table_name, $previous_data, $where_data, $user_id)
    {
        return DbHelper::softDeleteRecord($table_name, $previous_data, $where_data, $user_id);
    }
}

if (!function_exists('softDeleteRecordNoTransaction')) {
    function softDeleteRecordNoTransaction($table_name, $previous_data, $where_data, $user_id)
    {
        return DbHelper::softDeleteRecordNoTransaction($table_name, $previous_data, $where_data, $user_id);
    }
}

if (!function_exists('undoSoftDeletes')) {
    function undoSoftDeletes($table_name, $previous_data, $where_data, $user_id)
    {
        return DbHelper::undoSoftDeletes($table_name, $previous_data, $where_data, $user_id);
    }
}

if (!function_exists('undoSoftDeletesNoTransaction')) {
    function undoSoftDeletesNoTransaction($table_name, $previous_data, $where_data, $user_id)
    {
        return DbHelper::undoSoftDeletesNoTransaction($table_name, $previous_data, $where_data, $user_id);
    }
}

if (!function_exists('deleteRecordNoAudit')) {
    function deleteRecordNoAudit($table_name, $where_data)
    {
        return DbHelper::deleteRecordNoAudit($table_name, $where_data);
    }
}

if (!function_exists('decryptSimpleArray')) {
    function decryptSimpleArray($array)
    {
        return SecurityHelper::decryptSimpleArray($array);
    }
}

if (!function_exists('recordExists')) {
    function recordExists($table_name, $where, $con = 'mysql')
    {
        return DbHelper::recordExists($table_name, $where, $con);
    }
}

if (!function_exists('getPreviousRecords')) {
    function getPreviousRecords($table_name, $where, $con = 'mysql')
    {
        return DbHelper::getPreviousRecords($table_name, $where, $con);
    }
}

if (!function_exists('getRecordValFromWhere')) {
    function getRecordValFromWhere($table_name, $where, $col)
    {
        return DbHelper::getRecordValFromWhere($table_name, $where, $col);
    }
}

if (!function_exists('convertAssArrayToSimpleArray')) {
    function convertAssArrayToSimpleArray($assArray, $targetField)
    {
        return DbHelper::convertAssArrayToSimpleArray($assArray, $targetField);
    }
}

if (!function_exists('getUserGroups')) {
    function getUserGroups($user_id)
    {
        return DbHelper::getUserGroups($user_id);
    }
}

if (!function_exists('getSuperUserGroupIds')) {
    function getSuperUserGroupIds()
    {
        return DbHelper::getSuperUserGroupIds();
    }
}

if (!function_exists('belongsToSuperGroup')) {
    function belongsToSuperGroup($user_groups)
    {
        return DbHelper::belongsToSuperGroup($user_groups);
    }
}

if (!function_exists('insertReturnID')) {
    function insertReturnID($table_name, $table_data)
    {
        return DbHelper::insertReturnID($table_name, $table_data);
    }
}

if (!function_exists('insertRecordNoAudit')) {
    function insertRecordNoAudit($table_name, $table_data)
    {
        return DbHelper::insertRecordNoAudit($table_name, $table_data);
    }
}

if (!function_exists('converter1')) {
    function converter1($date)
    {
        return UtilityHelper::converter1($date);
    }
}

if (!function_exists('converter2')) {
    function converter2($date)
    {
        return UtilityHelper::converter2($date);
    }
}

if (!function_exists('converter11')) {
    function converter11($date)
    {
        return UtilityHelper::converter11($date);
    }
}
if (!function_exists('generateApplicationCertificateNumber')) {
    function generateApplicationCertificateNumber($application_id, $table_name, $sub_module_id, $reference_type_id, $codes_array, $process_id, $zone_id, $user_id, $module_id, $section_id)
    {
        return UtilityHelper::generateApplicationCertificateNumber($application_id, $table_name, $sub_module_id, $reference_type_id, $codes_array, $process_id, $zone_id, $user_id, $module_id, $section_id);

    }
}


if (!function_exists('converter22')) {
    function converter22($date)
    {
        return UtilityHelper::converter22($date);
    }
}

if (!function_exists('getSingleRecord')) {
    function getSingleRecord($table, $where,$col='mysql')
    {
        return DbHelper::getSingleRecord($table, $where,$col);
    }
}

if (!function_exists('getSingleRecordColValue')) {
    function getSingleRecordColValue($table, $where, $col, $con = 'mysql')
    {
        return DbHelper::getSingleRecordColValue($table, $where, $col, $con);
    }
}

if (!function_exists('formatMoney')) {
    function formatMoney($value)
    {
        return UtilityHelper::formatMoney($value);
    }
}

if (!function_exists('dms_createFolder')) {
    function dms_createFolder($parent_folder, $name, $comment, $user_email)
    {
        return DMSHelper::dms_createFolder($parent_folder, $name, $comment, $user_email);

    }
}
if (!function_exists('createDMSParentFolder')) {
    function createDMSParentFolder($parent_folder, $module_id, $name, $comment, $owner)
    {
        return DMSHelper::createDMSParentFolder($parent_folder, $module_id, $name, $comment, $owner);

    }
}

if (!function_exists('utf8ize')) {
    function utf8ize($d)
    {
        return UtilityHelper::utf8ize($d);
    }

}

if (!function_exists('formatDate')) {
    function formatDate($date)
    {
        return UtilityHelper::formatDate($date);
    }
}

if (!function_exists('formatDaterpt')) {
    function formatDaterpt($date)
    {
        return UtilityHelper::formatDaterpt($date);
    }
}


if (!function_exists('returnUniqueArray')) {
    function returnUniqueArray($array, $key)
    {
        return UtilityHelper::returnUniqueArray($array, $key);
    }
}

if (!function_exists('getUserScheduledtcmeetingCounter')) {
    function getUserScheduledtcmeetingCounter($user_id)
    {
        return UtilityHelper::getUserScheduledtcmeetingCounter($user_id);
    }
}

if (!function_exists('getAssignedProcesses')) {
    function getAssignedProcesses($user_id)
    {
        return DbHelper::getAssignedProcesses($user_id);
    }
}
if (!function_exists('getUserSystemDashaboard')) {
    function getUserSystemDashaboard($user_id)
    {
        return DbHelper::getUserSystemDashaboard($user_id);
    }
}

if (!function_exists('generateJasperReport')) {
    function generateJasperReport($input_file_name, $output_filename, $file_type, $params = array())
    {
        $reportsHelper = new ReportsHelper();
        return $reportsHelper->generateJasperReport($input_file_name, $output_filename, $file_type, $params);
    }
}

if (!function_exists('generatePremiseRefNumber')) {
    function generatePremiseRefNumber($ref_id, $codes_array, $year, $process_id, $zone_id, $user_id)
    {
        return UtilityHelper::generatePremiseRefNumber($ref_id, $codes_array, $year, $process_id, $zone_id, $user_id);
    }
}

if (!function_exists('generateApplicationRefNumber')) {
    function generateApplicationRefNumber($application_id, $table_name, $sub_module_id, $reference_type_id, $codes_array, $process_id, $zone_id, $user_id, $module_id = '', $section_id = '')
    {
        return UtilityHelper::generateApplicationRefNumber($application_id, $table_name, $sub_module_id, $reference_type_id, $codes_array, $process_id, $zone_id, $user_id, $module_id, $section_id);
    }
}

if (!function_exists('generateApplicationTrackingNumber')) {
    function generateApplicationTrackingNumber($sub_module_id, $reference_type_id, $codes_array, $process_id, $zone_id, $user_id, $is_refno = false)
    {
        return UtilityHelper::generateApplicationTrackingNumber($sub_module_id, $reference_type_id, $codes_array, $process_id, $zone_id, $user_id, $is_refno);
    }
}

if (!function_exists('generateProductsRefNumber')) {
    function generateProductsRefNumber($ref_id, $codes_array, $year, $process_id, $zone_id, $user_id)
    {
        return UtilityHelper::generateProductsRefNumber($ref_id, $codes_array, $year, $process_id, $zone_id, $user_id);
    }
}

if (!function_exists('unsetArrayData')) {
    function unsetArrayData($postData, $unsetData)
    {
        return UtilityHelper::unsetArrayData($postData, $unsetData);
    }
}

if (!function_exists('formatBytes')) {
    function formatBytes($size, $precision = 2)
    {
        return UtilityHelper::formatBytes($size, $precision);
    }
}

if (!function_exists('generateApplicationCode')) {
    function generateApplicationCode($module_id, $table_name)
    {
        return UtilityHelper::generateApplicationCode($module_id, $table_name);
    }
}

if (!function_exists('getAssignedProcessStages')) {
    function getAssignedProcessStages($user_id, $module_id)
    {
        return DbHelper::getAssignedProcessStages($user_id, $module_id);
    }
}

if (!function_exists('getApplicationInitialStatus')) {
    function getApplicationInitialStatus($module_id, $sub_module_id)
    {
        return UtilityHelper::getApplicationInitialStatus($module_id, $sub_module_id);
    }
}

if (!function_exists('getPortalApplicationInitialStatus')) {
    function getPortalApplicationInitialStatus($module_id, $portal_statustype_id)
    {
        return UtilityHelper::getPortalApplicationInitialStatus($module_id, $portal_statustype_id);
    }
}

if (!function_exists('generateInvoiceNo')) {
    function generateInvoiceNo($user_id)
    {
        return UtilityHelper::generateInvoiceNo($user_id);
    }
}

if (!function_exists('generateReceiptNo')) {
    function generateReceiptNo($user_id)
    {
        return UtilityHelper::generateReceiptNo($user_id);
    }
}

if (!function_exists('getApplicationPaymentsRunningBalance')) {
    function getApplicationPaymentsRunningBalance( $application_code, $invoice_id)
    {
        return UtilityHelper::getApplicationPaymentsRunningBalance( $application_code, $invoice_id);
    }
}if (!function_exists('convert_number_to_words')) {
    function convert_number_to_words($number)
    {
        return UtilityHelper::convert_number_to_words($number);
    }
}


if (!function_exists('getTableData')) {
    function getTableData($table_name, $where,$col='mysql')
    {
        return DbHelper::getTableData($table_name, $where,$col);
    }
}

if (!function_exists('getPermitSignatory')) {
    function getPermitSignatory($options = '')
    {
        return UtilityHelper::getPermitSignatory();
    }
}

if (!function_exists('generatePremisePermitNo')) {
    function generatePremisePermitNo($zone_id, $section_id, $table_name, $user_id, $ref_id,$sub_module_id)
    {
        return UtilityHelper::generatePremisePermitNo($zone_id, $section_id, $table_name, $user_id, $ref_id,$sub_module_id);
    }
}

if (!function_exists('generateProductRegistrationNo')) {
    function generateProductRegistrationNo($zone_id, $section_id, $classification_id, $product_type_id, $device_type_id, $table_name, $user_id, $ref_id)
    {
        return UtilityHelper::generateProductRegistrationNo($zone_id, $section_id, $classification_id, $product_type_id, $device_type_id, $table_name, $user_id, $ref_id);
    }
}
//
if (!function_exists('updateInTrayReading')) {
    function updateInTrayReading($application_id, $application_code, $current_stage, $user_id)
    {
        return UtilityHelper::updateInTrayReading($application_id, $application_code, $current_stage, $user_id);
    }
}

if (!function_exists('updateInTraySubmissions')) {
    function updateInTraySubmissions($application_id, $application_code, $from_stage, $user_id)
    {
        return UtilityHelper::updateInTraySubmissions($application_id, $application_code, $from_stage, $user_id);
    }
}

if (!function_exists('updateInTraySubmissionsBatch')) {
    function updateInTraySubmissionsBatch($application_ids, $application_codes, $from_stage, $user_id)
    {
        return UtilityHelper::updateInTraySubmissionsBatch($application_ids, $application_codes, $from_stage, $user_id);
    }
}

if (!function_exists('getApplicationTransitionStatus')) {
    function getApplicationTransitionStatus($prev_stage, $action, $next_stage, $static_status = '')
    {
        return UtilityHelper::getApplicationTransitionStatus($prev_stage, $action, $next_stage, $static_status);
    }
}

if (!function_exists('getIPAddress')) {
    function getIPAddress()
    {
        return DbHelper::getIPAddress();
    }
}

if (!function_exists('generateRefNumber')) {
    function generateRefNumber($codes_array, $ref_id)
    {
        return UtilityHelper::generateRefNumber($codes_array, $ref_id);
    }
}

if (!function_exists('updateApplicationQueryRef')) {
    function updateApplicationQueryRef($application_id, $application_code, $ref_no, $table_name = '', $user_id, $module_id, $remark = '')
    {
        UtilityHelper::updateApplicationQueryRef($application_id, $application_code, $ref_no, $table_name, $user_id, $module_id, $remark);
    }
}

if (!function_exists('updateApplicationChecklistsRef')) {
    function updateApplicationChecklistsRef($workflow_stage_id, $application_code, $tracking_no, $user_id, $table_name = '')
    {
        return UtilityHelper::updateApplicationChecklistsRef($workflow_stage_id, $application_code, $tracking_no, $user_id, $table_name);
    }
}

if (!function_exists('inValidateApplicationChecklist')) {
    function inValidateApplicationChecklist($module_id, $sub_module_id, $section_id, $checklist_category, $application_codes)
    {
        UtilityHelper::inValidateApplicationChecklist($module_id, $sub_module_id, $section_id, $checklist_category, $application_codes);
    }
}

if (!function_exists('uploadFile')) {
    function uploadFile($req, $params, $table_name, $folder, $user_id)
    {
        return UtilityHelper::uploadFile($req, $params, $table_name, $folder, $user_id);
    }
}
if (!function_exists('validateIsNumeric')) {
    function validateIsNumeric($value)
    {
        return UtilityHelper::validateIsNumeric($value);
    }
}
if (!function_exists('updateRenewalPermitDetails')) {
    function updateRenewalPermitDetails($primary_id, $current_permit_id, $table_name)
    {
        DbHelper::updateRenewalPermitDetails($primary_id, $current_permit_id, $table_name);
    }
}

if (!function_exists('checkForOngoingApplications')) {
    function checkForOngoingApplications($registered_id, $table_name, $reg_column, $process_id)
    {
        return UtilityHelper::checkForOngoingApplications($registered_id, $table_name, $reg_column, $process_id);
    }
}

if (!function_exists('updatePortalApplicationStatus')) {
    function updatePortalApplicationStatus($mis_application_id, $portal_status_id, $mis_table_name, $portal_table_name)
    {
        return DbHelper::updatePortalApplicationStatus($mis_application_id, $portal_status_id, $mis_table_name, $portal_table_name);
    }
}
if (!function_exists('updatePortalApplicationStatusWithCode')) {
    function updatePortalApplicationStatusWithCode($application_code, $portal_table_name, $portal_status_id)
    {
        return DbHelper::updatePortalApplicationStatusWithCode($application_code, $portal_table_name, $portal_status_id);
    }
}

if (!function_exists('getPortalApplicationsTable')) {
    function getPortalApplicationsTable($module_id)
    {
        return UtilityHelper::getPortalApplicationsTable($module_id);
    }
}
//the DMS functions

//start on the DMS func calls 
if (!function_exists('authDms')) {
    function authDms($usr_name)
    {
        return DMSHelper::authDms($usr_name);

    }
}
if (!function_exists('validateTicketDMS')) {
    function validateTicketDMS($ticket)
    {
        return DMSHelper::validateTicketDMS($ticket);

    }
}
if (!function_exists('logoutDMS')) {
    function logoutDMS($ticket)
    {
        return DMSHelper::logoutDMS($ticket);

    }
}

if (!function_exists('logoutDMS')) {
    function logoutDMS($ticket)
    {
        return DMSHelper::logoutDMS($ticket);

    }
}
if (!function_exists('dmsCreateAccount')) {
    function dmsCreateAccount($user_data)
    {
        return DMSHelper::dmsCreateAccount($user_data);

    }
}
if (!function_exists('dmsDeleteAccount')) {
    function dmsDeleteAccount($userName)
    {
        return DMSHelper::dmsDeleteAccount($userName);

    }
}
if (!function_exists('dmsGetAccount')) {
    function dmsGetAccount($userName)
    {
        return DMSHelper::dmsGetAccount($userName);

    }
}
if (!function_exists('dmsGetAllAccount')) {
    function dmsGetAllAccount()
    {
        return DMSHelper::dmsGetAllAccount();

    }
}
if (!function_exists('getNonStructuredDocApplicationRootNode')) {
    function getNonStructuredDocApplicationRootNode($parent_node_ref, $reference_record_id, $reference_table_name, $document_type_id, $user_id)
    {
        return DMSHelper::getNonStructuredDocApplicationRootNode($parent_node_ref, $reference_record_id, $reference_table_name, $document_type_id, $user_id);

    }
}

if (!function_exists('dmsUpdateAccount')) {
    function dmsUpdateAccount($userName, $userDetails)
    {
        return DMSHelper::dmsUpdateAccount($userName, $userDetails);

    }
}
if (!function_exists('dmsUpdateAccountPassword')) {
    function dmsUpdateAccountPassword($userName, $oldPassword, $newPassword)
    {
        return DMSHelper::dmsUpdateAccountPassword($userName, $oldPassword, $newPassword);

    }
}
if (!function_exists('dmsGetAppSiteRoot')) {
    function dmsGetAppSiteRoot($root_site = null)
    {
        return DMSHelper::dmsGetAppSiteRoot($root_site);

    }
}
if (!function_exists('dmsCreateAppSiteRoot')) {
    function dmsCreateAppSiteRoot($site_details)
    {
        return DMSHelper::dmsCreateAppSiteRoot($site_details);

    }
}

if (!function_exists('dmsGetAppSiteContainer')) {
    function dmsGetAppSiteContainer($site_id, $container = null)
    {
        return DMSHelper::dmsGetAppSiteContainer($site_id, $container);

    }
}
if (!function_exists('dmsGetAppSiteContainerNodes')) {
    function dmsGetAppSiteContainerNodes($site_id, $container)
    {
        return DMSHelper::dmsGetAppSiteContainerNodes($site_id, $container);

    }
}
if (!function_exists('dmsGetAppRootNodes')) {
    function dmsGetAppRootNodes($defination)
    {
        return DMSHelper::dmsGetAppRootNodes($defination);

    }
}
if (!function_exists('dmsGetAppRootNodesChildren')) {
    function dmsGetAppRootNodesChildren($parent_node)
    {
        return DMSHelper::dmsGetAppRootNodesChildren($parent_node);

    }
}
if (!function_exists('dmsGetAppRootNodesContents')) {
    function dmsGetAppRootNodesContents($parent_node)
    {
        return DMSHelper::dmsGetAppRootNodesContents($parent_node);

    }
}
if (!function_exists('dmsCreateAppRootNodesChildren')) {
    function dmsCreateAppRootNodesChildren($parent_node, $node_details)
    {
        return DMSHelper::dmsCreateAppRootNodesChildren($parent_node, $node_details);

    }
}
if (!function_exists('dmsUpdateAppRootNodesChildren')) {
    function dmsUpdateAppRootNodesChildren($node_id, $node_details)
    {
        return DMSHelper::dmsUpdateAppRootNodesChildren($node_id, $node_details);

    }
}
if (!function_exists('dmsUploadNodeDocument')) {
    function dmsUploadNodeDocument($destination_node, $document_path, $origFileName, $update_noderef = null, $description = null)
    {
        return DMSHelper::dmsUploadNodeDocument($destination_node, $document_path, $origFileName, $update_noderef, $description);
    }
}
if (!function_exists('dmsDeleteAppRootNodesChildren')) {
    function dmsDeleteAppRootNodesChildren($node_id)
    {
        return DMSHelper::dmsDeleteAppRootNodesChildren($node_id);

    }
}
if (!function_exists('getNonStructuredDestinationNode')) {
    function getNonStructuredDestinationNode($document_type_id, $document_site_id)
    {
        return DMSHelper::getNonStructuredDestinationNode($document_type_id, $document_site_id);

    }
}


//get folder documents 
if (!function_exists('dms_FolderDocuments')) {
    function dms_FolderDocuments($folder_id, $user_email)
    {
        return DMSHelper::dms_FolderDocuments($folder_id, $user_email);

    }
}
//check folder documents
if (!function_exists('check_DmsFolderDocuments')) {
    function check_DmsFolderDocuments($folder_id, $user_email)
    {
        return DMSHelper::check_DmsFolderDocuments($folder_id, $user_email);

    }
}
if (!function_exists('downloadDocumentUrl')) {
    function downloadDocumentUrl($node_ref, $version_id = null)
    {
        return DMSHelper::downloadDocumentUrl($node_ref, $version_id);

    }
}
if (!function_exists('dmsGetNodePreviousVersions')) {
    function dmsGetNodePreviousVersions($node_ref, $version_ref = null)
    {
        return DMSHelper::dmsGetNodePreviousVersions($node_ref, $version_ref);

    }
}
if (!function_exists('getApplicationSubModuleNodeDetails')) {
    function getApplicationSubModuleNodeDetails($section_id, $module_id, $sub_module_id, $user_id, $con = 'mysql')
    {
        return DMSHelper::getApplicationSubModuleNodeDetails($section_id, $module_id, $sub_module_id, $user_id, $con);

    }
}
if (!function_exists('getApplicationRootNode')) {
    function getApplicationRootNode($application_code)
    {
        return DMSHelper::getApplicationRootNode($application_code);

    }
}
if (!function_exists('getDocumentTypeRootNode')) {
    function getDocumentTypeRootNode($parent_node_ref, $application_code, $document_type_id, $trader_email)
    {
        return DMSHelper::getDocumentTypeRootNode($parent_node_ref, $application_code, $document_type_id, $trader_email);

    }
}
if (!function_exists('saveApplicationDocumentNodedetails')) {
    function saveApplicationDocumentNodedetails($module_id, $sub_module_id, $application_code, $tracking_no, $reference_no, $dms_node_id, $user, $con = 'mysql')
    {
        return DMSHelper::saveApplicationDocumentNodedetails($module_id, $sub_module_id, $application_code, $tracking_no, $reference_no, $dms_node_id, $user, $con);

    }
}
//end of the dms function call
if (!function_exists('utf8ize')) {
    function utf8ize($d)
    {
        return UtilityHelper::utf8ize($d);
    }

}

if (!function_exists('formatDate')) {
    function formatDate($date)
    {
        return UtilityHelper::formatDate($date);
    }
}

if (!function_exists('formatDaterpt')) {
    function formatDaterpt($date)
    {
        return UtilityHelper::formatDaterpt($date);
    }
}

if (!function_exists('createDMSModuleFolders')) {
    function createDMSModuleFolders($parent_id, $module_id, $owner)
    {
        return DMSHelper::createDMSModuleFolders($parent_id, $module_id, $owner);

    }
}

if (!function_exists('getSubModuleFolderID')) {
    function getSubModuleFolderID($parent_folder_id, $sub_module_id)
    {
        return DMSHelper::getSubModuleFolderID($parent_folder_id, $sub_module_id);
    }
}

if (!function_exists('getSubModuleFolderIDWithCreate')) {
    function getSubModuleFolderIDWithCreate($parent_folder_id, $sub_module_id, $owner)
    {
        return DMSHelper::getSubModuleFolderIDWithCreate($parent_folder_id, $sub_module_id, $owner);
    }
}

if (!function_exists('updateDocumentSequence')) {
    function updateDocumentSequence($parent, $order_no)
    {
        $dmsHelper = new DMSHelper();
        return $dmsHelper->updateDocumentSequence($parent, $order_no);
    }
}

if (!function_exists('saveRecordReturnId')) {
    function saveRecordReturnId($data, $table)
    {
        $dmsHelper = new DMSHelper();
        return $dmsHelper->saveRecordReturnId($data, $table);
    }
}

if (!function_exists('saveRecord')) {
    function saveRecord($data, $table)
    {
        $dmsHelper = new DMSHelper();
        return $dmsHelper->saveRecord($data, $table);
    }
}

if (!function_exists('getfile_extension')) {
    function getfile_extension($fileName)
    {
        $dmsHelper = new DMSHelper();
        return $dmsHelper->getfile_extension($fileName);
    }
}

if (!function_exists('fileSize')) {
    function fileSize($file)
    {
        $dmsHelper = new DMSHelper();
        return $dmsHelper->fileSize($file);
    }
}

if (!function_exists('format_filesize')) {
    function format_filesize($size, $sizes = array('Bytes', 'KiB', 'MiB', 'GiB', 'TiB', 'PiB', 'EiB', 'ZiB', 'YiB'))
    {
        $dmsHelper = new DMSHelper();
        return $dmsHelper->format_filesize($size, $sizes);
    }
}

if (!function_exists('parse_filesize')) {
    function parse_filesize($str)
    {
        $dmsHelper = new DMSHelper();
        return $dmsHelper->parse_filesize($str);
    }
}

if (!function_exists('getParent')) {
    function getParent($folderId)
    {
        $dmsHelper = new DMSHelper();
        return $dmsHelper->getParent($folderId);
    }
}

if (!function_exists('getChecksum')) {
    function getChecksum($file)
    {
        $dmsHelper = new DMSHelper();
        return $dmsHelper->getChecksum($file);
    }
}

if (!function_exists('getPath')) {
    function getPath($folderId)
    {
        $dmsHelper = new DMSHelper();
        return $dmsHelper->getPath($folderId);
    }
}

if (!function_exists('addDocument')) {
    function addDocument($doc_name, $doc_comment, $file_name, $folder_id, $versioncomment = '', $is_array_return = false)
    {
        $dmsHelper = new DMSHelper();
        return $dmsHelper->addDocument($doc_name, $doc_comment, $file_name, $folder_id, $versioncomment, $is_array_return);
    }
}

if (!function_exists('getParentFolderID')) {
    function getParentFolderID($table, $parent_record_id)
    {
        return DMSHelper::getParentFolderID($table, $parent_record_id);
    }
}

if (!function_exists('createDMSParentFolder')) {
    function createDMSParentFolder($parent_folder, $module_id, $name, $comment, $owner)
    {
        return DMSHelper::createDMSParentFolder($parent_folder, $module_id, $name, $comment, $owner);
    }
}

if (!function_exists('getPermitExpiryDate')) {
    function getPermitExpiryDate($approval_date, $duration, $duration_mode)
    {
        return UtilityHelper::getPermitExpiryDate($approval_date, $duration, $duration_mode);

    }
}
if (!function_exists('getParameterItem')) {
    function getParameterItem($table_name, $record_id, $con = 'mysql')
    {
        return DbHelper::getParameterItem($table_name, $record_id, $con);
    }
}

if (!function_exists('unsetPrimaryIDsInArray')) {
    function unsetPrimaryIDsInArray($array)
    {
        return DbHelper::unsetPrimaryIDsInArray($array);
    }
}

if (!function_exists('createInitialRegistrationRecord')) {
    function createInitialRegistrationRecord($reg_table, $application_table, $reg_params, $application_id, $reg_column)
    {
        return DbHelper::createInitialRegistrationRecord($reg_table, $application_table, $reg_params, $application_id, $reg_column);
    }
}

if (!function_exists('initializeApplicationDMS')) {
    function initializeApplicationDMS($section_id, $module_id, $sub_module_id, $application_code, $ref_number, $user_id)
    {
        DMSHelper::initializeApplicationDMS($section_id, $module_id, $sub_module_id, $application_code, $ref_number, $user_id);
    }
}
if (!function_exists('getApplicationExpiryDate')) {
    function getApplicationExpiryDate($approval_date, $sub_module_id, $module_id, $section_id)
    {
        return UtilityHelper::getApplicationExpiryDate($approval_date, $sub_module_id, $module_id, $section_id);

    }
}
if (!function_exists('saveApplicationRegistrationDetails')) {
    function saveApplicationRegistrationDetails($table_name, $registration_data, $where_statement, $user_id)
    {
        return UtilityHelper::saveApplicationRegistrationDetails($table_name, $registration_data, $where_statement, $user_id);

    }
}
if (!function_exists('getProductPrimaryReferenceNo')) {
    function getProductPrimaryReferenceNo($where_statement, $applications_table)
    {
        return UtilityHelper::getProductPrimaryReferenceNo($where_statement, $applications_table);

    }
}
if (!function_exists('getPreviousProductRegistrationDetails')) {
    function getPreviousProductRegistrationDetails($where_statement, $applications_table)
    {
        return UtilityHelper::getPreviousProductRegistrationDetails($where_statement, $applications_table);

    }
}

if (!function_exists('generateProductsSubRefNumber')) {
    function generateProductsSubRefNumber($reg_product_id, $table_name, $ref_id, $codes_array, $sub_module_id, $user_id)
    {
        return UtilityHelper::generateProductsSubRefNumber($reg_product_id, $table_name, $ref_id, $codes_array, $sub_module_id, $user_id);
    }
}
//genLaboratoryReference_number($req->section_id, $req->zone_id, $req->sample_category_id,$req->laboratory_id,$req->device_type_id);
if (!function_exists('genLaboratoryReference_number')) {
    function genLaboratoryReference_number($section_id, $zone_id, $sample_category_id, $laboratory_id, $device_type_id, $user_id,$sample_type_id)
    {
        return UtilityHelper::genLaboratoryReference_number($section_id, $zone_id, $sample_category_id, $laboratory_id, $device_type_id, $user_id,$sample_type_id);
    }
}

if (!function_exists('updatePortalParams')) {
    function updatePortalParams($portal_table_name, $portal_params, $where)
    {
        DbHelper::updatePortalParams($portal_table_name, $portal_params, $where);
    }
}
if (!function_exists('getAllUsersOnActingGroups')) {
    function getAllUsersOnActingGroups($user_id)
    {
        return DbHelper::getAllUsersOnActingGroups($user_id);
    }
}
if (!function_exists('convertArrayToString')) {
    function convertArrayToString($array)
    {
        return DbHelper::convertArrayToString($array);
    }
}
if (!function_exists('onlineApplicationNotificationMail')) {
    function onlineApplicationNotificationMail($template_id, $email, $vars = array(),$identification_no=null)
    {
        EmailHelper::onlineApplicationNotificationMail($template_id, $email, $vars,$identification_no);
    }
}

if (!function_exists('sendTemplatedApplicationNotificationEmail')) {
    function sendTemplatedApplicationNotificationEmail($template_id, $email, $vars = array())
    {
        EmailHelper::sendTemplatedApplicationNotificationEmail($template_id, $email, $vars);
    }
}

if (!function_exists('forgotPasswordEmail')) {
    function forgotPasswordEmail($template_id, $email, $link, $vars = array())
    {
        return EmailHelper::forgotPasswordEmail($template_id, $email, $link, $vars);
    }
}

if (!function_exists('generateTraderNo')) {
    function generateTraderNo($table_name)
    {
        return UtilityHelper::generateTraderNo($table_name);
    }
}
if (!function_exists('accountRegistrationEmail')) {
    function accountRegistrationEmail($template_id, $email, $password, $link, $vars = array())
    {
        return EmailHelper::accountRegistrationEmail($template_id, $email, $password, $link, $vars);
    }
}
if (!function_exists('getExchangeRate')) {
    function getExchangeRate($currency_id)
    {
        return DbHelper::getExchangeRate($currency_id);
    }
}

if (!function_exists('generatePaymentRefDistribution')) {
    function generatePaymentRefDistribution($invoice_id, $receipt_id, $amount_paid, $paying_currency, $user_id)
    {
        DbHelper::generatePaymentRefDistribution($invoice_id, $receipt_id, $amount_paid, $paying_currency, $user_id);
    }
}

if (!function_exists('applicationInvoiceEmail')) {
    function applicationInvoiceEmail($template_id, $email, $vars, $report, $attachment_name)
    {
        EmailHelper::applicationInvoiceEmail($template_id, $email, $vars, $report, $attachment_name);
    }
}

if (!function_exists('applicationPermitEmail')) {
    function applicationPermitEmail($template_id, $email, $vars, $permit_report, $certificate_report)
    {
        EmailHelper::applicationPermitEmail($template_id, $email, $vars, $permit_report, $certificate_report);
    }
}

if (!function_exists('getInvoiceDetails')) {
    function getInvoiceDetails($module_id, $application_id,$application_code = '')
    {
        $reportsHelper = new ReportsHelper();
        return $reportsHelper->getInvoiceDetails($module_id, $application_id,$application_code);
    }
}

if (!function_exists('returnParamFromArray')) {
    function returnParamFromArray($dataArray, $dataValue)
    {
        return UtilityHelper::returnParamFromArray($dataArray, $dataValue);
    }
}

if (!function_exists('funcSaveOnlineProductOtherdetails')) {
    function funcSaveOnlineProductOtherdetails($portal_product_id, $product_id, $reg_product_id, $user_id)
    {
        return UtilityHelper::funcSaveOnlineProductOtherdetails($portal_product_id, $product_id, $reg_product_id, $user_id);
    }
}

if (!function_exists('funcSaveOnlineMedicalNotificationOtherdetails')) {
    function funcSaveOnlineMedicalNotificationOtherdetails($portal_product_id, $product_id, $reg_product_id, $user_id)
    {
        return UtilityHelper::funcSaveOnlineMedicalNotificationOtherdetails($portal_product_id, $product_id, $reg_product_id, $user_id);
    }
}
//funcSaveOnlineImportExportOtherdetails
if (!function_exists('funcSaveOnlineImportExportOtherdetails')) {
    function funcSaveOnlineImportExportOtherdetails($application_code, $user_id)
    {
        return UtilityHelper::funcSaveOnlineImportExportOtherdetails($application_code, $user_id);
    }
}
//funcSaveOnlineImportExportOtherdetails
if (!function_exists('funcSaveOnlineDisposalOtherdetails')) {
    function funcSaveOnlineDisposalOtherdetails($application_code, $user_id)
    {
        return UtilityHelper::funcSaveOnlineDisposalOtherdetails($application_code, $user_id);
    }
}

if (!function_exists('returnMessage')) {
    function returnMessage($results)
    {
        return UtilityHelper::returnMessage($results);
    }
}
if (!function_exists('getLIMSApplicantRecord')) {
    function getLIMSApplicantRecord($trader_id, $user_id)
    {
        return UtilityHelper::getLIMSApplicantRecord($trader_id, $user_id);
    }
}

if (!function_exists('generateApplicationViewID')) {
    function generateApplicationViewID()
    {
        return UtilityHelper::generateApplicationViewID();
    }
}
//errror handler
if (!function_exists('sys_error_handler')) {
    function sys_error_handler($error='', $level=1, $me=[], $class_array=[], $user_id)
    {
        return DbHelper::sys_error_handler($error, $level, $me, $class_array, $user_id);
    }
}

if (!function_exists('updateDocumentRegulatoryDetails')) {
    function updateDocumentRegulatoryDetails($app_details, $document_types, $decision_id)
    {
        DbHelper::updateDocumentRegulatoryDetails($app_details, $document_types, $decision_id);
    }
}

if (!function_exists('getZoneIdFromRegion')) {
    function getZoneIdFromRegion($region_id)
    {
        return DbHelper::getZoneIdFromRegion($region_id);
    }
}

if (!function_exists('getHQZoneId')) {
    function getHQZoneId()
    {
        return DbHelper::getHQZoneId();
    }
}

if (!function_exists('_withdrawalReasons')) {
    function _withdrawalReasons($application_code)
    {
        return DbHelper::_withdrawalReasons($application_code);
    }
}

if (!function_exists('saveNotification')) {
    function saveNotification($source_record_id, $notification_type_id, $from_module_id, $to_module_id, $section_id, $note, $user_id)
    {
        DbHelper::saveNotification($source_record_id, $notification_type_id, $from_module_id, $to_module_id, $section_id, $note, $user_id);
    }
}

if (!function_exists('deleteNotification')) {
    function deleteNotification($source_record_id, $notification_type_id, $from_module_id, $to_module_id)
    {
        DbHelper::deleteNotification($source_record_id, $notification_type_id, $from_module_id, $to_module_id);
    }
}
if (!function_exists('applicationExpiryNotificationMail')) {
    function applicationExpiryNotificationMail($template_id, $email, $vars = array(),$applicant)
    {
        return EmailHelper::applicationExpiryNotificationMail($template_id, $email, $vars, $applicant);
    }
}
if (!function_exists('number_to_alpha')) {
    function number_to_alpha($num,$code)
    {
        return UtilityHelper::number_to_alpha($num,$code);
    }
}
if (!function_exists('toUpperCase')) {
    function toUpperCase($flat_array)
    {
        return UtilityHelper::toUpperCase($flat_array);
    }
}

//handler
if (!function_exists('sys_error_handler')) {
    function sys_error_handler($error='', $level=1, $me=[], $class_array=[], $user_id)
    {
        return DbHelper::sys_error_handler($error, $level, $me, $class_array, $user_id);
    }
}

if (!function_exists('exportDatatoExcel')) {
    function exportDatatoExcel($data, $heading, $filename)
    {
        return ReportsHelper::exportDatatoExcel($data, $heading, $filename);
    }
}
if (!function_exists('getTableName')) {
    function getTableName($module_id, $is_portal = 0)
    {
        return UtilityHelper::getTableName($module_id, $is_portal = 0);
    }
}

if (!function_exists('getPermitSignatoryDetails')) {
    function getPermitSignatoryDetails($options = '')
    {
        return UtilityHelper::getPermitSignatoryDetails();
    }
}
if (!function_exists('getPermitSignatorySignature')) {
    function getPermitSignatorySignature()
    {
        return UtilityHelper::getPermitSignatorySignature();
    }
}

if (!function_exists('getUserSignatureDetails')) {
    function getUserSignatureDetails($usr_id)
    {
        return UtilityHelper::getUserSignatureDetails($usr_id);
    }
}

