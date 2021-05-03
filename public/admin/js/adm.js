/**
 * expert function
 */


function saveThumbToExpert() {
    $.ajaxFileUpload({
        url: "/adm/expert/upload",
        secureuri: false,
        fileElementId: "upload_file",
        dataType: "json",
        data:{_token: $("#_token").val()},
        success: function(data, status) {
            if (data.success){
                $("#photo").val(data.photo);
                $("#thumb").attr("src", data.photo);
                alert("上传成功");
            } else{
                alert(data.msg);
            }
        }
    })
}




/**
 * video function
 */


function saveThumbToVideo() {
    $.ajaxFileUpload({
        url: "/adm/video/upload",
        secureuri: false,
        fileElementId: "upload_file",
        dataType: "json",
        data:{_token: $("#_token").val()},
        success: function(data, status) {
            if (data.success){
                $("#photo").val(data.photo);
                $("#thumb").attr("src", data.photo);
                alert("上传成功");
            } else{
                alert(data.msg);
            }
        }
    })
}

function experttovideo(){
    var expert = $('#expert option:selected');
    var flag = true;
    var experthtml = '';
    if(expert.val()){
        $('#expertlist').find('input').each(function(){
            if($(this).val()==expert.val()){
                flag = false;
                return false;
            }
        });
        if(flag){
            experthtml += '<div>';
            experthtml += '		<input type="hidden" value="'+expert.val()+'" name="doc_id[]">';
            experthtml += '		<span class="expert">'+expert.text()+'</span>';
            experthtml += '		<span class="glyphicon glyphicon-remove mouse" onclick="$(this).parent().remove()"></span>';
            experthtml += '</div>';
            $('#expertlist').append(experthtml);
        }else{
            alert('您已经添加过该专家了');
            return false;
        }
    }else{
        alert('请先选择一个专家');
        return false;
    }
}
