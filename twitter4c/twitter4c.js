/**
 * Created by JetBrains PhpStorm.
 * User: m_arino
 * Date: 12/02/13
 * Time: 16:41
 * To change this template use File | Settings | File Templates.
 */
function createTweetForm(){

    $("#twitter4c").empty()
                   .append("<p>contact us!</p>" +
                            "<input type='text' id='tweetbox' />" +
                            "<input type='button' value='tweet!' id='tweeting' onclick='tweeting();'>");
}

function tweeting(){

    var sendText = $("#tweetbox").val();

    $.post("./twitter4c/twitter4c.php",{message:sendText},function(data){
        if(data==1){
            alert("1");
        }else{
            alert(data);
        }
    });
}

$(function(){
    createTweetForm();
})