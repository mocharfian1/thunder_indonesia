<?php 
// if (!defined('BASEPATH')) exit('No direct script access allowed');
// class m_pdf {
    
//     function m_pdf()
//     {
//         $CI = & get_instance();
//         log_message('Debug', 'mPDF class is loaded.');
//     }
 
//     function load($param=NULL)
//     {
//         include_once APPPATH.'/third_party/mpdf60/mpdf.php';
         
//         if ($params == NULL)
//         {
//             $param = '"en-GB-x","A4","","",0,0,0,0,0,0';          
//         }
        
//         return new mPDF($param);
//     }
// }

if (!defined('BASEPATH')) exit('No direct script access allowed'); 

class M_pdf 
{ 
    function __construct()
    { 
        include_once APPPATH.'third_party/mpdf/autoload.php'; 
    } 
    function pdf()
    { 
        $CI = & get_instance(); 
        log_message('Debug', 'mPDF class is loaded.'); 
    } 
    function load($param=[])
    { 
        return new \Mpdf\Mpdf($param); 
    } 
}