/**
 * Created by JetBrains PhpStorm.
 * User: m_arino
 * Date: 12/02/13
 * Time: 16:41
 * To change this template use File | Settings | File Templates.
 */
function createTweetForm(){

    window.setTimeout("",100);

    $("#twitter4c").empty()
                   .append("<p>contact information</p>")
                   .append("<input type='text' id='tweetbox'></input>")
                   .append("<input type='button' id='tweeting' onclick='tweeting();'>");

}

function tweeting(){
    var sendtext = $("#tweetbox").val();

    $.post("./twitter4c/twitter4c.php",{message:sendtext},function(data){
        if(data==1){
            alert("1");
        }else{
            alert("2");
        }
    });
}