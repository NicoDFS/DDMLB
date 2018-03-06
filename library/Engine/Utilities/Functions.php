<?php

class Engine_Utilities_Functions {

    private static $_instance = null;
    public $_NFL = null;

    //Prevent any oustide instantiation of this class
    private function __construct() {
        
    }

    private function __clone() {
        
    }

//Prevent any copy of this object

    public static function getInstance() {
        if (!is_object(self::$_instance))  //or if( is_null(self::$_instance) ) or if( self::$_instance == null )
            self::$_instance = new Engine_Utilities_Functions();
        return self::$_instance;
    }

    /**
     * Desc : Filter Array by searchkey and searchvalue
     * @param <String> $searchValue
     * @param <Array> $array
     * @param <String> $searchKey
     * @return <Array> $filtered
     */
    public function filterArray($searchValue, $array, $searchKey) {
        if ($searchValue != "" && $searchKey != "") {
            $filter = function($array) use($searchValue, $searchKey) {
                        if ($array[$searchKey]) {
                            return $array[$searchKey] == $searchValue;
                        }
                    };
            $filtered = array_filter($array, $filter);
            return $filtered;
        }
    }

    public function array_sort($array, $on, $order = SORT_ASC) {
        $new_array = array();
        $sortable_array = array();

        if (count($array) > 0) {
            foreach ($array as $k => $v) {
                if (is_array($v)) {
                    foreach ($v as $k2 => $v2) {
                        if ($k2 == $on) {
                            $sortable_array[$k] = $v2;
                        }
                    }
                } else {
                    $sortable_array[$k] = $v;
                }
            }
            switch ($order) {
                case SORT_ASC:
                    asort($sortable_array);
                    break;
                case SORT_DESC:
                    arsort($sortable_array);
                    break;
            }
            foreach ($sortable_array as $k => $v) {
                $new_array[$k] = $array[$k];
            }
        }

        return $new_array;
    }
    
    
    
