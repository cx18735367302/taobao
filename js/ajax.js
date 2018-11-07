//ajax封装
function ajax(method, url, fnSucc, fnFaild) {

    //1、创建Ajax实例
    try {
        var xml = new XMLHttpRequest();
    } catch (e) {
        xml = new ActiveXObject("Microsoft.XMLHTTP");
    }
    //2、连接服务器  打开和服务器的链接
    xml.open(method, url, true);

    //3、发送
    xml.send();

    //4、接收数据
    xml.onreadystatechange = function () {
        if (xml.readyState === 4) {
            if (xml.status === 200) {
                fnSucc(xml.responseText);
            } else {
                if (fnFaild) {
                    fnFaild();
                }
            }
        }
    }
}