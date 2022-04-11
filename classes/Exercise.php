<?php


class exercise
{

    /**
     * @var
     */
    private $content;

    /**
     * @var
     */
    private $jsonObject;

    /**
     * @var
     */
    private $result;

    public function __construct($content) {

        $this->content = $content;

    }


    /**
     * @return array
     */
    public function in_List_One()
    {
        $names_from_txt1_in_array = file('../assets/List1.txt');
        $names_from_txt2_in_array = file('../assets/List2.txt');
        $array_list1_out[] = "";
        foreach($names_from_txt2_in_array as $key => $value){
            $is_in_array = in_array($value, $names_from_txt1_in_array,  false);
            if($is_in_array == false){
                array_push($array_list1_out, $value);
            }
        }
        return $array_list1_out;
    }

    /**
     * @return array
     */
    public function in_List_Two()
    {
        $names_from_txt1_in_array = file('../assets/List1.txt');
        $names_from_txt2_in_array = file('../assets/List2.txt');
        $array_list1_out[] = "";
        foreach($names_from_txt1_in_array as $key => $value){
            $is_in_array = in_array($value, $names_from_txt2_in_array,  false);
            if($is_in_array == false){
                array_push($array_list1_out, $value);
            }
        }
        return $array_list1_out;
    }

    /**
     * @return array
     */
    public function array_intersect(){

        $names_from_txt1_in_array = file('../assets/List1.txt');
        $names_from_txt2_in_array = file('../assets/List2.txt');

        return $this->result = array_intersect($names_from_txt1_in_array, $names_from_txt2_in_array);
    }

}