    public function arrangeLineup($sportId,$lineup){
        if($sportId){
            $posLineup = array();
            switch($sportId){
                case 1 :
                    $posLineup = $this->arrangeNFLineUp($lineup);
                    break;
                case 2:
                    $posLineup = $this->arrangeMLBLineUp($lineup);
                    break;
                case 3:
                    $posLineup = $this->arrangeNBALineUp($lineup);
                    break;
                case 4:
                    $posLineup = $this->arrangeNHLineUp($lineup);
                    break;
            }
            return $posLineup;
        }
    }
    
    
     //sport id 1 for NFL sport
        function arrangeNFLineUp($NFLineup){ 
           // echo "<pre>"; print_r($NFLineup); echo "</pre>"; die;
               $posQB = array();
               $posRB = array();
               $posWR = array();
               $posTE = array();
               $posFLEX = array();
               $posK = array();
               $posDST = array();               
               
               if(empty($posQB)){
                       foreach($NFLineup as $lineup){
                               if($lineup['position']=='QB'){
                                     $posQB[] =  $lineup; 
                               }
                       }
               }
               
               if(empty($posRB)){
                       foreach($NFLineup as $lineup){
                               if($lineup['position']=='RB'){
                                     $posRB[] =  $lineup; 
                               }
                       }
               }
               if(empty($posWR)){
                       foreach($NFLineup as $lineup){
                               if($lineup['position']=='WR'){
                                     $posWR[] =  $lineup; 
                               }
                       }
               }
               if(empty($posTE)){
                       foreach($NFLineup as $lineup){
                               if($lineup['position']=='TE'){
                                     $posTE[] =  $lineup; 
                               }
                       }
               }
               if(empty($posFLEX)){
                       foreach($NFLineup as $lineup){
                               if($lineup['position']=='FLEX'){
                                     $posFLEX[] =  $lineup; 
                               }
                       }
               }
               if(empty($posK)){
                       foreach($NFLineup as $lineup){
                               if($lineup['position']=='K'){
                                     $posK[] =  $lineup; 
                               }
                       }
               }
               if(empty($posDST)){
                       foreach($NFLineup as $lineup){
                               if($lineup['position']=='DST'){
                                     $posDST[] =  $lineup; 
                               }
                       }
               }
               return array_merge($posQB,$posRB,$posWR,$posTE,$posFLEX,$posK,$posDST);
              
       }   
       //sport id 2 for MLB sport
        function arrangeMLBLineUp($MLBLineup){
               $posP = array();
               $posC = array();
               $pos1B = array();
               $pos2B = array();
               $pos3B = array();
               $posSS = array();
               $posOF = array();
               
               if(empty($posP)){
                       foreach($MLBLineup as $lineup){
                               if($lineup['position']=='P'){
                                     $posP[] =  $lineup; 
                               }
                       }
               }
               
               if(empty($posC)){
                       foreach($MLBLineup as $lineup){
                               if($lineup['position']=='C'){
                                     $posC[] =  $lineup; 
                               }
                       }
               }
               if(empty($pos1B)){
                       foreach($MLBLineup as $lineup){
                               if($lineup['position']=='1B'){
                                     $pos1B[] =  $lineup; 
                               }
                       }
               }
               if(empty($pos2B)){
                       foreach($MLBLineup as $lineup){
                               if($lineup['position']=='2B'){
                                     $pos2B[] =  $lineup; 
                               }
                       }
               }
               if(empty($pos3B)){
                       foreach($MLBLineup as $lineup){
                               if($lineup['position']=='3B'){
                                     $pos3B[] =  $lineup; 
                               }
                       }
               }
               if(empty($posSS)){
                       foreach($MLBLineup as $lineup){
                               if($lineup['position']=='SS'){
                                     $posSS[] =  $lineup; 
                               }
                       }
               }
               if(empty($posOF)){
                       foreach($MLBLineup as $lineup){
                               if($lineup['position']=='OF'){
                                     $posOF[] =  $lineup; 
                               }
                       }
               }
               
               
               return array_merge($posP,$posC,$pos1B,$pos2B,$pos3B,$posSS,$posOF);
               
       }
       //sport id 3 for NBA sport
        function arrangeNBALineUp($NBALineup){ 
               $posPG = array();
               $posSG = array();
               $posSF = array();
               $posPF = array();
               $posC = array();
               $posG = array();
               $posF = array();
               $posUTIL = array();
               
               if(empty($posPG)){
                       foreach($NBALineup as $lineup){
                               if($lineup['position']=='PG'){
                                     $posPG[] =  $lineup; 
                               }
                       }
               }
               
               if(empty($posSG)){
                       foreach($NBALineup as $lineup){
                               if($lineup['position']=='SG'){
                                     $posSG[] =  $lineup; 
                               }
                       }
               }
               if(empty($posSF)){
                       foreach($NBALineup as $lineup){
                               if($lineup['position']=='SF'){
                                     $posSF[] =  $lineup; 
                               }
                       }
               }
               if(empty($posPF)){
                       foreach($NBALineup as $lineup){
                               if($lineup['position']=='PF'){
                                     $posPF[] =  $lineup; 
                               }
                       }
               }
               if(empty($posC)){
                       foreach($NBALineup as $lineup){
                               if($lineup['position']=='C'){
                                     $posC[] =  $lineup; 
                               }
                       }
               }
               if(empty($posG)){
                       foreach($NBALineup as $lineup){
                               if($lineup['position']=='G'){
                                     $posG[] =  $lineup; 
                               }
                       }
               }
               if(empty($posF)){
                       foreach($NBALineup as $lineup){
                               if($lineup['position']=='F'){
                                     $posF[] =  $lineup; 
                               }
                       }
               }
               
               if(empty($posUTIL)){
                       foreach($NBALineup as $lineup){
                               if($lineup['position']=='UTIL'){
                                     $posUTIL[] =  $lineup; 
                               }
                       }
               }
               return array_merge($posPG,$posSG,$posSF,$posPF,$posC,$posG,$posF,$posUTIL);
              
       }
       //sport id 4 for NHL sport
        function arrangeNHLineUp($NHLineup){ 
               $posC = array();
               $posW = array();
               $posD = array();
               $posG = array();
               $posUTLI = array();                         
               
               if(empty($posC)){
                       foreach($NHLineup as $lineup){
                               if($lineup['position']=='C'){
                                     $posC[] =  $lineup; 
                               }
                       }
               }
               
               if(empty($posW)){
                       foreach($NHLineup as $lineup){
                               if($lineup['position']=='W'){
                                     $posW[] =  $lineup; 
                               }
                       }
               }
               if(empty($posD)){
                       foreach($NHLineup as $lineup){
                               if($lineup['position']=='D'){
                                     $posD[] =  $lineup; 
                               }
                       }
               }
               if(empty($posG)){
                       foreach($NHLineup as $lineup){
                               if($lineup['position']=='G'){
                                     $posG[] =  $lineup; 
                               }
                       }
               }
               if(empty($posUTLI)){
                       foreach($NHLineup as $lineup){
                               if($lineup['position']=='UTIL'){
                                     $posUTLI[] =  $lineup; 
                               }
                       }
               }
               return array_merge($posC,$posW,$posD,$posG,$posUTLI);
       }  
}

?>
