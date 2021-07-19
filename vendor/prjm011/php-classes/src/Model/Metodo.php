<?php
    namespace PRJM011\Model;
    use \PRJM011\Model;
    use \PRJM011\Model\Cliente;
   

    class Metodo extends Model {
        
        public function convertDateToView($object = array())
        {
            $i = 0;
            
            if ((isset($object["dtcadastro"]) && $object["dtcadastro"] != '') ) {
                foreach ($object as $key => $value) {
                    if ($value != '' && $key == "dtcadastro") {
                        $object[$key] =  Metodo::convertDateView($value);
                    }
                    $i++;
                }
            } else 
            {
                if (isset($object)) {
                    foreach ($object as $key => $values) {
                        foreach ($values as $key => $value) {
                            if ($value != '' && $key == "dtcadastro") {
                                $values[$key] =  Metodo::convertDateView($value);
                            }
                        }
                        $object[$i] = $values;
                        $i++;
                    }
                }
            }
        
            return $object;
        }
        
        public function convertDateToDataBase($object = array())
        {
            foreach ($object as $key => $value) {
                if (isset($value) && $value !='') {
                    $object[$key] =  Metodo::convertDateDataBase($object[$key]);
                }
            }
            return $object;
            
        }

        public function convertDateView($date)
        {
            $data = date("d-m-Y", strToTime($date));
            if ($data == '31-12-1969')
            {
                $data = '';
            }   
            return  $data;
        }

        public function convertDateDataBase($date)
        {
            return $data = date("Y-m-d", strToTime($date));
        }

        public function convertToInt($object = array())
        {
            if (isset($object[0]["pgs"])) {
                for ($i=0; $i < count($object); $i++) { 
                    $object[$i]["pgs"] = ceil($object[$i]["pgs"]);
                }
                
                return $object;
            }
            return $object;
        }
        
        public function countRegister($qtdeRegister, $company)
        {
            $pgs = [];
            for ($j=0; $j < $qtdeRegister - 1; $j++) { 
                $pgs[$j]    = $j;
            }
            $pgs["list"]["limit"] = '';
            foreach ($company as $key => $value) {
                $pgs["list"][$key] = $value;
            }
            
            return $pgs;
        }

        public function selectRegister($act = array())
        {
            $classModel = "";
            $pgs        = [];
            $classModel = Cliente::listAll($act);
            
            $classModel = Metodo::convertDateToView($classModel);
            $classModel = Metodo::convertToInt($classModel);
            if (isset($classModel[0]["pgs"]) && count($classModel) > 0 && $classModel != '') {
                $pgs 	= Metodo::countRegister($classModel[0]["pgs"], $act);
            }
                   
            return [$classModel, $pgs];
        }
    }
?>
