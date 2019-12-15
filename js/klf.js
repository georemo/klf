$(document).ready(function () {
    var url = "klf/backend/";
    getContents();

    function getContents() {
        console.log('starting getContents()');
        var env = {
            "ctx": "App",
            "m": "klf",
            "c": "Content",
            "a": "getArticleContent",
            "dat": {
                "t_name": "content",
                "article_id": "1",
                "ret": "json",
                "token": "i02I0phd2T0Z6UIfuvv417aL3jis5RoMKq81mBKe"
            },
            "args": null
        };
        // POST values in the background the the script URL
        $.ajax({
            type: "POST",
            url: url,
            data: env,
            success: function (resp) {
                var jResp = JSON.parse(resp);
                console.log(jResp.data);
                set_home(jResp.data)
            }
        });
    }

    function set_home(data) {
        $.each(data,(i) => {
            $('#' + data[i]["htmlID"]).html(data[i]["content_text"]);
        });
    }

    function set_services_bg(){
        $(".box").css("background-image", "url(" + imageUrl + ")");
    }
});