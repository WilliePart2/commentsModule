var container;
window.addEventListener('load', function(){
    container = document.getElementsByClassName('js-comment-wrapper');
}, false);
window.addEventListener('handledMessage', render, false);
/*
* Функция выводит коментарий на страницу
*/
function render(event){
    console.log('Сообщение отображено');
    // Получение нужных данных
    var event = event || window.event;
    var target = event.target || event.srcElement;
    var head = event.detail.head;
    var content = event.detail.text;

    // Создание HTML разметки для этих данных
    var box = document.createElement('div');
    box.className = 'comment-container';
    var header = document.createElement('h4'); // Предположительно
    header.className = 'comment-header';
    var text = document.createElement('p');
    text.className = 'comment-text';
    header.appendChild(document.createTextNode(head));
    text.appendChild(document.createTextNode(content));

    // Вставка данных на страницу
    box.appendChild(header);
    box.appendChild(text);
    for(var i = 0; i < container.length; i++){
        var elt = container[i];
        elt.appendChild(box);
    }

    // Уведомляем контроллер что коментарий принят и его нужно сохранить
    var event = new CustomEvent('initSaveMessage', {
        'bubbles':true,
        'cancelable':true,
        'detail': event.detail
    });
    target.dispatchEvent(event);
    console.log('Отправлен запрос на сохранение коментария в базу данных');
}
/*
 * Обработчик обнуляет поля ввода коментария
 */
window.addEventListener('dropFields', resetHandler, false);
function resetHandler(){
    header.value = '';
    text.value = '';
    console.log('Коментарий сброшен');
}