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
function saveHandler(){
    var event = event || window.event;
    var target = event.target || event.srcElement; // Зачем я это сюда влепил?
    var xhr = new XMLHttpRequest();
    xhr.open('/ajax/','POST');
    xhr.setRequestHeader('Content-Type','application/json');
    var message = JSON.stringify(event.detail);
    xhr.send(message);
    xhr.onreadyStateChange = function(){
        if(xhr.readyState !== 4 && xhr.status !== 200){return;}
        console.log('Коментарий сохранен в базе данных');
    }
}