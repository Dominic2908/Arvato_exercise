<?php

require_once('Exercise.php');

class Controller
{

    /**
     * @var Aufgaben
     */
    private $exercise;

    /**
     * Controller constructor.
     */
    public function __construct() {
        $this->exercise = new Exercise($_POST);
    }

    /**
     * @return false|string
     */
    public function execute()
    {

        // Rueckgabeobjekt
        $result = "";

        // JSON-Objekt falls vorhanden
        $jsonObject = null;

        // $_POST Variable auslesen
        if (isset($_POST['method']))
        {
            $method = $_POST['method'];
        }
        /**
         * Aufruf der Klassenfunktionen der einzelnen Aufgaben
         */
        switch ($method)
        {
            case "in_List_one":

                $in_list_one = $this->exercise->in_List_One();

                $responseArray = array(
                    "result" => $in_list_one,
                    "position" => "#array_out_list1"
                );

                //Das Resultobjekt Kodieren
                $result = json_encode($responseArray);

                break;
            case "in_List_two":

                $in_list_two = $this->exercise->in_List_Two();

                $responseArray = array(
                    "result" => $in_list_two,
                    "position" => "#array_out_list2"
                );

                //Das Resultobjekt Kodieren
                $result = json_encode($responseArray);

                break;

            case "array_intersect":

                $arrayIntersect = $this->exercise->array_intersect();

                $responseArray = array(
                    "result" => $arrayIntersect,
                    "position" => "#array_out_diff"
                );

                //Das Resultobjekt Kodieren
                $result = json_encode($responseArray);

                break;
            case "json_generate":

                $arrayJason = $this->exercise->csv_read();
                $arrayJason = $this->exercise->json_evaluate();

                $responseArray = array(
                    "result" => $arrayJason,
                    "position" => "#json_generate"
                );

                //Das Resultobjekt Kodieren
                $result = json_encode($responseArray);

                break;
            case "get_flears":

                $arrayJason = $this->exercise->getOptimalValu();

                $responseArray = array(
                    "result" => $arrayJason,
                    "position" => "#array_out_flears"
                );

                //Das Resultobjekt Kodieren
                $result = json_encode($responseArray);

                break;

            default:
                $result = "Ein Fehler ist aufgetreten!";

                break;
        }

        return $result;
    }
}