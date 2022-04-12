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

    /**
     * @return array
     */
    public function csv_read(){
        $array_out = [];
        $row = 1;
        if (($handle = fopen("../assets/IP2LOCATION-ISO3166-2.CSV", "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $num = count($data);
                $row++;
                for ($c=0; $c < $num; $c++) {
                    $array_out[$row] = $data;
                }
            }
            fclose($handle);
        }

        file_put_contents("../assets/land_code.json", json_encode($array_out, JSON_PRETTY_PRINT));
        //$this->result = json_encode($array_out);
        return $array_out;
    }
    /**
     * @return array
     */
    public function json_evaluate(){

        $arrayland_code = json_decode(file_get_contents("../assets/land_code.json"), true);
        $array = json_decode(file_get_contents("../assets/sampleProductsData.json"), true);

        $array_out = [];
        $highest_price_array  = [];
        $highest_price  = 0;
        $lowest_price_array = [];
        $lowest_price = 0;
        $times_purchased_array = [];
        $times_purchased = 0;
        $land_code_array = [];
        $product_to_land_array = [];
        foreach($array as $key => $value){
            $array_out_high[$key] = $value;
            if($value['price'] >= $highest_price){
                $highest_price_array = $array_out_high[$key];
                $highest_price = $value['price'];
            }
        }
        $lowest_price = $highest_price;

        foreach($array as $key => $value){
            $array_out_low[$key] = $value;
            if($value['price'] <= $lowest_price){
                $lowest_price_array = $array_out_low[$key];
                $lowest_price = $value['price'];
            }
        }

        foreach($array as $key => $value){
            $array_out_times_purchased[$key] = $value;
            if($value['timesPurchased'] >= $times_purchased){
                $times_purchased_array = $array_out_times_purchased[$key];
                $times_purchased = $value['timesPurchased'];
            }
        }

        foreach($arrayland_code as $key => $value){
            foreach($array as $key1 => $value1){
                if($value['1'] == $value1['countryOfOrigin']){
                    $array[$key1] += ['land' => $value['0']];
                }
            }
        }

        foreach($arrayland_code as $key => $value){
            $e = 0;
            $test[$key] = $value['1'];
            foreach($array as $key1 => $value1){

                if($value1['countryOfOrigin'] === $value['1']){
                    //$product_to_land_array[$key1] = $value1['countryOfOrigin'];
                    //$product_to_land_array[$value['1']] = array_push($product_to_land_array, $array[$key1]) ;
                    $product_to_land_array[$key][$e] = [];
                    $product_to_land_array[$key][$e] += [$value['1'] => $array[$key1]];
                    $e++;
                }
            }
        }

        $array_out['highest'] = $highest_price_array;
        $array_out['lowest'] = $lowest_price_array;
        $array_out['times_purchased'] = $times_purchased_array;
        $array_out['product_to_land'] = $product_to_land_array;
        //print_r($product_to_land_array);
        file_put_contents("../text/analyze/sampleProductsData.json", json_encode($array_out, JSON_PRETTY_PRINT));
        return $product_to_land_array;
    }

}