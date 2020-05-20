<?php
require_once 'connection.php';

function getFromGet($param, $default=null, $type='string'){
	if($type === 'int'){
		$param = filter_input(INPUT_GET, $param, FILTER_SANITIZE_NUMBER_INT);
	} else{
		$param =filter_input(INPUT_GET, $param, FILTER_SANITIZE_STRING);
	}
	$ret = $param ? $param : $default;
	
	return $ret;
}
/*function getRandName() {
    
    $name = ['ROBERTO', 'GIOVANNI', 'GIULIA', 'TED', 'JOHN', 'GIAN'];
    $lastname = ['SMITH', 'RE', 'ROSSI', 'ARIAS', 'LILLI', 'CRUZ', 'RECOBA'];
    return $names[mt_rand(0,count($names)-1)]. ' ' . $lastnames[mt_rand(0, count($names)-1)];
}

function getRandEmail($name){
    $domains = ['google.com', 'yahoo.com', 'libero.it', 'hotmail.it'];
    
    $str = strtolower(str_replace(' ','.',$name)).'.'.mt_rand(11,99).'@'.$domains[mt_rand(0,99)];
    return $str;
}
function getRandFiscalcode() {
    $i = 16;
    $res = '';
    while ($i>0){
        $res .= chr(mt_rand(97, 122));
        $i--;
    }
    return stroupper($res);
}
function insertRandUsers($tot, mysqli $mysqli){
    $fiscalcodes = [];
    $emails = [];
    $fiscalcode = $emails = '';
    for ($i = 0; $i < $tot; $i++){
        
        do{
            $rand = getRandFiscalcode();
        } while (in_array($rand, $fiscalcodes));
        $fiscalcodes[] = $rand;
        $name = getRandName();
        $age = mt_rand(18,99);
        do{
            $email = getRandEmail($name);
        }while (in_array($email, $emails));
        
        $emails [] = $email;
        $query = "INSERT INTO users (id, username, age, fiscalcode, email) VALUES (NULL, '$name', $age, '".$fiscalcode."','$email'";
        $res = $mysqli->query($query);
        if (!res) {
            die('Error' . $mysqli->error);
        } else {
            echo $mysqli->affected_rows . 'created';
        }
		
    }
}
function getUsers(array $params){
			
			$mysqli = $GLOBALS['mysqli'];
			$sql = 'SELECT * FROM users';
			$result = $mysqli-> query($sql);
			return $result;
		}*/
		
function getSpecie(array $params){
			
	$mysqli = $GLOBALS['mysqli'];
			$records = [];
	//passo il valore orderBy alla query, verificando prima se esiste lasciando colonna nomeLatino come default
			$orderBy = $params['orderBy'];
			
			$orderBy = $mysqli->escape_string($orderBy); 
			$orderDir = $params['orderDir'];
			
			$orderDir = $mysqli->escape_string($orderDir); 
			$start =(int)$params['start'];
			$limit =(int)$params['limit'];
	//proteggo questa variabile
			$row = [];
			
			$where = '';
			$whereParam = !empty($params['search']) ? ($params['search']) : '';
		 	
			if($whereParam) {
				$whereParam = $mysqli->escape_string($whereParam);
				$where = "WHERE nomeLatino like '%$whereParam%' OR ";//metto le percentuali perchè la parte di stringa che voglio ricercare non importa se è all'inizio, all'interno o alla fine
				$where .= " tipo like '%$whereParam%' OR ";
				$where .= " nomeItaliano like '%$whereParam%' OR ";
				$where .= " classe like '%$whereParam%' OR ";
				$where .= " annoClassif =". ((int)$whereParam);
				/*$where .= "  vulnerabilita =". ((float)$whereParam);
				$where .= " wikiLink like '%$whereParam%' OR ";
				$where .= "  classe like '%$whereParam%' OR ";
				$where .= "  cmAltezza =". ((int)$whereParam);
				$where .= " cmDiametro =". ((int)$whereParam);
				$where .= " peso =". ((float)$whereParam);
				$where .= " mediaProle =". ((float)$whereParam);*/
			}
	
			
			
			$sql = "SELECT * FROM SPECIE $where ORDER BY $orderBy $orderDir LIMIT $start,$limit";
			$result = $mysqli-> query($sql);
		
		if($result && $result->num_rows){
			while ($records[] = $result->fetch_assoc());
		}
			return $records;
		}

