/**
 * Created by dell on 2018/10/20.
 */
function getParam(name){
    var search = location.search.substring(1);
    var regstr = "(^|&)"+name+"=(\\w+)(&|$)";
    reg = new RegExp(regstr);
    arr = reg.exec(search);
    if(arr){
        return arr[2]
    }else{
        return null
    }
}
$(document).ready(function(){
    if (cookiesutil.get('loginFlag')=='true'){
        $('.login').hide();
        $('.user').show().html('欢迎您，'+cookiesutil.get('name'));
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

    $.ajax({url:"json/tsconfig.json",success:function(result){
        var idnumber = Number(getParam("id")) ;
            var { id,productTit,productinfo,prise,shopName,photolist} = result[idnumber-1];
        $('.shopname p').text(shopName);
        $('.tit').text(productTit);
        $(".prise").text(prise);
        $('.info').text(productinfo);
        for (let i = 0; i < photolist.length; i++) {
            var obj = $('.model').html();
            obj = obj.replace("images/1.1.jpg",photolist[i]);
            $('.photolist').append(obj);
        }
        $('.middleimg').attr({src:$('.smallimg').attr("src")});
        for (let i = 0; i < $('.photolist .listmodel').length; i++) {
            $('.photolist .listmodel').eq(i).mouseenter(function(){
                $('.photolist .listmodel').removeClass("is-select");
                $(this).addClass("is-select")
                $('.middleimg').attr({src:$('.photolist .listmodel .smallimg').eq(i).attr("src")})
            })
        }
        $('.shopcarbtn').click(function(){
            if (cookiesutil.get('loginFlag')=='true'){
var arr = []
                arr.push(cookiesutil.get("id"));
                console.log(arr);
//cookiesutil.set("id","1")

            }else {
                alert("请先登录")
            }
        })
    }});
    var index = 1;
$('.add').click(function(){
    index++;
    $(".number").text(index)
})
    $('.cut').click(function(){
        index--;
        if(index<1){
            index =1;
        }
        $(".number").text(index)
    });
    $('.photo').mouseenter(function(){
        $('.mask').show();
        $('.show').show()
        $('.bigimg').attr({src:$('.middleimg').attr('src')})
    }).mouseleave(function(){
        $('.mask').hide();
        $('.show').hide()
    }).mousemove(function(){
        var pageX = event.pageX;
        var pageY = event.pageY;
        var box = $('.contentBox').offset()
        var maskX = pageX-box.left-$('.mask').width()/2
        var maskY = pageY-box.top-$('.mask').height()/2;
        if(maskX<0){
            maskX = 0;
        }
        if (maskX>$('.photo').width()-$('.mask').width()){
            maskX = $('.photo').width()-$('.mask').width()
        }
        if(maskY<0){
            maskY = 0
        }
        if(maskY>$('.photo').height()-$('.mask').height()){
            maskY = $('.photo').height()-$('.mask').height()
        }
        $('.mask').css({left:maskX,top:maskY});
        var bigMove = $('.bigimg').width()-$('.show').width();
        var maskmove = $('.photo').width()-$('.mask').width();
        var rate = bigMove/maskmove
        $('.bigimg').css({left:-(rate*maskX),top:-(rate*maskY)})
    })
});
