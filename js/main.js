/**
 * Created by dell on 2018/10/20.
 */
$(document).ready(function(){
    if (cookiesutil.get('loginFlag')=='true'){
        $('.login').hide();
        ajax("get","php/login.php",function (result) {
            result = JSON.parse(result);
            $('.user').show().html('欢迎您，'+result.data.username);
        });

        $('.islogin').hide();
        $('#out').show()
    }else{
        $('.login').show();
        $('.user').hide();
        $('#out').hide()
    }
    $('#out').click(function(){
        cookiesutil.set('loginFlag','false');
        window.location.reload()
    });
ajax("get","php/index.php",function(result){
    result = JSON.parse(result) ;
result = result["data"];
    var a = $('.product-list').html();
    for (let i = 0; i < result.length; i++) {
        var str = $('.flow').html();
        str = str.replace("{prise}",result[i].prise);
        str = str.replace("{id}",result[i].id);
        str = str.replace("{title}",result[i].productTit);
        str = str.replace("{shopName}",result[i].shopName);
        str = str.replace("{payPeople}",result[i].payPeople);
        str = str.replace("images/1.webp",result[i].photoSmallSrc);
a+=str;
    }
    $('.product-list').html(a)
})

});
