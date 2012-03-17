
function createTweetForm(){

    $("#twitter4c").empty()
                   .append("<p>Contact us!</p>" +
                            "<input type='text' class='input-xlarge' placeholder='ここに内容を書いてね。' id='tweetbox' style='margin: 5px;'/>" +
                            "<button class='btn btn-primary' style='margin: 5px;' onclick='tweeting();'>Tweet</button>");
}

function tweeting(){

    var sendText = $("#tweetbox").val();

    if (sendText
        )

    $.post("./twitter4c/twitter4c.php",{message:sendText},function(data){
        alert(data);
    });
    $.post("./twitter4c/twitter4c")
}

function showResult(){
    $("#result4c").empty()
                   .append("<p>まだ未実装</p>");
        
}

$(function(){
    createTweetForm();
})