<?php

Class API{

    public $link;
    public $url_soap;
    public $login;
    public $password;

    public $codeLang;
    public $poolAlias;

    public function getDetailArticle($recherche){
        $w = "";
        if(is_array($recherche)){
            $recherche  = implode("','",$recherche);
        }
        else{
            $recherche = $this->strim($recherche);
            $w = "  OR UPPER(IM.ITMREF_0) LIKE '%".strtoupper($recherche)."%'
                    OR UPPER(IM.ITMDES1_0) LIKE '%".strtoupper($recherche)."%'
                    OR UPPER(IM.YBPSEAN_0) LIKE '%".strtoupper($recherche)."%'
                    OR UPPER(IB.BPSNUM_0) LIKE '%".strtoupper($recherche)."%'
                    OR UPPER(BPS.BPSNAM_0) LIKE '%".strtoupper($recherche)."%'
                    OR UPPER(IB.ITMREFBPS_0) LIKE '%".strtoupper($recherche)."%' ";
        }

        $queryParams    = $data = array();
        $queryOptions   = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
        $query          = " SELECT 
                                CASE WHEN 
                                    ZB.ITMREF_0 IS NOT NULL
                                    THEN 
                                        ZB.CPNITMREF_0 
                                    ELSE
                                        IM.ITMREF_0
                                    END AS REF
                                ,CASE WHEN 
                                    ZB.ITMREF_0 IS NOT NULL
                                    THEN 
                                        (SELECT ITMDES1_0 FROM [ZITMMASTER] WHERE ITMREF_0 = ZB.CPNITMREF_0 )
                                    ELSE
                                        IM.ITMDES1_0
                                    END AS DESS
                                ,IM.TSICOD_1 AS FAM
                                ,CASE WHEN 
                                    ZB.ITMREF_0 IS NOT NULL
                                    THEN 
                                        (SELECT ISNULL(YBPSEAN_0,'') FROM [ZITMMASTER] WHERE ITMREF_0 = ZB.CPNITMREF_0 )
                                    ELSE
                                        ISNULL(IM.YBPSEAN_0,'')
                                    END AS CB
                                ,ISNULL(IB.BPSNUM_0,'') AS FOURN
                                ,ISNULL(BPS.BPSNAM_0,'') AS FOURNN
                                ,CASE WHEN 
                                    ZB.ITMREF_0 IS NOT NULL
                                    THEN 
                                        (SELECT ISNULL(ITMREFBPS_0,'') FROM [ZITMBPS] WHERE ITMREF_0 = ZB.CPNITMREF_0 AND DEFBPSFLG_0 = 2)
                                    ELSE
                                        ISNULL(IB.ITMREFBPS_0,'')
                                    END AS REF_F
                                ,SP.PRI_0 AS PV_TTC
                                ,CASE WHEN 
                                    ZB.ITMREF_0 IS NOT NULL
                                    THEN 
                                        ZB.LIKQTY_0
                                    ELSE
                                        1
                                    END AS QTE
                                ,ZC.qte AS CMDE
                                ,CONVERT(VARCHAR, ZC.date_derniere_cmde, 103) AS DATE_D_CMDE
                                
                            FROM 
                                [ZITMMASTER] IM 
                                LEFT JOIN [ZITMBPS] IB ON IB.ITMREF_0 = IM.ITMREF_0 AND IB.DEFBPSFLG_0 = 2
                                LEFT JOIN [ZBPSUPPLIER] BPS ON BPS.BPSNUM_0 = IB.BPSNUM_0
                                LEFT JOIN [ZSPRICLIST] SP ON SP.PLICRI1_0 = IM.ITMREF_0 AND SP.PLI_0 = 'TGEN'
                                LEFT JOIN [ZBOMD] ZB ON ZB.ITMREF_0 = IM.ITMREF_0
                                LEFT JOIN [ZCMDENCOURS] ZC ON ZC.code = IM.ITMREF_0

                            WHERE
                                IM.ACCCOD_0 = 'SAN'
                                AND ( 
                                        IM.ITMREF_0 IN ('".$recherche."')
                                        ".$w."
                                    ) 
                            ORDER BY
                                IM.ITMREF_0";

        $resultat       = sqlsrv_query($this->link, $query, $queryParams, $queryOptions);
        if ($resultat == FALSE) {
            var_dump(sqlsrv_errors());
            return false;
        } elseif (sqlsrv_num_rows($resultat) == 0) {
            return false;
        } else {
            while($row = sqlsrv_fetch_array($resultat, SQLSRV_FETCH_ASSOC)){
                $data[] = $row;
            }
        }
        return $data;
    }

    public function getNomenclatureArticle($recherche){
        $recherche      = $this->strim($recherche);
        $queryParams    = $data = array();
        $queryOptions   = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
        $query          = " SELECT ITMREF_0 FROM [ZBOMD] WHERE ITMREF_0 = '".$recherche."' ";

        $resultat       = sqlsrv_query($this->link, $query, $queryParams, $queryOptions);
        if ($resultat == FALSE) {
            var_dump(sqlsrv_errors());
            return false;
        } elseif (sqlsrv_num_rows($resultat) == 0) {
            return 0;
        } else {
            return 1;
        }
    }

    public function preg_replace_($xml){
        $xml = preg_replace("/\n/", "", $xml);
        $xml = preg_replace("/>\s*</", "><", $xml);
        return $xml;
    }

    public function soap_API($reference){
        $reference  = $this->strim($reference);
        $soapClient = new SoapClient(
            $this->url_soap,
            array(
                'trace'    => true,
                'login'    => $this->login,
                'password' => $this->password,
            )
        );
        $array      = array();
        $context    = array('codeLang'=>$this->codeLang, 'poolAlias'=>$this->poolAlias,'poolId'=>'','requestConfig'=>'adxwss.trace.on=on&adxwss.trace.size=16384&adonix.trace.on=on&adonix.trace.level=3&adonix.trace.size=8');

        //$context    = array('codeLang'=>$this->codeLang, 'poolAlias'=>$this->poolAlias,'poolId'=>'','requestConfig'=>'');

        $inputXml   = $this->ligne("1",$reference);

        $result     = $soapClient->__call("run",array($context,'YCONSTOCK',$inputXml));
        $xml        = simplexml_load_string($result->resultXml);
        
        $article    = $xml->TAB[1];

        foreach ($article as $val) {
            $array[] = $val->FLD;
        }

        return $array;
    }


    public function xml2array($fname){
      $sxi      = new SimpleXmlIterator($fname);
      return $this->sxiToArray($sxi);
    }

    public function strim(?string $value){
        return trim($value ?? '');
    }

    public function sxiToArray($sxi){
      $a = array();
      for( $sxi->rewind(); $sxi->valid(); $sxi->next() ) {
        if(!array_key_exists($sxi->key(), $a)){
          $a[$sxi->key()]   = array();
        }
        if($sxi->hasChildren()){
          $a[$sxi->key()][] = $this->sxiToArray($sxi->current());
        }
        else{
          $a[$sxi->key()][] = strval($sxi->current());
        }
      }
      return $a;
    }

    public function ligne($nb_ligne,$article){
        $xml    =   '<PARAM>
                        <TAB ID="IN">
                            <LIN ID="IN" NUM="'.$nb_ligne.'">
                                <FLD NAM="YITMREF">'.$article.'</FLD>
                            </LIN>
                        </TAB>
                    </PARAM>';
        $xml    = $this->preg_replace_($xml);
        return $xml;
    }


}
?>