function getTotalSpecie(array $params){
			
			$mysqli = $GLOBALS['mysqli'];
	
			$totalRecords = 0;
	
			$where = '';
			$whereParam = !empty($params['search']) ? ($params['search']) : '';
		 	
			if($whereParam) {
				$whereParam = $mysqli->escape_string($whereParam);
				$where = "WHERE nomeLatino like '%$whereParam%' OR ";//metto le percentuali perchè la parte di stringa che voglio ricercare non importa se è all'inizio, all'interno o alla fine
				$where .= " tipo like '%$whereParam%' OR ";
				$where .= " nomeItaliano like '%$whereParam%' OR ";
				$where .= " classe like '%$whereParam%' OR ";
				$where .= " annoClassif =". ((int)$whereParam);
				$where .= " OR vulnerabilita =". ((float)$whereParam);
				$where .= " OR wikiLink like '%$whereParam%' OR ";
				$where .= "  classe like '%$whereParam%' OR ";
				$where .= "  cmAltezza =". ((int)$whereParam);
				$where .= " OR cmDiametro =". ((int)$whereParam);
				$where .= " OR peso =". ((float)$whereParam);
				$where .= " OR mediaProle =". ((float)$whereParam);
			}
	
			
			
			$sql = "SELECT COUNT(*) AS total FROM SPECIE $where";
			$result = $mysqli-> query($sql);
		
		if($result && $result->num_rows){
			$row = $result->fetch_assoc();
				$totalRecords = $row['total'];
		}
			return $totalRecords;
		}

function deleteRecord($nomeLatino){
	//mi proteggo poichè i parametri sono passati via url
	$nomeLatino = (string) $nomeLatino;
	if(!$nomeLatino){
		return false;
	}
	
	$sql = 'DELETE FROM specie where nomeLatino='.($nomeLatino);
	$ret = $GLOBALS['mysqli']->query($sql);
	return $GLOBALS['mysqli']->affected_rows;
}

function getUnaSpecie($nomeLatino){
	$result = [];
	$nomeLatino = (string) $nomeLatino;
	$sql = 'SELECT * FROM specie where nomeLatino='.$nomeLatino;
	$res = $GLOBALS['mysqli']->query($sql);
	
	if($res && $res->num_rows){
		$result = $res->fetch_assoc();
	}
	return $result;
		
}

function updateSpecie(array $array){
	$mysqli = $GLOBALS['mysqli'];
	$nomeLatino = $mysqli->escape_string($array['nomeLatino']);
	$tipo = $mysqli->escape_string($array['tipo']);
	$classe = $mysqli->escape_string($array['classe']);
	$annoClassif = (int)$array['annoClassif'];
	$vulnerabilita = (float)$array['vulnerabilita'];
	$wikiLink = $mysqli->escape_string($array['wikiLink']);
	$cmAltezza = (int)$array['cmAltezza'];
	$cmDiametro = (int)$array['cmDiametro'];
	$peso = (float)$array['peso'];
	$mediaProle = (float)$array['mediaProle'];
	
	
	$sql = "UPDATE specie set nomeLatino='$nomeLatino', tipo='$tipo', classe='$classe'";
	$sql .= "annoClassif='$annoClassif', vulnerabilita='$vulnerabilita', wikiLink='$wikiLink'";
	$sql .= "cmAltezza='$cmAltezza', cmDiametro='$cmDiametro', peso='$peso', mediaProle='$mediaProle' WHERE nomeLatino=$nomeLatino";
}
