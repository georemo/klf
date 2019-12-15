$(document).ready(function () {
    var url = "../klf/backend/";
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
        post(env, set_editables);
    }

    function set_editables(data) {
        var token = $('#token').val();
        $.each(data,(i) => {
            var htmlID = data[i]["htmlID"];
            var itemIndex = data[i]["content_id"];
            var itemID = htmlID + 'ID';
            var itemName = htmlID;
            var itemContent = data[i]["content_text"];
            var itemTitle = data[i]["description"];
            $('#divControls').append(`<div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="hidden" id="` + itemID + `" type="text" name="` + itemID + `" class="form-control"
                                required="required" data-error="` + itemID + ` is required." value="` + itemIndex + `">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="form_message">` + itemTitle + `</label>
                            <textarea id="` + itemName + `" name="` + itemName + `" class="form-control"
                                placeholder="top header" rows="4" required="required"
                                data-error="top header not set">` + itemContent + `</textarea>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <input id="btn` + itemName + `" type="submit" class="btn btn-success btn-send" value="Save">
                    </div>
                </div>
                <hr>`);

                $('#divControls').find('#btn' + itemName).click((e) => {
                    e.preventDefault();
                    var contentID = $('#' + itemID).val();
                    var content = $('#' + itemName).val();
                    updateContent(contentID, content);
                });     
        });
    }

    function updateContent(contentID, content) {
        console.log('starting getContents()');
        var env = {
            "ctx": "App",
            "m": "klf",
            "c": "Content",
            "a": "updateContent",
            "dat": {
                "t_name": "content",
                "content_id": contentID,
                "content": content,
                "ret": "json",
                "token": $('#token').val()
            },
            "args": null
        };
        post(env, null);
    }

    function post(env, fx) {
        // POST values in the background the the script URL
        $.ajax({
            type: "POST",
            url: url,
            data: env,
            success: function (resp) {
                // console.log('resp>>', resp);
                var jResp = JSON.parse(resp);
                console.log(jResp.data);
                if (fx) {
                    fx(jResp.data);
                }
            }
        });
    }
});