<?php

require_once __DIR__ . "/Database.php";
require_once __DIR__ . "/../conf/Config.php";

/**
 * Class API
 * houses all API functions
 */
class API
{

    function fetchCurrency($requestData)
    {
        try {
            $this->logMessage("request received | " . print_r($requestData, true));

            $db = new Database();

            $fetchQuery = "SELECT CUR_ISO currencyCode,CUR_CENTRAL_BANK_RATE currencyCentralBankrate,CUR_RATE_DATE currencyRateDate,CURR_B_DESC description from CURRENCY order by CUR_ISO desc;";


            $currencies = $db->select($fetchQuery);

            $this->logMessage("currencies fetched | " . print_r($currencies, true));

            return $currencies;
        } catch (Exception $e) {
            $this->logMessage("Exception occurred fetching currencies | " . $e->getMessage());
            return array();
        }


    }

    /**
     * Write log to file
     * @param $string
     */
    function logMessage($string)
    {
        $file = Config::LOG_FILE;

        //Replace the newlines
        $date = date("Y-m-d G:i:s");
        if ($fo = fopen($file, 'ab')) {
            fwrite($fo, "$date | $string\n");
            fclose($fo);
        }

    }
}