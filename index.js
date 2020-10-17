
'use strict';
    const message = {  //объект с сообщениями об отправке
        loading: 'Загрузка',
        success: 'Спасибо! Скоро мы с вами свяжемся.',
        failure: 'Что-то пошло не так!',
    }
    
    const form = document.getElementById('form'); //получаем форму из HTML
  
        form.addEventListener("submit",function(e) {
            e.preventDefault(); // убрать стандартное поведение браузера
            
            const statusMessage = document.createElement('div');
            
             //сообщение о статусе
            statusMessage.textContent = message.loading;
            form.append(statusMessage);
           
            
      
            const request = new XMLHttpRequest();
            request.open('POST', 'test.php');
      
            request.setRequestHeader('Content-type', 'application/json');
            const formData = new FormData(form);
            
            // const json = JSON.stringify(Object.fromEntries(formData.entries()));  
            
            let obj = {}; // объект в который собираем все поля инпутов
            formData.forEach((value,key)=>{
              obj[key] = value;
            });
            const json = JSON.stringify(obj);

            request.send(json); //отправка данных
            request.addEventListener('load', ()=> {
                if(request.status === 200){  //проверка и вывод на экран сообщения об отправке
                    console.log(request.response);
                    statusMessage.textContent = message.success;
                } else {
                  statusMessage.textContent = message.failure;
                }
            });
            
          });


  