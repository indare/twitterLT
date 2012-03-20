
function createTweetForm(){

    $("#twitter4c").empty()
                   .append("<p>Contact us!</p>" +

                            "<label for='namebox'>名前：</label><input type='text' class='input-xlarge' placeholder='おなまえ。' id='namebox' style='margin: 5px;'/>" +
                            "<label for='tweetbox'>内容：</label><input type='text' class='input-xlarge' placeholder='ここに内容を書いてね。' id='tweetbox' style='margin: 5px;'/>" +
                            "<button class='btn btn-primary' style='margin: 5px;' onclick='tweeting();'>Tweet</button>");
}

function getTweetList(){
    $.post("./twitter4c/admin.php",{},function(data){
        $("#result4c").empty()
                        .append(data);
    });
}

function tweeting(){

    var sendText = $("#tweetbox").val();
    var sendName = $("#namebox").val();

    $.post("./twitter4c/twitter4c.php",{name:sendName,message:sendText},function(data){
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