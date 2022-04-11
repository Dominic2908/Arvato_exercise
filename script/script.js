$(document).ready(function(){
});
    $("#array_list1").click(function(){
            SendAjaxJsonRequest("classes/server.php", "in_List_one");
    });
    $("#array_list2").click(function(){
            SendAjaxJsonRequest("classes/server.php", "in_List_two");
    });
    $("#array_intersect").click(function(){
            SendAjaxJsonRequest("classes/server.php", "array_intersect");
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
    console.log(content)
    // Das empfangene Objekt wird wieder zum Objekt geparst
    var response = $.parseJSON(content);
    //console.log(response)
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
        default:
            $result = "Ein Fehler ist aufgetreten!";

            break;
    }
}
function array_out(request) {
    let output = "";
    $.each(request.result, function(key, value) {
        output = output + value;
    });
    return output;
}
