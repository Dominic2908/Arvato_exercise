$(document).ready(function(){
});
    /**
    * Funktionen zum Aufruf der Ajax/Sendefunktion
     */
    $("#array_list1").click(function(){
            SendAjaxJsonRequest("classes/server.php", "in_List_one");
    });
    $("#array_list2").click(function(){
            SendAjaxJsonRequest("classes/server.php", "in_List_two");
    });
    $("#array_intersect").click(function(){
            SendAjaxJsonRequest("classes/server.php", "array_intersect");
    });
    $("#json_generate").click(function(){
            SendAjaxJsonRequest("classes/server.php", "json_generate");
    });
    $("#array_flears").click(function(){
        let price_input = $("#preice_input").val();
        var values = {
            "price" : price_input
        }
        if(values !== "")
        {
            // JSON-Objekt wird zu einem string konvertiert, da wir nur ein serialisiertes Objekt uebergeben koennen
            var jsonString = JSON.stringify(values);
            SendAjaxJsonRequest("classes/server.php", "get_flears", jsonString);
        }
        else
        {
            alert("Alarm!");
        }

    });

/**
 * Sendet Ajax-Request
 */
function SendAjaxJsonRequest(url, method, jsonObject)
{
    $.ajax({
        type: "POST",
        url: url,
        data: {
            method: method,
            jsonObject: jsonObject
        },
        success: onSuccess
    });
}

/**
 * AJAX-Response auswerten
 */
function onSuccess(content)
{

    // Das empfangene Objekt wird wieder zum Objekt geparst
    var response = $.parseJSON(content);
    //var response = $.parseJSON(content.result);

    $(response.position).val(response.result);
    switch (response.position)
    {
        case "#array_out_list1":
            let output_list_one = array_out(response);
            $('#array_out_list1').val(output_list_one);
            break;
        case "#array_out_list2":
            let output_list_two = array_out(response);
            $('#array_out_list2').val(output_list_two);
            break;
        case "#array_out_diff":
            let output = array_out(response);
            $('#array_out_intersect').val(output);
            break;
        case "#json_generate":
            let output_produkt_list = product_out(response.result.product_to_land);
            $('#highest_price_out').val(response.result.highest.ddat);
            $('#lowest_price_out').val(response.result.lowest.ddat);
            $('#times_purchased').val(response.result.times_purchased.ddat);
            $('#input_product_land').html(output_produkt_list);
            break;
        case "#array_out_flears":
            let array_out_flears_list = array_out_fleats(response.result.flears);
            let array_out_flears_list_sold = array_out_fleats(response.result.flears_out);
            console.log(array_out_flears_list_sold);
            $('#array_out_flears').val(array_out_flears_list);
            $('#array_out_flears_sold').val(array_out_flears_list_sold);
            break;
        default:
            $result = "Ein Fehler ist aufgetreten!";

            break;
    }
}

/**
 * Funktionen zur Aufbereitung der Daten für HTML
 * @param request
 * @returns {string}
 */
function array_out(request) {
    let output = "";
    $.each(request.result, function(key, value) {
        output = output + value;
    });
    return output;
}

function array_out_fleats(request) {
    let output = "";
    for(let i = 0; i <= request.length; i++){
        $.each(request[i], function(key, value) {
            output = output + key + " - "+value + "\n";
        });
    }
    return output;
}

function product_out(response){
    let rowspan = 0;
    let output_land_produts = "";
    output_land_produts = output_land_produts + "<table>";
    output_land_produts = output_land_produts + "<thead>";
    output_land_produts = output_land_produts + "<tr>";
    output_land_produts = output_land_produts + "<th>Land</th>";
    output_land_produts = output_land_produts + "<th>Produktname</th>";
    output_land_produts = output_land_produts + "<th>Preis</th>";
    output_land_produts = output_land_produts + "</tr>";
    output_land_produts = output_land_produts + "</thead>";
    $.each(response, function(key, value) {
        rowspan = value.length;
        let control = 0;
        $.each(value, function(key1, value1) {
            output_land_produts = output_land_produts + "<tr>";
            if(rowspan > 1) {
                if(control <= 0){
                    output_land_produts = output_land_produts + "<td>" + value1.land + "</td><td>" + value1.ddat + "</td><td>" + value1.price + "</td>";
                }else{
                    output_land_produts = output_land_produts + "<td rowspan=''" + rowspan + " ></td><td>" + value1.ddat + "</td><td>" + value1.price + "</td>";
                }
                control++;
            }else{
                output_land_produts = output_land_produts + "<td>" + value1.land + "</td><td>" + value1.ddat + "</td><td>" + value1.price + "</td>";
            }
            output_land_produts = output_land_produts + "</tr>";
        });
    });
    output_land_produts = output_land_produts + "</table>";
    return output_land_produts;
}
