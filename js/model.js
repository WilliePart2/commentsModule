/*
* Объявляем переменные что бы они были видны глобально
*/
var header, text, send, reset;
window.addEventListener('load', function() {
    /*
    * Поиск нужных элементов
    */
    header = document.getElementsByClassName('js-head')[0];
    text = document.getElementsByClassName('js-text')[0];
    send = document.getElementsByClassName('js-send');
    reset = document.getElementsByClassName('js-reset');
    /*
    * Вешаем обработчики
    */
    Array.prototype.forEach.call(send, function (elt) {
        elt.addEventListener('click', sendHandler, false);
    });
    Array.prototype.forEach.call(reset, function (elt) {
        elt.addEventListener('click', resetHandler, false);
    });
}, false);
/*
* Этот обработчик отправляет сообщение при помощи события
*/
function sendHandler(event){
    if(!event){event = window.event;}
    var target = event.target || event.srcElement;
    var message = {
        'head': header.value,
        'text': text.value
    };
    var event = new CustomEvent('message',{
        'bubbles':true,
        'cancelable': true,
        'detail': message
    });
    target.dispatchEvent(event);
    console.log('Коментарий отправлен');
}
/*
 * Обработчик обнуляет поля ввода коментария
 */
function resetHandler(){
    header.value = '';
    text.value = '';
    console.log('Коментарий сброшен');
}