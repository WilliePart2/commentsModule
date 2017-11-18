/*
* Принимает событие отправки сообщения и обрабатываем его
*/
window.addEventListener('message', messageHandler, false);
function messageHandler(event){
    console.log('Сообщение принято');
    if(!event){event = window.event;}
    var target = event.target || event.srcElement;
    var message = event.detail;
    /*
    * Пока что никак не обрабатываем сообщение
    */
    var event = new CustomEvent('handledMessage', {
        'bubbles': true,
        'cancelable': true,
        'detail': message
    });
    target.dispatchEvent(event);
}
/*
* Сохранение сообщения на сервере(нужен AJAX)
*/
window.addEventListener('initSaveMessage', saveHandler, false);
function saveHandler(event){
    var event = event || window.event;
    var target = event.target || event.srcElement; // Зачем я это сюда влепил?
    var host = location.href + 'ajax/';
    console.log(host);
    var xhr = new XMLHttpRequest();
    xhr.open('POST',encodeURI(host), true);
    xhr.setRequestHeader('Content-Type','application/json');
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest'); // Заголовок устанавливать обязательно!
    var message = JSON.stringify(event.detail);
    console.log(message);
    xhr.send(message);
    xhr.onreadystatechange = function(){
        if((xhr.readyState !== 4) && (xhr.status !== 200)){return;}
        var event = new CustomEvent('dropFields', {
            'bubbles': true,
            'cancelable': true
        });
        target.dispatchEvent(event);

        console.log(xhr.responseText);
        console.log('Коментарий сохранен в базе данных');
    }
}